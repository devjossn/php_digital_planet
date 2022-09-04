<?php
  /**
   * Search
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: search.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row align middle gutters phone-hide" id="filter">
  <div class="columns auto">
    <div class="items"><?php echo Lang::$word->TOTAL . ': ' . (($this->featured > 0) ? count($this->featured) : 0);?></div>
  </div>
  <div class="columns content-center"><?php echo Lang::$word->FRONT_SEARCH_FOR;?> <span class="wojo bold text">[<?php echo $this->keyword;?>]</span></div>
  <div class="columns auto">
    <a <?php if(Validator::isGetSet("mode", "list")) echo 'href="' . Url::url(Router::$path, Url::buildUrl("mode","grid")) . '"';?> class="items inverted<?php if(!Validator::isGetSet("mode", "list")) echo ' active';?>"><i class="icon apps"></i></a>
  </div>
  <div class="columns auto">
    <a <?php if(!Validator::isGetSet("mode", "list")) echo 'href="' . Url::url(Router::$path, Url::buildUrl("mode","list")) . '"';?> class="items inverted last<?php if(Validator::isGetSet("mode", "list")) echo ' active';?>"><i class="icon unordered list"></i></a>
  </div>
</div>
<?php if(!$this->keyword || strlen($this->keyword = trim($this->keyword)) == 0 || strlen($this->keyword) < 3):?>
<?php Message::msgSingleInfo(Lang::$word->FRONT_SEARCH_EMPTY2);?>
<?php elseif(!$this->featured):?>
<?php Message::msgSingleInfo(Lang::$word->FRONT_SEARCH_EMPTY . '<span class="wojo bold text"> [' . $this->keyword . '] </span>' . Lang::$word->FRONT_SEARCH_EMPTY1);?>
<?php else:?>
<?php if(Validator::isGetSet("mode", "list")):?>
<?php include(THEMEBASE . '/_home_list.tpl.php');?>
<?php else:?>
<?php include(THEMEBASE . '/_home_grid.tpl.php');?>
<?php endif;?>
<?php endif;?>