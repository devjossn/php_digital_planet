<?php
  /**
   * Content Class
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2016
   * @version $Id: content.class.php, v1.00 2016-04-20 18:20:24 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  

  class Content
  {

      const mTable = "menus";
      const pTable = "pages";
	  const cTable = "categories";
	  const crTable = "categories_related";
	  const cnTable = "countries";
	  const dcTable = "coupons";
	  const fTable = "faq";
	  const mxTable = "memberships";
	  const mxhTable = "membership_history";
	  const eTable = "email_templates";
	  const cfTable = "custom_fields";
	  const cfdTable = "custom_fields_data";
	  const nTable = "news";
	  const wTable = "wishlist";
	  const xTable = "cart";
	  
	  public static $segments = array();
	  

      /**
       * Content::__construct()
       * 
       * @return
       */
      public function __construct()
      {

      }

      /**
       * Content::Menus()
       * 
       * @return
       */
      public function Menus()
      {

		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->crumbs = ['admin', Lang::$word->META_MENUS];
		  $tpl->template = 'admin/menus.tpl.php';
		  $tpl->contenttype = self::getContentType();
		  $tpl->tree = Db::run()->select(self::mTable, null, null,'ORDER BY sorting')->results();
		  $tpl->sortlist = $this->getSortMenuList($tpl->tree);
		  $tpl->title = Lang::$word->META_M_MENUS; 

      }

      /**
       * Content::MenuEdit()
       * 
       * @return
       */
      public function MenuEdit($id)
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->MU_EDIT;
          $tpl->crumbs = ['admin', Lang::$word->META_MENUS, Lang::$word->META_EDIT];

          if (!$row = Db::run()->first(self::mTable, null, array("id" => $id))) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [Content.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
              $tpl->data = $row;
			  $tpl->contenttype = self::getContentType();
		      $tpl->tree = Db::run()->select(self::mTable, null, null,'ORDER BY sorting')->results();
		      $tpl->sortlist = $this->getSortMenuList($tpl->tree);
			  $tpl->pagelist = $this->getPageList();
              $tpl->template = 'admin/menus.tpl.php';
          }
      }

      /**
       * Content::processMenu()
       * 
       * @return
       */
	  public function processMenu()
	  {

		  $rules = array(
		      'name' => array('required|string|min_len,3|max_len,100', Lang::$word->NAME),
			  'content_type' => array('required|string|min_len,3|max_len,8', Lang::$word->MU_TYPE),
			  'active' => array('required|numeric', Lang::$word->PUBLISHED),
			  );

		  $filters = array(
			  'name' => 'string',
		  );

		  if ($_POST['content_type'] == "page" and empty($_POST['page_id'])) {
			  Message::$msgs['page_id'] = Lang::$word->MU_PAGE;
		  }
		  
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
		  if (empty(Message::$msgs)) {
			  $data = array(
				  'name' => $safe->name,
				  'content_type' => $safe->content_type,
				  'link' => (isset($_POST['web'])) ? Validator::sanitize($_POST['web']) : "NULL",
				  'target' => (isset($_POST['target'])) ? Validator::sanitize($_POST['target'], "db") : "NULL",
				  'page_id' => (isset($_POST['page_id'])) ? Validator::sanitize($_POST['page_id'], "int") : 0,
				  'active' => $safe->active,
				  );
	
			  (Filter::$id) ? Db::run()->update(self::mTable, $data, array("id" => Filter::$id)) : $last_id = Db::run()->insert(self::mTable, $data)->getLastInsertId();
			  if (Filter::$id) {
				  $message = Message::formatSuccessMessage($data['name'], Lang::$word->MU_UPDATE_OK);
				  Message::msgReply(Db::run()->affected(), 'success', $message);
			  } else {
				  if ($last_id) {
					  $message = Message::formatSuccessMessage($data['name'], Lang::$word->MU_ADDED_OK);
					  $json['type'] = "success";
					  $json['title'] = Lang::$word->SUCCESS;
					  $json['message'] = $message;
					  $json['redirect'] = Url::url("/admin/menus");
				  } else {
					  $json['type'] = "alert";
					  $json['title'] = Lang::$word->ALERT;
					  $json['message'] = Lang::$word->NOPROCCESS;
				  }
				  print json_encode($json);
			  }
			  Logger::writeLog($message);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Content::getSortMenuList()
       * 
       * @param integer $parent_id
       * @return
       */
	  public function getSortMenuList($array, $parent_id = 0)
	  {
		  
		  $submenu = false;
		  $class = ($parent_id == 0) ? "parent" : "child";
		  $icon =  '<i class="icon negative trash"></i>';
		  $html = '';
		  $html .= "<ol class=\"dd-list\">\n";
	
		  foreach ($array as $key => $row) {
				  $html .= '<li class="dd-item dd3-item clearfix" data-id="' . $row->id . '"><div class="dd-handle dd3-handle"></div>' 
				  . '<div class="dd3-content"><span class="actions"><a class="data" data-set=\'{"option":[{"trash": "trashMenu","title": "' . Validator::sanitize($row->name, "chars") . '","id":' . $row->id . '}],"action":"trash","parent":"li", "redirect":"' . Url::url("/admin/menus") . '"}\'>' . $icon . '</a></span>'
				  . ' <a href="' . Url::url("/admin/menus/edit", $row->id) . '">' . $row->name . '</a>' 
				  . '</div>';
				  $html .= "</li>\n";
		  }
		  unset($row);

		  $html .= "</ol>\n";
		  
		  return $html;
	  }

      /**
       * Content::getMenus()
       * 
       * @return
       */
	  public static function getMenus()
	  {

		  $sql = "
		  SELECT 
		    m.id,
			m.name,
			m.content_type,
			m.link,
			m.target,
			p.slug,
			p.page_type
		  FROM
			`" . self::mTable . "` AS m 
			LEFT JOIN `" . self::pTable . "` AS p 
			  ON p.id = m.page_id 
		  WHERE m.active = ?
		  ORDER BY m.sorting;"; 

		  $row = Db::run()->pdoQuery($sql, array(1))->results();
	
		  return ($row) ? $row : 0;
	  }
	  
      /**
       * Content::Categories()
       * 
       * @return
       */
      public function Categories()
      {

		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->crumbs = ['admin', Lang::$word->META_CATEGORIES];
		  $tpl->template = 'admin/categories.tpl.php';
		  $tpl->tree = $this->categoryTree();
		  $tpl->droplist = self::getCategoryDropList($tpl->tree, 0, 0,"&#166;&nbsp;&nbsp;&nbsp;&nbsp;");
		  $tpl->sortlist = $this->getSortCategoryList($tpl->tree);
		  $tpl->title = Lang::$word->META_M_CATEGORIES; 

      }

      /**
       * Content::CategoryEdit()
       * 
       * @return
       */
      public function CategoryEdit($id)
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->CT_EDIT;
          $tpl->crumbs = ['admin', Lang::$word->META_CATEGORIES, Lang::$word->META_EDIT];

          if (!$row = Db::run()->first(self::cTable, null, array("id" => $id))) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [Content.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
              $tpl->data = $row;
			  $tpl->tree = $this->categoryTree();
		      $tpl->droplist = self::getCategoryDropList($tpl->tree, 0, 0,"&#166;&nbsp;&nbsp;&nbsp;&nbsp;", $row->parent_id);
		      $tpl->sortlist = $this->getSortCategoryList($tpl->tree);
              $tpl->template = 'admin/categories.tpl.php';
          }
      }

      /**
       * Content::processCategory()
       * 
       * @return
       */
	  public function processCategory()
	  {

		  $rules = array(
		      'name' => array('required|string|min_len,3|max_len,100', Lang::$word->NAME),
			  'parent_id' => array('required|numeric', Lang::$word->CT_PARENT),
			  'active' => array('required|numeric', Lang::$word->PUBLISHED),
			  );

		  $filters = array(
			  'name' => 'string',
			  'slug' => 'string',
			  'body' => 'string',
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
				  'body' => $safe->body,
				  'keywords' => $safe->keywords,
				  'description' => $safe->description,
				  'active' => $safe->active,
				  );
	
			  (Filter::$id) ? Db::run()->update(self::cTable, $data, array("id" => Filter::$id)) : $last_id = Db::run()->insert(self::cTable, $data)->getLastInsertId();
			  if (Filter::$id) {
				  $message = Message::formatSuccessMessage($data['name'], Lang::$word->CT_UPDATE_OK);
				  Message::msgReply(Db::run()->affected(), 'success', $message);
			  } else {
				  if ($last_id) {
					  $message = Message::formatSuccessMessage($data['name'], Lang::$word->CT_ADDED_OK);
					  $json['type'] = "success";
					  $json['title'] = Lang::$word->SUCCESS;
					  $json['message'] = $message;
					  $json['redirect'] = Url::url("/admin/categories");
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
       * Content::categoryTree()
       * 
       * @return
       */
	  public function categoryTree()
	  {
	
		  $data = Db::run()->select(self::cTable, array("id", "parent_id"," name"," slug"), null,'ORDER BY parent_id, sorting')->results();
	
		  $cats = array();
		  $result = array();
	
		  foreach ($data as $row) {
			  $cats['id'] = $row->id;
			  $cats['name'] = $row->name;
			  $cats['slug'] = $row->slug;
			  $cats['parent_id'] = $row->parent_id;
			  $result[$row->id] = $cats;
		  }
		  return $result;
	  }

      /**
       * Content::getCategoryDropList()
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
       * Content::getCatCheckList()
       * 
	   * @param mixed $array
	   * @param mixed $parent_id
	   * @param integer $level
	   * @param mixed $spacer
	   * @param bool $selected
       * @return
       */
	  public static function getCatCheckList($array, $parent_id, $level = 0, $spacer = "--", $selected = false)
	  {

		  $html = '';
		  if ($array) {
			  if($selected) {
				$arr = explode(",", $selected);
				reset($arr);
			  }
			  foreach ($array as $key => $row) {
				  $active = ($selected and in_array($row['id'], $arr)) ? " checked=\"checked\"" : "";
	
				  if ($parent_id == $row['parent_id']) {
					  $html .= "<div class=\"item\"><div class=\"wojo inline fitted checkbox\"> <input type=\"checkbox\" name=\"categories[]\" value=\"" . $row['id'] . "\"" . $active . " id=\"cat_" . $row['id'] . "\">";
					  $html .= "<label for=\"cat_" . $row['id'] . "\">";
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
       * Content::getSortCategoryList()
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
				  . '<div class="dd3-content"><span class="actions"><a class="trashCategory" data-set=\'{"option":[{"trash": "trashCategory","title": "' . Validator::sanitize($row['name'], "chars") . '","id":' . $row['id'] . '}],"subtext":"' . Lang::$word->DELCONFIRM3 . '", "action":"trash","parent":"li"}\'>' . $icon . '</a></span>'
				 . ' <a href="' . Url::url("/admin/categories/edit", $row['id']) . '">' . $row['name'] . '</a>' 
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
       * Content::renderCategories()
       * 
	   * @param array $array
	   * @param integer $parent_id
	   * @param str $menuid
	   * @param str $class
       * @return
       */
      public function renderCategories($array, $parent_id = 0, $menuid = 'main-menu', $class = 'top-menu')
      {
		  $html = '';
		  if(is_array($array) && count($array) > 0) {
			  $submenu = false;
			  $attr = (!$parent_id) ? ' class="' . $class . '" id="' . $menuid . '"' : ' class="menu-submenu"';
			  $attr2 = (!$parent_id) ? ' class="nav-item"' : ' class="nav-submenu-item"';

			  foreach ($array as $key => $row) {
				  if ($row['parent_id'] == $parent_id) {
					  if ($submenu === false) {
						  $submenu = true;	
						  $html .= "<ul" . $attr . ">\n";
					  }
					  
					  $url = Url::url("/category", $row['slug'] . '/');
					  $active = (in_array($row['slug'], self::$segments) ? "active" : "normal");
					  $name = ($parent_id == 0)  ? '<strong>' . $row['name'] . '</strong>' : $row['name'];
					  $link = '<a href="' . $url . '" class="' . $active . '">' . $name . '</a>';
					  
					  $html .= '<li' . $attr2 .'>';
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
       * Content::Category()
       * 
	   * @param str $slug
       * @return
       */
      public function Category($slug)
      {
		  $core = App::Core();
		  $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "front/themes/" . $core->theme . "/";
		  $tpl->keywords = null;
		  $tpl->description = null;
		  $tpl->title = str_replace("[COMPANY]", $core->company, Lang::$word->META_WELCOME);
	
		  if (!$row = Db::run()->first(self::cTable, null, array("slug" => $slug))) {
			  $tpl->template = 'front/themes/' . $core->theme . '/404.tpl.php';
			  DEBUG ? Debug::AddMessage("errors", '<i>ERROR</i>', "Invalid page detected [content.class.php, ln.:" . __line__ . "] slug ['<b>" . $slug ."</b>']") : Lang::$word->META_ERROR;
		  } else {
			  if (isset($_GET['order']) and count(explode("|", $_GET['order'])) == 2) {
				  list($sort, $order) = explode("|", $_GET['order']);
				  $sort = Validator::sanitize($sort, "string", 16);
				  $order = Validator::sanitize($order, "string", 5);
				  if (in_array($sort, array(
					  "title",
					  "price",
					  "memberships",
					  "likes"))) {
					  $ord = ($order == 'DESC') ? " DESC" : " ASC";
					  $sorting = $sort . $ord;
				  } else {
					  $sorting = " created DESC";
				  }
			  } else {
				  $sorting = " created DESC";
			  }

			  $pSql = "
			  SELECT 
				COUNT(p.id) 
			  FROM
				`" . Product::mTable . "` AS p 
				INNER JOIN `" . self::crTable . "` AS rc 
				  ON p.id = rc.product_id 
			  WHERE rc.category_id = " . $row->id . " 
				AND p.active = 1 
			  LIMIT 1;";
			  
			  $total = Db::run()->count(false, false, $pSql);
		  
			  $pager = Paginator::instance();
			  $pager->items_total = (($total < 2 ) ? 0 : ($total - 2));
			  $pager->default_ipp = $core->cperpage;
			  $pager->path = Url::url(Router::$path, "?");
			  $pager->paginate();

			  $sql = "
			  SELECT 
				p.id,
				p.created,
				p.price,
				p.sprice,
				p.is_sale,
				p.title,
				p.slug,
				p.thumb,
				p.audio,
				p.token,
				p.likes,
				p.body,
				p.type,
				p.token,
				p.affiliate,
				p.membership_id,
				c.slug AS cslug,
				c.name,
				GROUP_CONCAT(m.title SEPARATOR ', ') AS memberships,
				(SELECT 
				  COUNT(product_id) 
				FROM
				  `" . Comments::mTable . "`
				WHERE `" . Comments::mTable . "`.product_id = p.id) as comments
			  FROM
				`" . Product::mTable . "` AS p
				LEFT JOIN `" . self::cTable . "` AS c
				  ON c.id = p.category_id
				INNER JOIN `" . self::crTable . "` AS rc 
				  ON p.id = rc.product_id
				LEFT JOIN `" . self::mxTable . "` AS m 
				  ON FIND_IN_SET(m.id, p.membership_id)
			  WHERE rc.category_id = ?
			  AND p.active = ? 
			  AND c.active = ?  
			  GROUP BY p.id
			  ORDER BY $sorting " . $pager->limit; 

			  $tpl->data = Db::run()->pdoQuery($sql, array($row->id, 1, 1))->results();
			  $tpl->special = ($tpl->data) ? array_slice($tpl->data, 0, 2) : null;
			  $tpl->featured = ($tpl->data) ? array_slice($tpl->data, 2) : null;
			  
			  $tpl->pager = $pager;
			  $tpl->row = $row;
			  $tpl->title = Url::formatMeta($row->name);
			  $tpl->keywords = $row->keywords;
			  $tpl->description = $row->description;
			  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), $row->name];
			  $tpl->template = 'front/themes/' . $core->theme . '/category.tpl.php';
		  }
	  }

	  
      /**
       * Content::Pages()
       * 
       * @return
       */
      public function Pages()
      {

		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->crumbs = ['admin', Lang::$word->META_PAGES];
		  $tpl->template = 'admin/pages.tpl.php';
		  $tpl->data = Db::run()->select(self::pTable)->results(); 
		  $tpl->title = Lang::$word->META_M_PAGES; 

      }

      /**
       * Content::PageEdit()
       * 
	   * @param mixed $id
       * @return
       */
	  public function PageEdit($id)
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->PAG_EDIT;
		  $tpl->crumbs = ['admin', Lang::$word->META_PAGES, Lang::$word->META_EDIT];
	
		  if (!$row = Db::run()->first(self::pTable, null, array("id =" => $id))) {
			  $tpl->template = 'admin/error.tpl.php';
			  $tpl->error = DEBUG ? "Invalid ID ($id) detected [Content.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
		  } else {
			  $tpl->data = $row;
			  $tpl->pagetype = self::pageTypeList();
			  $tpl->template = 'admin/pages.tpl.php';
		  }
	  }

      /**
       * Content::PageSave()
       * 
       * @return
       */
	  public function PageSave()
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->PAG_NEW;
		  $tpl->crumbs = ['admin', Lang::$word->META_PAGES, Lang::$word->META_NEW];
		  $tpl->pagetype = self::pageTypeList();
		  $tpl->template = 'admin/pages.tpl.php';
	  }

      /**
       * Content::processPage()
       * 
       * @return
       */
	  public function processPage()
	  {
	
		  $rules = array(
			  'title' => array('required|string|min_len,3|max_len,100', Lang::$word->NAME),
			  'page_type' => array('required|string|min_len,3|max_len,10', Lang::$word->PAG_TYPE),
			  'active' => array('required|numeric', Lang::$word->PUBLISHED),
			  );

		  $filters = array(
			  'body' => 'advanced_tags',
			  'title' => 'string',
			  'slug' => 'string|trim',
			  'keywords' => 'string|trim',
			  'description' => 'string|trim',
			  );
			  
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
		  if (empty(Message::$msgs)) {
			  $data = array(
				  'title' => $safe->title,
				  'slug' => empty($safe->slug) ? Url::doSeo($safe->title) : Url::doSeo($safe->slug),
				  'body' => Url::in_url($safe->body),
				  'page_type' => $safe->page_type,
				  //'address' => (isset($_POST['address'])) ? Validator::sanitize($_POST['address']) : 'NULL',
				  'keywords' => $safe->keywords,
				  'description' => $safe->description,
				  'active' => $safe->active,
				  );
			  
			  (Filter::$id) ? Db::run()->update(self::pTable, $data, array("id" => Filter::$id)) : Db::run()->insert(self::pTable, $data); 
			  
			  $message = Filter::$id ? 
			  Message::formatSuccessMessage($data['title'], Lang::$word->PAG_UPDATE_OK) : 
			  Message::formatSuccessMessage($data['title'], Lang::$word->PAG_ADDED_OK);
			  Message::msgReply(Db::run()->affected(), 'success', $message);
			  Logger::writeLog($message);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }
	  
      /**
       * Content::getPageList()
       * 
       * @return
       */
      public function getPageList()
      {

          $row = Db::run()->select(self::pTable, array("id", "title"), null, "ORDER BY title")->results();

          return ($row) ? $row : 0;
      }

      /**
       * Content::Faq()
       * 
       * @return
       */
      public function Faq()
      {

		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->crumbs = ['admin', Lang::$word->META_FAQ];
		  $tpl->template = 'admin/faq.tpl.php';
		  $tpl->data = Db::run()->select(self::fTable, null, null, 'ORDER BY sorting')->results(); 
		  $tpl->title = Lang::$word->META_M_FAQ; 

      }
	  
      /**
       * Content::FaqEdit()
       * 
	   * @param mixed $id
       * @return
       */
	  public function FaqEdit($id)
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->ET_EDIT;
		  $tpl->crumbs = ['admin', Lang::$word->META_FAQ , Lang::$word->META_EDIT];
	
		  if (!$row = Db::run()->first(self::fTable, null, array("id =" => $id))) {
			  $tpl->template = 'admin/error.tpl.php';
			  $tpl->error = DEBUG ? "Invalid ID ($id) detected [Content.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
		  } else {
			  $tpl->data = $row;
			  $tpl->template = 'admin/faq.tpl.php';
		  }
	  }

      /**
       * Content::FaqSave()
       * 
       * @return
       */
	  public function FaqSave()
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->FAQ_NEW;
		  $tpl->crumbs = ['admin', Lang::$word->META_FAQ, Lang::$word->META_NEW];
		  $tpl->pagetype = self::pageTypeList();
		  $tpl->template = 'admin/faq.tpl.php';
	  }
	  
      /**
       * Content::processFaq()
       * 
       * @return
       */
	  public function processFaq()
	  {
	
		  $rules = array(
			  'question' => array('required|string|min_len,3|max_len,100', Lang::$word->FAQ_QUESTION),
			  'answer' => array('required|string', Lang::$word->FAQ_ANSWER),
			  );

		  $filters = array(
			  'answer' => 'string|trim',
			  'question' => 'string|trim',
			  );
			  
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
		  if (empty(Message::$msgs)) {
			  $data = array(
				  'question' => $safe->question,
				  'answer' => $safe->answer,
				  );
			  
			  (Filter::$id) ? Db::run()->update(self::fTable, $data, array("id" => Filter::$id)) : Db::run()->insert(self::fTable, $data); 
			  
			  $message = Filter::$id ? 
			  Message::formatSuccessMessage($data['question'], Lang::$word->FAQ_UPDATE_OK) : 
			  Message::formatSuccessMessage($data['question'], Lang::$word->FAQ_ADDED_OK);
			  Message::msgReply(Db::run()->affected(), 'success', $message);
			  Logger::writeLog($message);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }
	  
      /**
       * Content::Templates()
       * 
       * @return
       */
      public function Templates()
      {

		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->crumbs = ['admin', 'email templates'];
		  $tpl->template = 'admin/templates.tpl.php';
		  $tpl->data = Db::run()->select(self::eTable, null, null, "ORDER BY name DESC")->results(); 
		  $tpl->title = Lang::$word->META_M_TEMPLATES; 

      }

      /**
       * Content::TemplateEdit()
       * 
	   * @param mixed $id
       * @return
       */
	  public function TemplateEdit($id)
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->ET_EDIT;
		  $tpl->crumbs = ['admin', array(0 => Lang::$word->META_TMPLATES, 1 => "templates"), Lang::$word->META_EDIT];
	
		  if (!$row = Db::run()->first(self::eTable, null, array("id =" => $id))) {
			  $tpl->template = 'admin/error.tpl.php';
			  $tpl->error = DEBUG ? "Invalid ID ($id) detected [Content.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
		  } else {
			  $tpl->data = $row;
			  $tpl->template = 'admin/templates.tpl.php';
		  }
	  }

      /**
       * Content::processTemplate()
       * 
       * @return
       */
	  public function processTemplate()
	  {
	
		  $rules = array(
			  'name' => array('required|string|min_len,3|max_len,60', Lang::$word->ET_NAME),
			  'subject' => array('required|string|min_len,3|max_len,100', Lang::$word->ET_SUBJECT),
			  'id' => array('required|numeric', "ID"),
			  );
	
		  $filters = array(
		      'name' => 'string',
			  'body' => 'advanced_tags',
			  'help' => 'string',
			  );

		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
		  if (empty(Message::$msgs)) {
			  $data = array(
				  'name' => $safe->name,
				  'subject' => $safe->subject,
				  'help' => $safe->help,
				  'body' => str_replace(SITEURL, "[SITEURL]", $safe->body),
				  );
	
			  Db::run()->update(self::eTable, $data, array("id" => Filter::$id)); 
			  Message::msgReply(Db::run()->affected(), 'success', Message::formatSuccessMessage($data['name'], Lang::$word->ET_UPDATE_OK));
			  Logger::writeLog(Message::formatSuccessMessage($data['name'], Lang::$word->ET_UPDATE_OK));
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Content::Countries()
       * 
       * @return
       */
      public function Countries()
      {

		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->template = 'admin/countries.tpl.php';
		  $tpl->data = Db::run()->select(self::cnTable, null, null, "ORDER BY sorting DESC")->results(); 
		  $tpl->title = Lang::$word->META_M_COUNTRIES; 

      }

      /**
       * Content::CountryEdit()
       * 
	   * @param mixed $id
       * @return
       */
	  public function CountryEdit($id)
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->CNT_EDIT;
		  $tpl->crumbs = ['admin', Lang::$word->META_COUNTRIES, Lang::$word->META_EDIT];
	
		  if (!$row = Db::run()->first(self::cnTable, null, array("id =" => $id))) {
			  $tpl->template = 'admin/error.tpl.php';
			  $tpl->error = DEBUG ? "Invalid ID ($id) detected [content.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
		  } else {
			  $tpl->data = $row;
			  $tpl->template = 'admin/countries.tpl.php';
		  }
	  }

      /**
       * Content::processCountry()
       * 
       * @return
       */
	  public function processCountry()
	  {
	
		  $rules = array(
			  'name' => array('required|string|min_len,3|max_len,60', Lang::$word->NAME),
			  'abbr' => array('required|string|min_len,2|max_len,2', Lang::$word->CNT_ABBR),
			  'active' => array('required|numeric', Lang::$word->CNT_ABBR),
			  'home' => array('required|numeric', Lang::$word->CNT_ABBR),
			  'sorting' => array('required|numeric', Lang::$word->CNT_ABBR),
			  'vat' => array('required|float', Lang::$word->TRX_TAX),
			  'id' => array('required|numeric', "ID"),
			  );

		  $filters = array(
		      'name' => 'string',
			  'abbr' => 'string',
			  'vat' => 'floats',
			  );

		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
		  if (empty(Message::$msgs)) {
			  $data = array(
				  'name' => $safe->name,
				  'abbr' => $safe->abbr,
				  'sorting' => $safe->sorting,
				  'home' => $safe->home,
				  'active' => $safe->active,
				  'vat' => $safe->vat,
				  );

			  if ($data['home'] == 1) {
				  Db::run()->pdoQuery("UPDATE `" . self::cnTable . "` SET `home`= DEFAULT(home);");
			  }	
			  
			  Db::run()->update(self::cnTable, $data, array("id" => Filter::$id)); 
			  Message::msgReply(Db::run()->affected(), 'success', Message::formatSuccessMessage($data['name'], Lang::$word->CNT_UPDATE_OK));
			  Logger::writeLog(Message::formatSuccessMessage($data['name'], Lang::$word->CNT_UPDATE_OK));
		  } else {
			  Message::msgSingleStatus();
		  }
	  }
	  
      /**
       * Content::getCountryList()
       * 
       * @return
       */
      public function getCountryList($status = null)
      {
          $active = ($status) ? array("active" => 1) : null;
		  $row = Db::run()->select(self::cnTable, null, $active, "ORDER BY sorting DESC")->results();

          return ($row) ? $row : 0; 
      }

      /**
       * Content::Coupons()
       * 
       * @return
       */
      public function Coupons()
      {

		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->template = 'admin/coupons.tpl.php';
		  $tpl->data = Db::run()->select(self::dcTable)->results(); 
		  $tpl->title = Lang::$word->META_M_COUPONS; 

      }

      /**
       * Content::CouponEdit()
       * 
	   * @param mixed $id
       * @return
       */
	  public function CouponEdit($id)
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->DC_EDIT;
		  $tpl->crumbs = ['admin', Lang::$word->META_COUPONS, Lang::$word->META_EDIT];
	
		  if (!$row = Db::run()->first(self::dcTable, null, array("id =" => $id))) {
			  $tpl->template = 'admin/error.tpl.php';
			  $tpl->error = DEBUG ? "Invalid ID ($id) detected [content.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
		  } else {
			  $tpl->data = $row;
			  $tpl->template = 'admin/coupons.tpl.php';
		  }
	  }

      /**
       * Content::CouponSave()
       * 
       * @return
       */
	  public function CouponSave()
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->DC_NEW;
		  $tpl->crumbs = ['admin', Lang::$word->META_COUPONS, Lang::$word->META_NEW];
		  $tpl->template = 'admin/coupons.tpl.php';
	  }

      /**
       * Content::processCoupon()
       * 
       * @return
       */
	  public function processCoupon()
	  {
	
		  $rules = array(
			  'title' => array('required|string|min_len,3|max_len,10', Lang::$word->NAME),
			  'code' => array('required|string', Lang::$word->DC_CODE),
			  'discount' => array('required|numeric|min_numeric,1|max_numeric,99', Lang::$word->DC_DISC),
			  'type' => array('required|string', Lang::$word->DC_TYPE),
			  'active' => array('required|numeric', Lang::$word->PUBLISHED),
			  'minval' => array('required|numeric', Lang::$word->DC_MIN),
			  'validuntil_submit' => array('required|date', Lang::$word->DC_VALID),
			  );

		  $filters = array(
		      'title' => 'string',
			  'code' => 'string',
			  );

		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
		  if (empty(Message::$msgs)) {
			  $data = array(
				  'title' => $safe->title,
				  'code' => $safe->code,
				  'discount' => $safe->discount,
				  'type' => $safe->type,
				  'validuntil' => Db::toDate($safe->validuntil_submit),
				  'minval' => $safe->minval,
				  'active' => $safe->active,
				  );
				  
			  (Filter::$id) ? Db::run()->update(self::dcTable, $data, array("id" => Filter::$id)) : $last_id = Db::run()->insert(self::dcTable, $data)->getLastInsertId(); 
			  
			  $message = Filter::$id ? 
			  Message::formatSuccessMessage($data['title'], Lang::$word->DC_UPDATE_OK) : 
			  Message::formatSuccessMessage($data['title'], Lang::$word->DC_ADDED_OK);
			  Message::msgReply(Db::run()->affected(), 'success', $message);
			  Logger::writeLog($message);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }
	  
      /**
       * Content::applyCoupon()
       * 
       * @return
       */
	  public function applyCoupon()
	  {
	
		  $rules = array('coupon' => array('required|string', Lang::$word->DC_CODE));
		  $filters = array('coupon' => 'string');
	
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
	
		  if (empty(Message::$msgs)) {
			  $sql = "SELECT * FROM `" . self::dcTable . "` WHERE validuntil >= CURDATE() AND code = ? AND active = ?";
			  if ($row = Db::run()->pdoQuery($sql, array($safe->coupon, 1))->result()) {
	
				  $totals = Product::getCartTotal();
				  $tax = self::calculateTax();
	
				  if (Validator::compareNumbers($row->minval, $totals->subtotal, ">")) {
					  $json['type'] = "error";
					  $json['title'] = Lang::$word->ERROR;
					  $json['message'] = str_replace("[TOTAL]", Utility::formatMoney($row->minval), Lang::$word->DC_CODE_MIN);
					  print json_encode($json);
					  exit;
				  } else {
					  $cart_content = Db::run()->select(Product::cxTable, null, array("user_id" => App::Auth()->sesid, "membership_id" => 0))->results();
					  App::Session()->set('tmp_cart', $cart_content);
					  $cart = App::Session()->get('tmp_cart');

					  foreach ($cart as $rows) {
						  $coupon = self::calculateCoupon($row->type, $row->discount, $rows->originalprice,  $totals->items, $totals->subtotal);
						  $total = number_format($rows->originalprice - $coupon, 2);
						  $data[] = array(
							  'id' => $rows->id,
							  'user_id' => $rows->user_id,
							  'product_id' => $rows->product_id,
							  'tax' => $tax,
							  'totaltax' => Validator::sanitize(($rows->originalprice - $coupon) * $tax, "float"),
							  'coupon' => Validator::sanitize($coupon, "float"),
							  'originalprice' => $rows->originalprice,
							  'total' => $rows->total,
							  'totalprice' => Validator::sanitize(($totals->tax > 0) ? $totals->grand : $tax * $total + $total, "float"),
							  );
					  }
					  
					  Db::run()->delete(Product::cxTable, array("user_id" => App::Auth()->sesid, "membership_id" => 0));
					  Db::run()->insertBatch(Product::cxTable, $data);
					  App::Session()->remove('tmp_cart');
					  $totals = Product::getCartTotal();
	
					  $json['type'] = "success";
					  $json['title'] = Lang::$word->SUCCESS;
					  $json['message'] = str_replace("[AMOUNT]", Utility::formatMoney($totals->discount), Lang::$word->DC_CODE_OK);
					  $json['coupon'] = "<i class=\"icon minus positive alt\"></i> " . Utility::formatNumber($totals->discount, 2);
					  $json['tax'] = "<i class=\"icon plus negative alt\"></i>" . Utility::formatNumber($totals->tax);
					  $json['subtotal'] = Utility::formatNumber($totals->subtotal);
					  $json['total'] = Utility::formatMoney($totals->grand);
					  print json_encode($json);
				  }
			  } else {
				  $json['type'] = "error";
				  $json['title'] = Lang::$word->ERROR;
				  $json['message'] = Lang::$word->DC_INVALID;
				  print json_encode($json);
			  }
		  } else {
			  Message::msgSingleStatus();
		  }
	  }
	  
      /**
       * Content::calculateCoupon()
       * 
	   * @param string $type
	   * @param float $amount
	   * @param float $price
	   * @param int $qty
	   * @param int $sub
       * @return
       */
      public static function calculateCoupon($type, $amount, $price, $qty, $sub)
      {
		  
		  return ($type == "p") ? number_format($price / 100 * $amount, 2) : number_format($amount / ($sub) * $price, 2);
      }
	  
      /**
       * Content::Fields()
       * 
       * @return
       */
      public function Fields()
      {

		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->crumbs = ['admin', Lang::$word->META_FIELDS];
		  $tpl->template = 'admin/fields.tpl.php';
		  $tpl->data = Db::run()->select(self::cfTable, null, null, "ORDER BY sorting")->results(); 
		  $tpl->title = Lang::$word->META_M_FIELDS; 

      }

      /**
       * Content::FieldEdit()
       * 
	   * @param mixed $id
       * @return
       */
	  public function FieldEdit($id)
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->CF_EDIT;
		  $tpl->crumbs = ['admin', array(0 => Lang::$word->META_FIELDS, 1 => "fields"), Lang::$word->META_EDIT];
	
		  if (!$row = Db::run()->first(self::cfTable, null, array("id =" => $id))) {
			  $tpl->template = 'admin/error.tpl.php';
			  $tpl->error = DEBUG ? "Invalid ID ($id) detected [Content.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
		  } else {
			  $tpl->data = $row;
			  $tpl->template = 'admin/fields.tpl.php';
		  }
	  }

      /**
       * Content::FieldSave()
       * 
       * @return
       */
	  public function FieldSave()
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->CF_NEW;
		  $tpl->crumbs = ['admin', array(0 => Lang::$word->META_FIELDS, 1 => "fields"), Lang::$word->META_NEW];
		  $tpl->template = 'admin/fields.tpl.php';
	  }

      /**
       * Content::processField()
       * 
       * @return
       */
	  public function processField()
	  {
	
		  $rules = array(
			  'title' => array('required|string|min_len,2|max_len,60', Lang::$word->NAME),
			  'required' => array('required|numeric', Lang::$word->CF_REQUIRED),
			  'active' => array('required|numeric', Lang::$word->PUBLISHED),
			  );

		  $filters = array(
			  'tooltip' => 'string',
			  'title' => 'string',
			  'section' => 'string',
			  );
			  
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
		  if (empty(Message::$msgs)) {
			  $data = array(
				  'title' => $safe->title,
				  'tooltip' => $safe->tooltip,
				  'required' => $safe->required,
				  'section' => $safe->section,
				  'active' => $safe->active,
				  );
				  
			  if (!Filter::$id) {
				  $data['name'] = Utility::randomString(6);
			  }
			  
			  (Filter::$id) ? Db::run()->update(self::cfTable, $data, array("id" => Filter::$id)) : $last_id = Db::run()->insert(self::cfTable, $data)->getLastInsertId(); 
			  
			  if(!Filter::$id) {
				  switch($safe->section) {
					  case "product":
						  $products = Db::run()->select(Product::mTable)->results();
						  foreach ($products as $row) {
							  $dataArray[] = array(
								  'product_id' => $row->id,
								  'field_id' => $last_id,
								  'section' => $safe->section,
								  'field_name' => $data['name'],
								  );
						  }
					  break;
					  
					  default:
						  $users = Db::run()->select(Users::mTable)->results();
						  foreach ($users as $row) {
							  $dataArray[] = array(
								  'user_id' => $row->id,
								  'field_id' => $last_id,
								  'section' => $safe->section,
								  'field_name' => $data['name'],
								  );
						  }
					  break;
				  }

				  Db::run()->insertBatch(self::cfdTable, $dataArray);
			  }
			  
			  $message = Filter::$id ? 
			  Message::formatSuccessMessage($data['title'], Lang::$word->CF_UPDATE_OK) : 
			  Message::formatSuccessMessage($data['title'], Lang::$word->CF_ADDED_OK);
			  Message::msgReply(Db::run()->affected(), 'success', $message);
			  Logger::writeLog($message);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Content::News()
       * 
       * @return
       */
      public function News()
      {

		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->crumbs = ['admin', Lang::$word->META_NEWS];
		  $tpl->template = 'admin/news.tpl.php';
		  $tpl->data = Db::run()->select(self::nTable, null, null, "ORDER BY created DESC")->results(); 
		  $tpl->title = Lang::$word->META_M_NEWS; 

      }
	  
      /**
       * Content::NewsEdit()
       * 
	   * @param mixed $id
       * @return
       */
	  public function NewsEdit($id)
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->NW_EDIT;
		  $tpl->crumbs = ['admin', Lang::$word->META_NEWS, Lang::$word->META_EDIT];
	
		  if (!$row = Db::run()->first(self::nTable, null, array("id =" => $id))) {
			  $tpl->template = 'admin/error.tpl.php';
			  $tpl->error = DEBUG ? "Invalid ID ($id) detected [Content.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
		  } else {
			  $tpl->data = $row;
			  $tpl->template = 'admin/news.tpl.php';
		  }
	  }
	  
      /**
       * Content::NewsSave()
       * 
       * @return
       */
	  public function NewsSave()
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->NW_NEW;
		  $tpl->crumbs = ['admin', Lang::$word->META_NEWS, Lang::$word->META_NEW];
		  $tpl->template = 'admin/news.tpl.php';
	  }
	  
      /**
       * Content::processNews()
       * 
       * @return
       */
	  public function processNews()
	  {
	
		  $rules = array(
			  'title' => array('required|string|min_len,3|max_len,100', Lang::$word->NAME),
			  'active' => array('required|numeric', Lang::$word->PUBLISHED),
			  );

		  $filters = array(
			  'body' => 'advanced_tags',
			  'title' => 'string',
			  );
			  
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
		  if (empty(Message::$msgs)) {
			  $data = array(
				  'title' => $safe->title,
				  'body' => $safe->body,
				  'author' => App::Auth()->name,
				  'active' => $safe->active,
				  );
			  
			  (Filter::$id) ? Db::run()->update(self::nTable, $data, array("id" => Filter::$id)) : Db::run()->insert(self::nTable, $data); 
			  
			  $message = Filter::$id ? 
			  Message::formatSuccessMessage($data['title'], Lang::$word->NW_UPDATE_OK) : 
			  Message::formatSuccessMessage($data['title'], Lang::$word->NW_ADDED_OK);
			  Message::msgReply(Db::run()->affected(), 'success', $message);
			  Logger::writeLog($message);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Content::MembershipIndex()
       * 
       * @return
       */
      public function MembershipIndex()
      {
		  
		  $sql = "
		  SELECT 
			m.*,
			(SELECT 
			  COUNT(p.membership_id) 
			FROM
			  `" . Product::xTable . "` as p 
			WHERE p.membership_id = m.id) AS total
		  FROM
			`" . self::mxTable . "` as m;";

		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->template = 'admin/memberships.tpl.php';
		  $tpl->data = Db::run()->pdoQuery($sql)->results(); 
		  $tpl->title = Lang::$word->META_M_MEMBERSHIPS; 
	  }

      /**
       * Content::MembershipEdit()
       * 
	   * @param mixed $id
       * @return
       */
	  public function MembershipEdit($id)
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->NW_EDIT;
		  $tpl->crumbs = ['admin', Lang::$word->META_MEMBERSHIPS, Lang::$word->META_EDIT];
	
		  if (!$row = Db::run()->first(self::mxTable, null, array("id =" => $id))) {
			  $tpl->template = 'admin/error.tpl.php';
			  $tpl->error = DEBUG ? "Invalid ID ($id) detected [Content.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
		  } else {
			  $tpl->data = $row;
			  $tpl->template = 'admin/memberships.tpl.php';
		  }
	  }

      /**
       * Content::MembershipSave()
       * 
       * @return
       */
	  public function MembershipSave()
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->NW_NEW;
		  $tpl->crumbs = ['admin', Lang::$word->META_MEMBERSHIPS, Lang::$word->META_NEW];
		  $tpl->template = 'admin/memberships.tpl.php';
	  }

      /**
       * Content::processMembership()
       * 
       * @return
       */
	  public function processMembership()
	  {
	
		  $rules = array(
			  'title' => array('required|string|min_len,3|max_len,60', Lang::$word->NAME),
			  'price' => array('required|numeric', Lang::$word->MEM_PRICE),
			  'days' => array('required|numeric', Lang::$word->MEM_DAYS),
			  'period' => array('required|alpha|min_len,1|max_len,1', Lang::$word->MEM_DAYS),
			  'recurring' => array('required|numeric', Lang::$word->MEM_REC),
			  'private' => array('required|numeric', Lang::$word->MEM_PRIVATE),
			  'active' => array('required|numeric', Lang::$word->PUBLISHED),
			  );
	
		  $filters = array(
			  'description' => 'trim|string',
			  );
			  
			  
		  if (!empty($_FILES['thumb']['name']) and empty(Message::$msgs)) {
			  $upl = Upload::instance(3145728, "png,jpg");
			  $upl->process("thumb", UPLOADS .'/memberships/', "MEM_");
		  }

		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
		  if (empty(Message::$msgs)) {
			  $data = array(
				  'title' => $safe->title,
				  'description' => $safe->description,
				  'price' => $safe->price,
				  'days' => $safe->days,
				  'period' => $safe->period,
				  'recurring' => $safe->recurring,
				  'private' => $safe->private,
				  'active' => $safe->active,
				  );
				  
			  if (!empty($_FILES['thumb']['name'])) {
				  $data['thumb'] = $upl->fileInfo['fname'];
			  }
	
			  (Filter::$id) ? Db::run()->update(self::mxTable, $data, array("id" => Filter::$id)) : $last_id = Db::run()->insert(self::mxTable, $data)->getLastInsertId(); 
			  
			  $message = Filter::$id ? 
			  Message::formatSuccessMessage($data['title'], Lang::$word->MEM_UPDATE_OK) : 
			  Message::formatSuccessMessage($data['title'], Lang::$word->MEM_ADDED_OK);
			  
			  Message::msgReply(Db::run()->affected(), 'success', $message);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Content::MembershipHistory()
       * 
	   * @param mixed $id
       * @return
       */
	  public function MembershipHistory($id)
	  {

		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->META_M_HISTORY;
		  $tpl->crumbs = ['admin', Lang::$word->META_MEMBERSHIPS, Lang::$word->META_HISTORY];
	
		  if (!$row = Db::run()->first(self::mxTable, null, array("id =" => $id))) {
			  $tpl->template = 'admin/error.tpl.php';
			  $tpl->error = DEBUG ? "Invalid ID ($id) detected [content.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
		  } else {

			  $pager = Paginator::instance();
			  $pager->items_total = Db::run()->count(Product::xTable, 'membership_id = ' . $id . ' AND status = 1');
			  $pager->default_ipp = App::Core()->perpage;
			  $pager->path = Url::url(Router::$path, "?");
			  $pager->paginate();
			  
			  $sql = "
			  SELECT 
				p.amount,
				p.tax,
				p.coupon,
				p.total,
				p.currency,
				p.created,
				p.user_id,
				CONCAT(u.fname,' ',u.lname) as name
			  FROM
				`" . Product::xTable . "` AS p 
				LEFT JOIN " . Users::mTable . " AS u 
				  ON u.id = p.user_id 
			  WHERE p.membership_id = ?
			  AND p.status = ?
			  ORDER BY p.created DESC" . $pager->limit . ";";

			  $tpl->data = $row;
			  $tpl->plist = Db::run()->pdoQuery($sql, array($id, 1))->results();
			  $tpl->pager = $pager;
			  $tpl->template = 'admin/memberships.tpl.php';
		  }
	  }
	  
      /**
       * Content::getMembershipList()
       * 
       * @return
       */
	  public function getMembershipList()
	  {
	
		  $row = Db::run()->select(self::mxTable, array("id","title"))->results();
		  return ($row) ? $row : 0;
	  }
	  
	  /**
	   * Content::verifyCustomFields()
	   * 
	   * @param mixed $section
	   * @return
	   */
	  public static function verifyCustomFields($section)
	  {
	
		  if ($data = Db::run()->select(self::cfTable, null, array("section" => $section, "active" => 1, "required" => 1))->results()) {
			  foreach ($data as $row) {
				  Validator::checkPost('custom_' . $row->name, Lang::$word->FIELD_R0 . ' "' . $row->title . '" ' . Lang::$word->FIELD_R100);
			  }
		  }
	  } 
	  
	  /**
	   * Content::rendertCustomFields()
	   * 
	   * @param mixed $id
	   * @param mixed $section
	   * @return
	   */
	  public static function rendertCustomFields($id, $section)
	  {
		  
		  switch ($section) {
			  case "product":
				  $item = 'cfd.product_id = ? ';
				  break;
	
			  default:
				  $item = 'cfd.user_id = ? ';
				  break;
	
		  }
		  
		  if ($id) {
			  $sql = "
				  SELECT 
					cf.*,
					cfd.field_value 
				  FROM
					`" . self::cfTable . "` AS cf 
					LEFT JOIN `" . self::cfdTable . "` AS cfd 
					  ON cfd.field_id = cf.id 
				  WHERE $item
				  AND cf.section = ? 
				  ORDER BY cf.sorting;";
			  $data = Db::run()->pdoQuery($sql, array($id, $section))->results();
		  } else {
			  $data = Db::run()->select(self::cfTable, null, array("section" => $section), "ORDER BY sorting")->results();
		  }
	
		  $html = '';
		  if ($data) {
			  foreach ($data as $i => $row) {
				  $tootltip = $row->tooltip ? ' <i data-content="' . $row->tooltip . '" class="icon question sign"></i>' : '';
				  $required = $row->required ? ' <i class="icon asterisk"></i>' : '';
				  $html .= '<div class="wojo fields align middle">';
				  $html .= '<div class="field four wide labeled">';
				  $html .= '<label>' . $row->title . $required . $tootltip . '</label>';
				  $html .= '</div>';
				  $html .= '<div class="field">';
				  $html .= '<input name="custom_' . $row->name . '" type="text" placeholder="' . $row->title . '" value="' . ($id ? $row->field_value : '') . '">';
				  $html .= '</div>';
				  $html .= '</div>';
			  }
		  }
	
		  return $html;
	  }

	  /**
	   * Content::rendertCustomFieldsFront()
	   * 
	   * @param mixed $id
	   * @param mixed $section
	   * @return
	   */
	  public static function rendertCustomFieldsFront($id, $section)
	  {
		  
		  switch ($section) {
			  case "product":
				  $item = 'cfd.product_id = ? ';
				  break;
	
			  default:
				  $item = 'cfd.user_id = ? ';
				  break;
	
		  }
		  
		  if ($id) {
			  $sql = "
				  SELECT 
					cf.*,
					cfd.field_value 
				  FROM
					`" . self::cfTable . "` AS cf 
					LEFT JOIN `" . self::cfdTable . "` AS cfd 
					  ON cfd.field_id = cf.id 
				  WHERE $item
				  AND cf.section = ? 
				  ORDER BY cf.sorting;";
			  $result = Db::run()->pdoQuery($sql, array($id, $section))->results();
		  } else {
			  $result = Db::run()->select(self::cfTable, null, array("section" => $section), "ORDER BY sorting")->results();
		  }
	
		  return Utility::getSnippets(THEMEBASE . "/snippets/customFields.tpl.php", $data = ["data" => $result, "id" => $id, "section" => $section]);
	  }
	  
      /**
       * Content::calculateTax()
       * 
	   * @param bool $uid
       * @return
       */
	  public static function calculateTax($uid = false)
	  {
		  if (App::Core()->enable_tax) {
			  if ($uid) {
				  $cnt = Db::run()->first(Users::mTable, array("country"), array("id" => $uid));
				  if ($cnt) {
					  $row = Db::run()->first(self::cnTable, array("vat"), array("abbr" => $cnt->country));
					  return ($row->vat / 100);
				  } else {
					  return 0;
				  }
			  } else {
				  if (App::Auth()->country) {
					  $row = Db::run()->first(self::cnTable, array("vat"), array("abbr" => App::Auth()->country));
					  return ($row->vat / 100);
				  } else {
					  return 0;
				  }
			  }
		  } else {
			  return 0;
		  }
	  }

      /**
       * Content::makeSiteMap()
       * 
       * @return
       */ 	  
      public static function makeSiteMap()
	  {
		  
		  $html = "";
		  $html .= "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n";
		  $html .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\r\n";
		  $html .= "<url>\r\n";
		  $html .= "<loc>" . SITEURL . "/</loc>\r\n";
		  $html .= "<lastmod>" . date('Y-m-d') . "</lastmod>\r\n";
		  $html .= "</url>\r\n";
          
		  //products
          $items = "SELECT slug FROM `" . Product::mTable . "` WHERE active = ? ORDER BY created DESC;";
		  $query = Db::run()->pdoQuery($items, array(1));

		  foreach ($query->results() as $row) {
			  $html .= "<url>\r\n";
			  $html .= "<loc>" . Url::url('/product', $row->slug) . "</loc>\r\n";
			  $html .= "<lastmod>" . date('Y-m-d') . "</lastmod>\r\n";
			  $html .= "<changefreq>weekly</changefreq>\r\n";
			  $html .= "</url>\r\n";
		  }
          unset($row);

		  //categories
          $cats = "SELECT slug FROM `" . self::cTable . "` WHERE active = ? ORDER BY parent_id;";
		  $query = Db::run()->pdoQuery($cats, array(1));

		  foreach ($query->results() as $row) {
			  $html .= "<url>\r\n";
			  $html .= "<loc>" . Url::url('/category', $row->slug) . "</loc>\r\n";
			  $html .= "<lastmod>" . date('Y-m-d') . "</lastmod>\r\n";
			  $html .= "<changefreq>weekly</changefreq>\r\n";
			  $html .= "</url>\r\n";
		  }
          unset($row);
		  
		  //pages
          $pages = "SELECT slug FROM `" . self::pTable . "` WHERE active = ? AND page_type <> 'home' ORDER BY created DESC;";
		  $query = Db::run()->pdoQuery($pages, array(1));

		  foreach ($query->results() as $row) {
			  $html .= "<url>\r\n";
			  $html .= "<loc>" . Url::url('/page', $row->slug) . "</loc>\r\n";
			  $html .= "<lastmod>" . date('Y-m-d') . "</lastmod>\r\n";
			  $html .= "<changefreq>weekly</changefreq>\r\n";
			  $html .= "</url>\r\n";
		  }
          unset($row);
		  
		  $html .= "</urlset>";
		  
		  return $html;
      } 

      /**
       * Content::writeSiteMap()
       * 
       * @return
       */
	  public static function writeSiteMap()
	  {
		  
		  $filename = BASEPATH . 'sitemap.xml';
		  $file = SITEURL . '/sitemap.xml';
		  if (is_writable($filename)) {
			  file_put_contents($filename, self::makeSiteMap());
			  Message::msgReply($file, 'success', Message::formatSuccessMessage($file, Lang::$word->MT_MAP_OK));
		  } else {
			  Message::msgReply($file, 'success', Message::formatSuccessMessage($file, Lang::$word->MT_MAP_ERROR));
		  }
		  
	  }

      /**
       * Content::getCart()
       * 
	   * @param bool $uid
       * @return
       */
	  public static function getCart($uid = false)
	  {
		  $id = ($uid) ? intval($uid) : App::Auth()->uid;
		  $row = Db::run()->first(Product::cxTable, null, array("user_m_id" => $id));
		  
		  return ($row) ? $row : 0; 
	  }
	  
      /**
       * Content::is_valid()
       * 
       * @return
       */
	  public static function is_valid($mid)
	  {
		  return (in_array(App::Auth()->membership_id, explode(",", $mid))) ? true : false;
	  }
	  
      /**
       * Content::getContentType()
       * 
       * @return
       */ 	  
      public static function getContentType()
	  {
		  $array = array(
				'page' => Lang::$word->MU_PAGE,
				'web' => Lang::$word->EXT_LINK
		  );  

          return $array;
      } 
	  
      /**
       * Content::pageType()
       * 
	   * @param integer $type
       * @return
       */ 	  
      public static function pageType($type)
	  {
		  switch ($type) {
			  case "home" :
				return '<i class="icon medium home disabled"></i>';
			  break;
			  
			  case "faq" :
				return '<i class="icon medium question sign disabled"></i>';
			  break;
			  
			  case "contact" :
				return '<i class="icon medium email disabled"></i>';
			  break;

			  case "membership" :
				return '<i class="icon medium membership disabled"></i>';
			  break;
			  
			  default:
				return '<i class="icon medium file disabled"></i>';
			  break;
		  }

      } 
	  
      /**
       * Content::pageTypeList()
       * 
	   * @param integer $type
       * @return
       */ 	  
      public static function pageTypeList()
	  {
		  $array = array(
				'normal' => Lang::$word->PAG_NORMAL,
				'faq' => Lang::$word->PAG_FAQ,
				'contact' => Lang::$word->PAG_CONTACT,
				'home' => Lang::$word->PAG_HOME
		  );  

          return $array;
      } 
  }
