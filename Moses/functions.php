<?php
/**
 * Minimal functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, churchthemer_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'churchthemer_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Moses Theme by Church Themer
 * @since Moses Theme by Church Themer 3.0
 */

//define links to functions and includes
$functions_path = TEMPLATEPATH . '/functions/';
$includes_path = TEMPLATEPATH . '/includes/';

//Custom Post Types
require_once ($includes_path . 'custom-post-types.php'); 			// Options panel settings and custom settings

//sermon RSS
require_once ($includes_path . 'sermon-popup/sermon-rss.php'); 			// Options panel settings and custom settings

//Podcast RSS
require_once ($includes_path . 'podcast.php'); 			// Options panel settings and custom settings

/*-----------------------------------------------------------------------------------*/
/* Options Framework Functions
/*-----------------------------------------------------------------------------------*/

/* Set the file path based on whether the Options Framework is in a parent theme or child theme */

if ( STYLESHEETPATH != TEMPLATEPATH ) {
	define('OF_FILEPATH', TEMPLATEPATH);
	define('OF_DIRECTORY', get_bloginfo('template_directory'));
} else {
	define('OF_FILEPATH', STYLESHEETPATH);
	define('OF_DIRECTORY', get_bloginfo('stylesheet_directory'));
}

/* These files build out the options interface.  Likely won't need to edit these. */

require_once (OF_FILEPATH . '/admin/admin-functions.php');		// Custom functions and plugins
require_once (OF_FILEPATH . '/admin/admin-interface.php');		// Admin Interfaces (options,framework, seo)

/* These files build out the theme specific options and associated functions. */

require_once (OF_FILEPATH . '/admin/theme-options.php'); 		// Options panel settings and custom settings
require_once (OF_FILEPATH . '/admin/theme-functions.php'); 	// Theme actions based on options settings

/*-----------------------------------------------------------------------------------*/
/* END Options Framework Functions
/*-----------------------------------------------------------------------------------*/

/**
 * include the CheezCap files. CheezCap is a simple library for creating custom Wordpress admin panels (wp-admin) really, really easily. 
 */
// require_once('cheezcap/cheezcap.php'); 
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/** Tell WordPress to run churchthemer_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'churchthemer_setup' );

if ( ! function_exists( 'churchthemer_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override churchthemer_setup() in a child theme, add your own churchthemer_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
function churchthemer_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'churchthemer', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'minimal' ),
		'footer_row1' => __( 'Footer Navigation Column 1', 'minimal' ),
		'footer_row2' => __( 'Footer Navigation Column 2', 'minimal' ),
		'footer_row3' => __( 'Footer Navigation Column 3', 'minimal' ),
		'footer_row4' => __( 'Footer Navigation Column 4', 'minimal' ),
	) );

	

	
}
endif;

if ( ! function_exists( 'churchthemer_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in churchthemer_setup().
 *
 * @since Twenty Ten 1.0
 */
function churchthemer_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;

/**
 * Makes some changes to the <title> tag, by filtering the output of wp_title().
 *
 * If we have a site description and we're viewing the home page or a blog posts
 * page (when using a static front page), then we will add the site description.
 *
 * If we're viewing a search result, then we're going to recreate the title entirely.
 * We're going to add page numbers to all titles as well, to the middle of a search
 * result title and the end of all other titles.
 *
 * The site title also gets added to all titles.
 *
 * @since Twenty Ten 1.0
 *
 * @param string $title Title generated by wp_title()
 * @param string $separator The separator passed to wp_title(). Twenty Ten uses a
 * 	vertical bar, "|", as a separator in header.php.
 * @return string The new title, ready for the <title> tag.
 */
function churchthemer_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'churchthemer' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'churchthemer' ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:ug-2013
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	if ( isset($page)) { 
		error_log("the page variable is SET");
                error_log(gettype($page));
	} else {
		error_log("the page variable is NOT set around 228 of functions.php");
	}
	$pagestr = gettype($page);
	if ( strcmp($pagestr,"object") == 0) {
		$pageval = 0;
	} else {
		$pageval = $page;
	}
	// Add a page number if necessary:
	if ( $paged >= 2 || $pageval >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'churchthemer' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'churchthemer_filter_wp_title', 10, 2 );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function churchthemer_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'churchthemer_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function churchthemer_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'churchthemer_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function churchthemer_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'churchthemer' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and churchthemer_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function churchthemer_auto_excerpt_more( $more ) {
	return ' &hellip;' . churchthemer_continue_reading_link();
}
add_filter( 'excerpt_more', 'churchthemer_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function churchthemer_custom_excerpt_more( $output ) {
        error_log("in functions.php: churchthemer_custom_excerpt_more");
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= churchthemer_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'churchthemer_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css.
 *
 * @since Twenty Ten 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function churchthemer_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'churchthemer_remove_gallery_css' );

if ( ! function_exists( 'minimal_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own minimal_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function minimal_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
				<?php if (1 == $comment->user_id){
				//if commenter is the admin ?>
				register_sidebar_widget<li class="admin">
                <?php } else { 
				//if commenter is NOT the admin?>
				<li> 
                <?php } ?>
                    <div class="comment_wrap"> 
                        <div class="comment"> 
                            
							
							<?php if (1 == $comment->user_id){
                            //don't show gravatar for admin?> 
                            <div class="avatar">
                            <?php } else { 
                            //if commenter is NOT the admin - show the gravatar?>
                            <div class="avatarimg">
                            <?php echo get_avatar( $comment, 32 ); ?>
                            
                            <?php } ?></div> 
                            <?php if ( $comment->comment_approved == '0' ) : ?>
							<em><?php _e( 'Your comment is awaiting moderation.', 'churchthemer' ); ?></em>
							
							<?php endif; ?>
                            <?php strip_tags(comment_text()); ?>
                    	</div> </div>
                    <div class="comment_bottom"></div> 
                    
                    <p class="comment_info"> 
                        <strong class="name"><?php comment_author_link(); ?></strong><br /> 
                        <span class="date"><?php comment_date();?> at <?php comment_time(); ?></span> 
                    </p> 
                </li> 
								
		
	

	<?php
	break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override churchthemer_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
function churchthemer_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'churchthemer' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'churchthemer' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}
/** Register sidebars by running churchthemer_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'churchthemer_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since Twenty Ten 1.0
 */
function churchthemer_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'churchthemer_remove_recent_comments_style' );

if ( ! function_exists( 'churchthemer_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function churchthemer_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'churchthemer' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'churchthemer' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'churchthemer_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function churchthemer_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'churchthemer' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'churchthemer' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'churchthemer' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

//Cut "Continue Reading" from the_excerpt(();
function new_excerpt_more($more) {
     return '';
}
add_filter('excerpt_more', 'new_excerpt_more');

//Widgets
//Latest Sermon Widget
function widget_latest_sermon() { 
			global $wpdb; 
			global $post;
            global $table_prefix;
			?>
                        
				<li class="widget-container">
							
							<h3>Latest Teaching</h3> 
						
							<div class="content">
                            <?php
							 $argssidebar = array( 'post_type' => 'cpt_sermons',
							 'showposts' => 1);
							 $the__sermons_query = new WP_Query($argssidebar);	
							 $sermonposts = get_posts($argssidebar);
                                                         error_log("about to get posts in widget-lastest-sermon");
							 foreach($sermonposts as $post) : ?>
                             	<?php 
                                                         error_log("getting latest sermon in functions.php widget-latest-sermon func");
								$the_id = get_the_ID(); 
								$table_name = $table_prefix . "posts";
								$theexcerpt = $wpdb->get_var($wpdb->prepare("SELECT post_content FROM $table_name WHERE ID = '%d';", $the_id));
								$theexcerpt = substr($theexcerpt, 0, 150) . "...";
								?>
								<small class="date"><?php the_time('M j, Y'); ?></small> 
								<h2><?php the_title(); ?></h2> 
								<h4>by <?php echo get_post_meta($post->ID, 'sermonauthor', true); ?></h4> 
								
								<p><?php echo $theexcerpt; ?></p> 
								
								<a href="<?php if (get_option("cap_mp3_php") == "true"){?><?php echo get_template_directory_uri();?>/includes/mp3.php?file=<?php echo get_post_meta($post->ID, 'sermonmp3', true); ?>&fname=<?php echo get_the_title(); ?><?php } else { echo get_post_meta($post->ID, 'sermonmp3', true); } ?>" class="download">Download</a> 
                                <?php endforeach; 
								wp_reset_query();
								?>
							</div> 
				</li>	
			<?php
}
//Moses Theme by Church Themer Sermon Widget
function widget_search() { 
			global $wpdb; ?>
			
				<li class="widget-container">
							
                            <h3>Search:</h3> 
							<div id="search_widget"> 
							<form role="search" method="get" id="searchform" action="<?php bloginfo('url'); ?>"> 
							<fieldset> 
								<p class="text_field"> <input type="text" name="s" id="s" value="Search" /> </p> 
								<input type="submit" id="searchsubmit" value="submit" /> 
							</fieldset> 
							</form> 
							</div> 
				</li>	
			<?php
}



wp_register_sidebar_widget(__('Latest Sermon Widget', 'churchthemer'), 'widget_latest_sermon', null, 'latest_sermon');
wp_unregister_widget_control('latest_sermon');

wp_register_sidebar_widget(__('Church Theme Search Widget', 'churchthemer'), 'widget_search', null, 'searchwidget');
wp_unregister_widget_control('searchwidget');

//Get current Page name:
function curPageName() {
 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}

//ADMIN ColorBox Popup Javascript
function colorbox (){
	if (curPageName() != "nav-menus.php"){
	?>
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>-->
	<link type="text/css" media="screen" rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/js/colorbox/colorbox.css" />
	<script src="<?php echo get_bloginfo('template_url'); ?>/js/colorbox/jquery.colorbox.js"></script>
    <script>
        jQuery(document).ready(function(){
            //Examples of how to assign the ColorBox event to elements
            
            jQuery(".fileupload").colorbox({width:"700px", height:"500px", iframe:true});
            
            
            //Example of preserving a JavaScript event for inline calls.
            jQuery("#click").click(function(){ 
                jQuery('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
                return false;
            });
        });
    </script>
    <?php
	}
}        
//add_action('admin_head', 'colorbox');

//FRONTEND ColorBox Popup Javascript
function colorbox_front (){
	if (curPageName() != "nav-menus.php"){
	?>
<link type="text/css" media="screen" rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/js/colorbox/colorbox.css" />
		

		<script src="<?php echo get_bloginfo('template_url'); ?>/js/colorbox/jquery.colorbox.js"></script>
		<script>
			jQuery(document).ready(function(){
				//Examples of how to assign the ColorBox show to elements
				
				jQuery(".videopopup").colorbox({width:"700px", height:"500px", iframe:true});
				
				
				//Example of preserving a JavaScript show for inline calls.
				jQuery("#click").click(function(){ 
					jQuery('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
		</script>
        <?php
	}
}        
add_action('wp_head', 'colorbox_front');

/**
 * sermon cat taxonomies
 */
 function sermon_cat_taxonomy() {  
   register_taxonomy(  
    'sermon_cat',  
    'cpt_sermons',  
    array(  
        'hierarchical' => true,  
        'label' => 'Sermon Categories',  
        'query_var' => true,  
		'with_front' => false, 
        'rewrite' => array('slug' => 'sermons')  
    )  
);  
}  
add_action( 'init', 'sermon_cat_taxonomy' ); 


//Header Scripts and JQuery
function moses_header_scripts(){?>
	<script src="<?php bloginfo( 'template_url' ); ?>/js/jquery.tools.scrollable.min.js"></script>
       
    <script type="text/javascript" charset="utf-8">
        
    
       jQuery(document).ready(function(){
            
            var onLastSlide = false;
            jQuery(".scrollable").scrollable({
            onSeek: function(event) {
            if(this.getIndex() == this.getSize()-1){ 
            onLastSlide = true;	
            }
            },
            onBeforeSeek: function(event) {
            if(onLastSlide){ 
            onLastSlide = false;
            this.begin();	
            }							
            }
            }).navigator().autoscroll({interval: 7000});
    
            jQuery(".navi").css({
                // first move it half of the page width to the right (50%),
                // then move it back half of the nav width to the left
                // (page width / 2) - (nav width / 2)
                left: (jQuery(".navi_wrap").width() / 2)-(jQuery(".navi").outerWidth() / 2)
            });
            
            
            //MAIN SEARCH --------------------------
            jQuery("#search p.text_field input, #search_widget p.text_field input").focus(function(){
                jQuery(this).parent().css("backgroundPosition","-220px -360px");
                if(jQuery(this).value == jQuery(this).attr('defaultValue'))
                {
                  jQuery(this).val('');
                }
            });
            
            jQuery("#search p.text_field input, #search_widget p.text_field input").blur(function(){
                jQuery(this).parent().css("backgroundPosition","0 -360px");
                if(jQuery(this).value == '')
                {
                  jQuery(this).val(jQuery(this).attr('defaultValue'));
                }
            });
            
            
        });
        
    </script>
    <script type="text/javascript" charset="utf-8">
        
    jQuery(function () {
            jQuery(".scrollable").scrollable({circular: true}).navigator().autoscroll({interval: 7000});
    
            jQuery(".navi").css({
                // first move it half of the page width to the right (50%),
                // then move it back half of the nav width to the left
                // (page width / 2) - (nav width / 2)
                left: (jQuery(".navi_wrap").width() / 2)-(jQuery(".navi").outerWidth() / 2)
            });
 
            // FORM FIELDS -------------------------
            //Form text field styling and focus --------------------------
                
                //--------NAME
                jQuery(".comment-form-author input").focus(function(){
                    jQuery(this).parent().css("backgroundPosition","0 -400px");
                    if(jQuery(this).value == jQuery(this).attr('defaultValue'))
                    {
                      jQuery(this).val('');
                    }
                });
                
                jQuery(".comment-form-author input").blur(function(){
                    jQuery(this).parent().css("backgroundPosition","0 -240px");
                    if(jQuery(this).value == '')
                    {
                      jQuery(this).val(jQuery(this).attr('defaultValue'));
                    }
                });
                
                //--------EMAIL
                jQuery(".comment-form-email input").focus(function(){
                    jQuery(this).parent().css("backgroundPosition","0 -443px");
                    if(jQuery(this).value == jQuery(this).attr('defaultValue'))
                    {
                      jQuery(this).val('');
                    }
                });
                
                jQuery(".comment-form-email input").blur(function(){
                    jQuery(this).parent().css("backgroundPosition","0 -283px");
                    if(jQuery(this).value == '')
                    {
                      jQuery(this).val(jQuery(this).attr('defaultValue'));
                    }
                });
                
                //--------WEBSITE
                jQuery(".comment-form-url input").focus(function(){
                    jQuery(this).parent().css("backgroundPosition","0 -486px");
                    if(jQuery(this).value == jQuery(this).attr('defaultValue'))
                    {
                      jQuery(this).val('');
                    }
                });
                
                jQuery(".comment-form-url input").blur(function(){
                    jQuery(this).parent().css("backgroundPosition","0 -326px");
                    if(jQuery(this).value == '')
                    {
                      jQuery(this).val(jQuery(this).attr('defaultValue'));
                    }
                });
                
                
            
            //Form text field styling and focus --------------------------
            jQuery("div.field_message textarea").focus(function(){
                jQuery(this).parent().css("backgroundPosition","-240px -400px");
            });
            
            jQuery("div.field_message textarea").blur(function(){
                jQuery(this).parent().css("backgroundPosition","-240px -240px");
            });
            
            
        });
    
    </script>
    <?php
    }

add_action('wp_head', 'moses_header_scripts');

//switch posts over to new posts names - if any of the old ones still exist
global $wpdb;

$wpdb->update( $wpdb->posts, array('post_type' => 'cpt_news'), array('post_type' => 'news'));
$wpdb->update( $wpdb->posts, array('post_type' => 'cpt_events'), array('post_type' => 'events'));
$wpdb->update( $wpdb->posts, array('post_type' => 'cpt_sermons'), array('post_type' => 'sermons'));
$wpdb->update( $wpdb->posts, array('post_type' => 'cpt_photoalbums'), array('post_type' => 'photoalbums'));

