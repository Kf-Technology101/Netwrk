<?php /* Template Name: Get User Named */ ?>
<?php
$userid = $_POST['userid'];
$display_name = get_the_author_meta('display_name', $userid );
echo $display_name;
?>