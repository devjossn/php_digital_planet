<?php
  /**
   * Rename File
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: renameFile.tpl.php, v1.00 2020-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!$this->data) : Message::invalid("ID" . Filter::$id); return; endif;
?>
<div class="header"><h4><?php echo Lang::$word->RENAME;?></h4></div>
<div class="body">
  <div class="wojo small form content">
    <form method="post" id="modal_form" name="modal_form">
      <div class="wojo fields">
        <div class="basic field">
          <label><?php echo Lang::$word->FM_ALIAS;?>
            <i class="icon asterisk"></i></label>
          <input type="text" placeholder="<?php echo Lang::$word->FM_ALIAS;?>" value="<?php echo $this->data->alias;?>" name="alias">
        </div>
      </div>
    </form>
  </div>
</div>