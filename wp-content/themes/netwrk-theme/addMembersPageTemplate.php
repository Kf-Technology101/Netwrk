<?php /* Template Name: Add Members */ ?>
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
            <div class="col span_3_of_12"></div>
            <div class="col span_6_of_12"><div class="setCenter">
                <div class="innerHeader" style="background: none;">
                    <div class="innerlogo"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" /></div>
                    <p style="text-align: center;">Add New Contact</p>
                </div>
                <?php if($errorCode == 1){ ?>
                    <div class="errorMsg">Email address already exists. Please select different valid email address.</div>
                <?php }?>
                <?php
                    if(isset($_POST['formWheelchair']) && $_POST['formWheelchair'] == 'Yes') {
                        $role = 'groupadmin';
                    } else {
                        $role = 'groupmember';
                    } 
                    if(isset($_POST['add_member'])){
                        if(email_exists($_POST['emailid'])){
                            $errorCode = 1;
                        } else {
                            global $wpdb;
                            $new_user_id = wp_insert_user(
                                array(
                                    'user_login'		=> $_POST['emailid'],
                                    'user_pass'			=> $_POST['pwd1'],
                                    'user_email'		=> $_POST['emailid'],
                                    //'first_name'		=> $_POST['fname'],
                                    //'last_name'         => $_POST['lname'],
                                    'display_name'      => $_POST['fullname'],
                                    'role'              => $role,
                                    'user_nicename'     => $_POST['fname'],
                                    'user_registered'	=> date('Y-m-d H:i:s')
                                )
                            );
                            
                            add_user_meta($new_user_id, 'group_joined', $_POST['group_joined']);
                            add_user_meta($new_user_id, 'avatar', '');
                            if($_POST['parent_member'] == -1){
                                add_user_meta($new_user_id, 'parent_member', '');
                            } else {
                                add_user_meta($new_user_id, 'parent_member', $_POST['parent_member']);
                            }
                            
                            $key = $wpdb->get_var($wpdb->prepare("SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $_POST['emailid']));
                            if(empty($key)) {
    						    $key = wp_generate_password(20, false);
    							$wpdb->update($wpdb->users, array('user_activation_key' => $key), array('user_login' => $_POST['emailid']));
                                $wpdb->update($wpdb->users, array('user_status' => 1), array('user_login' => $_POST['emailid']));
                            }
                            // mail to user
                            $to1 = $_POST['emailid'];
							$from1 = get_option('admin_email');
							$headers1 = 'From: '.$from1. "\r\n";
                            $headers1 .= "MIME-Version: 1.0\n"; 
                            $headers1 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
							$subject1 = "Netwrk : Thank you"; 
                            $msg1 = 'Welcome to Nwtwrk!<br><br>Thank you for joining.<br><br>Your login details are as follows<br><br><strong>Email: </strong>'.$_POST['emailid'].'<br><strong>Password: </strong>'.$_POST['pwd1']; 
							wp_mail( $to1, $subject1, $msg1, $headers1 );
                            
                            
                            echo "<p class='successMsg'>New member added.</p>";
                            if($_POST['parent_member'] == -1){
                                header('Location: '.get_bloginfo('home').'/create-node-members?nodeid='.$new_user_id.'&nid='.$_POST['group_joined']);
                            } else {
                                header('Location: '.get_bloginfo('home').'/dwnetwrk/?nid='.$_POST['group_joined']);
                            }
                        }
                    }
                ?>
                    <div class="loginbox1" style="margin: 0;">
                    <div class="commonForm" style="padding: 0 5px 5px 5px;">
                        <form id="add_user" method="post" action="">
                            <div>
                                <label>Name</label>
                                <input type="text" style="width: 100%;" name="fullname" />
                            </div>
                            <div>
                                <label>Email</label>
                                <input type="text" style="width: 100%;" name="emailid" />
                            </div>
                            <div>
                                <label>Password</label>
                                <input id="pwd1" type="password" name="pwd1"  />
                            </div>
                            <!--<div>
                                <label>County</label>
                                <select name="group_joined">
                                    <option value="4">Pulaski</option>
                                    <option value="5">Kosciusko</option>
                                </select>
                            </div>-->
                            <div>
                                <label>Parent Member</label>
                                <select name="parent_member">
                                    <option value="-1">Select Parent Member</option>
                                    <?php
                                        echo '<option value="'.$user_ID.'">' . get_the_author_meta( 'display_name', $user_ID ) . '</option>';
                                        $user_query = new WP_User_Query( array( 'role' => 'groupmember' ) ); 
                                        if ( ! empty( $user_query->results ) ) {
                                        	foreach ( $user_query->results as $user ) {
                                        		echo '<option value="'.$user->ID.'">' . $user->display_name . '</option>';
                                        	}
                                        }
                                    ?>
                                </select>
                            </div>
                            <div><input type="hidden" name="group_joined" value="<?php echo $_GET['nid']; ?>" /></div>
                            <div><input type="checkbox" name="isadmin" value="1" /> Admin?</div>
                            <div style="text-align: center;">
                                <input type="submit" name="add_member" value="Next" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
            <div class="col span_3_of_12"></div>
	    </div>
	</div>
</div>
<script>
(function($){
    $('#add_user').validate({
        rules:{
            fullname:{
                required: true
            },
            emailid:{
                required: true,
                email: true
            },
            pwd1:{
                required: true,
                minlength: 8
            }
        }
    })
})(jQuery);
</script>
<?php } ?>
<?php } else { header('Location: '.get_bloginfo('home').'/log-in'); } ?>
<?php get_footer(); ?>