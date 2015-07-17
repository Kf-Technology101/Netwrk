<?php /* Template Name: Groups Template */ ?>
<?php get_header(); ?>
<?php if(is_user_logged_in()){ ?>
<?php
global $user_ID;
$user_role = get_user_role($user_ID);

if($user_role == 'groupmember'){
    get_template_part( 'groupmember/group' );
}
if($user_role == 'groupadmin') {
    get_template_part( 'groupadmin/group' );
}
?>
<?php } else { header('Location: '.get_bloginfo('home').'/log-in'); } ?>
<?php get_footer(); ?>