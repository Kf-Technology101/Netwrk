<?php /* Template Name: DW Netwrk Template */ ?>
<?php get_header(); ?>
<?php if(is_user_logged_in()){ ?>
<script>
function drawnetwork(){
    var nodes = null;
    var edges = null;
    
    var DIR = '<?php echo get_bloginfo('template_directory').'/images/'; ?>';
    
    <?php
    global $wpdb;
    if($_GET['nid']){
        $group_id = $_GET['nid'];
    } else {
        $group_id = 4;
    }
    
            
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
        'posts_per_page' => -1,
        'meta_key' => 'netwrk_id',
        'meta_value' => $group_id
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
</script>
<div id="bodymaincontainer">
    <div id="mynetwork1" style="height: 600px;"></div>
    <a id="link_id1" class="various" href="#popupdiv" style="display: none;">Iframe</a>
    <a id="link_id2" class="various" href="#popupdivAdmin" style="display: none;"></a>
</div>
<script>
jQuery( window ).load(function() {
  drawnetwork();
});
</script>

<?php } else { header('Location: '.get_bloginfo('home').'/log-in'); } ?>
<?php get_footer(); ?>