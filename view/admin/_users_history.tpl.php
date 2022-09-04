<?php
  /**
   * User Manager
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _users_history.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2><?php echo Lang::$word->META_M_HISTORY;?>
  <small>// <?php echo $this->data->fname;?>
  <?php echo $this->data->lname;?></small></h2>
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
    <div class="columns auto"><a href="<?php echo ADMINVIEW . '/helper.php?exportUserProductPayments&amp;id=' . $this->data->id;?>" class="wojo small secondary button"><?php echo Lang::$word->EXPORT;?></a>
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
        <th class="collapsing"><?php echo Lang::$word->STATUS;?></th>
      </tr>
    </thead>
    <?php $total = 0;?>
    <?php foreach ($this->plist as $prow):?>
    <?php $total += $prow->total;?>
    <tr>
      <td><a href="<?php echo Url::url("/admin/products/edit", $prow->product_id);?>"><?php echo $prow->title;?></a></td>
      <td><?php echo $prow->amount;?></td>
      <td><?php echo $prow->tax;?></td>
      <td><?php echo $prow->coupon;?></td>
      <td><?php echo $prow->total;?></td>
      <td><?php echo Date::doDate("short_date", $prow->created);?></td>
      <td class="center aligned"><?php echo Utility::isPublished($prow->status);?></td>
    </tr>
    <?php endforeach;?>
  </table>
  <div class="wojo secondary passive label"><?php echo Lang::$word->TRX_TOTAMT;?>
    <?php echo Utility::formatMoney($total);?></div>
</div>
<?php endif;?>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/morris.min.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/raphael.min.js"></script>
<script type="text/javascript"> 
// <![CDATA[
$(document).ready(function() {	
    function getStats(range) {
        $("#payment_chart").parent().addClass('loading');
        $.ajax({
            type: 'GET',
            url: "<?php echo ADMINVIEW . '/helper.php?action=getUserProductPaymentsChart&id=' . $this->data->id;?>&timerange=" + range,
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
            $("#payment_chart").parent().removeClass('loading');
        });
    }
    getStats('all');
});
// ]]>
</script>