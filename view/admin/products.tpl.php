<?php
  /**
   * Products
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: products.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::hasPrivileges('manage_products')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments)): case "edit": ?>
<!-- Start edit -->
<?php include("_products_edit.tpl.php");?>
<?php break;?>
<!-- Start new -->
<?php case "new": ?>
<?php include("_products_new.tpl.php");?>
<?php break;?>
<!-- Start history -->
<?php case "history": ?>
<?php include("_products_history.tpl.php");?>
<?php break;?>
<!-- Start grid -->
<?php case "grid": ?>
<?php include("_products_grid.tpl.php");?>
<?php break;?>
<!-- Start default -->
<?php default: ?>
<?php include("_products_list.tpl.php");?>
<?php break;?>
<?php endswitch;?>
<script src="<?php echo SITEURL;?>/assets/sortable.js"></script>
<script src="<?php echo ADMINVIEW;?>/js/products.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $.Products({
        url: "<?php echo ADMINVIEW;?>",
    });
});
// ]]>
</script>