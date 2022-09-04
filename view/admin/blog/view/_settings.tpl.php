<?php
  /**
   * Blog
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _blog_settings.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2><?php echo Lang::$word->_MOD_AM_CONF;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo form segment">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_AM_LATEST;?>
          <i class="icon asterisk"></i></label>
        <input name="fperpage" type="range" min="5" max="20" step="1" value="<?php echo $this->data->fperpage;?>" hidden data-suffix=" itm">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_AM_THUMB_W;?>
          <i class="icon asterisk"></i></label>
        <input name="thumb_w" type="range" min="100" max="800" step="20" value="<?php echo $this->data->thumb_w;?>" hidden data-suffix=" px">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_AM_THUMB_H;?>
          <i class="icon asterisk"></i></label>
        <input name="thumb_h" type="range" min="100" max="800" step="20" value="<?php echo $this->data->thumb_h;?>" hidden data-suffix=" px">
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin", "blog/");?>" class="wojo simple button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="blog" data-action="processConfig" name="dosubmit" class="wojo secondary button"><?php echo Lang::$word->CONF_UPDATE;?></button>
  </div>
</form>