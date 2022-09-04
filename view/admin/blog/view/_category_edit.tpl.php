<?php
  /**
   * Blog
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _blog_category_edit.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2><?php echo Lang::$word->_MOD_AM_UPDATECAT;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo form segment">
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->NAME;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo huge fluid input">
          <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="<?php echo $this->data->name;?>" name="name">
        </div>
      </div>
      <div class="field five wide">
        <label><?php echo Lang::$word->_MOD_AM_CSLUG;?></label>
        <div class="wojo huge fluid input">
          <input type="text" placeholder="<?php echo Lang::$word->_MOD_AM_CSLUG;?>" value="<?php echo $this->data->slug;?>" name="slug">
        </div>
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
        <label><?php echo Lang::$word->_MOD_AM_PARENT;?></label>
        <select id="parent_id" name="parent_id">
          <option value="0"><?php echo Lang::$word->CT_TOP;?></option>
          <?php echo $this->droplist;?>
        </select>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PUBLISHED;?></label>
        <div class="wojo checkbox toggle fitted inline">
          <input name="active" type="radio" value="1" id="active_1" <?php Validator::getChecked($this->data->active, 1);?>>
          <label for="active_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox toggle fitted inline">
          <input name="active" type="radio" value="0" id="active_0" <?php Validator::getChecked($this->data->active, 0);?>>
          <label for="active_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo form card" id="mSort">
      <div id="sortlist" class="dd">
        <?php if($this->droplist) : echo $this->sortlist; endif;?>
      </div>
    </div>
    <div class="wojo block fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_AM_IPC;?></label>
        <input name="perpage" type="range" min="5" max="20" step="1" value="<?php echo $this->data->perpage;?>" hidden data-suffix=" itm">
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/blog/categories");?>" class="wojo simple button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="blog" data-action="processCategory" name="dosubmit" class="wojo secondary button"><?php echo Lang::$word->_MOD_AM_UPDATECAT;?></button>
  </div>
  <input type="hidden" name="id" value="<?php echo $this->data->id;?>">
</form>
<script src="<?php echo SITEURL;?>/assets/nestable.js"></script>