<?php
  /**
   * Header
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: header.tpl.php, v1.00 2020-04-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
 ?>
<!doctype html>
<html lang="<?php echo Core::$language;?>">
<head>
<meta charset="utf-8">
<title><?php echo $this->title;?></title>
<meta name="keywords" content="<?php echo $this->keywords;?>">
<meta name="description" content="<?php echo $this->description;?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="dcterms.rights" content="<?php echo $this->core->company;?> &copy; All Rights Reserved">
<meta name="robots" content="index">
<meta name="robots" content="follow">
<meta name="revisit-after" content="1 day">
<meta name="generator" content="Powered by DDP v<?php echo $this->core->wojov;?>">
<!--<link rel="shortcut icon" href="<?php echo SITEURL;?>/assets/favicon.ico" type="image/x-icon">-->
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/jquery.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/global.js"></script>

<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

<script type="application/ld+json" class="reviews-schema" data-ref="0a8e8e14ae8fe7d06c77dfdac86bfffa8ba260c9" > {
    "@context": "http://schema.org",  
    "@type": "Product",  
    "name": "Digital Planet",  
    "aggregateRating":  
    {  
        "@type": "AggregateRating",  
        "ratingValue": "5",  
        "reviewCount": "764"
    }
} </script>

<link href="<?php echo THEMEURL . '/cache/' . Cache::cssCache(array('base.css','transition.css','dropdown.css','image.css','label.css','message.css','list.css','table.css','tooltip.css','form.css','input.css','icon.css','flags.css','button.css','card.css','comments.css','modal.css','progress.css','utility.css','style.css'), THEMEBASE);?>" rel="stylesheet" type="text/css">
<?php echo Core::Colors();?>
</head>
<body  dir="rtl">
<?php if($this->core->ploader):?>
<!-- Page Loader -->
<div id="preloader">
  <div class="inner">
    <div class="dot white"></div>
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
  </div>
</div>
<?php endif;?>
<header id="header">
  <div class="wojo-grid">
    <div class="top-bar">
      <div class="row small gutters align middle">
        <div class="columns screen-25 mobile-100 phone-100 logoColumn">
          <a href="<?php echo SITEURL;?>/" class="logo"><?php echo ($this->core->logo) ? '<img src="' . SITEURL . '/uploads/' . $this->core->logo . '" alt="' . $this->core->company . '">' : $this->core->company;?></a>
        </div>
        <div class="columns screen-50 mobile-100 phone-100 wojo form">
          <div class="wojo action rounded input">
            <input placeholder="<?php echo Lang::$word->SEARCH;?>" type="text" id="masterSearch">
            <button id="doSearch" type="submit" class="wojo simple button icon"><i class="icon find"></i></button>
            <div id="searchResult"></div>
          </div>
        </div>
        <div class="columns screen-25 mobile-100 phone-100 btnsColumn">
          <div class="wojo white simple rounded buttons">
            <?php if(count(Lang::fetchLanguage()) > 1):?>
  
                <a class="wojo icon button" data-dropdown="#dropdown-lMenu"><?php echo strtoupper(Core::$language);?></a>
            <?php endif;?>
            <a href="<?php echo Url::url('/wishlist');?>" class="wojo icon button"><i class="icon heart"></i></a>
            <a href="<?php echo Url::url("/compare");?>" class="wojo icon button"><i class="icon collection"></i></a>
            <?php if(App::Auth()->is_User()):?>
            <a href="<?php echo Url::url("/dashboard");?>" class="wojo right button"><?php echo Lang::$word->WELCOME;?><img src="<?php echo UPLOADURL;?>/avatars/<?php echo (App::Auth()->avatar) ? App::Auth()->avatar : "blank.svg";?>" alt="" class="avatar"></a>
            </a>
            <?php else:?>
            <a href="<?php echo Url::url("/login");?>" class="wojo right button"><?php echo Lang::$word->LOGIN;?><i class="icon user"></i></a>
            <?php endif;?>
          </div>
          <?php if(count(Lang::fetchLanguage()) > 1):?>
          <div class="wojo small dropdown top-left" id="dropdown-lMenu">
            <?php foreach(Lang::fetchLanguage() as $lang):?>
            <a class="item" data-value="<?php echo substr($lang, 0, 2);?>"><span class="flag icon <?php echo substr($lang, 0, 2);?>"></span>
                <?php echo strtoupper(substr($lang, 0, 2));?>
            </a>
            <?php endforeach;?>
          </div>
          <?php endif;?>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar relative">
    <div class="wojo-grid">
      <div class="row horizontal gutters align middle">
        <div class="columns auto hide-all" id="mobileToggle">
          <a class="wojo transparent icon button menu-mobile"><i class="icon white reorder"></i></a>
        </div>
        <div class="columns">
          <?php echo $this->categories;?>
        </div>
        <div class="columns auto relative">
          <a class="wojo dark button cartButton"><i class="icon bag"></i><span id="cTotal"><?php echo $this->counter;?></span></a>
          <div id="cartList" data-duration="200" data-delay="20" class="wojo segment animate hide-all">
            <div class="wojo very relaxed divided fluid list"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<main>
<div class="wojo-grid">
<?php if($this->segments[0] != "index"):?>
<div id="crumbs">
  <div class="wojo small breadcrumb">
    <?php echo Url::crumbs($this->crumbs ? $this->crumbs : $this->segments, "//", Lang::$word->HOME);?>
  </div>
</div>
<?php endif;?>