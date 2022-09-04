<?php
  /**
   * View Compare
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: viewCompare.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php $bfluid = true;?>
<h1><?php echo Lang::$word->FRONT_COMPARE;?></h1>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small thick caps text"><?php echo Lang::$word->FRONT_COMPARE_EMPTY;?></p>
</div>
<?php else:?>
<div class="row grid phone-1 mobile-2 tablet-3 screen-5 small gutters">
  <?php foreach($this->data as $i=> $row):?>
  <?php $i++;?>
  <div class="columns" id="compare_<?php echo $row->id?>">
    <div class="wojo card">
      <div class="header center aligned">
        <a href="<?php echo Url::url('/product', $row->slug);?>"><img src="<?php echo Product::hasThumb($row->thumb, $row->id);?>" alt="<?php echo $row->title?>" class="wojo basic image"></a>
        <h4 class="truncate"><a href="<?php echo Url::url('/product', $row->slug);?>" class="inverted"><?php echo $row->title?></a>
        </h4>
      </div>
      <div class="content">
        <div class="wojo large text"><?php echo Utility::renderPrice($row->is_sale, $row->price, $row->sprice, "negative");?></div>
        <?php include(THEMEBASE . '/snippets/listButton.tpl.php');?>
      </div>
      <div class="footer divided">
        <?php echo Validator::sanitize($row->body, "string", 100)?>
        <div class="center aligned">
          <a data-set='{"option":[{"iaction": "removeCompare", "id":<?php echo $row->id?>}], "url":"/controller.php", "complete":"remove", "parent":"#compare_<?php echo $row->id?>"}' class="iaction"><i class="icon negative circular delete link"></i></a>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>