<?php
  /**
   * Reply Form
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _replyForm.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once("../../../../../../init.php");
?>
<?php if(App::Comments()->public_access or App::Auth()->logged_in):?>
<div class="wojo small simple segment form hide-all" id="replyform">
  <?php if(App::Auth()->logged_in):?>
  <input type="hidden" name="replayname" value="<?php echo App::Auth()->uid;?>">
  <?php else:?>
  <input name="replayname" placeholder="<?php echo Lang::$word->NAME;?>" type="text" value="<?php if (App::Auth()->logged_in) echo App::Auth()->name;?>">
  <?php endif;?>
  <div class="small top padding">
    <textarea data-counter="<?php echo App::Comments()->char_limit;?>" id="replybody" placeholder="<?php echo Lang::$word->MESSAGE;?>" name="replybody"></textarea>
  </div>
  <div class="small top padding">
    <p class="wojo small text replybody_counter"><?php echo Lang::$word->CMT_CHARS . ' <span class="wojo positive text">' . App::Comments()->char_limit . '</span>';?></p>
    <button type="button" name="doReply" class="wojo small primary button"><?php echo Lang::$word->SUBMIT;?></button>
  </div>
</div>
<?php else:?>
<p id="pError" class="wojo small negative text"><?php echo Lang::$word->CMT_REGONLY;?></p>
<?php endif;?>