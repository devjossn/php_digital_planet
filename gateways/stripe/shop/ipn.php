<?php
  /**
   * Stripe IPN
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2016
   * @version $Id: ipn.php, v1.00 2016-06-08 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once ("../../../init.php");

  if (!App::Auth()->is_User())
      exit;

  ini_set('log_errors', true);
  ini_set('error_log', dirname(__file__) . '/ipn_errors.log');

  if (isset($_POST['processStripePayment'])) {
	  $rules = array(
		  'payment_method' => array('required|string', "Invalid Payment Method"),
		  );
			  
	  $validate = Validator::instance();
	  $safe = $validate->doValidate($_POST, $rules);

      if (!$cart = Product::getCartContentIpn()) {
          Message::$msgs['cart'] = Lang::$word->STR_ERR;
      }

      if (empty(Message::$msgs)) {
          require_once BASEPATH . "/gateways/stripe/vendor/autoload.php";
          $skey = Db::run()->first(Admin::gTable, array("extra", "extra2"), array("name" => "stripe"));
		  
		  $totals = Product::getCartTotal();
		  $tax = Content::calculateTax();
		  $amount = Utility::numberParse((($totals->tax > 0) ? $totals->grand : $tax * $totals->grand + $totals->grand));
		  $items = array();
		  $cdkey = array();

          \Stripe\Stripe::setApiKey($skey->extra);
          try {
              //Charge client
              $client = \Stripe\Customer::create(array(
			      "payment_method" => $safe->payment_method,
                  "name" => App::Auth()->name
                  ));

              // insert payemnt record
			  foreach ($cart as $k => $item) {
				  $key = Db::run()->getValue(Product::cdTable, "cdkey", "product_id", $item->id);
				  $data = array(
					  'user_id' => App::Auth()->uid,
					  'product_id' => $item->id,
					  'txn_id' => time(),
					  'tax' => Utility::numberParse($item->total * $tax),
					  'amount' => Validator::sanitize($item->total, "float"),
					  'total' => Validator::sanitize(($totals->tax > 0) ? $totals->tax : $tax * $item->total + $item->total, "float"),
					  'coupon' => $item->coupon,
					  'cdkey' => ($key) ? $key : "",
					  'pp' => "Stripe",
					  'ip' => Url::getIP(),
					  'file_date' => time(),
					  'currency' => $skey->extra2,
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
				'transaction_id' => $data['txn_id'],
				'user_id' => App::Auth()->uid,
				'items' => json_encode($items),
				'coupon' => $totals->discount,
				'tax' => Utility::numberParse(($totals->subtotal - $totals->discount) * $tax),
				'subtotal' => $totals->subtotal,
				'grand' => $amount,
				'currency' => strtoupper($skey->extra2),
			  );
			  Db::run()->insert(Product::ivTable, $xdata);  
				
              $jn['type'] = 'success';
			  $jn['title'] = Lang::$word->SUCCESS;
              $jn['message'] = Lang::$word->STR_POK;
              print json_encode($jn);

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
				  '[CDKEY]',
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
                  implode(", ", array_column($items, "title")),
				  implode(", ", array_column($items, "cdkey")),
                  $amount,
                  "Completed",
                  "Stripe",
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

          }
          catch (\Stripe\Error\Card $e) {
              $body = $e->getJsonBody();
              $err = $body['error'];
              $json['type'] = 'error';
              Message::$msgs['msg'] = 'Message is: ' . $err['message'] . "\n";
              Message::msgSingleStatus();
          }
      } else {
          Message::msgSingleStatus();
      }
  }