<?php

  /**
   * Front Class
   *
   * package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2016
   * @version $Id: front.class.php, v1.00 2016-04-20 18:20:24 gewa Exp $
   */

  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');

  class Front
  {
	  

      /**
       * Front::Index()
       * 
       * @return
       */
      public function Index()
      {
		  $core = App::Core();
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "front/themes/" . $core->theme . "/";
		  $tpl->template = 'front/themes/' . $core->theme . '/index.tpl.php';
          $tpl->title = str_replace("[COMPANY]", $core->company, Lang::$word->META_WELCOME);
		  
		  $array = App::Product()->Front();
		  $tpl->special = ($array) ? array_slice($array, 0, 2) : null;
		  $tpl->featured = ($array) ? array_slice($array, 2) : null;
		  $tpl->home = Db::run()->first(Content::pTable, array("title","body", "keywords", "description"), array("page_type" => "home", "active" => 1));
		  $tpl->keywords = $tpl->home->keywords;
		  $tpl->description = $tpl->home->description;
		  
      }
	  
      /**
       * Front::Login()
       * 
       * @return
       */
      public function Login()
      {
		  if (App::Auth()->is_User()) {
			  Url::redirect(URL::url('/dashboard')); 
			  exit; 
		  }
		  $core = App::Core();
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "front/themes/" . $core->theme . "/";
		  $tpl->template = 'front/themes/' . $core->theme . '/login.tpl.php';
		  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), Lang::$word->META_M_LOGIN];
          $tpl->title = Lang::$word->META_M_LOGIN . ' - ' . $core->company;
		  $tpl->keywords = '';
		  $tpl->description = '';
      }
	  
      /**
       * Front::Register()
       * 
       * @return
       */
      public function Register()
      {
		  if (App::Auth()->is_User()) {
			  Url::redirect(URL::url('/dashboard')); 
			  exit; 
		  }
		  $core = App::Core();
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "front/themes/" . $core->theme . "/";
		  $tpl->template = 'front/themes/' . $core->theme . '/register.tpl.php';
		  $tpl->custom_fields = Content::rendertCustomFieldsFront("", "profile");
		  $tpl->clist = $core->enable_tax ? App::Content()->getCountryList() : '';
		  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), Lang::$word->META_M_REGISTER];
          $tpl->title = Lang::$word->META_M_REGISTER . ' - ' . $core->company;
		  $tpl->keywords = '';
		  $tpl->description = '';
      }

      /**
       * Front::Registration()
       * 
       * @return
       */
      public function Registration()
      {
		  $rules = array(
			  'fname' => array('required|string|min_len,3|max_len,60', Lang::$word->FNAME),
			  'lname' => array('required|string|min_len,3|max_len,60', Lang::$word->LNAME),
			  'password' => array('required|string|min_len,6|max_len,20', Lang::$word->PASSWORD),
			  'email' => array('required|email', Lang::$word->EMAIL),
			  'agree' => array('required|numeric', Lang::$word->PRIVACY),
			  'captcha' => array('required|numeric|exact_len,5', Lang::$word->CAPTCHA),
			  );
			  
	      if(App::Core()->enable_tax) {
			  $rules['address'] = array('required|string|min_len,3|max_len,80', Lang::$word->ADDRESS);
			  $rules['city'] = array('required|string|min_len,2|max_len,80', Lang::$word->CITY);
			  $rules['zip'] = array('required|string|min_len,3|max_len,30', Lang::$word->ZIP);
			  $rules['state'] = array('required|string|min_len,2|max_len,80', Lang::$word->STATE);
			  $rules['country'] = array('required|string|exact_len,2', Lang::$word->COUNTRY);
		  }
			  
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);

		  if (App::Session()->get('wcaptcha') != $_POST['captcha']) {
			  Message::$msgs['captcha'] = Lang::$word->CAPTCHA;
		  }
			  
          if (!empty($safe->email)) {
			  if (Auth::emailExists($safe->email))
              Message::$msgs['email'] = Lang::$word->EMAIL_R2;
		  }
		  
		  Content::verifyCustomFields("profile");
		  
          if (empty(Message::$msgs)) {
              $salt = '';
			  $hash = App::Auth()->create_hash(Validator::cleanOut($_POST['password']), $salt);
			  $username = Utility::randomString();
			  $core = App::Core();

              if ($core->reg_verify == 1) {
                  $active = "t";
              } elseif ($core->auto_verify == 0) {
                  $active = "n";
              } else {
                  $active = "y";
              }
			  
              $data = array(
                  'username' => $username,
				  'email' => $safe->email,
                  'lname' => $safe->lname,
				  'fname' => $safe->fname,
                  'hash' => $hash,
                  'salt' => $salt,
                  'type' => "member",
				  'token' => Utility::randNumbers(),
				  'active' => $active,
                  'userlevel' => 1,
				  );
				  
			  if(App::Core()->enable_tax) {
				  $data['address'] = $safe->address;
				  $data['city'] = $safe->city;
				  $data['state'] = $safe->state;
				  $data['zip'] = $safe->zip;
				  $data['country'] = $safe->country;
			  }

			  $last_id = Db::run()->insert(Users::mTable, $data)->getLastInsertId();
			  
			  // Start Custom Fields
			  $fl_array = Utility::array_key_exists_wildcard($_POST, 'custom_*', 'key-value');
			  if ($fl_array) {
				  $fields = Db::run()->select(Content::cfTable, null, array("section" => "profile"))->results();
				  foreach ($fields as $row) {
					  $dataArray[] = array(
						  'user_id' => $last_id,
						  'field_id' => $row->id,
						  'field_name' => $row->name,
						  'section' => "profile",
						  );
				  }
				  Db::run()->insertBatch(Content::cfdTable, $dataArray);
				  
				  foreach ($fl_array as $key => $val) {
					  $cfdata['field_value'] = Validator::sanitize($val);
					  Db::run()->update(Content::cfdTable, $cfdata, array("user_id" => $last_id, "field_name" => str_replace("custom_", "", $key)));
				  }
			  }
				  
			  if ($core->reg_verify == 1) {
				  $message = Lang::$word->MSG_INFO01;
				  $json['redirect'] = Url::url('/login');
				  
				  $mailer = Mailer::sendMail();
				  $tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'regMail'));
				  $body = str_replace(array(
					  '[LOGO]',
					  '[CEMAIL]',
					  '[DATE]',
					  '[COMPANY]',
					  '[EMAIL]',
					  '[NAME]',
					  '[USERNAME]',
					  '[PASSWORD]',
					  '[LINK]',
					  '[FB]',
					  '[TW]',
					  '[SITEURL]'), array(
					  Utility::getLogo(),
					  $core->site_email,
					  date('Y'),
					  $core->company,
					  $data['email'],
					  $data['fname'] . ' ' . $data['lname'],
					  $username,
					  $safe->password,
					  Url::url("/activation", '?token=' . $data['token'] . '&email=' . $data['email']),
					  $core->social->facebook,
					  $core->social->twitter,
					  SITEURL), $tpl->body);
		
				  $msg = (new Swift_Message())
						->setSubject($tpl->subject)
						->setFrom(array($core->site_email => $core->company))
						->setTo(array($data['email'] => $data['fname'] . ' ' . $data['lname']))
						->setBody($body, 'text/html'
						);
				  $mailer->send($msg);
				  
			  } elseif ($core->auto_verify == 0) {
				  $message = Lang::$word->MSG_INFO01;
				  $json['redirect'] = Url::url('/login');
				  
				  $mailer = Mailer::sendMail();
				  $tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'regMailPending'));
				  $body = str_replace(array(
					  '[LOGO]',
					  '[CEMAIL]',
					  '[DATE]',
					  '[COMPANY]',
					  '[USERNAME]',
					  '[NAME]',
					  '[EMAIL]',
					  '[PASSWORD]',
					  '[FB]',
					  '[TW]',
					  '[SITEURL]'), array(
					  Utility::getLogo(),
					  $core->site_email,
					  date('Y'),
					  $core->company,
					  $username,
					  $data['fname'] . ' ' . $data['lname'],
					  $safe->email,
					  $safe->password,
					  $core->social->facebook,
					  $core->social->twitter,
					  SITEURL), $tpl->body);
		
				  $msg = (new Swift_Message())
						->setSubject($tpl->subject)
						->setFrom(array($core->site_email => $core->company))
						->setTo(array($data['email'] => $data['fname'] . ' ' . $data['lname']))
						->setBody($body, 'text/html'
						);
				  $mailer->send($msg);
			  } else {
				  //login user
				  App::Auth()->login($safe->email, $safe->password, true);
				  $message = Lang::$word->MSG_INFO02;
				  $json['redirect'] = Url::url('/dashboard');
				  
				  $mailer = Mailer::sendMail();
				  $tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'welcomeEmail'));
				  $body = str_replace(array(
					  '[LOGO]',
					  '[CEMAIL]',
					  '[DATE]',
					  '[LINK]',
					  '[COMPANY]',
					  '[USERNAME]',
					  '[NAME]',
					  '[EMAIL]',
					  '[PASSWORD]',
					  '[FB]',
					  '[TW]',
					  '[SITEURL]'), array(
					  Utility::getLogo(),
					  $core->site_email,
					  date('Y'),
					  Url::url('/login'),
					  $core->company,
					  $username,
					  $data['fname'] . ' ' . $data['lname'],
					  $safe->email,
					  $safe->password,
					  $core->social->facebook,
					  $core->social->twitter,
					  SITEURL), $tpl->body);
		
				  $msg = (new Swift_Message())
						->setSubject($tpl->subject)
						->setFrom(array($core->site_email => $core->company))
						->setTo(array($data['email'] => $data['fname'] . ' ' . $data['lname']))
						->setBody($body, 'text/html'
						);
				  $mailer->send($msg);
			  }
			  
			  if ($core->notify_admin) {
				  $mailer = Mailer::sendMail();
				  $tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'notifyAdmin'));
				  $body = str_replace(array(
					  '[LOGO]',
					  '[CEMAIL]',
					  '[DATE]',
					  '[EMAIL]',
					  '[COMPANY]',
					  '[NAME]',
					  '[IP]',
					  '[FB]',
					  '[TW]',
					  '[SITEURL]'), array(
					  Utility::getLogo(),
					  $core->site_email,
					  date('Y'),
					  $safe->email,
					  $core->company,
					  $data['fname'] . ' ' . $data['lname'],
					  Url::getIP(),
					  $core->social->facebook,
					  $core->social->twitter,
					  SITEURL), $tpl->body);
		
				  $msg = (new Swift_Message())
						->setSubject($tpl->subject)
						->setFrom(array($core->site_email => $core->company))
						->setTo(array($core->site_email => $core->company))
						->setBody($body, 'text/html'
						);
				  $mailer->send($msg);
			  }
			  
              if ($mailer) {
				  $json['type'] = 'success';
				  $json['title'] = Lang::$word->SUCCESS;
				  $json['message'] = $message;
				  print json_encode($json);
			  } else {
				  $json['type'] = 'error';
				  $json['title'] = Lang::$word->ERROR;
				  $json['message'] = Lang::$word->MSG_INFO06;
				  print json_encode($json);
			  }
				  
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Front::Password()
       * 
	   * @param string $token
       * @return
       */
      public function Password($token)
      {

		  if (App::Auth()->is_User()) {
			  Url::redirect(URL::url('/dashboard')); 
			  exit; 
		  }
		  $core = App::Core();
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "front/themes/" . $core->theme . "/";
		  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), Lang::$word->META_M_REGISTER];
          $tpl->title = Lang::$word->META_M_PASSRESET . ' - ' . $core->company;
		  $tpl->keywords = '';
		  $tpl->description = '';
		  
		  
          if (!$row = Db::run()->first(Users::mTable, null, array("token" => $token))) {
			  $tpl->title = Lang::$word->META_ERROR; 
              $tpl->template = "front/404.tpl.php"; 
              DEBUG ? Debug::AddMessage("errors", '<i>ERROR</i>', "Invalid token detected [front.class.php, ln.:" . __line__ . "] slug [" . $token ."]", "session") : Lang::$word->META_ERROR;
          } else {
			  $tpl->row = $row;
		      $tpl->template = 'front/themes/' . $core->theme . '/password.tpl.php';
          }
      }

      /**
       * Front::passwordChange()
       * 
       * @return
       */
      public function passwordChange()
      {
		  
		  $rules = array(
		      'token' => array('required|string|min_len,10|max_len,10', "Invalid Token"),
			  'password' => array('required|string|min_len,6|max_len,20', Lang::$word->NEWPASS),
			  );

		  $filters = array(
			  'token' => 'string',
		  );
			  
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);

		  if(!$row = Db::run()->first(Users::mTable, array("id", "type"), array('token' => $safe->token))) {
			  Message::$msgs['token'] = "Invalid Token.";
			  $json['title'] = Lang::$word->ERROR;
			  $json['message'] = "Invalid Token.";
			  $json['type'] = 'error';
		  }
		  
		  if (empty(Message::$msgs)) {
              $salt = '';
			  $hash = App::Auth()->create_hash(Validator::cleanOut($safe->password), $salt);
			  
			  $data = array(
					'hash' => $hash, 
					'salt' => $salt,
					'token' => 0,
			  );
			  
			  Db::run()->update(Users::mTable, $data, array("id" => $row->id));
			  $json['type'] = "success";
			  $json['title'] = Lang::$word->SUCCESS;
			  $json['redirect'] = ($row->type == "member") ? Url::url('/login') : Url::url('/admin');
			  $json['message'] = Lang::$word->USR_PASSUPDATE_OK2;
			  print json_encode($json);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }
	  
      /**
       * Front::passReset()
       * 
       * @return
       */
      public function passReset()
      {
		  
          $rules = array(
              'email' => array('required|email', Lang::$word->EMAIL),
              );

		  
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);

		  if(!empty($safe->email)) {
			  $row = Db::run()->first(Users::mTable, array("email", "fname", "lname", "id"), array('email' => $safe->email, "type" => "member", "active" => "y"));
			  if(!$row) {
				  Message::$msgs['email'] = Lang::$word->LOGIN_R5;
				  $json['title'] = Lang::$word->ERROR;
				  $json['message'] = Lang::$word->LOGIN_R5;
				  $json['type'] = 'error';
			  }
		  }
		  
          if (empty(Message::$msgs)) {
			  $row = Db::run()->first(Users::mTable, array("email", "fname", "lname", "id"), array('email' => $safe->email, "type" => "member", "active" => "y"));
			  $mailer = Mailer::sendMail();
			  $tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'userPassReset'));
			  $core = App::Core();
			  $token = substr(md5(uniqid(rand(), true)), 0, 10);
			  
			  $body = str_replace(array(
				  '[LOGO]',
				  '[CEMAIL]',
				  '[NAME]',
				  '[DATE]',
				  '[COMPANY]',
				  '[LINK]',
				  '[IP]',
				  '[FB]',
				  '[TW]',
				  '[CEMAIL]',
				  '[SITEURL]'), array(
				  Utility::getLogo(),
				  $core->site_email,
				  $row->fname . ' ' . $row->lname,
				  date('Y'),
				  $core->company,
				  Url::url('/password', $token),
				  Url::getIP(),
				  $core->social->facebook,
				  $core->social->twitter,
				  $core->site_email,
				  SITEURL), $tpl->body);
				  
				  $msg = (new Swift_Message())
						->setSubject($tpl->subject)
						->setFrom(array($core->site_email => $core->company))
						->setTo(array($row->email => $row->fname . ' ' . $row->lname))
						->setBody($body, 'text/html');
					  
              Db::run()->update(Users::mTable, array("token" => $token), array('id' => $row->id));
			  if($mailer->send($msg)) {
				  $json['type'] = "success";
				  $json['title'] = Lang::$word->SUCCESS;
				  $json['message'] = Lang::$word->PASSWORD_RES_D;
				  print json_encode($json);
			  }
		  } else {
			  $json['type'] = "error";
			  $json['title'] = Lang::$word->ERROR;
			  $json['message'] = Message::msgSingleStatus(false);
			  print json_encode($json);
		  } 
      }
	  
      /**
       * Front::Page()
       * 
	   * @param string $slug
       * @return
       */
	  public function Page($slug)
	  {
		  $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "front/themes/" . App::Core()->theme . "/";
		  $tpl->title = str_replace("[COMPANY]", App::Core()->company, Lang::$word->META_WELCOME);
		  $tpl->keywords = null;
	      $tpl->description = null;
	
		  if (!$row = Db::run()->first(Content::pTable, null, array("slug" => $slug, "active" => 1))) {
			  $tpl->template = 'front/themes/' . App::Core()->theme . '/404.tpl.php';
			  DEBUG ? Debug::AddMessage("errors", '<i>ERROR</i>', "Invalid page detected [front.class.php, ln.:" . __line__ . "] slug ['<b>" . $slug ."</b>']") : Lang::$word->META_ERROR;
		  } else {
			  $tpl->row = $row;
			  if($row->page_type == "faq") {
				 $tpl->questions = Db::run()->select(Content::fTable, null, null, 'ORDER BY sorting')->results();
			  }
			  if($row->page_type == "membership") {
				 $tpl->packages = Db::run()->select(Content::mxTable, null, array("active" => 1, "private" => 0), 'ORDER BY price')->results();
			  }
			  $tpl->title = Url::formatMeta($tpl->row->title);
			  $tpl->keywords = $row->keywords;
			  $tpl->description = $row->description;
			  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), $row->title];
			  $tpl->template = 'front/themes/' . App::Core()->theme . '/page.tpl.php';
		  }
	  }
	  
      /**
       * Front::processContact()
       * 
       * @return
       */
      public function processContact()
      {
		  $rules = array(
			  'name' => array('required|string|min_len,2|max_len,60', Lang::$word->NAME),
			  'notes' => array('required|string|min_len,3|max_len,400', Lang::$word->MESSAGE),
			  'email' => array('required|email', Lang::$word->EMAIL),
			  'slug' => array('required|string', "Invalid Page Detected"),
			  'captcha' => array('required|numeric|exact_len,5', Lang::$word->CAPTCHA),
			  );

		  $filters = array(
			  'notes' => 'trim|string',
			  );
			  
		  if(empty($_POST['front'])) {
			  if (App::Session()->get('wcaptcha') != $_POST['captcha']) {
				  Message::$msgs['captcha'] = Lang::$word->CAPTCHA;
			  }
		  }
		  
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
          if (empty(Message::$msgs)) {
			  $tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'contact'));
			  $mailer = Mailer::sendMail();
			  $core = App::Core();

			  $body = str_replace(array(
				  '[LOGO]',
				  '[CEMAIL]',
				  '[EMAIL]',
				  '[NAME]',
				  '[MESSAGE]',
				  '[IP]',
				  '[DATE]',
				  '[COMPANY]',
				  '[FB]',
				  '[TW]',
				  '[SITEURL]'), array(
				  Utility::getLogo(),
				  $core->site_email,
				  $safe->email,
				  $safe->name,
				  $safe->notes,
				  Url::getIP(),
				  date('Y'),
				  $core->company,
				  $core->social->facebook,
				  $core->social->twitter,
				  SITEURL), $tpl->body);
	
			  $msg = (new Swift_Message())
					->setSubject($tpl->subject)
					->setFrom(array($core->site_email => $core->company))
					->setTo(array($core->site_email => $core->company))
					->setReplyTo(array($safe->email => $safe->name))
					->setBody($body, 'text/html');

              if ($mailer->send($msg)) {
				  $json['type'] = 'success';
				  $json['title'] = Lang::$word->SUCCESS;
				  if(empty($_POST['front'])) {
					 $json['redirect'] = Url::url('/content/' . $safe->slug); 
				  }
				  $json['message'] = Lang::$word->CONTACT_OK;
				  print json_encode($json);
			  } else {
				  $json['type'] = 'error';
				  $json['title'] = Lang::$word->ERROR;
				  $json['message'] = Lang::$word->CONTACT_ERR;
				  print json_encode($json);
			  }
			  
		  } else {
			  Message::msgSingleStatus();
		  }
	  }
	  
      /**
       * Front::Wishlist()
       * 
       * @return
       */
      public function Wishlist()
      {

		  $core = App::Core();
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "front/themes/" . $core->theme . "/";
		  $tpl->data = null;
		  if (App::Auth()->is_User()) {
			  $sql = "
			  SELECT 
				m.id,
				m.title,
				m.slug,
				m.thumb,
				m.is_sale,
				m.price,
				m.sprice,
				m.type,
				m.token,
				m.affiliate,
				m.type,
				m.membership_id,
				GROUP_CONCAT(mx.title SEPARATOR ', ') AS memberships
			  FROM
				`" . Content::wTable . "` AS w 
				LEFT JOIN `" . Product::mTable . "` AS m 
				  ON m.id = w.product_id 
				LEFT JOIN `" . Content::mxTable . "` AS mx 
				  ON FIND_IN_SET(mx.id, m.membership_id)
			  WHERE m.active = ?
			  AND w.user_id = ?
			  GROUP BY m.id
			  ORDER BY m.created DESC;"; 
			  $tpl->data = Db::run()->pdoQuery($sql, array(1, App::Auth()->uid))->results();
		  } else {
			  if(App::Session()->get('wishlist')) {
				  $ids = Utility::implodeFields(App::Session()->get('wishlist'));
				  $sql = "SELECT id, slug, title, thumb, is_sale, price, sprice, affiliate, type, token, membership_id FROM `" . Product::mTable . "` WHERE id IN (" . $ids . ")";
				  $tpl->data = Db::Run()->pdoQuery($sql)->results();
			  }
		  }
		  
		  $tpl->template = 'front/themes/' . $core->theme . '/wishlist.tpl.php';
		  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), Lang::$word->META_M_WISHLIST];
          $tpl->title = Lang::$word->META_M_WISHLIST . ' - ' . $core->company;
		  $tpl->keywords = '';
		  $tpl->description = '';
      }

      /**
       * Front::Compare()
       * 
       * @return
       */
      public function Compare()
      {
		  $core = App::Core();
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "front/themes/" . $core->theme . "/";
		  $tpl->data = null; 

		  if(App::Session()->get('compare')) :
			  $ids = Utility::implodeFields(App::Session()->get('compare'));
			  $tpl->data = App::Product()->Compare($ids);
		  endif;
		  
		  $tpl->template = 'front/themes/' . $core->theme . '/compare.tpl.php';
		  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), Lang::$word->FRONT_COMPARE];
          $tpl->title = Lang::$word->FRONT_COMPARE . ' - ' . $core->company;
		  $tpl->keywords = '';
		  $tpl->description = '';
	  }
	  
      /**
       * Front::Search()
       * 
       * @return
       */
      public function Search()
      {
		  $core = App::Core();
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "front/themes/" . $core->theme . "/";
		  $tpl->template = 'front/themes/' . $core->theme . '/search.tpl.php';
		  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), Lang::$word->META_M_SEARCH];
		  $tpl->title = Lang::$word->META_M_SEARCH . ' - ' . $core->company;
		  $tpl->keyword = Validator::get('keyword');
		  $tpl->keywords = '';
		  $tpl->description = '';
		  $tpl->featured = ($tpl->keyword) ? App::Product()->Search(Validator::sanitize($tpl->keyword, "string", 20)) : null;

      }

      /**
       * Front::Activation()
       * 
       * @return
       */
      public function Activation()
      {

		  $core = App::Core();
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "front/themes/" . $core->theme . "/";
		  $tpl->template = 'front/themes/' . $core->theme . '/activation.tpl.php';
		  $tpl->title = Lang::$word->META_M_ACC_ACT . ' - ' . $core->company;
		  $tpl->keywords = '';
		  $tpl->description = '';
		  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), Lang::$word->META_M_ACC_ACT];
		  
		  if(Validator::get('token') and Validator::get('email')) {
			  $rules = array(
				  'email' => array('required|email', Lang::$word->EMAIL),
				  'token' => array('required|numeric|min_len,5|max_len,12', Lang::$word->MSG_INFO07),
				  );
			  $filters = array('token' => 'string');
			  
			  $validate = Validator::instance();
			  $safe = $validate->doValidate($_GET, $rules);
			  $safe = $validate->doFilter($_GET, $filters);
			  
			  if (empty(Message::$msgs)) {
				  if ($row = Db::run()->first(Users::mTable, array("id"), array(
					  "email" => $safe->email,
					  "token" => $safe->token,
					  ))) {
					  Db::run()->update(Users::mTable, array("active" => "y", "token" => 0), array("id" => $row->id));
					  Url::redirect(Url::url("/activation","?done=true"));
				  } else {
					  Url::url("/activation","?error=true");
				  }
			  } else {
				  Url::url("/activation","?error=true");
			  }
		  } else {
			  Url::url("/activation","?error=true");
		  }
      }

      /**
       * Front::News()
       * 
       * @return
       */
      public function News()
      {

		  $core = App::Core();
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "front/themes/" . $core->theme . "/";
		  $tpl->template = 'front/themes/' . $core->theme . '/news.tpl.php';
		  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), Lang::$word->NW_LATEST];
          $tpl->title = Lang::$word->NW_LATEST . ' - ' . $core->company;
		  $tpl->data = Db::Run()->select(Content::nTable, null, array('active' => 1), 'ORDER BY created DESC')->results();
		  $tpl->keywords = '';
		  $tpl->description = '';
      }
	  
      /**
       * Front::Dashboard()
       * 
       * @return
       */
      public function Dashboard()
      {
		  if (!App::Auth()->is_User()) {
			  Url::redirect(Url::url('/login')); 
			  exit; 
		  }
		  $core = App::Core();
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "front/themes/" . $core->theme . "/";
		  $tpl->template = 'front/themes/' . $core->theme . '/dashboard.tpl.php';
		  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), Lang::$word->META_M_MYDOWNS];
          $tpl->title = Lang::$word->META_M_MYDOWNS . ' - ' . $core->company;
		  $tpl->keywords = '';
		  $tpl->description = '';
		  $tpl->data = Stats::userDownloads();
      }
	  
      /**
       * Front::View()
       * 
	   * @param string $token
       * @return
       */
      public function View($token)
      {
		  if (!App::Auth()->is_User()) {
			  Url::redirect(Url::url('/login')); 
			  exit; 
		  }
		  $core = App::Core();
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "front/themes/" . $core->theme . "/";
		  $tpl->template = 'front/themes/' . $core->theme . '/view.tpl.php';
		  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), Lang::$word->META_M_MYDOWNS];
          $tpl->title = Lang::$word->META_M_MYDOWNS . ' - ' . $core->company;
		  $tpl->keywords = '';
		  $tpl->description = '';
		  $tpl->row = Product::fileAccess(Utility::decode($token));
		  if($tpl->row) {
			  $tpl->data = Product::relatedFiles($tpl->row->files);
			  $tpl->stats = Stats::fileStats($tpl->row);
		  } else {
			  $tpl->data = null;
			  $tpl->stats = null;
		  }
		  
      }
	  
      /**
       * Front::Profile()
       * 
       * @return
       */
      public function Profile()
      {
		  if (!App::Auth()->is_User()) {
			  Url::redirect(Url::url('/login')); 
			  exit; 
		  }
		  $core = App::Core();
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "front/themes/" . $core->theme . "/";
		  $tpl->template = 'front/themes/' . $core->theme . '/profile.tpl.php';
		  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), Lang::$word->META_DASH, Lang::$word->META_M_ACCNT];
          $tpl->title = Lang::$word->META_M_ACCNT . ' - ' . $core->company;
		  $tpl->keywords = '';
		  $tpl->description = '';
		  
		  $tpl->row = Db::run()->first(Users::mTable, null, array('id' => App::Auth()->uid));
		  $tpl->custom_fields = Content::rendertCustomFieldsFront($tpl->row->id, "profile");
		  $tpl->clist = App::Content()->getCountryList();
      }
	  
      /**
       * Front::updateProfile()
       * 
       * @return
       */
	  public function updateProfile()
	  {
		  $rules = array(
			  'fname' => array('required|string|min_len,3|max_len,60', Lang::$word->FNAME),
			  'lname' => array('required|string|min_len,3|max_len,60', Lang::$word->LNAME),
			  'email' => array('required|email', Lang::$word->EMAIL),
			  'newsletter' => array('required|numeric|exact_len,1', Lang::$word->USR_NLETTER),
			  );
	
		  if (App::Core()->enable_tax) {
			  $rules['address'] = array('required|string|min_len,3|max_len,80', Lang::$word->ADDRESS);
			  $rules['city'] = array('required|string|min_len,2|max_len,80', Lang::$word->CITY);
			  $rules['zip'] = array('required|string|min_len,3|max_len,30', Lang::$word->ZIP);
			  $rules['state'] = array('required|string|min_len,2|max_len,80', Lang::$word->STATE);
			  $rules['country'] = array('required|string|exact_len,2', Lang::$word->COUNTRY);
		  }
	
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
	
		  Content::verifyCustomFields("profile");
		  
		  $upl = Upload::instance(512000, "png,jpg");
		  if (!empty($_FILES['avatar']['name']) and empty(Message::$msgs)) {
			  $upl->process("avatar", UPLOADS . "/avatars/", "AVT_");
		  }
		  
		  if (empty(Message::$msgs)) {
			  $data = array(
				  'email' => $safe->email,
				  'lname' => $safe->lname,
				  'fname' => $safe->fname,
				  'newsletter' => $safe->newsletter,
				  );
			  if (App::Core()->enable_tax) {
				  $data['address'] = $safe->address;
				  $data['city'] = $safe->city;
				  $data['zip'] = $safe->zip;
				  $data['state'] = $safe->state;
				  $data['country'] = $safe->country;
			  }
	
			  if (!empty($_POST['password'])) {
				  $salt = '';
				  $hash = App::Auth()->create_hash(Validator::cleanOut($_POST['password']), $salt);
				  $data['hash'] = $hash;
				  $data['salt'] = $salt;
			  }
	
			  if (isset($upl->fileInfo['fname'])) {
				  $data['avatar'] = $upl->fileInfo['fname'];
				  if (Auth::$udata->avatar != "") {
					  File::deleteFile(UPLOADS . "/avatars/" . Auth::$udata->avatar);
					  Auth::$udata->avatar = App::Session()->set('avatar', $upl->fileInfo['fname']);
				  }
			  }
	
			  // Start Custom Fields
			  $fl_array = Utility::array_key_exists_wildcard($_POST, 'custom_*', 'key-value');
			  if ($fl_array) {
				  $result = array();
				  foreach ($fl_array as $key => $val) {
					$cfdata['field_value'] = Validator::sanitize($val);
					Db::run()->update(Content::cfdTable, $cfdata, array("user_id" => Auth::$udata->uid, "field_name" => str_replace("custom_", "", $key)));
				  }
			  }
	
			  Db::run()->update(Users::mTable, $data, array("id" => Auth::$udata->uid));
			  Message::msgReply(Db::run()->affected(), 'success', str_replace("[NAME]", "", Lang::$word->USR_UPDATE_OK));
			  if(Db::run()->affected()) {
				  Auth::$udata->email = App::Session()->set('email', $data['email']);
				  Auth::$udata->fname = App::Session()->set('fname', $data['fname']);
				  Auth::$udata->lname = App::Session()->set('lname', $data['lname']);
				  Auth::$udata->name = App::Session()->set('name', $data['fname'] . ' ' . $data['lname']);
				  if (App::Core()->enable_tax) {
					  Auth::$udata->country = App::Session()->set('country', $data['country']);
				  }
			  }
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Front::Memberships()
       * 
       * @return
       */
      public function Memberships()
      {
		  if (!App::Auth()->is_User()) {
			  Url::redirect(Url::url('/login'));  
			  exit; 
		  }
		  $core = App::Core();
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "front/themes/" . $core->theme . "/";
		  $tpl->data = Db::run()->select(Content::mxTable, null, array("private" => 0, "active" => 1), "ORDER BY price")->results();
		  $tpl->user = Db::run()->first(Users::mTable, array("membership_id"), array("id" => App::Auth()->uid));
		  App::Auth()->membership_id = $tpl->user->membership_id;
		  $tpl->template = 'front/themes/' . $core->theme . '/memberships.tpl.php';
          $tpl->title = Lang::$word->META_M_MEMBERSHIPS . ' - ' . $core->company;
		  $tpl->keywords = '';
		  $tpl->description = '';
		  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), Lang::$word->META_DASH, Lang::$word->MEMBERSHIPS];
      }

      /**
       * Front::History()
       * 
       * @return
       */
      public function History()
      {
		  if (!App::Auth()->is_User()) {
			  Url::redirect(Url::url('/login'));  
			  exit; 
		  }
		  $core = App::Core();
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "front/themes/" . $core->theme . "/";
		  $tpl->data = Stats::userHistory(App::Auth()->uid, 'expire');
		  $tpl->totals = Stats::userTotals();
		  $tpl->template = 'front/themes/' . $core->theme . '/history.tpl.php';
          $tpl->title = Lang::$word->META_M_MHISTORY . ' - ' . $core->company;
		  $tpl->keywords = '';
		  $tpl->description = '';
		  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), Lang::$word->META_DASH, Lang::$word->META_M_MHISTORY];
      }
	  
      /**
       * Front::buyMembership()
       * 
       * @return
       */
      public function buyMembership()
      {
		  
		  if($row = Db::run()->first(Content::mxTable, null, array("id" => Filter::$id, "private" => 0))) {
			  $gaterows = Db::run()->select(Admin::gTable, null, array("active" => 1))->results();
			  
			  if ($row->price == 0)  {
				  $data = array(
					  'membership_id' => $row->id,
					  'mem_expire' => Date::calculateDays($row->id),
					  );
	
				  Db::run()->update(Users::mTable, $data, array("id" => App::Auth()->uid));
				  Auth::$udata->membership_id = App::Session()->set('membership_id', $row->id);
				  Auth::$udata->mem_expire = App::Session()->set('mem_expire', $data['mem_expire']);
				  
				  $json['message'] = Message::msgSingleOk(str_replace("[NAME]", $row->title, Lang::$word->MSG_INFO09), false);
			  } else {
				  $recurring = ($row->recurring) ? Lang::$word->YES : Lang::$word->NO;
				  Db::run()->delete(Content::xTable, array("user_m_id" => App::Auth()->uid));
				  $tax = Content::calculateTax();
				  
				  $data = array(
					  'user_m_id' => App::Auth()->uid,
					  'membership_id' => $row->id,
					  'originalprice' => $row->price,
					  'tax' => Validator::sanitize($tax, "float"),
					  'totaltax' => Validator::sanitize($row->price * $tax, "float"),
					  'total' => $row->price,
					  'totalprice' => Validator::sanitize($tax * $row->price + $row->price, "float"),
					  );
				  Db::run()->insert(Content::xTable, $data);
				  $cart = Content::getCart();
				  
				  $tpl = App::View(THEMEBASE . '/snippets/');
				  $tpl->row = $row;
				  $tpl->gateways = $gaterows;
				  $tpl->cart = $cart;
				  $tpl->template = 'loadSummary.tpl.php'; 
				  $json['message'] = $tpl->render();
			  }
		  } else {
			  $json['type'] = "error";
		  }
		  print json_encode($json);
      }

      /**
       * Front::Validate()
       * 
       * @return
       */
      public function Validate()
      {
		  if (!App::Auth()->is_User()) {
			  Url::redirect(Url::url('/login'));  
			  exit; 
		  }
		  
		  $core = App::Core();
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "front/themes/" . $core->theme . "/";
		  $tpl->template = 'front/themes/' . $core->theme . '/_validate.tpl.php';
		  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), Lang::$word->META_DASH, Lang::$word->META_M_ACCNT];
          $tpl->title = Lang::$word->META_M_ACCNT . ' - ' . $core->company;
		  $tpl->keywords = '';
		  $tpl->description = '';
      }
	  
      /**
       * Front::selectGateway()
       * 
       * @return
       */
	  public function selectGateway()
	  {
	
		  if ($cart = Content::getCart()) {
			  $gateway = Db::run()->first(Admin::gTable, null, array("id" => Filter::$id, "active" => 1));
			  $row = Db::run()->first(Content::mxTable, null, array("id" => $cart->membership_id));
			  $tpl = App::View(BASEPATH . 'gateways/' . $gateway->dir . '/');
			  $tpl->cart = $cart;
			  $tpl->gateway = $gateway;
			  $tpl->row = $row;
			  $tpl->template = 'form.tpl.php';
			  $json['message'] = $tpl->render();
		  } else {
			  $json['message'] = Message::msgSingleError(Lang::$word->SYSERROR, false);
		  }
		  print json_encode($json);
	  }
	  
  }