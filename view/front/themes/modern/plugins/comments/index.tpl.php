<?php
  /**
   * Comments
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _comments.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  $pager = Paginator::instance();
  $conf = App::Comments();
  $comments = Comments::Render($this->row->id);
?>
<div id="comments">
  <?php echo $comments;?>
  <div class="full padding center aligned">
    <?php echo $pager->display_pages('mini');?>
  </div>
  <?php if($conf->public_access or App::Auth()->logged_in):?>
  <?php include(PLUGINBASE . "/comments/_form.tpl.php");?>
  <?php else:?>
  <?php echo Message::msgSingleAlert(Lang::$word->CMT_REGONLY);?>
  <?php endif;?>
</div>