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
<?php if(!$this->data):?>
<div class="item align middle">
  <div class="content">
    <p class="wojo semi text center aligned"><?php echo Lang::$word->FRONT_CART_EMPTY;?></p>
  </div>
</div>
<?php else:?>
<?php $total = 0;?>
<?php foreach($this->data as $xrow):?>
<?php $total += ($xrow->total * $xrow->items);?>
<div class="item align middle">
  <img class="wojo small basic image" src="<?php echo Product::hasThumb($xrow->thumb, $xrow->pid);?>" alt="">
  <div class="content">
    <div class="header truncate"><a href="<?php echo Url::url('/product', $xrow->slug);?>"><?php echo $xrow->title;?></a>
    </div>
    <div class="wojo semi small text"><?php echo $xrow->items;?> x <?php echo Utility::formatMoney($xrow->total);?></div>
  </div>
</div>
<?php endforeach;?>
<div class="item align middle">
  <div class="content center aligned">
    <div class="wojo left labeled fluid simple button">
      <span class="wojo simple right pointing label">
      <?php echo Utility::formatMoney($total);?>
      <small>
      <?php if(App::Core()->enable_tax) echo '+ ' . Lang::$word->TAX;?>
      </small>
      </span>
      <a href="<?php echo Url::url('/cart');?>" class="wojo primary fluid button">
        <?php echo Lang::$word->FRONT_VIEW_CART;?>
      </a>
    </div>
  </div>
</div>
<?php endif;?>