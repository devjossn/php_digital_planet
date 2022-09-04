<?php
  /**
   * Small Contact
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2017
   * @version $Id: _small_contact.tpl.php, v1.00 2017-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h4 class="wojo white text"><?php echo Lang::$word->CONTACT;?></h4>
<div class="wojo space divider"></div>
<div class="wojo inverted form">
  <div class="wojo tiny basic rounded input">
    <input name="name" type="text" placeholder="<?php echo Lang::$word->NAME;?> *">
  </div>
  <div class="wojo small space divider"></div>
  <div class="wojo tiny basic input">
    <input name="email" type="text" placeholder="<?php echo Lang::$word->EMAIL;?> *">
  </div>
  <div class="wojo small space divider"></div>
  <div class="wojo tiny basic input">
    <textarea class="small" placeholder="<?php echo Lang::$word->MESSAGE;?> *" name="message"></textarea>
  </div>
  <div class="wojo small space divider"></div>
  <p class="content-right"><a class="white fContact"><?php echo Lang::$word->SUBMIT;?></a>
</div>