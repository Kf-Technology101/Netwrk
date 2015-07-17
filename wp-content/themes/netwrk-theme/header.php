<?php ob_start(); ?>
<?php session_start(); ?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<!-- Responsive and mobile friendly stuff -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php
/*
* Print the <title> tag based on what is being viewed.
*/
global $page, $paged;

wp_title('|', true, 'right');

// Add the blog name.
bloginfo('name');

// Add the blog description for the home/front page.
$site_description = get_bloginfo('description', 'display');
if ($site_description && (is_home() || is_front_page()))
    echo " | $site_description";

// Add a page number if necessary:
if ($paged >= 2 || $page >= 2)
    echo ' | ' . sprintf(__('Page %s', 'twentyeleven'), max($paged, $page));

?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<!-- Responsive Stylesheets -->
<link rel="stylesheet" media="all" href="<?php bloginfo('template_directory'); ?>/css/commoncssloader.css" />
<link rel="stylesheet" media="only screen and (max-width: 1024px) and (min-width: 769px)" href="<?php bloginfo('template_directory'); ?>/css/1024.css">
<link rel="stylesheet" media="only screen and (max-width: 768px) and (min-width: 481px)" href="<?php bloginfo('template_directory'); ?>/css/768.css">
<link rel="stylesheet" media="only screen and (max-width: 480px)" href="<?php bloginfo('template_directory'); ?>/css/480.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>?ver=<?php echo(mt_rand(10,100)); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<!-- Custom Responsive Stylesheets -->
<link rel="stylesheet" media="only screen and (max-width: 1024px) and (min-width: 993px)" href="<?php bloginfo('template_directory'); ?>/css/mediaquerycss/styleMax1024.css?ver=<?php echo(mt_rand(10,100)); ?>">
<link rel="stylesheet" media="only screen and (max-width: 992px) and (min-width: 769px)" href="<?php bloginfo('template_directory'); ?>/css/mediaquerycss/styleMax992.css?ver=<?php echo(mt_rand(10,100)); ?>">
<link rel="stylesheet" media="only screen and (max-width: 768px) and (min-width: 481px)" href="<?php bloginfo('template_directory'); ?>/css/mediaquerycss/styleMax768.css?ver=<?php echo(mt_rand(10,100)); ?>">
<link rel="stylesheet" media="only screen and (max-width: 480px)" href="<?php bloginfo('template_directory'); ?>/css/mediaquerycss/styleMax480.css?ver=<?php echo(mt_rand(10,100)); ?>">

<?php
/* We add some JavaScript to pages with the comment form
* to support sites with threaded comments (when in use).
*/
if (is_singular() && get_option('thread_comments'))
    wp_enqueue_script('comment-reply');

/* Always have wp_head() just before the closing </head>
* tag of your theme, or you will break many plugins, which
* generally use this hook to add elements to <head> such
* as styles, scripts, and meta tags.
*/
wp_enqueue_script('jquery');
wp_head();
?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/jquery.fancybox.css" />
<script src="<?php bloginfo('template_directory'); ?>/js/modernizr-2.8.2-min.js"></script>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/slicknav.css" />
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.slicknav.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.fancybox.pack.js"></script>
<script>
	jQuery(function(){
		jQuery('.nav').slicknav({
		  prependTo:'#rspnavigation',
          label:''
		});
        
        
	});

jQuery(document).ready(function(){
    //jQuery('#headerBlock').stick_in_parent();
});
</script>
<script>
    jQuery(document).ready(function(){
        jQuery(".various").fancybox({
    		maxWidth	: 800,
    		maxHeight	: 600,
    		fitToView	: false,
    		width		: '90%',
    		height		: '90%',
    		autoSize	: false,
    		closeClick	: false,
    		openEffect	: 'none',
    		closeEffect	: 'none'
    	});
        
        jQuery(".various1").fancybox({
    		maxWidth	: 300,
    		maxHeight	: 292,
    		fitToView	: false,
    		width		: '90%',
    		height		: '90%',
    		autoSize	: false,
    		closeClick	: false,
    		openEffect	: 'none',
    		closeEffect	: 'none'
    	});
        jQuery(".various2").fancybox({
    		maxWidth	: 300,
    		maxHeight	: 600,
    		fitToView	: false,
    		width		: '90%',
    		height		: '90%',
    		autoSize	: false,
    		closeClick	: false,
    		openEffect	: 'none',
    		closeEffect	: 'none'
    	});

        jQuery('#dashboard_link').live('click',function(){
            jQuery('#dashboard_menu').toggle();
        });
    });
</script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.validate.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/additional-methods.js"></script>

<!-- load libs for graph representation -->
<link rel="stylesheet" media="all" href="<?php bloginfo('template_directory'); ?>/css/vis.min.css" />
<script src="<?php bloginfo('template_directory'); ?>/js/vis.min.js"></script>

<!-- Libs for chat -->
<link type="text/css" rel="stylesheet" media="all" href="<?php bloginfo('template_directory') ?>/chat/css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="<?php bloginfo('template_directory') ?>/chat/css/screen.css" />
<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/chat/js/chat.js"></script>
<script>
//var hostname = 'http://'+location.hostname+'/coregen/netwrkdemo';
var hostname = 'http://netwrkdemo.coregensolutions.com';
function openchat(user_id){
    jQuery.fancybox.close();
    
    jQuery.ajax({
        url: hostname+"/get-user-name",
        type: "post",
        data: {"userid": user_id},
        success: function(response){
            var display_name = response;
            chatWith(user_id, display_name);
        }
    });
}
</script>


<script type="text/javascript" >
jQuery(document).ready(function(){
    jQuery(".account").click(function(){
        var X=jQuery(this).attr('id');

        if(X==1){
            jQuery(".submenu").hide();
            jQuery(this).attr('id', '0');	
        } else {
            jQuery(".submenu").show();
            jQuery(this).attr('id', '1');
        }
});


    //Mouseup textarea false
    jQuery(".submenu").mouseup(function(){
        return false
    });
    jQuery(".account").mouseup(function(){
        return false
    });
    
    
    //Textarea without editing.
    jQuery(document).mouseup(function(){
        jQuery(".submenu").hide();
        jQuery(".account").attr('id', '');
    });
});
</script>
<link rel="stylesheet" media="all" href="<?php bloginfo('template_directory') ?>/fonts/font-awesome.min.css" />
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.rwdImageMaps.min.js"></script>
<script>
jQuery(document).ready(function(e) {
    jQuery('img[usemap]').rwdImageMaps();
});
</script>
</head>
<?php
if(is_user_logged_in()){
    global $user_ID;
    $user_role = get_user_role($user_ID);
    //$_SESSION['username'] = get_the_author_meta( 'display_name', $user_ID );
    $_SESSION['username'] = $user_ID;
}
?>
<?php if(is_page('network')){ ?>
<body <?php body_class(); ?> onload="draw()">
<?php } else { ?>
<body <?php body_class(); ?>>
<?php }?>
<div id="popupdiv" style="display: none;">
    <div class="maincontent">
        <div class="section group">
            <div class="col span_12_of_12">
                <div class="popup">
                    <ul class="popuplinks">
                        <li style="padding-right: 80px;"><a id="comment" href="javascript:void(0)" onclick="javascript:openchat();" ><div class="options"><i class="fa fa-comment"></i></div></a></li>
                        <li style="padding-left: 80px;"><a id="envelope" href="<?php bloginfo('url'); ?>/all-mails"><div class="options"><i class="fa fa-envelope"></i></div></a></li>
                    </ul>
                    <ul>
                        <li><div id="proImgBig1" class="proImgBig1" style="text-align: center;"></div></li>
                    </ul>
                    <ul class="popuplinks">
                        <li style="padding-right: 80px;"><a id="infobox" href="<?php bloginfo('url'); ?>/userinfo"><div class="options"><i class="fa fa-info-circle" style="padding: 10px 12px;"></i></div></a></li>
                        <li style="padding-left: 80px;"><a id="trash" href="<?php bloginfo('url'); ?>/delete-user"><div class="options"><i class="fa fa-trash-o" style="padding: 10px 13px;"></i></div></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="popupdivAdmin" style="display: none;">
    <div class="maincontent">
        <div class="section group">
            <div class="col span_12_of_12">
                <div class="popup">
                    <ul class="popuplinks">
                        <?php if(!empty($_GET['nid'])){ ?>
                        <li style="padding-right: 80px;"><a id="" href="<?php bloginfo('url'); ?>/create-conversation?nid=<?php echo $_GET['nid']; ?>" ><div class="options1"><img src="<?php bloginfo('template_directory'); ?>/images/createdwicon.png" /></div></a></li>
                        <li style="padding-left: 80px;"><a id="" href="<?php bloginfo('url'); ?>/add-members?nid=<?php echo $_GET['nid']; ?>"><div class="options2"><img src="<?php bloginfo('template_directory'); ?>/images/add-user.png" /></div></a></li>
                        <?php } else { ?>
                        <li style="padding-right: 80px;"><a id="" href="<?php bloginfo('url'); ?>/create-conversation" ><div class="options1"><img src="<?php bloginfo('template_directory'); ?>/images/createdwicon.png" /></div></a></li>
                        <li style="padding-left: 80px;"><a id="" href="<?php bloginfo('url'); ?>/add-members"><div class="options2"><img src="<?php bloginfo('template_directory'); ?>/images/add-user.png" /></div></a></li>
                        <?php } ?>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="headerBlock">
    <div class="maincontent">
        <div class="section group">
            <div class="col span_3_of_12">
                <h1><a href="<?php bloginfo('url'); ?>/geo-map"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" style="width: 130px;" /></a></h1>
            </div>
            <div class="col span_6_of_12"></div>
            <div class="col span_3_of_12 noMargin">
            <?php if(is_user_logged_in()){ ?>
            <?php
                $upload_dir = wp_upload_dir();
                $uploaddir = $upload_dir['baseurl'].'/profileimages/';
            ?>
            <div class="profilemenu">
                <div class="dropdown">
                <a class="account" >
                    <div>
                        <?php echo get_small_profile_pic($user_ID); ?>
                        <div class="profilename"><?php echo get_the_author_meta( 'display_name', $user_ID ); ?></div>
                    </div>
                </a>
                <div class="submenu">
                    <ul class="root">
                        <!--<li><a href="<?php bloginfo('url'); ?>/geo-map">Geo Map</a></li>-->
                         
                        <!--<li><a href="<?php bloginfo('url'); ?>/my-dashboard/">Dashboard</a></li>
                        <li><a href="<?php bloginfo('url'); ?>/edit-profile">Edit Profile</a></li>-->
                         
                        <li><a href="<?php echo wp_logout_url(home_url()); ?>">Logout</a></li>
                    </ul>
                </div>
            </div>
            </div>
                
            <?php } ?>
            </div>
        </div>
    </div>
</div>