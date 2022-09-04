<?php
  /**
   * Cart
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: cart.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if(!$this->data): ?>
<div class="center aligned margin bottom">
  <p class="wojo small thick caps text"><?php echo Lang::$word->FRONT_CART_EMPTY1;?></p>
  <p class="wojo small bold text"><a href="<?php echo SITEURL;?>/"><?php echo Lang::$word->FRONT_CONTINUE;?> ...</a>
  </p>
</div>
<img src="<?php echo THEMEURL;?>/images/banner.jpg" alt="" class="wojo shadow">
<?php if($this->special):?>
<?php include_once(PLUGINBASE . "/_specials.tpl.php");?>
<?php endif;?>
<?php else:?>
<div class="wojo segment">
  <table class="wojo basic table" id="bigCart">
    <thead>
      <tr>
        <th></th>
        <th><?php echo Lang::$word->PRD_PRODUCT;?></th>
        <th><?php echo Lang::$word->PRD_PRICE;?></th>
        <th class="center aligned"><?php echo Lang::$word->QUANTITY;?></th>
        <th><?php echo Lang::$word->TOTAL;?></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($this->data as $row):?>
      <tr id="item_<?php echo $row->pid?>">
        <td class="auto"><img src="<?php echo Product::hasThumb($row->thumb, $row->pid);?>" alt="<?php echo $row->title?>" class="wojo basic normal image"></td>
        <td><h4><a href="<?php echo Url::url('/product', $row->slug);?>"><?php echo $row->title?></a>
          </h4></td>
        <td><?php echo Utility::formatMoney($row->total);?></td>
        <td class="center aligned"><?php echo $row->items;?></td>
        <td><span class="wojo bold text"><?php echo Utility::formatMoney($row->items * $row->total);?></span></td>
        <td><a data-id="<?php echo $row->pid;?>" class="deleteItem"><i class="icon negative trash"></i></a></td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
</div>
<div class="margin bottom">
  <div class="wojo small action input">
    <input placeholder="<?php echo Lang::$word->DC_CODE;?>" type="text" name="coupon">
    <button type="button" name="discount" class="wojo primary small button">
    <?php echo Lang::$word->APPLY;?>
    </button>
  </div>
</div>
<h4 class="right aligned"><?php echo Lang::$word->FRONT_CART_TOTALS;?></h4>
<table class="wojo basic table">
  <tbody>
    <tr>
      <td class="right aligned wojo bold text"><?php echo Lang::$word->TRX_SUBTOTAL;?></td>
      <td class="right aligned" id="subtotal"><?php echo Utility::formatNumber($this->totals->subtotal);?></td>
    </tr>
    <tr>
      <td class="right aligned wojo bold text"><?php echo Lang::$word->DC_DISC;?></td>
      <td class="right aligned" id="discount"><i class="icon minus positive alt"></i>
        <?php echo Utility::formatNumber($this->totals->discount);?></td>
    </tr>
    <?php if($this->core->enable_tax):?>
    <tr>
      <td class="right aligned wojo bold text"><?php echo Lang::$word->TAX;?></td>
      <td class="right aligned" id="tax"><i class="icon plus negative alt"></i>
        <?php echo Utility::formatNumber(($this->totals->subtotal - $this->totals->discount) * $this->tax);?></td>
    </tr>
    <?php endif;?>
    <tr class="highlite">
      <td class="right aligned wojo bold text"><?php echo Lang::$word->TOTAL;?></td>
      <td class="right aligned wojo bold text" id="total"><?php echo Utility::formatMoney(($this->totals->tax > 0) ? $this->totals->grand : $this->tax * $this->totals->grand + $this->totals->grand);?></td>
    </tr>
  </tbody>
</table>
<?php if(App::Auth()->is_User()):?>
<?php include(THEMEBASE . '/_checkout.tpl.php');?>
<?php else:?>
<p class="padding top">
  <i class="icon info sign"></i>
  <?php echo str_replace(array("[LOGIN]", "[REGISTER]"), array(' <a href="' . Url::url('/login') . '" class="wojo bold text">' . strtolower(Lang::$word->LOGIN) . '</a>', '<a href="' . Url::url('/register') . '" class="wojo bold text">' . strtolower(Lang::$word->REGISTER) . '</a>'), Lang::$word->FRONT_CART_ERROR2);?></p>
<?php endif;?>
<?php endif;?>