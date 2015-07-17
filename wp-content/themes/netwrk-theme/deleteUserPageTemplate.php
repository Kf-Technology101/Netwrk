<?php /* Template Name: Delete User */ ?>
<?php
$userid = $_GET['uid'];
require_once(ABSPATH.'wp-admin/includes/user.php' );
wp_delete_user( $userid );
header('Location: '.get_bloginfo('home').'/geo-map');
?>