<?php
  /**
   * Index
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.php, v1.00 2020-04-05 10:12:05 gewa Exp $
   */
  define("_WOJO", true);

  include ('init.php');
  $core = App::Core();
  $router = new Router();
  $tpl = App::View(BASEPATH . 'view/');

  //admin routes
  $router->mount('/admin', function() use ($router, $tpl) {
      //admin login
	  $router->match('GET|POST', 'login', function () use ($tpl)
	  {
		  if (App::Auth()->is_Admin()) {
			  Url::redirect(SITEURL . '/admin/'); 
			  exit; 
		  }
		  
		  $tpl->template = 'admin/login.tpl.php'; 
		  $tpl->title = Lang::$word->LOGIN; 
	  });
	  
	  //admin index
	  $router->get('/', 'Admin@Index');

	  //admin menus
	  $router->mount('/menus', function() use ($router, $tpl) {
		  $router->get('/', 'Content@Menus');
		  $router->get('/edit/(\d+)', 'Content@MenuEdit');
	  });
	  
	  //admin categories
	  $router->mount('/categories', function() use ($router, $tpl) {
		  $router->get('/', 'Content@Categories');
		  $router->get('/edit/(\d+)', 'Content@CategoryEdit');
	  });

	  //admin pages
	  $router->mount('/pages', function() use ($router, $tpl) {
		  $router->get('/', 'Content@Pages');
		  $router->get('/edit/(\d+)', 'Content@PageEdit');
		  $router->get('/new', 'Content@PageSave');
	  });

	  //admin f.a.q.
	  $router->mount('/faq', function() use ($router, $tpl) {
		  $router->get('/', 'Content@Faq');
		  $router->get('/edit/(\d+)', 'Content@FaqEdit');
		  $router->get('/new', 'Content@FaqSave');
	  });
	  
	  //admin users
	  $router->mount('/users', function() use ($router, $tpl) {
		  $router->match('GET|POST', '/', 'Users@Index');
		  $router->match('GET|POST', '/grid', 'Users@Index');
		  $router->get('/history/(\d+)', 'Users@History');
		  $router->get('/edit/(\d+)', 'Users@Edit');
		  $router->get('/new', 'Users@Save');
	  });

	  //admin countries
	  $router->mount('/countries', function() use ($router, $tpl) {
		  $router->get('/', 'Content@Countries');
		  $router->get('/edit/(\d+)', 'Content@CountryEdit');
	  });

	  //admin coupons
	  $router->mount('/coupons', function() use ($router, $tpl) {
		  $router->get('/', 'Content@Coupons');
		  $router->get('/edit/(\d+)', 'Content@CouponEdit');
		  $router->get('/new', 'Content@CouponSave');
	  });

	  //admin custom fields
	  $router->mount('/fields', function() use ($router, $tpl) {
		  $router->get('/', 'Content@Fields');
		  $router->get('/edit/(\d+)', 'Content@FieldEdit');
		  $router->get('/new', 'Content@FieldSave');
	  });
	  
	  //admin account
	  $router->mount('/myaccount', function() use ($router, $tpl) {
		  $router->get('/', 'Admin@Account');
		  $router->get('/password', 'Admin@Password');
	  });

	  //admin gateways
	  $router->mount('/gateways', function() use ($router, $tpl) {
		  $router->get('/', 'Admin@Gateways');
		  $router->get('/edit/(\d+)', 'Admin@GatewayEdit');
	  });

	  //admin email templates
	  $router->mount('/templates', function() use ($router, $tpl) {
		  $router->get('/', 'Content@Templates');
		  $router->get('/edit/(\d+)', 'Content@TemplateEdit');
	  });

	  //admin news
	  $router->mount('/news', function() use ($router, $tpl) {
		  $router->get('/', 'Content@News');
		  $router->get('/edit/(\d+)', 'Content@NewsEdit');
		  $router->get('/new', 'Content@NewsSave');
	  });

	  //admin permissions
	  $router->mount('/permissions', function() use ($router, $tpl) {
		  $router->get('/', 'Admin@Permissions');
		  $router->get('/privileges/(\d+)', 'Admin@Privileges');
	  });

	  //admin products
	  $router->mount('/products', function() use ($router, $tpl) {
		  $router->match('GET|POST', '/', 'Product@Index');
		  $router->match('GET|POST', '/grid', 'Product@Index');
		  $router->get('/edit/(\d+)', 'Product@Edit');
		  $router->get('/new', 'Product@Save');
		  $router->get('/history/(\d+)', 'Product@History');
	  });

	  //admin memberships
	  $router->mount('/memberships', function() use ($router, $tpl) {
		  $router->match('GET', '/', 'Content@MembershipIndex');
		  $router->get('/history/(\d+)', 'Content@MembershipHistory');
		  $router->get('/edit/(\d+)', 'Content@MembershipEdit');
		  $router->get('/new', 'Content@MembershipSave');
	  });

	  //admin transactions
	  $router->mount('/transactions', function() use ($router, $tpl) {
		  $router->match('GET|POST', '/', 'Admin@Transactions');
		  $router->get('/new', 'Admin@TransactionNew');
	  });

	  //admin maintenance
	  $router->get('/maintenance', 'Admin@Maintenance');
	  
	  //admin backup
	  $router->get('/backup', 'Admin@Backup');

	  //admin newsletter
	  $router->get('/mailer', 'Admin@Mailer');

	  //admin system
	  $router->get('/system', 'Admin@System');

	  //admin trash
	  $router->get('/trash', 'Admin@Trash');
	  
	  //admin language manager
	  $router->get('/language', 'Lang@Index');

	  //admin comments
	  $router->mount('/comments', function() use ($router, $tpl) {
		  $router->match('GET', '/', 'Comments@Index');
		  $router->get('/edit', 'Comments@Settings');
	  });
	  
	  //admin files
	  $router->match('GET|POST', '/files', 'Admin@Files');

	  //admin configuration
	  $router->get('/configuration', 'Core@Index');

	  //admin blog
	  $router->mount('/blog', function() use ($router, $tpl) {
		  $router->match('GET|POST', '/', '/view/admin/blog/@Blog@AdminIndex');
		  $router->get('/edit/(\d+)', '/view/admin/blog/@Blog@Edit');
		  $router->get('/new', '/view/admin/blog/@Blog@Save');
		  $router->get('/categories', '/view/admin/blog/@Blog@CategorySave');
		  $router->get('/category/(\d+)', '/view/admin/blog/@Blog@CategoryEdit');
		  $router->get('/settings', '/view/admin/blog/@Blog@Settings');
	  });
	  
	  //logout
	  $router->before('GET', '/logout', function()
	  {   
	      if(App::Auth()->logged_in) {
		     App::Auth()->logout();
	      }
		  Url::redirect(SITEURL . '/admin/');
	  });
  
  });

  /* front end routes */
  //home
  $router->match('GET|POST', '/', 'Front@Index');
  $router->match('GET|POST', '/login', 'Front@Login');
  $router->match('GET|POST', '/register', 'Front@Register');
  $router->match('GET|POST', '/password/([a-z0-9_-]+)', 'Front@Password');

  //front pages
  $router->match('GET|POST', '/content/([a-z0-9_-]+)', 'Front@Page');

  //wishlist
  $router->match('GET|POST', '/wishlist', 'Front@Wishlist');

  //compare
  $router->match('GET|POST', '/compare', 'Front@Compare');
  
  //category
  $router->match('GET|POST', '/category/([a-z0-9_-]+)', 'Content@Category');

  //product
  $router->match('GET|POST', '/product/([a-z0-9_-]+)', 'Product@Render');

  //cart
  $router->match('GET|POST', '/cart', 'Product@Cart');

  //search
  $router->match('GET|POST', '/search', 'Front@Search');

  //news
  $router->match('GET|POST', '/news', 'Front@News');
  
  //acount activation
  $router->get('/activation', 'Front@Activation');

  //paymnet activation
  $router->match('GET|POST', '/validate', 'Front@Validate');

  //front blog
  $router->mount('/blog', function() use ($router, $tpl) {
	  $router->match('GET|POST', '/', '/view/admin/blog/@Blog@FrontIndex');
	  $router->get('/category/([a-z0-9_-]+)', '/view/admin/blog/@Blog@Category');
	  $router->get('/([a-z0-9_-]+)', '/view/admin/blog/@Blog@Render');
  });
	  
  //dashboard
  $router->mount('/dashboard', function() use ($router, $tpl) {
	  $router->match('GET|POST', '/', 'Front@Dashboard');
	  $router->get('/memberships', 'Front@Memberships');
	  $router->get('/history', 'Front@History');
	  $router->get('/profile', 'Front@Profile');
	  $router->get('/view/([a-zA-Z0-9]+)', 'Front@View');
  });
	  
  //logout
  $router->get('/logout', function()
  {
	  App::Auth()->logout();
	  Url::redirect(SITEURL . '/');
  });
  
  //404
  $router->set404(function () use($core, $router)
  {
      $tpl = App::View(BASEPATH . 'view/'); 
	  $tpl->dir = $router->segments[0] == "admin" ? "admin/" : "front/themes/" . $core->theme . "/";
	  $tpl->segments = $router->segments;
	  $tpl->data = null;
	  $tpl->title = Lang::$word->META_ERROR; 
	  $tpl->keywords = null;
	  $tpl->description = null;
	  $tpl->core = App::Core();
	  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), Lang::$word->META_ERROR2];
	  if($router->segments[0] != "admin") {
		  $tpl->menus = Content::getMenus();
		  $tpl->categories = App::Content()->renderCategories(App::Content()->categoryTree());
		  $tpl->counter = Product::cartCounter();
	  }
	  $tpl->template = $router->segments[0] == "admin" ? 'admin/404.tpl.php' : "front/themes/" . $core->theme . "/404.tpl.php"; 
	  echo $tpl->render(); 
  });
	  
  // Maintenance mode
  if ($core->offline == 1 && !App::Auth()->is_Admin() && !preg_match("#admin/#", $_SERVER['REQUEST_URI'])) {
      url::redirect(SITEURL . "/maintenance.php");
      exit;
  }
  
  // Run router
  $router->run(function () use($tpl, $router)
  {
	  $tpl->segments = $router->segments;
	  $tpl->core = App::Core();
	  if($router->segments[0] != "admin") {
		  $tpl->menus = Content::getMenus();
		  $tpl->categories = App::Content()->renderCategories(App::Content()->categoryTree());
		  $tpl->counter = Product::cartCounter();
	  }
	  Content::$segments = $router->segments;
      echo $tpl->render(); 
  });