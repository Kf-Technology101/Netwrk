<?php /* Template Name: Create Edge */ ?>
<?php
$new_user_id = $_POST['new_user_id'];
$clicked_user_id = $_POST['clicked_user_id'];
update_user_meta($new_user_id, 'parent_member', $clicked_user_id);
?>