<?php
  /**
   * RazorPay IPN
   *
   * @package CMS Pro
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: ipn.php, 2020-11-14 21:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once ("../../../init.php");
  
  if (!App::Auth()->is_User())
	  exit;
  
  ini_set('log_errors', true);
  ini_set('error_log', dirname(__file__) . '/ipn_errors.log');
  
  require(BASEPATH . '/gateways/razorpay/lib/Razorpay.php');
  use Razorpay\Api\Api;
  use Razorpay\Api\Errors\SignatureVerificationError;
  
  if (isset($_POST['razorpay_payment_id'])) {
	  $rules = array(
		  'razorpay_signature' => array('required|string', "Invalid Signature"),
		  'razorpay_payment_id' => array('required|string', "Invalid Payment Id"),
	  );
		  
	  $validate = Validator::instance();
	  $safe = $validate->doValidate($_POST, $rules);

      if (!$cart = Product::getCartContentIpn()) {
          Message::$msgs['cart'] = Lang::$word->STR_ERR;
      }
	  
	  if (empty(Message::$msgs)) {
		  $apikey = Db::run()->first(Admin::gTable, array("extra", "extra2", "extra3"), array("name" => "razorpay"));
		  $api = new Api($apikey->extra, $apikey->extra3);
		  
		  $totals = Product::getCartTotal();
		  $tax = Content::calculateTax();
		  $amount = Utility::numberParse((($totals->tax > 0) ? $totals->grand : $tax * $totals->grand + $totals->grand));
		  $items = array();
		  $cdkey = array();
		  
		  try {
			  $attributes = array(
				  'razorpay_order_id' => $totals->order_id,
				  'razorpay_payment_id' => $_POST['razorpay_payment_id'],
				  'razorpay_signature' => $_POST['razorpay_signature']
			  );
			  
			  $api->utility->verifyPaymentSignature($attributes);

              // insert payment record
			  foreach ($cart as $k => $item) {
				  $key = Db::run()->getValue(Product::cdTable, "cdkey", "product_id", $item->id);
				  $data = array(
					  'user_id' => App::Auth()->uid,
					  'product_id' => $item->id,
					  'txn_id' => $safe->razorpay_payment_id,
					  'tax' => Utility::numberParse($item->total * $tax),
					  'amount' => Validator::sanitize($item->total, "float"),
					  'total' => Validator::sanitize(($totals->tax > 0) ? $totals->tax : $tax * $item->total + $item->total, "float"),
					  'coupon' => $item->coupon,
					  'cdkey' => ($key) ? $key : "",
					  'pp' => "RazorPay",
					  'ip' => Url::getIP(),
					  'file_date' => time(),
					  'currency' => $apikey->extra2,
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
				'transaction_id' => $safe->razorpay_payment_id,
				'user_id' => App::Auth()->uid,
				'items' => json_encode($items),
				'coupon' => $totals->discount,
				'tax' => Utility::numberParse(($totals->subtotal - $totals->discount) * $tax),
				'subtotal' => $totals->subtotal,
				'grand' => $amount,
				'currency' => strtoupper($apikey->extra2),
			  );
			  Db::run()->insert(Product::ivTable, $xdata);  
			  
			  $json['type']    = 'success';
			  $json['title']   = Lang::$word->SUCCESS;
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
                  "RazorPay",
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
		  }
		  catch (SignatureVerificationError $e) {
			  $json['type']    = 'error';
			  $json['title']   = Lang::$word->ERROR;
			  $json['message'] = $e->getMessage();
			  print json_encode($json);
		  }
	  } else {
		  Message::msgSingleStatus();
	  }
  }