<?php
  /**
   * Products Grid
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _products_grid.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row gutters align middle">
  <div class="columns auto mobile-100 mobile-order-1">
    <h2><?php echo Lang::$word->META_M_PRODUCTS;?></h2>
  </div>
  <div class="columns right aligned mobile-50 phone-100 mobile-order-2">
    <a href="<?php echo Url::url("/admin/products", "new/");?>" class="wojo small secondary stacked button"><i class="icon plus alt"></i><?php echo Lang::$word->PRD_NEW;?></a>
  </div>
  <div class="columns auto mobile-50 mobile-order-3">
    <a href="<?php echo Url::url("/admin/products");?>" class="wojo small primary icon button"><i class="icon unordered list"></i></a>
    <a class="wojo small disabled icon button"><i class="icon grid list"></i></a>
  </div>
</div>
<div class="row gutters align center">
  <div class="columns screen-40 tablet-50 mobile-100 phone-100">
    <form method="post" id="wojo_form" name="wojo_form" class="wojo form">
      <div class="wojo action input">
        <input name="find" placeholder="<?php echo Lang::$word->SEARCH;?>" type="text">
        <button class="wojo small icon button">
        <i class="icon find"></i></button>
      </div>
    </form>
  </div>
</div>
<div class="center aligned">
  <div class="wojo small divided horizontal list">
    <div class="disabled item wojo bold text">
      <?php echo Lang::$word->SORTING_O;?>
    </div>
    <a href="<?php echo Url::url(Router::$path);?>" class="item<?php echo Url::setActive("order", false);?>">
    <?php echo Lang::$word->RESET;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?order=items|DESC");?>" class="item<?php echo Url::setActive("order", "items");?>">
    <?php echo Lang::$word->PURCHASES;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?price=email|DESC");?>" class="item<?php echo Url::setActive("price", "email");?>">
    <?php echo Lang::$word->PRD_PRICE;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?order=fname|DESC");?>" class="item<?php echo Url::setActive("order", "fname");?>">
    <?php echo Lang::$word->NAME;?>
    </a>
    <div class="item"><a href="<?php echo Url::sortItems(Url::url(Router::$path), "order");?>" data-tooltip="ASC/DESC"><i class="icon triangle unfold more link"></i></a>
    </div>
  </div>
</div>
<div class="center aligned margin bottom">
  <?php echo Validator::alphaBits(Url::url(Router::$path), "letter");?>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small thick caps text"><?php echo Lang::$word->PRD_EMPTY;?></p>
</div>
<?php else:?>
<div class="wojo mason">
  <?php foreach($this->data as $row):?>
  <div class="item" id="item_<?php echo $row->id;?>">
    <div class="wojo attached card">
      <div class="header">
        <div class="row align middle">
          <div class="columns truncate">
            <a class="wojo demi grey text" href="<?php echo Url::url("/admin/products", "edit/" . $row->id);?>">
            <?php echo $row->title;?></a>
          </div>
          <div class="columns auto">
            <a data-dropdown="#prodDrop_<?php echo $row->id;?>" class="wojo small primary inverted icon circular button">
            <i class="icon vertical ellipsis"></i>
            </a>
            <div class="wojo dropdown small pointing top-right" id="prodDrop_<?php echo $row->id;?>">
              <a class="item" href="<?php echo Url::url(Router::$path, "edit/" . $row->id);?>"><i class="icon pencil"></i>
              <?php echo Lang::$word->EDIT;?></a>
              <a class="item" href="<?php echo Url::url("/admin/products", "history/" . $row->id);?>"><i class="icon history"></i>
              <?php echo Lang::$word->HISTORY;?></a>
              <div class="divider"></div>
              <a data-set='{"option":[{"delete":"deleteProduct","title": "<?php echo Validator::sanitize($row->title, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete","parent":"#item_<?php echo $row->id;?>"}' class="item wojo demi text data">
              <i class="icon trash"></i><?php echo Lang::$word->DELETE;?>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="content">
        <div class="center aligned bottom margin">
          <a href="<?php echo Url::url("/admin/products/edit/" . $row->id);?>">
          <img src="<?php echo Product::hasThumb($row->thumb, $row->id);?>" alt="" class="wojo basic circular normal inline image"></a>
        </div>
        <div class="row align middle">
          <div class="columns"><?php echo Lang::$word->IN;?>: <a href="<?php echo Url::url("/admin/categories/edit",  $row->category_id);?>"><?php echo $row->name;?></a>
          </div>
          <div class="columns auto"><span class="wojo bold text"><?php echo Utility::formatMoney($row->price);?></span></div>
        </div>
      </div>
      <div class="footer divided">
        <div class="wojo divided relaxed small list">
          <div class="item">
            <div class="header"><?php echo Lang::$word->COMMENTS;?>
              <span class="description"><?php echo $row->comments;?></span>
            </div>
          </div>
          <div class="item">
            <div class="header"><?php echo Lang::$word->PURCHASES;?>
              <span class="description"><?php echo ($row->sales > 0) ? $row->sales : '-/-';?></span>
            </div>
          </div>
          <div class="item">
            <div class="header"><?php echo Lang::$word->MEMBERSHIP;?>
              <span class="description"><?php echo $row->memberships ? $row->memberships : '-/-';?></span>
            </div>
          </div>
          <div class="item">
            <div class="header"><?php echo Lang::$word->LIKES;?>
              <span class="description"><?php echo $row->likes;?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>
<div class="row gutters align middle">
  <div class="columns auto mobile-100 phone-100">
    <div class="wojo small semi text"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $this->pager->current_page . ' '. Lang::$word->OF . ' ' . $this->pager->num_pages;?></div>
  </div>
  <div class="columns right aligned mobile-100 phone-100"><?php echo $this->pager->display_pages();?></div>
</div>