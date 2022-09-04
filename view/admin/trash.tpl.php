<?php
  /**
   * Trash
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: trash.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if (!Auth::checkAcl("owner")) : print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<div class="row gutters align middle">
  <div class="columns mobile-100 phone-100">
    <h2><?php echo Lang::$word->META_M_TRASH;?></h2>
    <p class="wojo small text"><?php echo Lang::$word->TRS_INFO;?></p>
  </div>
  <?php if($this->data):?>
  <div class="columns auto mobile-100 phone-100">
    <a data-set='{"option":[{"delete": "trashAll","title": "<?php echo Validator::sanitize(Lang::$word->TRS_TEMPTY, "chars");?>"}],"action":"delete", "parent":"#self","redirect":"<?php echo Url::url("/admin/trash");?>"}' class="wojo small negative stacked button data"><?php echo Lang::$word->TRS_TEMPTY;?>
    </a>
  </div>
  <?php endif;?>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/trash_empty.png" alt="">
  <p class="wojo small thick caps text"><?php echo Lang::$word->TRS_EMPTY;?></p>
</div>
<?php else:?>
<?php foreach($this->data as $type => $rows):?>
<?php switch($type): ?>
<?php case "faq":?>
<!-- faq -->
<div class="wojo soft shadow card">
  <div class="header">
    <h4><?php echo Lang::$word->ADM_FAQ;?></h4>
  </div>
  <div class="content">
    <div class="wojo divided list">
      <?php foreach($rows as $row):?>
      <?php $dataset = Utility::jSonToArray($row->dataset);?>
      <div class="item" id="faq_<?php echo $dataset->id;?>">
        <div class="right floated content">
          <a data-set='{"option":[{"qAction": 1,"page":"restoreFaq", "id":<?php echo $row->id;?>}], "name":"<?php echo Validator::sanitize($dataset->question, "spchar");?>", "url":"/helper.php", "parent":"#page_<?php echo $dataset->id;?>", "complete":"remove"}' class="wojo positive text qAction"><?php echo Lang::$word->RESTORE;?></a>
          - <a data-set='{"option":[{"qAction": 1,"page":"deleteFaq", "id":<?php echo $row->id;?>}], "name":"<?php echo Validator::sanitize($dataset->question, "spchar");?>", "url":"/helper.php", "parent":"#faq_<?php echo $dataset->id;?>", "complete":"remove"}' class="wojo negative text qAction"><?php echo Lang::$word->TRS_DELGOOD;?></a>
        </div>
        <?php echo $dataset->question;?>
      </div>
      <?php endforeach;?>
      <?php unset($dataset);?>
    </div>
  </div>
</div>
<?php break;?>
<!-- page -->
<?php case "page":?>
<table class="wojo small segment table">
  <thead>
    <tr>
      <th colspan="2"> <h5 class="basic"><?php echo Lang::$word->ADM_PAGES;?></h5>
      </th>
    </tr>
  </thead>
  <?php foreach($rows as $row):?>
  <?php $dataset = Utility::jSonToArray($row->dataset);?>
  <tr id="user_<?php echo $row->id;?>">
    <td><?php echo $dataset->title;?></td>
    <td class="auto"><div class="wojo mini buttons">
        <a data-set='{"option":[{"restore": "restorePage","title": "<?php echo Validator::sanitize($dataset->title, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#user_<?php echo $row->id;?>"}' class="wojo positive simple button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deletePage","title": "<?php echo Validator::sanitize($dataset->title, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#user_<?php echo $row->id;?>"}' class="wojo negative simple button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a>
      </div></td>
  </tr>
  <?php endforeach;?>
  <?php unset($dataset);?>
</table>
<?php break;?>
<!-- user -->
<?php case "user":?>
<table class="wojo small segment table">
  <thead>
    <tr>
      <th colspan="2"> <h5 class="basic"><?php echo Lang::$word->ADM_USERS;?></h5>
      </th>
    </tr>
  </thead>
  <?php foreach($rows as $row):?>
  <?php $dataset = Utility::jSonToArray($row->dataset);?>
  <tr id="user_<?php echo $row->id;?>">
    <td><?php echo $dataset->fname . ' ' . $dataset->lname;?></td>
    <td class="auto"><div class="wojo mini buttons">
        <a data-set='{"option":[{"restore": "restoreUser","title": "<?php echo Validator::sanitize($dataset->fname . ' ' . $dataset->lname, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#user_<?php echo $row->id;?>"}' class="wojo positive simple button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deleteUser","title": "<?php echo Validator::sanitize($dataset->fname . ' ' . $dataset->lname, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#user_<?php echo $row->id;?>"}' class="wojo negative simple button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a>
      </div></td>
  </tr>
  <?php endforeach;?>
  <?php unset($dataset);?>
</table>
<?php break;?>
<!-- membership -->
<?php case "membership":?>
<table class="wojo small segment table">
  <thead>
    <tr>
      <th colspan="2"> <h5 class="basic"><?php echo Lang::$word->ADM_MEMS;?></h5>
      </th>
    </tr>
  </thead>
  <?php foreach($rows as $row):?>
  <?php $dataset = Utility::jSonToArray($row->dataset);?>
  <tr id="user_<?php echo $row->id;?>">
    <td><?php echo $dataset->title;?></td>
    <td class="auto"><div class="wojo mini buttons">
        <a data-set='{"option":[{"restore": "restoreMembership","title": "<?php echo Validator::sanitize($dataset->title, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#user_<?php echo $row->id;?>"}' class="wojo positive simple button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deleteMembership","title": "<?php echo Validator::sanitize($dataset->title, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#user_<?php echo $row->id;?>"}' class="wojo negative simple button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a>
      </div></td>
  </tr>
  <?php endforeach;?>
  <?php unset($dataset);?>
</table>
<?php break;?>
<!-- news -->
<?php case "news":?>
<table class="wojo small segment table">
  <thead>
    <tr>
      <th colspan="2"> <h5 class="basic"><?php echo Lang::$word->ADM_NEWS;?></h5>
      </th>
    </tr>
  </thead>
  <?php foreach($rows as $row):?>
  <?php $dataset = Utility::jSonToArray($row->dataset);?>
  <tr id="news_<?php echo $row->id;?>">
    <td><?php echo $dataset->title;?></td>
    <td class="auto"><div class="wojo mini buttons">
        <a data-set='{"option":[{"restore": "restoreNews","title": "<?php echo Validator::sanitize($dataset->title, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#news_<?php echo $row->id;?>"}' class="wojo positive simple button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deleteNews","title": "<?php echo Validator::sanitize($dataset->title, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#news_<?php echo $row->id;?>"}' class="wojo negative simple button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a>
      </div></td>
  </tr>
  <?php endforeach;?>
  <?php unset($dataset);?>
</table>
<?php break;?>
<?php case "coupon":?>
<!-- coupon -->
<table class="wojo small segment table">
  <thead>
    <tr>
      <th colspan="2"> <h5 class="basic"><?php echo Lang::$word->ADM_COUPONS;?></h5>
      </th>
    </tr>
  </thead>
  <?php foreach($rows as $row):?>
  <?php $dataset = Utility::jSonToArray($row->dataset);?>
  <tr id="coupon_<?php echo $row->id;?>">
    <td><?php echo $dataset->title;?></td>
    <td class="auto"><div class="wojo mini buttons">
        <a data-set='{"option":[{"restore": "restoreCoupon","title": "<?php echo Validator::sanitize($dataset->title, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#coupon_<?php echo $row->id;?>"}' class="wojo positive simple button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deleteCoupon","title": "<?php echo Validator::sanitize($dataset->title, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#coupon_<?php echo $row->id;?>"}' class="wojo negative simple button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a>
      </div></td>
  </tr>
  <?php endforeach;?>
  <?php unset($dataset);?>
</table>
<?php break;?>
<?php case "menu":?>
<!-- menu -->
<table class="wojo small segment table">
  <thead>
    <tr>
      <th colspan="2"> <h5 class="basic"><?php echo Lang::$word->ADM_MENUS;?></h5>
      </th>
    </tr>
  </thead>
  <?php foreach($rows as $row):?>
  <?php $dataset = Utility::jSonToArray($row->dataset);?>
  <tr id="menu_<?php echo $row->id;?>">
    <td><?php echo $dataset->name;?></td>
    <td class="auto"><div class="wojo mini buttons">
        <a data-set='{"option":[{"restore": "restoreMenu","title": "<?php echo Validator::sanitize($dataset->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#menu_<?php echo $row->id;?>"}' class="wojo positive simple button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deleteMenu","title": "<?php echo Validator::sanitize($dataset->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#menu_<?php echo $row->id;?>"}' class="wojo negative simple button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a>
      </div></td>
  </tr>
  <?php endforeach;?>
  <?php unset($dataset);?>
</table>
<?php break;?>
<?php case "category":?>
<!-- category -->
<table class="wojo small segment table">
  <thead>
    <tr>
      <th colspan="2"> <h5 class="basic"><?php echo Lang::$word->ADM_CATS;?></h5>
      </th>
    </tr>
  </thead>
  <?php foreach($rows as $row):?>
  <?php $dataset = Utility::jSonToArray($row->dataset);?>
  <tr id="category_<?php echo $row->id;?>">
    <td><?php echo $dataset->name;?></td>
    <td class="auto"><div class="wojo mini buttons">
        <a data-set='{"option":[{"restore": "restoreCategory","title": "<?php echo Validator::sanitize($dataset->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#category_<?php echo $row->id;?>"}' class="wojo positive simple button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deleteCategory","title": "<?php echo Validator::sanitize($dataset->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#category_<?php echo $row->id;?>"}' class="wojo negative simple button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a>
      </div></td>
  </tr>
  <?php endforeach;?>
  <?php unset($dataset);?>
</table>
<?php break;?>
<?php endswitch;?>
<?php endforeach;?>
<?php endif;?>