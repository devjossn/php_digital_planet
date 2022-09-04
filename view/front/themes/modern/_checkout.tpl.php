<?php
  /**
   * Checkout
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _checkout.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($this->gateways):?>
<div class="wojo very relaxed celled fluid list" id="dGateways">
  <?php foreach($this->gateways as $grow):?>
  <div class="item align middle">
    <div class="content">
      <div class="wojo checkbox radio fitted">
        <input name="gateway" type="radio" value="<?php echo $grow->id;?>" id="gate_<?php echo $grow->id;?>">
        <label for="gate_<?php echo $grow->id;?>"><?php echo $grow->displayname;?></label>
      </div>
    </div>
    <div class="content auto"><div class="wojo attached card" id="card_<?php echo $grow->id;?>"><img src="<?php echo SITEURL;?>/gateways/<?php echo $grow->dir;?>/logo_large.png" alt="" class="wojo small basic rounded image"></div></div>
  </div>
  <?php endforeach;?>
</div>
<div id="dCheckout"></div>
<?php endif;?>