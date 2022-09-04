<?php
  /**
   * Home Page
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _home_page.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>

<?php if($this->home):?>
<h1 class="center aligned"><?php echo $this->home->title;?></h1>
<?php echo Url::out_url($this->home->body);?>
<?php endif;?>