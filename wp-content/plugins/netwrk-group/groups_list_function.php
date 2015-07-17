<?php
        global $wpdb;
        $table_name = $wpdb->prefix.'groups';
        $query = "SELECT * FROM $table_name";
        $results = $wpdb->get_results($query);
?>
<style>
#group_listing tbody a span{
    display: inline-block;
    vertical-align: top;
    margin-top: 15px;
}
</style>
<div class='wrap'>
    <h2>Groups</h2>
    <div class="catListing">
        <table id="group_listing" border="0" cellpadding="0" cellspacing="0" class="widefat">
            <thead>
                <tr>
                    <th scope="col" class="manage-column column-name">Group Name</th>
                    <th scope="col" class="manage-column column-name">Group Owner</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($results as $r){ ?>
                <tr>
                    <td>
                        <a href="<?php bloginfo('home'); ?>/wp-admin/admin.php?page=edit-group&id=<?php echo $r->id; ?>" class="row-title"><img src="<?php echo $r->group_img; ?>" width="50" height="50" /> <span><?php echo $r->group_name; ?></span></a>
                        <div class="row-actions">
                            <span><a href="<?php bloginfo('home'); ?>/wp-admin/admin.php?page=edit-group&id=<?php echo $r->id; ?>">Edit</a> | </span>
                            <span><a href="<?php bloginfo('home'); ?>/wp-admin/admin.php?page=delete-group&id=<?php echo $r->id; ?>">Delete</a></span>
                        </div>
                    </td>
                    <td>
                        <?php echo get_the_author_meta( 'display_name', $r->group_owner_id ); ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
    </div>
</div>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'css/demo_table.css' , __FILE__ ); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'css/jquery-ui.css' , __FILE__ ); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'css/jquery-ui-1.10.4.custom.min.css' , __FILE__ ); ?>">
<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="<?php echo plugins_url( 'js/jquery.js' , __FILE__ ); ?>"></script>
 
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="<?php echo plugins_url( 'js/jquery.dataTables.min.js' , __FILE__ ); ?>"></script>
<script type="text/javascript" charset="utf8" src="<?php echo plugins_url( 'js/number_format.js' , __FILE__ ); ?>"></script>
<script type="text/javascript" charset="utf8" src="<?php echo plugins_url( 'js/jquery-ui.js' , __FILE__ ); ?>"></script>
<script type="text/javascript" charset="utf8" src="<?php echo plugins_url( 'js/jquery.dataTables.columnFilter.js' , __FILE__ ); ?>"></script>
<script>
jQuery(document).ready( function(){
    jQuery('#property_listing').DataTable();
});
</script>