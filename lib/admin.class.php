<?php
  /**
   * Class Admin
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: admin.class.php, v1.00 2020-04-20 18:20:24 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');


  class Admin
  {
	  
	  const gTable = "gateways";
	  

      /**
       * Admin::Index()
       * 
       * @return
       */
      public function Index()
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
		  $tpl->counters = Stats::indexStats();
		  $tpl->stats = Stats::indexSalesStats();
          $tpl->template = 'admin/index.tpl.php';
          $tpl->title = Lang::$word->META_M_DASH;
      }

      /**
       * Admin::Account()
       * 
       * @return
       */
      public function Account()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->crumbs = ['admin', Lang::$word->META_ACCOUNT];
          $tpl->template = 'admin/myaccount.tpl.php';
          $tpl->data = Db::run()->first(Users::mTable, null, array('id' => App::Auth()->uid));
          $tpl->title = Lang::$word->META_M_ACCOUNT;

      }

      /**
       * Admin::Password()
       * 
       * @return
       */
      public function Password()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->crumbs = ['admin', array(0 => Lang::$word->META_ACCOUNT, 1 => "myaccount"), Lang::$word->META_PASSWORD];
          $tpl->template = 'admin/myaccount.tpl.php';
          $tpl->title = Lang::$word->USR_PASSUPDATE;

      }

      /**
       * Admin::updateAccount()
       * 
       * @return
       */
      public function updateAccount()
      {

          $rules = array(
              'email' => array('required|email', Lang::$word->EMAIL),
              'fname' => array('required|string|min_len,2|max_len,60', Lang::$word->FNAME),
              'lname' => array('required|string|min_len,2|max_len,60', Lang::$word->LNAME),
              );

		  $filters = array(
			  'fname' => 'string',
			  'lname' => 'string',
			  );
			  
          $upl = Upload::instance(512000, "png,jpg");
          if (!empty($_FILES['avatar']['name']) and empty(Message::$msgs)) {
              $upl->process("avatar", UPLOADS . "/avatars/", "AVT_");
          }

          $validate = Validator::instance();
          $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);

          if (empty(Message::$msgs)) {
              $data = array(
                  'email' => $safe->email,
                  'lname' => $safe->lname,
                  'fname' => $safe->fname);

              if (isset($upl->fileInfo['fname'])) {
                  $data['avatar'] = $upl->fileInfo['fname'];
                  if (Auth::$udata->avatar != "") {
                      File::deleteFile(UPLOADS . "/avatars/" . Auth::$udata->avatar);
                      Auth::$udata->avatar = App::Session()->set('avatar', $upl->fileInfo['fname']);
                  }
              }
              Db::run()->update(Users::mTable, $data, array("id" => Auth::$udata->uid));
              if (Db::run()->affected()) {
                  Auth::$udata->fname = App::Session()->set('fname', $data['fname']);
                  Auth::$udata->lname = App::Session()->set('lname', $data['lname']);
                  Auth::$udata->email = App::Session()->set('email', $data['email']);
              }
              $message = str_replace("[NAME]", "", Lang::$word->USR_UPDATED_A);
              Message::msgReply(Db::run()->affected(), 'success', $message);
          } else {
              Message::msgSingleStatus();
          }
      }


      /**
       * Admin::updateAdminPassword()
       * 
       * @return
       */
      public function updateAdminPassword()
      {

          $rules = array(
              'password' => array('required|string|min_len,6|max_len,20', Lang::$word->NEWPASS),
              'password2' => array('required|string|min_len,6|max_len,20', Lang::$word->CONPASS),
              );

          $validate = Validator::instance();
          $safe = $validate->doValidate($_POST, $rules);

          if ($_POST['password'] != $_POST['password2']) {
              Message::$msgs['pass'] = Lang::$word->M_PASSMATCH;
          }

          if (empty(Message::$msgs)) {
              $salt = '';
              $hash = App::Auth()->create_hash($safe->password, $salt);
              $data['hash'] = $hash;
              $data['salt'] = $salt;

              Db::run()->update(Users::mTable, $data, array("id" => Auth::$udata->uid));
              Message::msgReply(Db::run()->affected(), 'success', Lang::$word->USR_PASSUPDATE_OK);
          } else {
              Message::msgSingleStatus();
          }
      }

      /**
       * Admin::Trash()
       * 
       * @return
       */
      public function Trash()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
		  $data = Db::run()->select(Core::txTable)->results() ;
		  $tpl->data = Utility::groupToLoop($data, "type");
          $tpl->crumbs = ['admin', Lang::$word->META_TRASH];
          $tpl->template = 'admin/trash.tpl.php';
          $tpl->title = Lang::$word->META_M_TRASH;
      }
	  
      /**
       * Admin::passReset()
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
			  $row = Db::run()->first(Users::mTable, array("email", "fname", "lname", "id"), array('email =' => $safe->email, "and type <>" => "member"));
			  if(!$row) {
				  Message::$msgs['email'] = Lang::$word->LOGIN_R5;
				  $json['title'] = Lang::$word->ERROR;
				  $json['message'] = Lang::$word->LOGIN_R5;
				  $json['type'] = 'error';
			  }
		  }
		  
          if (empty(Message::$msgs)) {
			  $row = Db::run()->first(Users::mTable, array("email", "fname", "lname", "id"), array('email =' => $safe->email, "and type <>" => "member"));
			  $mailer = Mailer::sendMail();
			  $tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'adminPassReset'));
			  $token = substr(md5(uniqid(rand(), true)), 0, 10);
			  $core = App::Core();
			  
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
						->setTo(array($row->email => $row->fname . ' ' . $row->lname))
						->setFrom(array($core->site_email => $core->company))
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
       * Admin::Backup()
       * 
       * @return
       */
      public function Backup()
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
		  $tpl->dbdir = UPLOADS . '/backups/';
		  $tpl->data = File::findFiles($tpl->dbdir, array('fileTypes' => array('sql'), 'returnType' => 'fileOnly'));
          $tpl->template = 'admin/backup.tpl.php';
          $tpl->title = Lang::$word->META_M_BACKUP;
      }

      /**
       * AdminController::Maintenance()
       * 
       * @return
       */
      public function Maintenance()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->crumbs = ['admin', Lang::$word->META_MAINTENANCE];
          $tpl->template = 'admin/maintenance.tpl.php';
          $tpl->banned = Db::run()->count(Users::mTable, "active = 'b' AND type = 'member'");
          $tpl->title = Lang::$word->META_M_MAINTENANCE;
      }
	  
      /**
       * Admin::Gateways()
       * 
       * @return
       */
      public function Gateways()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->crumbs = ['admin', Lang::$word->META_GATEWAYS];
		  $tpl->data = Db::run()->select(self::gTable, "*", null, 'ORDER BY name')->results();;
          $tpl->template = 'admin/gateways.tpl.php';
          $tpl->title = Lang::$word->META_M_GATEWAY;

      }
	  
      /**
       * Admin::GatewayEdit()
       * 
       * @return
       */
	  public function GatewayEdit($id)
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->GW_EDIT;
		  $tpl->crumbs = ['admin', array(0 => Lang::$word->META_GATEWAYS, 1 => "gateways"), Lang::$word->META_EDIT];
	
		  if (!$row = Db::run()->first(self::gTable, null, array("id =" => $id))) {
			  $tpl->template = 'admin/error.tpl.php';
			  $tpl->error = DEBUG ? "Invalid ID ($id) detected [admin.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
		  } else {
			  $tpl->data = $row;
			  $tpl->template = 'admin/gateways.tpl.php';
		  }
	  }
	  
      /**
       * Admin::processGateway()
       * 
       * @return
       */
	  public function processGateway()
	  {
	
		  $rules = array(
			  'displayname' => array('required|string|min_len,3|max_len,60', Lang::$word->GW_NAME),
			  'extra' => array('required|string', Lang::$word->GW_NAME),
			  'live' => array('required|numeric', Lang::$word->GW_LIVE),
			  'active' => array('required|numeric', Lang::$word->ACTIVE),
			  'id' => array('required|numeric', "ID"),
			  );
	
		  $filters = array(
			  'displayname' => 'string',
			  'extra2' => 'string',
			  'extra3' => 'string',
			  );

		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
		  if (empty(Message::$msgs)) {
			  $data = array(
				  'displayname' => $safe->displayname,
				  'extra' => $safe->extra,
				  'extra2' => $safe->extra2,
				  'extra3' => $safe->extra3,
				  'live' => $safe->live,
				  'active' => $safe->active,
				  );
	
			  Db::run()->update(self::gTable, $data, array("id" => Filter::$id)); 
			  Message::msgReply(Db::run()->affected(), 'success', Message::formatSuccessMessage($data['displayname'], Lang::$word->GW_UPDATE_OK));
		  } else {
			  Message::msgSingleStatus();
		  }
	  }
	  
      /**
       * Admin::System()
       * 
       * @return
       */
      public function System()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->crumbs = ['admin', Lang::$word->META_M_SYSTEM];
          $tpl->template = 'admin/system.tpl.php';
          $tpl->title = Lang::$word->META_M_SYSTEM;
      }
	  
      /**
       * Admin::Permissions()
       * 
       * @return
       */
      public function Permissions()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->crumbs = ['admin', Lang::$word->META_PERMISSIONS];
		  $tpl->data = App::Users()->getRoles();
          $tpl->template = 'admin/permissions.tpl.php';
          $tpl->title = Lang::$word->META_M_PERMISSIONS;

      }

      /**
       * Admin::Privileges()
       * 
       * @return
       */
      public function Privileges($id)
      {

		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->META_M_PRIVILEGE;
		  $tpl->crumbs = ['admin', Lang::$word->META_PERMISSIONS, Lang::$word->META_PRIVILEGES];
	
		  if (!$row = Db::run()->first(Users::rTable, null, array('id' => $id))) {
			  $tpl->template = 'admin/error.tpl.php';
			  $tpl->error = DEBUG ? "Invalid ID ($id) detected [admin.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
		  } else {
			  $tpl->role = $row;
			  $tpl->result = Utility::groupToLoop(App::Users()->getPrivileges($id), "type");
			  $tpl->template = 'admin/permissions.tpl.php';
		  }
      }
	  
      /**
       * Admin::Mailer()
       * 
       * @return
       */
      public function Mailer()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->crumbs = ['admin', Lang::$word->META_NEWSLETTER];
		  $type = Validator::get('email') ? "singleMail" : "newsletter";
		  $tpl->data = Db::run()->first(Content::eTable, null, array("typeid" => $type));
          $tpl->template = 'admin/mailer.tpl.php';
          $tpl->title = Lang::$word->META_M_NEWSLETTER;
      }
	  
      /**
       * Admin::processMailer()
       * 
       * @return
       */
      public function processMailer()
      {
          $rules = array(
              'subject' => array('required|string|min_len,3|max_len,100', Lang::$word->NL_SUBJECT),
              'recipient' => array('required|string', Lang::$word->NL_RCPT),
              );

		  $filters = array(
			  'body' => 'advanced_tags',
			  );

		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);

          $upl = Upload::instance(20971520, "zip,jpg,pdf,doc,docx");
          if (!empty($_FILES['attachment']['name']) and empty(Message::$msgs)) {
              $upl->process("attachment", UPLOADS . "/attachments/", "ATT_");
          }

          if (empty(Message::$msgs)) {
              $body = Validator::cleanOut($safe->body);
              $numSent = 0;
              $failedRecipients = array();
			  $core = App::Core();

              switch ($safe->recipient) {
                  case "all";
                      $mailer = Mailer::sendMail();
                      $mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100, 30));
                      $userrow = Db::run()->select(Users::mTable, array('email', 'CONCAT(fname," ",lname) as name'), array('active' => 'y', 'type' => 'member'))->results();
                      $replacements = array();
					  
                      if ($userrow) {
                          if (isset($upl->fileInfo['fname'])) {
                              $attachement = '<a href="' . UPLOADURL . '/attachments/' . $upl->fileInfo['fname'] . '">' . Lang::$word->NL_ATTACH . '</a>';
                          } else {
                              $attachement = '';
                          }

                          foreach ($userrow as $cols) {
                              $replacements[$cols->email] = array(
                                  '[LOGO]' => Utility::getLogo(),
								  '[CEMAIL]' => $core->site_email,
                                  '[NAME]' => $cols->name,
                                  '[DATE]' => date('Y'),
                                  '[COMPANY]' => $core->company,
                                  '[FB]' => $core->social->facebook,
                                  '[TW]' => $core->social->twitter,
                                  '[ATTACHMENT]' => $attachement,
                                  '[SITEURL]' => SITEURL);
                          }

                          $decorator = new Swift_Plugins_DecoratorPlugin($replacements);
                          $mailer->registerPlugin($decorator);

                          $message = (new Swift_Message())
								->setSubject($safe->subject)
								->setFrom(array($core->site_email => $core->company))
								->setBody($body, 'text/html');

                          foreach ($userrow as $row) {
                              $message->setTo(array($row->email => $row->name));
                              $numSent++;
                              $mailer->send($message, $failedRecipients);
                          }
                          unset($row);

                      }
                      break;

                  case "newsletter":
                      $mailer = Mailer::sendMail();
                      $mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100, 30));
                      $userrow = Db::run()->select(Users::mTable, array('email', 'CONCAT(fname," ",lname) as name'), array('newsletter' => 1, 'type' => 'member'))->results();
                      $replacements = array();
					  
                      if ($userrow) {
                          if (isset($upl->fileInfo['fname'])) {
                              $attachement = '<a href="' . UPLOADURL . '/attachments/' . $upl->fileInfo['fname'] . '">' . Lang::$word->NL_ATTACH . '</a>';
                          } else {
                              $attachement = '';
                          }

                          foreach ($userrow as $cols) {
                              $replacements[$cols->email] = array(
                                  '[LOGO]' => Utility::getLogo(),
								  '[CEMAIL]' => $core->site_email,
                                  '[NAME]' => $cols->name,
                                  '[DATE]' => date('Y'),
                                  '[COMPANY]' => $core->company,
                                  '[FB]' => $core->social->facebook,
                                  '[TW]' => $core->social->twitter,
                                  '[ATTACHMENT]' => $attachement,
                                  '[SITEURL]' => SITEURL);
                          }

                          $decorator = new Swift_Plugins_DecoratorPlugin($replacements);
                          $mailer->registerPlugin($decorator);

                          $message = (new Swift_Message())
								->setSubject($safe->subject)
								->setFrom(array($core->site_email => $core->company))
								->setBody($body, 'text/html');

                          foreach ($userrow as $row) {
                              $message->setTo(array($row->email => $row->name));
                              $numSent++;
                              $mailer->send($message, $failedRecipients);
                          }
                          unset($row);

                      }

                      break;

                  case "paid":
                      $mailer = Mailer::sendMail();
                      $mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100, 30));
                      $userrow = Db::run()->select(Users::mTable, array('email', 'CONCAT(fname," ",lname) as name'), array('membership_id <>' => 0, 'and type =' => 'member'))->results();
                      $replacements = array();
                      
                      if ($userrow) {
                          if (isset($upl->fileInfo['fname'])) {
                              $attachement = '<a href="' . UPLOADURL . '/attachments/' . $upl->fileInfo['fname'] . '">' . Lang::$word->NL_ATTACH . '</a>';
                          } else {
                              $attachement = '';
                          }

                          foreach ($userrow as $cols) {
                              $replacements[$cols->email] = array(
                                  '[LOGO]' => Utility::getLogo(),
								  '[CEMAIL]' => $core->site_email,
                                  '[NAME]' => $cols->name,
                                  '[DATE]' => date('Y'),
                                  '[COMPANY]' => $core->company,
                                  '[FB]' => $core->social->facebook,
                                  '[TW]' => $core->social->twitter,
                                  '[ATTACHMENT]' => $attachement,
                                  '[SITEURL]' => SITEURL);
                          }

                          $decorator = new Swift_Plugins_DecoratorPlugin($replacements);
                          $mailer->registerPlugin($decorator);

                          $message = (new Swift_Message())
								->setSubject($safe->subject)
								->setFrom(array($core->site_email => $core->company))
								->setBody($body, 'text/html');

                          foreach ($userrow as $row) {
                              $message->setTo(array($row->email => $row->name));
                              $numSent++;
                              $mailer->send($message, $failedRecipients);
                          }
                          unset($row);

                      }
                      break;

                  default:
                      $mailer = Mailer::sendMail();
                      $userrow = Db::run()->pdoQuery("SELECT email, CONCAT(fname,' ',lname) as name FROM `" . Users::mTable . "` WHERE email LIKE '%" . $safe->recipient . "%'")->result();

                      if ($userrow) {
                          if (isset($upl->fileInfo['fname'])) {
                              $attachement = '<a href="' . UPLOADURL . '/attachments/' . $upl->fileInfo['fname'] . '">' . Lang::$word->NL_ATTACH . '</a>';
                          } else {
                              $attachement = '';
                          }

						  $newbody = str_replace(array(
							  '[LOGO]',
							  '[CEMAIL]',
							  '[NAME]',
							  '[DATE]',
							  '[COMPANY]',
							  '[ATTACHMENT]',
							  '[FB]',
							  '[TW]',
							  '[SITEURL]'), array(
							  Utility::getLogo(),
							  $core->site_email,
							  $userrow->name,
							  date('Y'),
							  $core->company,
							  $attachement,
							  $core->social->facebook,
							  $core->social->twitter,
							  SITEURL), $body);

                          $message = (new Swift_Message())
								->setSubject($safe->subject)
								->setTo(array($safe->recipient => $userrow->name))
								->setFrom(array($core->site_email => $core->company))
								->setBody($newbody, 'text/html');

                          $numSent++;
                          $mailer->send($message, $failedRecipients);
                      }
                      break;
              }

              if ($numSent) {
                  $json['type'] = 'success';
                  $json['title'] = Lang::$word->SUCCESS;
                  $json['message'] = $numSent . ' ' . Lang::$word->NL_SENT;
              } else {
                  $json['type'] = 'error';
                  $json['title'] = Lang::$word->ERROR;
                  $res = '';
                  $res .= '<ul>';
                  foreach ($failedRecipients as $failed) {
                      $res .= '<li>' . $failed . '</li>';
                  }
                  $res .= '</ul>';
                  $json['message'] = Lang::$word->NL_ALERT . $res;

                  unset($failed);
              }
              print json_encode($json);
          } else {
              Message::msgSingleStatus();
          }
      }

      /**
       * Admin::Transactions()
       * 
       * @return
       */
      public function Transactions()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->crumbs = ['admin', Lang::$word->META_TRANS];
		  $data = Stats::getAllStats();
		  $tpl->data = isset($data[0]) ? $data[0] : 0;
		  $tpl->pager = isset($data[1]) ? $data[1] : 0;
          $tpl->template = 'admin/transactions.tpl.php';
          $tpl->title = Lang::$word->META_M_HISTORY;

      }

      /**
       * Admin::TransactionNew()
       * 
       * @return
       */
      public function TransactionNew()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->crumbs = ['admin', Lang::$word->META_TRANS, Lang::$word->META_NEW];
          $tpl->template = 'admin/transactions.tpl.php';
		  $tpl->products = Db::run()->select(Product::mTable, array("id", "title"), array("active" => 1), "ORDER BY title")->results();
		  $tpl->users = Db::run()->select(Users::mTable, array("id", "CONCAT(fname,' ',lname) as name"), array("active" => "y"))->results();
		  $tpl->gateways = Db::run()->select(self::gTable, array("name", "displayname"), array("active" => 1))->results();
          $tpl->title = Lang::$word->TRX_NEW;

      }

      /**
       * Admin::processTransaction()
       * 
       * @return
       */
	  public function processTransaction()
	  {
	
		  $rules = array(
			  'pp' => array('required|string|min_len,3|max_len,60', Lang::$word->GW_NAME),
			  'product_id' => array('required|numeric', Lang::$word->CF_SEC_P),
			  'user_id' => array('required|numeric', Lang::$word->USER),
			  'qty' => array('required|numeric', Lang::$word->QUANTITY),
			  );

		  $filters = array(
			  'memo' => 'string',
			  );

		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
		  if (empty(Message::$msgs)) {
			  $items = array();
			  $cdkey = array();
			  
			  $product = Db::run()->first(Product::mTable, null, array("id" => $safe->product_id));
			  $user = Db::run()->first(Users::mTable, null, array("id" => $safe->user_id));
			  $txn_id = "MAN_" . time();
			  $price = ($product->is_sale) ? $product->sprice : $product->price;
			  for ($k = 0; $k < $safe->qty; $k++) {
				  $key = Db::run()->getValue(Product::cdTable, "cdkey", "product_id", $safe->product_id);
				  $data = array(
					  'user_id' => $user->id,
					  'product_id' => $product->id,
					  'txn_id' => $txn_id, 
					  'amount' => $price,
					  'total' => $price,
					  'cdkey' => ($key) ? $key : "",
					  'pp' => $safe->pp, 
					  'file_date' => time(),
					  'currency' => App::Core()->currency,
					  'memo' => $safe->memo,
					  'status' => 1,
					  );

				  $items[$k]['title'] = $product->title;
				  $items[$k]['qty'] = 1;
				  $items[$k]['price'] = $price;
				  $items[$k]['cdkey'] = $data['cdkey'];
				  $cdkey[] = $data['cdkey'];

				  Db::run()->insert(Product::xTable, $data);
				  if($key) {
					  Db::run()->delete(Product::cdTable, array("cdkey" => $data['cdkey']));
				  }
			  }

			  // invoice table
			  $xdata = array(
				  'invoice_id' => substr(time(), 5),
				  'transaction_id' => $txn_id,
				  'user_id' => $user->id,
				  'items' => json_encode($items),
				  'subtotal' => Validator::sanitize($price * $safe->qty, "float"),
				  'grand' => Validator::sanitize($price * $safe->qty, "float"),
				  'currency' => App::Core()->currency,
				  );
			  Db::run()->insert(Product::ivTable, $xdata);
				  
			  Message::msgReply(Db::run()->affected(), 'success', Lang::$word->TRX_ADDED_OK);
			  
			  if (isset($_POST['notify'])) {
				  $tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'notifyUser'));
				  $mailer = Mailer::sendMail();
				  $core = App::Core();
							  
				  $body = str_replace(array(
					  '[LOGO]',
					  '[CEMAIL]',
					  '[NAME]',
					  '[DATE]',
					  '[COMPANY]',
					  '[ITEMNAME]',
					  '[LINK]',
					  '[FB]',
					  '[TW]',
					  '[SITEURL]'), array(
					  Utility::getLogo(),
					  $core->site_email,
					  $user->fname . ' ' . $user->lname,
					  date('Y'),
					  $core->company,
					  $product->title,
					  Url::url('/login'),
					  $core->social->facebook,
					  $core->social->twitter,
					  SITEURL), $tpl->body
					  );
		
					  $msg = (new Swift_Message())
							->setSubject($tpl->subject)
							->setFrom(array($core->site_email => $core->company))
							->setTo(array($user->email => $user->fname . ' ' . $user->lname))
							->setBody($body, 'text/html'
							);
					  $mailer->send($msg);
			  }
		  } else {
			  Message::msgSingleStatus();
		  }
	  }
	  
      /**
       * Admin::Files()
       * 
       * @return
       */
      public function Files()
      {
		  if (isset($_GET['letter']) and isset($_GET['type'])) {
			  $letter = Validator::sanitize($_GET['letter'], 'string', 2);
			  $type = Validator::sanitize($_GET['type'], "alpha", 10);

              if (in_array($type, array(
                  "audio",
                  "video",
                  "archive",
				  "document",
				  "image",
				  ))) {
				  $where = "WHERE `type` = '$type' AND `alias` REGEXP '^" . $letter . "'";	
				  $counter = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . Product::fTable . "` $where LIMIT 1");
              } else {
				  $where = "WHERE `alias` REGEXP '^" . $letter . "'";
                  $counter = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . Product::fTable . "` $where LIMIT 1");
              }
		  } elseif (isset($_GET['type'])) {
			  $type = Validator::sanitize($_GET['type'], "alpha", 10);
              if (in_array($type, array(
                  "audio",
                  "video",
                  "archive",
				  "document",
				  "image",
				  ))) {
				  $where = "WHERE `type` = '$type'";	
				  $counter = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . Product::fTable . "` WHERE `type` = '$type' LIMIT 1");
              } else {
                  $where = null;
				  $counter = Db::run()->count(Product::fTable);
              }
		  } elseif (isset($_GET['letter'])) {
			  $letter = Validator::sanitize($_GET['letter'], 'string', 2);
			  $where = "WHERE `alias` REGEXP '^" . $letter . "'";
			  $counter = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . Product::fTable . "` $where LIMIT 1");
		  } else {
			  $where = null;
			  $counter = Db::run()->count(Product::fTable);
		  }

          if (isset($_GET['order']) and count(explode("|", $_GET['order'])) == 2) {
              list($sort, $order) = explode("|", $_GET['order']);
              $sort = Validator::sanitize($sort, "default", 16);
              $order = Validator::sanitize($order, "default", 4);
              if (in_array($sort, array(
                  "name",
                  "alias",
                  "filesize"))) {
                  $ord = ($order == 'DESC') ? " DESC" : " ASC";
                  $sorting = $sort . $ord;
              } else {
                  $sorting = "created DESC";
              }
          } else {
              $sorting = "created DESC";
          }
		  
          $pager = Paginator::instance();
          $pager->items_total = $counter;
          $pager->default_ipp = App::Core()->perpage;
          $pager->path = Url::url(Router::$path, "?");
          $pager->paginate();
		  
          $sql = "
		  SELECT * 
		  FROM `" . Product::fTable . "` 
		  $where
		  ORDER BY $sorting" . $pager->limit;
		  
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->crumbs = ['admin', Lang::$word->META_FILES];
          $tpl->template = 'admin/files.tpl.php';
          $tpl->title = Lang::$word->META_M_FILES;
		  
		  $tpl->data = Db::run()->pdoQuery($sql)->results();
		  $tpl->pager = $pager;

      }
  }