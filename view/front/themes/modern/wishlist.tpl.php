<?php
  /**
   * Wishlist Page
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: wishlist.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h1><?php echo Lang::$word->META_M_WISHLIST;?></h1>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small thick caps text"><?php echo Lang::$word->FRONT_COMPARE_EMPTY;?></p>
</div>
<?php else:?>
<table class="wojo basic responsive table">
  <thead>
    <tr>
      <th></th>
      <th></th>
      <th><?php echo Lang::$word->NAME;?></th>
      <th><?php echo Lang::$word->PRD_PRICE;?></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($this->data as $row):?>
    <tr id="wishlist_<?php echo $row->id?>">
      <td class="auto"><a data-set='{"option":[{"iaction": "removeWishlist", "id":<?php echo $row->id?>}], "url":"/controller.php", "complete":"remove", "parent":"#wishlist_<?php echo $row->id?>"}' class="iaction"><i class="icon negative circular delete link"></i></a></td>
      <td class="auto"><img src="<?php echo Product::hasThumb($row->thumb, $row->id);?>" alt="<?php echo $row->title?>" class="wojo basic normal image"></td>
      <td><h4>
          <a href="<?php echo Url::url('/product', $row->slug);?>"><?php echo $row->title?></a>
        </h4></td>
      <td><span class="wojo bold text"><?php echo Utility::renderPrice($row->is_sale, $row->price, $row->sprice, "negative");?></span></td>
      <td class="auto"><?php include(THEMEBASE . '/snippets/listButton.tpl.php');?></td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
<?php endif;?>