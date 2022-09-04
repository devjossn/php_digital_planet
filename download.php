<?php
  /**
   * Download
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: download.php, v1.00 2020-03-05 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once ("init.php");
  set_time_limit(0);

  if (ini_get('zlib.output_compression')) {
      ini_set('zlib.output_compression', 'Off');
  }

  //free downloads
  if (isset($_GET['free'])) {
      $token = Validator::sanitize($_GET['token'], "alphanumeric", 32);
      $id = Utility::decode($_GET['free']);

      if ($item = Db::run()->select(Product::mTable, array("price"), array("id" => $id ? $id : 0, "active" => 1))->result()) {
          if ($item->price > 0) {
              Url::redirect(SITEURL . "/?msg=6");
              exit;
          }

          if (App::Core()->allow_free == "no" and !App::Auth()->logged_in) {
              Url::redirect(Url::currentUrl() . "?msg=" . urlencode(Lang::$word->FM_ERROR9));
              exit;
          }

          if ($row = Db::run()->first(Product::fTable, array("alias", "name"), array("token" => $token))) {
              if (!File::exists(App::Core()->file_dir . $row->name)) {
                  Url::redirect(Url::currentUrl() . "?msg=" . urlencode(Lang::$word->FM_ERROR5));
                  exit;
              }
              File::download(App::Core()->file_dir . $row->name, $row->name);
          } else {
              Url::redirect(Url::currentUrl() . "?msg=" . urlencode(str_replace("[IP]", Url::getIP(), Lang::$word->FM_ERROR10)));
              exit;
          }

      } else {
          Url::redirect(Url::currentUrl() . "?msg=" . urlencode(Lang::$word->FM_ERROR7));
      }
  //membership downloads
  } elseif (isset($_GET['member']) and isset($_GET['token']) and App::Auth()->logged_in) {
      $token = Validator::sanitize($_GET['token'], "alphanumeric", 32);
      $id = Utility::decode($_GET['member']);

      if ($item = Db::run()->select(Product::mTable, array("membership_id"), array("id" => $id ? $id : 0, "active" => 1))->result()) {
          if (!Content::is_valid($item->membership_id)) {
              Url::redirect(Url::currentUrl() . "?msg=" . urlencode(Lang::$word->FM_ERROR11));
              exit;
          }

          if ($row = Db::run()->first(Product::fTable, array("alias", "name"), array("token" => $token))) {
              if (!File::exists(App::Core()->file_dir . $row->name)) {
                  Url::redirect(Url::currentUrl() . "?msg=" . urlencode(Lang::$word->FM_ERROR5));
                  exit;
              }
              File::download(App::Core()->file_dir . $row->name, $row->name);
          } else {
              Url::redirect(Url::currentUrl() . "?msg=" . urlencode(str_replace("[IP]", Url::getIP(), Lang::$word->FM_ERROR10)));
              exit;
          }
      } else {
          Url::redirect(Url::currentUrl() . "?msg=" . urlencode(Lang::$word->FM_ERROR7));
      }

  //paid downloads
  } elseif (isset($_GET['paid']) and isset($_GET['token']) and App::Auth()->logged_in) {
      $token = Validator::sanitize($_GET['token'], "alphanumeric", 32);
      $id = Validator::sanitize($_GET['paid'], "int", 11);

      $sql = "
	  SELECT 
		COUNT(t.qty) AS counter,
		t.id,
		t.status,
		t.downloads,
		t.file_date,
		p.expiry,
		p.expiry_type
	  FROM
		`" . Product::xTable . "` AS t
		LEFT JOIN `" . Product::mTable . "` AS p
		  ON t.product_id = p.id
	  WHERE t.id = ?
		AND t.user_id = ?
		AND t.status = ?
		AND p.active = ?
		GROUP BY t.id;";

      if ($row = Db::run()->pdoQuery($sql, array($id, App::Auth()->uid, 1, 1))->result()) {
          if ($row->expiry != 0 && $row->status == 1) {
              if ($row->expiry_type == "days") {
				  
				  $expiry = ($row->expiry * $row->counter);
				  $current_time = time();
				  $expiry_time = $row->file_date + ($expiry * 24 * 60 * 60);
				  $elapsed_time = $current_time - $row->file_date;
				  if ($current_time > $expiry_time) {
					  $expired = true;
				  }
              } else {
                  if ($row->downloads >= ($row->expiry * $row->counter)) {
                      $expired = true;
                  }
              }
          }
          if (isset($expired)) {
			  Url::redirect(Url::currentUrl() . "?msg=" . urlencode(Lang::$word->FM_ERROR1));
              exit;
          }

          $frow = Db::run()->first(Product::fTable, array("alias", "name"), array("token" => $token));
          if (!File::exists(App::Core()->file_dir . $frow->name)) {
			  Url::redirect(Url::currentUrl() . "?msg=" . urlencode(Lang::$word->FM_ERROR5));
              exit;
          }
          //update download counter
          Db::run()->pdoQuery("
			  UPDATE `" . Product::xTable . "` 
			  SET downloads = downloads + 1
			  WHERE id = ?
		  ", array($row->id));

          File::download(App::Core()->file_dir . $frow->name, $frow->name);
      } else {
          Url::redirect(Url::currentUrl() . "?msg=" . urlencode(str_replace("[IP]", Url::getIP(), Lang::$word->FM_ERROR10)));
      }
  } else {
      Url::redirect(Url::currentUrl() . "?msg=" . urlencode(Lang::$word->FM_ERROR7));
  }