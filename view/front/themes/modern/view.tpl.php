<?php
  /**
   * View Download
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2017
   * @version $Id: view.tpl.php, v1.00 2017-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php include_once(THEMEBASE . '/snippets/dashNav.tpl.php');?>
<h1><?php echo Lang::$word->FRONT_FPROP;?></h1>
<?php if(!$this->row):?>
<?php echo Message::msgSingleError(Lang::$word->FM_ERROR);?>
<?php else:?>
<div class="row gutters">
  <div class="columns auto"><a href="<?php echo Url::url('/product', $this->row->slug);?>"><img src="<?php echo Product::hasThumb($this->row->thumb, $this->row->pid);?>" class="wojo normal basic image"></a>
  </div>
  <div class="columns">
    <h4>
      <a href="<?php echo Url::url('/product', $this->row->slug);?>"><?php echo $this->row->title;?></a>
    </h4>
    <p><?php echo Validator::sanitize($this->row->body, "string", 300);?></p>
  </div>
</div>
<?php if($this->row->type == "cdkey"):?>
<h4><?php echo Lang::$word->PRD_CDKEY;?></h4>
<div class="wojo segment"><?php echo $this->row->cdkey;?></div>
<?php if($this->data):?>
<div class="wojo fluid relaxed celled list">
  <?php foreach($this->data as $row):?>
  <div class="item">
    <img src="<?php echo SITEURL;?>/assets/images/filetypes/<?php echo File::getFileType($row->name);?>" class="wojo small rounded shadow image">
    <div class="content">
      <p class="header"><?php echo $row->alias;?></p>
      <div class="wojo small text"><?php echo Date::doDate("long_date", $row->created);?></div>
      <div class="wojo small text"><?php echo File::getSize($row->filesize);?>
        <span class="wojo vertical divider"></span>
        <a href="<?php echo SITEURL;?>/download.php?paid=<?php echo $this->row->tid;?>&amp;token=<?php echo $row->token;?>"><?php echo Lang::$word->DOWNLOAD;?></a>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>
<?php else:?>
<h4><?php echo Lang::$word->FM_FILES;?></h4>
<?php if($this->data):?>
<div class="wojo fluid relaxed celled list">
  <?php foreach($this->data as $row):?>
  <div class="item">
    <img src="<?php echo SITEURL;?>/assets/images/filetypes/<?php echo File::getFileType($row->name);?>" class="wojo small rounded shadow image">
    <div class="content">
      <p class="header"><?php echo $row->alias;?></p>
      <div class="wojo small text"><?php echo Date::doDate("long_date", $row->created);?></div>
      <div class="wojo small text"><?php echo File::getSize($row->filesize);?>
        <span class="wojo vertical divider"></span>
        <a href="<?php echo SITEURL;?>/download.php?paid=<?php echo $this->row->tid;?>&amp;token=<?php echo $row->token;?>"><?php echo Lang::$word->DOWNLOAD;?></a>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>
<?php if ($this->stats['expiry'] > 0) :?>
<div class="wojo small indicating positive progress" data-wprogress='{"tooltip": true,"label": false}'>
  <span class="bar" data-percent="<?php echo $this->stats['bar'];?>"><span class="tip"></span></span>
  <div class="label"></div>
  <h6 class="center aligned"><?php echo Lang::$word->FM_ERROR6;?>
    <?php echo $this->stats['counter'];?>. <?php echo $this->stats['status'];?></h6>
</div>
<?php else:?>
<div class="wojo small indicating positive progress" data-wprogress='{"tooltip": true,"label": false}'>
  <span class="bar" data-percent="100"><span class="tip"></span></span>
  <div class="label"></div>
  <h6 class="center aligned"><?php echo $this->stats['status'];?></h6>
</div>
<?php endif;?>
<?php endif;?>
<?php if ($this->stats['expired']):?>
<a href="<?php echo Url::url('/product', $this->row->slug);?>" class="wojo primary button"><?php echo Lang::$word->FM_BUY;?></a>
<?php endif;?>
<?php endif;?>