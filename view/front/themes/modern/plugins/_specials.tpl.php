<?php
  /**
   * Product Specials
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _specials.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="padding top">
  <div class="row grid phone-1 mobile-2 tablet-3 screen-4 small gutters">
    <?php if(in_array("product", $this->segments)):?>
    <div class="columns tablet-hide mobile-hide phone-hide" id="special4"></div>
    <?php endif;?>
    <?php foreach($this->special as $row):?>
    <div class="columns" id="item_<?php echo $row->id;?>">
      <div class="wojo attached segment related-product-content">
        <?php if($row->is_sale):?>
        <span class="wojo tiny dark top right attached label">-<?php echo Utility::salePercent($row->price, $row->sprice);?>%</span>
        <?php endif;?>
        <div class="center aligned grid-text-content">
          <a href="<?php echo Url::url('/product', $row->slug);?>" class="thumbnail-link"><img src="<?php echo Product::hasThumb($row->thumb, $row->id);?>" alt="<?php echo $row->title;?>" class="wojo inline image"></a>
        </div>
        <h4 class="truncate"><a href="<?php echo Url::url('/product', $row->slug);?>" class="dark"><?php echo $row->title;?></a>
        </h4>
        <p><?php echo Lang::$word->IN;?>
          <a href="<?php echo Url::url('/category', $row->cslug);?>"><?php echo $row->name;?></a>
        </p>
        <p class="wojo bold text">
          <?php echo Utility::renderPrice($row->is_sale, $row->price, $row->sprice, "negative");?></p>
        <div class="center aligned">
          <?php include(THEMEBASE . '/snippets/gridButton.tpl.php');?>
          <a data-tooltip="<?php echo Lang::$word->WISHLIST;?>" data-layout="grid" data-id="<?php echo $row->id;?>" class="wishlist simple wojo white icon button">
          <i class="icon heart"></i></a>
          <a data-tooltip="<?php echo Lang::$word->COMPARE;?>" data-layout="grid" data-id="<?php echo $row->id;?>" class="compare simple wojo white icon button">
          <i class="icon files"></i></a>
        </div>
      </div>
    </div>
    <?php endforeach;?>
  </div>
</div>