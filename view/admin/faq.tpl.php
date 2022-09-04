<?php
  /**
   * Page Manager
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: faq.tpl.php, v1.00 2020-05-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::hasPrivileges('manage_faq')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments)): case "edit": ?>
<!-- Start edit -->
<h2><?php echo Lang::$word->FAQ_EDIT;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo segment form">
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->FAQ_QUESTION;?>
          <i class="icon asterisk"></i></label>
      </div>
      <div class="field">
        <input type="text" placeholder="<?php echo Lang::$word->FAQ_QUESTION;?>" name="question" value="<?php echo $this->data->question;?>">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->FAQ_ANSWER;?>
          <i class="icon asterisk"></i></label>
      </div>
      <div class="field">
        <textarea name="answer" placeholder="<?php echo Lang::$word->FAQ_ANSWER;?>"><?php echo $this->data->answer;?></textarea>
      </div>
    </div>
    <div class="center aligned">
      <a href="<?php echo Url::url("/admin/faq");?>" class="wojo small simple button"><?php echo Lang::$word->CANCEL;?></a>
      <button type="button" data-action="processFaq" name="dosubmit" class="wojo secondary button"><?php echo Lang::$word->FAQ_UPDATE;?></button>
    </div>
  </div>
  <input type="hidden" name="id" value="<?php echo $this->data->id;?>">
</form>
<?php break;?>
<?php case "new": ?>
<!-- Start new -->
<h2><?php echo Lang::$word->FAQ_NEW;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo segment form">
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->FAQ_QUESTION;?>
          <i class="icon asterisk"></i></label>
      </div>
      <div class="field">
        <input type="text" placeholder="<?php echo Lang::$word->FAQ_QUESTION;?>" name="question">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->FAQ_ANSWER;?>
          <i class="icon asterisk"></i></label>
      </div>
      <div class="field">
        <textarea name="answer" placeholder="<?php echo Lang::$word->FAQ_ANSWER;?>"></textarea>
      </div>
    </div>
    <div class="center aligned">
      <a href="<?php echo Url::url("/admin/faq");?>" class="wojo small simple button"><?php echo Lang::$word->CANCEL;?></a>
      <button type="button" data-action="processFaq" name="dosubmit" class="wojo secondary button"><?php echo Lang::$word->FAQ_CREATE;?></button>
    </div>
  </div>
</form>
<?php break;?>
<?php default: ?>
<div class="row gutters align middle">
  <div class="columns mobile-100 phone-100">
    <h2><?php echo Lang::$word->META_M_FAQ;?></h2>
    <p class="wojo small text">
      <?php echo Lang::$word->FAQ_INFO;?>
    </p>
  </div>
  <div class="columns auto mobile-100 phone-100">
    <a href="<?php echo Url::url(Router::$path, "new/");?>" class="wojo small secondary stacked button"><i class="icon plus alt"></i><?php echo Lang::$word->FAQ_NEW;?></a>
  </div>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small thick caps text"><?php echo Lang::$word->FAQ_EMPTY;?></p>
</div>
<?php else:?>
<div class="wojo mason" id="sortable">
  <?php foreach ($this->data as $row):?>
  <div class="item" id="item_<?php echo $row->id;?>" data-id="<?php echo $row->id;?>">
    <div class="wojo attached card">
      <div class="header">
        <h4 class="basic">
          <?php echo $row->question;?>
        </h4>
      </div>
      <div class="content wojo small text"><?php echo Validator::truncate($row->answer, 100);?></div>
      <div class="footer divided">
        <div class="row align middle">
          <div class="columns">
            <a href="<?php echo Url::url(Router::$path, "edit/" . $row->id);?>" class="wojo positive small inverted icon button">
            <i class="icon pencil"></i></a>
          </div>
          <div class="columns auto">
            <a data-set='{"option":[{"trash": "trashFaq","title": "<?php echo Validator::sanitize($row->question, "chars");?>","id": <?php echo $row->id;?>}],"action":"trash","parent":"#item_<?php echo $row->id;?>"}' class="wojo negative small inverted icon button data"><i class="icon trash"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/sortable.js"></script>
<script type="text/javascript"> 
// <![CDATA[
$(document).ready(function() {
    $("#sortable").sortable({
        ghostClass: "ghost",
        animation: 600,
        onUpdate: function(e) {
            var order = this.toArray();
            $.ajax({
                type: 'post',
                url: "<?php echo ADMINVIEW . '/helper.php';?>",
                dataType: 'json',
                data: {
                    iaction: "sortFaq",
                    sorting: order
                }
            });
        }
    });
});
// ]]>
</script>
<?php endif;?>
<?php break;?>
<?php endswitch;?>