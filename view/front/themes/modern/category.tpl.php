<?php
  /**
   * Category
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: category.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($this->special):?>
<div class="wojo cards screen-2 tablet-2 mobile-1">
  <div class="card" id="special3">
    <?php if(isset($this->special[0])):?>
    <div class="content">
      <div class="row horizontal gutters">
        <div class="columns screen-40 mobile-100 phone-100 center aligned">
          <img src="<?php echo Product::hasThumb($this->special[0]->thumb, $this->special[0]->id);?>" alt="<?php echo $this->special[0]->title?>" class="wojo large inline image"></div>
        <div class="columns mobile-100 phone-100">
          <div class="padding">
            <p><span class="wojo transparent label"><?php echo Utility::renderPrice($this->special[0]->is_sale, $this->special[0]->price, $this->special[0]->sprice);?></span></p>
            <h3 class="wojo truncate"><?php echo $this->special[0]->title?></h3>
            <p class="wojo small dimmed text"><?php echo Validator::sanitize($this->special[0]->body, "string", 80)?></p>
            <p class="margin-top"><a href="<?php echo Url::url('/product', $this->special[0]->slug);?>" class="wojo small transparent button"><?php echo Lang::$word->MOREINFO;?></a>
            </p>
          </div>
        </div>
      </div>
    </div>
    <?php endif;?>
  </div>
  <div class="card" id="special2">
    <?php if(isset($this->special[1])):?>
    <div class="content">
      <div class="row horizontal gutters">
        <div class="columns screen-40 mobile-100 phone-100 center aligned">
          <img src="<?php echo Product::hasThumb($this->special[1]->thumb, $this->special[1]->id);?>" alt="<?php echo $this->special[1]->title?>" class="wojo large inline image"></div>
        <div class="columns mobile-100 phone-100">
          <div class="padding">
            <p><span class="wojo transparent label"><?php echo Utility::renderPrice($this->special[1]->is_sale, $this->special[1]->price, $this->special[1]->sprice);?></span></p>
            <h3 class="wojo truncate"><?php echo $this->special[1]->title?></h3>
            <p class="wojo small dimmed text"><?php echo Validator::sanitize($this->special[1]->body, "string", 80)?></p>
            <p class="margin-top"><a href="<?php echo Url::url('/product', $this->special[1]->slug);?>" class="wojo small transparent button"><?php echo Lang::$word->MOREINFO;?></a>
            </p>
          </div>
        </div>
      </div>
    </div>
    <?php endif;?>
  </div>
</div>
<?php endif;?>
<div class="row align middle gutters phone-hide" id="filter">
  <div class="columns auto">
    <div class="items"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?></div>
  </div>
  <div class="columns phone-100">
    <div class="items center aligned">
      <div class="wojo divided horizontal list">
        <div class="disabled item wojo bold text">
          <?php echo Lang::$word->SORTING_O;?>
        </div>
        <a href="<?php echo Url::url(Router::$path);?>" class="item<?php echo Url::setActive("order", false);?>">
          <?php echo Lang::$word->RESET;?>
        </a>
        <a href="<?php echo Url::url(Router::$path, Url::buildUrl("order","title|DESC"));?>" class="item<?php echo Url::setActive("order", "title");?>">
          <?php echo Lang::$word->NAME;?>
        </a>
        <a href="<?php echo Url::url(Router::$path, Url::buildUrl("order","price|DESC"));?>" class="item<?php echo Url::setActive("order", "price");?>">
          <?php echo Lang::$word->PRD_PRICE;?>
        </a>
        <a href="<?php echo Url::url(Router::$path, Url::buildUrl("order","likes|DESC"));?>" class="item<?php echo Url::setActive("order", "likes");?>">
          <?php echo Lang::$word->LIKES;?>
        </a>
        <div class="item">
          <a href="<?php echo Url::sortItems(Url::url(Router::$path), "order");?>" data-tooltip="ASC/DESC"><i class="icon triangle unfold more link"></i></a>
        </div>
      </div>
    </div>
  </div>
  <div class="columns auto">
    <a <?php if(Validator::isGetSet("mode", "list")) echo 'href="' . Url::url(Router::$path, Url::buildUrl("mode","grid")) . '"';?> class="wojo simple icon button<?php if(!Validator::isGetSet("mode", "list")) echo ' primary';?>"><i class="icon apps"></i></a>
    <a <?php if(!Validator::isGetSet("mode", "list")) echo 'href="' . Url::url(Router::$path, Url::buildUrl("mode","list")) . '"';?> class="wojo simple icon button<?php if(Validator::isGetSet("mode", "list")) echo ' primary';?>"><i class="icon unordered list"></i></a>
  </div>
</div>
<?php if($this->featured):?>
<?php if(Validator::isGetSet("mode", "list")):?>
<?php include(THEMEBASE . '/_category_list.tpl.php');?>
<?php else:?>
<?php include(THEMEBASE . '/_category_grid.tpl.php');?>
<?php endif;?>
<?php if ($this->pager->items_total > $this->pager->items_per_page):?>
<div class="center aligned full padding"><?php echo $this->pager->display_pages();?></div>
<?php endif;?>
<?php endif;?>