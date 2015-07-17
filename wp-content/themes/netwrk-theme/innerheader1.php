<?php global $user_ID; ?>
<div class="innerHeader">
    <div class="innerlogo"><a href="<?php bloginfo('url'); ?>/geo-map"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" /></a></div>
    <div class="section group">
        <div class="col span_4_of_12">
            <a id="comment" href="javascript:void(0)" ><div class="options"><i class="fa fa-comment"></i></div></a>
        </div>
        <div class="col span_4_of_12">
            <div class="profileimg" style="text-align: center;">
                <?php echo get_image_size_100_100($user_ID); ?>
                <div class="username1"><?php echo get_the_author_meta( 'display_name', $user_ID ); ?></div>
            </div>
        </div>
        <div class="col span_4_of_12"><a id="infobox" href="<?php bloginfo('url'); ?>/userinfo?uid=<?php echo $user_ID; ?>"><div class="options"><i class="fa fa-info-circle" style="padding: 10px 12px;"></i></div></a></div>
    </div>
</div>