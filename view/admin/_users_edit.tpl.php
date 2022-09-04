<?php
  /**
   * User Manager
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _users_edit.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2><?php echo Lang::$word->USR_EDIT;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo segment form">
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->FNAME;?>
          <i class="icon asterisk"></i></label>
      </div>
      <div class="field">
        <input name="fname" type="text" placeholder="<?php echo Lang::$word->FNAME;?>" value="<?php echo $this->data->fname;?>">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->LNAME;?>
          <i class="icon asterisk"></i></label>
      </div>
      <div class="field">
        <input name="lname" type="text" placeholder="<?php echo Lang::$word->LNAME;?>" value="<?php echo $this->data->lname;?>">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->EMAIL;?>
          <i class="icon asterisk"></i></label>
      </div>
      <div class="field">
        <input name="email" type="text" placeholder="<?php echo Lang::$word->EMAIL;?>" value="<?php echo $this->data->email;?>">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->NEWPASS;?></label>
      </div>
      <div class="field">
        <input type="text" name="password">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->USR_MEMBERSHIP;?></label>
      </div>
      <div class="field">
        <select name="membership_id">
          <option value="0">-/-</option>
          <?php echo Utility::loopOptions($this->mlist, "id", "title", $this->data->membership_id);?>
        </select>
      </div>
      <div class="field auto">
        <div class="wojo fitted inline toggle checkbox">
          <input name="update_membership" type="checkbox" value="1" id="update_membership">
          <label for="update_membership"><?php echo Lang::$word->YES;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->USR_EXTEND;?></label>
      </div>
      <div class="field">
        <input placeholder="<?php echo Lang::$word->TO;?>" name="mem_expire" type="text" value="<?php echo Date::doDate("MM/dd/yyyy", Date::NumberOfDays('+ 30 day'));?>" readonly class="datepick">
      </div>
      <div class="field auto">
        <div class="wojo fitted inline toggle checkbox">
          <input name="extend_membership" type="checkbox" value="1" id="extend_membership">
          <label for="extend_membership"><?php echo Lang::$word->YES;?></label>
        </div>
      </div>
    </div>
    <div class="wojo simple segment">
      <h5><?php echo Lang::$word->CF_TITLE;?></h5>
      <?php echo $this->custom_fields;?></div>
  </div>
  <div class="wojo segment form">
    <h5><?php echo Lang::$word->USR_ADDRESS;?></h5>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->ADDRESS;?></label>
      </div>
      <div class="field">
        <input type="text" placeholder="<?php echo Lang::$word->ADDRESS;?>" value="<?php echo $this->data->address;?>" name="address">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->CITY;?></label>
      </div>
      <div class="field">
        <input type="text" placeholder="<?php echo Lang::$word->CITY;?>" value="<?php echo $this->data->city;?>" name="city">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->STATE;?></label>
      </div>
      <div class="field">
        <input type="text" placeholder="<?php echo Lang::$word->STATE;?>" value="<?php echo $this->data->state;?>" name="state">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="basic field four wide labeled">
        <label><?php echo Lang::$word->COUNTRY;?>/<?php echo Lang::$word->ZIP;?></label>
      </div>
      <div class="basic field">
        <div class="wojo action input">
          <input type="text" placeholder="<?php echo Lang::$word->ZIP;?>" value="<?php echo $this->data->zip;?>" name="zip">
          <select name="country">
            <?php echo Utility::loopOptions($this->clist, "abbr", "name", $this->data->country);?>
          </select>
        </div>
      </div>
    </div>
  </div>
  <div class="wojo segment form">
    <div class="wojo fields">
      <div class="field four wide">
        <div class="field">
          <label class="inverted"><?php echo Lang::$word->CREATED;?></label>
          <?php echo Date::doDate("long_date", $this->data->created);?>
        </div>
        <div class="field">
          <label class="inverted"><?php echo Lang::$word->LASTLOGIN;?></label>
          <?php echo $this->data->lastlogin ? Date::doDate("long_date", $this->data->lastlogin) : Lang::$word->NEVER;?>
        </div>
        <div class="field">
          <label class="inverted"><?php echo Lang::$word->LASTIP;?></label>
          <?php echo $this->data->lastip;?>
        </div>
      </div>
      <div class="field six wide">
        <div class="fitted field">
          <label><?php echo Lang::$word->STATUS;?></label>
          <div class="wojo checkbox radio fitted inline">
            <input name="active" type="radio" value="y" id="active_y" <?php Validator::getChecked($this->data->active, "y"); ?>>
            <label for="active_y"><?php echo Lang::$word->ACTIVE;?></label>
          </div>
          <div class="wojo checkbox radio fitted inline">
            <input name="active" type="radio" value="n" id="active_n" <?php Validator::getChecked($this->data->active, "n"); ?>>
            <label for="active_n"><?php echo Lang::$word->INACTIVE;?></label>
          </div>
          <div class="wojo checkbox radio fitted inline">
            <input name="active" type="radio" value="t" id="active_t" <?php Validator::getChecked($this->data->active, "t"); ?>>
            <label for="active_t"><?php echo Lang::$word->PENDING;?></label>
          </div>
          <div class="wojo checkbox radio fitted inline">
            <input name="active" type="radio" value="b" id="active_b" <?php Validator::getChecked($this->data->active, "b"); ?>>
            <label for="active_b"><?php echo Lang::$word->BANNED;?></label>
          </div>
        </div>
        <div class="fitted field">
          <label><?php echo Lang::$word->USR_TYPE;?></label>
          <div class="wojo checkbox radio fitted inline">
            <input name="type" type="radio" value="staff" id="staff" <?php Validator::getChecked($this->data->type, "staff"); ?>>
            <label for="staff"><?php echo Lang::$word->STAFF;?></label>
          </div>
          <div class="wojo checkbox radio fitted inline">
            <input name="type" type="radio" value="editor" id="editor" <?php Validator::getChecked($this->data->type, "editor"); ?>>
            <label for="editor"><?php echo Lang::$word->EDITOR;?></label>
          </div>
          <div class="wojo checkbox radio fitted inline">
            <input name="type" type="radio" value="member" id="member" <?php Validator::getChecked($this->data->type, "member"); ?>>
            <label for="member"><?php echo Lang::$word->MEMBER;?></label>
          </div>
        </div>
        <div class="fitted field">
          <label><?php echo Lang::$word->USR_NLETTER;?></label>
          <div class="wojo checkbox radio fitted inline">
            <input name="newsletter" type="radio" value="1" id="newsletter_1" <?php Validator::getChecked($this->data->newsletter, 1); ?>>
            <label for="newsletter_1"><?php echo Lang::$word->YES;?></label>
          </div>
          <div class="wojo checkbox radio fitted inline">
            <input name="newsletter" type="radio" value="0" id="newsletter_0" <?php Validator::getChecked($this->data->newsletter, 0); ?>>
            <label for="newsletter_0"><?php echo Lang::$word->NO;?></label>
          </div>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->USR_NOTE;?></label>
        <textarea placeholder="<?php echo Lang::$word->USR_NOTE;?>" name="notes"><?php echo $this->data->notes;?></textarea>
      </div>
    </div>
    <div class="center aligned">
      <a href="<?php echo Url::url("/admin/users");?>" class="wojo small simple button"><?php echo Lang::$word->CANCEL;?></a>
      <button type="button" data-action="processUser" name="dosubmit" class="wojo secondary button"><?php echo Lang::$word->USR_UPDATE;?></button>
    </div>
  </div>
  <input type="hidden" name="id" value="<?php echo $this->data->id;?>">
</form>