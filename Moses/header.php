<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Moses Theme by Church Themer
 * @since Moses Theme by Church Themer 3.0
 */

//check if this is a multisite setup or single
if (constant('MULTISITE') == 1) {global $multisite; $multisite = true;};
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 * We filter the output of wp_title() a bit -- see
	 * twentyten_filter_wp_title() in functions.php.
	 */
	wp_title( '|', true, 'right' );

	?></title>
    
    <?php wp_enqueue_script("jquery"); ?>
    
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link id="colour_switch" rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/<?php echo reverse_escape(get_option('cap_stylesheet')); ?>" />
    
  
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/ie7down.css" />
	<![endif]-->
    
    <?php if(preg_match('/(?i)msie [1-7]/',$_SERVER['HTTP_USER_AGENT'])) { ?>
       <!--[if IE 7]>
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/ie7fix.css" />
      <![endif]-->
	<?php } ?>

<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
	
	global $homevar;
	$homevar = is_home();
?>
</head>

<body <?php body_class($class); ?>> 

	<!-- Site Info --> 
    <?php if (get_option("cap_address") != "" && get_option("cap_address") != "Address"){
			$address = "true";
	}
	if (get_option("cap_worship_times") != "" && get_option("cap_worship_times") != "Worship TImes"){ 
		$worshiptimes = "true";
	}
	if ($address == "true" || $worshiptimes == "true"){?>
	<div id="site_info_wrap"> 
		<div id="site_info"> 
        	<?php if (get_option("cap_address") != "" && get_option("cap_address") != "Address"){?>
			<span class="location"><span class="icon"></span><?php if (get_option("cap_address_link") != "" && get_option("cap_address_link") != "Address Link"){?><a href="<?php echo get_option("cap_address_link"); ?>"><?php } ?><?php  echo(stripslashes(get_option("cap_address"))); ?><?php if (get_option("cap_address_link") != "" && get_option("cap_address_link") != "Address Link"){?></a><?php } ?></span> 
            <?php } ?>
            <?php if (get_option("cap_worship_times") != "" && get_option("cap_worship_times") != "Worship TImes"){?>
			<span class="time"><span class="icon"></span><?php  echo(stripslashes(get_option("cap_worship_times"))); ?></span> 
			<?php  } ?>
			<div class="hr"><hr /></div> 
		</div> 
	</div> 
    <?php } ?>
    <!-- Header --> 
	<div id="header_wrap"> 
		<div id="header"> 

       
			<h1 id="branding"><a href="<?php echo home_url( '/' ); ?>">
			<?php // check to see if there's a header image set
			if(get_option("cap_logo_image") == 'Image URL') {
				print bloginfo( 'name' );
			} else {
			// if there's a header image, print it
			?><img src="<?php bloginfo( 'template_directory' ); ?>/thumb.php?src=<?php if (is_multisite()){echo get_current_site(1)->path; echo str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),get_option("cap_logo_image")); }else{ echo get_option("cap_logo_image");}?>&h=61&w=320&zc=1" alt="<?php bloginfo( 'name' ); ?>" width="320" height="61" />
			<?php
			// end logo image test
			}
			?>
			</a></h1> 
			<h2><?php if (get_bloginfo( 'description' ) != ""){?><?php bloginfo( 'description' ); ?><?php } ?></h2>
						
			<div id="nav"> 
            <div class="home-button">
				 	<ul>
                    <li <?php if ( is_home() ) { ?> class="current_page_item" <?php } ?>><a href="<?php echo get_option('home'); ?>/">Home</a></li>	
                    </ul>
             </div>
                    <?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary', 'fallback_cb' => false) ); ?>
			</div></div> 
		<div class="hr"><hr /></div> 
	</div> 