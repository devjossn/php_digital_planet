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


  require 'autoload.php';

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
          'cvv' => array('required|numeric|min_len,3|max_len,4', Lang::$word->STR_CCV),
          'address' => array('required|string|min_len,3|max_len,80', Lang::$word->ADDRESS),
          'city' => array('required|string|min_len,2|max_len,80', Lang::$word->CITY),
          'zip' => array('required|string|min_len,3|max_len,30', Lang::$word->ZIP),
          'state' => array('required|string|min_len,2|max_len,80', Lang::$word->STATE),
          'country' => array('required|string|exact_len,2', Lang::$word->COUNTRY),
          'fname' => array('required|string|min_len,3|max_len,60', Lang::$word->FNAME),
          'lname' => array('required|string|min_len,3|max_len,60', Lang::$word->LNAME),
          'email' => array('required|email', Lang::$word->EMAIL),
          );
	  
      $validate = Validator::instance();
      $safe = $validate->doValidate($_POST, $rules);

      if (!$cart = Content::getCart()) {
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

      if (empty(Message::$msgs) and $row = Db::run()->first(Content::mxTable, null, array("id" => $cart->membership_id))) {
          $sale = new AuthorizeNetAIM;
          $sale->amount = $cart->totalprice;
          $sale->card_num = Validator::sanitize($_POST['ccn']);
          $sale->exp_date = Validator::sanitize($_POST['month'] . '/' . $_POST['year']);
          $response = $sale->authorizeAndCapture();
          $trans_id = $response->transaction_id;
          $staus = $response->approved;
          $case = 1;

          switch ($staus) {
              case $case:
                  $data = array(
                      'txn_id' => $trans_id,
                      'membership_id' => $row->id,
                      'user_id' => $auth->uid,
                      'amount' => $total->originalprice,
                      'tax' => $total->totaltax,
                      'coupon' => $total->coupon,
                      'total' => $total->totalprice,
                      'currency' => "USD",
                      'pp' => "Authorize.Net",
                      'ip' => Url::getIP(),
                      'created' => Db::toDate(),
                      'status' => 1);

                  $last_id = Db::run()->insert(Product::xTable, $data)->getLastInsertId();

                  //insert user membership
				  $udata = array(
					  'transaction_id' => $last_id,
					  'user_id' => App::Auth()->uid,
					  'membership_id' => $row->id,
					  'expire' => Date::calculateDays($row->id),
					  'recurring' => $row->recurring,
					  'active' => 1,
					  );

                  //update user record
                  $xdata = array(
                      'membership_id' => $row->id,
                      'mem_expire' => $udata['expire'],
                      );

				  Db::run()->insert(Content::mxhTable, $udata);
				  Db::run()->update(Users::mTable, $xdata, array("id" => App::Auth()->uid));
				  Db::run()->delete(Product::cxTable, array("user_m_id" => App::Auth()->uid));

                  //update membership status
                  Auth::$udata->membership_id = App::Session()->set('membership_id', $row->id);
                  Auth::$udata->mem_expire = App::Session()->set('mem_expire', $xdata['mem_expire']);

				  $json['type'] = 'success';
				  $json['title'] = Lang::$word->SUCCESS;
				  $json['redirect'] = SITEURL;
				  $json['message'] = Lang::$word->STR_POK;
				  print json_encode($json);
                  break;

              default:
				  $json['type'] = 'error';
				  $json['title'] = Lang::$word->ERROR;
				  $json['message'] = "API Error Code: " . $response->response_reason_code . "<br>Description: " . $response->response_reason_text;
				  print json_encode($json);
                  break;

          }
          //echo '<pre>' . print_r($response, true) . '</pre>';
      } else {
          Message::msgSingleStatus();
	  }
  }