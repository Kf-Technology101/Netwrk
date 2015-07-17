<?php /* Template Name: View Mail Template */ ?>
<?php get_header(); ?>
<?php if(is_user_logged_in()){ ?>
<?php
    global $user_ID;
    $user_id = $_GET['uid'];
    $sender_id = $_GET['uid'];
    $mail_id = $_GET['mid'];
    $receiver_id = $user_ID;
?>
<div id="allMails">
    <div class="maincontent">
    <div class="section group">
        <div class="col span_4_of_12"></div>
        <div class="col span_4_of_12">
            <div class="setCenter">
            <?php get_template_part('innerheader'); ?>
            <div class="innerbody">
                <div class="mailicons">
                    <span><a href="<?php bloginfo('url'); ?>/search-mail"><i class="fa fa-search"></i></a></span>
                    <span><a href="<?php bloginfo('url'); ?>/create-mail?sid=<?php echo $sender_id; ?>"><i class="fa fa-pencil-square-o"></i></a></span>
                </div>
                <div class="createMail">
                <?php if(isset($_POST['createmessage'])){
                        send_message($_POST['subject'], $_POST['messagetextbody'], $_POST['receiver_id'], $_POST['sender_id'] );
                        $noerror = 1; 
                    }
                    
                    global $wpdb;
                    $table_name = $wpdb->prefix.'mails';
                    
                    // update mails read status
                    $sql1 = "UPDATE $table_name SET read_status = 1 WHERE id = $mail_id";
                    $wpdb->query($sql1);
                    
                    $sql = "SELECT * FROM $table_name WHERE id = $mail_id";
                    $results = $wpdb->get_results($sql);
                    //print_r($results);
                    foreach($results as $r){
                ?>
                    <form method="post" action="">
                        <table>
                            <tr>
                                <td><div class="senderProfilePic"><?php echo get_small_profile_pic($sender_id); ?></div></td>
                                <td><p><?php echo $r->subject; ?></p></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><p><?php echo $r->message_body; ?></p></td>
                            </tr>
                            <tr>
                                <td><div class="senderProfilePic"><?php echo get_small_profile_pic($receiver_id); ?></div></td>
                                <td>
                                    <p><textarea name="messagetextbody" placeholder="Reply"></textarea></p>
                                    <input type="hidden" name="subject" value="Re: <?php echo $r->subject; ?>" />
                                    <input type="hidden" name="sender_id" value="<?php echo $user_ID; ?>" />
                                    <input type="hidden" name="receiver_id" value="<?php echo $r->sender_id; ?>" />
                                    <input type="submit" name="createmessage" value="Send" />
                                </td>
                            </tr>
                        </table>
                    </form>
                    <?php } ?>
                    <?php if($noerror == 1){ ?>
                        <div class="successMsg">Mail Send</div>
                    <?php } ?>
                </div>
            </div>
        </div></div>
        <div class="col span_4_of_12"></div>
    </div>
    </div>
</div>
<?php } else { header('Location: '.get_bloginfo('home').'/log-in'); } ?>
<?php get_footer(); ?>