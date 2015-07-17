<?php /* Template Name: Geo Map Template */ ?>
<?php get_header(); ?>
<?php if(is_user_logged_in()){ ?>
<script>
function initialize() {
    infowindow = new google.maps.InfoWindow();
    var map, marker, polys = [];
    var mapOptions = {
        zoom: 4,
        center: new google.maps.LatLng(40.314245, -99.310831),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        disableDefaultUI:true,
        disableDoubleClickZoom: true,
        draggable: false,
        scrollwheel: false,
        zoomControl: false,
    };
    //mapOptions.styles = [{featureType:'all',stylers:[{saturation:-100},{gamma:0.80}]}];
    map = new google.maps.Map(document.getElementById('chart_div'), mapOptions);
    
    var addListenersOnPolygon = function(polygon, stateName, avr, polycenter) {
        google.maps.event.addListener(polygon, 'click', function (event) {
            layer = new google.maps.FusionTablesLayer({
                suppressInfoWindows: true,
                map: map,
                query: {
                    select: "geometry",
                    from: "1d-OoNus4o8aIMG2O1x47jkUIRIfEOTYDAmrlNGG7",
                    where: "'State Abbr.' LIKE '"+avr+"'"
                },
                styles: [{
                  polygonOptions: {
                    fillColor: '#00FF00',
                    fillOpacity: 0.3,
                    strokeColor: '#FFFF00',
                    strokeWeight: 1
                  }
                }]
           });
            for(var i=0; i<polys.length; i++){
                polys[i].setMap(null);
                //marker.setMap(null);
           }
           
           map.setCenter(polycenter);
           map.setZoom(7);
           layer.setMap(map);
           
            var myLatlng = new google.maps.LatLng(40.57087, -84.91335);
            var marker = new google.maps.Marker({
                map: map,
                position: myLatlng,
                title: 'Adams, IN, USA',
                icon: '<?php bloginfo('template_directory'); ?>/images/redmarker.png'
            });
            google.maps.event.addListener(marker, 'click', function() {
                //window.location = 'http://netwrk.coregensolutions.com/network/?gid=4&avr='+avr;
                //var href = 'http://netwrk.coregensolutions.com/network/?gid=4&avr='+avr;
                var href = '#popupnetwork';
                jQuery.fancybox({
                    maxWidth	: 800,
            		maxHeight	: 600,
            		fitToView	: false,
            		width		: '70%',
            		height		: '70%',
            		autoSize	: false,
            		closeClick	: false,
            		openEffect	: 'none',
            		closeEffect	: 'none',
                    href : href,
                });
            });
           
            var myLatlng1  = new google.maps.LatLng(40.2044071,-87.148234);
            var marker1 = new google.maps.Marker({
                position: myLatlng1,
                map: map,
                icon: '<?php bloginfo('template_directory'); ?>/images/yellowmarker.png',
                title: 'Newtown, IN, USA'
            });
            google.maps.event.addListener(marker1, 'click', function() {
                var href = '#popupnetwork';
                jQuery.fancybox({
                    maxWidth	: 800,
            		maxHeight	: 600,
            		fitToView	: false,
            		width		: '70%',
            		height		: '70%',
            		autoSize	: false,
            		closeClick	: false,
            		openEffect	: 'none',
            		closeEffect	: 'none',
                    href : href,
                });
            });
            
            var myLatlng2  = new google.maps.LatLng(41.0938519,-85.070737);
            var marker2 = new google.maps.Marker({
                position: myLatlng2,
                map: map,
                icon: '<?php bloginfo('template_directory'); ?>/images/redmarker.png',
                title: 'Allen, IN, USA'
            });
            google.maps.event.addListener(marker2, 'click', function() {
                var href = '#popupnetwork';
                jQuery.fancybox({
                    maxWidth	: 800,
            		maxHeight	: 600,
            		fitToView	: false,
            		width		: '70%',
            		height		: '70%',
            		autoSize	: false,
            		closeClick	: false,
            		openEffect	: 'none',
            		closeEffect	: 'none',
                    href : href,
                });
            });
                    
        });  
    }

    
    jQuery.get("<?php bloginfo('template_directory'); ?>/states.xml", {}, function(data) {
    jQuery(data).find("state").each(function() {
      var stateName = this.getAttribute('name');
      var avr = this.getAttribute('avr');
      var colour = this.getAttribute('colour');
      var points = this.getElementsByTagName("point");
      var pts = [];
      if(stateName == 'Indiana'){
      for (var i = 0; i < points.length; i++) {
        pts[i] = new google.maps.LatLng(parseFloat(points[i].getAttribute("lat")), parseFloat(points[i].getAttribute("lng")));
      }
        var bounds = new google.maps.LatLngBounds();
        for (i = 0; i < pts.length; i++) {
            bounds.extend(pts[i]);
        }
        var polycenter = bounds.getCenter();
        
        /*var marker=new google.maps.Marker({
            position:polycenter,
        }); */
        
      var poly = new google.maps.Polygon({
        paths: pts,
        strokeColor: '#000000',
        strokeOpacity: 0.6,
        strokeWeight:1,
        fillColor: colour,
        fillOpacity: 0.35
      });
      polys.push(poly);
      poly.setMap(map);
      //marker.setMap(map);
        
        
        addListenersOnPolygon(poly, stateName, avr, polycenter);
      }
    });
  });
}

function showArrays(event){
    alert(this.indexID);
}
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<div id="popupnetwork" style="display: none;">
    <div class="maincontent">
        <div class="section group">
            <div class="col span_3_of_12">
                <div class="netwrkBlock"><a href="<?php bloginfo('url'); ?>/network/?gid=4">Network 1</a></div>
            </div>
            <div class="col span_3_of_12">
                <div class="netwrkBlock"><a href="<?php bloginfo('url'); ?>/network/?gid=4">Network 2</a></div>
            </div>
            <div class="col span_3_of_12">
                <div class="netwrkBlock"><a href="<?php bloginfo('url'); ?>/network/?gid=4">Network 3</a></div>
            </div>
            <div class="col span_3_of_12">
                <div class="netwrkBlock"><a href="<?php bloginfo('url'); ?>/network/?gid=4">Network 4</a></div>
            </div>
        </div>
        <div class="section group">
            <div class="col span_12_of_12">
                <div class="col span_4_of_12">
                    <div class="createBlock">
                    <?php
                        $user_role = get_user_role($user_ID);
                        if($user_role == 'groupadmin'){
                            $addmemberurl = get_bloginfo('url').'/add-members';
                        } else {
                             $addmemberurl = '#';
                        }
                    ?>
                        <a href="#>"><img src="<?php bloginfo('template_directory'); ?>/images/createnetwork.png" /></a>
                        <div>Create Network</div>
                    </div>
                </div>
                <div class="col span_4_of_12">
                    <div class="createBlock1"><div class="proImgBig1" style="text-align: center;"><img src="<?php bloginfo('template_directory'); ?>/images/profile1.png" /></div></div>
                </div>
                <div class="col span_4_of_12">
                    <div class="createBlock">
                        <a href="<?php bloginfo('url'); ?>/create-conversation"><img src="<?php bloginfo('template_directory'); ?>/images/dw2.png" /></a>
                        <div>Create DW</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section group">
            <div class="col span_3_of_12">
                <div class="dwBlock"><a href="<?php bloginfo('url'); ?>/view-dw/?pid=62">DW 1</a></div>
            </div>
            <div class="col span_3_of_12">
                <div class="dwBlock"><a href="<?php bloginfo('url'); ?>/view-dw/?pid=62">DW 2</a></div>
            </div>
            <div class="col span_3_of_12">
                <div class="dwBlock"><a href="<?php bloginfo('url'); ?>/view-dw/?pid=62">DW 3</a></div>
            </div>
            <div class="col span_3_of_12">
                <div class="dwBlock"><a href="<?php bloginfo('url'); ?>/view-dw/?pid=62">DW 4</a></div>
            </div>
        </div>
    </div>
</div>
<div id="bodymaincontainer">
	<div class="maincontent">
	    <div class="section group">
            <div class="col span_12_of_12">
                <div class="groupbox" style="height: 500px;">
                    <div id="chart_div" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
	    </div>
	</div>
</div>
<?php } else { header('Location: '.get_bloginfo('home').'/log-in'); } ?>
<?php get_footer(); ?>