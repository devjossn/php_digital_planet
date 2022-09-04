<?php
  /**
   * Contact Page
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _contact.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($this->row->address):?>
<div id="map" style="height:400px" class="margin bottom"></div>
<?php endif;?>
  <div class="row big gutters">
    <div class="columns screen-50 tablet-50 mobile-100 phone-100">
      <h3 class="content-center"><?php echo Lang::$word->CONTACT_INFO;?></h3>
      <div class="wojo big space divider"></div>
      <?php echo $this->row->body;?>
    </div>
    <div class="columns screen-50 tablet-50 mobile-100 phone-100">
      <h3><?php echo Lang::$word->CONTACT_WRITE;?></h3>
      <div class="wojo big space divider"></div>
      <div class="wojo form">
        <form id="wojo_form" name="wojo_form" method="post">
          <div class="wojo block fields">
            <div class="field">
              <label><?php echo Lang::$word->NAME;?>
                <i class="icon asterisk"></i></label>
              <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="<?php if (App::Auth()->is_User()) echo App::Auth()->name;?>" name="name">
            </div>
            <div class="field">
              <label><?php echo Lang::$word->EMAIL;?>
                <i class="icon asterisk"></i></label>
              <input type="text" placeholder="<?php echo Lang::$word->EMAIL;?>" value="<?php if (App::Auth()->is_User()) echo App::Auth()->email;?>" name="email">
            </div>
            <div class="field">
              <label><?php echo Lang::$word->MESSAGE;?>
                <i class="icon asterisk"></i></label>
              <textarea class="small" placeholder="<?php echo Lang::$word->MESSAGE;?>" name="notes"></textarea>
            </div>
            <div class="field">
              <label><?php echo Lang::$word->CAPTCHA;?>
                <i class="icon asterisk"></i></label>
              <div class="wojo labeled input">
                <input name="captcha" placeholder="<?php echo Lang::$word->CAPTCHA;?>" type="text">
                <div class="wojo simple label"><?php echo Session::captcha();?></div>
              </div>
            </div>
            <div class="field">
              <button type="button" data-hide="true" data-action="contact" name="dosubmit" class="wojo primary fluid  button"><?php echo Lang::$word->SEND;?></button>
            </div>
          </div>
          <input type="hidden" name="slug" value="<?php echo $this->segments[1];?>">
        </form>
      </div>
    </div>
  </div>

<?php if($this->row->address):?>
<script type="text/javascript"> 
// <![CDATA[  
  function initMap() {
      var geocoder = new google.maps.Geocoder();
      geocoder.geocode({
          'address': "<?php echo $this->row->address;?>"
      }, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
              var map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 16,
                  center: {
                      lat: results[0].geometry.location.lat(),
                      lng: results[0].geometry.location.lng()
                  },
                  zoomControlOptions: {
                      style: google.maps.ZoomControlStyle.SMALL
                  },
                  scaleControl: true,
                  streetViewControl: false,
                  styles: [
				      {"featureType": "all","stylers": [{"saturation": 0},{"hue": "#e7ecf0"}]},
                      {"featureType": "road","stylers": [{"saturation": -70}]},
                      {"featureType": "transit","stylers": [{"visibility": "off"}]},
                      {"featureType": "poi","stylers": [{"visibility": "off"}]},
                      {"featureType": "water","stylers": [{"visibility": "simplified"},{"saturation": -60}]}
                  ]
              });
              map.setCenter(results[0].geometry.location);
              var marker = new google.maps.Marker({
                  map: map,
                  animation: google.maps.Animation.DROP,
                  icon: '<?php echo SITEURL;?>/assets/images/marker.png',
                  position: results[0].geometry.location
              });
              //set infowindow
              var content =
                  "<div class=\"container\">" +
                  "<h5><?php echo $this->core->company;?></h5>" +
                  "<div class=\"content\">" +
                  "<?php echo $this->row->address;?>" +
                  "</div>" +
                  "</div>";

              var infowindow = new google.maps.InfoWindow({
                  content: content,
                  maxWidth: 350,
                  maxHeight: 350
              });

              marker.addListener('click', function() {
                  infowindow.open(map, marker);
              });
          } else {
              $.wNotice('Geocode was not successful for the following reason: ' + status, {
                  title: 'Error',
				  type: 'error'
              });
          }
      });
  }
// ]]>
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $this->core->mapapi;?>&callback=initMap"></script>
<?php endif;?>
