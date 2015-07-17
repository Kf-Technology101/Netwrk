<?php /* Template Name: Reset Password Template */ ?>
<?php get_header(); ?>
<div id="content">
	<div class="maincontent">
	    <div class="section group">
	        <div class="col span_4_of_12"></div>
            <div class="col span_4_of_12">
                <?php
                	$key = $_GET['action'];
                	if(isset($_POST['Submit']) && !empty($key)){
                	    $user = get_user_by( 'email', $key );
                        $pwd = $_POST['pwd1'];
                		//$user_data = $wpdb->get_row($wpdb->prepare("SELECT ID  FROM $wpdb->users WHERE user_email = %s", $key));
                		wp_set_password( $pwd, $user->ID );
                		header("Location: ".get_bloginfo('home')."/thank-you/?action=".encripted('resetpassword'));
                	}
                ?>
                <div class="loginbox">
                    <h1 style="padding: 10px 0 5px; text-align: center;">Reset Password</h1>
                    <hr />
                    <div class="commonForm" style="padding: 0 5px 5px 5px;">
                        <form id="resetpassword" method="post" action="">
                            <div>
                                <label>Password</label>
                                <input type="password" name="pwd1" id="pwd1" />
                            </div>
                            <div>
                                <label>Confirm Password</label>
                                <input type="password" name="pwd2" id="pwd2" />
                            </div>
                            <div><input type="submit" name="Submit" id="Submit" value="Reset" class="fullwidthBtn" /></div>
                        </form>
                    </div>
                </div>              
	        </div>
            <div class="col span_4_of_12">  </div>
	    </div>
	</div>
</div>
<script>
(function($){
    $('#resetpassword').validate({
        rules:{
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