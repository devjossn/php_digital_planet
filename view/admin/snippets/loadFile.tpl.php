<?php
  /**
   * Load File
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: loadFile.tpl.php, v1.00 2020-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!$this->row) : Message::invalid("ID" . Filter::$id); return; endif;
?>
<div class="columns">
  <div class="item align middle" id="item_<?php echo $this->row->id;?>">
    <div class="columns auto">
      <img src="<?php echo SITEURL;?>/assets/images/filetypes/<?php echo File::getFileType($this->row->name);?>" class="wojo default rounded image">
    </div>
    <div class="columns">
      <h6 class="basic"><?php echo $this->row->name;?></h6>
      <div id="alias_<?php echo $this->row->id;?>" class="wojo small text truncate"><?php echo $this->row->alias;?></div>
      <span class="wojo small text"><?php echo File::getSize($this->row->filesize);?></span>
    </div>
    <div class="columns auto">
      <p class="wojo small basic text"><?php echo Date::doDate("long_date", $this->row->created);?></p>
    </div>
    <div class="columns auto">
      <a class="grey" data-dropdown="#fileDrop_<?php echo $this->row->id;?>">
      <i class="icon vertical ellipsis"></i>
      </a>
      <div class="wojo dropdown small pointing top-right" id="fileDrop_<?php echo $this->row->id;?>">
        <a href="<?php echo Url::url("/admin/products/new", "?file=" . $this->row->id);?>" class="item"><i class="icon plus"></i>
        <?php echo Lang::$word->PRD_NEW;?></a>
        <a data-set='{"option":[{"action":"renameFile","id": <?php echo $this->row->id;?>}], "label":"<?php echo Lang::$word->RENAME;?>", "url":"helper.php", "parent":"#alias_<?php echo $this->row->id;?>", "complete":"replace", "modalclass":"normal"}' class="item action"><i class="icon pencil"></i><?php echo Lang::$word->RENAME;?></a>
        <div class="divider"></div>
        <a data-set='{"option":[{"delete": "deleteFile","title": "<?php echo Validator::sanitize($this->row->alias, "chars");?>","id":<?php echo $this->row->id;?>,"name": "<?php echo $this->row->name;?>"}],"action":"delete", "parent":"#item_<?php echo $this->row->id;?>"}' class="item data">
        <i class="icon trash"></i>
        <?php echo Lang::$word->DELETE;?>
        </a>
      </div>
    </div>
  </div>
</div>