<?php
  /**
   * Activation
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: activation.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if(Validator::get('done')):?>
<?php Message::msgOk(Lang::$word->MSG_INFO08 . ' <a href="' . Url::url('/login') . '" class="wojo bold text white">' . Lang::$word->MSG_INFO08_1 . '</a>');?>
<?php else:?>
<?php echo Message::msgError(Lang::$word->MSG_INFO07);?>
<?php endif;?>