<?php
  /**
   * News
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: news.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h1><?php echo Lang::$word->NW_LATEST;?></h1>
<?php if($this->data):?>
<div class="wojo celled very relaxed list">
  <?php foreach($this->data as $row):?>
  <div class="item">
    <i class="icon news"></i>
    <div class="content">
      <div class="wojo small text">
        <?php echo Date::doDate("long_date", $row->created);?>
      </div>
      <div class="header"><?php echo $row->title;?></div>
      <?php echo Url::out_url($row->body);?></div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>