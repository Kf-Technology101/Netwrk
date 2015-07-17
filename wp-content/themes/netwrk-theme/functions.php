<?php 
add_filter('wp_mail_from_name', 'new_mail_from_name'); 
function new_mail_from_name($old) {
	$site_title = get_bloginfo( 'name' );
	return $site_title;
}
if (!current_user_can('administrator')):
show_admin_bar(false);
endif;
add_role('groupmember', 'Group Member');
add_role('groupadmin', 'Group Admin');
add_theme_support( 'post-thumbnails' );

function get_user_role($userid){ 
	$user_info = get_userdata($userid);
 	$role = implode(', ', $user_info->roles);
 	return $role;
}

function encripted($data){
	$key1 = '644CBEF595BC9';
	$final_data = $key1.'|'.$data;
	$val = base64_encode(base64_encode(base64_encode($final_data)));
	return $val;
}
function decripted($data){
	$val = base64_decode(base64_decode(base64_decode($data)));
	$final_data = explode('|', $val);
	return $final_data[1];
}

function remove_core_updates(){
    global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','remove_core_updates');
add_filter('pre_site_transient_update_plugins','remove_core_updates');
add_filter('pre_site_transient_update_themes','remove_core_updates');

register_nav_menus( array(
    'mainmenu' => __( 'Main Menu'),
    'footermenu' => __('Footer Menu')
));

register_sidebar(array('name'=>'Sidebar',
'before_widget' => '<div>',
'after_widget' => '</div>',
'before_title' => '<h2">',
'after_title' => '</h2>',
));

add_theme_support( 'post-thumbnails' );
add_image_size( 'homepage-thumb', 288, 151, true );
add_image_size( 'image_size_30_30', 30, 30, array('center', 'center'), true );
add_image_size( 'image_size_100_100', 100, 100, array('center', 'center'), true );
add_image_size( 'image_size_50_50', 50, 50, array('center', 'center'), true );

function limitcontent_by_id($limit, $postid) {
    $post = get_page($postid);
    $fullContent = $post->post_content; 
    $content = explode(' ', $fullContent, $limit);
    if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
    } else {
        $content = implode(" ",$content);
    }
    $content = preg_replace('/\[.+\]/','', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}

function limitcontent($limit) {
    $content = explode(' ', get_the_content(), $limit);
    if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
    } else {
        $content = implode(" ",$content);
    }
    $content = preg_replace('/\[.+\]/','', $content);
    $content = apply_filters('the_content', $content); 
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}
function string_limit_words($string, $word_limit){
    $words = explode(' ', $string, ($word_limit + 1));
    if(count($words) > $word_limit)
        array_pop($words);
    return implode(' ', $words).'...';
}

function get_small_profile_pic($user_id){
    $attachment_id = get_user_meta($user_id, 'avatar', true);
    $image_attributes = wp_get_attachment_image_src( $attachment_id, 'image_size_30_30' );
    if(!empty($image_attributes[0])){
        $return_img = '<img style="max-width: 27px; border-radius: 50%; border: 1px solid #8c8c8c;" src="'.$image_attributes[0].'" />';
    } else {
        $return_img = '<img style="max-width: 27px; border-radius: 50%; border: 1px solid #8c8c8c;" src="'.get_bloginfo('template_directory').'/images/profile1.png" />';
    }
    return $return_img;
}

function get_image_size_50_50($user_id){
    $attachment_id = get_user_meta($user_id, 'avatar', true);
    $image_attributes = wp_get_attachment_image_src( $attachment_id, 'image_size_50_50' );
    if(!empty($image_attributes[0])){
        $return_img = '<img style="border-radius: 50%; border: 1px solid #8c8c8c;" src="'.$image_attributes[0].'" />';
    } else {
        $return_img = '<img style="border-radius: 50%; border: 1px solid #8c8c8c;" src="'.get_bloginfo('template_directory').'/images/profile1.png" />';
    }
    return $return_img;
}

function get_image_size_100_100($user_id){
    $attachment_id = get_user_meta($user_id, 'avatar', true);
    $image_attributes = wp_get_attachment_image_src( $attachment_id, 'image_size_100_100' );
    if(!empty($image_attributes[0])){
        $return_img = '<img style="max-width: 100px; border-radius: 50%; border: 1px solid #8c8c8c;" src="'.$image_attributes[0].'" />';
    } else {
        $return_img = '<img style="max-width: 100px; border-radius: 50%; border: 1px solid #8c8c8c;" src="'.get_bloginfo('template_directory').'/images/profile1.png" />';
    }
    return $return_img;
}

function get_image_size_30_30($user_id){
    $attachment_id = get_user_meta($user_id, 'avatar', true);
    $image_attributes = wp_get_attachment_image_src( $attachment_id, 'image_size_30_30' );
    if(!empty($image_attributes[0])){
        $return_img = $image_attributes[0];
    } else {
        $return_img = get_bloginfo('template_directory').'/images/noprofile.png';
    }
    return $return_img;
}

function get_profile_image_size_50_50($user_id){
    $attachment_id = get_user_meta($user_id, 'avatar', true);
    $image_attributes = wp_get_attachment_image_src( $attachment_id, 'image_size_50_50' );
    if(!empty($image_attributes[0])){
        $return_img = $image_attributes[0];
    } else {
        $return_img = get_bloginfo('template_directory').'/images/noprofile1.png';
    }
    return $return_img;
}

function send_message($subject, $message, $sender_id, $receiver_id){
      global $wpdb;
      $date = date('Y-m-d H:i:s');
      $table_name = $wpdb->prefix.'mails';
      $sql = "INSERT INTO $table_name(subject, message_body, message_time, sender_id, receiver_id, read_status) VALUES('".$subject."', '".$message."', '".$date."', '".$sender_id."', '".$receiver_id."', 0)";
      $wpdb->query($sql);
}

function dwcount($catid){
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'cat' => $catid
    );
    $the_query = new WP_Query( $args );
    $count = $the_query->post_count;
    return $count;
}

function email_count($receiver_id){
    global $wpdb;
    $table_name = $wpdb->prefix.'mails';
    $sql = "SELECT count(*) as mailcount FROM $table_name WHERE receiver_id = $receiver_id AND read_status = 0";
    $result = $wpdb->get_results($sql);
    return $result[0]->mailcount;
}

function chat_count($to_user){
    global $wpdb;
    $table_name = $wpdb->prefix.'chat';
    $sql = "SELECT count(*) as chatcount FROM $table_name WHERE to_user = $to_user AND recd = 0";
    $result = $wpdb->get_results($sql);
    return $result[0]->chatcount;
}
?>