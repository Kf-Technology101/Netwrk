<?php /* Template Name: Create Node Members */ ?>
<?php get_header(); ?>
<?php if(is_user_logged_in()){ ?>
<?php
global $user_ID;
$user_role = get_user_role($user_ID);

if($user_role == 'groupadmin') {
?>
<script>
function add_user_to_netwrk(){
    var nodes = null;
    var edges = null;
    var netwrk = null;
    //nodes = [];
    edges = [];
    var DIR = '<?php echo get_bloginfo('template_directory').'/images/'; ?>';
    <?php
    global $wpdb;
    $group_id = $_GET['nid'];
            
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
                {from: <?php echo $r2->meta_value; ?>, to: <?php echo $r2->user_id; ?>, dashes:true},
                <?php } ?>
            <?php } ?>
        <?php } ?>
    ]);
    
    
    // create a network
    var container = document.getElementById('add_user_netwrk');
    var data = {
        nodes: nodes,
        edges: edges
    };
    var options = {};
    var network = new vis.Network(container, data, options);
    
    network.on("click", function (params) {
        params.event = "[event]";
        var new_user_id = <?php echo $_GET['nodeid']; ?>;
        var clicked_user_id = params.nodes;
        if(new_user_id != clicked_user_id){
            var array_length = clicked_user_id.length;
            if(array_length == 1){
                jQuery.ajax({
                    url: hostname+"/create-edge",
                    type: "post",
                    cache: false,
                    data: {"new_user_id": new_user_id, "clicked_user_id": clicked_user_id[0]},
                    success: function(response){
                        alert('User linked');
                        window.location.href="http://netwrkdemo.coregensolutions.com/dwnetwrk?nid="<?php echo $group_id; ?>;
                    }
                });
            }
        }
    });
}
</script>

<div id="bodymaincontainer">
	<div class="maincontent">
    <!-- 
    
	    <div class="section group">
            <div class="col span_3_of_12"></div>
            <div class="col span_6_of_12"><div class="setCenter">
                <div class="innerHeader" style="background: none;">
                    <div class="innerlogo"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" /></div>
                    <p style="text-align: center;">Add New Contact</p>
                </div>
                
                <div class="loginbox1" style="margin: 0;">
                    
                </div>
            </div>
            </div>
            <div class="col span_3_of_12"></div>
	    </div>
     -->
        <div class="section group">
            <div class="col span_12_of_12">
                <div id="add_user_netwrk" style="height: 600px;"></div>
            </div>
        </div>
	</div>
</div>
<script>
jQuery( window ).load(function() {
  // Handler for .load() called.
  add_user_to_netwrk();
});
</script>
<?php } ?>
<?php } else { header('Location: '.get_bloginfo('home').'/log-in'); } ?>
<?php get_footer(); ?>