<?php
  /**
   * Category Grid
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: categoryGrid.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row grid phone-1 mobile-2 tablet-3 screen-4 small gutters">
    dsfas
  <?php foreach($this->featured as $row):?>
  <div class="columns" id="item_<?php echo $row->id;?>">
    <div class="wojo attached card">
      <?php if($row->is_sale):?>
      <span class="wojo small dark top right attached label">-<?php echo Utility::salePercent($row->price, $row->sprice);?>%</span>
      <?php endif;?>
      <div class="content">
        <div class="center aligned margin bottom">
          <a href="<?php echo Url::url('/product', $row->slug);?>">
          <img src="<?php echo Product::hasThumb($row->thumb, $row->id);?>" alt="<?php echo $row->title;?>" class="wojo inline image"></a>
        </div>
        <h5 class="truncate">
          <a href="<?php echo Url::url('/product', $row->slug);?>" class="dark"><?php echo $row->title?></a>
        </h5>
        <div class="wojo small icon text">
          <?php echo $row->memberships ? '<i class="icon membership"></i>' . $row->memberships : '<i class="icon minus alt"></i>' . Lang::$word->MEMBERSHIP . ':  ' . Lang::$word->NONE;?></div>
        <p class="wojo bold primary text"><?php echo Utility::renderPrice($row->is_sale, $row->price, $row->sprice, "dark");?></p>
        <div class="center aligned">
          <div class="wojo small divided horizontal list">
            <div class="item">
              <i class="icon positive star"></i>
              <?php echo $row->likes;?>
            </div>
            <div class="item">
              <i class="icon secondary comments"></i>
              <?php echo $row->comments;?>
            </div>
            <div class="item">
              <?php echo Date::doDate("short_date", $row->created);?>
            </div>
          </div>
        </div>
        <div class="center aligned">
          <?php include(THEMEBASE . '/snippets/gridButton.tpl.php');?>
          <a data-tooltip="<?php echo Lang::$word->WISHLIST;?>" data-layout="grid" data-id="<?php echo $row->id;?>" class="wishlist wojo simple white icon button"><i class="icon heart"></i></a>
          <a data-tooltip="<?php echo Lang::$word->COMPARE;?>" data-layout="grid" data-id="<?php echo $row->id;?>" class="compare wojo simple white icon button"><i class="icon collection"></i></a>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>