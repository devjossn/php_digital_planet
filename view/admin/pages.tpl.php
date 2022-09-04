<?php
  /**
   * Page Manager
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: pages.tpl.php, v1.00 2020-05-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::hasPrivileges('manage_pages')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments)): case "edit": ?>
<!-- Start edit -->
<h2><?php echo Lang::$word->PAG_EDIT;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo segment form">
    <div class="wojo two fields">
      <div class="field">
        <label><?php echo Lang::$word->NAME;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo input">
          <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="<?php echo $this->data->title;?>" name="title">
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PAG_SLUG;?></label>
        <div class="wojo input">
          <input type="text" placeholder="<?php echo Lang::$word->PAG_SLUG;?>" value="<?php echo $this->data->slug;?>" name="slug">
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <textarea class="bodypost" name="body"><?php echo str_replace("[SITEURL]", SITEURL, $this->data->body);?></textarea>
      </div>
    </div>
    <div class="wojo fields">
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
    <div class="center aligned">
      <a href="<?php echo Url::url("/admin/pages");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
      <button type="button" data-action="processPage" name="dosubmit" class="wojo secondary button"><?php echo Lang::$word->PAG_UPDATE;?></button>
    </div>
  </div>
  <input type="hidden" name="id" value="<?php echo $this->data->id;?>">
  <input type="hidden" name="page_type" value="<?php echo $this->data->page_type;?>">
</form>
<?php break;?>
<?php case "new": ?>
<!-- Start new -->
<h2><?php echo Lang::$word->PAG_NEW;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo segment form">
    <div class="wojo two fields">
      <div class="field">
        <label><?php echo Lang::$word->NAME;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo input">
          <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" name="title">
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PAG_SLUG;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo input">
          <input type="text" placeholder="<?php echo Lang::$word->PAG_SLUG;?>" name="slug">
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <textarea class="bodypost" name="body"></textarea>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
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
    <div class="center aligned">
      <a href="<?php echo Url::url("/admin/pages");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
      <button type="button" data-action="processPage" name="dosubmit" class="wojo secondary button"><?php echo Lang::$word->PAG_CREATE;?></button>
    </div>
  </div>
  <input type="hidden" name="page_type" value="normal">
</form>
<?php break;?>
<?php default: ?>
<div class="row gutters align middle">
  <div class="columns mobile-100 phone-100">
    <h2><?php echo Lang::$word->META_M_PAGES;?></h2>
    <p class="wojo small text">
      <?php echo Lang::$word->PAG_INFO;?>
    </p>
  </div>
  <div class="columns auto mobile-100 phone-100">
    <a href="<?php echo Url::url(Router::$path, "new/");?>" class="wojo small secondary stacked button"><i class="icon plus alt"></i><?php echo Lang::$word->PAG_NEW;?></a>
  </div>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small thick caps text"><?php echo Lang::$word->PAG_NOPAGE;?></p>
</div>
<?php else:?>
<?php foreach ($this->data as $row):?>
<div class="wojo card" id="item_<?php echo $row->id;?>">
  <div class="header">
    <div class="row horizontal gutters align middle">
      <div class="columns auto"><?php echo Content::pageType($row->page_type);?></div>
      <div class="columns">
        <h4>
          <a class="wojo thick text" href="<?php echo Url::url(Router::$path, "edit/" . $row->id);?>"><?php echo $row->title;?></a>
        </h4>
        <p><small><?php echo Date::doDate("short_date", $row->created);?></small></p>
      </div>
      <div class="columns auto">
        <?php if($row->page_type == "normal"):?>
        <a data-set='{"option":[{"trash": "trashPage","title": "<?php echo Validator::sanitize($row->title, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3;?>","parent":"#item_<?php echo $row->id;?>"}' class="wojo inverted circular icon negative button data">
        <i class="icon trash"></i>
        </a>
        <?php else:?>
        <i class="icon disabled close"></i>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>
<?php endforeach;?>
<?php endif;?>
<?php break;?>
<?php endswitch;?>