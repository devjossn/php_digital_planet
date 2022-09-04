<?php
  /**
   * PayFast IPN
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2016
   * @version $Id: ipn.php, 2016-08-30 21:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once ("../../../init.php");

  ini_set('log_errors', true);
  ini_set('error_log', dirname(__file__) . '/ipn_errors.log');

  if (isset($_POST['payment_status'])) {
      require_once (BASEPATH . '/gateways/payfast/pf.inc.php');

      $pf = Db::run()->first(Admin::gTable, array("live", "extra3"), array("name" => "payfast"));
      $pfHost = ($pf->live) ? 'https://www.payfast.co.za' : 'https://sandbox.payfast.co.za';
      $error = false;

      pflog('ITN received from payfast.co.za');
      if (!pfValidIP($_SERVER['REMOTE_ADDR'])) {
          pflog('REMOTE_IP mismatch: ');
          $error = true;
          return false;
      }

      $result = pfGetData();

      pflog('POST received from payfast.co.za: ' . print_r($result, true));

      if ($result === false) {
          pflog('POST is empty: ' . print_r($result, true));
          $error = true;
          return false;
      }

      if (!pfValidSignature($result, $pf->extra3)) {
          pflog('Signature mismatch on POST');
          $error = true;
          return false;
      }

      pflog('Signature OK');

      $itnPostData = array();
      $itnPostDataValuePairs = array();

      foreach ($_POST as $key => $value) {
          if ($key == 'signature')
              continue;

          $value = urlencode(stripslashes($value));
          $value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value);
          $itnPostDataValuePairs[] = "$key=$value";
      }

      $itnVerifyRequest = implode('&', $itnPostDataValuePairs);
      if (!pfValidData($pfHost, $itnVerifyRequest, "$pfHost/eng/query/validate")) {
          pflog("ITN mismatch for $itnVerifyRequest\n");
          pflog('ITN not OK');
          $error = true;
          return false;
      }

      pflog('ITN OK');
      pflog("ITN verified for $itnVerifyRequest\n");

      if ($error == false and $_POST['payment_status'] == "COMPLETE") {
          $custom = Utility::decode($_POST['custom_int1']);
          list($user_id, $sesid) = explode("_", $custom);
          $mc_gross = $_POST['amount_gross'];
          $membership_id = $_POST['m_payment_id'];
          $txn_id = Validator::sanitize($_POST['pf_payment_id']);

          $user = Db::run()->first(Users::mTable, null, array("id" => intval($user_id)));
          $cart = Product::getCartContentIpn($sesid);
          $totals = Product::getCartTotal($sesid);
          $tax = Content::calculateTax();
          $amount = (($totals->tax > 0) ? $totals->grand : $tax * $totals->grand + $totals->grand);
		  $items = array();
		  $cdkey = array();
		  
          if ($cart) {
              foreach ($cart as $k => $item) {
				  $key = Db::run()->getValue(Product::cdTable, "cdkey", "product_id", $item->id);
                  $data = array(
                      'user_id' => $user->id,
                      'product_id' => $item->id,
                      'txn_id' => $txn_id,
                      'tax' => Validator::sanitize($item->total * $tax, "float"),
                      'amount' => Validator::sanitize($item->total, "float"),
                      'total' => Validator::sanitize(($totals->tax > 0) ? $totals->tax : $tax * $item->total + $item->total, "float"),
                      'coupon' => $item->coupon,
                      'cdkey' => ($key) ? $key : "",
                      'pp' => "PayFast",
                      'ip' => Url::getIP(),
                      'file_date' => time(),
                      'currency' => "ZAR",
                      'status' => 1,
                      );

                  $items[$k]['title'] = $item->title;
                  $items[$k]['qty'] = 1;
                  $items[$k]['price'] = $item->total;
                  $items[$k]['cdkey'] = $data['cdkey'];
                  $cdkey[] = $data['cdkey'];

				  Db::run()->insert(Product::xTable, $data);
				  if($key) {
					  Db::run()->delete(Product::cdTable, array("cdkey" => $data['cdkey']));
				  }
              }

              // invoice table
              $xdata = array(
                  'invoice_id' => substr(time(), 5),
                  'transaction_id' => $txn_id,
                  'user_id' => $user->id,
                  'items' => json_encode($items),
                  'coupon' => $totals->discount,
                  'tax' => Utility::formatNumber(($totals->subtotal - $totals->discount) * $tax),
                  'subtotal' => $totals->subtotal,
                  'grand' => $amount,
                  'currency' => "ZAR",
                  );
              Db::run()->insert(Product::ivTable, $xdata);

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
                  "PayFast",
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
              Db::run()->delete(Product::cxTable, array("user_id" => $sesid));

              pflog("Email Notification [Admin] sent successfuly");
          }

      } else {
          /* == Failed or Pending Transaction == */
      }
  }