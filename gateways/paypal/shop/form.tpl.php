<?php
  /**
   * Paypal Form
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2017
   * @version $Id: form.tpl.php, v1.00 2017-03-20 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php $url = ($this->gateway->live) ? 'www.paypal.com' : 'www.sandbox.paypal.com';?>
<form action="https://<?php echo $url;?>/cgi-bin/webscr" method="post" id="pp_form" name="pp_form" class="content-center">
<input type="image" src="<?php echo SITEURL;?>/gateways/paypal/logo_large.png" style="width:200px" name="submit" class="wojo basic primary button" title="Pay With Paypal" alt="" onclick="this.form.submit();">
  <input type="hidden" name="cmd" value="_xclick" />
  <input type="hidden" name="amount" value="<?php echo $this->cart->grand;?>">
  <input type="hidden" name="business" value="<?php echo $this->gateway->extra;?>">
  <input type="hidden" name="item_name" value="<?php echo $this->core->company . ' - ' . Lang::$word->CHECKOUT;?>">
  <input type="hidden" name="custom" value="<?php echo Utility::encode(App::Auth()->uid . '_' . App::Auth()->sesid);?>">
  <input type="hidden" name="return" value="<?php echo Url::url("/dashboard");?>">
  <input type="hidden" name="rm" value="2" />
  <input type="hidden" name="notify_url" value="<?php echo SITEURL . '/gateways/'. $this->gateway->dir;?>/shop/ipn.php">
  <input type="hidden" name="cancel_return" value="<?php echo Url::url("/dashboard");?>">
  <input type="hidden" name="no_note" value="1" />
  <input type="hidden" name="currency_code" value="<?php echo ($this->gateway->extra2) ? $this->gateway->extra2 : $this->core->currency;?>">
</form>