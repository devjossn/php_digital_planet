<?php
  /**
   * Product Button
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: productButton.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php
  if ($this->row->type == "affiliate") {
      echo '<a href="' . $this->row->affiliate . '" targe="_blank" class="wojo secondary button"> <i class="icon globe"></i> ' . Lang::$word->VISIT . '</a>';
  } else {
      if ($this->row->membership_id == 0) {
          if ($this->row->price == 0) {
			  if($this->core->allow_free == "yes") {
				  echo '<a data-set=\'{"option":[{"action":"download", "token":"' . Utility::encode($this->row->id) . '"}],"url":"/controller.php", "parent":"#item_' . $this->row->id . '", "buttons": false, "complete":"replace", "modalclass":"medium"}\' class="wojo fluid rounded primary button action"><i class="icon membership"></i> ' . Lang::$word->PRD_DOWNFREE . '</a>';
			  } else {
				  if(App::Auth()->logged_in) {
					  echo '<a data-set=\'{"option":[{"action":"download", "token":"' . Utility::encode($this->row->id) . '"}],"url":"/controller.php", "parent":"#item_' . $this->row->id . '", "buttons": false, "complete":"replace", "modalclass":"medium"}\' class="wojo fluid rounded primary button action"><i class="icon membership"></i> ' . Lang::$word->PRD_DOWNFREE . '</a>';
				  } else {
					  echo '<a href="' . Url::url("/login") . '" class="wojo fluid rounded primary button"> <i class="icon lock"> </i>' . Lang::$word->LOGIN . '</a>';
				  }
			  }
          } else {
              echo '<a data-id="' . $this->row->id . '" class="wojo fluid rounded primary button add"><i class="icon basket add"></i> ' . Lang::$word->ADD . '</a>';
          }
      } else {
          if ($this->row->membership_id and Content::is_valid($this->row->membership_id)) {
              echo '<a data-set=\'{"option":[{"action":"download", "token":"' . Utility::encode($this->row->id) . '"}],"url":"/controller.php", "parent":"#item_' . $this->row->id . '", "buttons": false, "complete":"replace", "modalclass":"medium"}\' class="wojo fluid rounded primary button action"><i class="icon membership"></i> ' . Lang::$word->DOWNLOAD . '</a>';
          } else {
              echo '<a class="wojo fluid rounded primary button disabled"> <i class="icon membership"></i> ' . Lang::$word->VIP . '</a>';
          }
      }
  }