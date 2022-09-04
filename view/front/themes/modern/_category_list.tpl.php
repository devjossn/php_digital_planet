<?php
  /**
   * Category List
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _category_list.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
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
        <p class="wojo demi text"><?php echo Utility::renderPrice($row->is_sale, $row->price, $row->sprice, "negative");?></p>
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
          <?php if($row->memberships):?>
          <div class="item">
            <i class="icon membership"></i>
            <?php echo $row->memberships;?>
          </div>
          <?php endif;?>
        </div>
        <div>
          <a data-tooltip="<?php echo Lang::$word->WISHLIST;?>" data-layout="list" data-id="<?php echo $row->id?>" class="wojo simple white icon button wishlist">
          <i class="icon heart"></i></a>
          <a data-tooltip="<?php echo Lang::$word->COMPARE;?>" data-layout="list" data-id="<?php echo $row->id?>" class="wojo simple white icon button compare">
          <i class="icon collection"></i></a>
          <?php include(THEMEBASE . '/snippets/listButton.tpl.php');?>
        </div>
        <?php if($row->audio):?>
        <audio preload="auto" controls>
          <source src="<?php echo Product::hasAudio($row->audio, $row->id);?>">
        </audio>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>
<?php endforeach;?>