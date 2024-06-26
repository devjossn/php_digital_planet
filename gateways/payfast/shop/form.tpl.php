<?php
  /**
   * PayFast Form
   *
   * @package Membership Manager Pro
   * @author wojoscripts.com
   * @copyright 2016
   * @version $Id: form.tpl.php, v1.00 2016-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php $url = ($this->gateway->live) ? 'www.payfast.co.za' : 'sandbox.payfast.co.za';?>
  <form action="https://<?php echo $url;?>/eng/process" class="center aligned" method="post" id="pf_form" name="pf_form">
    <input type="image" src="<?php echo SITEURL.'/gateways/payfast/logo_large.png';?>" style="width:200px;margin:1rem auto" class="wojo card" name="submit" title="Pay With PayFast" alt="" onclick="document.pf_form.submit();"/>
	<?php
      $html = '';
      $string = '';
      $array = array(
          'merchant_id' => $this->gateway->extra,
          'merchant_key' => $this->gateway->extra2,
          'return_url' => Url::url("/dashboard"),
          'cancel_url' => Url::url("/dashboard"),
          'notify_url' => SITEURL . '/gateways/' . $this->gateway->dir . '/shop/ipn.php',
		  'name_first' => Auth::$userdata->fname,
		  'name_last' => Auth::$userdata->lname,
          'email_address' => Auth::$userdata->email,
          'm_payment_id' => time(),
          'amount' => Utility::numberParse($this->cart->grand),
          'item_name' => $this->core->company . ' - ' . Lang::$word->CHECKOUT,
          'custom_int1' => Utility::encode(App::Auth()->uid . '_' . App::Auth()->sesid),
          );
      foreach ($array as $k => $v) {
          $html .= '<input type="hidden" name="' . $k . '" value="' . $v . '" />';
          $string .= $k . '=' . urlencode(trim($v)) . '&';
      }
      $string = substr($string, 0, -1);
      $sig = md5($string);
      $html .= '<input type="hidden" name="signature" value="' . $sig . '" />';
    
      print $html;
    ?>
  </form>