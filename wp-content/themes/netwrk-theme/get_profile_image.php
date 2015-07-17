<?php /* Template Name: Get Profile Image */ ?>
<?php
$user_id = $_POST['userid'];
$attachment_id = get_user_meta($user_id[0], 'avatar', true);
$image_attributes = wp_get_attachment_image_src( $attachment_id, 'image_size_100_100' );
if(!empty($image_attributes[0])){
    $return_img = '<img style="max-width: 100px; border-radius: 50%; border: 3px solid #8c8c8c;" src="'.$image_attributes[0].'" />';
} else {
    $return_img = '<img style="max-width: 100px; border-radius: 50%; border: 3px solid #8c8c8c;" src="'.get_bloginfo('template_directory').'/images/profile1.png" />';
}
echo $return_img;
?>