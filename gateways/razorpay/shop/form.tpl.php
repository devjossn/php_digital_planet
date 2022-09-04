<?php
  /**
   * RazorPay Form
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: form.tpl.php, v3.00 2020-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');

  require BASEPATH . "/gateways/razorpay/lib/Razorpay.php";
  
  use Razorpay\Api\Api;
  $api = new Api($this->gateway->extra, $this->gateway->extra3);
  $displayCurrency = $this->gateway->extra2;

  $orderData = array(
	  'receipt' => md5(time()),
	  'amount' => round($this->cart->grand * 100, 0),
	  'currency' => $this->gateway->extra2,
	  'payment_capture' => 1 // auto capture
  );
  
  $razorpayOrder = $api->order->create($orderData);
  $razorpayOrderId = $razorpayOrder['id'];
  $displayAmount = $amount = $orderData['amount'];

  $data = array(
	  "key" => $this->gateway->extra,
	  "amount" => $amount,
	  "name" => $this->core->company . ' - ' . Lang::$word->CHECKOUT,
	  "description" => "",
	  "image" => UPLOADURL . '/' . App::Core()->logo,
	  "prefill" => array(
		  "name" => App::Auth()->name,
		  "email" => App::Auth()->email,
		  "contact" => "",
	  ),
	  "theme" => array(
		  "color" => "#667eea"
	  ),
	  "order_id" => $razorpayOrderId,
  );

  $json = json_encode($data);
  
  Db::run()->update(Product::cxTable, array("order_id" => $razorpayOrderId), array("user_id" => App::Auth()->sesid));
?>
<form name="razorpayform" action="<?php echo Url::url("/validate");?>" method="POST">
  <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
  <input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
  <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
  <input type="hidden" name="type" value="DDP">
</form>
<script type="text/javascript">
var options = <?php echo $json?>;
options.handler = function(response) {
    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
    document.getElementById('razorpay_signature').value = response.razorpay_signature;
    document.razorpayform.submit();
};

options.theme.image_padding = false;

options.modal = {
    ondismiss: function() {
        console.log("This code runs when the popup is closed");
    },
    escape: true,
    backdropclose: false
};

var rzp = new Razorpay(options);

document.getElementById('rzrpay').onclick = function(e){
    rzp.open();
    e.preventDefault();
}
</script>
<div class="center aligned">
  <a id="rzrpay" class="wojo card" style="width:200px;margin:1rem auto" title="Pay With RazorPay"><img src="<?php echo SITEURL;?>/gateways/razorpay/logo_large.png"></a>
</div>