<?php /* Template Name: Create Conversation Template */ ?>
<?php get_header(); ?>
<?php if(is_user_logged_in()){ ?>
<?php
    global $user_ID;
    $receiver_id = $user_ID;
?>
<div id="allMails">
    <div class="maincontent">
    <div class="section group">
        <div class="col span_3_of_12"></div>
        <div class="col span_6_of_12"><div class="setCenter">
            <div class="innerHeader" style="background: none;">
                <div class="innerlogo"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" /></div>
                <p style="text-align: center;">Start New Conversation</p>
            </div>
            <!-- <div class="adminsection"> -->
                <!-- <div class="innerlogo"> -->
                    <?php
                        if(isset($_POST['createconversation'])){
                            $post = array(
                                 'post_author' => $user_ID,
                                 'post_content' => $_POST['message'],
                                 'post_status' => "publish",
                                 'post_title' => $_POST['dwtitle'],
                                 'post_parent' => '',
                                 'post_type' => "post",
                                 );
                            $post_id = wp_insert_post( $post, $wp_error );
                            add_post_meta($post_id, 'netwrk_id', $_POST['nid']);
                            if($post_id){
                                //header("Location: ".get_bloginfo('home')."/network/?gid=4");
                                header('Location: '.get_bloginfo('home').'/dwnetwrk/?nid='.$_POST['nid']);
                            }
                        }
                    ?>
                    <div class="loginbox1" style="margin: 0;">
                    <div class="commonForm" style="padding: 0 5px 5px 5px;">
                        <form method="post" action="">
                            <div>
                                <input type="text" style="width: 100%;" name="dwtitle" placeholder="Title" />
                            </div>
                            <div>
                                <textarea name="message" placeholder="Your Message"></textarea>
                            </div>
                            <div>
                                <input type="hidden" name="nid" value="<?php echo $_GET['nid']; ?>" />
                                <input type="submit" name="createconversation" value="Create Conversation" />
                            </div>
                        </form>
                    </div>
                    </div>
                <!-- </div> -->
            <!-- </div> -->
        </div></div>
        <div class="col span_3_of_12"></div>
    </div>
    </div>
</div>
<?php } else { header('Location: '.get_bloginfo('home').'/log-in'); } ?>
<?php get_footer(); ?>