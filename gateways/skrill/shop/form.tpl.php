<?php
  /**
   * Skrill Form
   *
   * @package Membership Manager Pro
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: form.tpl.php, v3.00 2020-03-20 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<form action="https://www.skrill.com/app/payment.pl" method="post" id="mb_form" name="mb_form" class="center aligned">
<input type="image" src="<?php echo SITEURL;?>/gateways/skrill/logo_large.png" style="width:200px;margin:1rem auto" name="submit" class="wojo card" title="Pay With Skrill" alt="" onclick="this.form.submit();">
  <input type="hidden" name="pay_to_email" value="<?php echo $this->gateway->extra;?>">
  <input type="hidden" name="return_url" value="<?php echo Url::url("/dashboard");?>">
  <input type="hidden" name="cancel_url" value="<?php echo Url::url("/dashboard");?>">
  <input type="hidden" name="status_url" value="<?php echo SITEURL.'/gateways/' . $this->gateway->dir;?>/shop/ipn.php" />
  <input type="hidden" name="merchant_fields" value="session_id, item, custom" />
  <input type="hidden" name="item" value="<?php echo time();?>" />
  <input type="hidden" name="session_id" value="<?php echo md5(time())?>" />
  <input type="hidden" name="custom" value="<?php echo Utility::encode(App::Auth()->uid . '_' . App::Auth()->sesid);?>" />
  <input type="hidden" name="amount" value="<?php echo Utility::numberParse($this->cart->grand);?>" />
  <input type="hidden" name="currency" value="<?php echo ($this->gateway->extra2) ? $this->gateway->extra2 : App::Core()->currency;?>" />
  <input type="hidden" name="detail1_description" value="<?php echo $this->core->company . ' - ' . Lang::$word->CHECKOUT;?>" />
</form>