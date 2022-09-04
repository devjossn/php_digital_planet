<?php
  /**
   * Home Grid
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: homeGrid.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($this->featured):?>
<div class="wojo cards screen-3 tablet-3 mobile-1">
  <?php foreach($this->featured as $row):?>
  <div class="card" id="item_<?php echo $row->id;?>">
    <?php if($row->is_sale):?>
    <span class="wojo tiny dark top right attached label">-<?php echo Utility::salePercent($row->price, $row->sprice);?>%</span>
    <?php endif;?>
    <div class="content">
      <div class="center aligned grid-text-content"><a href="<?php echo Url::url('/product', $row->slug);?>" class="thumbnail-link"><img src="<?php echo Product::hasThumb($row->thumb, $row->id);?>" alt="<?php echo $row->title;?>" class="wojo medium inline image"></a>
        <h5 class="truncate"><a href="<?php echo Url::url('/product', $row->slug);?>" class="grey"><?php echo $row->title;?></a>
        </h5>
        <p><?php echo Lang::$word->IN;?>
          <a href="<?php echo Url::url('/category', $row->cslug);?>"><?php echo $row->name;?></a>
        </p>
      </div>
      <div class="center aligned">
        <p class="wojo demi text"><?php echo Utility::renderPrice($row->is_sale, $row->price, $row->sprice, "negative");?></p>
        <?php include(THEMEBASE . '/snippets/gridButton.tpl.php');?>
        <a data-tooltip="<?php echo Lang::$word->WISHLIST;?>" data-layout="grid" data-id="<?php echo $row->id;?>" class="wishlist wojo simple white icon button"><i class="icon heart"></i></a>
        <a data-tooltip="<?php echo Lang::$word->COMPARE;?>" data-layout="grid" data-id="<?php echo $row->id;?>" class="compare wojo simple white icon button"><i class="icon collection"></i></a>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>