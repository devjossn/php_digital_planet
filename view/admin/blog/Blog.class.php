<?php
  /**
   * Blog Class
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: Blog.class.php, v5.00 2020-07-07 18:12:05 gewa Exp $
   */
  
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');

  class Blog
  {
      const mTable = "blog";
	  const cTable = "blog_categories";
	  	  
      const BLOGDATA = '/blog/data/';
	  const BLOGFILES = '/blog/datafiles/';
	  const FILES = "zip,pdf,rar,mp3";
	  const MAXIMG = 5242880;
	  const MAXFILE = 52428800;
	  
      /**
       * Blog::__construct()
       * 
       * @return
       */
      public function __construct()
      {
		  $this->Config();
	  }

      /**
       * Blog::Config()
       * 
       * @return
       */
      private function Config()
      {

          $row = File::readIni(ADMINBASE . '/blog/config.ini');
		  $this->thumb_w = $row->blog->thumb_w;
		  $this->thumb_h = $row->blog->thumb_h;
		  $this->fperpage = $row->blog->fperpage;

          return ($row) ? $this : 0;
      }
	  
      /**
       * Blog::AdminIndex()
       * 
       * @return
       */
      public function AdminIndex()
      {
		  $find = isset($_POST['find']) ? Validator::sanitize($_POST['find'], "default", 30) : null;
		  
          if (isset($_GET['letter']) and $find) {
              $letter = Validator::sanitize($_GET['letter'], 'string', 2);
              $counter = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . self::mTable . "` WHERE `title` LIKE '%" . trim($find) . "%' AND `title` REGEXP '^" . $letter . "'");
              $where = "WHERE `title` LIKE '%" . trim($find) . "%' AND d.title REGEXP '^" . $letter . "'";

          } elseif (isset($_POST['find'])) {
              $counter = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . self::mTable . "` WHERE `title` LIKE '%" . trim($find) . "%'");
              $where = "WHERE d.title LIKE '%" . trim($find) . "%'";

          } elseif (isset($_GET['letter'])) {
              $letter = Validator::sanitize($_GET['letter'], 'string', 2);
              $where = "WHERE d.title REGEXP '^" . $letter . "'";
              $counter = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . self::mTable . "` WHERE `title` REGEXP '^" . $letter . "' LIMIT 1");
          } else {
			  $counter = Db::run()->count(self::mTable);
              $where = null;
          }
		  
          if (isset($_GET['order']) and count(explode("|", $_GET['order'])) == 2) {
              list($sort, $order) = explode("|", $_GET['order']);
              $sort = Validator::sanitize($sort, "default", 16);
              $order = Validator::sanitize($order, "default", 4);
              if (in_array($sort, array(
                  "title",
                  "hits",
                  "active",
                  "category_id"))) {
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
		  SELECT 
		    d.id,
			d.category_id,
			d.hits,
			d.active,
			d.created,
			d.title,
			d.thumb,
			c.name 
		  FROM
			`" . self::mTable . "` AS d 
			LEFT JOIN `" . self::cTable . "` AS c 
			  ON c.id = d.category_id 
		  $where 
		  GROUP BY d.id
		  ORDER BY $sorting " . $pager->limit; 
		  
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->data = Db::run()->pdoQuery($sql)->results();
          $tpl->title = Lang::$word->_MOD_AM_TITLE;
		  $tpl->pager = $pager;
          $tpl->template = 'admin/blog/view/index.tpl.php';
      }

      /**
       * Blog::Edit()
       * 
       * @param int $id
       * @return
       */
      public function Edit($id)
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_AM_TITLE2;
          $tpl->crumbs = ['admin', 'blog', 'edit'];

          if (!$row = Db::run()->first(self::mTable, null, array("id" => $id))) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [Blog.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
              $tpl->data = $row;
			  $tpl->tree = $this->categoryTree();
		      $tpl->droplist = self::getCatCheckList($tpl->tree, 0, 0,"&#166;&nbsp;&nbsp;&nbsp;&nbsp;", $row->category_id);
              $tpl->template = 'admin/blog/view/index.tpl.php';
          }
      }

      /**
       * Blog::Save()
       * 
       * @return
       */
      public function Save()
      {
		  App::Session()->set("blogtoken",Utility::randNumbers(4));
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_AM_NEW;
		  $tpl->tree = $this->categoryTree();
		  $tpl->droplist = self::getCatCheckList($tpl->tree, 0, 0,"&#166;&nbsp;&nbsp;&nbsp;&nbsp;");
          $tpl->template = 'admin/blog/view/index.tpl.php';
      }
	  
      /**
       * Blog::processItem()
       * 
       * @return
       */
      public function processItem()
      {
  
		  $rules = array(
		      'title' => array('required|string|min_len,3|max_len,100', Lang::$word->NAME),
			  'show_sharing' => array('required|numeric', Lang::$word->_MOD_AM_SHARE),
			  'show_created' => array('required|numeric', Lang::$word->_MOD_AM_CREATED),
			  'category_id' => array('required|numeric', Lang::$word->CATEGORIES),
			  'active' => array('required|numeric', Lang::$word->PUBLISHED),
			  );

		  $filters = array(
			  'body' => 'advanced_tags',
			  'slug' => 'string',
			  'description' => 'string',
			  'keywords' => 'string',
			  );
		  
		  (Filter::$id) ? $this->_updateItem($rules, $filters) : $this->_addItem($rules, $filters);
		  
      }
	  
      /**
       * Blog::processItem()
       * 
	   * @param array $rules
	   * @param array $filters
       * @return
       */
      public function _updateItem($rules, $filters)
      {

		  if (!empty($_FILES['thumb']['name'])) {
			  $thumb = File::upload("thumb", self::MAXIMG, "png,jpg,jpeg");
		  }
		  
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
          if (empty(Message::$msgs)) {
              $data = array(
				  'title' => $safe->title,
				  'slug' => empty($safe->slug) ? Url::doSeo($safe->title) : Url::doSeo($safe->slug),
				  'keywords' => $safe->keywords,
				  'description' => $safe->description,
				  'body' => Url::in_url($safe->body),
                  'category_id' => $safe->category_id,
				  'show_sharing' => $safe->show_sharing,
				  'show_created' => $safe->show_created,
				  'user_id' => Auth::$userdata->id,
				  'active' => $safe->active,
                  );
				  
			  //process thumb 
			  $row = Db::run()->first(self::mTable, array("thumb"), array('id' => Filter::$id));
			  if (!empty($_FILES['thumb']['name'])) {
				  $thumbpath = FRONTBASE . self::BLOGDATA . Filter::$id . '/'; 
				  $tresult = File::process($thumb, $thumbpath, false);
				  File::deleteFile($thumbpath . $row->thumb);
				  File::deleteFile($thumbpath . 'thumbs/' . $row->thumb);
                  try {
                      $img = new Image($thumbpath . $tresult['fname']);
                      $img->thumbnail($this->thumb_w, $this->thumb_h)->save($thumbpath . 'thumbs/' . $tresult['fname']);
                  }
                  catch (exception $e) {
					  Debug::AddMessage("errors", '<i>Error</i>', $e->getMessage(), "session");
                  }
				  $data['thumb'] = $tresult['fname'];
			  }
			  
			  Db::run()->update(self::mTable, $data, array("id" => Filter::$id));
			  
			  $message = Message::formatSuccessMessage($data['title'], Lang::$word->_MOD_AM_ITM_UPDATE_OK);
			  Message::msgReply(Db::run()->affected(), 'success', $message);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Blog::_addItem()
       * 
	   * @param array $rules
	   * @param array $filters
       * @return
       */
      public function _addItem($rules, $filters)
      {

		  if (!empty($_FILES['thumb']['name'])) {
			  $thumb = File::upload("thumb", self::MAXIMG, "png,jpg,jpeg");
		  }

		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
          if (empty(Message::$msgs)) {
              $data = array(
				  'title' => $safe->title,
				  'slug' => empty($safe->slug) ? Url::doSeo($safe->title) : Url::doSeo($safe->slug),
				  'keywords' => $safe->keywords,
				  'description' => $safe->description,
				  'body' => Url::in_url($safe->body),
                  'category_id' => $safe->category_id,
				  'show_sharing' => $safe->show_sharing,
				  'show_created' => $safe->show_created,
				  'user_id' => Auth::$userdata->id,
				  'active' => $safe->active,
                  );
				  
			  $temp_id = App::Session()->get("blogtoken");
			  File::makeDirectory(FRONTBASE . self::BLOGDATA . $temp_id . '/thumbs');
			  
			  //process thumb 
			  if (!empty($_FILES['thumb']['name'])) {
				  $thumbpath = FRONTBASE . self::BLOGDATA . $temp_id . '/'; 
				  $tresult = File::process($thumb, $thumbpath, false);
                  try {
                      $img = new Image($thumbpath . $tresult['fname']);
                      $img->thumbnail($this->thumb_w, $this->thumb_h)->save($thumbpath . 'thumbs/' . $tresult['fname']);
                  }
                  catch (exception $e) {
					  Debug::AddMessage("errors", '<i>Error</i>', $e->getMessage(), "session");
                  }
				  $data['thumb'] = $tresult['fname'];
			  }
			  
			  $last_id = Db::run()->insert(self::mTable, $data)->getLastInsertId();

			  
			  //rename temp folder 
			  File::renameDirectory(FRONTBASE . self::BLOGDATA . $temp_id, FRONTBASE . self::BLOGDATA . $last_id);
				  
			  if ($last_id) {
				  $message = Message::formatSuccessMessage($data['title'], Lang::$word->_MOD_AM_ITM_ADDED_OK);
				  $json['type'] = "success";
				  $json['title'] = Lang::$word->SUCCESS;
				  $json['message'] = $message;
				  $json['redirect'] = Url::url("/admin", "blog/");
			  } else {
				  $json['type'] = "alert";
				  $json['title'] = Lang::$word->ALERT;
				  $json['message'] = Lang::$word->NOPROCCESS;
			  }
			  print json_encode($json);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Blog::CategoryEdit()
       * 
       * @param int $id
       * @return
       */
      public function CategoryEdit($id)
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_AM_UPDATECAT;
          $tpl->crumbs = ['admin', 'blog', 'category'];

          if (!$row = Db::run()->first(self::cTable, null, array("id" => $id))) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [Blog.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
              $tpl->data = $row;
			  $tpl->tree = $this->categoryTree();
		      $tpl->droplist = self::getCategoryDropList($tpl->tree, 0, 0,"&#166;&nbsp;&nbsp;&nbsp;&nbsp;", $row->parent_id);
		      $tpl->sortlist = $this->getSortCategoryList($tpl->tree);
              $tpl->template = 'admin/blog/view/index.tpl.php';
          }
      }

      /**
       * Blog::CategorySave()
       * 
       * @return
       */
      public function CategorySave()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_AM_CATS;
		  $tpl->tree = $this->categoryTree();
		  $tpl->droplist = self::getCategoryDropList($tpl->tree, 0, 0,"&#166;&nbsp;&nbsp;&nbsp;&nbsp;");
		  $tpl->sortlist = $this->getSortCategoryList($tpl->tree);
          $tpl->template = 'admin/blog/view/index.tpl.php';
      }

      /**
       * Blog::processCategory()
       * 
       * @return
       */
	  public function processCategory()
	  {

		  $rules = array(
		      'name' => array('required|string|min_len,3|max_len,100', Lang::$word->NAME),
			  'parent_id' => array('required|numeric', Lang::$word->_MOD_AM_PARENT),
			  'perpage' => array('required|numeric', Lang::$word->_MOD_AM_IPC),
			  'active' => array('required|numeric', Lang::$word->PUBLISHED),
			  );

		  $filters = array(
		      'name' => 'string',
			  'slug' => 'string',
			  'keywords' => 'string',
			  'description' => 'string',
		  );
		  
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
		  if (empty(Message::$msgs)) {
			  $data = array(
				  'name' => $safe->name,
				  'slug' => empty($safe->slug) ? Url::doSeo($safe->name) : Url::doSeo($safe->slug),
				  'parent_id' => $safe->parent_id,
				  'perpage' => $safe->perpage,
				  'keywords' => $safe->keywords,
				  'description' => $safe->description,
				  'active' => $safe->active,
				  );
			  
	
			  (Filter::$id) ? Db::run()->update(self::cTable, $data, array("id" => Filter::$id)) : $last_id = Db::run()->insert(self::cTable, $data)->getLastInsertId();
			  if (Filter::$id) {
				  $message = Message::formatSuccessMessage($data['name'], Lang::$word->_MOD_AM_CAT_UPDATE_OK);
				  Message::msgReply(Db::run()->affected(), 'success', $message);
			  } else {
				  if ($last_id) {
					  $message = Message::formatSuccessMessage($data['name'], Lang::$word->_MOD_AM_CAT_ADDED_OK);
					  $json['type'] = "success";
					  $json['title'] = Lang::$word->SUCCESS;
					  $json['message'] = $message;
					  $json['redirect'] = Url::url("/admin/blog/categories");
				  } else {
					  $json['type'] = "alert";
					  $json['title'] = Lang::$word->ALERT;
					  $json['message'] = Lang::$word->NOPROCCESS;
				  }
				  print json_encode($json);
			  }
		  } else {
			  Message::msgSingleStatus();
		  }
	  }
	  
      /**
       * Blog::categoryTree()
       * 
       * @return
       */
	  public function categoryTree()
	  {
	
		  $data = Db::run()->select(self::cTable, array("id", "parent_id"," name"), null,'ORDER BY parent_id, sorting')->results();
	
		  $cats = array();
		  $result = array();
	
		  foreach ($data as $row) {
			  $cats['id'] = $row->id;
			  $cats['name'] = $row->name;
			  $cats['parent_id'] = $row->parent_id;
			  $result[$row->id] = $cats;
		  }
		  return $result;
	  }

      /**
       * Blog::getCategoryDropList()
       * 
	   * @param mixed $array
	   * @param mixed $parent_id
	   * @param integer $level
	   * @param mixed $spacer
	   * @param bool $selected
       * @return
       */
	  public static function getCategoryDropList($array, $parent_id, $level = 0, $spacer = "--", $selected = false)
	  {
		  $html = '';
		  if ($array) {
			  foreach ($array as $key => $row) {
				  $sel = ($row['id'] == $selected) ? " selected=\"selected\"" : "";
	
				  if ($parent_id == $row['parent_id']) {
					  $html .= "<option value=\"" . $row['id'] . "\"" . $sel . ">";
	
					  for ($i = 0; $i < $level; $i++)
						  $html .= $spacer;
	
					  $html .= $row['name'] . "</option>\n";
					  $level++;
					  $html .= self::getCategoryDropList($array, $key, $level, $spacer, $selected);
					  $level--;
				  }
			  }
			  unset($row);
		  }
		  return $html;
	  }

      /**
       * Blog::getCatCheckList()
       * 
	   * @param mixed $array
	   * @param mixed $parent_id
	   * @param integer $level
	   * @param mixed $spacer
	   * @param bool $selected
       * @return
       */
	  public function getCatCheckList($array, $parent_id, $level = 0, $spacer = "--", $selected = false)
	  {

		  $html = '';
		  if ($array) {
			  if($selected) {
				$arr = explode(",", $selected);
				reset($arr);
			  }
			  foreach ($array as $key => $row) {
				  $active = ($selected and $row['id'] == $selected) ? " checked=\"checked\"" : "";
	
				  if ($parent_id == $row['parent_id']) {
					  $html .= "<div class=\"item\"><div class=\"wojo checkbox small fitted inline\"> <input id=\"ckb_" . $row['id'] . "\" type=\"radio\" name=\"category_id\" value=\"" . $row['id'] . "\"" . $active . ">";
					  $html .= "<label for=\"ckb_" . $row['id'] . "\">";
					  for ($i = 0; $i < $level; $i++)
						  $html .= $spacer;
					  
					  $html .= $row['name'] . "</label></div></div>\n";
					  $level++;
					  $html .= self::getCatCheckList($array, $key, $level, $spacer, $selected);
					  $level--;
				  }
			  }
			  unset($row);
		  }
		  return $html;
	  }

            
      /**
       * Blog::getSortCategoryList()
       * 
	   * @param array $array
       * @param integer $parent_id
       * @return
       */
	  public function getSortCategoryList($array, $parent_id = 0)
	  {
		  
		  $submenu = false;
		  $class = ($parent_id == 0) ? "parent" : "child";
		  $icon =  '<i class="icon negative trash"></i>';
		  $html = '';
	
		  foreach ($array as $key => $row) {
			  if ($row['parent_id'] == $parent_id) {
				  if ($submenu === false) {
					  $submenu = true;
					  $html .= "<ol class=\"dd-list\">\n";
				  }
				  $html .= '<li class="dd-item dd3-item clearfix" data-id="' . $row['id'] . '"><div class="dd-handle dd3-handle"></div>' 
				  . '<div class="dd3-content"><span class="actions"><a class="delCategory" data-set=\'{"option":[{"delete": "deleteCategory","title": "' . Validator::sanitize($row['name'], "chars") . '","id":' . $row['id'] . '}],"action":"delete","parent":"li"}\'>' . $icon . '</a></span>'
				  . ' <a href="' . Url::url("/admin/blog/category", $row['id']) . '">' . $row['name'] . '</a>' 
				  . '</div>';
				  $html .= $this->getSortCategoryList($array, $key);
				  $html .= "</li>\n";
			  }
		  }
		  unset($row);
	
		  if ($submenu === true) {
			  $html .= "</ol>\n";
		  }
		  
		  return $html;
	  }

      /**
       * Blog::Settings()
       * 
       * @return
       */
      public function Settings()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_AM_CONF;
		  $tpl->data = $this->Config();
          $tpl->template = 'admin/blog/view/index.tpl.php';
      }

      /**
       * Blog::processConfig()
       * 
       * @return
       */
	  public function processConfig()
	  {
	
		  $rules = array(
			  'fperpage' => array('required|numeric', Lang::$word->_MOD_AM_LATEST),
			  'thumb_w' => array('required|numeric|min_len,3|max_len,3', Lang::$word->_MOD_AM_THUMB_W),
			  'thumb_h' => array('required|numeric|min_len,3|max_len,3', Lang::$word->_MOD_AM_THUMB_H),
			  );
			  
	      $filters = array('blacklist_words' => 'trim|string');
		  
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
	
		  if (empty(Message::$msgs)) {
			  $data = array('blog' => array(
					  'fperpage' => $safe->fperpage,
					  'thumb_w' => $safe->thumb_w,
					  'thumb_h' => $safe->thumb_h,
					  ));
	
			  Message::msgReply(File::writeIni(ADMINBASE . '/blog/config.ini', $data), 'success', Lang::$word->_MOD_AM_CUPDATED);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Blog::catList()
       * 
       * @return
       */
      public function catList()
	  {

		  $sql = "
		  SELECT 
			c.id,
			c.parent_id,
			c.name,
			c.slug 
		  FROM `" . self::cTable . "` AS c
		  GROUP BY c.id
		  ORDER BY parent_id, sorting;";

		  $menu = array();
		  $result = array();
		  
		  if($data = Db::run()->pdoQuery($sql)->results()) {
			  foreach ($data as $row) {
				  $menu['id'] = $row->id;
				  $menu['name'] = $row->name;
				  $menu['parent_id'] = $row->parent_id;
				  $menu['slug'] = $row->slug;
				  
				  $result[$row->id] = $menu;
			  }
		  }
		  return $result;
	  }
	  
	  /**
	   * Blog::renderCategories()
	   * 
	   * @return
	   */
	  public function renderCategories($array, $parent_id = 0, $menuid = 'blogcats', $class = 'vertical-menu')
	  {
		  $html = '';
		  if(is_array($array) && count($array) > 0) {
			  $submenu = false;
			  $attr = (!$parent_id) ? ' class="' . $class . '" id="' . $menuid . '"' : ' class="menu-submenu"';
			  $attr2 = (!$parent_id) ? ' class="nav-item"' : ' class="nav-submenu-item"';
			  $icon = (!$parent_id) ? '<i class="icon open folder"></i>' :null ;
			  
			  foreach ($array as $key => $row) {
				  if ($row['parent_id'] == $parent_id) {
					  if ($submenu === false) {
						  $submenu = true;
						  
						  $html .= "<ul" . $attr . ">\n";
					  }
	
					  $url = Url::Url('/blog/category', $row['slug'] . Url::buildQuery());
	
					  //$counter =  '<span>('.$row['items'].')</span> ';
					  $active = (isset(Content::$segments[2]) and Content::$segments[2] == $row['slug']) ? " active" : "normal";
					  $link = '<a href="' . $url . '" class="' . $active . '" title="' . $row['name'] . '">' . $row['name'] . '</a>';
					  
					  $html .= "<li>";
					  $html .= $link;
					  $html .= $this->renderCategories($array, $key);
					  $html .= "</li>\n";
				  }
			  }
			  unset($row);
			  
			  if ($submenu === true)
				  $html .= "</ul>\n";
		  }
          return $html;
      }
	  
      /**
       * Blog::FrontIndex()
       * 
       * @return
       */
      public function FrontIndex()
      {
		  
		  $core = App::Core();
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "front/themes/" . $core->theme . "/";
          $tpl->title = Lang::$word->_MOD_AM_LATEST_TITLE . ' - ' . $core->company;
		  $tpl->keywords = null;
		  $tpl->description = null;
		  $tpl->core = $core;

          $pager = Paginator::instance();
          $pager->items_total = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . self::mTable . "` WHERE active = 1 LIMIT 1");
          $pager->default_ipp = $this->fperpage;
          $pager->path = Url::url(Router::$path, "?");
          $pager->paginate();
		  
          $sql = "
		  SELECT 
		    a.id,
			a.created,
			a.title,
			a.slug,
			a.body,
			a.thumb,
			c.slug AS cslug,
			c.name AS ctitle
		  FROM
			`" . self::mTable . "` AS a
			LEFT JOIN `" . self::cTable . "` AS c
			ON c.id = a.category_id
		  WHERE a.active = ?  
		  ORDER BY a.created DESC " . $pager->limit; 
		  
		  $tpl->rows = Db::run()->pdoQuery($sql, array(1))->results();
		  $tpl->pager = $pager;
		  
		  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), strtolower(Lang::$word->_MOD_AM_BLOG)];
		  $tpl->template = 'front/themes/' . $core->theme . '/blog.tpl.php';

	  }

      /**
       * Blog::Category()
       * 
	   * @param str $slug
       * @return
       */
      public function Category($slug)
      {
		  
		  $core = App::Core();
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "front/themes/" . $core->theme . "/";
		  $tpl->title = $core->company;
		  $tpl->core = $core;
		  $tpl->keywords = null;
		  $tpl->description = null;
	
		  if (!$tpl->row = Db::run()->first(self::cTable, null, array("slug" => $slug))) {
			  if (DEBUG) {
				  $tpl->template = 'admin/error.tpl.php';
				  $tpl->error = "Invalid slug ($slug) detected [Blog.class.php, ln.:" . __line__ . "]";
			  } else {
				  $tpl->template = 'front/themes/' . $core->theme . '/404.tpl.php';
			  }
		  } else {

			  $pSql = "
			  SELECT 
				COUNT(a.id) 
			  FROM
				`" . self::mTable . "` AS a 
			  WHERE a.category_id = " . $tpl->row->id . " 
				AND a.active = 1 
			  LIMIT 1;";
		  
			  $pager = Paginator::instance();
			  $pager->items_total = Db::run()->count(false, false, $pSql);
			  $pager->default_ipp = $tpl->row->perpage;
			  $pager->path = Url::url(Router::$path, "?");
			  $pager->paginate();

			  $sql = "
			  SELECT 
				a.id,
				a.created,
				a.title,
				a.slug,
				a.body,
				a.thumb,
				c.slug AS cslug,
				c.name AS ctitle 
			  FROM
				`" . self::mTable . "` AS a
				LEFT JOIN `" . self::cTable . "` AS c
				  ON c.id = a.category_id
			  WHERE a.category_id = ?
			  AND a.active = ? 
			  AND c.active = ?  
			  GROUP BY a.id
			  ORDER BY created DESC " . $pager->limit; 

			  $tpl->rows = Db::run()->pdoQuery($sql, array($tpl->row->id, 1, 1))->results();
			  $tpl->conf = $this;
	
			  $tpl->title = $tpl->row->name. ' - ' . Lang::$word->_MOD_AM_BLOG . ' - ' . $core->company;
			  $tpl->keywords = $tpl->row->keywords;
			  $tpl->description = $tpl->row->description;
			  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), 'blog', $tpl->row->name];
			  
			  $tpl->pager = $pager;
			  $tpl->template = 'front/themes/' . $core->theme . '/blog.tpl.php';
		  }

	  }
	  
      /**
       * Blog::Render()
       * 
	   * @param str $slug
       * @return
       */
	  public function Render($slug)
	  {
		  $core = App::Core();
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "front/themes/" . $core->theme . "/";
		  $tpl->title = $core->company;
		  $tpl->keywords = null;
		  $tpl->description = null;
		  $tpl->core = $core;
		  
		  $sql = "
		  SELECT 
			a.*,
			a.slug,
			c.slug as catslug,
			c.name as catname,
			CONCAT(u.fname,' ',u.lname) as user,
			u.username 
		  FROM
			`" . self::mTable . "` AS a
			LEFT JOIN `" . Users::mTable . "` AS u 
			  ON u.id = a.user_id
			LEFT JOIN `" . self::cTable . "` AS c 
			  ON c.id = a.category_id
		  WHERE a.slug = ?
		  AND a.active = ? 
		  GROUP BY a.id;";
	
		  if (!$tpl->row = Db::run()->pdoQuery($sql, array($slug, 1))->result()) {
			  if (DEBUG) {
				  $tpl->template = 'admin/error.tpl.php';
				  $tpl->error = "Invalid slug ($slug) detected [Blog.class.php, ln.:" . __line__ . "]";
			  } else {
				  $tpl->template = 'front/themes/' . $core->theme . '/404.tpl.php';
			  }
		  } else {
			  $this->doHits($tpl->row->id);
			  $tpl->title = $tpl->row->title. ' - ' . Lang::$word->_MOD_AM_BLOG . ' - ' . $core->company;
			  $tpl->keywords = $tpl->row->keywords;
			  $tpl->description = $tpl->row->description;
			  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), 'blog', $tpl->row->title];
	
			  $tpl->conf = $this;
			  $tpl->template = 'front/themes/' . $core->theme . '/blog.tpl.php';
		  }
	  }

      /**
       * Blog::doHits()
       * 
	   * @param int $id
       * @return
       */
      public function doHits($id)
      {
		  
		  Db::run()->pdoQuery("
			  UPDATE `" . self::mTable . "` 
			  SET `hits` = `hits` + 1 
			  WHERE id = " . $id . ";
		  ");
	  }
	  
      /**
       * Blog::Sitemap()
       * 
       * @return
       */
      public function Sitemap()
      {
		  
		  return Db::run()->select(self::mTable, array("title", "slug"), array("active" => 1))->results();
	  }

      /**
       * Blog::hasThumb()
       * 
	   * @param str $thumb
	   * @param str $id
       * @return
       */
      public static function hasThumb($thumb, $id)
      {

          if($thumb) {
			  return FRONTVIEW . self::BLOGDATA . $id . '/thumbs/' . $thumb;
		  } else {
			  return UPLOADURL . '/blank.jpg';
		  }
      }
	  
      /**
       * Blog::hasImage()
       * 
	   * @param str $image
	   * @param str $id
       * @return
       */
      public static function hasImage($image, $id)
      {

          if($image) {
			  return FRONTVIEW . self::BLOGDATA . $id . '/' . $image;
		  } else {
			  return UPLOADURL . '/blank.jpg';
		  }
      } 
  }