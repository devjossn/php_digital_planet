<?php
  /**
   * Register
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: register.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row align center">
  <div class="columns screen-60 tablet-80 mobile-100 phone-100">
    <h1><?php echo Lang::$word->USR_ACCNEW;?></h1>
    <form method="post" id="wojo_form" name="wojo_form">
      <div class="wojo form">
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->EMAIL;?>
              <i class="icon asterisk"></i></label>
          </div>
          <div class="field">
            <input type="text" placeholder="<?php echo Lang::$word->EMAIL;?>" name="email">
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->PASSWORD;?>
              <i class="icon asterisk"></i></label>
          </div>
          <div class="field">
            <input type="password" placeholder="<?php echo Lang::$word->PASSWORD;?>" name="password">
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->NAME;?>
              <i class="icon asterisk"></i></label>
          </div>
          <div class="field three wide">
            <input type="text" placeholder="<?php echo Lang::$word->FNAME;?>" name="fname">
          </div>
          <div class="field three wide">
            <input type="text" placeholder="<?php echo Lang::$word->LNAME;?>" name="lname">
          </div>
        </div>
        <?php echo $this->custom_fields;?>
        <?php if($this->core->enable_tax):?>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->ADDRESS;?>
              <i class="icon asterisk"></i></label>
          </div>
          <div class="field">
            <input type="text" placeholder="<?php echo Lang::$word->ADDRESS;?>"  name="address">
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->CITY;?>/<?php echo Lang::$word->STATE;?>
              <i class="icon asterisk"></i></label>
          </div>
          <div class="field three wide">
            <input type="text" placeholder="<?php echo Lang::$word->CITY;?>" name="city">
          </div>
          <div class="field three wide">
            <input type="text" placeholder="<?php echo Lang::$word->STATE;?>" name="state">
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->COUNTRY;?>/<?php echo Lang::$word->ZIP;?>
              <i class="icon asterisk"></i>
            </label>
          </div>
          <div class="field">
            <div class="wojo action input">
              <input type="text" placeholder="<?php echo Lang::$word->ZIP;?>" name="zip">
              <select name="country">
                <?php echo Utility::loopOptions($this->clist, "abbr", "name");?>
              </select>
            </div>
          </div>
        </div>
        <?php endif;?>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->CAPTCHA;?>
              <i class="icon asterisk"></i></label>
          </div>
          <div class="field">
            <div class="wojo labeled input">
              <input name="captcha" type="text">
              <span class="wojo simple label"><?php echo Session::captcha();?></span>
            </div>
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->PRIVACY;?>
              <i class="icon asterisk"></i></label>
          </div>
          <div class="field">
            <div class="wojo inline fitted checkbox">
              <input name="agree" type="checkbox" value="1" id="agree_1">
              <label for="agree_1"><a href="<?php echo Url::url("/content", "privacy-policy");?>" target="_blank"><?php echo Lang::$word->AGREE;?></a>
              </label>
            </div>
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label><a href="<?php echo Url::url('/login');?>"><?php echo Lang::$word->USR_HASACCOUNT;?>?</a></label>
          </div>
          <div class="field">
            <button class="bottom fluid wojo primary button" data-action="register" name="dosubmit" type="button"><?php echo Lang::$word->USR_REGCOMP;?></button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
