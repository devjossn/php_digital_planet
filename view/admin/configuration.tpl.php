<?php
  /**
   * Configuration
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: configuration.tpl.php, v1.00 2020-02-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if (!Auth::checkAcl("owner")) : print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<h2><?php echo Lang::$word->META_M_SETTINGS;?></h2>
<p class="wojo small text"><?php echo Lang::$word->CONF_INFO;?></p>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo segment form">
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->CONF_SITE;?>
          <i class="icon asterisk"></i></label>
        <input type="text" placeholder="<?php echo Lang::$word->CONF_SITE;?>" value="<?php echo $this->core->site_name;?>" name="site_name">
      </div>
      <div class="field five wide">
        <label><?php echo Lang::$word->CONF_COMPANY;?>
          <i class="icon asterisk"></i></label>
        <input type="text" placeholder="<?php echo Lang::$word->CONF_COMPANY;?>" value="<?php echo $this->core->company;?>" name="company">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->CONF_DIR;?></label>
        <input type="text" placeholder="<?php echo Lang::$word->CONF_DIR;?>" value="<?php echo $this->core->site_dir;?>" name="site_dir">
      </div>
      <div class="field five wide">
        <label><?php echo Lang::$word->CONF_EMAIL;?>
          <i class="icon asterisk"></i></label>
        <input type="text" placeholder="<?php echo Lang::$word->CONF_EMAIL;?>" value="<?php echo $this->core->site_email;?>" name="site_email">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field auto">
        <label><?php echo Lang::$word->CONF_LOGO;?></label>
        <input type="file" name="logo" id="logo" class="filestyle" data-input="false">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_DELLOGO;?></label>
        <div class="wojo inline fitted checkbox toggle">
          <input name="dellogo" type="checkbox" value="1" id="dellogo">
          <label for="dellogo"><?php echo Lang::$word->YES;?></label>
        </div>
      </div>
      <div class="field auto">
        <label><?php echo Lang::$word->CONF_LOGOP;?></label>
        <input type="file" name="plogo" id="plogo" class="filestyle" data-input="false">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_DELLOGO;?></label>
        <div class="wojo inline fitted checkbox toggle">
          <input name="dellogop" type="checkbox" value="1" id="dellogop">
          <label for="dellogop"><?php echo Lang::$word->YES;?></label>
        </div>
      </div>
    </div>
    <div class="wojo auto very wide divider"></div>
    <div class="wojo space divider"></div>
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->CONF_LONGDATE;?>
          <i class="icon asterisk"></i></label>
        <select name="long_date">
          <?php echo Date::getLongDate($this->core->long_date);?>
        </select>
      </div>
      <div class="field three wide">
        <label><?php echo Lang::$word->CONF_SHORTDATE;?>
          <i class="icon asterisk"></i></label>
        <select name="short_date">
          <?php echo Date::getShortDate($this->core->short_date);?>
        </select>
      </div>
      <div class="field two wide">
        <label><?php echo Lang::$word->CONF_TIMEFORMAT;?>
          <i class="icon asterisk"></i></label>
        <select name="time_format">
          <?php echo Date::getTimeFormat($this->core->time_format);?>
        </select>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->CONF_WEEKSTART;?></label>
        <select name="weekstart">
          <?php echo Date::weekList(true, true, $this->core->weekstart);?>
        </select>
      </div>
      <div class="field three wide">
        <label><?php echo Lang::$word->CONF_LANG;?></label>
        <select name="lang">
          <?php foreach(Lang::fetchLanguage() as $langlist):?>
          <option value="<?php echo substr($langlist, 0, 2);?>" <?php echo Validator::getSelected($this->core->lang, substr($langlist, 0, 2));?>><?php echo strtoupper(substr($langlist, 0, 2));?></option>
          <?php endforeach;?>
        </select>
      </div>
      <div class="field two wide">
        <label><?php echo Lang::$word->CONF_PERPAGE;?>
          <i class="icon asterisk"></i></label>
        <input type="text" placeholder="<?php echo Lang::$word->CONF_PERPAGE;?>" value="<?php echo $this->core->perpage;?>" name="perpage">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->CONF_DTZ;?></label>
        <select name="dtz">
          <?php echo Date::getTimezones();?>
        </select>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_LOCALES;?></label>
        <select name="locale">
          <?php echo Date::localeList($this->core->locale);?>
        </select>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->CONF_THEME;?></label>
        <select name="theme">
          <?php echo Utility::loopOptionsSimple(File::getThemes(FRONTBASE . "/themes"), $this->core->theme);?>
        </select>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_THEME_COLOR;?></label>
        <select name="color">
          <option value="_default.css"><?php echo Lang::$word->DEFAULT;?></option>
          <?php echo Utility::loopOptionsSimpleMultiple($this->colors, $this->core->color);?>
        </select>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_PLOADER;?></label>
        <div class="wojo checkbox radio inline">
          <input name="ploader" type="radio" value="1" <?php Validator::getChecked($this->core->ploader, 1); ?> id="ploader_1">
          <label for="ploader_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio inline">
          <input name="ploader" type="radio" value="0" <?php Validator::getChecked($this->core->ploader, 0); ?> id="ploader_0">
          <label for="ploader_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_EUCOOKIE;?></label>
        <div class="wojo checkbox radio inline">
          <input name="eucookie" type="radio" value="1" <?php Validator::getChecked($this->core->eucookie, 1); ?> id="eucookie_1">
          <label for="eucookie_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio inline">
          <input name="eucookie" type="radio" value="0" <?php Validator::getChecked($this->core->eucookie, 0); ?> id="eucookie_0">
          <label for="eucookie_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->CONF_LOGIN_ATTEMPT;?></label>
        <input name="attempt" type="range" min="0" max="6" step="1" value="<?php echo $this->core->attempt;?>" hidden data-suffix=" x" data-type="labels" data-labels="0,2,4,6">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_LOGIN_TIME;?></label>
        <input name="flood" type="range" min="5" max="90" step="5" value="<?php echo ($this->core->flood / 60);?>" hidden data-suffix=" min" data-type="labels" data-labels="5,20,50,75,100">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_LOG_ON;?></label>
        <div class="wojo checkbox radio inline">
          <input name="logging" type="radio" value="1" <?php Validator::getChecked($this->core->logging, 1); ?> id="logging_1">
          <label for="logging_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio inline">
          <input name="logging" type="radio" value="0" <?php Validator::getChecked($this->core->logging, 0); ?> id="logging_0">
          <label for="logging_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
  </div>
  <div class="wojo segment form">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->CONF_REGVERIFY;?></label>
        <div class="wojo checkbox radio inline">
          <input name="reg_verify" type="radio" value="1" <?php Validator::getChecked($this->core->reg_verify, 1); ?> id="reg_verify_1">
          <label for="reg_verify_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio inline">
          <input name="reg_verify" type="radio" value="0" <?php Validator::getChecked($this->core->reg_verify, 0); ?> id="reg_verify_0">
          <label for="reg_verify_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_AUTOVERIFY;?></label>
        <div class="wojo checkbox radio inline">
          <input name="auto_verify" type="radio" value="1" <?php Validator::getChecked($this->core->auto_verify, 1); ?> id="auto_verify_1">
          <label for="auto_verify_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio inline">
          <input name="auto_verify" type="radio" value="0" <?php Validator::getChecked($this->core->auto_verify, 0); ?> id="auto_verify_0">
          <label for="auto_verify_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_NOTIFY_ADMIN;?></label>
        <div class="wojo checkbox radio inline">
          <input name="notify_admin" type="radio" value="1" <?php Validator::getChecked($this->core->notify_admin, 1); ?> id="notify_admin_1">
          <label for="notify_admin_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio inline">
          <input name="notify_admin" type="radio" value="0" <?php Validator::getChecked($this->core->notify_admin, 0); ?> id="notify_admin_0">
          <label for="notify_admin_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->CONF_CURRENCY;?></label>
        <input type="text" placeholder="<?php echo Lang::$word->CONF_CURRENCY;?>" value="<?php echo $this->core->currency;?>" name="currency">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_ETAX;?></label>
        <div class="wojo checkbox radio inline">
          <input name="enable_tax" type="radio" value="1" <?php Validator::getChecked($this->core->enable_tax, 1); ?> id="enable_tax_1">
          <label for="enable_tax_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio inline">
          <input name="enable_tax" type="radio" value="0" <?php Validator::getChecked($this->core->enable_tax, 0); ?> id="enable_tax_0">
          <label for="enable_tax_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_HLAYOUT;?></label>
        <div class="wojo checkbox radio inline">
          <input name="home_layout" type="radio" value="1" <?php Validator::getChecked($this->core->home_layout, 1); ?> id="home_layout_1">
          <label for="home_layout_1"><?php echo Lang::$word->GRID;?></label>
        </div>
        <div class="wojo checkbox radio inline">
          <input name="home_layout" type="radio" value="0" <?php Validator::getChecked($this->core->home_layout, 0); ?> id="home_layout_0">
          <label for="home_layout_0"><?php echo Lang::$word->LIST;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_COMMENTS;?></label>
        <div class="wojo checkbox radio inline">
          <input name="enable_comments" type="radio" value="1" <?php Validator::getChecked($this->core->enable_comments, 1); ?> id="enable_comments_1">
          <label for="enable_comments_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio inline">
          <input name="enable_comments" type="radio" value="0" <?php Validator::getChecked($this->core->enable_comments, 0); ?> id="enable_comments_0">
          <label for="enable_comments_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->CONF_FILEDIR;?>
          <i class="icon asterisk"></i></label>
        <input type="text" placeholder="<?php echo Lang::$word->CONF_FILEDIR;?>" value="<?php echo $this->core->file_dir;?>" name="file_dir">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_FREEDOWN;?></label>
        <div class="wojo checkbox radio inline">
          <input name="allow_free" type="radio" value="yes" <?php Validator::getChecked($this->core->allow_free, "yes"); ?> id="allow_free_1">
          <label for="allow_free_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio inline">
          <input name="allow_free" type="radio" value="no" <?php Validator::getChecked($this->core->allow_free, "no"); ?> id="allow_free_0">
          <label for="allow_free_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->CONF_CPERPAGE;?></label>
        <input name="cperpage" type="range" min="2" max="40" step="2" value="<?php echo $this->core->cperpage;?>" hidden data-suffix=" itm" data-type="labels" data-labels="6,12,16,32,40">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CONF_FEATURED;?></label>
        <input name="featured" type="range" min="2" max="20" step="2" value="<?php echo $this->core->featured;?>" hidden data-suffix=" itm" data-type="labels" data-labels="2,6,12,16,20">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->CONF_TH_WH;?>
          <i class="icon asterisk"></i></label>
        <div class="row horizontal gutters">
          <div class="columns">
            <input name="thumb_w" type="range" min="150" max="400" step="50" value="<?php echo $this->core->thumb_w;?>" hidden data-suffix=" px" data-type="labels" data-labels="150,200,250,300,400">
          </div>
          <div class="columns">
            <input name="thumb_h" type="range" min="150" max="400" step="50" value="<?php echo $this->core->thumb_h;?>" hidden data-suffix=" px" data-type="labels" data-labels="150,200,250,300,400">
          </div>
        </div>
      </div>
      <div class="field five wide">
        <label><?php echo Lang::$word->CONF_AV_WH;?>
          <i class="icon asterisk"></i></label>
        <div class="row horizontal gutters">
          <div class="columns">
            <input name="avatar_w" type="range" min="150" max="400" step="50" value="<?php echo $this->core->avatar_w;?>" hidden data-suffix=" px" data-type="labels" data-labels="150,200,250,300,400">
          </div>
          <div class="columns">
            <input name="avatar_h" type="range" min="150" max="400" step="50" value="<?php echo $this->core->avatar_h;?>" hidden data-suffix=" px" data-type="labels" data-labels="150,200,250,300,400">
          </div>
        </div>
      </div>
    </div>
    <div class="wojo very wide auto divider"></div>
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->CONF_TWID;?></label>
        <div class="wojo icon input">
          <input type="text" placeholder="<?php echo Lang::$word->CONF_TWID;?>" value="<?php echo $this->core->social->twitter;?>" name="twitter">
          <i class="icon twitter"></i>
        </div>
      </div>
      <div class="field five wide">
        <label><?php echo Lang::$word->CONF_FBID;?></label>
        <div class="wojo icon input">
          <input type="text" placeholder="<?php echo Lang::$word->CONF_FBID;?>" value="<?php echo $this->core->social->facebook;?>" name="facebook">
          <i class="icon facebook"></i>
        </div>
      </div>
    </div>
  </div>
  <div class="wojo segment form">
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->CONF_INVDATA;?></label>
        <textarea class="altpost" name="inv_info"><?php echo $this->core->inv_info;?></textarea>
      </div>
      <div class="field five wide">
        <label><?php echo Lang::$word->CONF_INVNOTE;?></label>
        <textarea class="altpost" name="inv_note"><?php echo $this->core->inv_note;?></textarea>
      </div>
    </div>
    <div class="wojo very wide auto divider"></div>
    <div class="wojo fields">
      <div class="five wide field">
        <label><?php echo Lang::$word->CONF_OFFLINE_M;?></label>
        <div class="wojo checkbox radio inline">
          <input name="offline" type="radio" value="1" <?php Validator::getChecked($this->core->offline, 1); ?> id="offline_1">
          <label for="offline_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio inline">
          <input name="offline" type="radio" value="0" <?php Validator::getChecked($this->core->offline, 0); ?> id="offline_0">
          <label for="offline_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="five wide field">
        <label><?php echo Lang::$word->CONF_OFFLINE_DT;?></label>
        <div class="wojo icon input">
          <input name="offline_d" type="text" placeholder="<?php echo Lang::$word->CONF_OFFLINE_DT;?>" value="<?php echo Date::doDate("MM/dd/yyyy", $this->core->offline_d);?>" readonly class="datepick">
          <i class="icon date"></i>
          <input name="offline_t" type="text" placeholder="<?php echo Lang::$word->CONF_OFFLINE_DT;?>" value="<?php echo $this->core->offline_t;?>" readonly class="timepick">
          <i class="icon clock"></i>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->CONF_OFFLINE_MS;?></label>
        <textarea class="altpost" name="offline_msg"><?php echo $this->core->offline_msg;?></textarea>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->CONF_GA;?></label>
        <input type="text" placeholder="<?php echo Lang::$word->CONF_GA;?>" value="<?php echo $this->core->analytics;?>" name="analytics">
      </div>
      <div class="field">
      </div>
    </div>
    <div class="wojo very wide auto divider"></div>
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->CONF_MAILER;?></label>
        <select name="mailer" id="mailerchange">
          <option value="SMAIL" <?php echo Validator::getSelected($this->core->mailer, "SMAIL");?>>Sendmail</option>
          <option value="SMTP" <?php echo Validator::getSelected($this->core->mailer, "SMTP");?>>SMTP Mailer</option>
        </select>
      </div>
      <div class="field showsmail<?php echo ($this->core->mailer == "SMAIL") ? '' : ' hide-all';?>">
        <label><?php echo Lang::$word->CONF_SMAILPATH;?></label>
        <input type="text" placeholder="<?php echo Lang::$word->CONF_SMAILPATH;?>" value="<?php echo $this->core->sendmail;?>" name="sendmail">
      </div>
    </div>
    <div class="showsmtp<?php echo ($this->core->mailer == "SMTP") ? '' : ' hide-all';?>">
      <div class="wojo fields">
        <div class="field five wide">
          <label><?php echo Lang::$word->CONF_SMTP_HOST;?>
            <i class="icon asterisk"></i></label>
          <input type="text" placeholder="<?php echo Lang::$word->CONF_SMTP_HOST;?>" value="<?php echo $this->core->smtp_host;?>" name="smtp_host">
        </div>
        <div class="field five wide">
          <label><?php echo Lang::$word->CONF_SMTP_USER;?></label>
          <input type="text" placeholder="<?php echo Lang::$word->CONF_SMTP_USER;?>" value="<?php echo $this->core->smtp_user;?>" name="smtp_user">
        </div>
      </div>
      <div class="wojo fields">
        <div class="field three wide">
          <label><?php echo Lang::$word->CONF_SMTP_PASS;?></label>
          <input type="text" placeholder="<?php echo Lang::$word->CONF_SMTP_PASS;?>" value="<?php echo $this->core->smtp_pass;?>" name="smtp_pass">
        </div>
        <div class="field three wide">
          <label><?php echo Lang::$word->CONF_SMTP_PORT;?></label>
          <input type="text" placeholder="<?php echo Lang::$word->CONF_SMTP_PORT;?>" value="<?php echo $this->core->smtp_port;?>" name="smtp_port">
        </div>
        <div class="field four wide">
          <label><?php echo Lang::$word->CONF_SMTP_SSL;?></label>
          <div class="wojo checkbox radio inline">
            <input name="is_ssl" type="radio" value="1" <?php Validator::getChecked($this->core->is_ssl, 1); ?> id="is_ssl_1">
            <label for="is_ssl_1">SSL</label>
          </div>
          <div class="wojo checkbox radio inline">
            <input name="is_ssl" type="radio" value="0" <?php Validator::getChecked($this->core->is_ssl, 0); ?> id="is_ssl_0">
            <label for="is_ssl_0">TLS</label>
          </div>
        </div>
      </div>
    </div>
    <div class="center aligned">
      <button type="button" data-action="processConfig" name="dosubmit" class="wojo secondary button"><?php echo Lang::$word->CONF_UPDATE;?></button>
    </div>
  </div>
</form>
<script type="text/javascript"> 
// <![CDATA[  
$(document).ready(function () {
     $('#mailerchange').change(function () {
         var val = $("#mailerchange option:selected").val();
		 if(val === "SMTP") {
			 $('.showsmtp').show() ;
			 $('.showsmail').hide();
		 } else  {
			 $('.showsmtp').hide() ;
			 $('.showsmail').show();
		 }
     });
});
// ]]>
</script>