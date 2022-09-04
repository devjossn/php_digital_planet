<?php
  /**
   * F.A.Q. Page
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _faq.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h1><?php echo $this->row->title;?></h1>
<?php echo $this->row->body;?>
<?php if($this->questions):?>
<?php foreach($this->questions as $row):?>
<article class="wojo segment">
  <h4 class="basic"><?php echo Url::out_url($row->question);?></h4>
  <div class="content"><?php echo $row->answer;?></div>
</article>
<?php endforeach;?>
<?php endif;?>