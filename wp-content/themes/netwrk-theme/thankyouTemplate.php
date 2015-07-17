<?php /* Template Name: Thank You Template */ ?>
<?php get_header(); ?>
<div id="bodymaincontainer">
	<div class="maincontent">
	    <div class="section group">
            <div class="col span_12_of_12">
                <h3><?php the_title(); ?></h3>
                <?php
					$action = decripted($_GET['action']);
					if($action == 'registration'){
						echo "<p class='successMsg'>Thankyou for registration. Please check your email to activate your account.</p>";
                        header('Location: '.get_bloginfo('home').'/dwnetwrk/');
					}
					if($action == 'forgotpassword'){
						echo "<p class='successMsg'>Please check your registered email and click on the reset password link.</p>";
					}
					if($action == 'resetpassword'){
                ?>
					<p class='successMsg'>Your password updated successfully. Please click here to <a class="alink" href="<?php bloginfo('home'); ?>/log-in">Login</a>.</p>
				<?php } ?>
            </div>
	    </div>
	</div>
</div>
<?php get_footer(); ?>