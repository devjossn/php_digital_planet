<?php
  /**
   * Product Admin
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: product.class.php, v1.00 2020-04-20 18:20:24 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');


  class Product
  {
	  
      const mTable = "products";
      const xTable = "payments";
	  const iTable = "images";
	  const fTable = "files";
	  const cxTable = "cart";
	  const cdTable = "cdkeys";
	  const ivTable = "invoices";
	  
	  const FS = 104857600;
	  const FE = "png,jpg,jpeg,bmp,zip,pdf,doc,docx,txt,xls,xlsx,rar,mp4,mp3";
	  
	  const MAXAUDIO = 20971520;
	  const MAXIMG = 5242880;
	  
	  const DATA = "/data/";

      /**
       * Product::__construct()
       * 
       * @return
       */
      public function __construct()
      {

      }
	  
      /**
       * Product::Index()
       * 
       * @return
       */
	  public function Index()
	  {

		  $find = isset($_POST['find']) ? Validator::sanitize($_POST['find'], "default", 30) : null;
		  
          if (isset($_GET['letter']) and $find) {
              $letter = Validator::sanitize($_GET['letter'], 'string', 2);
              $counter = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . self::mTable . "` WHERE `title` LIKE '%" . trim($find) . "%' AND `title` REGEXP '^" . $letter . "'");
              $where = "WHERE p.title LIKE '%" . trim($find) . "%'  AND p.title REGEXP '^" . $letter . "'";

          } elseif (isset($_POST['find'])) {
              $counter = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . self::mTable . "` WHERE `title` LIKE '%" . trim($find) . "%'");
              $where = "WHERE p.title LIKE '%" . trim($find) . "%'";

          } elseif (isset($_GET['letter'])) {
              $letter = Validator::sanitize($_GET['letter'], 'string', 2);
              $where = "WHERE p.title REGEXP '^" . $letter . "'";
              $counter = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . self::mTable . "` WHERE `title` REGEXP '^" . $letter . "' LIMIT 1");
          } else {
			  $counter = Db::run()->count(self::mTable);
              $where = null;
          }

		  
          if (isset($_GET['order']) and count(explode("|", $_GET['order'])) == 2) {
              list($sort, $order) = explode("|", $_GET['order']);
              $sort = Validator::sanitize($sort, "default", 16);
              $order = Validator::sanitize($order, "default", 5);
              if (in_array($sort, array(
                  "title",
                  "price",
                  "sales"))) {
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
		    p.id,
			p.price,
			p.created,
			p.title,
			p.likes,
			p.category_id,
			p.thumb,
			GROUP_CONCAT(m.title SEPARATOR ', ') AS memberships,
			(SELECT 
			  COUNT(product_id) 
			FROM
			  `" . Comments::mTable . "`
			WHERE `" . Comments::mTable . "`.product_id = p.id) as comments,
			(SELECT 
			  COUNT(x.product_id) 
			FROM
			  `" . self::xTable . "` as x 
			WHERE x.product_id = p.id) AS sales,
			c.name
		  FROM
			`" . self::mTable . "` AS p 
			LEFT JOIN `" . Content::cTable . "` AS c 
			  ON c.id = p.category_id 
			LEFT JOIN `" . Content::mxTable . "` AS m 
			  ON FIND_IN_SET(m.id, p.membership_id)
		  $where
		  GROUP BY p.id
		  ORDER BY $sorting " . $pager->limit; 
		  
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->data = Db::run()->pdoQuery($sql)->results();
          $tpl->title = Lang::$word->META_M_PRODUCTS;
		  $tpl->pager = $pager;
          $tpl->template = 'admin/products.tpl.php';
	  }

      /**
       * Product::Edit()
       * 
	   * @param int $id
       * @return
       */
      public static function Edit($id)
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->PRD_EDIT;
          $tpl->crumbs = ['admin', Lang::$word->META_PRODUCTS, Lang::$word->META_EDIT];

          if (!$row = Db::run()->first(self::mTable, null, array("id" => $id))) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [Products.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
              $tpl->row = $row;
			  $tpl->membership_list = App::Content()->getMembershipList();
			  $tpl->files = Db::run()->select(self::fTable, array("id", "alias", "extension", "type", "filesize"), null, "ORDER BY alias")->results();
			  $tpl->tree = App::Content()->categoryTree();
		      $tpl->droplist = Content::getCatCheckList($tpl->tree, 0, 0,"&#166;&nbsp;&nbsp;&nbsp;&nbsp;", $row->categories);
			  $tpl->custom_fields = Content::rendertCustomFields($id, "product");
			  $tpl->cdkeys = Db::run()->select(Product::cdTable, array("cdkey"), array("product_id" => $row->id))->results();
			  $tpl->images = Db::run()->select(self::iTable, array("id", "name"), array("parent_id" => $row->id), "ORDER BY sorting")->results();
              $tpl->template = 'admin/products.tpl.php';
          }
      }

      /**
       * Product::Save()
       * 
       * @return
       */
      public static function Save()
      {
		  
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->PRD_NEW;
          $tpl->crumbs = ['admin', Lang::$word->META_PRODUCTS, Lang::$word->META_NEW];

		  $tpl->membership_list = App::Content()->getMembershipList();
		  $tpl->files = Db::run()->select(self::fTable, array("id", "alias", "extension", "type", "filesize"), null, "ORDER BY alias")->results();
		  $tpl->tree = App::Content()->categoryTree();
		  $tpl->droplist = Content::getCatCheckList($tpl->tree, 0, 0,"&#166;&nbsp;&nbsp;&nbsp;&nbsp;");
		  $tpl->custom_fields = Content::rendertCustomFields('', "product");
		  App::Session()->set("digitoken", Utility::randNumbers(6));
		  $tpl->template = 'admin/products.tpl.php';
      }

      /**
       * Product::History()
       * 
	   * @param int $id
       * @return
       */
      public static function History($id)
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->META_M_HISTORY;
          $tpl->crumbs = ['admin', Lang::$word->META_PRODUCTS, Lang::$word->META_HISTORY];

          if (!$row = Db::run()->first(self::mTable, null, array("id" => $id))) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [Products.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
			  $pager = Paginator::instance();
			  $pager->items_total = Db::run()->count(self::xTable, 'product_id = ' . $id . ' AND status = 1');
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
				`" . self::xTable . "` AS p 
				LEFT JOIN " . Users::mTable . " AS u 
				  ON u.id = p.user_id 
			  WHERE p.product_id = ?
				AND p.status = ?
			  ORDER BY p.created DESC" . $pager->limit . ";";
			  
              $tpl->row = $row;
			  $tpl->plist = Db::run()->pdoQuery($sql, array($id, 1))->results();
			  $tpl->pager = $pager;
              $tpl->template = 'admin/products.tpl.php';
          }
      }
	  
      /**
       * Products::processItem()
       * 
       * @return
       */
      public function processItem()
      {

		  $rules = array(
			  'title' => array('required|string|min_len,3|max_len,100', Lang::$word->NAME),
			  'price' => array('required|numeric', Lang::$word->PRD_PRICE),
			  'sprice' => array('required|numeric', Lang::$word->PRD_SPRICE),
			  'expiry' => array('required|string', Lang::$word->PRD_EXPIRY),
			  'type' => array('required|string', Lang::$word->PRD_TYPE),
			  'active' => array('required|numeric', Lang::$word->PUBLISHED),
			  );

		  $filters = array(
			  'body' => 'advanced_tags',
			  'pbody' => 'advanced_tags',
			  'title' => 'string',
			  'slug' => 'string',
			  'keywords' => 'string',
			  'description' => 'string',
			  'expiry_type' => 'string',
			  'youtube' => 'string',
			  'tags' => 'string',
			  'price' => 'floats',
			  'sprice' => 'floats',
			  'cdkeys' => 'string|trim',
			  );
			  
          switch($_POST['type']) {
			  case "affiliate" :
                  $rules['affiliate'] = array('required|valid_url', Lang::$word->PRD_AFFURL);
			  break;
			  
			  case "cdkey" :
                  $rules['cdkeys'] = array('required|string', Lang::$word->PRD_CDKEYS);
			  break;
			  
			  default :
				  if (!array_key_exists('files', $_POST)) {
					  Message::$msgs['files'] = LANG::$word->PRD_FILE_ERROR;
				  }
			  break;
		  }
		  
          if (!array_key_exists('categories', $_POST)) {
              Message::$msgs['categories'] = LANG::$word->PRD_CAT_ERROR;
          }
		  
		  (Filter::$id) ? $this->_updateItem($rules, $filters) : $this->_addItem($rules, $filters);
      }

      /**
       * Products::_addItem()
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

		  if (!empty($_FILES['audio']['name'])) {
			  $audio = File::upload("audio", self::MAXAUDIO, "mp3");
		  }

		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
		  Content::verifyCustomFields("product");
		  
          if (empty(Message::$msgs)) {
              $data = array(
                  'title' => $safe->title,
				  'slug' => empty($safe->slug) ? Url::doSeo($safe->title) : Url::doSeo($safe->slug),
				  'category_id' => intval($_POST['categories'][0]),
				  'categories' => Utility::implodeFields($_POST['categories']),
				  'files' => $safe->type == "normal" ? Utility::implodeFields($_POST['files']) : 0,
				  'membership_id' => empty($_POST['memberships']) ? 0 : Utility::implodeFields($_POST['memberships']),
                  'price' => $safe->price,
				  'sprice' => $safe->sprice,
				  'is_sale' => ($safe->sprice > 0) ? 1 : 0,
				  'body' => $safe->body,
				  'pbody' => $safe->pbody,
				  'tags' => strtolower($safe->tags),
				  'youtube' => $safe->youtube,
				  'expiry' => $safe->expiry,
				  'expiry_type' => $safe->expiry_type,
                  'active' => $safe->active,
				  'type' => $safe->type,
				  'affiliate' => $safe->affiliate,
				  'token' => Utility::randomString(32),
				  'keywords' => $safe->keywords,
				  'description' => $safe->description,
                  );
				  
			  $temp_id = App::Session()->get("digitoken");
			  File::makeDirectory(UPLOADS . '/data/' . $temp_id . '/thumbs');
			  
			  //process thumb 
			  if (!empty($_FILES['thumb']['name'])) {
				  $item_path = UPLOADS . self::DATA . $temp_id . '/'; 
				  $tresult = File::process($thumb, $item_path, false);
                  try {
                      $img = new Image($item_path . $tresult['fname']);
                      $img->bestFit(App::Core()->thumb_w, App::Core()->thumb_h)->save($item_path . 'thumbs/' . $tresult['fname']);
                  }
                  catch (exception $e) {
					  Debug::AddMessage("errors", '<i>Error</i>', $e->getMessage(), "session");
                  }
				  $data['thumb'] = $tresult['fname'];
			  }

			  //process audio 
			  if (!empty($_FILES['audio']['name'])) {
				  $item_path = UPLOADS . self::DATA . $temp_id . '/'; 
				  $aresult = File::process($audio, $item_path, false);
				  $data['audio'] = $aresult['fname'];
			  }
			  
			  $last_id = Db::run()->insert(self::mTable, $data)->getLastInsertId();

			  //process cd keys 
			  if($_POST['type'] == "cdkey") {
				  $keys = preg_split('/\r\n|[\r\n]/', $safe->cdkeys);
				  foreach ($keys as $key) {
					  $keysArray[] = array(
						  'product_id' => $last_id,
						  'cdkey' => trim($key),
					  );
				  }
				  Db::run()->insertBatch(Product::cdTable, $keysArray);
			  }
			  
			  // Start Custom Fields
			  $fl_array = Utility::array_key_exists_wildcard($_POST, 'custom_*', 'key-value');
			  if ($fl_array) {
				  $fields = Db::run()->select(Content::cfTable, null, array('section' => "product"))->results();
				  foreach ($fields as $row) {
					  $dataArray[] = array(
						  'product_id' => $last_id,
						  'field_id' => $row->id,
						  'field_name' => $row->name,
						  'section' => "product",
						  );
				  }
				  Db::run()->insertBatch(Content::cfdTable, $dataArray);
				  foreach ($fl_array as $key => $val) {
					  if(!empty($val)) {
						  $cfdata['field_value'] = Validator::sanitize($val);
						  Db::run()->update(Content::cfdTable, $cfdata, array("product_id" => $last_id, "field_name" => str_replace("custom_", "", $key)));
					  }
				  }
			  }

			  //process related categories 
			  foreach ($_POST['categories'] as $item) {
				  $cdataArray[] = array(
					  'product_id' => $last_id,
					  'category_id' => $item);
			  }
			  Db::run()->insertBatch(Content::crTable, $cdataArray);
	
			  //process gallery 
			  if($rows = Db::run()->select(self::iTable, array("id", "parent_id"), array("parent_id" => App::Session()->get("digitoken")))->results()) {
				  $query = "UPDATE `" . self::iTable . "` SET `parent_id` = CASE ";
				  $idlist = '';
				  foreach ($rows as $item):
					  $query .= " WHEN id = " . $item->id . " THEN " . $last_id;
					  $idlist .= $item->id . ',';
				  endforeach;
				  $idlist = substr($idlist, 0, -1);
				  $query .= "
						  END
						  WHERE id IN (" . $idlist . ")";
				  Db::run()->pdoQuery($query);
				  
				  $images =  Db::run()->select(self::iTable, array("name"), array("parent_id" => $last_id))->results('json');
				  Db::run()->update(self::mTable, array("images" => $images), array("id" => $last_id));
			  }
			  
			  //rename temp folder 
			  File::renameDirectory(UPLOADS . self::DATA . $temp_id, UPLOADS . '/data/' . $last_id);
				  
			  if ($last_id) {
				  $message = Message::formatSuccessMessage($data['title'], Lang::$word->PRD_ADDED_OK);
				  $json['type'] = "success";
				  $json['title'] = Lang::$word->SUCCESS;
				  $json['message'] = $message;
				  $json['redirect'] = Url::url("/admin/products");
				  Logger::writeLog($message);
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
       * Product::_updateItem()
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

		  if (!empty($_FILES['audio']['name'])) {
			  $audio = File::upload("audio", self::MAXAUDIO, "mp3");
		  }

		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
		  Content::verifyCustomFields("product");
		  
          if (empty(Message::$msgs)) {
              $data = array(
                  'title' => $safe->title,
				  'slug' => empty($safe->slug) ? Url::doSeo($safe->title) : Url::doSeo($safe->slug),
				  'category_id' => intval($_POST['categories'][0]),
				  'categories' => Utility::implodeFields($_POST['categories']),
				  'files' => $safe->type == "normal" ? Utility::implodeFields($_POST['files']) : 0,
				  'membership_id' => empty($_POST['memberships']) ? 0 : Utility::implodeFields($_POST['memberships']),
                  'price' => $safe->price,
				  'sprice' => $safe->sprice,
				  'is_sale' => ($safe->sprice > 0) ? 1 : 0,
				  'body' => $safe->body,
				  'pbody' => $safe->pbody,
				  'tags' => strtolower($safe->tags),
				  'youtube' => $safe->youtube,
				  'expiry' => $safe->expiry,
				  'expiry_type' => $safe->expiry_type,
                  'active' => $safe->active,
				  'images' => Db::run()->select(self::iTable, array("name"), array("parent_id" => Filter::$id))->results('json'),
				  'type' => $safe->type,
				  'affiliate' => $safe->affiliate,
				  'keywords' => $safe->keywords,
				  'description' => $safe->description,
                  );
				  
			  //process thumb 
			  $row = Db::run()->first(self::mTable, array("thumb", "audio"), array('id' => Filter::$id));
			  if (!empty($_FILES['thumb']['name'])) {
				  $item_path = UPLOADS . self::DATA . Filter::$id . '/'; 
				  $tresult = File::process($thumb, $item_path, false);
				  File::deleteFile($item_path . $row->thumb);
				  File::deleteFile($item_path . 'thumbs/' . $row->thumb);
                  try {
                      $img = new Image($item_path . $tresult['fname']);
                      $img->bestFit(App::Core()->thumb_w, App::Core()->thumb_h)->save($item_path . 'thumbs/' . $tresult['fname']);
                  }
                  catch (exception $e) {
					  Debug::AddMessage("errors", '<i>Error</i>', $e->getMessage(), "session");
                  }
				  $data['thumb'] = $tresult['fname'];
			  }

			  //process audio 
			  if (!empty($_FILES['audio']['name'])) {
				  $item_path = UPLOADS . self::DATA . Filter::$id . '/'; 
				  $fresult = File::process($audio, $item_path, false);
				  File::deleteFile($item_path . $row->audio);
				  $data['audio'] = $fresult['fname'];
			  }

			  Db::run()->update(self::mTable, $data, array("id" => Filter::$id));

			  //process cd keys 
			  if($_POST['type'] == "cdkey") {
				  Db::run()->delete(self::cdTable, array("product_id" => Filter::$id));
				  $keys = preg_split('/\r\n|[\r\n]/', $safe->cdkeys);
				  foreach ($keys as $key) {
					  $keysArray[] = array(
						  'product_id' => Filter::$id,
						  'cdkey' => trim($key),
					  );
				  }
				  Db::run()->insertBatch(Product::cdTable, $keysArray);
			  }
			  
			  // Start Custom Fields
			  $fl_array = Utility::array_key_exists_wildcard($_POST, 'custom_*', 'key-value');
			  if ($fl_array) {
				  foreach ($fl_array as $key => $val) {
					$cfdata['field_value'] = Validator::sanitize($val);
					Db::run()->update(Content::cfdTable, $cfdata, array("product_id" => Filter::$id, "field_name" => str_replace("custom_", "", $key)));
				  }
			  }
			  
			  //process related categories 
			  Db::run()->delete(Content::crTable, array('product_id' => Filter::$id));
			  foreach ($_POST['categories'] as $item) {
				  $dataArray[] = array(
					  'product_id' => Filter::$id,
					  'category_id' => $item);
			  }
			  Db::run()->insertBatch(Content::crTable, $dataArray);
			  
			  $message = Message::formatSuccessMessage($data['title'], Lang::$word->PRD_UPDATE_OK);
			  Message::msgReply(Db::run()->affected(), 'success', $message);
			  Logger::writeLog($message);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }
	  
      /**
       * Products::renameFile()
       * 
       * @return
       */
	  public function renameFile()
	  {
	
		  $rules = array(
			  'alias' => array('required|string|min_len,3|max_len,60', Lang::$word->FM_ALIAS),
			  'id' => array('required|numeric', "ID"),
			  );
	
		  $filters = array(
		      'alias' => 'string',
			  );

		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
		  if (empty(Message::$msgs)) {
			  $data = array(
				  'alias' => $safe->alias,
				  );
	
			  Db::run()->update(self::fTable, $data, array("id" => Filter::$id));
			  if(Db::run()->affected()) {
				  $json['type'] = 'success';
				  $json['title'] = Lang::$word->SUCCESS;
				  $json['message'] = Message::formatSuccessMessage($data['alias'], Lang::$word->FM_REN_OK);
				  $json['html'] = $data['alias'];
			  } else {
				  $json['type'] = 'alert';
				  $json['title'] = Lang::$word->ALERT;
				  $json['message'] = Lang::$word->NOPROCCESS;
			  }
			  print json_encode($json);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Product::Front()
       * 
       * @return
       */
	  public function Front()
	  {

          $sql = "
		  SELECT 
		    p.id,
			p.price,
			p.sprice,
			p.is_sale,
			p.created,
			p.title,
			p.slug,
			p.likes,
			p.category_id,
			p.body,
			p.thumb,
			p.type,
			p.token,
			p.affiliate,
			p.membership_id,
			GROUP_CONCAT(m.title SEPARATOR ', ') AS memberships,
			c.name,
			c.slug as cslug
		  FROM
			`" . self::mTable . "` AS p 
			LEFT JOIN `" . Content::cTable . "` AS c 
			  ON c.id = p.category_id 
			LEFT JOIN `" . Content::mxTable . "` AS m 
			  ON FIND_IN_SET(m.id, p.membership_id)
		  WHERE p.active =?
		  GROUP BY p.id
		  ORDER BY p.created DESC LIMIT 0," . App::Core()->featured; 
		  
          $row = Db::run()->pdoQuery($sql, array(1))->results();
		  
		  return ($row) ? $row : 0;
	  }

      /**
       * Product::Search()
       * 
	   * @param str $string
       * @return
       */
	  public function Search($string)
	  {

          $sql = "
		  SELECT 
		    p.id,
			p.price,
			p.sprice,
			p.is_sale,
			p.created,
			p.title,
			p.slug,
			p.likes,
			p.category_id,
			p.body,
			p.thumb,
			p.type,
			p.token,
			p.affiliate,
			p.membership_id,
			GROUP_CONCAT(m.title SEPARATOR ', ') AS memberships,
			c.name,
			c.slug as cslug
		  FROM
			`" . self::mTable . "` AS p 
			LEFT JOIN `" . Content::cTable . "` AS c 
			  ON c.id = p.category_id 
			LEFT JOIN `" . Content::mxTable . "` AS m 
			  ON FIND_IN_SET(m.id, p.membership_id)
		  WHERE p.active = ?
		  AND MATCH (p.title) AGAINST ('" . $string . "*' IN BOOLEAN MODE)
		  OR MATCH (p.body) AGAINST ('" . $string . "*' IN BOOLEAN MODE)
		  GROUP BY p.id
		  ORDER BY p.created DESC LIMIT 20;"; 
		  
          $row = Db::run()->pdoQuery($sql, array(1))->results();
		  
		  return ($row) ? $row : 0;
	  }
	  
      /**
       * Product::Compare()
       * 
	   * @param str $ids
       * @return
       */
	  public function Compare($ids)
	  {

          $sql = "
		  SELECT 
		    p.id,
			p.price,
			p.sprice,
			p.is_sale,
			p.created,
			p.title,
			p.slug,
			p.likes,
			p.category_id,
			p.body,
			p.thumb,
			p.type,
			p.token,
			p.affiliate,
			p.membership_id,
			GROUP_CONCAT(m.title SEPARATOR ', ') AS memberships,
			c.name,
			c.slug as cslug
		  FROM
			`" . self::mTable . "` AS p 
			LEFT JOIN `" . Content::cTable . "` AS c 
			  ON c.id = p.category_id 
			LEFT JOIN `" . Content::mxTable . "` AS m 
			  ON FIND_IN_SET(m.id, p.membership_id)
		  WHERE p.id IN (" . $ids . ")
		  AND p.active = ?
		  GROUP BY p.id
		  ORDER BY p.created DESC LIMIT 0, 6;"; 
		  
          $row = Db::run()->pdoQuery($sql, array(1))->results();
		  
		  return ($row) ? $row : 0;
	  }

      /**
       * Product::Render()
       * 
	   * @param str $slug
       * @return
       */
      public function Render($slug)
      {
		  $core = App::Core();
		  $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "front/themes/" . $core->theme . "/";
		  $tpl->keywords = null;
		  $tpl->description = null;
		  $tpl->title = str_replace("[COMPANY]", $core->company, Lang::$word->META_WELCOME);

		  $sql = "
		  SELECT 
			p.id,
			p.created,
			p.price,
			p.sprice,
			p.is_sale,
			p.title,
			p.thumb,
			p.token,
			p.likes,
			p.ratings,
			FORMAT((likes/ratings),0) as stars,
			p.body,
			p.pbody,
			p.type,
			p.token,
			p.images,
			p.audio,
			p.youtube,
			p.affiliate,
			p.membership_id,
			p.keywords,
			p.description,
			c.slug AS cslug,
			c.name,
			GROUP_CONCAT(m.title SEPARATOR ', ') AS memberships,
			(SELECT 
			  COUNT(product_id) 
			FROM
			  `" . Comments::mTable . "`
			WHERE `" . Comments::mTable . "`.product_id = p.id AND `" . Comments::mTable . "`.active = 1) as comments
		  FROM
			`" . Product::mTable . "` AS p
			LEFT JOIN `" . Content::cTable . "` AS c
			  ON c.id = p.category_id
			LEFT JOIN `" . Content::mxTable . "` AS m 
			  ON FIND_IN_SET(m.id, p.membership_id)
		  WHERE p.slug = ?
			AND p.active = ? 
		  GROUP BY p.id;"; 

		  if (!$tpl->row = Db::run()->pdoQuery($sql, array($slug, 1))->result()) {
			  $tpl->template = 'front/themes/' . $core->theme . '/404.tpl.php';
			  DEBUG ? Debug::AddMessage("errors", '<i>ERROR</i>', "Invalid product detected [product.class.php, ln.:" . __line__ . "] slug ['<b>" . $slug ."</b>']") : Lang::$word->META_ERROR;
		  } else {
			  $sql2 = "
			  SELECT 
				p.id,
				p.price,
				p.sprice,
				p.is_sale,
				p.title,
				p.slug,
				p.category_id,
				p.thumb,
				p.type,
				p.token,
				p.affiliate,
				p.membership_id,
				c.name,
				c.slug as cslug
			  FROM
				`" . self::mTable . "` AS p 
				LEFT JOIN `" . Content::cTable . "` AS c 
				  ON c.id = p.category_id 
			  WHERE p.id NOT IN(" . $tpl->row->id . ")
			     AND p.is_sale = ?
				 AND p.active = ?
			  ORDER BY RAND() LIMIT 3;"; 
			  
			  $tpl->special = Db::run()->pdoQuery($sql2, array(1, 1))->results();
			  $tpl->custom_fields = Content::rendertCustomFieldsFront($tpl->row->id, "product");
			  $tpl->images = Utility::jSonToArray($tpl->row->images);
			  
			  $tpl->title = Url::formatMeta($tpl->row->title);
			  $tpl->keywords = $tpl->row->keywords;
			  $tpl->description = $tpl->row->description;
			  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), $tpl->row->title];
			  $tpl->template = 'front/themes/' . $core->theme . '/product.tpl.php';
		  }
	  }

      /**
       * Product::onSale()
       * 
       * @return
       */
	  public static function onSale()
	  {
	
		  $sql = "
		  SELECT 
			p.id,
			p.price,
			p.sprice,
			p.is_sale,
			p.title,
			p.slug,
			p.category_id,
			p.thumb,
			p.type,
			p.token,
			p.affiliate,
			p.membership_id,
			c.name,
			c.slug as cslug
		  FROM
			`" . self::mTable . "` AS p 
			LEFT JOIN `" . Content::cTable . "` AS c 
			  ON c.id = p.category_id 
		  WHERE p.is_sale = ? 
			 AND p.active = ?
		  ORDER BY RAND() LIMIT 4;"; 
		  
		  $row = Db::run()->pdoQuery($sql, array(1, 1))->results();
	
		  return ($row) ? $row : 0;
			  
	  }
	  
      /**
       * Product::getCartContent()
       * 
       * @return
       */
	  public static function getCartContent($uid = '')
	  {
	
		  $sql = "
		  SELECT 
			c.total,
			p.id AS pid,
			p.title,
			p.slug,
			p.thumb,
			COUNT(*) AS items 
		  FROM
			`" . self::cxTable . "` AS c 
			LEFT JOIN `" . self::mTable . "` AS p 
			  ON p.id = c.product_id 
		  WHERE c.user_id = ?
		  GROUP BY c.product_id, c.total
		  ORDER BY c.product_id DESC;";
		  
		  $row = Db::run()->pdoQuery($sql, array($uid ? $uid : App::Auth()->sesid))->results();
	
		  return ($row) ? $row : 0;
	  }

      /**
       * Product::getCartContentIpn()
       * 
       * @return
       */
	  public static function getCartContentIpn($uid = '')
	  {
	
		  $sql = "
		  SELECT 
			c.total,
			c.totalprice,
			c.coupon,
			p.id,
			p.title
		  FROM
			`" . self::cxTable . "` AS c 
			LEFT JOIN `" . self::mTable . "` AS p 
			  ON p.id = c.product_id 
		  WHERE c.user_id = ?
		  ORDER BY c.product_id DESC;";
		  
		  $row = Db::run()->pdoQuery($sql, array($uid ? $uid : App::Auth()->sesid))->results();
	
		  return ($row) ? $row : 0;
	  }
	  

      /**
       * Product::addToCart($id)
       * 
	   * @param int $id
       * @return
       */
	  public static function addToCart($id)
	  {
	
		  $sql = "
		  SELECT 
			id,
			title, 
			slug, 
			price, 
			sprice, 
			thumb, 
			type, 
			affiliate, 
			is_sale, 
			membership_id 
		  FROM
			`" . self::mTable . "` 
		  WHERE id = ? 
			AND membership_id = ? 
			AND active = ?;";
	
		  if ($row = Db::run()->pdoQuery($sql, array($id, 0, 1))->result()) {
			  if($row->type == "affiliate") {
				  Url::redirect($row->affiliate);
				  exit;
			  } else {
				  if($row->type == "cdkey") {
					  $keys = Db::run()->count(self::cdTable, "product_id = " . $row->id);
					  if (Validator::compareNumbers(intval($_POST['qty']), $keys, "gt")) {
						  $json['status'] = 'error';
						  $json['type'] = "error";
						  $json['title'] = Lang::$word->ERROR;
						  $json['message'] = str_replace("[KEYS]", $keys, Lang::$word->FRONT_CART_ERROR1);
						  print json_encode($json);
						  exit;
					  }
				  }
				  
				  $tax = Content::calculateTax();
				  $price = ($row->is_sale) ? $row->sprice : $row->price;
				  
				  for ($i = 0; $i < intval($_POST['qty']); $i++) {
					  $data[] = array(
						  'user_id' => App::Auth()->sesid,
						  'product_id' => $row->id,
						  'originalprice' => Validator::sanitize($price, "float"),
						  'tax' => Validator::sanitize($tax, "float"),
						  'totaltax' => Validator::sanitize($price * $tax, "float"),
						  'total' => Validator::sanitize($price, "float"),
						  'totalprice' => Validator::sanitize($tax * $price + $price, "float"),
						  );
				  } 
				  Db::run()->insertBatch(self::cxTable, $data);

				  $tpl = App::View(THEMEBASE . '/snippets/');
				  $tpl->template = 'cart.tpl.php';
				  $tpl->data = Product::getCartContent();

				  $json['html'] = $tpl->render();
				  $json['status'] = 'success';
				  $json['title'] = Lang::$word->SUCCESS;
				  $json['type'] = "success";
				  $json['message'] = str_replace("[NAME]", $row->title, Lang::$word->FRONT_CART_OK);
				  $json['counter'] = Product::cartCounter();  
				  print json_encode($json);
			  }
		  } else {
			  $json['status'] = 'error';
			  $json['type'] = "error";
			  $json['title'] = Lang::$word->ERROR;
			  $json['message'] = Lang::$word->FRONT_CART_ERROR;
			  print json_encode($json);
		  }
	  }
	  
      /**
       * Product::getCartTotal()
       * 
       * @return
       */
	  public static function getCartTotal($uid = '')
	  {
	
		  $sql = "
		  SELECT 
		    order_id,
			cart_id,
			SUM(coupon) as discount,
			SUM(totaltax) as tax,
			SUM(total) as subtotal,
			SUM(totalprice) as grand,
			COUNT(id) AS items 
		  FROM
			`" . self::cxTable . "`
		  WHERE user_id = ?
		  GROUP BY user_id, order_id, cart_id;";
		  
		  $row = Db::run()->pdoQuery($sql, array($uid ? $uid : App::Auth()->sesid))->result();
	
		  return ($row) ? $row : 0;
	  }

      /**
       * Product::cartCounter()
       * 
       * @return
       */
	  public static function cartCounter()
	  {
	
		  $sql = "
		  SELECT 
			COUNT(id) AS items 
		  FROM
			`" . self::cxTable . "`
		  WHERE user_id = ?
		  AND membership_id = ?
		  GROUP BY user_id;";
		  
		  $row = Db::run()->pdoQuery($sql, array(App::Auth()->sesid, 0))->result();
	
		  return ($row) ? $row->items : 0;
	  }

      /**
       * Product::Cart()
       * 
       * @return
       */
      public static function Cart()
      {

		  $core = App::Core();
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "front/themes/" . $core->theme . "/";
		  $tpl->template = 'front/themes/' . $core->theme . '/cart.tpl.php';
		  $tpl->title = Url::formatMeta(Lang::$word->META_M_CART);
		  $tpl->keywords = null;
		  $tpl->description = null;
		  
		  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), Lang::$word->META_M_CART];
		  $tpl->data = self::getCartContent();
		  $tpl->totals = self::getCartTotal();
		  $tpl->tax = Content::calculateTax();
		  $tpl->special = self::onSale();
		  if(App::Auth()->is_User()) {
			  $tpl->gateways = Db::run()->select(Core::gTable, null, array("active" => 1))->results();
		  }
      }

      /**
       * Product::fileAccess()
       * 
	   * @param string $token
       * @return
       */
      public static function fileAccess($token)
      {
          $sql = "
		  SELECT 
			SUM(t.qty) AS counter,
			t.created,
			t.status,
			t.ip,
			t.cdkey,
			t.id AS tid,
			SUM(t.downloads) AS file_downloads,
			FROM_UNIXTIME(t.file_date, '%M %e %Y, %H:%i') AS registered,
			MAX(t.file_date) AS file_date,
			p.id AS pid,
			p.title,
			p.files,
			p.thumb,
			p.body,
			p.description,
			p.expiry,
			p.expiry_type,
			p.active AS pactive,
			p.price,
			p.type,
			p.slug
		  FROM
			`" . self::xTable . "` AS t
			LEFT JOIN `" . self::mTable . "` AS p
			  ON t.product_id = p.id
		  WHERE t.id = ?
			AND t.user_id = ?
			AND t.status = ?
			AND p.active = ?
		  GROUP BY p.id,
			t.id;";
			
          $id = $token ? $token : 0;
		  $row = Db::run()->pdoQuery($sql, array($id, App::Auth()->uid, 1, 1))->result();
		  
          return $row ? $row : 0;

      }

      /**
       * Product::relatedFiles()
       * 
	   * @param string $ids
       * @return
       */
      public static function relatedFiles($ids)
      {
          $row = Db::run()->pdoQuery("SELECT * FROM `" . self::fTable . "` WHERE id IN(" . $ids . ");")->results();
		  
          return $row ? $row : 0;

      }
	  
      /**
       * Product::hasThumb()
       * 
	   * @param str $thumb
	   * @param str $id
       * @return
       */
      public static function hasThumb($thumb, $id)
      {

          if($thumb) {
			  return UPLOADURL . '/data/' . $id . '/thumbs/' . $thumb;
		  } else {
			  return UPLOADURL . '/blank.jpg';
		  }
      }
	  
      /**
       * Product::hasImage()
       * 
	   * @param str $image
	   * @param str $id
       * @return
       */
      public static function hasImage($image, $id)
      {

          if($image) {
			  return UPLOADURL . '/data/' . $id . '/' . $image;
		  } else {
			  return UPLOADURL . '/blank.jpg';
		  }
      }

      /**
       * Product::hasAudio()
       * 
	   * @param str $image
	   * @param str $id
       * @return
       */
      public static function hasAudio($audio, $id)
      {

          return UPLOADURL . '/data/' . $id . '/' . $audio;
      }
	  
      /**
       * Product::fileIcon()
       * 
       * @return
       */
	  public static function fileIcon($type, $size = "big")
	  {
			  
		  switch ($type) {
			  case "image":
			  case "jpg":
			  case "png":
			  case "jpeg":
			  case "bmp":
			  case "ai":
			  case "psd":
			      return "<i class=\"icon white $size photo\"></i>";
			  break;
			  
			  case "video":
			  case "mov":
			  case "avi":
			  case "flv":
			  case "mp4":
			  case "mpeg":
			  case "wmv":
			      return "<i class=\"icon white $size movie\"></i>";
			  break;
			  
			  case "audio":
			  case "mp3":
			  case "wav":
			  case "aiff":
			  case "ogg":
			  case "wma":
			  case "flac":
			  case "m4a":
			  case "m4b":
			  case "m4p":
			      return "<i class=\"icon white $size musical note\"></i>";
			  break;
			  
			  case "document":
			  case "text":
			  case "txt":
			  case "doc":
			  case "docx":
			  case "xls":
			  case "xlsx":
			  case "pdf":
			      return "<i class=\"icon white $size files\"></i>";
			  break;
			  
			  case "archive":
			  case "application":
			  case "zip":
			  case "rar":
			      return "<i class=\"icon white $size book\"></i>";
			  break;
			  
		  }
	  }
	  
      /**
       * Product::fileStyle()
       * 
       * @return
       */
	  public static function fileStyle($type)
	  {
			  
		  switch ($type) {
			  case "image":
			  case "jpg":
			  case "png":
			  case "jpeg":
			  case "bmp":
			  case "ai":
			  case "psd":
			      return " #e91e63";
			  break;
			  
			  case "video":
			  case "mov":
			  case "avi":
			  case "flv":
			  case "mp4":
			  case "mpeg":
			  case "wmv":
			      return " #3f51b5";
			  break;
			  
			  case "audio":
			  case "mp3":
			  case "wav":
			  case "aiff":
			  case "ogg":
			  case "wma":
			  case "flac":
			  case "m4a":
			  case "m4b":
			  case "m4p":
			      return " #03a9f4";
			  break;
			  
			  case "document":
			  case "text":
			  case "txt":
			  case "doc":
			  case "docx":
			  case "xls":
			  case "xlsx":
			  case "pdf":
			      return " #8bc34a";
			  break;
			  
			  case "archive":
			  case "application":
			  case "zip":
			  case "rar":
			      return " #607d8b";
			  break;
			  
		  }
	  }
  }