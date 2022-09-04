<?php
  /**
   * Rating Stars
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2017
   * @version $Id: ratingStars.tpl.php, v1.00 2017-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo stars" data-tooltip="<?php echo $this->row->ratings;?>">
  <?php for ($x = 1; $x <= $this->row->stars; $x++):?>
  <span class="star active"><i class="icon star full"></i></span>
  <?php endfor;?>
  <?php while ($x <= 5):?>
  <span class="star"><i class="icon star"></i></span>
  <?php $x++;?>
  <?php endwhile;?>
  <a href="#pMore" data-scroll="true">
    <span class="rcounter"><?php echo $this->row->comments;?></span>
    <?php echo strtolower(Lang::$word->FRONT_CREVIEW);?>
  </a>
</div>