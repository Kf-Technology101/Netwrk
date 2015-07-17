<?php
global $wpdb;
$table_name = $wpdb->prefix.'groups';
$query = "DELETE FROM $table_name WHERE id = ".$_GET['id'];
$results = $wpdb->query($query);
header('Location: '.get_bloginfo('home').'/wp-admin/admin.php?page=nwgroup-menu');
?>