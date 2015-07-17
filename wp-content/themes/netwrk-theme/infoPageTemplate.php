<?php /* Template Name: Info Template */ ?>
<?php get_header(); ?>
<?php if(is_user_logged_in()){ ?>
<?php
    $user_id = $_GET['uid'];
    $upload_dir = wp_upload_dir();
    $uploaddir = $upload_dir['baseurl'].'/profileimages/';
    $avatar = $uploaddir.get_user_meta($user_id, 'avatar', true);
?>
<div id="bodymaincontainer">
	<div class="maincontent">
	    <div class="section group">
            <div class="col span_3_of_12"></div>
            <div class="col span_6_of_12">
                <div class="profilebox" style="padding: 10px;">
                    <ul>
                        <li style="vertical-align: middle;">
                        <?php echo get_image_size_100_100($user_id); ?>
                        </li>
                        <li style="vertical-align: middle;">
                            <h3><?php echo get_the_author_meta( 'display_name', $user_id ); ?> </h3>
                        </li>
                    </ul>
                    <div>
                        <strong style="font-size: 14px;">About : </strong><p><?php echo get_user_meta($user_id, 'about', true); ?></p>
                        <strong style="font-size: 14px;">Organisation : </strong><p><?php echo get_user_meta($user_id, 'organisation', true); ?></p>
                    </div>
                </div>
            </div>
            <div class="col span_3_of_12"></div>
        </div>
	</div>
</div>
<?php } else { header('Location: '.get_bloginfo('home').'/log-in'); } ?>
<?php get_footer(); ?>