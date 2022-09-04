<?php
  /**
   * Custom Fields
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2017
   * @version $Id: customFields.tpl.php, v1.00 2017-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>               
<?php
  $html = '';
  switch ($data['section']):
      case "profile":
          foreach ($data['data'] as $i => $row) {
              $tootltip = $row->tooltip ? ' <span data-tooltip="' . $row->tooltip . '"><i class="icon question sign"></i></span>' : '';
              $required = $row->required ? ' <i class="icon asterisk"></i>' : '';

              $html .= '<div class="wojo fields align middle">';
			  $html .= '<div class="field four wide labeled">';
              $html .= '<label>' . $row->title . $tootltip . $required . '</label>';
			  $html .= '</div>';
              $html .= '<div class="field">';
			  $html .= '<input name="custom_' . $row->name . '" type="text" placeholder="' . $row->title . '" value="' . ($data['id'] ? $row->field_value : '') . '">';
              $html .= '</div>';
              $html .= '</div>';
          }
		  unset($row);
          break;
		  
      case "product":
          foreach ($data['data'] as $i => $row) {
			  if(!empty($row->field_value)) {
				  $html .= '<div class="item" align middle>';
				  $html .= '<div class="content auto"><span class="wojo demi text">' . $row->title . ':</span></div>';
				  $html .= '<div class="content padding left">' . $row->field_value;
				  $html .= '</div>';
				  $html .= '</div>';
			  }
		  }
		  unset($row);
          break;
  endswitch;
  echo $html;