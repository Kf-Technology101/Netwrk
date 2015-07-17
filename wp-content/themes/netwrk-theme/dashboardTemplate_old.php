<?php /* Template Name: Dashboard Template old */ ?>
<?php get_header(); ?>
<?php if(is_user_logged_in()){ ?>
<?php
global $user_ID;
$user_role = get_user_role($user_ID);

?>
<div id="bodymaincontainer1">
	<div class="maincontent">
	    <div class="section group">
            <div class="col span_3_of_12"></div>
            <div class="col span_6_of_12">
                <div class="dashboardBlock">
                <?php get_template_part('innerheader1'); ?>
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
                                <div class="profileImg <?php echo $user->ID; ?>">
                                    <a href="javascript:void(0)" onclick="chatWith(<?php echo $user->ID; ?>,'<?php echo get_the_author_meta('display_name', $user->ID ); ?>')">
                                        <?php echo get_image_size_50_50($user->ID); ?>
                                    </a>
                                </div>
                            </li>
                            <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="col span_4_of_12">
                        <h1>DW</h1>
                        <?php
                            $args = array(
                                'post_type' => 'post',
                                'post_status' => 'publish',
                            );
                            
                            $the_query = new WP_Query( $args );

                            if ( $the_query->have_posts() ) :
                            while ( $the_query->have_posts() ) : $the_query->the_post();
                        ?>
                        <ul>
                            <li class="<?php $author_id=$post->post_author; ?>">
                                <div class="dwicon" style="text-align: center; position: relative;">
                                    <a href="<?php bloginfo('url'); ?>/view-dw?pid=<?php echo get_the_ID(); ?>">
                                        <div class="dw_title"><?php echo get_the_title(); ?></div>
                                        <div class="dw_comments"><?php $comments_count = wp_count_comments( get_the_ID() ); echo $comments_count->total_comments; ?></div>
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <?php
                            endwhile;
                            endif;
                            
                            wp_reset_postdata();
                        ?>
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
                                        <?php echo get_image_size_50_50($user->ID); ?>
                                    </a>
                                </div>
                            </li>
                            <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
            <div class="col span_4_of_12"></div>
    	</div>
    </div>
</div>
<?php } else { header('Location: '.get_bloginfo('home').'/log-in'); } ?>
<?php get_footer(); ?>