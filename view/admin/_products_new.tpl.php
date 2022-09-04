<?php
  /**
   * Products New
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _products_new.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2><?php echo Lang::$word->PRD_NEW;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo segment form">
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->NAME;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo input">
          <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" name="title">
        </div>
      </div>
      <div class="field five wide">
        <label><?php echo Lang::$word->PRD_SLUG;?></label>
        <div class="wojo input">
          <input type="text" placeholder="<?php echo Lang::$word->PRD_SLUG;?>" name="slug">
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->PRD_PRICE;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo labeled input">
          <span class="wojo simple label"><?php echo Utility::currencySymbol();?></span>
          <input type="text" placeholder="<?php echo Lang::$word->PRD_PRICE;?>" name="price">
          <div class="wojo simple label"><?php echo App::Core()->currency;?></div>
        </div>
      </div>
      <div class="field five wide">
        <label><?php echo Lang::$word->PRD_SPRICE;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo labeled input">
          <span class="wojo simple label"><?php echo Utility::currencySymbol();?></span>
          <input type="text" placeholder="<?php echo Lang::$word->PRD_SPRICE;?>" value="0" name="sprice">
          <div class="wojo simple label"><?php echo App::Core()->currency;?></div>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->PRD_TYPE;?></label>
        <div class="wojo checkbox radio inline">
          <input name="type" type="radio" value="normal" checked="checked" id="normal_1">
          <label for="normal_1"><?php echo Lang::$word->PRD_DEFAULT;?></label>
        </div>
        <div class="wojo checkbox radio inline">
          <input name="type" type="radio" value="affiliate" id="affiliate_1">
          <label for="affiliate_1"><?php echo Lang::$word->PRD_AFFILIATE;?></label>
        </div>
        <div class="wojo checkbox radio inline">
          <input name="type" type="radio" value="cdkey" id="cdkey_1">
          <label for="cdkey_1"><?php echo Lang::$word->PRD_CDKEY;?></label>
        </div>
      </div>
    </div>
    <div id="affiliate" class="hide-all">
      <div class="wojo fields">
        <div class="field">
          <label><?php echo Lang::$word->PRD_AFFURL;?>
            <i class="icon asterisk"></i></label>
          <input type="text" placeholder="<?php echo Lang::$word->PRD_AFFURL;?>" name="affiliate">
        </div>
      </div>
    </div>
    <div id="cdkey" class="hide-all">
      <div class="wojo fields">
        <div class="field five wide">
          <label><?php echo Lang::$word->PRD_CDKEYS;?>
            <i class="icon asterisk"></i></label>
          <textarea name="cdkeys" class="formatted"></textarea>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <div class="wojo simple attached segment">
          <h6 class="wojo secondary text"><?php echo Lang::$word->PRD_MLEVEL;?></h6>
          <div class="wojo horizontal list">
            <?php if($this->membership_list):?>
            <?php foreach($this->membership_list as $mrow):?>
            <div class="item">
              <div class="wojo checkbox inline">
                <input type="checkbox" name="memberships[]" value="<?php echo $mrow->id;?>" id="memberships_<?php echo $mrow->id;?>">
                <label for="memberships_<?php echo $mrow->id;?>"><?php echo $mrow->title;?></label>
              </div>
            </div>
            <?php endforeach;?>
            <?php endif;?>
          </div>
        </div>
      </div>
    </div>
    <div class="wojo auto wide divider"></div>
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->CATEGORIES;?></label>
        <div class="wojo simple attached segment">
          <div class="scrollbox" style="height:400px;">
            <div class="wojo relaxed divided list">
              <?php echo $this->droplist;?>
            </div>
          </div>
        </div>
      </div>
      <div class="field five wide">
        <label><?php echo Lang::$word->FILES;?></label>
        <div class="wojo simple attached segment">
          <?php if($this->files):?>
          <div class="wojo small icon input" id="filter">
            <input type="text" placeholder="Filter">
            <i class="find icon"></i>
          </div>
          <div class="wojo divider"></div>
          <div class="scrollbox" style="height:345px;">
            <div id="fsearch" class="wojo relaxed fluid divided list">
              <?php foreach($this->files as $file):?>
              <?php $is_checked = (Validator::get('file') and Validator::get('file') ==  $file->id) ? ' checked="checked"' : null;?>
              <?php $is_active = (Validator::get('file') and Validator::get('file') ==  $file->id) ? ' highlite' : null;?>
              <div class="item align middle<?php echo $is_active;?>">
                <div class="content auto right margin">
                  <div class="wojo mime rounded image" style="background-color:<?php echo Product::fileStyle($file->extension);?>"><?php echo Product::fileIcon($file->extension, "");?></div>
                </div>
                <div class="content">
                  <div class="wojo fitted checkbox">
                    <input type="checkbox" name="files[]" id="fls_<?php echo $file->id;?>" value="<?php echo $file->id;?>"<?php echo $is_checked;?>>
                    <label for="fls_<?php echo $file->id;?>"><?php echo $file->alias;?></label>
                  </div>
                </div>
                <div class="content auto"><small class="size"><?php echo File::getSize($file->filesize);?> - <?php echo $file->extension;?></small></div>
              </div>
              <?php endforeach;?>
            </div>
          </div>
          <?php endif;?>
        </div>
      </div>
    </div>
    <div class="wojo auto wide divider"></div>
    <h5><?php echo Lang::$word->CF_TITLE;?></h5>
    <?php echo $this->custom_fields;?>
    <div class="wojo auto wide divider"></div>
    <div class="wojo fields">
      <div class="field">
        <h6 class="wojo secondary text"><?php echo Lang::$word->IMAGES;?></h6>
        <input type="file" name="images" id="images" class="filestyle" data-input="false" data-btnClass="secondary" data-text="<?php echo Lang::$word->MULTIPLE;?>" data-fields='{"iaction":"processImages","id":<?php echo App::Session()->get("digitoken");?>}' multiple>
        <div class="scrollbox margin top" style="height:300px;">
          <div class="row grid phone-1 mobile-2 tablet-3 screen-5 gutters" id="sortable"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="wojo segment form">
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->PRD_EXPIRY;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo action input">
          <input type="text" placeholder="<?php echo Lang::$word->PRD_EXPIRY;?>" value="0" name="expiry">
          <select name="expiry_type">
            <option value="downs" selected="selected"><?php echo Lang::$word->PRD_EXP_DOWN;?></option>
            <option value="days"><?php echo Lang::$word->PRD_EXP_DAYS;?></option>
          </select>
        </div>
      </div>
      <div class="field five wide">
        <label><?php echo Lang::$word->PUBLISHED;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="active" type="radio" value="1" id="active_1" checked="chcked">
          <label for="active_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="active" type="radio" value="0" id="active_0">
          <label for="active_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->PRD_BODY;?></label>
        <textarea class="bodypost" name="body"></textarea>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->PRD_PBODY;?></label>
        <textarea class="bodypost" name="pbody"></textarea>
      </div>
    </div>
    <div class="wojo auto wide divider"></div>
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->PRD_IMG;?></label>
        <input type="file" data-buttonText="<?php echo Lang::$word->BROWSE;?>" name="thumb" id="thumb" class="filestyle">
      </div>
      <div class="field five wide">
        <label><?php echo Lang::$word->PRD_AUDIO;?></label>
        <input type="file" data-buttonText="<?php echo Lang::$word->BROWSE;?>" name="audio" id="audio" class="filestyle">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->PRD_YTUBE;?></label>
        <div class="wojo icon input">
          <i class="icon youtube alt"></i>
          <input type="text" placeholder="<?php echo Lang::$word->PRD_YTUBE;?>" name="youtube">
        </div>
      </div>
      <div class="field five wide">
        <label><?php echo Lang::$word->PRD_TAGS;?></label>
        <div class="wojo icon input">
          <i class="icon tags"></i>
          <input type="text" placeholder="<?php echo Lang::$word->PRD_TAGS;?>" name="tags">
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->METAKEYS;?></label>
        <textarea class="small" placeholder="<?php echo Lang::$word->METAKEYS;?>" name="keywords"></textarea>
      </div>
      <div class="field five wide">
        <label><?php echo Lang::$word->METADESC;?></label>
        <textarea class="small" placeholder="<?php echo Lang::$word->METADESC;?>" name="description"></textarea>
      </div>
    </div>
    <div class="center aligned">
      <a href="<?php echo Url::url("/admin/products");?>" class="wojo small simple button"><?php echo Lang::$word->CANCEL;?></a>
      <button type="button" data-action="processItem" name="dosubmit" class="wojo secondary button"><?php echo Lang::$word->PRD_CREATE;?></button>
    </div>
  </div>
</form>