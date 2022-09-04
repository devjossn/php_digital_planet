<?php
  /**
   * Memberships Page
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _memberships.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h1><?php echo $this->row->title;?></h1>
<?php echo Url::out_url($this->row->body);?>
<?php if(!App::Auth()->is_User()):?>
<p><i class="icon info sign"></i>
  <?php echo str_replace(array("[LOGIN]", "[REGISTER]"), array(' <a href="' . Url::url('/login') . '" class="wojo bold text">' . strtolower(Lang::$word->LOGIN) . '</a>', '<a href="' . Url::url('/register') . '" class="wojo bold text">' . strtolower(Lang::$word->REGISTER) . '</a>'), Lang::$word->FRONT_VIP_ERROR);?></p>
<?php endif;?>
<?php if($this->packages):?>
<div class="row grid screen-3 tablet-2 mobile-1 phone-1 gutters">
  <?php foreach($this->packages as $row):?>
  <div class="columns">
    <div class="wojo attached segment">
      <?php if($row->thumb):?>
      <img src="<?php echo UPLOADURL;?>/memberships/<?php echo $row->thumb;?>" alt="<?php echo $row->title;?>">
      <?php else:?>
      <img src="<?php echo UPLOADURL;?>/memberships/default.svg" alt="<?php echo $row->title;?>">
      <?php endif;?>
      <h4 class="center aligned">
        <?php echo Utility::formatMoney($row->price);?>
        <?php echo $row->title;?>
      </h4>
      <p class="wojo small text center aligned">
        <?php echo $row->description;?>
      </p>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>