<?php
  /**
   * Core Class
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2016
   * @version $Id: core.class.php, v1.00 2016-06-05 10:12:05 gewa Exp $
   */

  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');

  class Core
  {

      const sTable = "settings";
	  const txTable = "trash";
	  const gTable = "gateways";
	  const cjTable = "cronjobs";
	  
      public static $language;

      /**
       * Core::__construct()
       * 
       * @return
       */
      public function __construct()
      {
          $this->getSettings();
          ($this->dtz) ? ini_set('date.timezone', $this->dtz) : date_default_timezone_set('UTC');
		  Locale::setDefault($this->locale);
      }

      /**
       * Core::Index()
       * 
       * @return
       */
      public function Index()
      {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->crumbs = ['admin', Lang::$word->META_SETTINGS];
		  $tpl->template = 'admin/configuration.tpl.php';
		  $tpl->title = Lang::$word->META_M_SETTINGS; 
		  $colors = File::findFiles(THEMEBASE . '/css/colors/', array('fileTypes'=>array('css'), 'level' => 1));
		  $values = array_map(function($e) {
			  return ucfirst(substr($e, 1, -4));
		  }, $colors);
		  
		  $tpl->colors = array_combine($colors, $values);

      }
	  
      /**
       * Core::getSettings()
       * 
       * @return
       */
      private function getSettings()
      {
          $row = Db::run()->select(self::sTable, null, array('id' => 1))->result();

          $this->site_name = $row->site_name;
		  $this->company = $row->company;
          $this->site_dir = $row->site_dir;
          $this->site_email = $row->site_email;
          $this->logo = $row->logo;
		  $this->plogo = $row->plogo;
          $this->short_date = $row->short_date;
          $this->long_date = $row->long_date;
          $this->time_format = $row->time_format;
          $this->dtz = $row->dtz;
          $this->locale = $row->locale;
          $this->lang = $row->lang;
          $this->weekstart = $row->weekstart;
          $this->theme = $row->theme;
		  $this->color = $row->color;
          $this->perpage = $row->perpage;
		  $this->ploader = $row->ploader;

          $this->offline = $row->offline;
          $this->offline_msg = $row->offline_msg;
          $this->offline_d = $row->offline_d;
          $this->offline_t = $row->offline_t;
          $this->eucookie = $row->eucookie;
          $this->backup = $row->backup;
          $this->currency = $row->currency;
          $this->file_dir = $row->file_dir;
		  $this->featured = $row->featured;
		  $this->cperpage = $row->cperpage;
		  $this->home_layout = $row->home_layout;
		  
		  $this->avatar_w = $row->avatar_w;
		  $this->avatar_h = $row->avatar_h;
		  $this->thumb_h = $row->thumb_h;
		  $this->thumb_w = $row->thumb_w;
		  
		  $this->enable_tax = $row->enable_tax;
		  
		  $this->reg_verify = $row->reg_verify;
		  $this->auto_verify = $row->auto_verify;
		  $this->notify_admin = $row->notify_admin;
		  $this->allow_free = $row->allow_free;
		  $this->enable_comments = $row->enable_comments;

          $this->mailer = $row->mailer;
          $this->smtp_host = $row->smtp_host;
          $this->smtp_user = $row->smtp_user;
          $this->smtp_pass = $row->smtp_pass;
          $this->smtp_port = $row->smtp_port;
          $this->sendmail = $row->sendmail;
          $this->is_ssl = $row->is_ssl;
		  
		  $this->social = json_decode($row->social_media);
		  //$this->mapapi = $row->mapapi;
		  $this->analytics = $row->analytics;

		  $this->flood = $row->flood;
		  $this->attempt = $row->attempt;
		  $this->logging = $row->logging;
		  
		  $this->inv_info = $row->inv_info;
		  $this->inv_note = $row->inv_note;
		  
          $this->wojov = $row->wojov;
          $this->wojon = $row->wojon;

      }

      /**
       * Core::processConfig()
       * 
       * @return
       */
      public function processConfig()
      {

		  $rules = array(
			  'site_name' => array('required|string|min_len,2|max_len,80', Lang::$word->CONF_SITE),
			  'company' => array('required|string|min_len,2|max_len,80', Lang::$word->CONF_COMPANY),
			  'site_email' => array('required|email', Lang::$word->CONF_EMAIL),
			  'theme' => array('required|string', Lang::$word->CONF_THEME),
			  'color' => array('required|string', Lang::$word->CONF_THEME_COLOR),
			  'perpage' => array('required|numeric', Lang::$word->CONF_PERPAGE),
			  'thumb_w' => array('required|numeric', Lang::$word->CONF_TH_WH),
			  'thumb_h' => array('required|numeric', Lang::$word->CONF_TH_WH),
			  'avatar_w' => array('required|numeric', Lang::$word->CONF_AV_WH),
			  'avatar_h' => array('required|numeric', Lang::$word->CONF_AV_WH),
			  'long_date' => array('required|string', Lang::$word->CONF_LONGDATE),
			  'short_date' => array('required|string', Lang::$word->CONF_SHORTDATE),
			  'time_format' => array('required|string', Lang::$word->CONF_TIMEFORMAT),
			  'dtz' => array('required|string', Lang::$word->CONF_DTZ),
			  'locale' => array('required|string', Lang::$word->CONF_LOCALES),
			  'weekstart' => array('required|numeric', Lang::$word->CONF_WEEKSTART),
			  'lang' => array('required|string|min_len,2|max_len,2', Lang::$word->CONF_LANG),
			  'ploader' => array('required|numeric', Lang::$word->CONF_PLOADER),
			  'file_dir' => array('required|string', Lang::$word->CONF_FILEDIR),
			  'featured' => array('required|numeric', Lang::$word->CONF_FEATURED),
			  'cperpage' => array('required|numeric', Lang::$word->CONF_CPERPAGE),
			  'home_layout' => array('required|numeric', Lang::$word->CONF_HLAYOUT),
			  'eucookie' => array('required|numeric', Lang::$word->CONF_EUCOOKIE),
			  'offline' => array('required|numeric', Lang::$word->CONF_OFFLINE_M),
			  'offline_d_submit' => array('required|date', Lang::$word->CONF_OFFLINE_DT),
			  'offline_t' => array('required|date', Lang::$word->CONF_OFFLINE_DT),
			  'currency' => array('required|string|min_len,3|max_len,6', Lang::$word->CONF_CURRENCY),
			  'enable_tax' => array('required|numeric', Lang::$word->CONF_ETAX),
			  'reg_verify' => array('required|numeric', Lang::$word->CONF_REGVERIFY),
			  'auto_verify' => array('required|numeric', Lang::$word->CONF_AUTOVERIFY),
			  'notify_admin' => array('required|numeric', Lang::$word->CONF_NOTIFY_ADMIN),
			  'allow_free' => array('required|string', Lang::$word->CONF_FREEDOWN),
			  'flood' => array('required|numeric|min_len,1|max_len,3', Lang::$word->CONF_LOGIN_TIME),
			  'attempt' => array('required|numeric|min_len,1|max_len,1', Lang::$word->CONF_LOGIN_ATTEMPT),
			  'logging' => array('required|numeric', Lang::$word->CONF_LOG_ON),
			  'enable_comments' => array('required|numeric', Lang::$word->CONF_COMMENTS),
			  'mailer' => array('required|string|min_len,3|max_len,5', Lang::$word->CONF_MAILER),
			  'is_ssl' => array('required|numeric', Lang::$word->CONF_SMTP_SSL),
			  //'mapapi' => array('required|string', Lang::$word->CONF_GMAPKEY),
			  );
	
		  $filters = array(
		      'site_dir' => 'string',
			  'site_name' => 'string',
			  'company' => 'string',
			  'twitter' => 'string',
			  'facebook' => 'string',
			  'inv_info' => 'basic_tags',
			  'inv_note' => 'basic_tags',
			  //'offline_info' => 'basic_tags',
			  'offline_msg' => 'basic_tags',
			  'offline_d_submit' => 'string',
			  'offline_t' => 'string',
			  'analytics' => 'basic_tags',
			  );

  		switch ($_POST['mailer']) {
  			case "SMTP":
  				$rules['smtp_host'] = ['required|string', Lang::$word->CONF_SMTP_HOST];
				$rules['smtp_user'] = ['required|string', Lang::$word->CONF_SMTP_USER];
				$rules['smtp_pass'] = ['required|string', Lang::$word->CONF_SMTP_PASS];
				$rules['smtp_port'] = ['required|numeric', Lang::$word->CONF_SMTP_PORT];
  				break;

  			case "SMAIL":
  				$rules['sendmail'] = ['required|string', Lang::$word->CONF_SMAILPATH];
  				break;
  		}
		
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);

		  if (!empty($_FILES['logo']['name']) and empty(Message::$msgs)) {
			  $upl = Upload::instance(3145728, "png,jpg,svg");
			  $upl->process("logo", UPLOADS . "/", false, "logo", false);
		  }

		  if (!empty($_FILES['plogo']['name']) and empty(Message::$msgs)) {
			  $upl = Upload::instance(3145728, "png,jpg");
			  $upl->process("plogo", UPLOADS . "/", false, "print_logo", false);
		  }
		  
		  if (empty(Message::$msgs)) {
			  $smedia['facebook'] = $safe->facebook;
			  $smedia['twitter'] = $safe->twitter;
			  
			  $data = array(
				  'site_name' => $safe->site_name,
				  'company' => $safe->company,
				  'site_email' => $safe->site_email,
				  'site_dir' => $safe->site_dir,
				  'theme' => $safe->theme,
				  'color' => $safe->color,
				  'perpage' => $safe->perpage,
				  'thumb_w' => $safe->thumb_w,
				  'thumb_h' => $safe->thumb_h,
				  'avatar_w' => $safe->avatar_w,
				  'avatar_h' => $safe->avatar_h,
				  'long_date' => $safe->long_date,
				  'short_date' => $safe->short_date,
				  'time_format' => $safe->time_format,
				  'weekstart' => $safe->weekstart,
				  'file_dir' => $safe->file_dir,
				  'lang' => $safe->lang,
				  'dtz' => $safe->dtz,
				  'locale' => $safe->locale,
				  'ploader' => $safe->ploader,
				  'featured' => $safe->featured,
				  'cperpage' => $safe->cperpage,
				  'home_layout' => $safe->home_layout,
				  'eucookie' => $safe->eucookie,
				  'offline' => $safe->offline,
				  'offline_msg' => $safe->offline_msg,
				  'offline_d' => Db::toDate($safe->offline_d_submit),
				  'offline_t' => $safe->offline_t,
				  'currency' => $safe->currency,
				  'enable_tax' => $safe->enable_tax,
				  'reg_verify' => $safe->reg_verify,
				  'auto_verify' => $safe->auto_verify,
				  'notify_admin' => $safe->notify_admin,
				  'allow_free' => $safe->allow_free,
				  'enable_comments' => $safe->enable_comments,
				  'flood' => ($safe->flood * 60),
				  'attempt' => $safe->attempt,
				  'logging' => $safe->logging,
				  'analytics' => $safe->analytics,
				  'mailer' => $safe->mailer,
				  'sendmail' => $safe->sendmail,
				  'smtp_host' => $safe->smtp_host,
				  'smtp_user' => $safe->smtp_user,
				  'smtp_pass' => $safe->smtp_pass,
				  'smtp_port' => $safe->smtp_port,
				  'is_ssl' => $safe->is_ssl,
				  'inv_info' => $safe->inv_info,
				  'inv_note' => $safe->inv_note,
				  'social_media' => json_encode($smedia),
				  //'mapapi' => $safe->mapapi,
				  );

			  if (!empty($_FILES['logo']['name'])) {
				  $data['logo'] = $upl->fileInfo['fname'];
			  }
			  
			  if (!empty($_FILES['plogo']['name'])) {
				  $data['plogo'] = $upl->fileInfo['fname'];
			  }
			  
			  if (Validator::post('dellogo')) {
				  $data['logo'] = "NULL";
			  }
			  if (Validator::post('dellogop')) {
				  $data['plogo'] = "NULL";
			  }
			  
			  Db::run()->update(self::sTable, $data, array('id' => 1));
			  Message::msgReply(true, 'success', Lang::$word->CONF_UPDATE_OK);
		  } else {
			  Message::msgSingleStatus();
		  }
      }
	  
      /**
       * Core::restoreFromTrash()
       *
       * @return
       */
      public static function restoreFromTrash($array, $table)
      {
          if ($array) {
              $mapped = array_map(function($k) {
				  return "`".$k."` = ?";
				  },array_keys((array)$array
				  ));
              $stmt = Db::run()->prepare("INSERT INTO `" . $table . "` SET ".implode(", ",$mapped));
              $stmt->execute(array_values((array)$array));
			  
              $json['type'] = "success";
              print json_encode($json);
          }
      }
	  
      /**
       * Core::Colors()
       * 
       * @return
       */
	  public static function Colors()
	  {
	
		  if (isset($_COOKIE['COLOR_DDP'])) {
			  $file = Validator::sanitize($_COOKIE['COLOR_DDP'], "string", 12);
	
			  if (file_exists(THEMEBASE . '/css/colors/' . $file)) {
				  $html = '<link id="styler" href="' . THEMEURL . '/css/colors/' . $file . '" rel="stylesheet" type="text/css">';
			  } else {
				  $html = '<link id="styler" href="' . THEMEURL . '/css/_default.css" rel="stylesheet" type="text/css">';
			  }
		  } else {
			  if (App::Core()->color == "_default.css") {
				  $html = '<link id="styler" href="' . THEMEURL . '/css/_default.css" rel="stylesheet" type="text/css">';
			  } else {
				  $html = '<link id="styler" href="' . THEMEURL . '/css/colors/_' . strtolower(App::Core()->color) . '.css" rel="stylesheet" type="text/css">';
			  }
		  }
		  return $html;
	  }
  }