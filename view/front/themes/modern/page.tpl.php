<?php
  /**
   * Page
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: page.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php switch($this->row->page_type): case "contact": ?>
<?php include_once(THEMEBASE . '/_contact.tpl.php');?>
<?php break;?>
<?php case "faq": ?>
<?php include_once(THEMEBASE . '/_faq.tpl.php');?>
<?php break;?>
<?php case "membership": ?>
<?php include_once(THEMEBASE . '/_packages.tpl.php');?>
<?php break;?>
<?php default: ?>
<h1><?php echo $this->row->title;?></h1>
<?php echo Url::out_url($this->row->body);?>
<?php break;?>
<?php endswitch;?>