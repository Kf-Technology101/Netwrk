<?php /* Template Name: Edit Profile Template */ ?>
<?php
                        if(isset($_POST['updateprofile'])){
                            if(get_user_meta($user_ID, 'your_day', true) == ''){
                                add_user_meta($user_ID, 'your_day', $_POST['your_day']);
                            } else {
                                update_user_meta($user_ID, 'your_day', $_POST['your_day']);
                            }
                            if(get_user_meta($user_ID, 'working_on', true) == ''){
                                add_user_meta($user_ID, 'working_on', $_POST['working_on']);
                            } else {
                                update_user_meta($user_ID, 'working_on', $_POST['working_on']);
                            }
                            if(get_user_meta($user_ID, 'about', true) == ''){
                                add_user_meta($user_ID, 'about', $_POST['about']);
                            } else {
                                update_user_meta($user_ID, 'about', $_POST['about']);
                            }
                            
                            wp_update_user( array( 'ID' => $user_ID, 'about' => $_POST['about'] ) );
                            //wp_update_user( array( 'ID' => $user_ID, 'about' => $_POST['about'] ) );
                            
                            if(($_POST['pwd1'] === $_POST['pwd2']) && (!empty($_POST['pwd1']))){
                                wp_set_password( $_POST['pwd1'], $user_ID );
                            }
                            
                            /*$file_exts = array("jpg","jpeg","png","gif");
                            $upload_exts1 = strtolower(end(explode(".", $_FILES['avatar']['name'])));
                            $file_name1 = preg_replace("/[\s]+/", "", $_FILES['avatar']['name']);
                            if (($_FILES["avatar"]["size"] < 4000000) && in_array($upload_exts1, $file_exts)){
                                $date = date('Ymd');
                                $time = time();
                                $filename1 = $date.'_'.$time.'_'.($file_name1);
                                
                                $upload_dir = wp_upload_dir();
                                $uploaddir = $upload_dir['basedir'].'/profileimages/';
                                $file = $uploaddir . $date.'_'.$time.'_'.($file_name1);
                                $file2 = $uploaddir . 's_'.$date.'_'.$time.'_'.($file_name1);
                                
                                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $file)) {
                                    update_user_meta($user_ID, 'avatar', $filename1);
                                }
                            }*/
                            require_once(ABSPATH . "wp-admin" . '/includes/image.php'); 
                            require_once(ABSPATH . "wp-admin" . '/includes/file.php'); 
                            require_once(ABSPATH . "wp-admin" . '/includes/media.php');
                            
                            $keys = array_keys($_FILES);
                            foreach ( $_FILES as $image ) {   // if a files was upload   
                            if ($image['size']) {     // if it is an image     
                                if ( preg_match('/(jpg|jpeg|png|gif)$/', $image['type']) ) {       
                                    $override = array('test_form' => false);       // save the file, and store an array, containing its location in $file       
                                    $file = wp_handle_upload( $image, $override );
                                    $attachment = array(
                                        'post_title' => $image['name'],
                                        'post_content' => '',
                                        'post_type' => 'attachment',
                                        'post_mime_type' => $image['type'],
                                        'guid' => $file['url']
                                    ); 
                                    $attach_id = wp_insert_attachment( $attachment, $file[ 'file' ]);
                                    $attach_data = wp_generate_attachment_metadata( $attach_id, $file['file'] );
                                    wp_update_attachment_metadata( $attach_id, $attach_data );
                                     
                                    //add_user_meta($new_user_id, 'profile_pic', $attach_id); 
                                    update_user_meta($user_ID, 'avatar', $attach_id);    
                                } else {       // Not an image.        
                                    // Die and let the user know that they made a mistake.       
                                    wp_die('No image was uploaded.');     
                                    }   
                                }  
                            } // end of foreach
                        }
                        
                        $user_info = get_userdata($user_ID);
                        $upload_dir = wp_upload_dir();
                        $uploaddir = $upload_dir['baseurl'].'/profileimages/';
                        
                    ?>
<?php get_header(); ?>
<?php if(is_user_logged_in()){ ?>
<div id="bodymaincontainer">
	<div class="maincontent">
	    <div class="section group">
            <div class="col span_3_of_12"><h1></h1></div>
            <div class="col span_6_of_12">
                <div class="profilebox">
                    
                    <div style="padding: 10px;">
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="section group">
                                <div class="col span_1_of_2">
                                    <div class="profile1">
                                        <ul>
                                            <li>
                                                <div class="proImgBig">
                                                <?php echo get_image_size_100_100($user_ID); ?>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col span_1_of_2">
                                    <div class="profile2">
                                    <ul style="padding-top: 43px;">
                                        <li>
                                            <h3><?php echo get_the_author_meta('display_name', $user_ID); ?></h3>
                                            <input id="upload" type="file" name="avatar"/>
                                            <input type="hidden" name="MAX_FILE_SIZE" value="500" />
                                            <a id="upload_link" href="javascript:void(0);" class="linkcolor">Change Photo</a>
                                        </li>
                                    </ul>
                                    </div>
                                </div>
                            </div>
                        <div class="commonForm" style="padding: 0 5px 5px 5px;">
                            <!--
<div>
                                <label>Organisation</label>
                                <input class="fullwidth" type="text" name="organisation" value="<?php //echo get_user_meta($user_ID, 'organisation', true); ?>" />
                            </div>
-->
                            <div>
                                <label>How is your day?</label>
                                <input class="fullwidth" type="text" name="your_day" value="<?php echo get_user_meta($user_ID, 'your_day', true); ?>" />
                            </div>
                            <div>
                                <label>What are you working on?</label>
                                <input class="fullwidth" type="text" name="working_on" value="<?php echo get_user_meta($user_ID, 'working_on', true); ?>" />
                            </div>
                            <div>
                                <label>Name</label>
                                <input class="fullwidth" type="text" name="display_name" value="<?php echo $user_info->display_name; ?>" />
                            </div>
                            <div>
                                <label>Password</label>
                                <input class="fullwidth" type="password" name="pwd1" id="pwd1"  />
                            </div>
                            <div>
                                <label>Confirm Password</label>
                                <input class="fullwidth" type="password" name="pwd2" id="pwd2"  />
                            </div>
                            <div>
                                <label>About</label>
                                <textarea class="fullwidth" name="about"><?php echo get_user_meta($user_ID, 'about', true); ?></textarea>
                            </div>
                            <div>
                                <input type="submit" value="Save" name="updateprofile" />
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col span_3_of_12">
	    </div>
	</div>
</div>
<script>
(function($){
    $("#upload_link").on('click', function(e){
        e.preventDefault();
        $("#upload:hidden").trigger('click');
    });
    
    $('#register').validate({
        rules:{
            pwd1:{
                required: true,
                minlength: 8
            },
            pwd2:{
                required: true,
                minlength: 8,
                equalTo: '#pwd1'
            }
        }
    })
})(jQuery);
</script>
<?php } else { header('Location: '.get_bloginfo('home').'/log-in'); } ?>
<?php get_footer(); ?>