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
  require_once("../../init.php");
  
  if (!App::Auth()->is_User())
	  exit;
  
  ini_set('log_errors', true);
  ini_set('error_log', dirname(__file__) . '/ipn_errors.log');
  
  require(dirname(__file__) . '/lib/Razorpay.php');
  use Razorpay\Api\Api;
  use Razorpay\Api\Errors\SignatureVerificationError;
  
  if (isset($_POST['razorpay_payment_id'])) {
	  $rules = array(
		  'razorpay_signature' => array('required|string', "Invalid Signature"),
		  'razorpay_payment_id' => array('required|string', "Invalid Payment Id"),
	  );
		  
	  $validate = Validator::instance();
	  $safe = $validate->doValidate($_POST, $rules);

      if (!$cart = Content::getCart()) {
          Message::$msgs['cart'] = Lang::$word->STR_ERR;
      }
	  
	  if (empty(Message::$msgs)) {
		  $apikey = Db::run()->first(Admin::gTable, array("extra", "extra2", "extra3"), array("name" => "razorpay"));
		  $api = new Api($apikey->extra, $apikey->extra3);
		  
		  try {
			  $attributes = array(
				  'razorpay_order_id' => $cart->order_id,
				  'razorpay_payment_id' => $_POST['razorpay_payment_id'],
				  'razorpay_signature' => $_POST['razorpay_signature']
			  );
			  
			  $api->utility->verifyPaymentSignature($attributes);

              // insert payment record
			  $row = Db::run()->first(Content::mxTable, null, array("id" => $cart->membership_id));
              $data = array(
                  'txn_id' => $safe->razorpay_payment_id,
                  'membership_id' => $row->id,
                  'user_id' => App::Auth()->uid,
                  'amount' => $cart->total,
                  'coupon' => $cart->coupon,
				  'total' => $cart->totalprice,
				  'tax' => $cart->totaltax,
				  'currency' => $apikey->extra2,
                  'ip' => Url::getIP(),
                  'pp' => "RazorPay",
                  'status' => 1,
                  );
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
				  Lang::$word->MEMBERSHIP,
                  $row->title,
				  "---",
                  $data['total'],
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