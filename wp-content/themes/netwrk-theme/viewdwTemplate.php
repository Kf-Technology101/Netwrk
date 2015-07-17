<?php /* Template Name: View DW Template */ ?>
<?php get_header(); ?>
<?php if(is_user_logged_in()){ ?>
<?php global $wpdb; global $user_ID; ?>
<div class="viewdw">
    <div class="maincontent">
        <div class="section group">
            <div class="col span_3_of_12"></div>
            <div class="col span_6_of_12">
                <div class="setCenter">
                <?php get_template_part('innerheader1'); ?>
                <div class="commonForm">
                <?php
                    if(isset($_POST['createmessage'])){
                            global $post;
                            $data = array(
                            	'comment_post_ID' => $_POST['postid'],
                            	'comment_author' => $_POST['yourname'],
                            	//'comment_author_email' => $_POST['youremail'],
                            	'comment_author_url' => '',
                            	'comment_content' => $_POST['messagetextbody'],
                            	'comment_author_IP' => $_SERVER['REMOTE_ADDR'],
                            	'comment_agent' => 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.6; fr; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3',
                            	'comment_date' => date('Y-m-d H:i:s'),
                            	'comment_date_gmt' => date('Y-m-d H:i:s'),
                            	'comment_approved' => 1,
                                'user_id' => $user_ID
                            );
                            
                            $comment_id = wp_insert_comment($data);
                            echo '<div class="successMsg">Thank you.</div>';
                        }
                        
                    $comments = get_comments('post_id='.$_GET['pid']);
                    
                    //print_r($comments);
                ?>
                    <form method="post" action="">
                        <table class="viewdwclass">
                            <tr style="background: #DDDDDD;">
                                <td style="padding: 10px;"><p><?php $id=$_GET['pid']; $post = get_page($id); $content = apply_filters('the_title', $post->post_title); echo $content;  ?></p></td>
                            </tr>
                            <tr style="background: #DDDDDD;">
                                <td style="padding: 10px;"><?php $id=$_GET['pid']; $post = get_page($id); $content = apply_filters('the_content', $post->post_content); echo $content;  ?></td>
                            </tr>
                            <?php foreach($comments as $comment) : ?>
                            <tr style="background: #EEEEEE;">
                                <td style="padding: 10px;">
                                    <table>
                                        <tr>
                                            <td style="width: 44px; vertical-align: top;"><div style="margin-top: 0; max-width: 35px;"><?php echo get_small_profile_pic($comment->user_id); ?></div></td>
                                            <td style="vertical-align: top;"><p><?php echo ($comment->comment_content); ?></p></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td>
                                    <p style="padding-bottom: 15px;"><textarea name="messagetextbody" placeholder="Reply"></textarea></p>
                                    <input type="hidden" name="postid" value="<?php echo $_GET['pid']; ?>" />
                                    <input type="hidden" name="yourname" value="<?php echo get_the_author_meta( 'display_name', $user_ID );; ?>" />
                                    <input type="submit" name="createmessage" value="Send" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            </div>
            <div class="col span_3_of_12"></div>
        </div>
    </div>
</div>
<?php } else { header('Location: '.get_bloginfo('home').'/log-in'); } ?>
<?php get_footer(); ?>