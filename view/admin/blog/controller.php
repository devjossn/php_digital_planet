<?php
  /**
   * Blog
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: controller.php, v1.00 2020-04-05 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once("../../../init.php");
  
  if (!App::Auth()->is_Admin())
      exit;
	  
  Bootstrap::Autoloader(array(ADMINBASE . '/blog/'));

  if (!App::Auth()->is_Admin())
      exit;
	  
  $delete = Validator::post('delete');
  $trash = Validator::post('trash');
  $pAction = Validator::post('action');
  $iAction = Validator::post('iaction');
  $restore = Validator::post('restore');
  $title = Validator::post('title') ? Validator::sanitize($_POST['title']) : null;

  /* == Delete == */
  switch ($delete):
      /* == Delete Item == */
      case "deleteItem":
          if (Db::run()->delete(Blog::mTable, array("id" => Filter::$id))):
			  File::deleteRecrusive(FRONTBASE . Blog::BLOGDATA . Filter::$id, true);
			  $json['type'] = "success";
          endif;

          $json['title'] = Lang::$word->SUCCESS;
          $json['message'] = str_replace("[NAME]", $title, Lang::$word->_MOD_AM_DEL_OK);
		  print json_encode($json);
          break;
		  
      /* == Delete deleteCategory == */
      case "deleteCategory":
          if ($res = Db::run()->delete(Blog::cTable, array("id" => Filter::$id))):
		      Db::run()->delete(Blog::cTable, array("parent_id" => Filter::$id));
          endif;
		  $json['menu'] = Blog::getCategoryDropList(App::Blog()->categoryTree(), 0, 0, "&#166;&nbsp;&nbsp;&nbsp;&nbsp;");

          $json['type'] = "success";
          $json['title'] = Lang::$word->SUCCESS;
          $json['message'] = str_replace("[NAME]", $title, Lang::$word->_MOD_AM_CATDEL_OK);
		  print json_encode($json);
          break;
  endswitch;
  
  /* == Post Actions == */
  switch ($pAction):
      /* == Process Item == */
      case "processItem":
          App::Blog()->processItem();
      break;
      /* == Process Category == */
      case "processCategory":
          App::Blog()->processCategory();
      break;
      /* == Process Configuration == */
      case "processConfig":
          App::Blog()->processConfig();
      break;
  endswitch;

  /* == Instant Actions == */
  switch ($iAction):
      /* == Sort Categories == */
      case "sortCategories":
		  $jsonstring = $_POST['sortlist'];
		  $jsonDecoded = json_decode($jsonstring, true, 12);
		  $result = Utility::parseJsonArray($jsonDecoded);
		  $i = 0;
		  foreach ($result as $value):
			  if (is_array($value)):
				  $i++;
				  $data = array('sorting' => $i, 'parent_id' => $value['parent_id']);
				  Db::run()->update(Blog::cTable, $data, array('id' => $value['id']));
			  endif;
		  endforeach; 
      break;
  endswitch;