<?php /* Template Name: Forgot Password Template */ ?>
<?php get_header(); ?>
<div id="bodymaincontainer">
	<div class="maincontent">
	    <div class="section group">
            <div class="col span_4_of_12"></div>
            <div class="col span_4_of_12">
                <?php
                    global $wpdb, $user_ID;
					if (empty($user_ID)) {
						if(isset($_POST['sendid'])){
							$user_login = $_POST['userid'];
							$user_data = $wpdb->get_row($wpdb->prepare("SELECT ID, user_login, user_email, user_activation_key FROM $wpdb->users WHERE user_login = %s", $user_login));
							if(!empty($user_data)){
								$from = get_option('admin_email');
								$headers = "From: $from";
								$subject = "Reset Password";
                                $headers .= "MIME-Version: 1.0\n"; 
                                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                                $useremail = $user_data->user_email;
                                $reseturl = get_bloginfo('url');
								$emailmsg = "Please click on the following link to reset your password <a href='$reseturl/reset-password/?action=$useremail'>Reset Password</a>"; 
								wp_mail( $useremail, $subject, $emailmsg, $headers );
                                //wp_mail( 'bhulbhal1981@gmail.com', $subject, $emailmsg, $headers );
								$sucess= 'Please check your registered email and click on the reset password link.';
								header("Location: ".get_bloginfo('home')."/thank-you/?action=".encripted('forgotpassword'));
							}
						}
					} else {
						header('Location:'.get_bloginfo('home').'/forgot-password');
					}
                ?>
                <div class="loginbox register">
                    <h1 style="padding: 10px 0 5px; text-align: center;">Register</h1>
                    <hr />
                    <div class="commonForm" style="padding: 0 5px 5px 5px;">
                        <form id="forms" method="post" action="">
                            <div>
                                <label>Registered Email Address</label>
                                <input type="text" name="userid" />
                            </div>
                            <div><input type="submit" name="sendid" value="Send Request" class="fullwidthBtn"></div>
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
    $('#forms').validate({
        rules:{
            userid:{
                required: true,
                email: true
            }
        }
    })
})(jQuery);
</script>
<?php get_footer(); ?>