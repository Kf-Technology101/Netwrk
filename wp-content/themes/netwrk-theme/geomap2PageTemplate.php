<?php /* Template Name: Geo Map 2 Template */ ?>
<?php get_header(); ?>
<?php if(is_user_logged_in()){ ?>
<script>
//var hostname = 'http://'+location.hostname+'/coregen/netwrkdemo';
var hostname = 'http://netwrkdemo.coregensolutions.com';

/* Zoom In Function */
function zoominFunction(){
    jQuery('#usmap').hide();
    jQuery('#indiana_county').show();
    jQuery('.marker1').show();
    jQuery('.marker2').show();
    
    jQuery('#zoominmap').hide();
    jQuery('#zoomoutmap').hide();
    
    jQuery('#zoominmap1').show();
    jQuery('#zoomoutmap1').show();
}

function zoomin_showGraph(){
    jQuery('#indiana_county').hide();
    jQuery('#mynetwork1').show();
    jQuery('.marker1').hide();
    jQuery('.marker2').hide();
    drawnetwork();
    
    jQuery('#zoominmap').hide();
    jQuery('#zoomoutmap').hide();
    
    jQuery('#zoominmap1').hide();
    jQuery('#zoomoutmap1').hide();
    
    jQuery('#zoominmap2').show();
    jQuery('#zoomoutmap2').show();
}

function show_county(){
    jQuery('#indiana_county').show();
    jQuery('.marker1').show();
    jQuery('.marker2').show();
    
    jQuery('#mynetwork1').hide();
    
    jQuery('#zoominmap').hide();
    jQuery('#zoomoutmap').hide();
    
    jQuery('#zoominmap1').show();
    jQuery('#zoomoutmap1').show();
    
    jQuery('#zoominmap2').hide();
    jQuery('#zoomoutmap2').hide();
}

function show_network(){
    jQuery('#indiana_county').hide();
    jQuery('#mynetwork1').show();
    drawnetwork();
    jQuery('.marker1').hide();
    jQuery('.marker2').hide();
    
    jQuery('#zoominmap').hide();
    jQuery('#zoomoutmap').hide();
    
    jQuery('#zoominmap1').hide();
    jQuery('#zoomoutmap1').hide();
    
    jQuery('#zoominmap2').show();
    jQuery('#zoomoutmap2').show();
    
    jQuery('#zoominmap3').hide();
    jQuery('#zoomoutmap3').hide();
}

function show_network1(){
    jQuery('#indiana_county').hide();
    //jQuery('#mynetwork1').show();
    //drawnetwork();
    jQuery('#mynetwork2').show();
    drawnetwork1();
    jQuery('.marker1').hide();
    jQuery('.marker2').hide();
    
    jQuery('#zoominmap').hide();
    jQuery('#zoomoutmap').hide();
    
    jQuery('#zoominmap1').hide();
    jQuery('#zoomoutmap1').hide();
    
    jQuery('#zoominmap2').show();
    jQuery('#zoomoutmap2').show();
    
    jQuery('#zoominmap3').hide();
    jQuery('#zoomoutmap3').hide();
}

function show_network_withzoomin(){
    jQuery('#indiana_county').hide();
    jQuery('#mynetwork1').show();
    drawnetwork_withzoomin();
    jQuery('.marker1').hide();
    jQuery('.marker2').hide();
    
    jQuery('#zoominmap').hide();
    jQuery('#zoomoutmap').hide();
    
    jQuery('#zoominmap1').hide();
    jQuery('#zoomoutmap1').hide();
    
    jQuery('#zoominmap2').hide();
    jQuery('#zoomoutmap2').hide();
    
    jQuery('#zoominmap3').show();
    jQuery('#zoomoutmap3').show();
}
function show_network_withzoomout(){
    jQuery('#indiana_county').hide();
    jQuery('#mynetwork1').show();
    drawnetwork_withzoomout();
    
    jQuery('.marker1').hide();
    jQuery('.marker2').hide();
    
    jQuery('#zoominmap').hide();
    jQuery('#zoomoutmap').hide();
    
    jQuery('#zoominmap1').hide();
    jQuery('#zoomoutmap1').hide();
    
    jQuery('#zoominmap2').show();
    jQuery('#zoomoutmap2').show();
    
    jQuery('#zoominmap3').hide();
    jQuery('#zoomoutmap3').hide();
}


function drawnetwork(){
    var nodes = null;
    var edges = null;
    
    var DIR = '<?php echo get_bloginfo('template_directory').'/images/'; ?>';
    
    <?php
    global $wpdb;
    $group_id = 4;
            
    $table_name1 = $wpdb->prefix.'usermeta';
    $sql1 = "SELECT * FROM $table_name1 WHERE meta_key = 'group_joined' AND meta_value = ".$group_id;
    $results1 = $wpdb->get_results($sql1);
    ?>
    
    var nodes = new vis.DataSet([
    <?php foreach($results1 as $r1){ ?>
            {id: <?php echo $r1->user_id; ?>, shape: 'circularImage', image: '<?php echo get_image_size_30_30($r1->user_id); ?>', label:"<?php echo get_the_author_meta('display_name', $r1->user_id); ?>"},
    <?php } ?>
    ]);
    
    var edges = new vis.DataSet([
        <?php foreach($results1 as $r1){ ?>
        <?php
            $sql2 = "SELECT * FROM $table_name1 WHERE meta_key = 'parent_member' AND user_id = ".$r1->user_id;
            $results2 = $wpdb->get_results($sql2);
            foreach($results2 as $r2){
                if(!empty($r2->meta_value)){
        ?>
                {from: <?php echo $r2->meta_value; ?>, to: <?php echo $r2->user_id; ?>, dashes:false},
                <?php } ?>
            <?php } ?>
        <?php } ?>
    ]);
    
    <?php
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) :
    while ( $the_query->have_posts() ) : $the_query->the_post();
    ?>
    <?php $abspath = dirname(__FILE__); ?>
    nodes.add({id: -<?php the_ID(); ?>, image: '<?php bloginfo('template_directory'); ?>/images123.php?num=<?php $comments_count = wp_count_comments( get_the_ID() ); echo $comments_count->total_comments; ?>&title=<?php echo get_the_title(); ?>', shape: 'image'});
    
    <?php
    endwhile;
    endif;
    wp_reset_postdata();
    ?>
    
    // create a network
    var container = document.getElementById('mynetwork1');
    var data = {
        nodes: nodes,
        edges: edges
    };
    var options = {
    layout:{
        randomSeed:2
        }
    };
    
    var network = new vis.Network(container, data, options);
    var envelope = jQuery('#envelope').attr('href');
    var infobox = jQuery('#infobox').attr('href');
    var deleteuser = jQuery('#trash').attr('href');
    
    network.on("click", function (properties) {
       // alert(properties.nodes);
        var user_id = '?uid='+properties.nodes;
        var chatfunc = "javascript:openchat("+properties.nodes+")";
            jQuery('#comment').attr('onclick', chatfunc);
            jQuery('#envelope').attr('href', envelope+user_id);
            jQuery('#infobox').attr('href', infobox+user_id);
            jQuery('#trash').attr('href', deleteuser+user_id);
            
            var nodeid = properties.nodes;
            
            <?php 
        if(is_user_logged_in()){
            global $user_ID;
            $user_role = get_user_role($user_ID);
            if($user_role == 'groupadmin' || $user_role == 'groupmember'){
        ?>
        //alert(nodeid);
        if(nodeid != '' && nodeid>0){
            jQuery('#proImgBig1').html('');
            jQuery.ajax({
                url: hostname+"/get-profile-image",
                type: "post",
                cache: false,
                data: {"userid": nodeid},
                success: function(response){
                    //alert(response);
                    jQuery('#proImgBig1').html(response);
                }
            });
            jQuery('#link_id1').trigger('click');
        } else if(nodeid<0) {
            window.location = '<?php bloginfo('url'); ?>/view-dw/?pid='+nodeid*(-1);
        } else {
            jQuery('#link_id2').trigger('click');
        }
        <?php } ?>
        <?php } ?>
    });
}

function drawnetwork_withzoomin(){
    var nodes = null;
    var edges = null;
    
    var DIR = '<?php echo get_bloginfo('template_directory').'/images/'; ?>';
    
    <?php
    global $wpdb;
    $group_id = 4;
            
    $table_name1 = $wpdb->prefix.'usermeta';
    $sql1 = "SELECT * FROM $table_name1 WHERE meta_key = 'group_joined' AND meta_value = ".$group_id;
    $results1 = $wpdb->get_results($sql1);
    ?>
    
    var nodes = new vis.DataSet([
    <?php foreach($results1 as $r1){ ?>
            {id: <?php echo $r1->user_id; ?>, shape: 'circularImage', image: '<?php echo get_image_size_30_30($r1->user_id); ?>', label:"<?php echo get_the_author_meta('display_name', $r1->user_id); ?>"},
    <?php } ?>
    ]);
    
    var edges = new vis.DataSet([
        <?php foreach($results1 as $r1){ ?>
        <?php
            $sql2 = "SELECT * FROM $table_name1 WHERE meta_key = 'parent_member' AND user_id = ".$r1->user_id;
            $results2 = $wpdb->get_results($sql2);
            foreach($results2 as $r2){
                if(!empty($r2->meta_value)){
        ?>
                {from: <?php echo $r2->meta_value; ?>, to: <?php echo $r2->user_id; ?>, dashes:false},
                <?php } ?>
            <?php } ?>
        <?php } ?>
    ]);
    
    <?php
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) :
    while ( $the_query->have_posts() ) : $the_query->the_post();
    ?>
    <?php $abspath = dirname(__FILE__); ?>
    nodes.add({id: -<?php the_ID(); ?>, image: '<?php bloginfo('template_directory'); ?>/images123.php?num=<?php $comments_count = wp_count_comments( get_the_ID() ); echo $comments_count->total_comments; ?>&title=<?php echo get_the_title(); ?>', shape: 'image'});
    
    <?php
    endwhile;
    endif;
    wp_reset_postdata();
    ?>
    
    // create a network
    var container = document.getElementById('mynetwork1');
    var data = {
        nodes: nodes,
        edges: edges
    };
    var options = {
        layout:{randomSeed:2},
        scaling: {
          min: 10,
          max: 30
        },
        };
    var network = new vis.Network(container, data, options);
    var envelope = jQuery('#envelope').attr('href');
    var infobox = jQuery('#infobox').attr('href');
    var deleteuser = jQuery('#trash').attr('href');
    
    network.on("click", function (properties) {
       // alert(properties.nodes);
        var user_id = '?uid='+properties.nodes;
        var chatfunc = "javascript:openchat("+properties.nodes+")";
            jQuery('#comment').attr('onclick', chatfunc);
            jQuery('#envelope').attr('href', envelope+user_id);
            jQuery('#infobox').attr('href', infobox+user_id);
            jQuery('#trash').attr('href', deleteuser+user_id);
            
            var nodeid = properties.nodes;
            
            <?php 
        if(is_user_logged_in()){
            global $user_ID;
            $user_role = get_user_role($user_ID);
            if($user_role == 'groupadmin' || $user_role == 'groupmember'){
        ?>
        //alert(nodeid);
        if(nodeid != '' && nodeid>0){
            jQuery('#proImgBig1').html('');
            jQuery.ajax({
                url: hostname+"/get-profile-image",
                type: "post",
                cache: false,
                data: {"userid": nodeid},
                success: function(response){
                    //alert(response);
                    jQuery('#proImgBig1').html(response);
                }
            });
            jQuery('#link_id1').trigger('click');
        } else if(nodeid<0) {
            window.location = '<?php bloginfo('url'); ?>/view-dw/?pid='+nodeid*(-1);
        } else {
            jQuery('#link_id2').trigger('click');
        }
        <?php } ?>
        <?php } ?>
    });
    var options1 = {
        scale: 1.5
    }
    network.moveTo(options1);
}


function drawnetwork_withzoomout(){
    var nodes = null;
    var edges = null;
    
    var DIR = '<?php echo get_bloginfo('template_directory').'/images/'; ?>';
    
    <?php
    global $wpdb;
    $group_id = 4;
            
    $table_name1 = $wpdb->prefix.'usermeta';
    $sql1 = "SELECT * FROM $table_name1 WHERE meta_key = 'group_joined' AND meta_value = ".$group_id;
    $results1 = $wpdb->get_results($sql1);
    ?>
    
    var nodes = new vis.DataSet([
    <?php foreach($results1 as $r1){ ?>
            {id: <?php echo $r1->user_id; ?>, shape: 'circularImage', image: '<?php echo get_image_size_30_30($r1->user_id); ?>', label:"<?php echo get_the_author_meta('display_name', $r1->user_id); ?>"},
    <?php } ?>
    ]);
    
    var edges = new vis.DataSet([
        <?php foreach($results1 as $r1){ ?>
        <?php
            $sql2 = "SELECT * FROM $table_name1 WHERE meta_key = 'parent_member' AND user_id = ".$r1->user_id;
            $results2 = $wpdb->get_results($sql2);
            foreach($results2 as $r2){
                if(!empty($r2->meta_value)){
        ?>
                {from: <?php echo $r2->meta_value; ?>, to: <?php echo $r2->user_id; ?>, dashes:false},
                <?php } ?>
            <?php } ?>
        <?php } ?>
    ]);
    
    <?php
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) :
    while ( $the_query->have_posts() ) : $the_query->the_post();
    ?>
    <?php $abspath = dirname(__FILE__); ?>
    nodes.add({id: -<?php the_ID(); ?>, image: '<?php bloginfo('template_directory'); ?>/images123.php?num=<?php $comments_count = wp_count_comments( get_the_ID() ); echo $comments_count->total_comments; ?>&title=<?php echo get_the_title(); ?>', shape: 'image'});
    
    <?php
    endwhile;
    endif;
    wp_reset_postdata();
    ?>
    
    // create a network
    var container = document.getElementById('mynetwork1');
    var data = {
        nodes: nodes,
        edges: edges
    };
    var options = {layout:{randomSeed:2}};
    var network = new vis.Network(container, data, options);
    var envelope = jQuery('#envelope').attr('href');
    var infobox = jQuery('#infobox').attr('href');
    var deleteuser = jQuery('#trash').attr('href');
    
    network.on("click", function (properties) {
       // alert(properties.nodes);
        var user_id = '?uid='+properties.nodes;
        var chatfunc = "javascript:openchat("+properties.nodes+")";
            jQuery('#comment').attr('onclick', chatfunc);
            jQuery('#envelope').attr('href', envelope+user_id);
            jQuery('#infobox').attr('href', infobox+user_id);
            jQuery('#trash').attr('href', deleteuser+user_id);
            
            var nodeid = properties.nodes;
            
            <?php 
        if(is_user_logged_in()){
            global $user_ID;
            $user_role = get_user_role($user_ID);
            if($user_role == 'groupadmin' || $user_role == 'groupmember'){
        ?>
        //alert(nodeid);
        if(nodeid != '' && nodeid>0){
            jQuery('#proImgBig1').html('');
            jQuery.ajax({
                url: hostname+"/get-profile-image",
                type: "post",
                cache: false,
                data: {"userid": nodeid},
                success: function(response){
                    //alert(response);
                    jQuery('#proImgBig1').html(response);
                }
            });
            jQuery('#link_id1').trigger('click');
        } else if(nodeid<0) {
            window.location = '<?php bloginfo('url'); ?>/view-dw/?pid='+nodeid*(-1);
        } else {
            jQuery('#link_id2').trigger('click');
        }
        <?php } ?>
        <?php } ?>
    });
}

/* Zoom Out Function */
function zoomoutFunction(){
    jQuery('#mynetwork1').hide();
    jQuery('#indiana_county').show();
    jQuery('#zoomoutmap').attr('onclick','zoomout_showMap()');
}

function zoomout_showMap(){
    jQuery('#indiana_county').hide();
    jQuery('.marker1').hide();
    jQuery('.marker2').hide();
    jQuery('#usmap').show();
    
    jQuery('#zoominmap').show();
    jQuery('#zoomoutmap').show();
    
    jQuery('#zoominmap1').hide();
    jQuery('#zoomoutmap1').hide();
    
    jQuery('#zoominmap2').hide();
    jQuery('#zoomoutmap2').hide();
    
    var map, marker, polys = [];
    var mapOptions = {
        zoom: 5,
        center: new google.maps.LatLng(40.314245, -99.310831),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        disableDefaultUI:true,
        disableDoubleClickZoom: true,
        draggable: false,
        scrollwheel: false,
        zoomControl: false,
    };
    
    map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
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
                google.maps.event.addListener(poly, 'click', zoominFunction);
            }
        });
    });
}


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
    <!-- <div id="map_canvas" style="width:100%; height: 660px;"></div> -->
    <div id="usmap">
        <!-- <img src="<?php bloginfo('template_directory'); ?>/images/usmap1.png" usemap="#Map" /> -->
        <img src="<?php bloginfo('template_directory'); ?>/images/usmap2.jpg" usemap="#Map" />
        <map class="" name="Map" id="Map">
            <area onclick="zoominFunction();" alt="" title="" href="#" shape="poly" coords="623,209,639,203,667,203,675,260,662,278,658,286,647,289,639,292,631,293,623,298" />
        </map>
        <!--<map class="mobileview" name="Map" id="Map">
            <area onclick="zoominFunction();" alt="" title="" href="#" shape="poly" coords="449,415,455,409,466,405,474,405,480,408,481,419,486,447,481,459,474,464,465,468,459,468,456,470,449,470" />
        </map>-->
    </div>
    <div id="indiana_county" style="display: none;">
        <img src="<?php bloginfo('template_directory'); ?>/images/indiana-county.png" />
    </div>
    <div id="mynetwork1" style="display: none; height: 600px;"></div>
    <div id="mynetwork2" style="display: none; height: 600px;"></div>
    <div id="mynetwork3" style="display: none; height: 600px;"></div>
    <div id="mynetwork4" style="display: none; height: 600px;"></div>
    <a id="link_id1" class="various" href="#popupdiv" style="display: none;">Iframe</a>
    <a id="link_id2" class="various" href="#popupdivAdmin" style="display: none;"></a>
    
    <!--<div class="zoomoptions">
        <div id="zoominmap" onclick="zoominFunction()"><i class="fa fa-plus"></i></div>
        <div id="zoomoutmap" onclick="javascript:void(0)"><i class="fa fa-minus"></i></div>
        
        <div id="zoominmap1" onclick="zoomin_showGraph()"><i class="fa fa-plus"></i></div>
        <div id="zoomoutmap1" onclick="zoomout_showMap()"><i class="fa fa-minus"></i></div>
        
        <div id="zoominmap2" onclick="show_network_withzoomin();"><i class="fa fa-plus"></i></div>
        <div id="zoomoutmap2" onclick="show_county();"><i class="fa fa-minus"></i></div>
        
        <div id="zoominmap3" onclick="javascript:void(0)"><i class="fa fa-plus"></i></div>
        <div id="zoomoutmap3" onclick="show_network_withzoomout();"><i class="fa fa-minus"></i></div>
        
    </div>-->
    <div id="marker1" class="marker marker1" onclick="show_network();"><?php echo dwcount(1); ?></div>
    <div id="marker2" class="marker marker2" onclick="show_network();"><?php echo dwcount(2); ?></div>
</div>

<?php } else { header('Location: '.get_bloginfo('home').'/log-in'); } ?>
<?php get_footer(); ?>