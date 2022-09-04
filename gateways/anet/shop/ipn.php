<?php
  /**
   * Auth.net IPN
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2016
   * @version $Id: ipn.php, v3.00 2016-03-08 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once ("../../init.php");

  if (!App::Auth()->is_User())
      exit;

  function ccValidate($ccn, $type)
  {
      switch ($type) {
          case "A":
              //American Express
              $pattern = "/^([34|37]{2})([0-9]{13})$/";
              return (preg_match($pattern, $ccn)) ? true : false;
              break;

          case "DI":
              //Diner's Club
              $pattern = "/^([30|36|38]{2})([0-9]{12})$/";
              return (preg_match($pattern, $ccn)) ? true : false;
              break;

          case "D":
              //Discover Card
              $pattern = "/^([6011]{4})([0-9]{12})$/";
              return (preg_match($pattern, $ccn)) ? true : false;
              break;

          case "M":
              //Mastercard
              $pattern = "/^([51|52|53|54|55]{2})([0-9]{14})$/";
              return (preg_match($pattern, $ccn)) ? true : false;
              break;

          case "V":
              //Visa
              $pattern = "/^([4]{1})([0-9]{12,15})$/";
              return (preg_match($pattern, $ccn)) ? true : false;
              break;
      }
  }

  function ccnCheck($ccn)
  {
      $ccn = preg_replace('/\D/', '', $ccn);
      $num_lenght = strlen($ccn);
      $parity = $num_lenght % 2;

      $total = 0;
      for ($i = 0; $i < $num_lenght; $i++) {
          $digit = $ccn[$i];
          if ($i % 2 == $parity) {
              $digit *= 2;
              if ($digit > 9) {
                  $digit -= 9;
              }
          }
          $total += $digit;
      }
      return ($total % 10 == 0) ? true : false;
  }

  require_once (BASEPATH . '/gateways/anet/autoload.php');

  $an = Db::run()->first(Admin::gTable, array(
      "live",
      "extra",
      "extra3"), array("name" => "anet"));

  define("AUTHORIZENET_API_LOGIN_ID", $an->extra);
  define("AUTHORIZENET_TRANSACTION_KEY", $an->extra3);
  define("AUTHORIZENET_SANDBOX", $an->live);

  if (isset($_POST['action'])) {
      $rules = array(
          'ccn' => array('required|string|min_len,15|max_len,19', Lang::$word->STR_CCN),
          'month' => array('required|numeric|exact_len,2', Lang::$word->STR_CEXM),
          'year' => array('required|numeric|exact_len,4', Lang::$word->STR_CEXY),
          'cvv' => array('required|numeric|exact_len,3', Lang::$word->STR_CCV),
          'address' => array('required|string|min_len,3|max_len,80', Lang::$word->ADDRESS),
          'city' => array('required|string|min_len,2|max_len,80', Lang::$word->CITY),
          'zip' => array('required|string|min_len,3|max_len,30', Lang::$word->ZIP),
          'state' => array('required|string|min_len,2|max_len,80', Lang::$word->STATE),
          'country' => array('required|string|exact_len,2', Lang::$word->M_COUNTRY),
          'fname' => array('required|string|min_len,3|max_len,60', Lang::$word->FNAME),
          'lname' => array('required|string|min_len,3|max_len,60', Lang::$word->LNAME),
          'email' => array('required|email', Lang::$word->EMAIL),
          );

      $validate = Validator::instance();
      $safe = $validate->doValidate($_POST, $rules);

      if (!$cart = Product::getCartContentIpn()) {
          Message::$msgs['cart'] = Lang::$word->STR_ERR;
      }

      if (!isset($_POST['cctype']))
          Message::$msgs['cctype'] = 'Please select your Credit Card Type';

      if (!empty($_POST['ccn']) and isset($_POST['cctype'])) {
          if (!ccValidate($_POST['ccn'], $_POST['cctype']))
              Message::$msgs['ccn'] = 'Credit Card number does not match the card type';

          if (!ccnCheck($_POST['ccn']))
              Message::$msgs['ccn'] = 'Invalid credit card number.';
      }

      if (empty($_POST['ccname']))
          Message::$msgs['ccname'] = 'Please enter name on your Credit Card';

      if (empty(Message::$msgs)) {
          $totals = Product::getCartTotal();
          $tax = Content::calculateTax();
          $amount = (($totals->tax > 0) ? $totals->grand : $tax * $totals->grand + $totals->grand);

          $sale = new AuthorizeNetAIM;
          $sale->amount = $amount;
          $sale->card_num = Validator::sanitize($_POST['ccn']);
          $sale->exp_date = Validator::sanitize($_POST['month'] . '/' . $_POST['year']);
          $response = $sale->authorizeAndCapture();
          $trans_id = $response->transaction_id;
          $staus = $response->approved;
          $case = 1;
		  $items = array();
		  $cdkey = array();
          switch ($staus) {
              case $case:
                  // insert payemnt record
                  foreach ($cart as $k => $item) {
					  $key = Db::run()->getValue(Product::cdTable, "cdkey", "product_id", $item->id);
                      $data = array(
                          'user_id' => App::Auth()->uid,
                          'product_id' => $item->id,
                          'txn_id' => $trans_id,
                          'tax' => Validator::sanitize($item->total * $tax, "float"),
                          'amount' => Validator::sanitize($item->total, "float"),
                          'total' => Validator::sanitize(($totals->tax > 0) ? $totals->tax : $tax * $item->total + $item->total, "float"),
                          'coupon' => $item->coupon,
                          'cdkey' => ($key) ? $key : "",
                          'pp' => "Authorize.Net",
                          'ip' => Url::getIP(),
                          'file_date' => time(),
                          'currency' => "USD",
                          'status' => 1,
                          );

                      $items[$k]['title'] = $item->title;
                      $items[$k]['qty'] = 1;
                      $items[$k]['price'] = $item->total;
                      $items[$k]['cdkey'] = $data['cdkey'];
                      $cdkey[] = $data['cdkey'];

                      Db::run()->insert(Product::xTable, $data);
                      ($key) ? Db::run()->insert(Product::xTable, $data) : null;
                  }

                  // invoice table
                  $xdata = array(
                      'invoice_id' => substr(time(), 5),
                      'transaction_id' => $trans_id,
                      'user_id' => App::Auth()->uid,
                      'items' => json_encode($items),
                      'coupon' => $totals->discount,
                      'tax' => Utility::formatNumber(($totals->subtotal - $totals->discount) * $tax),
                      'subtotal' => $totals->subtotal,
                      'grand' => $amount,
                      'currency' => "USD",
                      );
                  Db::run()->insert(Product::ivTable, $xdata);


                  $json['type'] = 'success';
                  $json['title'] = Lang::$word->SUCCESS;
                  $json['redirect'] = SITEURL;
                  $json['message'] = Lang::$word->STR_POK;
                  print json_encode($json);


                  /* == Notify Administrator == */
                  $mailer = Mailer::sendMail();
                  $tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'payComplete'));
                  $core = App::Core();
                  $body = str_replace(array(
                      '[LOGO]',
					  '[CEMAIL]',
                      '[COMPANY]',
                      '[DATE]',
                      '[SITEURL]',
                      '[NAME]',
                      '[TYPE]',
                      '[ITEMNAME]',
                      '[PRICE]',
                      '[STATUS]',
                      '[PP]',
                      '[IP]',
                      '[FB]',
                      '[TW]'), array(
                      Utility::getLogo(),
					  $core->site_email,
                      $core->company,
                      date('Y'),
                      SITEURL,
                      App::Auth()->name,
                      Lang::$word->PRD_PRODUCT,
                      implode(", ", array_column($cart, "title")),
                      $amount,
                      "Completed",
                      "Authorize.Net",
                      Url::getIP(),
                      $core->social->facebook,
                      $core->social->twitter), $tpl->body);

                  $msg = (new Swift_Message())
							->setSubject($tpl->subject)
							->setTo(array($core->site_email => $core->company))
							->setFrom(array($core->site_email => $core->company))
							->setBody($body, 'text/html');
							$mailer->send($msg);

                  // empty cart
                  Db::run()->delete(Product::cxTable, array("user_id" => App::Auth()->sesid));

                  break;

              default:
                  $json['type'] = 'error';
                  $json['title'] = Lang::$word->ERROR;
                  $json['message'] = "API Error Code: ' . $response->response_reason_code . '<br>Description: ' . $response->response_reason_text";
                  print json_encode($json);
                  break;
          }
          //echo '<pre>' . print_r($response, true) . '</pre>';
      } else {
          Message::msgSingleStatus();
      }
  }