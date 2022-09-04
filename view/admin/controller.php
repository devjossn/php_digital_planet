<?php
  /**
   * Controller
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: controller.php, v1.00 2020-02-05 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once("../../init.php");
	  
  if (!App::Auth()->is_Admin())
      exit;
	  
  $delete = Validator::post('delete');
  $trash = Validator::post('trash');
  $action = Validator::post('action');
  $restore = Validator::post('restore');
  $title = Validator::post('title') ? Validator::sanitize($_POST['title']) : null;
  
    /* == Delete Actions == */
  switch ($delete):
      /* == Delete Product == */
      case "deleteProduct":
          if ($row = Db::run()->delete(Product::mTable, array("id" => Filter::$id))):
		     Db::run()->delete(Comments::mTable, array("product_id" => Filter::$id));
		     Db::run()->delete(Content::cfdTable, array("product_id" => Filter::$id));
			 Db::run()->delete(Product::cdTable, array("product_id" => Filter::$id));
			 Db::run()->delete(Product::xTable, array("product_id" => Filter::$id));
			 File::deleteRecrusive(UPLOADS . Product::DATA . Filter::$id, true);
             $json['type'] = "success";
          endif;

          $json['title'] = Lang::$word->SUCCESS;
          $json['message'] = str_replace("[NAME]", $title, Lang::$word->PRD_TRASH_OK);
		  print json_encode($json);
          break;

      /* == Delete Image == */
      case "deleteImage":
          if ($row = Db::run()->first(Product::iTable, null, array("id" => Filter::$id))):
		     File::deleteFile(UPLOADS . Product::DATA . $row->parent_id . '/' . $row->name);
			 File::deleteFile(UPLOADS . Product::DATA . $row->parent_id . '/thumbs/' . $row->name);
			 Db::run()->delete(Product::iTable, array("id" => Filter::$id));
             $json['type'] = "success";
          endif;
		  print json_encode($json);
          break;

      /* == Delete File == */
      case "deleteFile":
          if ($row = Db::run()->delete(Product::fTable, array("id" => Filter::$id))):
		     File::deleteFile(App::Core()->file_dir . $_POST['name']);
             $json['type'] = "success";
          endif;

          $json['title'] = Lang::$word->SUCCESS;
          $json['message'] = str_replace("[NAME]", $title, Lang::$word->FM_DELETE_OK);
		  print json_encode($json);
          break;
		  
      /* == Delete Field == */
      case "deleteField":
          if ($row = Db::run()->delete(Content::cfTable, array("id" => Filter::$id))):
		     Db::run()->delete(Content::cfdTable, array("field_id" => Filter::$id));
             $json['type'] = "success";
          endif;

          $json['title'] = Lang::$word->SUCCESS;
          $json['message'] = str_replace("[NAME]", $title, Lang::$word->CF_DEL_OK);
		  print json_encode($json);
          break;
		  
      /* == Delete Comment == */
      case "deleteComment":
          if ($row = Db::run()->delete(Comments::mTable, array("id" => Filter::$id))):
             $json['type'] = "success";
          endif;

          $json['title'] = Lang::$word->SUCCESS;
          $json['message'] = str_replace("[ID]", $title, Lang::$word->CMT_DEL_OK);
		  print json_encode($json);
          break;
		  
      /* == Delete Database == */
      case "deleteBackup":
		  File::deleteFile(UPLOADS . '/backups/' . $title);
		  $json['type'] = "success";
          $json['title'] = Lang::$word->SUCCESS;
          $json['message'] = str_replace("[NAME]", $title, Lang::$word->DBM_DEL_OK);
		  print json_encode($json);
          break;
		  
	  /* == Delete From Trash == */
	  case "deleteMenu":
	  case "deletePage":
	  case "deleteNews":
	  case "deleteMembership":
	  case "deleteUser":
	  case "deleteMenu":
	  case "deleteCategory":
		  Db::run()->delete(Core::txTable, array("id" => filter::$id));
		  $json['type'] = "success";
		  print json_encode($json);
	  break; 
	  
      /* == Delete Trash == */
      case "trashAll":
		  Db::run()->truncate(Core::txTable);
		  Message::msgReply(true, 'success', Lang::$word->TRASH_DEL_OK);
          break;
  endswitch;
  
  /* == Trash Actions == */
  switch ($trash):
      /* == Trash User == */
      case "trashUser":
          if ($row = Db::run()->first(Users::mTable, "*", array("id =" =>Filter::$id, "AND type <>" => "owner"))):
              $data = array(
                  'type' => "user",
                  'parent_id' => Filter::$id,
                  'dataset' => json_encode($row),
				  );
              Db::run()->insert(Core::txTable, $data);
              Db::run()->delete(Users::mTable, array("id" => $row->id));
			  $json['type'] = "success";
          endif;

          $json['title'] = Lang::$word->SUCCESS;
          $json['message'] = str_replace("[NAME]", $title, Lang::$word->USR_TRASH_OK);
		  print json_encode($json);
          break;
		  
      /* == Trash Menu == */
      case "trashMenu":
          if ($row = Db::run()->first(Content::mTable, "*", array("id =" =>Filter::$id))):
              $data = array(
                  'type' => "menu",
                  'parent_id' => Filter::$id,
                  'dataset' => json_encode($row)
				  );
              Db::run()->insert(Core::txTable, $data);
              Db::run()->delete(Content::mTable, array("id" => $row->id));
			  $json['type'] = "success";
          endif;
		  
		  $json['title'] = Lang::$word->SUCCESS;
		  $json['message'] = str_replace("[NAME]", $title, Lang::$word->NW_TRASH_OK);
		  print json_encode($json);
          break;
		  
      /* == Trash Category == */
      case "trashCategory":
          if ($row = Db::run()->first(Content::cTable, "*", array("id" => Filter::$id))):
              $data = array(
                  'type' => "category",
                  'parent_id' => Filter::$id,
                  'dataset' => json_encode($row)
				  );
              Db::run()->insert(Core::txTable, $data);
              $res = Db::run()->delete(Content::cTable, array("id" => $row->id));
              if ($result = Db::run()->select(Content::cTable, "*", array("parent_id" => $row->id))->results()):
                  foreach ($result as $item):
                      $dataArray[] = array(
                          'parent' => "category",
                          'type' => "subcategory",
                          'parent_id' => $row->id,
                          'dataset' => json_encode($item),
                          );
                  endforeach;
                  Db::run()->insertBatch(Core::txTable, $dataArray);
                  Db::run()->delete(Content::cTable, array("parent_id" => $row->id));
              endif;
              $json['menu'] = App::Content()->getCategoryDropList(App::Content()->categoryTree(), 0, 0, "&#166;&nbsp;&nbsp;&nbsp;&nbsp;");
			  $json['type'] = "success";
          endif;
		  
          $json['title'] = Lang::$word->SUCCESS;
          $json['message'] = str_replace("[NAME]", $title, Lang::$word->CT_TRASH_OK);
		  print json_encode($json);
          break;
		  
      /* == Trash Page == */
      case "trashPage":
          if ($row = Db::run()->first(Content::pTable, "*", array("id =" =>Filter::$id))):
              $data = array(
                  'type' => "page",
                  'parent_id' => Filter::$id,
                  'dataset' => json_encode($row)
				  );
              Db::run()->insert(Core::txTable, $data);
              Db::run()->delete(Content::pTable, array("id" => $row->id));
			  $json['type'] = "success";
          endif;
		  
		  $json['title'] = Lang::$word->SUCCESS;
		  $json['message'] = str_replace("[NAME]", $title, Lang::$word->PAG_TRASH_OK);
		  print json_encode($json);
          break;
		  
      /* == Trash Coupon == */
      case "trashCoupon":
          if ($row = Db::run()->first(Content::dcTable, "*", array("id =" =>Filter::$id))):
              $data = array(
                  'type' => "coupon",
                  'parent_id' => Filter::$id,
                  'dataset' => json_encode($row)
				  );
              Db::run()->insert(Core::txTable, $data);
              Db::run()->delete(Content::dcTable, array("id" => $row->id));
			  $json['type'] = "success";
          endif;
		  
		  $json['title'] = Lang::$word->SUCCESS;
		  $json['message'] = str_replace("[NAME]", $title, Lang::$word->DC_TRASH_OK);
		  print json_encode($json);
          break;
		  
      /* == Trash News == */
      case "trashNews":
          if ($row = Db::run()->first(Content::nTable, "*", array("id =" =>Filter::$id))):
              $data = array(
                  'type' => "news",
                  'parent_id' => Filter::$id,
                  'dataset' => json_encode($row)
				  );
              Db::run()->insert(Core::txTable, $data);
              Db::run()->delete(Content::nTable, array("id" => $row->id));
			  $json['type'] = "success";
          endif;
		  
		  $json['title'] = Lang::$word->SUCCESS;
		  $json['message'] = str_replace("[NAME]", $title, Lang::$word->NW_TRASH_OK);
		  print json_encode($json);
          break;
		  
      /* == Trash Faq == */
      case "trashFaq":
          if ($row = Db::run()->first(Content::fTable, "*", array("id =" =>Filter::$id))):
              $data = array(
                  'type' => "faq",
                  'parent_id' => Filter::$id,
                  'dataset' => json_encode($row)
				  );
              Db::run()->insert(Core::txTable, $data);
              Db::run()->delete(Content::fTable, array("id" => $row->id));
			  $json['type'] = "success";
          endif;
		  
		  $json['title'] = Lang::$word->SUCCESS;
		  $json['message'] = str_replace("[NAME]", $title, Lang::$word->FAQ_TRASH_OK);
		  print json_encode($json);
          break;
		  
      /* == Trash Membersip == */
      case "trashMembership":
          if ($row = Db::run()->first(Content::mxTable, "*", array("id =" =>Filter::$id))):
              $data = array(
                  'type' => "membership",
                  'parent_id' => Filter::$id,
                  'dataset' => json_encode($row)
				  );
              Db::run()->insert(Core::txTable, $data);
              Db::run()->delete(Content::mxTable, array("id" => $row->id));
			  $json['type'] = "success";
          endif;
		  
		  $json['title'] = Lang::$word->SUCCESS;
		  $json['message'] = str_replace("[NAME]", $title, Lang::$word->NW_TRASH_OK);
		  print json_encode($json);
          break;
  endswitch;

  /* == Restore Actions == */
  switch ($restore):
	  /* == Restore Menu == */
	  case "restoreMenu":
		  if($result = Db::run()->first(Core::txTable, array('dataset'), array("id" => filter::$id))):
			  $array = Utility::jSonToArray($result->dataset);
			  Core::restoreFromTrash($array, Content::mTable);
			  Db::run()->delete(Core::txTable, array("id" => filter::$id));
			  
              $json['type'] = 'success';
              $json['title'] = Lang::$word->SUCCESS;
              $json['message'] = str_replace("[NAME]", $title, Lang::$word->MU_RESTORE_OK);
          else :
              $json['type'] = 'alert';
              $json['title'] = Lang::$word->ALERT;
              $json['message'] = Lang::$word->NOPROCCESS;
          endif;

          print json_encode($json);
          break;

	  /* == Restore Category == */
	  case "restoreCategory":
		  if($result = Db::run()->first(Core::txTable, array('dataset'), array("id" => filter::$id))):
			  $array = Utility::jSonToArray($result->dataset);
			  Core::restoreFromTrash($array, Content::cTable);
			  Db::run()->delete(Core::txTable, array("id" => filter::$id));
			  
              $json['type'] = 'success';
              $json['title'] = Lang::$word->SUCCESS;
              $json['message'] = str_replace("[NAME]", $title, Lang::$word->CT_RESTORE_OK);
          else :
              $json['type'] = 'alert';
              $json['title'] = Lang::$word->ALERT;
              $json['message'] = Lang::$word->NOPROCCESS;
          endif;

          print json_encode($json);
          break;
		  
	  /* == Restore Page == */
	  case "restorePage":
		  if($result = Db::run()->first(Core::txTable, array('dataset'), array("id" => filter::$id))):
			  $array = Utility::jSonToArray($result->dataset);
			  Core::restoreFromTrash($array, Content::pTable);
			  Db::run()->delete(Core::txTable, array("id" => filter::$id));
			  
              $json['type'] = 'success';
              $json['title'] = Lang::$word->SUCCESS;
              $json['message'] = str_replace("[NAME]", $title, Lang::$word->PAG_RESTORE_OK);
          else :
              $json['type'] = 'alert';
              $json['title'] = Lang::$word->ALERT;
              $json['message'] = Lang::$word->NOPROCCESS;
          endif;
          print json_encode($json);
          break;

	  /* == Restore Faq == */
	  case "restoreFaq":
		  if($result = Db::run()->first(Core::txTable, array('dataset'), array("id" => filter::$id))):
			  $array = Utility::jSonToArray($result->dataset);
			  Core::restoreFromTrash($array, Content::fTable);
			  Db::run()->delete(Core::txTable, array("id" => filter::$id));
			  
              $json['type'] = 'success';
              $json['title'] = Lang::$word->SUCCESS;
              $json['message'] = str_replace("[NAME]", $title, Lang::$word->FAQ_RESTORE_OK);
          else :
              $json['type'] = 'alert';
              $json['title'] = Lang::$word->ALERT;
              $json['message'] = Lang::$word->NOPROCCESS;
          endif;
          print json_encode($json);
          break;
	  
	  /* == Restore Membership == */
	  case "restoreMembership":
		  if($result = Db::run()->first(Core::txTable, array('dataset'), array("id" => filter::$id))):
			  $array = Utility::jSonToArray($result->dataset);
			  Core::restoreFromTrash($array, Content::mxTable);
			  Db::run()->delete(Core::txTable, array("id" => filter::$id));
			  
              $json['type'] = 'success';
              $json['title'] = Lang::$word->SUCCESS;
              $json['message'] = str_replace("[NAME]", $title, Lang::$word->MEM_RESTORE_OK);
          else :
              $json['type'] = 'alert';
              $json['title'] = Lang::$word->ALERT;
              $json['message'] = Lang::$word->NOPROCCESS;
          endif;
          print json_encode($json);
          break;

	  /* == Restore News == */
	  case "restoreNews":
		  if($result = Db::run()->first(Core::txTable, array('dataset'), array("id" => filter::$id))):
			  $array = Utility::jSonToArray($result->dataset);
			  Core::restoreFromTrash($array, Content::nTable);
			  Db::run()->delete(Core::txTable, array("id" => filter::$id));
			  
              $json['type'] = 'success';
              $json['title'] = Lang::$word->SUCCESS;
              $json['message'] = str_replace("[NAME]", $title, Lang::$word->NW_RESTORE_OK);
          else :
              $json['type'] = 'alert';
              $json['title'] = Lang::$word->ALERT;
              $json['message'] = Lang::$word->NOPROCCESS;
          endif;
          print json_encode($json);
          break;

	  /* == Restore Coupon == */
	  case "restoreCoupon":
		  if($result = Db::run()->first(Core::txTable, array('dataset'), array("id" => filter::$id))):
			  $array = Utility::jSonToArray($result->dataset);
			  Core::restoreFromTrash($array, Content::dcTable);
			  Db::run()->delete(Core::txTable, array("id" => filter::$id));
			  
              $json['type'] = 'success';
              $json['title'] = Lang::$word->SUCCESS;
              $json['message'] = str_replace("[NAME]", $title, Lang::$word->DC_RESTORE_OK);
          else :
              $json['type'] = 'alert';
              $json['title'] = Lang::$word->ALERT;
              $json['message'] = Lang::$word->NOPROCCESS;
          endif;
          print json_encode($json);
          break;
	  
	  /* == Restore User == */
	  case "restoreUser":
		  if($result = Db::run()->first(Core::txTable, array('dataset'), array("id" => filter::$id))):
			  $array = Utility::jSonToArray($result->dataset);
			  Core::restoreFromTrash($array, Users::mTable);
			  Db::run()->delete(Core::txTable, array("id" => filter::$id));
			  
              $json['type'] = 'success';
              $json['title'] = Lang::$word->SUCCESS;
              $json['message'] = str_replace("[NAME]", $title, Lang::$word->USR_RESTORE_OK);
          else :
              $json['type'] = 'alert';
              $json['title'] = Lang::$word->ALERT;
              $json['message'] = Lang::$word->NOPROCCESS;
          endif;
          print json_encode($json);
          break;
	  
      /* == Restore Database == */
      case "restoreBackup":
		  dbTools::doRestore($title);
          break;
  endswitch;
  
  /* == Actions == */
  switch ($action):
        /* == Process User == */
      case "processUser":
          App::Users()->processUser();
      break;
      /* == Process Product == */
      case "processItem":
          App::Product()->processItem();
      break;
        /* == Process Menu == */
      case "processMenu":
          App::Content()->processMenu();
      break;
        /* == Process Category == */
      case "processCategory":
          App::Content()->processCategory();
      break;
      /* == Process Page == */
      case "processPage":
          App::Content()->processPage();
      break;
        /* == Process Country == */
      case "processCountry":
          App::Content()->processCountry();
      break;
      /* == Process Coupon == */
      case "processCoupon":
          App::Content()->processCoupon();
      break;
      /* == Comment Configuration == */
      case "commentConfig":
          App::Comments()->processConfig();
      break;
        /* == Process Email Template == */
      case "processTemplate":
          App::Content()->processTemplate();
      break;
      /* == Process Field == */
      case "processField":
          App::Content()->processField();
      break;
      /* == Process News == */
      case "processNews":
          App::Content()->processNews();
      break;
        /* == Process Faq == */
      case "processFaq":
          App::Content()->processFaq();
      break;
        /* == Process Newsletter == */
      case "processMailer":
          App::Admin()->processMailer();
      break;
        /* == Process Membership == */
      case "processMembership":
          App::Content()->processMembership();
      break;
      /* == System Configuration == */
      case "processConfig":
          App::Core()->processConfig();
      break;
      /* == Process Transaction == */
      case "processTransaction":
          App::Admin()->processTransaction();
      break;
        /* == Process Gateway == */
      case "processGateway":
          App::Admin()->processGateway();
      break;
      /* == Update Account == */
      case "updateAccount":
          App::Admin()->updateAccount();
      break;
      /* == Update Password == */
      case "updatePassword":
          App::Admin()->updateAdminPassword();
      break;
      /* == Delete Inactive users == */
      case "processMInactive":
          Stats::deleteInactive(intval($_POST['days']));
      break;
      /* == Delete Banned Users == */
      case "processMIBanned":
          Stats::deleteBanned();
      break;
      /* == Delete Cart == */
      case "processMCart":
          Stats::emptyCart();
      break;
      /* == Generate SiteMap == */
      case "processMap":
          Content::writeSiteMap();
      break;
  endswitch;