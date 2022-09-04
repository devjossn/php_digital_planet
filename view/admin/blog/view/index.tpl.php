<?php
  /**
   * Blog
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::hasPrivileges('manage_blog')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments, 2)): case "category": ?>
<!-- Start category edit -->
<?php include("_category_edit.tpl.php");?>
<?php break;?>
<?php case "categories": ?>
<!-- Start category new -->
<?php include("_category_new.tpl.php");?>
<?php break;?>
<?php case "edit": ?>
<!-- Start edit -->
<?php include("_edit.tpl.php");?>
<?php break;?>
<?php case "new": ?>
<!-- Start new -->
<?php include("_new.tpl.php");?>
<?php break;?>
<?php case "settings": ?>
<!-- Start settings -->
<?php include("_settings.tpl.php");?>
<?php break;?>
<?php default: ?>
<!-- Start default -->
<?php include("_list.tpl.php");?>
<?php break;?>
<?php endswitch;?>
<script src="<?php echo SITEURL;?>/assets/sortable.js"></script>
<script src="<?php echo ADMINVIEW;?>/blog/view/js/blog.js"></script> 
<script type="text/javascript"> 
// <![CDATA[  
  $(document).ready(function() {
	  $.Blog({
		  url: "<?php echo ADMINVIEW;?>/blog/controller.php",
		  aurl: "<?php echo ADMINVIEW;?>",
		  lang: {
			  delMsg3: "<?php echo Lang::$word->DELCONFIRM1;?>",
			  delMsg8: "<?php echo Lang::$word->DELCONFIRM2;?>",
			  canBtn: "<?php echo Lang::$word->CANCEL;?>",
			  trsBtn: "<?php echo Lang::$word->DELETE_REC;?>",
			  err: "<?php echo Lang::$word->ERROR;?>",
			  err1: "<?php echo Lang::$word->FU_ERROR7;?>",
		  }
	  });
  });
// ]]>
</script> 