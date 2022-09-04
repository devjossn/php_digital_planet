<?php
  /**
   * Home List
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: homeList.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($this->featured):?>
<?php foreach($this->featured as $row):?>
<div class="wojo card" id="item_<?php echo $row->id;?>">
  <?php if($row->is_sale):?>
  <span class="wojo tiny dark top right attached label">-<?php echo Utility::salePercent($row->price, $row->sprice);?>%</span>
  <?php endif;?>
  <div class="header">
    <div class="row horizontal gutters align top">
      <div class="columns auto phone-100 center aligned">
        <a href="<?php echo Url::url('/product', $row->slug);?>"><img src="<?php echo Product::hasThumb($row->thumb, $row->id);?>" alt="<?php echo $row->title?>" class="wojo normal inline image"></a>
      </div>
      <div class="columns phone-100">
        <h4 class="basic">
          <a href="<?php echo Url::url('/product', $row->slug);?>" class="grey"><?php echo $row->title?></a>
        </h4>
        <p cass="basic">
          <?php echo Lang::$word->IN;?>
          <a href="<?php echo Url::url('/category', $row->cslug);?>" class="wojo small text"><?php echo $row->name?></a>
        </p>
        <p class="wojo demi text"><?php echo Utility::renderPrice($row->is_sale, $row->price, $row->sprice, "negative");?></p>
        <a data-tooltip="<?php echo Lang::$word->WISHLIST;?>" data-layout="list" data-id="<?php echo $row->id?>" class="wojo simple white icon button wishlist">
        <i class="icon heart"></i></a>
        <a data-tooltip="<?php echo Lang::$word->COMPARE;?>" data-layout="list" data-id="<?php echo $row->id?>" class="wojo simple white icon button compare">
        <i class="icon collection"></i></a>
        <?php include(THEMEBASE . '/snippets/listButton.tpl.php');?>
      </div>
    </div>
  </div>
</div>
<?php endforeach;?>
<?php endif;?>