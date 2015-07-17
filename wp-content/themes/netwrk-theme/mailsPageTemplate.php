<?php /* Template Name: All Mails Template */ ?>
<?php get_header(); ?>
<?php if(is_user_logged_in()){ ?>
<?php
    global $user_ID;
    $user_id = $_GET['uid'];
    $upload_dir = wp_upload_dir();
    $uploaddir = $upload_dir['baseurl'].'/profileimages/';
    $avatar = $uploaddir.get_user_meta($user_id, 'avatar', true);
    $sender_id = $_GET['uid'];
    $receiver_id = $user_ID;
?>
<div id="allMails">
    <div class="maincontent">
    <div class="section group">
        <div class="col span_3_of_12"></div>
        <div class="col span_6_of_12">
            <div class="setCenter">
            <?php get_template_part('innerheader'); ?>
            <div class="innerbody">
                <div class="mailicons">
                    <span><a href="<?php bloginfo('url'); ?>/search-mail"><i class="fa fa-search"></i></a></span>
                    <span><a href="<?php bloginfo('url'); ?>/create-mail?sid=<?php echo $sender_id; ?>"><i class="fa fa-pencil-square-o"></i></a></span>
                </div>
                <ul>
                <?php
                    global $wpdb;
                    $table_name = $wpdb->prefix.'mails';
                    
                    //$sql = "SELECT * FROM $table_name WHERE sender_id = $sender_id AND receiver_id = $receiver_id";
                    if($user_id == $user_ID){
                        $sql = "SELECT * FROM $table_name WHERE receiver_id = $user_ID";
                    } else {
                        $sql = "SELECT * FROM $table_name WHERE sender_id = $receiver_id AND receiver_id = $sender_id";
                    }
                    $results = $wpdb->get_results($sql);
                ?>
                    <?php if(!empty($results)){ ?>
                    <?php foreach($results as $r) { ?>
                    <li><a href="<?php bloginfo('url'); ?>/view-mail?uid=<?php echo $_GET['uid']; ?>&mid=<?php echo $r->id; ?>">
                        <table>
                            <tr>
                                <td style="width: 30px;">
                                    <div class="senderProfilePic"><?php echo get_small_profile_pic($r->sender_id); ?></div>
                                </td>
                                <td>
                                    <div class="msgSubject"><?php echo string_limit_words($r->subject,6).'...'; ?></div>
                                    <div class="msgSmallBody"><?php echo string_limit_words($r->message_body, 6).'...'; ?></div>
                                </td>
                                <td>
                                    <div class="time"></div>
                                </td>
                            </tr>
                        </table></a>
                    </li>
                    <?php } ?>
                    <?php } else { ?>
                    <li style="text-align: center;">Currently no message</li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        </div>
        <div class="col span_3_of_12"></div>
    </div>
    </div>
</div>
<?php } else { header('Location: '.get_bloginfo('home').'/log-in'); } ?>
<?php get_footer(); ?>