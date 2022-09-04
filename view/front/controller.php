<?php
  /**
   * Controller
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: controller.php, v1.00 2020-04-05 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once("../../init.php");

  $action = Validator::request('action');
  $iAction = Validator::post('iaction');
  
  /* == Actions == */
  switch ($action):
          /* == Admin Password Reset == */
      case "aResetPass":
          App::Admin()->passReset();
          break;

          /* == User Password Reset == */
      case "uResetPass":
          App::Front()->passReset();
          break;

          /* == Admin Login == */
      case "adminLogin":
          App::Auth()->login($_POST['username'], $_POST['password']);
          break;

      /* == Pass Reset == */
      case "password":
          App::Front()->passwordChange();
      break;
	  
          /* == User Login == */
      case "userLogin":
          App::Auth()->login($_POST['username'], $_POST['password']);
          break;

          /* == Register == */
      case "register":
          App::Front()->Registration();
          break;

      /* == Update Profile == */
      case "profile":
	      if(!App::Auth()->is_User())
			  exit;
          App::Front()->updateProfile();
      break;

      /* == Buy Membership == */
      case "membership":
	      if(!App::Auth()->is_User())
			  exit;
          App::Front()->buyMembership();
      break;

      /* == Select Membership Gateway == */
      case "mGateway":
	      if(!App::Auth()->is_User())
			  exit;
          App::Front()->selectGateway();
      break;
	  
          /* == Contact == */
      case "contact":
          App::Front()->processContact();
          break;

          /* == Wishlist Compare == */
      case "wcomp":
          if (Filter::$id and isset($_POST['type'])):
		      if($_POST['type'] == "wishlist"):
			     if (App::Auth()->is_User()) :
					 Db::run()->insert(Content::wTable, array("product_id" => Filter::$id, "user_id" => App::Auth()->uid));
			     else:
					 App::Session()->setKey("wishlist", Filter::$id, Filter::$id);
				 endif;
			  else:
			     App::Session()->setKey("compare", Filter::$id, Filter::$id);
			  endif;
              $json['type'] = 'success';
          else:
              $json['type'] = 'error';
          endif;
              print json_encode($json);
          break;
		  
          /* == Compare Items == */
      case "compare":
          $tpl = App::View(THEMEBASE . '/snippets/'); 
		  $tpl->data = '';
		  if(App::Session()->get('compare')) :
			  $ids = Utility::implodeFields(App::Session()->get('compare'));
			  $tpl->data = App::Product()->Compare($ids);
		  endif;
		  $tpl->core = App::Core();
          $tpl->template = 'viewCompare.tpl.php'; 
          echo $tpl->render(); 
          break;
		  
      /* == Vote Up/Down == */
      case "vote":
          if(Filter::$id) :
		      $type = Validator::sanitize($_POST['type'], "alpha");
			  $vote = ($type == "down") ? 'vote_down = vote_down - 1' : 'vote_up = vote_up + 1';

			  Db::run()->pdoQuery("
				  UPDATE `" . Comments::mTable . "` 
				  SET $vote
				  WHERE id = ?
			  ", array(Filter::$id));
			  $json['type'] = $type;
			  $json['status'] = 'success';
			  print json_encode($json);
		  endif;
      break;

      /* == Select Membership Gateway == */
      case "download":
          $tpl = App::View(THEMEBASE . '/snippets/'); 
		  $tpl->data = '';
		  if(isset($_GET['token'])) :
			  $id = Utility::decode($_GET['token']);
			  $tpl->row = Db::run()->select(Product::mTable, array("id", "price", "title", "slug", "files", "body", "thumb"), array("id" => $id ? $id : 0, "active" => 1))->result();
			  $tpl->data = Product::relatedFiles($tpl->row->files);
		  endif;
          $tpl->template = 'viewDownloads.tpl.php'; 
          echo $tpl->render(); 
      break;
	  
      /* == Add to cart == */
      case "add":
          Product::addToCart(Filter::$id);
      break;
	  
      /* == Remove from cart == */
      case "remove":
          if (Filter::$id) :
              Db::run()->delete(Product::cxTable, array("product_id" => Filter::$id, "user_id" => App::Auth()->sesid));
			  $sql = "UPDATE `" . Product::cxTable . "` SET `tax` = 0, `totaltax` = 0, `coupon` = 0, `totalprice` = `originalprice` WHERE `user_id` = ?";;
			  Db::run()->pdoQuery($sql, array(App::Auth()->sesid));
			  
			  $tpl = App::View(THEMEBASE . '/snippets/');
			  $tpl->template = 'cart.tpl.php';
			  $tpl->data = Product::getCartContent();

			  $json['html'] = $tpl->render();
			  $json['counter'] = Product::cartCounter();  
              $json['status'] = 'success';
          else:
              $json['status'] = 'error';
          endif;
          print json_encode($json);
      break;

      /* == Remove from big cart == */
      case "removeBig":
          if (Filter::$id) :
              Db::run()->delete(Product::cxTable, array("product_id" => Filter::$id, "user_id" => App::Auth()->sesid));
			  $sql = "UPDATE `" . Product::cxTable . "` SET `tax` = 0, `totaltax` = 0, `coupon` = 0, `totalprice` = `originalprice` WHERE `user_id` = ?";;
			  Db::run()->pdoQuery($sql, array(App::Auth()->sesid));
					  
			  if($totals = Product::getCartTotal()):
				  $json['coupon'] = "<i class=\"icon minus positive alt\"></i> " . Utility::formatNumber($totals->discount, 2);
				  $json['tax'] = "<i class=\"icon plus negative alt\"></i>" . Utility::formatNumber($totals->tax);
				  $json['subtotal'] = Utility::formatNumber($totals->subtotal);
				  $json['total'] = Utility::formatMoney($totals->grand);
				  $json['counter'] = 1;
			  else:
				  $json['coupon'] = "<i class=\"icon minus positive alt\"></i> " . 0.00;
				  $json['tax'] = "<i class=\"icon plus negative alt\"></i>" . 0.00;
				  $json['subtotal'] = 0;
				  $json['total'] = 0;
				  $json['counter'] = 0;
			  endif;
			  $json['count'] = Product::cartCounter();
              $json['status'] = 'success';
          else:
              $json['status'] = 'error';
          endif;
          print json_encode($json);
      break;

      /* == Small Cart == */
      case "smallCart":
		  $tpl = App::View(THEMEBASE . '/snippets/');
		  $tpl->template = 'cart.tpl.php';
		  $tpl->url = (isset($_GET['url'])) ? $_GET['url'] : "index";
		  $tpl->data = Product::getCartContent();
		  
		  $json['html'] = $tpl->render();
		  $json['status'] = 'success';
		  print json_encode($json);
      break;
	  
      /* == Comment Reply == */
      case "comment":
	  case "reply":
          App::Comments()->processComment();
      break;

      /* == Apply Coupon == */
      case "coupon":
          App::Content()->applyCoupon();
      break;
	  
      /* == Delete == */
	  case "deleteComment":
		  if(App::Auth()->is_Admin()):
			  Db::run()->delete(Comments::mTable, array("id" => Filter::$id));
			  Db::run()->delete(Comments::mTable, array("parent_id" => Filter::$id));
		  endif;
      break;

      /* == Load Gateway == */
      case "gateway":
          if(Filter::$id) :
		      if($gateway = Db::run()->first(Core::gTable, null, array("id" => Filter::$id, "active" => 1))):
				  $tpl = App::View(BASEPATH . 'gateways/' . $gateway->dir . '/shop/');
				  $tpl->gateway = $gateway;
				  $tpl->core = App::Core();
				  $tpl->cart = Product::getCartTotal();
				  //$tpl->tax = Membership::calculateTax();
				  $tpl->template = 'form.tpl.php';
				  $json['message'] = $tpl->render();
		      else:
				  $json['message'] = Message::msgSingleError(Lang::$word->SYSERROR, false);
		      endif;
		  else:
			  $json['message'] = Message::msgSingleError(Lang::$word->SYSERROR, false);
		  endif;
		  print json_encode($json);
      break;

      /* == Ajax search == */
      case "search":
	      $string = Validator::sanitize($_GET['value'], 'string', 20);
		  $sql = "
			SELECT 
			  id,
			  title,
			  slug,
			  thumb,
			  price,
			  sprice,
			  is_sale,
			  body
			FROM
			  `" . Product::mTable . "`
			WHERE title LIKE '%" . $string . "%'
			OR body LIKE '%" . $string . "%'
			ORDER BY title
			LIMIT 10;";

		  $html = '';
		  if ($result = Db::run()->pdoQuery($sql)->results()):
			  $html .= '<div class="wojo relaxed divided fluid list">';
			  
			  foreach ($result as $row):
				  $link = Url::url("/product", $row->slug);
				  $img = '<img src="' . Product::hasThumb($row->thumb, $row->id) . '" alt="' . $row->title . '" class="wojo basic normal image">';
				  $html .= '<a class="item align middle" href="' . $link . '">';
				  $html .= '<div class="content auto padding right">';
				  $html .= $img;
				  $html .= '</div>';
				  $html .= '<div class="content">';
				  $html .= '<p class="wojo bold dark text">' . $row->title . '</p>';
				  $html .= '<p class="wojo small text">' . Validator::sanitize($row->body, "string", 80) . '</p>';
				  $html .= '<p>' . Utility::renderPrice($row->is_sale, $row->price, $row->sprice, "negative") . '</p>';
				  $html .= '</div>';
				  $html .= '</a>';
			  endforeach;
			  $html .= '</div>';
			  $json['html'] = $html;
			  $json['status'] = 'success';
		  else:
			  $json['status'] = 'error';
			  $json['html'] = '<p class="wojo negative icon text full padding"><i class="icon info sign"></i>' . Lang::$word->FRONT_NO_RESULTS . '</p>';
		  endif;
		  print json_encode($json);
      break;
	  
	  /* == Membership Invoice == */
	  case "mInvoice":
		  if(!App::Auth()->is_User())
			  exit;

		  if(empty($_GET['id'])) {
		      Url::redirect(Url::currentUrl() . "?msg=" . urlencode(Lang::$word->FRONT_ERROR01));
			  exit;
		  }
			  
		  if($row = Users::membershipInvoice(Filter::$id)):
			  $tpl = App::View(THEMEBASE . '/snippets/');
			  $tpl->row = $row;
			  $tpl->user = Auth::$userdata;
			  $tpl->core = App::Core();
			  $tpl->template = 'mInvoice.tpl.php'; 
			  $title = Validator::sanitize($row->title, "alpha");
			  
			  require_once (BASEPATH . 'lib/mPdf/vendor/autoload.php');
			  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8']);
			  $mpdf->SetTitle($title);
			  $mpdf->WriteHTML($tpl->render());
			  $mpdf->Output($title . ".pdf", "D");
			  exit;
		  else:
		      Url::redirect(Url::currentUrl() . "?msg=" . urlencode(Lang::$word->FRONT_ERROR01));
			  exit;
		  endif;
	  break;
	  
	  /* == Product Invoice == */
	  case "pInvoice":
		  if(!App::Auth()->is_User())
			  exit;

		  if(empty($_GET['tid'])) {
		      Url::redirect(Url::currentUrl() . "?msg=" . urlencode(Lang::$word->FRONT_ERROR01));
			  exit;
		  }
			  
		  if($row = Users::productInvoice(Validator::sanitize($_GET['tid'], "db"))):
			  $tpl = App::View(THEMEBASE . '/snippets/');
			  $tpl->row = $row;
			  $tpl->user = Auth::$userdata;
			  $tpl->items = Utility::jSonToArray($row->items);
			  $tpl->core = App::Core();
			  $tpl->template = 'pInvoice.tpl.php'; 
			  $title = Validator::sanitize($row->created, "alphanumeric");
			  
			  require_once (BASEPATH . 'lib/mPdf/vendor/autoload.php');
			  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8']);
			  $mpdf->SetTitle($title);
			  $mpdf->WriteHTML($tpl->render());
			  $mpdf->Output($title . ".pdf", "D");
			  exit;
		  else:
		      Url::redirect(Url::currentUrl() . "?msg=" . urlencode(Lang::$word->FRONT_ERROR01));
			  exit;
		  endif;
	  break;

  endswitch;

  /* == Instant Actions == */
  switch ($iAction) :
	  /* == Remove Compare == */
	  case "removeCompare":
		  App::Session()->removeKey('compare', Filter::$id);
		  $json['type'] = "success";
		  print json_encode($json);
	  break;
	  
	  /* == Remove Wishlist == */
	  case "removeWishlist":
		  App::Session()->removeKey('wishlist', Filter::$id);
		  if (App::Auth()->is_User()):
			 Db::run()->delete(Content::wTable, array("product_id" => Filter::$id, "user_id" => App::Auth()->uid));
		  endif;  
		  $json['type'] = "success";
		  print json_encode($json);
	  break;
  endswitch;
  
  /* == Clear Session Temp Queries == */
  if (isset($_GET['ClearSessionQueries'])):
      App::Session()->remove('debug-queries');
	  App::Session()->remove('debug-warnings');
	  App::Session()->remove('debug-errors');
	  print 1;
  endif;