<?php ob_start(); ?>
<?php
/*
    Plugin Name: Netwrk Group
*/
?>
<?php
class netwrkGroupClass{
    public function __construct(){
        add_action('admin_menu', array($this, 'netwrkGroup_function'));
    }
    
    public function netwrkGroup_function(){
        add_menu_page('Netwrk Groups', 'Netwrk Groups', 'manage_options', 'nwgroup-menu', array($this, 'groups_list_function' ));
        add_submenu_page('nwgroup-menu', 'Create Group', 'Create Group', 'manage_options', 'create-group', array($this, 'create_group_function'));
        add_submenu_page('nwgroup-menu', 'Add Members', 'Add Members', 'manage_options', 'add-members', array($this, 'add_member_function'));
        add_submenu_page('', 'Edit Group', 'Edit Group', 'manage_options', 'edit-group', array($this, 'edit_group_function'));
        add_submenu_page('', 'Delete Group', 'Delete Group', 'manage_options', 'delete-group', array($this, 'delete_group_function'));
    }
    
    public function groups_list_function(){
        include('groups_list_function.php');
    }
    
    public function create_group_function(){
        include('create_group_function.php');
    }
    
    public function edit_group_function(){
        include('edit_group_function.php');
    }
    
    public function delete_group_function(){
        include('delete_group_function.php');
    }
    
    public function add_member_function(){
        
    }
}
$netwrkGroup = new netwrkGroupClass();