<?php
  /**
   * PayPal IPN
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: ipn.php, v1.00 2020-04-08 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once ("../../../init.php");

  ini_set('log_errors', true);
  ini_set('error_log', dirname(__file__) . '/ipn_errors.log');

  if (isset($_POST['payment_status'])) {
	  
      require_once (BASEPATH . '/gateways/paypal/paypal.class.php');
      $pp = Db::run()->first(Admin::gTable, array("live", "extra"), array("name" => "paypal"));

      $listener = new IpnListener();
      $listener->use_live = $pp->live;
      $listener->use_ssl = false;
      $listener->use_curl = true;

      try {
          $listener->requirePostMethod();
          $ppver = $listener->processIpn();
      }
      catch (exception $e) {
          error_log('Process IPN failed: ' . $e->getMessage() . " [" . $_SERVER['REMOTE_ADDR'] . "] \n" . $listener->getResponse(), 3, "pp_errorlog.log");
          exit;
      }

      $payment_status = $_POST['payment_status'];
      $receiver_email = $_POST['receiver_email'];
      $mc_currency = Validator::sanitize($_POST['mc_currency'], "string", 4);
      $custom = Utility::decode($_POST['custom']);
      list($user_id, $sesid) = explode("_", $custom);
      $mc_gross = $_POST['mc_gross'];
      $sesid = Validator::sanitize($sesid);
      $txn_id = Validator::sanitize($_POST['txn_id']);

      if ($ppver) {
          if ($_POST['payment_status'] == 'Completed') {
              $user = Db::run()->first(Users::mTable, null, array("id" => intval($user_id)));
              $cart = Product::getCartContentIpn($sesid);
              $totals = Product::getCartTotal($sesid);
              $tax = Content::calculateTax();
              $amount = Utility::numberParse((($totals->tax > 0) ? $totals->grand : $tax * $totals->grand + $totals->grand));
			  $items = array();
			  $cdkey = array();
			  $v1 = Validator::compareNumbers($mc_gross, $totals->grand, "=");
		  
              if ($cart and $receiver_email == strtolower($pp->extra) and $v1) {
                  foreach ($cart as $k => $item) {
					  $key = Db::run()->getValue(Product::cdTable, "cdkey", "product_id", $item->id);
                      $data = array(
                          'user_id' => $user->id,
                          'product_id' => $item->id,
                          'txn_id' => $txn_id,
                          'tax' => Utility::numberParse($item->total * $tax),
                          'amount' => Utility::numberParse($item->total),
                          'total' => Utility::numberParse($tax * $item->total + $item->total),
                          'coupon' => $item->coupon,
                          'cdkey' => ($key) ? $key : "",
                          'pp' => "PayPal",
                          'ip' => Url::getIP(),
                          'file_date' => time(),
                          'currency' => strtoupper($mc_currency),
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
                      'tax' => Utility::numberParse(($totals->subtotal - $totals->discount) * $tax),
                      'subtotal' => $totals->subtotal,
                      'grand' => $amount,
                      'currency' => strtoupper($mc_currency),
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
                      $user->fname . ' ' . $user->lname,
                      Lang::$word->PRD_PRODUCT,
                      implode(", ", array_column($cart, "title")),
                      $amount,
                      "Completed",
                      "PayPal",
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
                      $user->fname . ' ' . $user->lname,
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
                            ->setTo(array($user->email => $user->fname . ' ' . $user->lname))
                            ->setFrom(array($core->site_email => $core->company))
                            ->setBody($ubody, 'text/html');
                  $umailer->send($umessage);
				  
                  // empty cart
                  Db::run()->delete(Product::cxTable, array("user_id" => $sesid));
              }
          } else {
              /* == Failed Transaction= = */
          }
      }
  }