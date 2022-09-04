<?php
  /**
   * Comments Class
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: comments.class.php, v1.00 2020-04-20 18:20:24 gewa Exp $
   */

  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');


  class Comments
  {

      const mTable = "comments";

      /**
       * Comments::__construct()
       * 
       * @return
       */
      public function __construct()
      {
          $this->Config();
      }
	  
      /**
       * Comments::Config()
       * 
       * @return
       */
      private function Config()
      {

          $row = File::readIni(ADMINBASE . '/snippets/comments.ini');
          $this->auto_approve = $row->comments->auto_approve;
          $this->rating = $row->comments->rating;
		  $this->timesince = $row->comments->timesince;
          $this->blacklist_words = $row->comments->blacklist_words;
          $this->char_limit = $row->comments->char_limit;
          $this->dateformat = $row->comments->dateformat;
          $this->notify_new = $row->comments->notify_new;
          $this->perpage = $row->comments->perpage;
          $this->public_access = $row->comments->public_access;
          $this->show_captcha = $row->comments->show_captcha;
          $this->sorting = $row->comments->sorting;
          $this->name_req = $row->comments->name_req;

          return ($row) ? $this : 0;
      }

      /**
       * Comments::Index()
       * 
       * @return
       */
      public function Index()
      {

          $counter = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . self::mTable . "` WHERE active = 0 LIMIT 1");
          $pager = Paginator::instance();
          $pager->items_total = $counter;
          $pager->default_ipp = App::Core()->perpage;
          $pager->path = Url::url(Router::$path, "?");
          $pager->paginate();

          $sql = "		
		  SELECT 
			c.id,
			c.user_id,
			c.parent_id,
			c.product_id,
			c.body,
			c.created,
			c.username as uname,
			u.username,
			CONCAT(u.fname, ' ', u.lname) AS name
		  FROM
			`" . self::mTable . "` AS c 
			LEFT JOIN `" . Users::mTable . "` AS u 
			  ON u.id = c.user_id 
		  WHERE c.active = ?
		  ORDER BY c.created DESC " . $pager->limit . ";";
				
          $rows = Db::run()->pdoQuery($sql, array(0))->results();
		  
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->data = $rows;
          $tpl->title = Lang::$word->META_M_COMMENTS;
		  $tpl->crumbs = ['admin', Lang::$word->META_COMMENTS];
		  $tpl->pager = $pager;
          $tpl->template = 'admin/comments.tpl.php';
      }

      /**
       * Comments::Settings()
       * 
       * @return
       */
      public function Settings()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->META_M_CONFIGURE;
		  $tpl->crumbs = ['admin', Lang::$word->META_COMMENTS, Lang::$word->META_M_CONFIGURE];
          $tpl->row = $this->Config();
          $tpl->template = 'admin/comments.tpl.php';
      }
	  
      /**
       * Comments::processConfig()
       * 
       * @return
       */
      public function processConfig()
      {
			  
          $rules = array(
              'auto_approve' => array('required|numeric', Lang::$word->CMT_AUTOA),
              'rating' => array('required|numeric', Lang::$word->CMT_RATING),
              'char_limit' => array('required|numeric', Lang::$word->CMT_CHARS),
              'notify_new' => array('required|numeric', Lang::$word->CMT_NOTIFY),
              'perpage' => array('required|numeric', Lang::$word->CMT_CPP),
              'public_access' => array('required|numeric', Lang::$word->CMT_PUBLIC),
              'show_captcha' => array('required|numeric', Lang::$word->CMT_SHOWCAP),
              'sorting' => array('required|string|min_len,3|max_len,4', Lang::$word->CMT_SORTING),
              'dateformat' => array('required|string', Lang::$word->CMT_DATEFORMAT),
              'name_req' => array('required|numeric', Lang::$word->CMT_NAMEREQ),
              );
			  
		  $filters = array(
			  'dateformat' => 'string',
			  'blacklist_words' => 'string|trim',
			  'sorting' => 'string|trim',
			  );

          $validate = Validator::instance();
          $safe = $validate->doValidate($_POST, $rules);
          $safe = $validate->doFilter($_POST, $filters);

          if (empty(Message::$msgs)) {
              $data = array('comments' => array(
                      'auto_approve' => $safe->auto_approve,
                      'rating' => $safe->rating,
                      'char_limit' => $safe->char_limit,
                      'notify_new' => $safe->notify_new,
                      'perpage' => $safe->perpage,
                      'public_access' => $safe->public_access,
                      'show_captcha' => $safe->show_captcha,
                      'sorting' => $safe->sorting,
                      'dateformat' => $safe->dateformat,
					  'timesince' => (empty($_POST['timesince']) ? 0 : 1),
                      'name_req' => $safe->name_req,
                      'blacklist_words' => $safe->blacklist_words,
                      ));

              Message::msgReply(File::writeIni(ADMINBASE . '/snippets/comments.ini', $data), 'success', Lang::$word->CMT_UPDATE_OK);
              Logger::writeLog(Lang::$word->CMT_UPDATE_OK);
          } else {
              Message::msgSingleStatus();          
          }
      }
	  
      /**
       * Comments::commentTree()
       * 
       * @param int $id
       * @return
       */
      public function commentTree($id)
      {

          $counter = "
		  SELECT 
			COUNT(*) 
		  FROM
			`" . self::mTable . "` 
		  WHERE parent_id = 0 
			AND product_id = $id 
			AND active = 1 
		  LIMIT 1;";

          $pager = Paginator::instance();
          $pager->items_total = Db::run()->count(false, false, $counter);
          $pager->default_ipp = $this->perpage;
          $pager->path = Url::url(Router::$path, "?");
          $pager->paginate();

          if (isset($_GET['order']) and count(explode("|", $_GET['order'])) == 2) {
              list($sort, $order) = explode("|", $_GET['order']);
              $sort = Validator::sanitize($sort, "default", 16);
              $order = Validator::sanitize($order, "default", 4);
              if (in_array($sort, array(
                  "vote_up",
                  "vote_down",
                  "created"))) {
                  $ord = ($order == 'DESC') ? " DESC" : " ASC";
                  $sorting = $sort . $ord;
              } else {
                  $sorting = " created " . $this->sorting;
              }
          } else {
              $sorting = " created " . $this->sorting;
          }

          $sql = "		
		  SELECT 
			c.id,
			c.user_id,
			c.product_id,
			c.parent_id,
			c.vote_down,
			c.vote_up,
			c.body,
			c.created,
			c.rating,
			c.username as uname,
			u.username,
			CONCAT(u.fname, ' ', u.lname) AS name,
			u.avatar 
		  FROM
			`" . self::mTable . "` AS c 
			INNER JOIN 
			  (SELECT 
				id 
			  FROM
				`" . self::mTable . "` 
			  WHERE product_id = ? 
				AND parent_id = 0
				AND active = 1 
			  ORDER BY $sorting 
			  " . $pager->limit . ") AS ch 
			  ON ch.id IN (c.id, c.parent_id) 
			LEFT JOIN `" . Users::mTable . "` AS u 
			  ON u.id = c.user_id 
				WHERE product_id = ? 
				AND c.active = 1
		  ORDER BY $sorting;";

          $data = Db::run()->pdoQuery($sql, array($id, $id))->results();

          $comments = array();
          $result = array();

          foreach ($data as $row) {
              $comments['id'] = $row->id;
              $comments['user_id'] = $row->user_id;
              $comments['product_id'] = $row->product_id;
			  $comments['parent_id'] = $row->parent_id;
              $comments['vote_up'] = $row->vote_up;
              $comments['vote_down'] = $row->vote_down;
			  $comments['rating'] = $row->rating;
              $comments['parent_id'] = $row->parent_id;
              $comments['body'] = $row->body;
              $comments['created'] = $row->created;
              $comments['name'] = $row->name;
              $comments['username'] = $row->username;
              $comments['uname'] = $row->uname;
              $comments['avatar'] = $row->avatar;
              $result[$row->id] = $comments;
          }
          return $result;
      }
	  
      /**
       * Comments::getCommentList()
       * 
       * @param array $array
       * @param integer $parent_id
       * @param str $class
       * @return
       */
	  public function getCommentList($array, $parent_id = 0, $class = 'threaded')
	  {
	
		  $submenu = false;
		  $class = ($parent_id == 0) ? "wojo comments $class" : "comments";
		  $delete = (App::Auth()->is_Admin()) ? '<a class="delete"><i class="icon trash"></i></a>' : null;
		  $html = '';
	
		  foreach ($array as $key => $row) {
			  if ($row['parent_id'] == $parent_id) {
				  if ($submenu === false) {
					  $submenu = true;
					  $html .= "<div class=\"$class\">\n";
				  }
				  if ($row['uname']) {
					  $user = '<span class="author">' . $row['uname'] . '</span>';
					  $avatar = '<div class="avatar"><img src="' . UPLOADURL . '/avatars/blank.svg" alt=""></div>';
				  } else {
					  $user = $row['name'];
					  $avatar = '<a class="avatar"><img src="' . UPLOADURL . '/avatars/' . ($row['avatar'] ? $row['avatar'] : "blank.svg") . '" alt=""></a>';
				  }
	
				  $html .= '<div class="comment" data-id="' . $row['id'] . '" id="comment_' . $row['id'] . '">';
				  $html .= $avatar;
				  $html .= '<div class="content">';
				  $html .= $user;
				  $html .= '<div class="metadata">';
				  $html .= '<span class="date">' . ($this->timesince) ? Date::timesince($row['created']) : Date::doDate($this->dateformat, $row['created']) . '</span>';
				  
				  if($parent_id == 0) {
					  $html .= '<div class="wojo stars">';
					  for ($x = 1; $x <= $row['rating']; $x++) {
						  $html .= '<span class="star active"><i class="icon star full"></i></span>';
					  }
					  while ($x <= 5) {
						  $html .= '<span class="star"><i class="icon star"></i></span>';
						  $x++;
					  }
					  $html .= '</div>';
				  }
				  
				  $html .= $delete;
				  $html .= '</div>';
				  $html .= '<div class="description">' . $row['body'] . '</div>';
				  $html .= '<div class="wojo horizontal divided flex list align-middle actions">';
				  if ($this->rating) {
					  $html .= '<a data-up="' . $row['vote_up'] . '" data-id="' . $row['id'] . '" 
						  class="item up"><span class="wojo positive text">' . $row['vote_up'] . '</span> <i class="icon chevron up"></i></a>';
					  $html .= '<a data-down="' . $row['vote_down'] . '" data-id="' . $row['id'] . '" 
						  class="item down"><span class="wojo negative text">' . $row['vote_down'] . '</span> <i class="icon chevron down"></i></a>';
				  }
				  if ($parent_id == 0) {
					  $html .= '<a data-id="' . $row['id'] . '" class="item replay">' . Lang::$word->CMT_REPLAY . '</a>';
				  }
				  $html .= '</div>';
				  $html .= '</div>';
				  $html .= $this->getCommentList($array, $key);
				  $html .= "</div>\n";
			  }
		  }
		  unset($row);
	
		  if ($submenu === true) {
			  $html .= "</div>\n";
		  }
	
		  return $html;
	  }
	  
      /**
       * Comments::Render()
       * 
       * @param int $id
       * @return
       */
      public static function Render($id)
      {
          return App::Comments()->getCommentList(App::Comments()->commentTree($id));
      }
	  
      /**
       * Comments::processComment()
       * 
       * @return
       */
	  public function processComment()
	  {

		  $rules = array(
			  'id' => array('required|numeric', "Invalid ID detected"),
			  'username' => array('required|string', Lang::$word->NAME),
			  'message' => array('required|string|min_len,10', Lang::$word->MESSAGE),
			  'parent_id' => array('required|numeric', "Invalid PID detected"),
			  'product_id' => array('required|numeric', "Invalid PID detected"),
			  'url' => array('required|string', "Invalid URI detected"),
			  );
          
		  $filters = array(
			  'message' => 'trim|string',
			  'type' => 'trim|string',
			  'url' => 'trim|string',
			  'username' => 'trim|string',
		  );
		  
		  if($this->show_captcha) {
			  if($_POST['action'] != "reply") {
				  if (App::Session()->get('wcaptcha') != $_POST['captcha'])
					  Message::$msgs['captcha'] = Lang::$word->CAPTCHA; 
			  }
		  }
		  
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  $core = App::Core();
		  
		  if (empty(Message::$msgs)) {
              $data = array(
                  'parent_id' => ($safe->parent_id == -1) ? 0 : $safe->parent_id,
				  'user_id' => (App::Auth()->logged_in) ? App::Auth()->uid : 0,
                  'product_id' => $safe->product_id,
				  'username' => (App::Auth()->logged_in) ? App::Auth()->name : $safe->username,
				  'rating' => (isset($_POST['rating'])) ? intval($_POST['rating']) : 0,
                  'body' => Validator::censored($safe->message, $this->blacklist_words),
				  'www' => Url::getIP(),
                  'active' => ($this->auto_approve) ? 1 : 0,
				  );
			  
			  $last_id = Db::run()->insert(self::mTable, $data)->getLastInsertId();
			  
			  // Set product raings
              if($safe->parent_id == -1) {
				  $db = Db::run()->prepare("UPDATE `" . Product::mTable . "` SET `ratings` = `ratings` + 1, `likes` = `likes` + " . $data['rating'] . " WHERE `id` = :id;");
				  $db->execute(array('id' => $safe->product_id));
			  }
			  
			  if($this->auto_approve) {
				  $message = Lang::$word->CMT_MSGOK1;
				  $tpl = App::View(PLUGINBASE . '/comments/'); 
				  $tpl->template = '_loadComment.tpl.php'; 
				  $tpl->data = $this->singleComment($last_id);
				  $tpl->conf = $this;
				  $json['counter'] = intval($_POST['counter']);
				  $json['html'] = $tpl->render(); 
			  } else {
				  $message = Lang::$word->CMT_MSGOK2;
			  }

			  $json['type'] = 'success';
			  $json['title'] = Lang::$word->SUCCESS;
			  $json['message'] = $message;
			  print json_encode($json);
			  
			  if($this->notify_new) {
				  $user = (App::Auth()->logged_in) ? App::Auth()->name : $safe->username;
				  $mailer = Mailer::sendMail();
				  $tpl = Db::run()->first(Content::eTable, array("body", "subject"), array('typeid' => 'newComment'));
				  $body = str_replace(array(
					  '[LOGO]',
					  '[CEMAIL]',
					  '[DATE]',
					  '[COMPANY]',
					  '[NAME]',
					  '[MESSAGE]',
					  '[PAGEURL]',
					  '[IP]',
					  '[FB]',
					  '[TW]',
					  '[SITEURL]'), array(
					  Utility::getLogo(),
					  $core->site_email,
					  date('Y'),
					  $core->company,
					  $user,
					  $data['body'],
					  SITEURL . $safe->url,
					  Url::getIP(),
					  $core->social->facebook,
					  $core->social->twitter,
					  SITEURL), $tpl->body);
		
				  $msg = (new Swift_Message())
						->setSubject($tpl->subject)
						->setTo(array($core->site_email => $core->company))
						->setFrom(array($core->site_email => $user))
						->setBody($body, 'text/html'
						);
				  $mailer->send($msg); 
			  }
			 
		  } else {
			  Message::msgSingleStatus();
		  }
	  }
	  
      /**
       * Comments::singleComment()
       * 
       * @param int $id
       * @return
       */
      public static function singleComment($id)
      {
          $sql = "		
		  SELECT 
			c.id,
			c.user_id,
			c.product_id,
			c.parent_id,
			c.vote_down,
			c.vote_up,
			c.rating,
			c.body,
			c.created,
			c.username AS uname,
			u.username,
			CONCAT(u.fname, ' ', u.lname) AS name,
			u.avatar 
		  FROM
			`" . self::mTable . "` AS c 
			LEFT JOIN `" . Users::mTable . "` AS u 
			  ON u.id = c.user_id 
		  WHERE c.id = ?;";
				
          $row = Db::run()->pdoQuery($sql, array($id))->result();
		  
          return ($row) ? $row : 0;
      }
  }