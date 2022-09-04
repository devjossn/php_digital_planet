<?php
  /**
   * View Downloads
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: viewDownloads.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="header">
  <?php if($this->row):?>
  <h4 class="basic"><?php echo ($this->row->price > 0) ? Lang::$word->META_M_MDOWNS : Lang::$word->META_M_FDOWNS;?>
    <?php else:?>
    <?php echo Lang::$word->DOWNLOADS;?></h4>
  <?php endif;?>
</div>
<div class="body">
  <div class="content">
    <?php if(!$this->row):?>
    <?php echo Message::msgSingleError(Lang::$word->FM_ERROR);?>
    <?php else:?>
    <div class="row small gutters">
      <div class="columns auto"><img src="<?php echo Product::hasThumb($this->row->thumb, $this->row->id);?>" alt="" class="wojo small image"></div>
      <div class="columns">
        <h4>
          <a href="<?php echo Url::url('/product', $this->row->slug);?>"><?php echo $this->row->title;?></a>
        </h4>
        <?php echo Validator::sanitize($this->row->body, "string", 100);?></div>
    </div>
    <?php endif;?>
    <h4><?php echo Lang::$word->FM_FILES;?></h4>
    <?php if($this->data):?>
    <div class="wojo very relaxed divided items">
      <?php foreach($this->data as $row):?>
      <div class="item align middle">
        <div class="columns">
          <h6><?php echo $row->alias;?></h6>
          <p class="wojo small text"><?php echo Date::doDate("long_date", $row->created);?>
            <?php echo File::getSize($row->filesize);?></p>
        </div>
        <div class="columns auto"><a href="<?php echo SITEURL;?>/download.php?<?php echo ($this->row->price > 0) ? "member" : "free";?>=<?php echo Utility::encode($this->row->id);?>&amp;token=<?php echo $row->token;?>" class="wojo small primary button"><?php echo Lang::$word->DOWNLOAD;?></a>
        </div>
      </div>
      <?php endforeach;?>
    </div>
    <?php endif;?>
  </div>
</div>