<?php /* Template Name: Network Template */ ?>
<?php get_header(); ?>
<?php if(is_user_logged_in()){ ?>
<div id="bodymaincontainer">
	<div class="maincontent">
	    <div class="section group">
            <div class="col span_12_of_12">
                <div class="groupbox" style="height: 400px;">
                    <div id="mynetwork1" style="height: 400px;"></div>
                    <a id="link_id1" class="various" href="#popupdiv" style="display: none;">Iframe</a>
                    <a id="link_id2" class="various" href="#popupdivAdmin" style="display: none;"></a>
                </div>
            </div>
	    </div>
	</div>
    <div class="maincontent">
        <div class="section group">
            <!-- <div class="col span_1_of_3"><div style="text-align: right;"><a id="pluszoom" href="javascript:void(0);" class="aButton">+</a></div></div> -->
            <div class="col span_3_of_3"><div style="text-align: center;"><a href="<?php bloginfo('url'); ?>/my-dashboard" class="aButton">Dashboard</a></div></div>
            <!-- <div class="col span_1_of_3"><div style="text-align: left;"><a id="minuszoom" href="javascript:void(0);" class="aButton">-</a></div></div> -->
        </div>
    </div>
</div>
<?php } else { header('Location: '.get_bloginfo('home').'/log-in'); } ?>
<?php get_footer(); ?>