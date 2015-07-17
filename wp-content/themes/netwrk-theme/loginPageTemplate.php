<?php /* Template Name: Login Template */ ?>
<?php get_header(); ?>
<div id="bodymaincontainer loginpage">
	<div class="maincontent">
	    <div class="section group">
            <div class="col span_4_of_12"></div>
	        <div class="col span_4_of_12">
                <?php
                    if(isset($_POST['login'])){                    
                        global $wpdb;
                        $username = $wpdb->escape($_POST['username']);
                    	$pwd = $wpdb->escape($_POST['pwd']);
                    				
                    	$user_status = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->users WHERE user_login = %s", $username));
                        $user_status[0]->user_status;
                        if($user_status[0]->user_status == 1){
                    		$login_data = array();
                    		$login_data['user_login'] = $username;
                    		$login_data['user_password'] = $pwd;
                    		$login_data['remember'] = 'false';
                            
                            $user_verify = wp_signon( $login_data, true );
                            if ( is_wp_error($user_verify) ){
                                //echo $error_string = $user_verify->get_error_message();
                                $errorCode = 1;
                            } else {
                                header('Location: '.get_bloginfo('home').'/geo-map');
                                exit();
                    		}
                    	} else {
                    		$errorCode = 2; // invalid login details
                    	}
                    }
                ?>
                <?php if($errorCode == 1){ ?>
                    <div class="errorMsg">Incorrect login details...Please try again.</div>
                <?php } ?>
                <?php if($errorCode == 2){ ?>
                    <div class="errorMsg">Your account is not activated...Please check your mail and activate your account.</div>
                <?php } ?> 
                <div class="loginbox">
                    <h1 style="padding: 10px 0 5px; text-align: center;"><img src="<?php bloginfo('template_directory'); ?>/images/wrk.png" /></h1>
                    <div class="commonForm" style="padding: 0 5px 5px 5px;">
                        <form action="" method="post">
                            <div>
                                <input type="text" name="org" class="org" placeholder="Organisation" autocomplete="off" />
                            </div>
                            <div>
                                <input type="text" name="username" class="username" placeholder="Email ID" autocomplete="off" />
                            </div>
                            <div>
                                <input type="password" name="pwd" class="pwd" placeholder="Password" autocomplete="off" />
                            </div>
                            <div>
                                <input type="submit" name="login" value="SIGN IN" class="fullwidthBtn" />
                            </div>
                            <div class="loginLinks">
                                <div><a href="<?php bloginfo('url'); ?>/forgot-password">Forgot Password?</a></div>
                                <div><a href="<?php bloginfo('url'); ?>/register">Register</a></div>
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
<?php get_footer(); ?>