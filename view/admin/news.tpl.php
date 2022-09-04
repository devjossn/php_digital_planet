<?php
  /**
   * News Manager
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: news.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::hasPrivileges('manage_news')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments)): case "edit": ?>
<!-- Start edit -->
<h2><?php echo Lang::$word->NW_EDIT;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo segment form">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->NAME;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo input">
          <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="<?php echo $this->data->title;?>" name="title">
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
    <div class="center aligned">
      <a href="<?php echo Url::url("/admin/news");?>" class="wojo small simple button"><?php echo Lang::$word->CANCEL;?></a>
      <button type="button" data-action="processNews" name="dosubmit" class="wojo secondary button"><?php echo Lang::$word->NW_UPDATE;?></button>
    </div>
  </div>
  <input type="hidden" name="id" value="<?php echo $this->data->id;?>">
</form>
<?php break;?>
<?php case "new": ?>
<h2><?php echo Lang::$word->NW_NEW;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo segment form">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->NAME;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo input">
          <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" name="title">
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
    <div class="center aligned">
      <a href="<?php echo Url::url("/admin/news");?>" class="wojo small simple button"><?php echo Lang::$word->CANCEL;?></a>
      <button type="button" data-action="processNews" name="dosubmit" class="wojo secondary button"><?php echo Lang::$word->NW_CREATE;?></button>
    </div>
  </div>
</form>
<?php break;?>
<?php default: ?>
<div class="row gutters align middle">
  <div class="columns mobile-100 phone-100">
    <h2><?php echo Lang::$word->META_M_NEWS;?></h2>
    <p class="wojo small text"><?php echo Lang::$word->NW_INFO;?></p>
  </div>
  <div class="columns auto mobile-100 phone-100">
    <a href="<?php echo Url::url(Router::$path, "new/");?>" class="wojo small secondary button stacked"><i class="icon plus alt"></i><?php echo Lang::$word->NW_NEW;?></a>
  </div>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small thick caps text"><?php echo Lang::$word->NW_EMPTY;?></p>
</div>
<?php else:?>
<?php foreach ($this->data as $row):?>
<div class="wojo card" id="item_<?php echo $row->id;?>">
  <div class="header">
    <div class="row horizontal gutters align middle">
      <div class="columns auto"><i class="icon huge disabled news"></i></div>
      <div class="columns">
        <h4>
          <a class="wojo thick text" href="<?php echo Url::url(Router::$path, "edit/" . $row->id);?>"><?php echo $row->title;?></a>
        </h4>
        <p><small><?php echo Date::doDate("short_date", $row->created);?></small></p>
      </div>
      <div class="columns auto">
        <a data-set='{"option":[{"trash": "trashNews","title": "<?php echo Validator::sanitize($row->title, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3;?>","parent":"#item_<?php echo $row->id;?>"}' class="wojo inverted circular icon negative button data">
        <i class="icon trash"></i>
        </a>
      </div>
    </div>
  </div>
</div>
<?php endforeach;?>
<?php endif;?>
<?php break;?>
<?php endswitch;?>