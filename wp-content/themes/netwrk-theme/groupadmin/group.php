<div id="bodymaincontainer">
	<div class="maincontent">
	    <div class="section group">
            <div class="col span_12_of_12">
                <div class="section group">
                    <div class="col span_12_of_12">
                        <div style="text-align: right;"><a href="<?php bloginfo('url'); ?>/add-new-group" class="aButton">Add New Group</a></div><br /><br />
                    </div>
                </div>
            </div>
            <div class="section group">
                <div class="col span_12_of_12">
                    <div class="groups">
                        <ul>
                        <?php
                            global $wpdb;
                            global $user_ID;
                            
                            $upload_dir = wp_upload_dir();
                            $uploaddir = $upload_dir['baseurl'].'/groupimg/';
                            
                            $table_name = $wpdb->prefix.'groups';
                            $sql = "SELECT * FROM $table_name WHERE group_owner_id = ".$user_ID;
                            $results = $wpdb->get_results($sql);
                            
                            foreach($results as $r){
                        ?>
                            <li>
                                <table style="margin-bottom: 0;">
                                    <tr>
                                        <td style="width: 120px;"><a href="<?php bloginfo('url'); ?>/network?gid=<?php echo $r->id; ?>"><img src="<?php echo $uploaddir.$r->group_img; ?>" /></a></td>
                                        <td style="width: 150px;"><?php echo $r->group_name; ?></td>
                                        <td><?php echo rand(1,99); ?></td>
                                        <td><div style="text-align: right;"><a href="javascript:void(0);" class="aButton">Delete</a></div></td>
                                    </tr>
                                </table>
                            </li>
                        <?php } // end of foreach ?>
                        </ul>
                    </div>
                </div>
            </div>
	    </div>
	</div>
</div>