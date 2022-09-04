<?php
  /**
   * Helper
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: helper.php, v1.00 2020-02-05 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once("../../init.php");
	  
  if (!App::Auth()->is_Admin())
      exit;

  $gAction = Validator::get('action');
  $pAction = Validator::post('action');
  $iAction = Validator::post('iaction');
  $title = Validator::post('title') ? Validator::sanitize($_POST['title']) : null;
  
    /* == GET Actions == */
  switch ($gAction) :
	  /* == Rename File == */
	  case "renameFile":
		  $tpl = App::View(BASEPATH . 'view/admin/snippets/'); 
		  $tpl->template = 'renameFile.tpl.php'; 
		  $tpl->data = Db::run()->first(Product::fTable, array("alias"), array('id' => Filter::$id));
		  echo $tpl->render(); 
	  break;
	  
	  /* == Get Content Type == */
	  case "contenttype":
		  $type = Validator::sanitize($_GET['type'], "alpha");
		  $html = '';
		  if ($type == "page"):
			  $data = Db::run()->select(Content::pTable, array("id", "title"), array("active" => 1), "ORDER BY title ASC")->results();
			  if ($data):
				  foreach ($data as $row):
					  $html .= "<option value=\"" . $row->id . "\">" . $row->title . "</option>\n";
				  endforeach;
				  $json['type'] = 'page';
			  endif;

		  else:
			  $json['type'] = 'web';
		  endif;
			  $json['message'] = $html;
			  print json_encode($json);
	  break;
		  
	  /* == Edit Role == */
	  case "editRole":
		  $tpl = App::View(BASEPATH . 'view/admin/snippets/'); 
		  $tpl->data = Db::run()->first(Users::rTable, null, array('id' => Filter::$id));
		  $tpl->template = 'editRole.tpl.php'; 
		  echo $tpl->render(); 
	  break;
	  
	  /* == Load Language Section == */
	  case "languageSection":
		  $xmlel = simplexml_load_file(BASEPATH . Lang::langdir . Core::$language . ".lang.xml");
		  $section = $xmlel->xpath('/language/phrase[@section="' . Validator::sanitize($_GET['section']) . '"]');
		  $tpl = App::View(BASEPATH . 'view/admin/snippets/'); 
		  $tpl->xmlel = $xmlel;
		  $tpl->section = $section;
		  $tpl->template = 'loadLanguageSection.tpl.php'; 
		  $json['html'] = $tpl->render(); 
		  print json_encode($json);
	  break;
	  
	  /* == Site Sales Chart == */
	  case "salesChart":
		  $data = Stats::getAllSalesStats();
		  print json_encode($data);
	  break;

	  /* == Export All Payments == */
	  case "exportAllTransactions":
		  header("Pragma: no-cache");
		  header('Content-Type: text/csv; charset=utf-8');
		  header('Content-Disposition: attachment; filename=AllPayments.csv');
		  
		  $data = fopen('php://output', 'w');
		  fputcsv($data, array('TXN ID', 'Item', 'User', 'Amount', 'TAX/VAT', 'Coupon', 'Total Amount', 'Currency', 'Processor', 'Created'));
		  
		  $result = Stats::exportAllTransactions();
		  if($result):
			  foreach ($result as $row) :
				  fputcsv($data, $row);
			  endforeach;
		  endif;
	  break;

	  /* == Membership Payments Chart == */
	  case "getMembershipPaymentsChart":
		  $data = Stats::getMembershipPaymentsChart(Filter::$id);
		  print json_encode($data);
	  break;
	  
	  /* == Export Membership Payments == */
	  case "exportMembershipPayments":
		  header("Pragma: no-cache");
		  header('Content-Type: text/csv; charset=utf-8');
		  header('Content-Disposition: attachment; filename=MembershipPayments.csv');
		  
		  $data = fopen('php://output', 'w');
		  fputcsv($data, array('TXN ID', 'User', 'Amount', 'TAX/VAT', 'Coupon', 'Total Amount', 'Currency', 'Processor', 'Created'));
		  
		  $result = Stats::exportMembershipPayments(Filter::$id);
		  if($result):
			  foreach ($result as $row) :
				  fputcsv($data, $row);
			  endforeach;
		  endif;
	  break;

	  /* == Export All Payments == */
	  case "exportAllTransactions":
		  header("Pragma: no-cache");
		  header('Content-Type: text/csv; charset=utf-8');
		  header('Content-Disposition: attachment; filename=AllPayments.csv');
		  
		  $data = fopen('php://output', 'w');
		  fputcsv($data, array('TXN ID', 'Item', 'User', 'Amount', 'TAX/VAT', 'Coupon', 'Total Amount', 'Currency', 'Processor', 'Created'));
		  
		  $result = Stats::exportAllTransactions();
		  if($result):
			  foreach ($result as $row) :
				  fputcsv($data, $row);
			  endforeach;
		  endif;
	  break;
	  
	  /* == Export Users == */
	  case "exportUsers":
		  header("Pragma: no-cache");
		  header('Content-Type: text/csv; charset=utf-8');
		  header('Content-Disposition: attachment; filename=UserList.csv');
		  
		  $data = fopen('php://output', 'w');
		  fputcsv($data, array('Name', 'Membership', 'Expire', 'Email', 'Newsletter', 'Created'));
		  
		  $result = Stats::exportUsers();
		  if($result):
			  foreach ($result as $row) :
				  fputcsv($data, $row);
			  endforeach;
		  endif;
	  break;

	  /* == User Payments Chart == */
	  case "getUserProductPaymentsChart":
		  $data = Stats::getUserProductPaymentsChart(Filter::$id);
		  print json_encode($data);
	  break;

	  /* == Export User Payments == */
	  case "exportUserProductPayments":
		  header("Pragma: no-cache");
		  header('Content-Type: text/csv; charset=utf-8');
		  header('Content-Disposition: attachment; filename=UserPayments.csv');
		  
		  $data = fopen('php://output', 'w');
		  fputcsv($data, array('TXN ID', 'User', 'Item', 'Coupon', 'TAX/VAT', 'Amount', 'Processor', 'Currency', 'IP', 'Status', 'Created'));
		  
		  $result = Stats::exportProductPayments(Filter::$id);
		  if($result):
			  foreach ($result as $row) :
				  fputcsv($data, $row);
			  endforeach;
		  endif;
	  break;

	  /* == Item Chart == */
	  case "itemChart":
		  $data = Stats::itemChart(Filter::$id);
		  print json_encode($data);
	  break;

	  /* == Export Item Payments == */
	  case "itemPayments":
		  header("Pragma: no-cache");
		  header('Content-Type: text/csv; charset=utf-8');
		  header('Content-Disposition: attachment; filename=ItemPayments.csv');
		  
		  $data = fopen('php://output', 'w');
		  fputcsv($data, array('TXN ID', 'User', 'Amount', 'TAX/VAT', 'Coupon', 'Total Amount', 'Currency', 'Processor', 'Created'));
		  
		  $result = Stats::itemPayments(Filter::$id);
		  if($result):
			  foreach ($result as $row) :
				  fputcsv($data, $row);
			  endforeach;
			  fclose($data);
		  endif;
	  break;
	  
	  /* == Index Payments Chart == */
	  case "getIndexStats":
		  $data = Stats::indexSalesStats(Filter::$id);
		  print json_encode($data);
	  break;
	  
	  /* == Main Membership Chart == */
	  case "getMainMembershipStats":
		  $data = Stats::getMainMembershipStats(Filter::$id);
		  print json_encode($data);
	  break;
  endswitch;
  
  /* == Post Actions == */
  switch ($pAction) :
	  /* == Rename File == */
	  case "renameFile":
		  App::Product()->renameFile();
	  break;
	  
	  /* == Update Role Description == */
	  case "editRole":
		  App::Users()->updateRoleDescription();
	  break;  
	  
	  /* == Chnage Role == */
	  case "changeRole":
		  if(Auth::checkAcl("owner")):
			  Db::run()->update(Users::rpTable, array("active" => intval($_POST['active'])), array("id" => Filter::$id));
		  endif;
	  break;

	  /* == Chnage Gateway Status == */
	  case "gatewayStatus":
		  if(Auth::checkAcl("owner")):
			  Db::run()->update(Admin::gTable, array("active" => intval($_POST['active'])), array("id" => Filter::$id));
		  endif;
	  break;

	  /* == Update Country Tax == */
	  case "editTax":
		  if (empty($_POST['title'])):
			  print '0.000';
			  exit;
		  endif;
			  $data['vat'] = Validator::sanitize($_POST['title'], "float");
			  Db::run()->update(Content::cnTable, $data, array('id' => Filter::$id));
		  
		  $json['title'] = $title;
		  print json_encode($json);			  
	  break;

	  /* == Chnage Cooupon Status == */
	  case "couponStatus":
		  Db::run()->update(Content::dcTable, array("active" => intval($_POST['active'])), array("id" => Filter::$id));
	  break;
	  
	  /* == Update Language Phrase == */
	  case "editPhrase":
		  if (file_exists(BASEPATH . Lang::langdir . Core::$language . ".lang.xml")):
			  $xmlel = simplexml_load_file(BASEPATH . Lang::langdir . Core::$language . ".lang.xml");
			  $node = $xmlel->xpath("/language/phrase[@data = '" . $_POST['key'] . "']");
			  $node[0][0] = $title;
			  $xmlel->asXML(BASEPATH . Lang::langdir . Core::$language . ".lang.xml");
			  
			  $json['title'] = $title;
			  print json_encode($json);
		  endif;
	  break; 
  endswitch;
		  	  
  /* == Instant Actions == */
  switch ($iAction) :
		  /* == File Upload == */
	  case "fileUpload":
		  if (!empty($_FILES['file']['name'])):
			  $upl = Upload::instance(Product::FS, Product::FE);
			  $upl->process("file", UPLOADS.(App::Core()->file_dir), 'File_');
			  if (empty(Message::$msgs)):
				  $data = array(
					  'alias' => $upl->fileInfo['name'],
					  'name' => $upl->fileInfo['fname'],
					  'filesize' => $upl->fileInfo['size'],
					  'extension' => $upl->fileInfo['ext'],
					  'type' => $upl->fileInfo['type_short'],
					  'token' => Utility::randomString(32),
					  );
					  
				  $last_id = Db::run()->insert(Product::fTable, $data)->getLastInsertId(); 
				  $tpl = App::View(BASEPATH . 'view/admin/snippets/');
				  $tpl->row = Db::run()->first(Product::fTable, null, array('id' => $last_id)); 
				  $tpl->template = 'loadFile.tpl.php'; 
		  
				  $json['type'] = "success";
				  $json['filename'] = $data['name'];
				  $json['icon'] = File::getFileIcon($data['name']);
				  $json['type'] = File::getFileType($data['name']);
				  $json['color'] = File::getFileColor($data['name']);
				  $json['id'] = $last_id;
				  $json['html'] = $tpl->render();
			  else:
				  $json['type'] = "error";
				  $json['message'] = Message::$msgs['name'];
			  endif;
			  print json_encode($json);
		  endif;
	  break;
	  
	  /* == Process Images == */
	  case "processImages":
		  $num_files = count($_FILES['images']['tmp_name']);
		  $filedir = UPLOADS . Product::DATA . Filter::$id;
		  File::makeDirectory($filedir . '/thumbs');
		  
		  for ($x = 0; $x < $num_files; $x++):
			  $image = $_FILES['images']['name'][$x];
			  $newName = "IMG_" . Utility::randomString(12);
			  $ext = substr($image, strrpos($image, '.') + 1);
			  $name = $newName . "." . strtolower($ext);
			  $fullname = $filedir . '/' . $name;
			  
			  if (!move_uploaded_file($_FILES['images']['tmp_name'][$x], $fullname)) {
				  die(Message::msgSingleError(Lang::$word->FU_ERROR13, false));
			  }

			  try {
				  $img = new Image($filedir . '/' . $name);
				  $img->bestFit(App::Core()->thumb_w, App::Core()->thumb_h)->save($filedir . '/thumbs/' . $name);
			  } catch(Exception $e) {
				  echo 'Error: ' . $e->getMessage();
			  }
			  
			  $last_id = Db::run()->insert(Product::iTable, array("parent_id" => Filter::$id, "name" => $name))->getLastInsertId();

			  print '
                <div class="columns" id="item_' . $last_id . '" data-id="' . $last_id . '">
                  <div class="wojo attached segment center aligned"><img src="' . Product::hasThumb($name, Filter::$id) . '" alt="" class="wojo normal center image">
                    <a data-set=\'{"option":[{"delete": "deleteImage","id":' . $last_id . '}],"action":"delete", "parent":"#item_' . $last_id . '"}\' class="wojo small icon negative simple button data">
                    <i class="icon trash"></i></a>
                  </div>
                </div>';
		  endfor;
	  break;

      /* == Sort Images == */
      case "sortImages":
		  $i = 0;
		  $query = "UPDATE `" . Product::iTable . "` SET `sorting` = CASE ";
		  $idlist = '';
		  foreach ($_POST['sorting'] as $item):
			  $i++;
			  $query .= " WHEN id = " . $item . " THEN " . $i . " ";
			  $idlist .= $item . ',';
		  endforeach;
		  $idlist = substr($idlist, 0, -1);
		  $query .= "
				  END
				  WHERE id IN (" . $idlist . ")";
		  Db::run()->pdoQuery($query);
      break;
	  
	  /* == Sort Menus == */
	  case "sortMenus":
		  $jsonstring = $_POST['sorting'];
		  $jsonDecoded = json_decode($jsonstring, true, 12);
		  $result = Utility::parseJsonArray($jsonDecoded);
		  
		  $i = 0;
		  $query = "UPDATE `" . Content::mTable . "` SET `sorting` = CASE ";
		  $idlist = '';
		  foreach ($result as $item):
			  $i++;
			  $query .= " WHEN id = " . $item['id'] . " THEN " . $i . " ";
			  $idlist .= $item['id'] . ',';
		  endforeach;
		  $idlist = substr($idlist, 0, -1);
		  $query .= "
				  END
				  WHERE id IN (" . $idlist . ")";
		  Db::run()->pdoQuery($query);
	  break;

	  /* == Sort Categories == */
	  case "sortCategories":
		  $jsonstring = $_POST['sorting'];
		  $jsonDecoded = json_decode($jsonstring, true, 12);
		  $result = Utility::parseJsonArray($jsonDecoded);
		  $i = 0;
		  foreach ($result as $item):
			  if (is_array($item)):
				  $i++;
				  $data = array('sorting' => $i, 'parent_id' => $item['parent_id']);
				  Db::run()->update(Content::cTable, $data, array('id' => $item['id']));
			  endif;
		  endforeach; 
	  break;

	  /* == Sort Custom Fields == */
	  case "sortFields":
		  $i = 0;
		  $query = "UPDATE `" . Content::cfTable . "` SET `sorting` = CASE ";
		  $idlist = '';
		  foreach ($_POST['sorting'] as $item):
			  $i++;
			  $query .= " WHEN id = " . $item . " THEN " . $i . " ";
			  $idlist .= $item . ',';
		  endforeach;
		  $idlist = substr($idlist, 0, -1);
		  $query .= "
				  END
				  WHERE id IN (" . $idlist . ")";
		  Db::run()->pdoQuery($query);
	  break;

	  /* == Sort FAQ == */
	  case "sortFaq":
		  $i = 0;
		  $query = "UPDATE `" . Content::fTable . "` SET `sorting` = CASE ";
		  $idlist = '';
		  foreach ($_POST['sorting'] as $item):
			  $i++;
			  $query .= " WHEN id = " . $item . " THEN " . $i . " ";
			  $idlist .= $item . ',';
		  endforeach;
		  $idlist = substr($idlist, 0, -1);
		  $query .= "
				  END
				  WHERE id IN (" . $idlist . ")";
		  Db::run()->pdoQuery($query);
	  break;
		  
	  /* == Database Backup == */
	  case "databaseBackup":
		  dbTools::doBackup();
	  break;
	  
	  /* == Comment Approve == */
	  case "commentApprove":
		  if(Db::run()->update(Comments::mTable, array("active" => 1), array("id" => Filter::$id))):
			  $json['type'] = "success";
			  print json_encode($json);
		  endif;
	  break; 
  endswitch;

  /* == Clear Session Temp Queries == */
  if (isset($_GET['ClearSessionQueries'])):
      App::Session()->remove('debug-queries');
	  App::Session()->remove('debug-warnings');
	  App::Session()->remove('debug-errors');
	  print 1;
  endif;