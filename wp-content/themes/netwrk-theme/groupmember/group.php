<div id="bodymaincontainer">
	<div class="maincontent">
	    <div class="section group">
            <?php
                global $wpdb;
                global $user_ID;
                
                $upload_dir = wp_upload_dir();
                $uploaddir = $upload_dir['baseurl'].'/groupimg/';
                            
                $table_name = $wpdb->prefix.'groups';
                $sql = "SELECT * FROM $table_name";
                $results = $wpdb->get_results($sql);
                
                foreach($results as $r){
                    if($r->id == get_user_meta($user_ID, 'group_joined', true)){
            ?>
            <div class="col span_3_of_12">
                <div class="groupbox">
                    <a href="<?php bloginfo('url'); ?>/network?gid=<?php echo $r->id; ?>"><img src="<?php echo $uploaddir.$r->group_img; ?>" /></a>
                </div>
                <div style="text-align: center;"><?php echo $r->group_name; ?></div>
            </div>
                <?php } // end of if loop ?>
            <?php } // end of foreach ?>
	    </div>
	</div>
</div>