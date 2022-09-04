<?php
  /**
   * Index
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>

<?php if($this->special):?>
<div class="wojo cards screen-2 tablet-2 mobile-1">
  <div class="card" id="special1">
    <?php if(isset($this->special[0])):?>
    <div class="content">
      <div class="row horizontal gutters">
        <div class="columns screen-40 mobile-100 phone-100 center aligned first-banner-img">
          <img src="<?php echo Product::hasThumb($this->special[0]->thumb, $this->special[0]->id);?>" alt="<?php echo $this->special[0]->title?>" class="wojo large inline image"></div>
        <div class="columns mobile-100 phone-100">
          <div class="padding">
            <p><span class="wojo transparent label"><?php echo Utility::renderPrice($this->special[0]->is_sale, $this->special[0]->price, $this->special[0]->sprice);?></span></p>
            <h3 class="wojo "><?php echo $this->special[0]->title; ?></h3>
            <p class="wojo small dimmed text"><?php  echo Validator::sanitize($this->special[0]->body, "string", 80); ?></p>
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
        <div class="columns screen-40 mobile-100 phone-100 center aligned first-banner-img">
          <img src="<?php echo Product::hasThumb($this->special[1]->thumb, $this->special[1]->id);?>" alt="<?php echo $this->special[1]->title?>" class="wojo large inline image"></div>
        <div class="columns mobile-100 phone-100">
          <div class="padding">
            <p><span class="wojo transparent label"><?php echo Utility::renderPrice($this->special[1]->is_sale, $this->special[1]->price, $this->special[1]->sprice);?></span></p>
            <h3 class="wojo"><?php echo $this->special[1]->title; ?></h3>
            <p class="wojo small dimmed text"><?php echo Validator::sanitize($this->special[1]->body, "string", 80); ?></p>
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
<?php include_once($this->core->home_layout == 1 ? THEMEBASE . "/_home_grid.tpl.php" : THEMEBASE . "/_home_list.tpl.php");?>