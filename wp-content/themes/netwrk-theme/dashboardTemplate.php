<?php /* Template Name: Dashboard Template */ ?>
<?php get_header(); ?>
<?php 
if(is_user_logged_in()){ 
    global $user_ID;
    $user_role = get_user_role($user_ID);    
?>
<div class="userDashboard">
    <div class="maincontent">
        <div class="section group">
            <div class="col span_2_of_12"></div>
            <div class="col span_8_of_12">
                <div class="dashboardTable">
                    <table>
                        <tr>
                            <td>
                                <h1>Talking</h1>
                                <div class="talking">
                                    <ul>
                                    <?php
                                    global $wpdb;
                                    $table_name_chat = $wpdb->prefix.'chat';
                                    
                                    $chat_sql = "SELECT DISTINCT from_user FROM $table_name_chat WHERE to_user = $user_ID AND recd = 0";
                                    $chat_result = $wpdb->get_results($chat_sql);
                                    
                                    if ( ! empty( $chat_result ) ) {
                                        foreach ( $chat_result as $r ) {
                                    ?>
                                    <li>
                                        <div class="profileImg <?php echo $r->from_user; ?>">
                                            <a href="javascript:void(0)" onclick="chatWith(<?php echo $r->from_user; ?>,'<?php echo get_the_author_meta('display_name', $r->from_user ); ?>')">
                                                <?php echo get_image_size_50_50($r->from_user); ?>
                                            </a>
                                        </div>
                                    </li>
                                    <?php } } ?>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="mainBlock">
                                    <div class="userProfile">
                                        <table>
                                            <tr>
                                                <td>
                                                    <div class="chatClass">
                                                        <div class="counting"><?php echo chat_count($user_ID); ?></div>
                                                        <i class="fa fa-comment-o"></i>
                                                   </div> 
                                                </td>
                                                <td class="centerAligned">
                                                    <div class="logo"><a href="<?php bloginfo('url'); ?>/geo-map"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" /></a></div>
                                                    <div class="profilePic" style="position: relative;">
                                                        <div class="editProfile"><a href="<?php bloginfo('url'); ?>/edit-profile">Edit</a></div>
                                                        <?php echo get_image_size_100_100($user_ID); ?>
                                                    </div>
                                                    <div class="display_name"><?php echo get_the_author_meta( 'display_name', $user_ID ); ?></div>
                                                </td>
                                                <td>
                                                    <div class="mailClass">
                                                        <div class="counting"><?php echo email_count($user_ID); ?></div>
                                                        <a href="<?php bloginfo('url'); ?>/mailbox"><i class="fa fa-envelope-o"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="netwrkFeed">
                                        <div class="normaltext"><?php echo get_user_meta($user_ID, 'your_day', true); ?></div>
                                        <div class="normaltext"><?php echo get_user_meta($user_ID, 'working_on', true); ?></div>
                                        <br />
                                        <div>
                                            <h1>Netwrk Feed</h1>
                                            <div class="netwrkSection">
                                                <h2><?php echo get_the_author_meta('display_name', $user_ID); ?>’s Network</h2>
                                                <table>
                                                <?php
                                                    $post_arg = array(
                                                        'post_stats' => 'publish',
                                                        'post_type' => 'post',
                                                        'posts_per_page' => 3,
                                                    );
                                                    
                                                    $the_query = new WP_Query( $post_arg );
                                                    if ( $the_query->have_posts() ) :
                                                        while ( $the_query->have_posts() ) : $the_query->the_post();
                                                ?>
                                                    <tr>
                                                        <td><a href="<?php bloginfo('url') ?>/view-dw/?pid=<?php echo get_the_ID(); ?>"><?php echo string_limit_words(get_the_title(get_the_ID()),3); ?></a></td>
                                                        <td><a href="<?php bloginfo('url') ?>/view-dw/?pid=<?php echo get_the_ID(); ?>"><?php echo limitcontent_by_id(6, get_the_ID()); ?></a></td>
                                                    </tr>
                                                <?php
                                                        endwhile;
                                                    endif;
                                                ?>
                                                <?php wp_reset_postdata(); ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h1>Mails</h1>
                                <div class="talking">
                                    <ul>
                                    <?php
                                    global $wpdb;
                                    $table_name_mail = $wpdb->prefix.'mails';
                                    
                                    $mail_sql = "SELECT DISTINCT sender_id FROM $table_name_mail WHERE receiver_id = $user_ID AND read_status = 0";
                                    $result = $wpdb->get_results($mail_sql);
                                    
                                    if ( ! empty( $result ) ) {
                                        foreach ( $result as $r ) {
                                            $mail_sql2 = "SELECT count(*) AS mail_count FROM $table_name_mail WHERE receiver_id = $user_ID AND sender_id = ".$r->sender_id." AND read_status = 0";
                                            $resul2 = $wpdb->get_results($mail_sql2);
                                            if(!empty($resul2[0]->mail_count)){
                                    ?>
                                    <li>
                                        <div class="profileImg">
                                            <div class="mailCount"><?php echo $resul2[0]->mail_count; ?></div>
                                            <a href="<?php bloginfo('url'); ?>/all-mails?uid=<?php echo $r->sender_id; ?>">
                                                <?php echo get_image_size_50_50($r->sender_id); ?>
                                            </a>
                                        </div>
                                    </li>
                                    <?php } else { ?>
                                    <li>
                                        <div class="profileImg">
                                            <a href="<?php bloginfo('url'); ?>/all-mails?uid=<?php echo $r->sender_id; ?>">
                                                <?php echo get_image_size_50_50($r->sender_id); ?>
                                            </a>
                                        </div>
                                    </li>
                                    <?php } ?>
                                    <?php } } ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col span_2_of_12"></div>
        </div>
    </div>
</div>
<?php } else { header('Location: '.get_bloginfo('home').'/log-in'); } ?>
<?php get_footer(); ?>