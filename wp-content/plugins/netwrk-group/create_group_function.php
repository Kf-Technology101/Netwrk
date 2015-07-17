<?php
if(isset($_POST['group_img_nonce'], $_POST['creategroup']) && wp_verify_nonce( $_POST['group_img_nonce'], 'group_img' )){
    if ( ! function_exists( 'wp_handle_upload' ) ) {
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
    }
    $uploadedfile = $_FILES['group_img'];
    $upload_overrides = array( 'test_form' => false );

    $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
    
    if ( $movefile && !isset( $movefile['error'] ) ) {
        global $wpdb;
        $table_name = $wpdb->prefix.'groups';
        $sql = "INSERT INTO $table_name(group_name, group_owner_id, group_img) VALUES('".$_POST['groupname']."', '".$_POST['group_admin']."', '".$movefile['url']."')";
        $wpdb->query($sql);
        echo '<div class="updated"><p>Group created</p></div>';
    } else {
        echo $movefile['error'];
    }
}

?>
<div class="wrap">
    <h2>Create Group</h2>
    <div class="commonForm">
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">
            <table class="form-table">
                <tr>
                    <th style="width:150px;">Group Name</th>
                    <td><input type="text" name="groupname" /></td>
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
                                		echo '<option value="'.$user->ID.'">' . $user->display_name . '</option>';
                                	}
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><?php wp_nonce_field( 'group_img', 'group_img_nonce' ); ?></th>
                    <td><input name="creategroup" type="submit" class="button button-primary" value="Create Group" /></td>
                </tr>
            </table>
        </form>
    </div>
</div>