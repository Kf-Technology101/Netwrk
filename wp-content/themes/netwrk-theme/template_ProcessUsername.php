<?php /* Template Name: Process Username */ ?>
<?php
    $userid = $_POST['userid'];
    $display_name = get_the_author_meta( 'display_name', $userid );
    echo $display_name;
?>