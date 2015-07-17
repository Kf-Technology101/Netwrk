<?php /* Template Name: Add New Group*/ ?>
<?php get_header(); ?>
<?php if(is_user_logged_in()){ ?>
<?php
global $user_ID;
$user_role = get_user_role($user_ID);

if($user_role == 'groupadmin') {
?>
<div id="bodymaincontainer">
	<div class="maincontent">
	    <div class="section group">
            <div class="col span_3_of_12"><h1>Add New Group</h1></div>
            <div class="col span_6_of_12">
            <?php
            if(isset($_POST['creategroup'])){
                $file_exts = array("jpg","jpeg","png","gif");
                $upload_exts1 = end(explode(".", $_FILES['group_img']['name']));
                $file_name1 = preg_replace("/[\s]+/", "", $_FILES['group_img']['name']);
                if (($_FILES["group_img"]["size"] < 4000000) && in_array($upload_exts1, $file_exts)){
                    $date = date('Ymd');
                    $time = time();
                    $filename1 = $date.'_'.$time.'_'.($file_name1);
                    $upload_dir = wp_upload_dir();
                    $uploaddir = $upload_dir['basedir'].'/groupimg/';
                    $file = $uploaddir . $date.'_'.$time.'_'.($file_name1);
                    
                    if (move_uploaded_file($_FILES['group_img']['tmp_name'], $file)) {
                        //update_user_meta($user_ID, 'group_img', $filename1);
                        global $wpdb;
                        $table_name = $wpdb->prefix.'groups';
                        $sql = "INSERT INTO $table_name(group_name, group_owner_id, group_img) VALUES('".$_POST['group_name']."', '".$user_ID."', '".$filename1."')";
                        $wpdb->query($sql);
                        echo '<div class="successMsg"><p>Group created</p></div>';
                    }
                }
            }
            
            ?>
                <div class="loginbox1">
                    <div class="commonForm" style="padding: 0 5px 5px 5px;">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div>
                                <label>Group Name</label>
                                <input type="text" style="width: 100%;" name="group_name" />
                            </div>
                            <div>
                                <label>Group Description</label>
                                <input type="text" style="width: 100%;" name="group_description" />
                            </div>
                            <div>
                                <label>Group Image</label>
                                <input type="file" name="group_img" />
                            </div>
                            <div>
                                <input type="submit" value="Create Group" name="creategroup" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col span_3_of_12"></div>
	    </div>
	</div>
</div>
<?php } ?>
<?php } else { header('Location: '.get_bloginfo('home').'/log-in'); } ?>
<?php get_footer(); ?>