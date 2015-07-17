<?php /* Template Name: Chat Template */ ?>
<?php get_header(); ?>
<?php if(is_user_logged_in()){ ?>
<?php
    global $user_ID;
    $user_id = $_GET['cuid'];
    $sender_id = $_GET['sid'];
    $receiver_id = $user_ID;
?>
<div id="allMails">
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
                <div class="createMail">
                <?php if(isset($_POST['createmessage'])){
                        send_message($_POST['subject'], $_POST['messagetextbody'], $_POST['sender_id'], $_POST['receiver_id'] );
                        $noerror = 1; 
                    }
                ?>
                    <form method="post" action="">
                        <table>
                            <tr>
                                <td><div class="senderProfilePic"><img src="<?php echo get_profile_pic($sender_id); ?>" /></div></td>
                                <td><input type="text" name="subject" /></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><textarea name="messagetextbody"></textarea></td>
                            </tr>
                            <tr>
                                <td><div class="senderProfilePic"><img src="<?php echo get_profile_pic($receiver_id); ?>" /></div></td>
                                <td>
                                    <input type="hidden" name="sender_id" value="<?php echo $user_ID; ?>" />
                                    <input type="hidden" name="receiver_id" value="<?php echo $_GET['sid']; ?>" />
                                    <input type="submit" name="createmessage" value="Send" />
                                </td>
                            </tr>
                        </table>
                    </form>
                    <?php if($noerror == 1){ ?>
                        <div class="successMsg">Mail Send</div>
                    <?php } ?>
                </div>
            </div>
        </div></div>
        <div class="col span_3_of_12"></div>
    </div>
</div>
<?php } else { header('Location: '.get_bloginfo('home').'/log-in'); } ?>
<?php get_footer(); ?>