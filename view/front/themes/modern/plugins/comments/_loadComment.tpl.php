<?php
  /**
   * Load Single Comment
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: loadComment.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php
	if ($this->data->uname) {
		$user = '<span class="author">' . $this->data->uname . '</span>';
		$avatar = '<div class="avatar"><img src="' . UPLOADURL . '/avatars/blank.svg" alt=""></div>';
	} else {
		$user = '<span class="author">' . $this->data->name . '</span>';
		$avatar = '<a class="avatar"><img src="' . UPLOADURL . '/avatars/' . ($this->data->avatar ? $this->data->avatar : "blank.svg") . '" alt=""></a>';
	}
?>
<div id="comment_<?php echo $this->data->id;?>" data-id="<?php echo $this->data->id;?>" class="comment">
  <?php echo $avatar;?>
  <div class="content">
    <?php echo $user;?>
    <div class="metadata">
      <span class="date">
      <?php echo ($this->conf->timesince) ? Date::timesince($this->data->created) : Date::doDate($this->conf->dateformat, $this->data->created);?>
      </span>
      <?php if($this->data->parent_id == 0):?>
      <div class="wojo stars">
        <?php for ($x = 1; $x <= $this->data->rating; $x++):?>
        <span class="star active"><i class="icon star full"></i></span>
        <?php endfor;?>
        <?php while ($x <= 5) :?>
        <span class="star"><i class="icon star"></i></span>
        <?php $x++;?>
        <?php endwhile;?>
      </div>
      <?php endif;?>
      <?php if(App::Auth()->is_Admin()):?>
      <a class="delete"><i class="icon trash"></i></a>
      <?php endif;?>
    </div>
    <div class="text"><?php echo $this->data->body;?></div>
    <div class="wojo horizontal divided fluid list actions">
      <?php if($this->conf->rating):?>
      <a class="item up" data-id="<?php echo $this->data->id;?>" data-up="<?php echo $this->data->vote_up;?>"><span class="wojo positive text"><?php echo $this->data->vote_up;?></span>
        <i class="icon chevron up"></i></a>
      <a class="item down" data-id="<?php echo $this->data->id;?>" data-down="<?php echo $this->data->vote_down;?>"><span class="wojo negative text"><?php echo $this->data->vote_down;?></span>
        <i class="icon chevron down"></i></a>
      <?php endif;?>
      <?php if($this->data->parent_id == 0):?>
      <a data-id="<?php echo $this->data->id;?>" class="item replay"><?php echo Lang::$word->CMT_REPLAY;?></a>
      <?php endif;?>
    </div>
  </div>
</div>
