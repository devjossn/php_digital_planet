<?php
  /**
   * Payment Validation
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _validate.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<!-- Razorpay -->
<?php if(Validator::post('razorpay_payment_id')):?>
<div class="wojo loading segment">
  <h4 class="center aligned"><?php echo Lang::$word->STR_POK1;?></h4>
</div>
<?php endif;?>
<?php if($type = Validator::post('type')):?>
<?php
  switch ($type) {
      case "DDP":
          $url = "/gateways/razorpay/shop/ipn.php";
		  $link = "";
          break;

      default:
          $url = "/gateways/razorpay/ipn.php";
		  $link = "memberships";
          break;
  }
?>
<script type="text/javascript"> 
// <![CDATA[  
$(document).ready(function() {
    $.ajax({
        type: 'POST',
        url: "<?php echo SITEURL . $url;?>",
        dataType: 'json',
        data: {
            "razorpay_payment_id": "<?php echo Validator::post('razorpay_payment_id');?>",
			"razorpay_signature": "<?php echo Validator::post('razorpay_signature');?>",
        }
    }).done(function(json) {
        if (json.type === "success") {
			$('main').transition("scaleOut", {
				duration: 4000,
				complete: function() {
					window.location.href = '<?php echo Url::url('/dashboard', $link);?>';
				}
			});
        }
		$.wNotice(decodeURIComponent(json.message), {
			autoclose: 12000,
			type: json.type,
			title: json.title
		});
    });
});
// ]]>
</script>
<?php endif;?>

<!-- iDeal -->
<?php if(Validator::get('order_id')):?>
<div class="wojo loading segment">
  <h4 class="center aligned"><?php echo Lang::$word->STR_POK1;?></h4>
</div>
<?php endif;?>
<?php if($type = Validator::get('order_id')):?>
<?php
  switch (substr($type, 0, 3)) {
      case "DDP":
          $url = "/gateways/ideal/shop/ipn.php";
		  $link = "";
          break;

      default:
          $url = "/gateways/ideal/ipn.php";
		  $link = "memberships";
          break;
  }
?>
<script type="text/javascript"> 
// <![CDATA[  
$(document).ready(function() {
    $.ajax({
        type: 'GET',
        url: "<?php echo SITEURL . $url;?>",
        dataType: 'json',
        data: {
            "order_id": "<?php echo Validator::sanitize(Validator::get('order_id'), "db");?>"
        }
    }).done(function(json) {
        if (json.type === "success") {
			$('main').transition("scaleOut", {
				duration: 4000,
				complete: function() {
					window.location.href = '<?php echo Url::url('/dashboard', $link);?>';
				}
			});
        }
		$.wNotice(decodeURIComponent(json.message), {
			autoclose: 12000,
			type: json.type,
			title: json.title
		});
    });
});
// ]]>
</script>
<?php endif;?>