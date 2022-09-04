<?php
  /**
   * Blog
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _edit.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2><?php echo Lang::$word->_MOD_AM_TITLE2;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo form segment">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->NAME;?>
          <i class="icon asterisk"></i></label>
        <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="<?php echo $this->data->title;?>" name="title">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_AM_SLUG;?></label>
        <input type="text" placeholder="<?php echo Lang::$word->_MOD_AM_SLUG;?>" value="<?php echo $this->data->slug;?>" name="slug">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <textarea class="bodypost" name="body"><?php echo Url::out_url($this->data->body);?></textarea>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->METAKEYS;?></label>
        <textarea class="small" placeholder="<?php echo Lang::$word->METAKEYS;?>" name="keywords"><?php echo $this->data->keywords;?></textarea>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->METADESC;?></label>
        <textarea class="small" placeholder="<?php echo Lang::$word->METADESC;?>" name="description"><?php echo $this->data->description;?></textarea>
      </div>
    </div>
  </div>
  <div class="wojo form segment">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->CATEGORIES;?></label>
        <div class="wojo attached segment">
          <div class="scrollbox" style="height:300px;">
            <div class="wojo relaxed divided list">
              <?php echo $this->droplist;?>
            </div>
          </div>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PRD_IMG;?></label>
        <input type="file" name="thumb" data-type="image" data-exist="<?php echo Blog::hasThumb($this->data->thumb, $this->data->id);?>" accept="image/png, image/jpeg">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_AM_CREATED;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_created" type="radio" value="1" id="show_created_1" <?php Validator::getChecked($this->data->show_created, 1); ?>>
          <label for="show_created_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_created" type="radio" value="0" id="show_created_0" <?php Validator::getChecked($this->data->show_created, 0); ?>>
          <label for="show_created_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_AM_SHARE;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_sharing" type="radio" value="1" id="show_sharing_1" <?php Validator::getChecked($this->data->show_sharing, 1); ?>>
          <label for="show_sharing_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_sharing" type="radio" value="0" id="show_sharing_0" <?php Validator::getChecked($this->data->show_sharing, 0); ?>>
          <label for="show_sharing_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PUBLISHED;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="active" type="radio" value="1" id="active_1" <?php Validator::getChecked($this->data->active, 1); ?>>
          <label for="active_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="active" type="radio" value="0" id="active_0" <?php Validator::getChecked($this->data->active, 0); ?>>
          <label for="active_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin", "blog/");?>" class="wojo simple button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="blog" data-action="processItem" name="dosubmit" class="wojo secondary button"><?php echo Lang::$word->_MOD_AM_UPDATEITM;?></button>
  </div>
  <input type="hidden" name="id" value="<?php echo $this->data->id;?>">
</form>