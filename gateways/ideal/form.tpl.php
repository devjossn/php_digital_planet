<?php
  /**
   * Ideal Form
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: form.tpl.php, v3.00 2020-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');

  include "initialize.php";
  $mollie = new Mollie_API_Client;
  $mollie->setApiKey($this->gateway->extra);
  
  $order_id = "MEM_" . md5(time());
  $payment = $mollie->payments->create(array(
      "amount" => $this->cart->totalprice,
      "method" => Mollie_API_Object_Method::IDEAL,
      "description" => $this->row->title,
      "redirectUrl" => Url::url("/validate", "?ideal=1&order_id=" . $order_id),
      "metadata" => array("order_id" => $order_id, "user_id" => App::Auth()->uid),
	  ));
	  
  Db::run()->update(Product::cxTable, array("cart_id" => $payment->id, "order_id" => $order_id), array("user_id" => App::Auth()->uid));
?>
<div class="center aligned">
  <a class="wojo primary button" href="<?php echo $payment->getPaymentUrl();?>" title="Pay With Mollie"><img src="<?php echo SITEURL;?>/gateways/ideal/logo_large.png" style="width:200px"></a>
</div>