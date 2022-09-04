<?php
  /**
   * Footer
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: footer.tpl.php, v1.00 2020-04-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
</div>
</main>
<!-- Home page -->
<?php ($this->segments[0] == "index") ? include_once("_home_page.tpl.php") : null;?>
<!-- Footer -->
<footer>
  <div class="wojo-grid">
    <div class="row align middle small gutters">
      <div class="columns auto phone-100">
        <a href="<?php echo SITEURL;?>/" class="logo"><?php echo ($this->core->logo) ? '<img src="' . SITEURL . '/uploads/' . $this->core->logo . '" alt="' . $this->core->company . '">' : $this->core->company;?></a>
      </div>
      <div class="columns phone-100 right aligned">
        <?php if($this->menus):?>
        <ul class="wojo horizontal fitted divided list">
          <?php foreach ($this->menus as $menu):?>
          <li class="item"><a class="grey" <?php ($menu->content_type == 'web') ? 'target="' . $menu->target . '"': null;?> href="<?php echo ($menu->content_type == 'web') ? Url::out_url($menu->link) : ($menu->page_type == "home" ? SITEURL : Url::url('/content', $menu->slug));?>"><strong><?php echo $menu->name;?></strong></a>
          </li>
          <?php endforeach;?>
        </ul>
        <?php endif;?>
      </div>
    </div>
    <div class="divider"></div>
    <div class="row align middle small gutters">
      <div class="columns phone-100">
        <p class="wojo small text">זכויות יוצרים &copy;<?php echo date('Y') . ' '. $this->core->company;?>| מופעל על ידי DDP v.<?php echo $this->core->wojov;?></p>
      </div>
      <div class="columns auto phone-100">
        <a class="wojo icon small primary inverted button" href="//<?php echo $this->core->social->facebook;?>"><i class="icon facebook"></i></a>
        <a class="wojo icon small primary inverted button" href="//<?php echo $this->core->social->twitter;?>"><i class="icon twitter"></i></a>
      </div>
    </div>
  </div>
</footer>
<?php Debug::displayInfo();?>
<script type="text/javascript" src="<?php echo THEMEURL;?>/js/master.js"></script>
<?php if(Utility::in_array_any(["memberships", "cart"], $this->segments) and App::Auth()->is_User()):?>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<?php endif;?>
<script type="text/javascript"> 
// <![CDATA[  
<?php if($this->core->ploader):?>
$(window).on("load", function (e) {
	$("#preloader").fadeOut(200);
})
<?php endif;?>
$(document).ready(function() {
    $.Master({
        weekstart: <?php echo($this->core->weekstart);?>,
		ampm: "<?php echo ($this->core->time_format) == "hh:mm" ? false : true;?>",
		url: "<?php echo FRONTVIEW;?>",
		surl: "<?php echo SITEURL;?>",
		theme: "<?php echo THEMEURL;?>",
        lang: {
            button_text: "<?php echo Lang::$word->BROWSE;?>",
            empty_text: "<?php echo Lang::$word->NOFILE;?>",
            delBtn: "<?php echo Lang::$word->DELETE_REC;?>",
			trsBtn: "<?php echo Lang::$word->MTOTRASH;?>",
			restBtn: "<?php echo Lang::$word->RFCOMPLETE;?>",
			canBtn: "<?php echo Lang::$word->CANCEL;?>",
			popular: "<?php echo Lang::$word->FAQ_POPULAR;?>",
        }
    });
		
	<?php if($this->core->eucookie):?>
    $("body").acceptCookies({
        position: 'top',
        notice: '<?php echo Lang::$word->EU_NOTICE;?>',
        accept: '<?php echo Lang::$word->EU_ACCEPT;?>',
        decline: '<?php echo Lang::$word->EU_DECLINE;?>',
        decline_t: '<?php echo Lang::$word->EU_DECLINE_T;?>',
        whatc: '<?php echo Lang::$word->EU_W_COOKIES;?>'
    });
	<?php endif;?>
});
// ]]>
</script>
<?php if($this->core->analytics):?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $this->core->analytics;?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '<?php echo $this->core->analytics;?>');
</script>
<?php endif;?>
</body></html>