<?php
  /**
   * Comments
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: comments.tpl.php, v1.00 2020-02-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if (!Auth::checkAcl("owner")) : print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments)): case "edit": ?>
<!-- Start configuration -->
<h2><?php echo Lang::$word->META_M_COMMENTS;?></h2>
<p class="wojo small text"><?php echo Lang::$word->CMT_INFO;?></p>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo segment form">
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->CMT_NAMEREQ;?></label>
      </div>
      <div class="field">
        <div class="wojo checkbox radio inline fitted">
          <input name="name_req" type="radio" value="1" <?php Validator::getChecked($this->row->name_req, 1); ?> id="name_req_1">
          <label for="name_req_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio inline fitted">
          <input name="name_req" type="radio" value="0" <?php Validator::getChecked($this->row->name_req, 0); ?> id="name_req_0">
          <label for="name_req_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->CMT_RATING;?></label>
      </div>
      <div class="field">
        <div class="wojo checkbox radio inline fitted">
          <input name="rating" type="radio" value="1" <?php Validator::getChecked($this->row->rating, 1); ?> id="rating_1">
          <label for="rating_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio inline fitted">
          <input name="rating" type="radio" value="0" <?php Validator::getChecked($this->row->rating, 0); ?> id="rating_0">
          <label for="rating_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->CMT_SHOWCAP;?></label>
      </div>
      <div class="field">
        <div class="wojo checkbox radio inline fitted">
          <input name="show_captcha" type="radio" value="1" <?php Validator::getChecked($this->row->show_captcha, 1); ?> id="show_captcha_1">
          <label for="show_captcha_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio inline fitted">
          <input name="show_captcha" type="radio" value="0" <?php Validator::getChecked($this->row->show_captcha, 0); ?> id="show_captcha_0">
          <label for="show_captcha_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->CMT_AUTOA;?></label>
      </div>
      <div class="field">
        <div class="wojo checkbox radio inline fitted">
          <input name="auto_approve" type="radio" value="1" <?php Validator::getChecked($this->row->auto_approve, 1); ?> id="auto_approve_1">
          <label for="auto_approve_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio inline fitted">
          <input name="auto_approve" type="radio" value="0" <?php Validator::getChecked($this->row->auto_approve, 0); ?> id="auto_approve_0">
          <label for="auto_approve_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->CMT_PUBLIC;?></label>
      </div>
      <div class="field">
        <div class="wojo checkbox radio inline fitted">
          <input name="public_access" type="radio" value="1" <?php Validator::getChecked($this->row->public_access, 1); ?> id="public_access_1">
          <label for="public_access_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio inline fitted">
          <input name="public_access" type="radio" value="0" <?php Validator::getChecked($this->row->public_access, 0); ?> id="public_access_0">
          <label for="public_access_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->CMT_NOTIFY;?></label>
      </div>
      <div class="field">
        <div class="wojo checkbox radio inline fitted">
          <input name="notify_new" type="radio" value="1" <?php Validator::getChecked($this->row->notify_new, 1); ?> id="notify_new_1">
          <label for="notify_new_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio inline fitted">
          <input name="notify_new" type="radio" value="0" <?php Validator::getChecked($this->row->notify_new, 0); ?> id="notify_new_0">
          <label for="notify_new_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->CMT_DATEFORMAT;?></label>
      </div>
      <div class="field">
        <select name="dateformat">
          <?php echo Date::getShortDate($this->row->dateformat);?>
          <?php echo Date::getLongDate($this->row->dateformat);?>
        </select>
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->CMT_SINCE;?></label>
      </div>
      <div class="field">
        <div class="wojo checkbox radio inline fitted">
          <input name="timesince" type="radio" value="1" <?php Validator::getChecked($this->row->timesince, 1); ?> id="timesince_1">
          <label for="timesince_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio inline fitted">
          <input name="timesince" type="radio" value="0" <?php Validator::getChecked($this->row->timesince, 0); ?> id="timesince_0">
          <label for="timesince_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->CMT_SORTING;?></label>
      </div>
      <div class="field">
        <select name="sorting">
          <option value="DESC" <?php echo Validator::getSelected($this->row->sorting, "DESC");?>><?php echo Lang::$word->CMT_SORTING_T;?></option>
          <option value="ASC" <?php echo Validator::getSelected($this->row->sorting, "ASC");?>><?php echo Lang::$word->CMT_SORTING_B;?></option>
        </select>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->CMT_CHARS;?></label>
      </div>
      <div class="field">
        <input name="char_limit" type="range" min="20" max="400" step="10" value="<?php echo $this->row->char_limit;?>" hidden data-suffix=" char" data-type="labels" data-labels="20,50,100,200,400">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->CMT_CPP;?></label>
      </div>
      <div class="field">
        <input name="perpage" type="range" min="5" max="50" step="5" value="<?php echo $this->row->perpage;?>" hidden data-suffix=" itm" data-type="labels" data-labels="5,20,35,50">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->CMT_BLACK;?></label>
      </div>
      <div class="field">
        <textarea placeholder="<?php echo Lang::$word->CMT_BLACK;?>" name="blacklist_words"><?php echo $this->row->blacklist_words;?></textarea>
      </div>
    </div>
    <div class="center aligned">
      <button type="button" data-action="commentConfig" name="dosubmit" class="wojo secondary button"><?php echo Lang::$word->CMT_UPDATE;?></button>
    </div>
  </div>
</form>
<?php break;?>
<?php default: ?>
<div class="row gutters align middle">
  <div class="columns mobile-100 phone-100">
    <h2><?php echo Lang::$word->META_M_COMMENTS;?></h2>
    <p class="wojo small text"><?php echo Lang::$word->CMT_INFO1;?></p>
  </div>
  <div class="column auto mobile-100 phone-100">
    <a href="<?php echo Url::url(Router::$path, "edit/");?>" class="wojo small secondary button stacked"><i class="icon cogs"></i><?php echo Lang::$word->META_M_CONFIGURE;?></a>
  </div>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small thick caps text"><?php echo Lang::$word->CMT_EMPTY;?></p>
</div>
<?php else:?>
<?php foreach($this->data as $row):?>
<div class="wojo card" id="item_<?php echo $row->id;?>">
  <div class="header divided">
    <div class="row horizontal gutters">
      <div class="columns">
        <h4 class="basic">
          <?php echo ($row->uname)? $row->uname : $row->username;?>
        </h4>
      </div>
      <div class="columns auto">
        <a data-tooltip="<?php echo Lang::$word->APPROVE;?>" data-set='{"option":[{"iaction":"commentApprove", "id":<?php echo $row->id;?>}], "url":"/helper.php", "complete":"remove", "parent":"#item_<?php echo $row->id;?>"}' class="wojo small positive inverted icon button iaction"><i class="icon check"></i></a>
        <a data-set='{"option":[{"delete": "deleteComment","title": "<?php echo $row->id;?>","id": <?php echo $row->id;?>}],"action":"delete","parent":"#item_<?php echo $row->id;?>"}' class="wojo small negative icon inverted button data"><i class="icon trash"></i></a>
      </div>
    </div>
  </div>
  <div class="content">
    <p class="wojo small text">
      <?php echo $row->body;?>
    </p>
    <span class="wojo small caps text"><?php echo Date::doDate("long_date", $row->created);?>
  </div>
</div>
<?php endforeach;?>
<div class="row gutters align middle">
  <div class="columns auto mobile-100 phone-100">
    <div class="wojo small semi text"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $this->pager->current_page . ' '. Lang::$word->OF . ' ' . $this->pager->num_pages;?></div>
  </div>
  <div class="columns right aligned mobile-100 phone-100"><?php echo $this->pager->display_pages();?></div>
</div>
<?php endif;?>
<?php break;?>
<?php endswitch;?>