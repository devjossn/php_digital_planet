<?php
  /**
   * Users Class
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2016
   * @version $Id: users.class.php, v1.00 2016-06-05 10:12:05 gewa Exp $
   */

  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');

  class Users
  {

      const mTable = "users";
      const rTable = "roles";
      const rpTable = "role_privileges";
      const pTable = "privileges";
	  const blTable = 'banlist';
	  const aTable = 'activity';


      /**
       * Users::__construct()
       * 
       * @return
       */
      public function __construct()
      {

      }

      /**
       * Users::Index()
       * 
       * @return
       */
      public function Index()
      {
		  
		  switch(App::Auth()->usertype) {
			  case "owner":
			     $where = 'WHERE (type = \'staff\' || type = \'editor\' || type = \'member\')';
			  break;
			  
			  case "staff":
			     $where = 'WHERE (type = \'editor\' || type = \'member\')';
			  break;
			  
			  case "editor":
			     $where = 'WHERE (type = \'member\')';
			  break;
			  
		  }
		  
		  $enddate = (isset($_POST['enddate']) && $_POST['enddate'] <> "") ? Validator::sanitize(Db::toDate($_POST['enddate'], false)) : date("Y-m-d");
		  $fromdate = isset($_POST['fromdate']) ? Validator::sanitize(Db::toDate($_POST['fromdate'], false)) : null;
		  
		  $find = isset($_POST['find']) ? Validator::sanitize($_POST['find'], "default", 30) : null;
		  
          if (isset($_GET['letter']) and $find) {
              $letter = Validator::sanitize($_GET['letter'], 'string', 2);
              $counter = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . self::mTable . "` $where AND `fname` LIKE '%" . trim($find) . "%' OR `lname` LIKE '%" . trim($find) . "%' AND `fname` REGEXP '^" . $letter . "'");
              $and = "AND `fname` LIKE '%" . trim($find) . "%' AND `lname` LIKE '%" . trim($find) . "%' AND `fname` REGEXP '^" . $letter . "'";

          } elseif (isset($_POST['find'])) {
              $counter = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . self::mTable . "` $where AND `fname` LIKE '%" . trim($find) . "%' OR `lname` LIKE '%" . trim($find) . "%'");
              $and = "AND `fname` LIKE '%" . trim($find) . "%' OR `lname` LIKE '%" . trim($find) . "%'";

          } elseif (isset($_GET['letter'])) {
              $letter = Validator::sanitize($_GET['letter'], 'string', 2);
              $and = "AND `fname` REGEXP '^" . $letter . "'";
              $counter = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . self::mTable . "` $where AND `fname` REGEXP '^" . $letter . "' LIMIT 1");
          } else {
			  $counter = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . self::mTable . "` $where LIMIT 1");
              $and = null;
          }
		  
          if (isset($_GET['order']) and count(explode("|", $_GET['order'])) == 2) {
              list($sort, $order) = explode("|", $_GET['order']);
              $sort = Validator::sanitize($sort, "default", 16);
              $order = Validator::sanitize($order, "default", 5);
              if (in_array($sort, array(
                  "fname",
                  "email",
                  "items"))) {
                  $ord = ($order == 'DESC') ? " DESC" : " ASC";
                  $sorting = $sort . $ord;
              } else {
                  $sorting = " created DESC";
              }
          } else {
              $sorting = " created DESC";
          }
		  
          $pager = Paginator::instance();
          $pager->items_total = $counter;
          $pager->default_ipp = App::Core()->perpage;
          $pager->path = Url::url(Router::$path, "?");
          $pager->paginate();
		  
          $sql = "
		  SELECT u.*, u.id as id, u.userlevel, u.active as active, CONCAT(fname,' ',lname) as fullname, 
		  m.title as mtitle,
			(SELECT 
			  COUNT(id) 
			FROM
			  `" . Product::xTable . "` as p 
			WHERE p.user_id = u.id) AS items
		  FROM `" . self::mTable . "` as u 
		  LEFT JOIN " . Content::mxTable . " as m on m.id = u.membership_id
		  $where
		  $and
		  ORDER BY $sorting" . $pager->limit;

		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->template = 'admin/users.tpl.php'; 
		  $tpl->title = Lang::$word->META_M_USERS;
		  $tpl->data = Db::run()->pdoQuery($sql)->results();
		  $tpl->pager = $pager;
	  }

      /**
       * Users::Edit()
       * 
	   * @param mixed $id
       * @return
       */
	  public function Edit($id)
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->USR_EDIT;
		  $tpl->crumbs = ['admin', Lang::$word->META_USERS, Lang::$word->META_EDIT];
	
		  if (!$row = Db::run()->first(self::mTable, null, array("id =" => $id, "AND type <>" => "owner"))) {
			  $tpl->template = 'admin/error.tpl.php';
			  $tpl->error = DEBUG ? "Invalid ID ($id) detected [users.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
		  } else {
			  $tpl->data = $row;
			  $tpl->clist = App::Content()->getCountryList();
			  $tpl->custom_fields = Content::rendertCustomFields($id, "profile");
			  $tpl->mlist = Db::run()->select(Content::mxTable)->results();
			  $tpl->template = 'admin/users.tpl.php';
		  }
	  }

      /**
       * Users::Save()
       * 
       * @return
       */
	  public function Save()
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->crumbs = ['admin', Lang::$word->META_USERS, Lang::$word->META_NEW];
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->USR_NEW;
		  $tpl->clist = App::Content()->getCountryList();
		  $tpl->custom_fields = Content::rendertCustomFields("", "profile");
		  $tpl->mlist = Db::run()->select(Content::mxTable)->results();
		  $tpl->template = 'admin/users.tpl.php';
	  }

      /**
       * Users::History()
       * 
	   * @param mixed $id
       * @return
       */
	  public function History($id)
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->META_M_HISTORY;
		  $tpl->crumbs = ['admin', Lang::$word->META_USERS, Lang::$word->META_HISTORY];
	
		  if (!$row = Db::run()->first(self::mTable, array("id", "fname", "lname"), array("id =" => $id, "AND type <>" => "owner"))) {
			  $tpl->template = 'admin/error.tpl.php';
			  $tpl->error = DEBUG ? "Invalid ID ($id) detected [users.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
		  } else {
			  $tpl->data = $row;
			  $tpl->plist = Stats::userProductPayments($id);
			  $tpl->template = 'admin/users.tpl.php';
		  }
	  }
	  
      /**
       * Users::processUser()
       * 
       * @return
       */
	  public function processUser()
	  {
		  $rules = array(
			  'fname' => array('required|string|min_len,3|max_len,60', Lang::$word->FNAME),
			  'lname' => array('required|string|min_len,3|max_len,60', Lang::$word->LNAME),
			  'email' => array('required|email', Lang::$word->EMAIL),
			  'type' => array('required|alpha', Lang::$word->USR_TYPE),
			  'active' => array('required|alpha|min_len,1|max_len,1', Lang::$word->STATUS),
			  'newsletter' => array('required|numeric', Lang::$word->USR_NLETTER),
			  );
	
		  $filters = array(
		      'membership_id' => 'numbers',
			  'notes' => 'trim|string',
			  'address' => 'string',
			  'city' => 'string',
			  'state' => 'string',
			  'zip' => 'string',
			  'country' => 'string',
			  );
	
		  (Filter::$id) ? $this->_updateUser($rules, $filters) : $this->_addUser($rules, $filters);
	  }

      /**
       * Users::_addUser()
       * 
	   * @param array $rules
	   * @param array $filters
       * @return
       */
      public function _addUser($rules, $filters)
      {

		  if(Validator::post('extend_membership')) {
			  $rules['mem_expire_submit'] = array('required|date', Lang::$word->USR_EXTEND);
		  }
		  
		  $rules['password'] = array('required|string|min_len,6|max_len,20', Lang::$word->PASSWORD);

		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
          if (!empty($safe->email)) {
			  if (Auth::emailExists($safe->email))
              Message::$msgs['email'] = Lang::$word->EMAIL_R2;
		  }
		  
		  Content::verifyCustomFields("profile");
		    
          if (empty(Message::$msgs)) {
              $salt = '';
			  $hash = App::Auth()->create_hash(Validator::cleanOut($_POST['password']), $salt);
			  $username = Utility::randomString();

              $data = array(
                  'username' => $username,
				  'email' => $safe->email,
                  'lname' => $safe->lname,
				  'fname' => $safe->fname,
				  'address' => $safe->address,
				  'city' => $safe->city,
				  'state' => $safe->state,
				  'zip' => $safe->zip,
				  'country' => $safe->country,
                  'hash' => $hash,
                  'salt' => $salt,
                  'type' => $safe->type,
				  'active' => $safe->active,
				  'newsletter' => $safe->newsletter,
				  'notes' => $safe->notes,
                  'userlevel' => ($safe->type == "staff" ? 8 : ($safe->type == "editor" ? 7 : 1)),
				  );

			  if($_POST['membership_id'] > 0) {
				  $data['mem_expire'] = Date::calculateDays($safe->membership_id);
				  $data['membership_id'] = $safe->membership_id;
			  }

			  if(Validator::post('extend_membership')) {
				  $data['mem_expire'] = Db::toDate($safe->mem_expire_submit);
			  }
			    
			  $last_id = Db::run()->insert(self::mTable, $data)->getLastInsertId();

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
			  
			  if ($last_id) {
				  $message = Message::formatSuccessMessage($data['fname'] . ' ' . $data['lname'], Lang::$word->USR_ADDED_OK);
				  Message::msgReply(true, 'success', $message);
				  
				  if (Validator::post('notify') && intval($_POST['notify']) == 1) {
					  $tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'regMailAdmin'));
					  $pass = Validator::cleanOut($_POST['password']);
					  $mailer = Mailer::sendMail();
					  $core = App::Core();

					  $body = str_replace(array(
						  '[LOGO]',
						  '[CEMAIL]',
						  '[EMAIL]',
						  '[NAME]',
						  '[DATE]',
						  '[COMPANY]',
						  '[SITE_NAME]',
						  '[USERNAME]',
						  '[PASSWORD]',
						  '[LINK]',
						  '[FB]',
						  '[TW]',
						  '[SITEURL]'), array(
						  Utility::getLogo(),
						  $core->site_email,
						  $data['email'],
						  $data['fname'] . ' ' . $data['lname'],
						  date('Y'),
						  $core->company,
						  $core->site_name,
						  $username,
						  $pass,
						  Url::url('/login'),
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
			  }
		  } else {
			  Message::msgSingleStatus();
		  }
	  }
	  
      /**
       * Users::_updateUser()
       * 
	   * @param array $rules
	   * @param array $filters
       * @return
       */
      public function _updateUser($rules, $filters)
      {

		  if(Validator::post('extend_membership')) {
			  $rules['mem_expire_submit'] = array('required|date', Lang::$word->USR_EXTEND);
		  }
		  
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
		  Content::verifyCustomFields("profile");

          if (empty(Message::$msgs)) {
              $data = array(
                  'email' => $safe->email,
                  'lname' => $safe->lname,
				  'fname' => $safe->fname,
				  'address' => $safe->address,
				  'city' => $safe->city,
				  'state' => $safe->state,
				  'zip' => $safe->zip,
				  'country' => $safe->country,
                  'type' => $safe->type,
				  'active' => $safe->active,
				  'newsletter' => $safe->newsletter,
				  'notes' => $safe->notes,
                  'userlevel' => ($safe->type == "staff" ? 8 : ($safe->type == "editor" ? 7 : 1)),
				  );
				  
              if (!empty($_POST['password'])) {
                  $salt = '';
                  $hash = App::Auth()->create_hash(Validator::cleanOut($_POST['password']), $salt);
                  $data['hash'] = $hash;
                  $data['salt'] = $salt;
              }

			  if (Validator::post('update_membership')) {
				  if($_POST['membership_id'] > 0) {
					  $data['mem_expire'] = Date::calculateDays($safe->membership_id);
					  $data['membership_id'] = $safe->membership_id;
				  } else {
					  $data['membership_id'] = 0;
				  }
			  }
			  
			  if(Validator::post('extend_membership')) {
				  $data['mem_expire'] = Db::toDate($safe->mem_expire_submit);
			  }
			  
              Db::run()->update(self::mTable, $data, array("id" => Filter::$id));
			  
			  // Start Custom Fields
			  $fl_array = Utility::array_key_exists_wildcard($_POST, 'custom_*', 'key-value');
			  if ($fl_array) {
				  $result = array();
				  foreach ($fl_array as $key => $val) {
					$cfdata['field_value'] = Validator::sanitize($val);
					Db::run()->update(Content::cfdTable, $cfdata, array("user_id" => Filter::$id, "field_name" => str_replace("custom_", "", $key)));
				  }
			  }
			  
			  $message = Message::formatSuccessMessage($data['fname'] . ' ' . $data['lname'], Lang::$word->USR_UPDATE_OK);
			  Message::msgReply(true, 'success', $message);
			  Logger::writeLog($message);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Users::updateProfile()
       * 
       * @return
       */
      public function updateProfile()
      {
		  $rules = array(
			  'fname' => array('required|string|min_len,3|max_len,60', Lang::$word->M_FNAME),
			  'lname' => array('required|string|min_len,3|max_len,60', Lang::$word->M_LNAME),
			  'email' => array('required|email', Lang::$word->M_EMAIL),
			  );
	
		  if (App::Core()->enable_tax) {
			  $rules['address'] = array('required|string|min_len,3|max_len,80', Lang::$word->M_ADDRESS);
			  $rules['city'] = array('required|string|min_len,2|max_len,80', Lang::$word->M_CITY);
			  $rules['zip'] = array('required|string|min_len,3|max_len,30', Lang::$word->M_ZIP);
			  $rules['state'] = array('required|string|min_len,2|max_len,80', Lang::$word->M_STATE);
			  $rules['country'] = array('required|string|exact_len,2', Lang::$word->M_COUNTRY);
			  
			  $filters['address'] = 'trim|string';
			  $filters['city'] = 'trim|string';
			  $filters['zip'] = 'trim|string';
			  $filters['state'] = 'trim|string';
			  $filters['country'] = 'trim|string';
		  }  

		  $filters = array(
			  'fname' => 'trim|string',
			  'lname' => 'trim|string',
			  'fb_link' => 'trim|string',
			  'tw_link' => 'trim|string',
			  'gp_link' => 'trim|string',
			  'info' => 'trim|string',
			  );
			  
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
		  Content::verifyCustomFields("profile");

          if (empty(Message::$msgs)) {
			  $data = array(
				  'email' => $safe->email,
				  'lname' => $safe->lname,
				  'fname' => $safe->fname,
				  'custom_fields' => Content::dataFields(),
				  'newsletter' => (empty($_POST['newsletter']) ? 0 : 1),
				  'info' => $safe->info,
				  'fb_link' => $safe->fb_link,
				  'tw_link' => $safe->tw_link,
				  'gp_link' => $safe->gp_link,
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

			  Db::run()->update(self::mTable, $data, array("id" => Auth::$udata->uid));
			  Message::msgReply(Db::run()->affected(), 'success', str_replace("[NAME]", "", Lang::$word->M_UPDATED));
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
       * Users::membershipInvoice()
       * 
	   * @param int $id
       * @return
       */
      public static function membershipInvoice($id)
      {

		  $sql = "
		  SELECT 
			p.*,
			m.title,
			m.description,
			DATE_FORMAT(p.created, '%Y%m%d') AS invid 
		  FROM
			`" . Product::xTable . "` AS p 
			LEFT JOIN " . Content::mxTable . " AS m 
			  ON m.id = p.membership_id 
		  WHERE p.id = ? 
			AND p.user_id = ? 
			AND p.status = ?;";
          $row = Db::run()->pdoQuery($sql, array($id, App::Auth()->uid, 1))->result();

          return ($row) ? $row : 0;
      }

      /**
       * Users::productInvoice()
       * 
	   * @param str $tid
       * @return
       */
      public static function productInvoice($tid)
      {

		  $sql = "
		  SELECT * 
		  FROM
			`" . Product::ivTable . "`
		  WHERE transaction_id = ? 
			AND user_id = ?;";
          $row = Db::run()->pdoQuery($sql, array($tid, App::Auth()->uid))->result();

          return ($row) ? $row : 0;
      }
	  
      /**
       * Users::resendNotification()
       * 
       * @return
       */
      public function resendNotification()
      {

		  $row = Db::run()->first(Users::mTable, array("email", "token", "id"), array('id' => Filter::$id));
		  $tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'regMail'));

		  $salt = '';
		  $temp = Utility::randNumbers();
		  $hash = App::Auth()->create_hash($temp, $salt);
		  $data['hash'] = $hash;
		  $data['salt'] = $salt;
		  Db::run()->update(self::mTable, $data, array("id" => $row->id));
			  
		  $mailer = Mailer::sendMail();
		  $core = App::Core();
		  
		  $body = str_replace(array(
			  '[LOGO]',
			  '[EMAIL]',
			  '[DATE]',
			  '[COMPANY]',
			  '[USERNAME]',
			  '[PASSWORD]',
			  '[LINK]',
			  '[FB]',
			  '[TW]',
			  '[SITEURL]'), array(
			  Utility::getLogo(),
			  $row->email,
			  date('Y'),
			  $core->company,
			  $row->email,
			  $temp,
			  Url::url("/login","?token=" . $row->token),
			  $core->social->facebook,
			  $core->social->twitter,
			  SITEURL), $tpl->body);

		  $msg = (new Swift_Message())
				->setSubject($tpl->subject)
				->setFrom(array($core->site_email => $core->company))
				->setTo(array($row->email))
				->setBody($body, 'text/html');

		  if($mailer->send($msg)) {
			  $json['type'] = 'success';
			  $json['title'] = Lang::$word->SUCCESS;
			  $json['message'] = Lang::$word->M_INFO5;
		  } else {
			  $json['type'] = 'error';
			  $json['title'] = Lang::$word->ERROR;
			  $json['message'] = Lang::$word->SENDERROR;
			    
		  }
         print json_encode($json);
      }

      /**
       * Users::getAllUserList()
       *
	   * @param int $id
       * @return
       */
      public function getAllUserList()
      {
          $sql = "
		  SELECT 
			id,
			CONCAT(fname, ' ',lname) as name
		  FROM
			`" . self::mTable . "`
		  WHERE active = ? 
		  ORDER BY name;";
		  
		  $row = Db::run()->pdoQuery($sql, array("y"))->results();
		  return ($row) ? $row : 0;
	  }
	  
      /**
       * Users::getRoles()
       * 
       * @return
       */
      public function getRoles()
      {

          $row = Db::run()->select(self::rTable)->results();

          return ($row) ? $row : 0;

      }

      /**
       * Users::getPrivileges()
       * 
       * @return
       */
      public function getPrivileges($id)
      {
          $sql = "
		  SELECT 
			rp.id,
			rp.active,
			p.id as prid,
			p.name,
			p.type,
			p.description,
			p.mode
		  FROM `" . self::rpTable . "` as rp 
			INNER JOIN `" . self::rTable . "` as r 
			  ON rp.rid = r.id 
			INNER JOIN `" . self::pTable . "` as p 
			  ON rp.pid = p.id 
		  WHERE rp.rid = ?
		  ORDER BY p.type;";

          $row = Db::run()->pdoQuery($sql, array($id))->results();

          return ($row) ? $row : 0;

      }
	  
      /**
       * Users::updateRoleDescription()
       * 
       * @return
       */
      public static function updateRoleDescription()
      {

          $rules = array(
              'name' => array('required|string|min_len,2|max_len,60', Lang::$word->NAME),
              'description' => array('required|string|min_len,2|max_len,150', Lang::$word->DESCRIPTION),
              );


		  $filters = array(
			  'name' => 'string',
			  'description' => 'string',
			  );
			  
          $validate = Validator::instance();
          $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
		  if (empty(Message::$msgs)) {
			  $data = array(
					'name' => $safe->name, 
					'description' => $safe->description
			  );
	          
			  Db::run()->update(self::rTable, $data, array('id' => Filter::$id));
			  Message::msgModalReply(Db::run()->affected(), 'success', Lang::$word->PS_UPDATE_OK, Validator::truncate($data['description'], 100));
		  } else {
			  Message::msgSingleStatus();
		  }
      }
  }