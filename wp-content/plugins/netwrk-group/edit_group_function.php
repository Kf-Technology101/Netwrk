<?php
$group_id = $_GET['id'];
global $wpdb;
$table_name = $wpdb->prefix.'groups';
$query = "SELECT * FROM $table_name WHERE id = ".$group_id;
$results = $wpdb->get_row($query);

//print_r($results->group_owner_id);

if(isset($_POST['group_img_nonce'], $_POST['editgroup']) && wp_verify_nonce( $_POST['group_img_nonce'], 'group_img' )){
    if ( ! function_exists( 'wp_handle_upload' ) ) {
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
    }
    $uploadedfile = $_FILES['group_img'];
    $upload_overrides = array( 'test_form' => false );

    $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
    
    if ( $movefile && !isset( $movefile['error'] ) ) {
        global $wpdb;
        $table_name = $wpdb->prefix.'groups';
        $sql = "UPDATE $table_name SET group_name = '".$_POST['groupname']."', group_owner_id = '".$_POST['group_admin']."', group_img = '".$movefile['url']."' WHERE id = ".$group_id;
                
        $wpdb->query($sql);
        echo '<div class="updated"><p>Group created</p></div>';
    } else {
        $sql = "UPDATE $table_name SET group_name = '".$_POST['groupname']."', group_owner_id = '".$_POST['group_admin']."' WHERE id = ".$group_id;
        $wpdb->query($sql);
        echo '<div class="updated"><p>Updated</p></div>';
    }
    header('Location: '.get_bloginfo('home').'/wp-admin/admin.php?page=nwgroup-menu');
}

?>
<div class="wrap">
    <h2>Edit Group</h2>
    <div class="commonForm">
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">
            <table class="form-table">
                <tr>
                    <th style="width:150px;">Group Name</th>
                    <td><input type="text" name="groupname" value="<?php echo $results->group_name; ?>" /></td>
                </tr>
                <tr>
                    <th>Group Image</th>
                    <td><input name="group_img" type="file" /></td>
                </tr>
                <tr>
                    <th>Group Admin</th>
                    <td>
                        <select name="group_admin">
                            <?php
                                $user_query = new WP_User_Query( array( 'role' => 'groupadmin' ) ); 
                                if ( ! empty( $user_query->results ) ) {
                                	foreach ( $user_query->results as $user ) {
                    	   ?>
                                <option value="<?php echo $user->ID; ?>" <?php if($user->ID == $results->group_owner_id){ echo "selected='selected'"; } ?> ><?php echo $user->display_name; ?></option>
                           <?php
                                	}
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><?php wp_nonce_field( 'group_img', 'group_img_nonce' ); ?></th>
                    <td><input name="editgroup" type="submit" class="button button-primary" value="Update" /></td>
                </tr>
            </table>
        </form>
    </div>
</div>