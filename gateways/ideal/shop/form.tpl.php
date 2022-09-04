<?php
  /**
   * Ideal Form
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2016
   * @version $Id: form.tpl.php, v3.00 2016-06-20 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');

  include (BASEPATH . '/gateways/' . $this->gateway->dir . '/initialize.php');
  $mollie = new Mollie_API_Client;
  $mollie->setApiKey($this->gateway->extra);

  $order_id = "DDP_" . md5(time());
  $payment = $mollie->payments->create(array(
      "amount" => $this->cart->grand,
      "method" => Mollie_API_Object_Method::IDEAL,
      "description" => $this->core->company . ' - ' . Lang::$word->CHECKOUT,
      "redirectUrl" => Url::url("/validate", "?ideal=1&order_id=" . $order_id),
      "metadata" => array("order_id" => $order_id, "user_id" => App::Auth()->uid),
	  ));
	  
  Db::run()->update(Product::cxTable, array("cart_id" => $payment->id, "order_id" => $order_id), array("membership_id" => 0, "user_id" => App::Auth()->sesid));

?>
<div class="center aligned">
  <a class="wojo primary button" href="<?php echo $payment->getPaymentUrl();?>" title="Pay With Mollie"><img src="<?php echo SITEURL;?>/gateways/ideal/logo_large.png" style="width:200px"></a>
</div>
