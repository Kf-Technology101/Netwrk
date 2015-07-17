<?php /* Template Name: Mailbox Template */ ?>
<?php get_header(); ?>
<?php 
if(is_user_logged_in()){ 
    global $user_ID;
    $user_role = get_user_role($user_ID);    
?>
<div class="mymailbox">
    <div class="maincontent">
        <div class="section group">
            <div class="col span_4_of_12"></div>
            <div class="col span_4_of_12">
                <div class="setCenter mailbox">
                <?php get_template_part('innerheader1'); ?>
                    <ul>
                    <?php
                        global $wpdb;
                        $table_name_mail = $wpdb->prefix.'mails';
                        $mail_sql = "SELECT * FROM $table_name_mail WHERE receiver_id = $user_ID ORDER BY id DESC";
                        $result = $wpdb->get_results($mail_sql);
                        //print_r($result);
                        if ( ! empty( $result ) ) {
                            foreach ( $result as $r ) {
                    ?>
                    <?php if($r->read_status == 0){ ?>
                        <li><a href="<?php bloginfo('url'); ?>/view-mail/?uid=<?php echo $r->sender_id; ?>&mid=<?php echo $r->id; ?>"><strong><?php echo $r->subject; ?></strong></a></li>
                    <?php } else { ?>
                        <li><a href="<?php bloginfo('url'); ?>/view-mail/?uid=<?php echo $r->sender_id; ?>&mid=<?php echo $r->id; ?>"><?php echo $r->subject; ?></a></li>
                    <?php } ?>
                        
                        <?php } ?>
                    <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col span_4_of_12"></div>
        </div>
    </div>
</div>
<?php } else { header('Location: '.get_bloginfo('home').'/log-in'); } ?>
<?php get_footer(); ?>