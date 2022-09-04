<?php
  /**
   * Files
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: files.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::hasPrivileges('manage_files')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<div class="row gutters align middle">
  <div class="columns mobile-100 phone-100">
    <h2><?php echo Lang::$word->META_M_FILES;?></h2>
    <p class="wojo small text"><?php echo str_replace("[LIMIT]", '<span class="wojo bold positive text">' . ini_get('upload_max_filesize') . '</span>', Lang::$word->FM_INFO);?></p>
  </div>
  <div class="columns auto mobile-100 phone-100">
    <div class="wojo small secondary button stacked uploader" id="drag-and-drop-zone">
      <label><i class="icon plus alt"></i>
        <?php echo Lang::$word->UPLOAD;?>
        <input type="file" multiple name="files[]">
      </label>
    </div>
  </div>
</div>
<div id="fileList" class="wojo items relaxed"></div>
<div class="center aligned">
  <div class="wojo divided horizontal list">
    <div class="disabled item wojo bold text">
      <?php echo Lang::$word->FILTER_O;?>
    </div>
    <a href="<?php echo Url::url(Router::$path);?>" class="item<?php echo Url::setActive("type", false);?>">
    <?php echo Lang::$word->FM_ALL_F;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?type=audio");?>" class="item<?php echo Url::setActive("type", "audio");?>">
    <i class="icon musical note"></i>
    <?php echo Lang::$word->FM_AUD_F;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?type=video");?>" class="item<?php echo Url::setActive("type", "video");?>">
    <i class="icon movie"></i>
    <?php echo Lang::$word->FM_VID_F;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?type=image");?>" class="item<?php echo Url::setActive("type", "image");?>">
    <i class="icon photo"></i>
    <?php echo Lang::$word->FM_AMG_F;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?type=document");?>" class="item<?php echo Url::setActive("type", "document");?>">
    <i class="icon files"></i>
    <?php echo Lang::$word->FM_DOC_F;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?type=archive");?>" class="item<?php echo Url::setActive("type", "archive");?>">
    <i class="icon book"></i>
    <?php echo Lang::$word->FM_ARC_F;?>
    </a>
  </div>
</div>
<div class="center aligned margin top">
  <div class="wojo divided horizontal list">
    <div class="disabled item wojo bold text">
      <?php echo Lang::$word->SORTING_O;?>
    </div>
    <a href="<?php echo Url::url(Router::$path);?>" class="item<?php echo Url::setActive("order", false);?>">
    <?php echo Lang::$word->RESET;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?order=name|DESC");?>" class="item<?php echo Url::setActive("order", "name");?>">
    <?php echo Lang::$word->NAME;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?order=alias|DESC");?>" class="item<?php echo Url::setActive("order", "alias");?>">
    <?php echo Lang::$word->FM_ALIAS;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?order=filesize|DESC");?>" class="item<?php echo Url::setActive("order", "filesize");?>">
    <?php echo Lang::$word->FM_FSIZE;?>
    </a>
    <div class="item">
      <a href="<?php echo Url::sortItems(Url::url(Router::$path), "order");?>" data-tooltip="ASC/DESC"><i class="icon triangle unfold more link"></i></a>
    </div>
  </div>
</div>
<div class="center aligned vertical margin"><?php echo Validator::alphaBits(Url::url(Router::$path), "letter");?></div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small thick caps text"><?php echo Lang::$word->FM_NOFILES;?></p>
</div>
<?php else:?>
<div class="wojo segment">
  <div class="row divided grid horizontal gutters screen-2 tablet-2 mobile-1 phone-1" id="fileData">
    <?php foreach($this->data as $i => $row):?>
    <div class="columns" id="item_<?php echo $row->id;?>">
      <div class="item align middle">
        <div class="columns auto">
          <img src="<?php echo SITEURL;?>/assets/images/filetypes/<?php echo File::getFileType($row->name);?>" class="wojo default rounded image">
        </div>
        <div class="columns">
          <h6 class="basic"><?php echo $row->name;?></h6>
          <div id="alias_<?php echo $row->id;?>" class="wojo small text truncate"><?php echo $row->alias;?></div>
          <span class="wojo small text"><?php echo File::getSize($row->filesize);?></span>
        </div>
        <div class="columns auto">
          <p class="wojo small basic text"><?php echo Date::doDate("long_date", $row->created);?></p>
        </div>
        <div class="columns auto">
          <a class="grey" data-dropdown="#fileDrop_<?php echo $row->id;?>">
          <i class="icon vertical ellipsis"></i>
          </a>
          <div class="wojo dropdown small pointing top-right" id="fileDrop_<?php echo $row->id;?>">
            <a href="<?php echo Url::url("/admin/products/new", "?file=" . $row->id);?>" class="item"><i class="icon plus"></i>
            <?php echo Lang::$word->PRD_NEW;?></a>
            <a data-set='{"option":[{"action":"renameFile","id": <?php echo $row->id;?>}], "label":"<?php echo Lang::$word->RENAME;?>", "url":"helper.php", "parent":"#alias_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal"}' class="item action"><i class="icon pencil"></i><?php echo Lang::$word->RENAME;?></a>
            <div class="divider"></div>
            <a data-set='{"option":[{"delete": "deleteFile","title": "<?php echo Validator::sanitize($row->alias, "chars");?>","id":<?php echo $row->id;?>,"name": "<?php echo $row->name;?>"}],"action":"delete", "parent":"#item_<?php echo $row->id;?>"}' class="item data">
            <i class="icon trash"></i>
            <?php echo Lang::$word->DELETE;?>
            </a>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach;?>
  </div>
</div>
<?php endif;?>
<div class="row gutters align middle">
  <div class="columns auto mobile-100 phone-100">
    <div class="wojo small semi text"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $this->pager->current_page . ' '. Lang::$word->OF . ' ' . $this->pager->num_pages;?></div>
  </div>
  <div class="columns right aligned mobile-100 phone-100"><?php echo $this->pager->display_pages();?></div>
</div>
<script src="<?php echo ADMINVIEW;?>/js/files.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $("#fileList").Manager({
        url: "<?php echo ADMINVIEW;?>",
		surl: "<?php echo SITEURL;?>",
        lang: {
            delete: "<?php echo Lang::$word->DELETE;?>",
			insert: "<?php echo Lang::$word->INSERT;?>",
			download: "<?php echo Lang::$word->DOWNLOAD;?>",
			unzip: "<?php echo Lang::$word->FM_UNZIP;?>",
			size: "<?php echo Lang::$word->FM_FSIZE;?>",
			lastm: "<?php echo Lang::$word->FM_LASTM;?>",
			items: "<?php echo strtolower(Lang::$word->ITEMS);?>",
			done: "<?php echo Lang::$word->DONE;?>",
			home: "<?php echo Lang::$word->HOME;?>",
        }
    });
});
// ]]>
</script>