<?php
  /**
   * iDeal IPN
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2017
   * @version $Id: ipn.php, v1.00 2017-06-08 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once ("../../../init.php");

  if (!App::Auth()->is_User())
      exit;

  ini_set('log_errors', true);
  ini_set('error_log', dirname(__file__) . '/ipn_errors.log');

  if (Validator::get('order_id')) {
	  require_once (BASEPATH . '/gateways/ideal/initialize.php');
      $apikey = Db::run()->first(Admin::gTable, array("extra"), array("name" => "ideal"));

      $mollie = new Mollie_API_Client;
      $mollie->setApiKey($apikey->extra);

      $o = Validator::sanitize($_GET['order_id'], "string");
      $c = Db::run()->select(Content::xTable, array("cart_id"), array("order_id" => $o))->result();

	  $items = array();
	  $cdkey = array();
		  
      if ($c) {
		  $cart = Product::getCartContentIpn();
		  $totals = Product::getCartTotal();
		  $tax = Content::calculateTax();
		  
          $payment = $mollie->payments->get($c->cart_id);
          if ($payment->isPaid() == true) {
			  $amount = Utility::numberParse((($totals->tax > 0) ? $totals->grand : $tax * $totals->grand + $totals->grand));
			  $txn_id = $payment->metadata->order_id;
              // insert payemnt record
			  foreach ($cart as $k => $item) {
				  $key = Db::run()->getValue(Product::cdTable, "cdkey", "product_id", $item->id);
				  $data = array(
					  'user_id' => App::Auth()->uid,
					  'product_id' => $item->id,
					  'txn_id' => $txn_id,
					  'tax' => Utility::numberParse($item->total * $tax),
					  'amount' => Validator::sanitize($item->total, "float"),
					  'total' => Validator::sanitize(($totals->tax > 0) ? $totals->tax : $tax * $item->total + $item->total, "float"),
					  'coupon' => $item->coupon,
					  'cdkey' => ($key) ? $key : "",
					  'pp' => "iDeal",
					  'ip' => Url::getIP(),
					  'file_date' => time(),
					  'currency' => "EUR",
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
				'user_id' => App::Auth()->uid,
				'items' => json_encode($items),
				'coupon' => $totals->discount,
				'tax' => Utility::formatNumber(($totals->subtotal - $totals->discount) * $tax),
				'subtotal' => $totals->subtotal,
				'grand' => $amount,
				'currency' => "EUR",
			  );
			  Db::run()->insert(Product::ivTable, $xdata);  
			  

              $json['type'] = 'success';
              $json['title'] = Lang::$word->SUCCESS;
              $json['message'] = Lang::$word->STR_POK;
			  
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
				  implode(", ", array_column($items, "cdkey")),
                  $amount,
                  "Completed",
                  "iDeal",
                  Url::getIP(),
                  $core->social->facebook,
                  $core->social->twitter), $tpl->body);

              $msg = (new Swift_Message())
					->setSubject($tpl->subject)
					->setTo(array($core->site_email => $core->company))
					->setFrom(array($core->site_email => $core->company))
					->setBody($body, 'text/html');
              $mailer->send($msg);

              /* == Notify User == */
              $tpl2 = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'payCompleteUser'));
              $ubody = str_replace(array(
                  '[LOGO]',
                  '[CEMAIL]',
                  '[COMPANY]',
                  '[DATE]',
                  '[SITEURL]',
                  '[NAME]',
                  '[TYPE]',
                  '[ITEMNAME]',
                  '[CDKEY]',
                  '[PRICE]',
                  '[TAX]',
                  '[PP]',
                  '[FB]',
                  '[TW]'), array(
                  Utility::getLogo(),
                  $core->site_email,
                  $core->company,
                  date('Y'),
                  SITEURL,
                  App::Auth()->name,
                  Lang::$word->PRD_PRODUCT,
                  implode(", ", array_column($items, "title")),
                  Lang::$word->PRD_CDKEYS . ": " . implode(", ", array_column($items, "cdkey")),
                  $amount,
                  $data['tax'],
                  "Stripe",
                  Url::getIP(),
                  $core->social->facebook,
                  $core->social->twitter), $tpl2->body);

              $umailer = Mailer::sendMail();
              $umessage = (new Swift_Message())
                        ->setSubject($tpl2->subject)
                        ->setTo(array(App::Auth()->email => App::Auth()->name))
                        ->setFrom(array($core->site_email => $core->company))
                        ->setBody($ubody, 'text/html');
              $umailer->send($umessage);
			  
			  // empty cart
			  Db::run()->delete(Product::cxTable, array("user_id" => App::Auth()->sesid));
          } else {
              $json['type'] = 'error';
              $json['title'] = Lang::$word->ERROR;
              $json['message'] = Lang::$word->STR_ERR1;
          }
      } else {
          $json['type'] = 'error';
          $json['title'] = Lang::$word->ERROR;
          $json['message'] = Lang::$word->STR_ERR1;
      }
      print json_encode($json);
  } else {
	  $json['type'] = 'error';
	  $json['title'] = Lang::$word->ERROR;
	  $json['message'] = Lang::$word->STR_ERR1;
	  print json_encode($json);
  }