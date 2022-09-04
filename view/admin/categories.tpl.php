<?php
  /**
   * Categories
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: categories.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::hasPrivileges('manage_categories')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments)): case "edit": ?>
<!-- Start edit -->
<h2><?php echo Lang::$word->CT_EDIT;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo segment form">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->NAME;?>
          <i class="icon asterisk"></i></label>
        <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" name="name" value="<?php echo $this->data->name;?>">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CT_SLUG;?></label>
        <input type="text" placeholder="<?php echo Lang::$word->CT_SLUG;?>" name="slug" value="<?php echo $this->data->slug;?>">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->CT_PARENT;?>
          <i class="icon asterisk"></i></label>
        <select id="parent_id" name="parent_id">
          <option value="0"><?php echo Lang::$word->CT_TOP;?></option>
          <?php echo $this->droplist;?>
        </select>
      </div>
      <div class="field">
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
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->DESCRIPTION;?></label>
        <textarea class="tiny" placeholder="<?php echo Lang::$word->DESCRIPTION;?>" name="body"><?php echo $this->data->body;?></textarea>
      </div>
    </div>
    <div class="wojo simple segment" id="mSort">
      <div id="sortlist" class="dd">
        <?php if($this->droplist) : echo $this->sortlist; endif;?>
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
  <div class="center aligned"><a href="<?php echo Url::url("/admin/categories");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-action="processCategory" name="dosubmit" class="wojo secondary button"><?php echo Lang::$word->CT_UPDATE;?></button>
  </div>
  <input type="hidden" name="id" value="<?php echo $this->data->id;?>">
</form>
<script src="<?php echo SITEURL;?>/assets/nestable.js"></script>
<script type="text/javascript" src="<?php echo ADMINVIEW;?>/js/categories.js"></script>
<script type="text/javascript"> 
// <![CDATA[  
  $(document).ready(function() {
	  $.Categories({
		  url: "<?php echo ADMINVIEW;?>",
		  lang: {
			  delMsg3: "<?php echo Lang::$word->TRASH;?>",
			  delMsg8: "<?php echo Lang::$word->DELCONFIRM3;?>",
			  canBtn: "<?php echo Lang::$word->CANCEL;?>",
			  trsBtn: "<?php echo Lang::$word->MTOTRASH;?>",
		  }
	  });
  });
// ]]>
</script>
<?php break;?>
<?php default: ?>
<h2><?php echo Lang::$word->META_M_CATEGORIES;?></h2>
<p class="wojo small text"><?php echo Lang::$word->CT_INFO;?></p>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo segment form">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->NAME;?>
          <i class="icon asterisk"></i></label>
        <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" name="name">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CT_SLUG;?></label>
        <input type="text" placeholder="<?php echo Lang::$word->CT_SLUG;?>" name="slug">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->CT_PARENT;?>
          <i class="icon asterisk"></i></label>
        <select id="parent_id" name="parent_id">
          <option value="0"><?php echo Lang::$word->CT_TOP;?></option>
          <?php echo $this->droplist;?>
        </select>
      </div>
      <div class="field">
        <div class="field">
          <label><?php echo Lang::$word->PUBLISHED;?></label>
          <div class="wojo checkbox radio fitted inline">
            <input name="active" type="radio" value="1" id="active_1" checked="checked">
            <label for="active_1"><?php echo Lang::$word->YES;?></label>
          </div>
          <div class="wojo checkbox radio fitted inline">
            <input name="active" type="radio" value="0" id="active_0">
            <label for="active_0"><?php echo Lang::$word->NO;?></label>
          </div>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->DESCRIPTION;?></label>
        <textarea class="tiny" placeholder="<?php echo Lang::$word->DESCRIPTION;?>" name="body"></textarea>
      </div>
    </div>
    <div class="wojo simple segment" id="mSort">
      <div id="sortlist" class="dd">
        <?php if($this->droplist) : echo $this->sortlist; endif;?>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->METAKEYS;?></label>
        <textarea class="small" placeholder="<?php echo Lang::$word->METAKEYS;?>" name="keywords"></textarea>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->METADESC;?></label>
        <textarea class="small" placeholder="<?php echo Lang::$word->METADESC;?>" name="description"></textarea>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <button type="button" data-action="processCategory" name="dosubmit" class="wojo secondary button"><?php echo Lang::$word->CT_CREATE;?></button>
  </div>
</form>
<script src="<?php echo SITEURL;?>/assets/nestable.js"></script>
<script type="text/javascript" src="<?php echo ADMINVIEW;?>/js/categories.js"></script>
<script type="text/javascript"> 
// <![CDATA[  
  $(document).ready(function() {
	  $.Categories({
		  url: "<?php echo ADMINVIEW;?>",
		  lang: {
			  delMsg3: "<?php echo Lang::$word->TRASH;?>",
			  delMsg8: "<?php echo Lang::$word->DELCONFIRM3;?>",
			  canBtn: "<?php echo Lang::$word->CANCEL;?>",
			  trsBtn: "<?php echo Lang::$word->MTOTRASH;?>",
		  }
	  });
  });
// ]]>
</script>
<?php break;?>
<?php endswitch;?>