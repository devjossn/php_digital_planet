<?php
  /**
   * Transactions
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: transactions.tpl.php, v1.00 2020-02-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if (!Auth::checkAcl("owner")) : print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments)): case "new": ?>
<!-- Start new -->
<h2><?php echo Lang::$word->TRX_NEW;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo segment form">
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->USER;?>
          <i class="icon asterisk"></i></label>
      </div>
      <div class="field">
        <select name="user_id">
          <?php echo Utility::loopOptions($this->users, "id", "name");?>
        </select>
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->CF_SEC_P;?>
          <i class="icon asterisk"></i></label>
      </div>
      <div class="field">
        <select name="product_id">
          <?php echo Utility::loopOptions($this->products, "id", "title");?>
        </select>
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->GW_NAME;?>
          <i class="icon asterisk"></i></label>
      </div>
      <div class="field">
        <select name="pp">
          <?php echo Utility::loopOptions($this->gateways, "name", "displayname");?>
        </select>
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->QUANTITY;?>
          <i class="icon asterisk"></i></label>
      </div>
      <div class="field">
        <input name="qty" type="range" min="1" max="20" step="1" value="1" hidden data-suffix=" qty" data-type="labels" data-labels="1,5,10,15,20">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->USR_NOTIFY;?>
          <i class="icon asterisk"></i></label>
      </div>
      <div class="field">
        <div class="wojo checkbox toggle inline">
          <input name="notify" type="checkbox" value="1" id="notify_0">
          <label for="notify_0"><?php echo Lang::$word->YES;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->TRX_MEMO;?></label>
      </div>
      <div class="field">
        <textarea name="memo" placeholder="<?php echo Lang::$word->TRX_MEMO;?>"></textarea>
      </div>
    </div>
    <div class="center aligned">
      <a href="<?php echo Url::url("/admin/transactions");?>" class="wojo small simple button"><?php echo Lang::$word->CANCEL;?></a>
      <button type="button" data-action="processTransaction" name="dosubmit" class="wojo secondary button"><?php echo Lang::$word->TRX_CREATE;?></button>
    </div>
  </div>
</form>
<?php break;?>
<!-- Start default -->
<?php default: ?>
<div class="row gutters align middle">
  <div class="columns">
    <h2><?php echo Lang::$word->TRX_PAY;?></h2>
  </div>
  <div class="columns auto phone-100">
    <a href="<?php echo Url::url(Router::$path, "new/");?>" class="wojo small stacked secondary button"><i class="icon plus alt"></i><?php echo Lang::$word->TRX_NEW;?></a>
  </div>
</div>
<div class="wojo card" id="pData">
  <div class="header">
    <div class="row horizontal gutters align middle">
      <div class="columns">
        <a data-dropdown="#dropdown-transMenu" class="wojo icon button">
        <i class="icon chevron down"></i>
        </a>
        <div class="wojo small dropdown top-left" id="dropdown-transMenu">
          <a class="item" data-value="all"><?php echo Lang::$word->ALL;?></a>
          <a class="item" data-value="day"><?php echo Lang::$word->TODAY;?></a>
          <a class="item" data-value="week"><?php echo Lang::$word->THIS_WEEK;?></a>
          <a class="item" data-value="month"><?php echo Lang::$word->THIS_MONTH;?></a>
          <a class="item" data-value="year"><?php echo Lang::$word->THIS_YEAR;?></a>
        </div>
      </div>
      <div class="columns auto">
        <div id="legend" class="wojo small horizontal list">
        </div>
      </div>
    </div>
  </div>
  <div class="content" id="payment_chart" style="height:400px"></div>
</div>
<?php if($this->data):?>
<div class="wojo form segment">
  <form method="post" id="wojo_form" action="<?php echo Url::url(Router::$path);?>" name="wojo_form">
    <div class="row align center middle gutters">
      <div class="columns screen-30 tablet-40 mobile-100 phone-100">
        <div class="wojo icon input">
          <input name="fromdate" type="text" placeholder="<?php echo Lang::$word->FROM;?>" readonly id="fromdate">
          <i class="icon calendar alt"></i>
        </div>
      </div>
      <div class="columns screen-30 tablet-40 mobile-100 phone-100">
        <div class="wojo action input">
          <input name="enddate" type="text" placeholder="<?php echo Lang::$word->TO;?>" readonly id="enddate">
          <button id="doDates" class="wojo icon primary inverted button"><i class="icon find"></i></button>
        </div>
      </div>
      <div class="columns auto phone-hide">
        <a href="<?php echo Url::url(Router::$path);?>" class="wojo icon button"><i class="icon refresh"></i></a>
      </div>
      <div class="columns auto phone-hide">
        <a href="<?php echo ADMINVIEW;?>/helper.php?action=exportAllTransactions" class="wojo primary icon button"><i class="icon wysiwyg table"></i></a>
      </div>
    </div>
  </form>
  <table class="wojo responsive basic table">
    <thead>
      <tr>
        <th class="disabled center aligned"><i class="icon disabled id"></i></th>
        <th data-sort="string"><?php echo Lang::$word->ITEM;?></th>
        <th data-sort="string"><?php echo Lang::$word->USER;?></th>
        <th data-sort="int"><?php echo Lang::$word->TRX_PP;?></th>
        <th data-sort="int"><?php echo Lang::$word->TRX_TOTAMT;?></th>
        <th data-sort="int"><?php echo Lang::$word->CREATED;?></th>
      </tr>
    </thead>
    <?php $total = 0;?>
    <?php foreach ($this->data as $row):?>
    <?php $total += $row->total;?>
    <tr id="item_<?php echo $row->id;?>">
      <td class="auto"><span class="wojo small dark inverted label"><?php echo $row->id;?></span></td>
      <td><a class="inverted" href="<?php echo Url::url("/admin/products/edit", $row->product_id);?>"><?php echo $row->title;?></a></td>
      <td><a class="inverted" href="<?php echo Url::url("/admin/users/edit", $row->user_id);?>"><?php echo $row->name;?></a></td>
      <td><?php echo $row->pp;?></td>
      <td><?php echo $row->total;?></td>
      <td data-sort-value="<?php echo strtotime($row->created);?>"><?php echo Date::doDate("short_date", $row->created);?></td>
    </tr>
    <?php endforeach;?>
  </table>
  <div class="wojo small passive button"><?php echo Lang::$word->TRX_TOTAMT;?>
    <?php echo Utility::formatMoney($total);?></div>
</div>
<div class="row gutters align middle">
  <div class="columns auto mobile-100 phone-100">
    <div class="wojo small semi text"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $this->pager->current_page . ' '. Lang::$word->OF . ' ' . $this->pager->num_pages;?></div>
  </div>
  <div class="columns right aligned mobile-100 phone-100"><?php echo $this->pager->display_pages();?></div>
</div>
<?php endif;?>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/morris.min.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/raphael.min.js"></script>
<script type="text/javascript"> 
// <![CDATA[
$(document).ready(function() {	
    function getStats(range) {
        $("#pData").addClass('loading');
		$("#payment_chart").empty();
        $.ajax({
            type: 'GET',
            url: "<?php echo ADMINVIEW;?>/helper.php?action=salesChart&timerange=" + range,
            dataType: 'json'
        }).done(function(json) {
			var legend = '';
            json.legend.map(function(val) {
               legend += val;
            });
			$("#legend").html(legend);
            Morris.Area({
                element: 'payment_chart',
                data: json.data,
                xkey: 'm',
                ykeys: json.label,
                labels: json.label,
                parseTime: false,
                lineWidth: 1,
                pointSize: 5,
                lineColors: json.color,
				gridTextColor: "rgba(0,0,0,0.6)",
				gridTextSize: 14,
                fillOpacity: '.1',
                hideHover: 'auto',
				preUnits: json.preUnits,
				behaveLikeLine:true,
				hoverCallback: function(index, json, content) {
					var text = $(content)[1].textContent;
					return content.replace(text, text.replace(json.preUnits, ""));
				},
                smooth: true,
                resize: true,
            });
            $("#pData").removeClass('loading');
        });
    }
    getStats('all');
	
    $("#timeRange").on('click', '.item', function() {
		$("#payment_chart").html('');
        getStats($(this).data('value'));
    });
});
// ]]>
</script>
<?php break;?>
<?php endswitch;?>
