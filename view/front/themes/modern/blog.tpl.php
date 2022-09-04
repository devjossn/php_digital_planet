<?php
  /**
   * Blog
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: blog.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(ADMINBASE . '/blog/'));
?>
<?php switch(count($this->segments)): case 3: ?>
<div class="row big gutters">
  <div class="columns screen-70 tablet-70 mobile-100 phone-100">
    <div id="blog" class="row gutters">
      <?php if($this->rows):?>
      <?php foreach($this->rows as $row):?>
      <div class="columns screen-40 tablet-40 mobile-50 phone-100">
        <figure class="wojo rounded image"><img src="<?php echo Blog::hasThumb($row->thumb, $row->id);?>" alt="<?php echo $row->title;?>"></figure>
      </div>
      <div class="columns screen-60 tablet-60 mobile-50 phone-100">
        <small class="wojo thin text"><?php echo Date::doDate("long_date", $row->created);?></small>
        <h3 class="basic">
          <a href="<?php echo Url::url('/blog', $row->slug);?>" class="black"><?php echo $row->title;?></a>
        </h3>
        <p class="wojo small text">
          <?php echo Lang::$word->IN;?>: <a class="black" href="<?php echo Url::url('/blog/category', $row->cslug);?>">
          <?php echo $row->ctitle;?>
          </a>
        </p>
        <p><?php echo Validator::sanitize($row->body, "default", 100);?></p>
      </div>
      <?php endforeach;?>
      <?php endif;?>
    </div>
  </div>
  <div class="columns screen-30 tablet-30 mobile-100 phone-100"><?php echo App::Blog()->renderCategories(App::Blog()->catList());?></div>
</div>
<div class="row gutters align middle">
  <div class="columns auto mobile-100 phone-100">
    <div class="wojo small semi text"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $this->pager->current_page . ' '. Lang::$word->OF . ' ' . $this->pager->num_pages;?></div>
  </div>
  <div class="columns right aligned mobile-100 phone-100"><?php echo $this->pager->display_pages();?></div>
</div>
<?php break;?>
<!-- Start Blog single -->
<?php case 2: ?>
<div class="row big gutters">
  <div class="columns screen-70 tablet-70 mobile-100 phone-100">
    <h1><?php echo $this->row->title;?></h1>
    <a href="<?php echo FRONTVIEW . Blog::BLOGDATA . $this->row->id. '/' . $this->row->thumb;?>" class="wojo basic rounded image lightbox">
    <img src="<?php echo Blog::hasImage($this->row->thumb, $this->row->id);?>" alt="<?php echo $this->row->title;?>">
    </a>
    <div class="center aligned margin top">
      <div class="wojo small relaxed fluid horizontal list align middle">
        <div class="item">
          <div class="content auto wojo semi text">
            <?php echo Lang::$word->IN;?>: </div>
          <div class="content">
            <a href="<?php echo Url::url('/blog/category', $this->row->catslug);?>" class="secondary dashed description"><?php echo $this->row->catname;?></a>
          </div>
        </div>
        <?php if($this->row->show_created):?>
        <!-- Show created -->
        <div class="item">
          <div class="content auto wojo semi text">
            <?php echo Lang::$word->CREATED;?>: </div>
          <div class="content">
            <span class="wojo secondary text description"><?php echo Date::doDate("short_date", $this->row->created);?></span>
          </div>
        </div>
        <?php endif;?>
        <?php if($this->row->show_sharing):?>
        <!--Social Sharing-->
        <div class="item">
          <div class="content auto">
            <a target="_blank" data-tooltip="<?php echo Lang::$word->SHAREON;?> Facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo Url::url('/blog', $this->row->slug);?>" class="wojo small secondary icon button"><i class="icon facebook"></i></a>
            <a data-tooltip="<?php echo Lang::$word->SHAREON;?> Twitter" href="https://twitter.com/home?status=<?php echo Url::url('/blog', $this->row->slug);?>"  class="wojo small secondary icon button"><i class="icon twitter"></i></a>
            <a target="_blank" data-tooltip="<?php echo Lang::$word->SHAREON;?> Google +" href="https://plus.google.com/share?url=<?php echo Url::url('/blog', $this->row->slug);?>" class="wojo small secondary icon button"><i class="icon google plus"></i></a>
            <a target="_blank" data-tooltip="<?php echo Lang::$word->SHAREON;?> Pinterest" href="https://pinterest.com/pin/create/button/?url=&amp;media=<?php echo Url::url('/blog', $this->row->slug);?>" class="wojo small secondary icon button"><i class="icon pinterest"></i></a>
          </div>
        </div>
        <?php endif;?>
      </div>
    </div>
  </div>
  <div class="columns screen-30 tablet-30 mobile-100 phone-100"><?php echo App::Blog()->renderCategories(App::Blog()->catList());?></div>
</div>
<?php echo Url::out_url($this->row->body);?>
<?php break;?>
<!-- Start Blog default -->
<?php default: ?>
<div class="row big gutters">
  <div class="columns screen-70 tablet-70 mobile-100 phone-100">
    <div id="blog" class="row gutters">
      <?php if($this->rows):?>
      <?php foreach($this->rows as $row):?>
      <div class="columns screen-40 tablet-40 mobile-50 phone-100">
        <figure class="wojo rounded image"><img src="<?php echo Blog::hasThumb($row->thumb, $row->id);?>" alt="<?php echo $row->title;?>"></figure>
      </div>
      <div class="columns screen-60 tablet-60 mobile-50 phone-100">
        <small class="wojo thin text"><?php echo Date::doDate("long_date", $row->created);?></small>
        <h3 class="basic">
          <a href="<?php echo Url::url('/blog', $row->slug);?>" class="black"><?php echo $row->title;?></a>
        </h3>
        <p class="wojo small text">
          <?php echo Lang::$word->IN;?>: <a class="black" href="<?php echo Url::url('/blog/category', $row->cslug);?>">
          <?php echo $row->ctitle;?>
          </a>
        </p>
        <p><?php echo Validator::sanitize($row->body, "default", 100);?></p>
      </div>
      <?php endforeach;?>
      <?php endif;?>
    </div>
  </div>
  <div class="columns screen-30 tablet-30 mobile-100 phone-100"><?php echo App::Blog()->renderCategories(App::Blog()->catList());?></div>
</div>
<div class="row gutters align middle">
  <div class="columns auto mobile-100 phone-100">
    <div class="wojo small semi text"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $this->pager->current_page . ' '. Lang::$word->OF . ' ' . $this->pager->num_pages;?></div>
  </div>
  <div class="columns right aligned mobile-100 phone-100"><?php echo $this->pager->display_pages();?></div>
</div>
<?php break;?>
<?php endswitch;?>
<?php //Debug::pre($this->rows);?>
