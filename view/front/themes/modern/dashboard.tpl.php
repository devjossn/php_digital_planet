<?php
  /**
   * Dashboard
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: dashboard.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php include_once(THEMEBASE . '/snippets/dashNav.tpl.php');?>
<h1><?php echo Lang::$word->META_M_MYDOWNS;?></h1>
<?php if($this->data):?>
<table class="wojo basic table">
  <thead>
    <tr>
      <th>&nbsp;</th>
      <th><?php echo Lang::$word->NAME;?></th>
      <th><?php echo Lang::$word->DATE;?></th>
      <th class="right aligned">&nbsp;</th>
    </tr>
  </thead>
  <?php foreach ($this->data as $row):?>
  <tr>
    <td class="auto"><a href="<?php echo Url::url('/product', $row->slug);?>"><img src="<?php echo Product::hasThumb($row->thumb, $row->product_id);?>" alt="" class="wojo small basic image"></a></td>
    <td><a href="<?php echo Url::url('/product', $row->slug);?>"><?php echo $row->title;?></a></td>
    <td><?php echo Date::doDate("short_date", $row->created);?></td>
    <td class="auto"><a href="<?php echo Url::url('/dashboard/view', Utility::encode($row->id));?>" class="wojo small primary icon button"><i class="icon download"></i></a>
      <a data-tooltip="<?php echo Lang::$word->INVOICE;?>" href="<?php echo FRONTVIEW;?>/controller.php?action=pInvoice&amp;tid=<?php echo $row->txn_id?>" class="wojo small secondary icon button"><i class="icon files"></i></a></td>
  </tr>
  <?php endforeach;?>
  <?php unset($row);?>
</table>
<?php endif;?>