<?php /* Template Name: Register Template */ ?>
<?php get_header(); ?>
<div id="bodymaincontainer">
	<div class="maincontent">
	    <div class="section group">
            <div class="col span_4_of_12"></div>
	        <div class="col span_4_of_12">
            <?php
                if(isset($_POST['register'])){
                    if(email_exists($_POST['emailid'])){
                        $errorCode = 1;
                    } else {
                        global $wpdb;
                        $new_user_id = wp_insert_user(
                            array(
                                'user_login'		=> $_POST['emailid'],
                                'user_pass'			=> $_POST['pwd1'],
                                'user_email'		=> $_POST['emailid'],
                                'first_name'		=> $_POST['fname'],
                                'last_name'         => $_POST['lname'],
                                'role'              => $_POST['logintype'],
                                'user_nicename'     => $_POST['fname'],
                                'user_registered'	=> date('Y-m-d H:i:s')
                            )
                        );
                        
                        add_user_meta($new_user_id, 'active', 0);
                        add_user_meta($new_user_id, 'avatar', '');
                        
                        $key = $wpdb->get_var($wpdb->prepare("SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $_POST['emailid']));
                        if(empty($key)) {
						    $key = wp_generate_password(20, false);
							$wpdb->update($wpdb->users, array('user_activation_key' => $key), array('user_login' => $_POST['emailid']));
                        }
                        
                        // Mail to admin
                            $to = get_option('admin_email');
							$from = get_option('admin_email');
							$headers = 'From: '.$from . "\r\n";
                            $headers .= "MIME-Version: 1.0\n"; 
                            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
							$subject = "New Member registered"; 
                            $msg ='<strong>New Member registered</strong><br><br><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td width="15%"><strong>Name : </strong></td>
                                        <td>'.$_POST['fname'].' '.$_POST['lname'].'</td>
                                      </tr>
                                      <tr>
                                        <td><strong>Email : </strong></td>
                                        <td>'.$_POST['emailid'].'</td>
                                      </tr>
                                    </table><br><br>Regards,<br>Netwrk';
							wp_mail( $to, $subject, $msg, $headers );
                            
                            // mail to user
                            $to1 = $_POST['emailid'];
							$from1 = get_option('admin_email');
							$headers1 = 'From: '.$from1. "\r\n";
                            $headers1 .= "MIME-Version: 1.0\n"; 
                            $headers1 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
							$subject1 = "Activate your account"; 
                            $msg1 = 'Welcome to Nwtwrk!  Please click on the link to complete the registration process<br><br>Activation Link :<a href="'.get_site_url().'/activation?key='.$key.'" target="_blank">'.get_site_url().'/activation?key='.$key.'</a>'; 
							wp_mail( $to1, $subject1, $msg1, $headers1 );
                            header("Location: ".get_bloginfo('home')."/thank-you/?action=".encripted('registration'));
                    }
                }
            ?>
                <?php if($errorCode == 1){ ?>
                    <div class="errorMsg">Email address already exists. Please select different valid email address.</div>
                <?php }?>
                <div class="loginbox register">
                    <h1 style="padding: 10px 0 5px; text-align: center;">Register</h1>
                    <hr />
                    <div class="commonForm" style="padding: 0 5px 5px 5px;">
                        <form id="register" action="" method="post">
                            <div>
                                <label>First Name</label>
                                <input type="text" name="fname"  />
                            </div>
                            <div>
                                <label>Last Name</label>
                                <input type="text" name="lname"  />
                            </div>
                            <div>
                                <label>Email</label>
                                <input type="text" name="emailid"  />
                            </div>
                            <div>
                                <label>Password</label>
                                <input id="pwd1" type="password" name="pwd1"  />
                            </div>
                            <div>
                                <label>Confirm Password</label>
                                <input id="pwd2" type="password" name="pwd2"  />
                            </div>
                            <div>
                                <label><input type="radio" name="logintype" checked="checked" style="width: auto !important;" value="groupmember" /> Group Member</label>
                                <label><input type="radio" name="logintype" style="width: auto !important;" value="groupadmin" /> Group Administrator</label>
                            </div>
                            <div>
                                <input type="submit" name="register" value="Register" class="fullwidthBtn" />
                            </div>
                            <div class="loginLinks">
                                <div><a href="<?php bloginfo('url'); ?>/forgot-password">Forgot Password?</a></div>
                                <div><a href="<?php bloginfo('url'); ?>/log-in">Login</a></div>
                                <div style="clear: both;"></div>
                            </div>
                        </form>
                    </div>
                </div>                         
	        </div>
            <div class="col span_4_of_12"></div>
	    </div>
	</div>
</div>
<script>
(function($){
    $('#register').validate({
        rules:{
            fname:{
                required: true
            },
            emailid:{
                required: true,
                email: true
            },
            pwd1:{
                required: true,
                minlength: 8
            },
            pwd2:{
                required: true,
                minlength: 8,
                equalTo: '#pwd1'
            }
        }
    })
})(jQuery);
</script>
<?php get_footer(); ?>