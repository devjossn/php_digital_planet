<?php
  /**
   * Account History
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: history.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php include_once(THEMEBASE . '/snippets/dashNav.tpl.php');?>
<h1><?php echo Lang::$word->META_M_MHISTORY;?></h1>
<?php if($this->data):?>
<table class="wojo basic table">
  <thead>
    <tr>
      <th><?php echo Lang::$word->NAME;?></th>
      <th><?php echo Lang::$word->MEM_ACT;?></th>
      <th><?php echo Lang::$word->MEM_EXP;?></th>
      <th class="center aligned"><?php echo Lang::$word->MEM_REC1;?></th>
      <th class="auto"></th>
    </tr>
  </thead>
  <?php foreach ($this->data as $row):?>
  <tr id="item_<?php echo $row->transaction_id?>">
    <td><strong><?php echo $row->title;?></strong></td>
    <td><?php echo Date::doDate("long_date", $row->activated);?></td>
    <td><?php echo Date::doDate("long_date", $row->expire);?></td>
    <td class="center aligned"><?php echo Utility::isPublished($row->recurring);?></td>
    <td class="center aligned"><a data-tooltip="<?php echo Lang::$word->INVOICE;?>" href="<?php echo FRONTVIEW;?>/controller.php?action=mInvoice&amp;id=<?php echo $row->transaction_id;?>" class="wojo small primary inverted icon button"><i class="icon files"></i></a></td>
  </tr>
  <?php endforeach;?>
  <tfoot>
    <tr>
      <td colspan="5"><span class="wojo basic primary inverted passive button">
        <?php echo Lang::$word->TRX_TOTAMT;?>
        <?php echo Utility::formatMoney($this->totals);?>
        </span></td>
    </tr>
  </tfoot>
</table>
<?php endif;?>