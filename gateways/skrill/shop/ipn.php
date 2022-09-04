<?php

  /**
   * Skrill IPN
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2016
   * @version $Id: ipn.php, v1.00 2016-06-08 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once ("../../../init.php");

  ini_set('log_errors', true);
  ini_set('error_log', dirname(__file__) . '/ipn_errors.log');

  /* Check for mandatory fields */
  $r_fields = array(
      'status',
      'md5sig',
      'merchant_id',
      'pay_to_email',
      'mb_amount',
      'mb_transaction_id',
      'currency',
      'amount',
      'transaction_id',
      'pay_from_email',
      'mb_currency');
	  
  $skrill = Db::run()->first(Admin::gTable, array("extra3"), array("name" => "skrill"));
  foreach ($r_fields as $f)
      if (!isset($_POST[$f]))
          die();

  /* Check for MD5 signature */
  $md5 = strtoupper(md5($_POST['merchant_id'] . $_POST['transaction_id'] . strtoupper(md5($skrill->extra3)) . $_POST['mb_amount'] . $_POST['mb_currency'] . $_POST['status']));
  if ($md5 != $_POST['md5sig'])
      die();

  if (intval($_POST['status']) == 2) {
      $mb_currency = Validator::sanitize($_POST['mb_currency']);
      $mc_gross = $_POST['amount'];
      $txn_id = Validator::sanitize($_POST['mb_transaction_id']);
      $custom = Utility::decode($_POST['custom']);
      list($user_id, $sesid) = explode("_", $custom);

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
                  'pp' => "Skrill",
                  'ip' => Url::getIP(),
                  'file_date' => time(),
                  'currency' => strtoupper($mb_currency),
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
              'currency' => strtoupper($mb_currency),
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
              "Skrill",
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
      }
  } else {
      /* == Failed or Pending Transaction == */
  }