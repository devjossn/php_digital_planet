<?php
  /**
   * Products History
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _products_history.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2><?php echo Lang::$word->META_M_HISTORY;?>
  <small>// <?php echo $this->row->title;?></small></h2>
<div class="wojo segment">
  <div id="legend" class="wojo small horizontal list"></div>
  <div id="payment_chart" style="height:300px;"></div>
</div>
<?php if($this->plist):?>
<div class="wojo segment">
  <div class="row gutters align middle">
    <div class="columns">
      <h6 class="wojo secondary text"><?php echo Lang::$word->TRANSACTION;?></h6>
    </div>
    <div class="columns auto"><a href="<?php echo ADMINVIEW . '/helper.php?action=itemPayments&amp;id=' . $this->row->id;?>" class="wojo small secondary button"><?php echo Lang::$word->EXPORT;?></a>
    </div>
  </div>
  <table class="wojo responsive basic table">
    <thead>
      <tr>
        <th><?php echo Lang::$word->NAME;?></th>
        <th><?php echo Lang::$word->TRX_AMOUNT;?></th>
        <th><?php echo Lang::$word->TRX_TAX;?></th>
        <th><?php echo Lang::$word->TRX_COUPON;?></th>
        <th><?php echo Lang::$word->TRX_TOTAMT;?></th>
        <th><?php echo Lang::$word->CREATED;?></th>
      </tr>
    </thead>
    <?php $total = 0;?>
    <?php foreach ($this->plist as $prow):?>
    <?php $total += $prow->total;?>
    <tr>
      <td><a href="<?php echo Url::url("/admin/users/edit", $prow->user_id);?>"><?php echo $prow->name;?></a></td>
      <td><?php echo $prow->amount;?></td>
      <td><?php echo $prow->tax;?></td>
      <td><?php echo $prow->coupon;?></td>
      <td><?php echo $prow->total;?></td>
      <td><?php echo Date::doDate("short_date", $prow->created);?></td>
    </tr>
    <?php endforeach;?>
  </table>
  <div class="wojo secondary passive label"><?php echo Lang::$word->TRX_TOTAMT;?>
    <?php echo Utility::formatMoney($total);?></div>
</div>
<?php endif;?>
<div class="row half-gutters-mobile half-gutters-phone align-middle">
  <div class="columns shrink mobile-100 phone-100">
    <div class="wojo small thick text"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $this->pager->current_page . ' '. Lang::$word->OF . ' ' . $this->pager->num_pages;?></div>
  </div>
  <div class="columns mobile-100 phone-100 content-right mobile-content-left"><?php echo $this->pager->display_pages('small');?></div>
</div>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/morris.min.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/raphael.min.js"></script>