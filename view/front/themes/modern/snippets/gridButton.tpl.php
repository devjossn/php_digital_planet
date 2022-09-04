<?php
  /**
   * Grid Button
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: gridButton.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php
  if ($row->type == "affiliate") {
      echo '<a href="' . $row->affiliate . '" target="_blank" class="wojo simple white button"> <i class="icon globe"></i> ' . Lang::$word->VISIT . '</a>';
  } else {
	  if ($row->membership_id == 0) {
		  if ($row->price == 0) {
			  if($this->core->allow_free == "yes") {
				  echo '<a data-set=\'{"option":[{"action":"download", "token":"' . Utility::encode($row->id) . '"}],"url":"/controller.php", "parent":"#item_' . $row->id . '", "buttons": false, "complete":"replace", "modalclass":"medium"}\' class="wojo simple white button button action"><i class="icon unlock"></i> ' . Lang::$word->PRD_DOWNFREE . '</a>';
			  } else {
				  if(App::Auth()->logged_in) {
					  echo '<a data-set=\'{"option":[{"action":"download", "token":"' . Utility::encode($row->id) . '"}],"url":"/controller.php", "parent":"#item_' . $row->id . '", "buttons": false, "complete":"replace", "modalclass":"medium"}\' class="wojo simple white button button action"><i class="icon unlock"></i> ' . Lang::$word->PRD_DOWNFREE . '</a>';
				  } else {
					  echo '<a href="' . Url::url("/login") . '" class="wojo simple white button"> <i class="icon lock"> </i>' . Lang::$word->LOGIN . '</a>';
				  }
			  }
		  } else {
			  echo '<a data-id="' . $row->id . '" class="wojo simple white button add"> <i class="icon bag add"> </i>' . Lang::$word->ADD . '</a>';
		  }
	  } else {
		  if ($row->membership_id and Content::is_valid($row->membership_id)) {
              echo '<a data-set=\'{"option":[{"action":"download", "token":"' . Utility::encode($row->id) . '"}],"url":"/controller.php", "parent":"#item_' . $row->id . '", "buttons": false, "complete":"replace", "modalclass":"medium"}\' class="wojo simple white button button action"><i class="icon membership"></i> ' . Lang::$word->DOWNLOAD . '</a>';
		  } else {
			  echo '<a class="wojo simple white button disabled"> <i class="icon membership"> </i>' . Lang::$word->VIP . '</a>';
		  }
	  }
  }