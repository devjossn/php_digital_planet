<?php
  /**
   * Product
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: product.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row big gutters">
  <div class="columns screen-60 tablet-60 mobile-100 phone-100">
    <h4 class="basic">
      <a href="<?php echo Url::url('/category', $this->row->cslug);?>"><?php echo $this->row->name;?></a>
    </h4>
    <h2 class="title"><?php echo $this->row->title;?></h2>
    <?php include(THEMEBASE . '/snippets/ratingStars.tpl.php');?>
    <p class="wojo large bold text"><?php echo Utility::renderPrice($this->row->is_sale, $this->row->price, $this->row->sprice, "negative");?></p>
    <?php echo Validator::sanitize($this->row->body, "string", 300)?>
    <div class="padding top">
      <div class="row gutters align middle">
        <div class="columns auto">
          <div class="wojo action input number">
            <input type="text" value="1" data-rule="quantity">
            <div class="buttons">
              <button class="wojo small icon simple button" type="button" data-spin="up"><i class="icon triangle up"></i></button>
              <button class="wojo small icon simple button" type="button" data-spin="down"><i class="icon triangle down"></i></button>
            </div>
          </div>
        </div>
        <div class="columns">
          <?php include(THEMEBASE . '/snippets/productButton.tpl.php');?>
        </div>
        <div class="columns auto phone-100 center aligned">
          <a data-tooltip="<?php echo Lang::$word->WISHLIST;?>" data-id="<?php echo $this->row->id?>" class="wishlist wojo icon small primary circular button"><i class="icon heart"></i></a>
          <a data-tooltip="<?php echo Lang::$word->COMPARE;?>" data-id="<?php echo $this->row->id?>" class="compare wojo icon small circular primary button"><i class="icon collection"></i></a>
        </div>
      </div>
    </div>
    <div class="share">
      <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo Url::url(Router::$path);?>" class="wojo small icon primary button" target="_blank"><i class="icon facebook"></i></a>
      <a href="https://twitter.com/home?status=<?php echo Url::url(Router::$path);?>" class="wojo small icon primary button" target="_blank"><i class="icon twitter"></i></a>
      <a href="https://pinterest.com/pin/create/button/?url=<?php echo Url::url(Router::$path);?>" class="wojo small icon primary button" target="_blank"><i class="icon pinterest"></i></a>
    </div>
  </div>
  <div class="columns screen-40 tablet-40 mobile-100 phone-100">
    <div class="wojo basic attached segment center aligned">
      <a class="lightbox" data-gall="gallery01" href="<?php echo Product::hasImage($this->row->thumb, $this->row->id);?>">
      <img id="mainimg" src="<?php echo Product::hasThumb($this->row->thumb, $this->row->id);?>" alt="<?php echo $this->row->title;?>"></a>
    </div>
    <!-- Image Gallery-->
    <?php if($this->images):?>
    <nav id="imageswitch" class="wojo images align center">
      <a href="<?php echo Product::hasImage($this->row->thumb, $this->row->id);?>" class="wojo small image">
      <img src="<?php echo Product::hasThumb($this->row->thumb, $this->row->id);?>" alt=""></a>
      <?php foreach($this->images as $img):?>
      <a href="<?php echo Product::hasImage($img->name, $this->row->id);?>" class="wojo small image">
      <img src="<?php echo Product::hasThumb($img->name, $this->row->id);?>" alt=""></a>
      <?php endforeach;?>
    </nav>
    <?php endif;?>
    <!-- Product Audio-->
    <?php if($this->row->audio):?>
    <audio preload="auto" controls>
      <source src="<?php echo Product::hasAudio($this->row->audio, $this->row->id);?>">
    </audio>
    <?php endif;?>
  </div>
</div>
<div class="wojo fluid relaxed tabs">
  <ul class="nav" id="pMore">
    <li class="active">
      <a data-tab="desc"><i class="icon news"></i><?php echo Lang::$word->DESCRIPTION;?></a>
    </li>
    <?php if($this->row->pbody and $this->row->membership_id and Content::is_valid($this->row->membership_id)):?>
    <li>
      <a data-tab="vip"><i class="icon membership"></i><?php echo Lang::$word->VIP;?></a>
    </li>
    <?php endif;?>
    <li>
      <a data-tab="info"><i class="icon info sign"></i><?php echo Lang::$word->FRONT_ADINFO;?></a>
    </li>
    <?php if($this->core->enable_comments):?>
    <li>
      <a data-tab="reviews"><i class="icon comment"></i><?php echo Lang::$word->REVIEWS;?> (<span class="rcounter"><?php echo $this->row->comments;?></span>)</a>
    </li>
    <?php endif;?>
  </ul>
  <div class="wojo segment tab">
    <div data-tab="desc" class="item">
      <h4><?php echo Lang::$word->DESCRIPTION;?></h4>
      <?php echo Validator::CleanOut($this->row->body)?>
    </div>
    <?php if($this->row->pbody and $this->row->membership_id and Content::is_valid($this->row->membership_id)):?>
     <div data-tab="vip" class="item">
      <h4><?php echo Lang::$word->VIP;?></h4>
      <?php echo Validator::CleanOut($this->row->pbody)?>
    </div>
    <?php endif;?>
    <div data-tab="info" class="item">
      <h4><?php echo Lang::$word->FRONT_ADINFO;?></h4>
      <div class="row gutters align middle">
        <div class="columns screen-50 tablet-40 moble-100 phone-100">
          <div class="wojo relaxed fluid list">
            <?php echo $this->custom_fields;?>
          </div>
        </div>
        <?php if($this->row->youtube):?>
        <div class="columns screen-50 tablet-60 moble-100 phone-100">
          <div id="ytube" class="wojo basic attached segment">
            <a href="<?php echo $this->row->youtube;?>">
            </a>
          </div>
        </div>
        <?php endif;?>
      </div>
    </div>
    <?php if($this->core->enable_comments):?>
    <div data-tab="reviews" class="item">
      <h4><span class="rcounter"><?php echo $this->row->comments;?></span>
        <?php echo Lang::$word->REVIEWS . ' ' . strtolower(Lang::$word->FOR) . ' ' . $this->row->title;?></h4>
      <?php include_once(PLUGINBASE . "/comments/index.tpl.php");?>
    </div>
    <?php endif;?>
  </div>
</div>
<?php if($this->special):?>
<?php include_once(PLUGINBASE . "/_specials.tpl.php");?>
<?php endif;?>