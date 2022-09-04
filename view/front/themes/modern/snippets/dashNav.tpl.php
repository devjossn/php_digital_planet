<?php
  /**
   * Cart
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: dashNav.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row gutters align middle">
  <div class="columns">
    <div class="wojo white fluid buttons">
      <a class="wojo button<?php if (count($this->segments) == 1) echo ' active';?>" href="<?php echo Url::url('/dashboard');?>"><?php echo Lang::$word->META_M_MYDOWNS;?></a>
      <a class="wojo button<?php if (Utility::in_array_any(["memberships"], $this->segments)) echo ' active';?>" href="<?php echo Url::url('/dashboard', 'memberships');?>"><?php echo Lang::$word->MEMBERSHIPS;?></a>
      <a class="wojo button<?php if (Utility::in_array_any(["profile"], $this->segments)) echo ' active';?>" href="<?php echo Url::url('/dashboard', 'profile');?>"><?php echo Lang::$word->ADM_MYACC;?></a>
      <a class="wojo button" href="<?php echo Url::url('/logout');?>"><?php echo Lang::$word->LOGOUT;?></a>
    </div>
  </div>
  <div class="columns auto">
    <div id="colorPanel">
      <a id="cpToggle" href="#"><i class="icon contrast"></i></a>
      <ul>
      </ul>
    </div>
  </div>
</div>