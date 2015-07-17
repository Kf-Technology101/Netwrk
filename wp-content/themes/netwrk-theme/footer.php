<?php if(is_user_logged_in()){ ?>
<?php global $user_ID; ?>
<div class="dashboard-icon">
        <div id="createNetwrk" style="display: none;">
            <?php
                if(isset($_POST['createNetwrk'])){
                    $post_arg = array(
                        'post_title'     => $_POST['netwrk-name'],
                        'post_status'    => 'publish',
                        'post_type'      => 'netwrk',
                        'post_author'    => $user_ID,
                        'post_content'   => $_POST['netwrk-description'],
                        'post_date'      => date('Y-m-d H:i:s'),
                    );
                    
                    $netwrk_id = wp_insert_post( $post_arg );
                    add_user_meta($user_ID, 'group_joined', $netwrk_id);
                    header('Location: '.get_bloginfo('home').'/dwnetwrk/?nid='.$netwrk_id);
                }
            ?>
            <div class="popupProfileImg"><img src="<?php echo get_image_size_30_30($user_ID); ?>" /></div>
            <form method="post" action="">
                <div class="commonForm">
                    <div>
                        <label style="text-align: center;">Netwrk Name</label>
                        <input type="text" name="netwrk-name" />
                    </div>
                    <div>
                        <label style="text-align: center;">Netwrk Description</label>
                        <textarea name="netwrk-description"></textarea>
                    </div>
                    <div style="text-align: center;">
                        <input type="submit" name="createNetwrk" value="Create" />
                    </div>
                </div>
            </form>
        </div>
        <div id="getAllNetwrk" style="display: none;">
            <h1 style="text-align: center;">My Networks</h1>
            <?php
                $table_name2 = $wpdb->prefix.'usermeta';
                $query_netwrk = array(
                    'post_type' => 'netwrk',
                    'author' => $user_ID,
                    'post_status' => 'publish',
                    'orderby'=>'date',
                    'order'=>'DESC'
                );
                query_posts($query_netwrk);
            ?>
            <?php if ( have_posts() ) { ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="netwrklist"><a href="<?php bloginfo('url'); ?>/dwnetwrk?nid=<?php echo get_the_ID(); ?>"><?php the_title(); ?></a></div>
            <?php endwhile ?>
            <?php } else { ?>
                <div><p style="text-align: center;">No Netwrk Created</p></div>
            <?php } ?>
            <?php wp_reset_query(); ?>
            <br />
            <h1 style="text-align: center;">Networks Joined</h1>
            <?php query_posts($query_netwrk); ?>
            <?php if ( have_posts() ) { ?>
            <?php while ( have_posts() ) : the_post(); ?>
            <?php
                $group_id = get_the_ID();
                $nonetwrk = 0;
                $sql1 = "SELECT * FROM $table_name2 WHERE meta_key = 'group_joined' AND meta_value = ".$group_id;
                $results1 = $wpdb->get_results($sql1);
                foreach($results1 as $rs){
                    if($rs->meta_value != $group_id){
            ?>
                        <div class="netwrklist"><a href="<?php bloginfo('url'); ?>/dwnetwrk?nid=<?php echo $rs->meta_value; ?>"><?php echo get_the_title($rs->meta_value); ?></a></div>
            <?php
                    } else { 
                        $nonetwrk ++;
                    }
                }
            ?>
            
            <?php endwhile ?>
            <?php } else { ?>
            <?php if(!empty($nonetwrk)){ ?>
                <div><p style="text-align: center;">No Netwrk Joined</p></div>
            <?php } ?>
            <?php } ?>
            <?php wp_reset_query(); ?>
            
        </div>
        <div id="dashboard_menu" style="display: none;">
            <ul>
                <!--
<li><a href="<?php bloginfo('url'); ?>/geo-map">Map</a></li>
-->
                <li style="border-bottom: none;"><a href="<?php bloginfo('url'); ?>/my-dashboard/">Dashboard</a></li>
                <li></li>
            </ul>
        </div>
        <img src="<?php bloginfo('template_directory'); ?>/images/dashboard-icon.png" usemap="#dashboardMap" />
        <map name="dashboardMap" id="dashboardMap">
            <area class="various1" alt="" title="" href="#createNetwrk" shape="poly" coords="42,75,1,74,4,61,7,49,14,35,26,20,41,12,45,9,53,7,61,4,71,3,74,4,74,16,75,30,74,42,62,40,53,44,49,50,45,56,39,67" />
            <area class="various2" alt="" title="" href="#getAllNetwrk" shape="poly" coords="149,75,112,75,109,66,107,58,103,54,101,51,98,50,95,44,89,42,78,40,76,2,85,1,97,3,110,9,123,19,134,30,145,46" />
            <area id="dashboard_link" title="" href="javascript:void(0);" shape="poly" coords="45,74,44,63,51,53,57,47,71,43,80,43,93,48,103,59,107,64,109,69,109,75" />
        </map>
    </div>
<?php } ?>
<div id="footerBlock">
	<div class="maincontent">
	    <div class="section group">
	        <div class="col span_12_of_12">
                <div style="font-size: 10px; text-align: center;">Copyright © <?php echo date('Y');?> NETWRK</div>                       
	        </div>
	    </div>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>