<div id="bodymaincontainer1">
	<div class="maincontent">
	    <div class="section group">
            <div class="col span_4_of_12"></div>
            <div class="col span_4_of_12">
                <?php get_template_part('innerheader'); ?>
                <?php
                $groupadmin_query = new WP_User_Query(
                	array(
                		'role'			    =>	'groupadmin'
                	)
                );
                $groupadmin = $groupadmin_query->get_results();
                
                // get the featured admins
                $groupmember_query = new WP_User_Query(
                	array(
                		'role'			    =>	'groupmember'
                	)
                );
                $groupmember = $groupmember_query->get_results();
                
                // store them all as users
                $users = array_merge( $groupadmin, $groupmember );
                ?>
                
                <div class="section group">
                    <div class="col span_4_of_12">
                        <h1>Talking</h1>
                        <ul>
                            <?php
                                if ( ! empty( $users ) ) {
                                    foreach ( $users as $user ) {
                            ?>
                            <li>
                                <div class="profileImg">
                                    <a href="javascript:void(0)" onclick="chatWith(<?php echo $user->ID; ?>)">
                                        <img src="<?php echo get_profile_pic($user->ID); ?>" />
                                    </a>
                                </div>
                            </li>
                            <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="col span_4_of_12">
                        <h1>DW</h1>
                    </div>
                    <div class="col span_4_of_12">
                        <h1>Mail</h1>
                        <ul>
                            <?php
                                if ( ! empty( $users ) ) {
                                    foreach ( $users as $user ) {
                            ?>
                            <li>
                                <div class="profileImg">
                                    <a href="<?php bloginfo('url'); ?>/all-mails?uid=<?php echo $user->ID; ?>">
                                        <img src="<?php echo get_profile_pic($user->ID); ?>" />
                                    </a>
                                </div>
                            </li>
                            <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col span_4_of_12"></div>
    	</div>
    </div>
</div>