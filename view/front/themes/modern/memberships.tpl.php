<?php
  /**
   * Account Memberships
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: memberships.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php include_once(THEMEBASE . '/snippets/dashNav.tpl.php');?>
<div class="row gutters">
  <div class="columns">
    <h1><?php echo Lang::$word->MEMBERSHIPS;?></h1>
  </div>
  <div class="columns auto">
    <a href="<?php echo Url::url('/dashboard', 'history');?>" class="wojo small primary button"><i class="icon history"></i>
    <?php echo Lang::$word->HISTORY;?></a>
  </div>
</div>
<?php if($this->data):?>
<div id="mBlock" class="row grid screen-3 tablet-2 mobile-1 phone-1 gutters">
  <?php foreach($this->data as $row):?>
  <div class="columns">
    <div id="item_<?php echo $row->id;?>" class="wojo attached segment<?php echo App::Auth()->membership_id == $row->id ? ' shadow' : null;?>">
      <?php if($row->thumb):?>
      <img src="<?php echo UPLOADURL;?>/memberships/<?php echo $row->thumb;?>" alt="<?php echo $row->title;?>">
      <?php else:?>
      <img src="<?php echo UPLOADURL;?>/memberships/default.svg" alt="<?php echo $row->title;?>">
      <?php endif;?>
      <h4 class="center aligned">
        <?php echo Utility::formatMoney($row->price);?>
        <?php echo $row->title;?></h4>
      <p class="wojo small text"><?php echo Lang::$word->MEM_REC1;?>
        <?php echo ($row->recurring) ? Lang::$word->YES : Lang::$word->NO;?></p>
      <p class="wojo small text"><?php echo $row->days;?>@<?php echo Date::getPeriodReadable($row->period);?></p>
      <p class="wojo small text"><?php echo $row->description;?></p>
      <?php if(App::Auth()->membership_id != $row->id):?>
      <button type="button" class="wojo primary button mCart" data-id="<?php echo $row->id;?>"><?php echo ($row->price <> 0) ? Lang::$word->SELECT : Lang::$word->ACTIVATE;?></button>
      <?php else:?>
      <span class="wojo simple disabled button"><?php echo Lang::$word->ACTIVE;?></span>
      <?php endif;?>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>
<div id="mResult"></div>