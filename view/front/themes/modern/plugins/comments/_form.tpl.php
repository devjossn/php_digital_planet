<?php
  /**
   * Comments Form
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _form.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo form">
  <form id="wojo_form" name="wojo_form" method="post">
    <div class="row gutters align center">
      <div class="columns screen-70 tablet-100 mobile-100 phone-100">
        <h4><?php echo Lang::$word->CMT_NEW;?></h4>
        <p class="wojo small bold text"><?php echo Lang::$word->CMT_YRATING;?></p>
        <div class="wojo fields">
          <div class="field">
            <div class="wojo checkbox radio fitted inline">
              <input name="star" type="radio" value="1" id="star_1">
              <label for="star_1">1</label>
            </div>
            <div class="wojo checkbox radio fitted inline">
              <input name="star" type="radio" value="2" id="star_2">
              <label for="star_2">2</label>
            </div>
            <div class="wojo checkbox radio fitted inline">
              <input name="star" type="radio" value="3" checked="checked" id="star_3">
              <label for="star_3">3</label>
            </div>
            <div class="wojo checkbox radio fitted inline">
              <input name="star" type="radio" value="4" id="star_4">
              <label for="star_4">4</label>
            </div>
            <div class="wojo checkbox radio fitted inline">
              <input name="star" type="radio" value="5" id="star_5">
              <label for="star_5">5</label>
            </div>
          </div>
        </div>
        <div class="wojo fields">
          <div class="field">
            <label><?php echo Lang::$word->NAME;?>
              <i class="icon asterisk"></i></label>
            <input name="name" placeholder="<?php echo Lang::$word->NAME;?>" type="text" value="<?php if (App::Auth()->logged_in) echo App::Auth()->name;?>">
          </div>
          <?php if($conf->show_captcha):?>
          <div class="field">
            <label><?php echo Lang::$word->CAPTCHA;?>
              <i class="icon asterisk"></i></label>
            <div class="wojo labeled input">
              <input placeholder="<?php echo Lang::$word->CAPTCHA;?>" name="captcha" type="text">
              <span class="wojo simple label"><?php echo Session::captcha();?>
              </span></div>
          </div>
          <?php endif;?>
        </div>
        <div class="wojo fields">
          <div class="field">
            <label><?php echo Lang::$word->MESSAGE;?>
              <i class="icon asterisk"></i></label>
            <textarea data-counter="<?php echo $conf->char_limit;?>" class="small" id="combody" placeholder="<?php echo Lang::$word->MESSAGE;?>" name="body"></textarea>
            <p class="wojo small text content-right combody_counter"><?php echo Lang::$word->CMT_CHARS . ' <span class="wojo bold positive text">' . $conf->char_limit . ' </span>';?></p>
          </div>
        </div>
        <div class="center aligned">
          <button type="button" name="doComment" class="wojo primary button"><?php echo Lang::$word->SUBMIT;?></button>
        </div>
        <input name="product_id" type="hidden" value="<?php echo $this->row->id;?>">
        <input name="url" type="hidden" value="<?php echo Url::uri();?>">
      </div>
    </div>
  </form>
</div>