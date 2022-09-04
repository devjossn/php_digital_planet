<?php
  /**
   * Login
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: login.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row align center">
  <div class="columns screen-50 tablet-70 mobile-100 phone-100">
    <h1><?php echo Lang::$word->META_M_LOGIN;?></h1>
    <div class="wojo form">
      <div id="loginform">
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->EMAIL;?>
              <i class="icon asterisk"></i></label>
          </div>
          <div class="field">
            <input name="username" type="text" placeholder="<?php echo Lang::$word->EMAIL;?>">
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->PASSWORD;?>
              <i class="icon asterisk"></i></label>
          </div>
          <div class="field">
            <input type="password" name="password" placeholder="<?php echo Lang::$word->PASSWORD;?>">
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled"></div>
          <div class="field">
            <button id="doLogin" type="button" name="submit" class="wojo primary fluid button"><?php echo Lang::$word->LOGIN;?></button>
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled"><a id="passreset"><?php echo Lang::$word->PASSWORD_L;?>?</a>
          </div>
          <div class="field">
            <a href="<?php echo Url::url('/register');?>"><?php echo Lang::$word->USR_NOACC;?>?</a>
          </div>
        </div>
      </div>
      <div id="passform" class="hide-all">
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->EMAIL;?>
              <i class="icon asterisk"></i></label>
          </div>
          <div class="field">
            <input type="text" name="pEmail" id="pEmail" placeholder="<?php echo Lang::$word->EMAIL;?>">
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled"></div>
          <div class="field">
            <button id="doPass" type="button" name="doopass" class="wojo primary fluid button"><?php echo Lang::$word->SUBMIT;?></button>
          </div>
        </div>
        <div class="wojo fields">
          <div class="field"><a id="backto"><?php echo Lang::$word->BACKTOLOGIN;?></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>