<?php
add_action('init', 'session_start');
/**
 * TwentyTen functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, twentyten_setup(), sets up the theme by registering support
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
 *     remove_filter( 'excerpt_length', 'twentyten_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

	/*-------------------------------------------
		Show error messages
	-------------------------------------------*/
	//error_reporting(E_ALL);
	//ini_set('display_errors', '1');

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/** Tell WordPress to run twentyten_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'twentyten_setup' );

if ( ! function_exists( 'twentyten_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyten_setup() in a child theme, add your own twentyten_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'twentyten', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'twentyten' ),
	) );

	// This theme allows users to set a custom background
	add_custom_background();

	// Your changeable header business starts here
	define( 'HEADER_TEXTCOLOR', '' );
	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	define( 'HEADER_IMAGE', '%s/images/headers/path.jpg' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to twentyten_header_image_width and twentyten_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'twentyten_header_image_width', 940 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'twentyten_header_image_height', 198 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 198 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Don't support text inside the header image.
	define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See twentyten_admin_header_style(), below.
	add_custom_image_header( '', 'twentyten_admin_header_style' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'berries' => array(
			'url' => '%s/images/headers/starkers.png',
			'thumbnail_url' => '%s/images/headers/starkers-thumbnail.png',
			/* translators: header image description */
			'description' => __( 'Starkers', 'twentyten' )
		)
	) );
}
endif;

if ( ! function_exists( 'twentyten_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in twentyten_setup().
 *
 * @since Twenty Ten 1.0
 */
function twentyten_admin_header_style() {
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
 $separator = " | ";
function twentyten_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'twentyten' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'twentyten' ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	if ( $title !== "") {	
		$title .= " | ";
	} 

	$title .= get_bloginfo( 'name', 'display' );
	
	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'twentyten_filter_wp_title', 10, 2 );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentyten_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function twentyten_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'twentyten_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function twentyten_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyten_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function twentyten_auto_excerpt_more( $more ) {
	return ' &hellip;' . twentyten_continue_reading_link();
}
add_filter( 'excerpt_more', 'twentyten_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function twentyten_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= twentyten_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'twentyten_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css.
 *
 * @since Twenty Ten 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function twentyten_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'twentyten_remove_gallery_css' );

if ( ! function_exists( 'twentyten_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyten_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard clearfix">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'twentyten' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>

			<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php
					/* translators: 1: date, 2: time */
					printf( __( '%1$s at %2$s', 'twentyten' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' );
				?>
			</div><!-- .comment-meta .commentmetadata -->
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'twentyten' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyten' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'twentyten'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override twentyten_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
// create widget areas
$sidebars = 
	array(
		array(
			array('Blocks - Home'),
			array('Blocks - Home')
		),
		array(
			array('Blocks - Home - Bottom'),
			array('Blocks - Home - Bottom')
		),
		array(
			array('Blocks - Smarter Solutions'),
			array('Blocks - Smarter Solutions')
		),
		array(
			array('Blocks - Better Results'),
			array('Blocks - Better Results')
		),
		array(
			array('Blocks - About Us'),
			array('Blocks - About Us')
		),
		array(
			array('Blocks - Request a Demo'),
			array('Blocks - Request a Demo')
		),
		array(
			array('Home - Recent Posts'),
			array('Home - Recent Posts')
		),
		array(
			array('Blog'),
			array('Blog')
		),
		array(
			array('Tag Search'),
			array('Tag Search')
		),
		array(
			array('Footer - Contact Information'),
			array('Footer - Contact Information')
		),
		array(
			array('Footer - Request a Demo'),
			array('Footer - Request a Demo')
		),
		array(
			array('Footer - Get Directions'),
			array('Footer - Get Directions')
		),
		array(
			array('Footer - Tweets'),
			array('Footer - Tweets')
		),
		array(
			array('Footer - Products'),
			array('Footer - Products')
		),
		array(
			array('Footer - Resources'),
			array('Footer - Resources')
		),
		array(
			array('Footer - Markets'),
			array('Footer - Markets')
		),
		array(
			array('Footer - Topics'),
			array('Footer - Topics')
		)
	);
foreach ($sidebars as $sidebar) {
	register_sidebar(array('name'=> $sidebar[0][0],
		'id'=> $sidebar[0][0],
		'description'   => '',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}



###############################################################33
// Setup Multiple post thumbnails for specific pages
###############################################################33
if (class_exists('MultiPostThumbnails')) {
	
	//thumbnails that are associated with clients
		$types = array('clients','clients');
		foreach($types as $type){
			new MultiPostThumbnails(array(
				'label' => 'Color Image',
				'id' => 'client_color_image',
				'post_type' => $type
			) );
		}
}





/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'twentyten_remove_recent_comments_style' );

if ( ! function_exists( 'twentyten_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'twentyten' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'twentyten_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
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


								
// Changing excerpt length - only works with AUTO excerpt
add_filter('excerpt_length', 'new_excerpt_length');
function new_excerpt_length($length) {
	return 100;
}


function add_query_vars($aVars) {
$aVars[] = "topic";
return $aVars;
}
function add_rewrite_rules($aRules) {
$aNewRules = array('topics/([^/]+)/?$' => 'index.php?pagename=topics&topic=$matches[1]');
$aRules = $aNewRules + $aRules;
return $aRules;
}
 
// hook add_rewrite_rules function into rewrite_rules_array
add_filter('rewrite_rules_array', 'add_rewrite_rules');
 
// hook add_query_vars function into query_vars
add_filter('query_vars', 'add_query_vars');





###############################################################
// dump
###############################################################
function dump($data) {
    if(is_array($data)) { //If the given variable is an array, print using the print_r function.
        print "<pre>-----------------------\n";
        print_r($data);
        print "-----------------------</pre>";
    } elseif (is_object($data)) {
        print "<pre>==========================\n";
        var_dump($data);
        print "===========================</pre>";
    } else {
        print "=========&gt; ";
        var_dump($data);
        print " &lt;=========";
    }
} 




function load_jquery() {
 
    // only use this method is we're not in wp-admin
    if (!is_admin())
    {
 
        // deregister the original version of jQuery
        wp_deregister_script('jquery');
 
        // register it again, this time with no file path
        wp_register_script('jquery', '', FALSE, '1.7.1');
 
        // add it back into the queue
        wp_enqueue_script('jquery');
 
    }
 
}
 
add_action('template_redirect', 'load_jquery');









// smarter remarketer challenge


 
 
 	// step one calculations
	add_action("gform_pre_submission_8", "pre_submission_handler_8");
	function pre_submission_handler_8($form){
	
		setlocale(LC_MONETARY, 'en_US.UTF-8');
			 
		$industry				= $_POST["input_6"];
		$online_revenue 		= $_POST["input_7"];
		$average_order_value 	= $_POST["input_8"];
		$total_site_value 		= $_POST["input_9"];
		
		
		
	
		switch ($industry) {
		    case "Apparel":
		        $industry_conversion_rate						= 0.0298;
		        $industry_shopping_cart_sessions				= 0.0916;
		        $industry_shopping_cart_conversion_rate 		= 0.2975;
		        $industry_shopping_cart_abandonment_rate		= 0.7025;
		        $industry_started_checkout_rate					= 0.3787;
		        break;
		    case "Catalog":
		        $industry_conversion_rate						= 0.035;
		        $industry_shopping_cart_sessions				= 0.0879;
		        $industry_shopping_cart_conversion_rate 		= 0.262;
		        $industry_shopping_cart_abandonment_rate		= 0.738;
		        $industry_started_checkout_rate					= 0.3335;
		        break;
		    case "General Store":
		        $industry_conversion_rate						= 0.0399;
		        $industry_shopping_cart_sessions				= 0.1012;
		        $industry_shopping_cart_conversion_rate 		= 0.3568;
		        $industry_shopping_cart_abandonment_rate		= 0.6432;
		        $industry_started_checkout_rate					= 0.4542;
		        break;
		    case "Health & Beauty":
		        $industry_conversion_rate						= 0.0447;
		        $industry_shopping_cart_sessions				= 0.1434;
		        $industry_shopping_cart_conversion_rate 		= 0.2945;
		        $industry_shopping_cart_abandonment_rate		= 0.7055;
		        $industry_started_checkout_rate					= 0.3749;
		        break;
		    case "Home Goods":
		        $industry_conversion_rate						= 0.0354;
		        $industry_shopping_cart_sessions				= 0.1076;
		        $industry_shopping_cart_conversion_rate 		= 0.2967;
		        $industry_shopping_cart_abandonment_rate		= 0.7033;
		        $industry_started_checkout_rate					= 0.3779;
		        break;
		    case "Software":
		        $industry_conversion_rate						= 0.029;
		        $industry_shopping_cart_sessions				= 0.0728;
		        $industry_shopping_cart_conversion_rate 		= 0.259;
		        $industry_shopping_cart_abandonment_rate		= 0.741;
		        $industry_started_checkout_rate					= 0.43;
		        break;
		    case "Specialty":
		        $industry_conversion_rate						= 0.075;
		        $industry_shopping_cart_sessions				= 0.1883;
		        $industry_shopping_cart_conversion_rate 		= 0.413;
		        $industry_shopping_cart_abandonment_rate		= 0.587;
		        $industry_started_checkout_rate					= 0.5257;
		        break;
		    case "Sporting Goods & Outdoors":
		        $industry_conversion_rate						= 0.026;
		        $industry_shopping_cart_sessions				= 0.0653;
		        $industry_shopping_cart_conversion_rate 		= 0.25;
		        $industry_shopping_cart_abandonment_rate		= 0.75;
		        $industry_started_checkout_rate					= 0.3182;
		        break;
		    case "Other":
		        $industry_conversion_rate						= 0.0458;
		        $industry_shopping_cart_sessions				= 0.115;
		        $industry_shopping_cart_conversion_rate 		= 0.3378;
		        $industry_shopping_cart_abandonment_rate		= 0.6622;
		        $industry_started_checkout_rate					= 0.43;
		        break;
		}
		
		// constants
		$percentage_of_checkouts_abandoned_that_can_be_reengaged 	= 0.75;
		$percentage_of_carts_abandoned_that_can_be_reengaged 		= 0.1;
		$conversion_rate_for_reengaged_checkouts 					= 0.08;
		$conversion_rate_for_reengaged_carts 						= 0.07;
		        
		        
		
		$number_of_transactions 				= intval(intval(str_replace(',', '', $online_revenue)) 	/ intval(str_replace(',', '', $average_order_value))				);
		$number_of_carts_started 				= intval($number_of_transactions 					/ $industry_shopping_cart_conversion_rate					);
		$number_of_total_abandoned_transactions = ($number_of_carts_started 				- $number_of_transactions									);
		$number_of_checkouts_abandoned			= ($number_of_total_abandoned_transactions 	* $industry_started_checkout_rate							);
		$number_of_carts_abandoned				= ($number_of_total_abandoned_transactions 	- $number_of_checkouts_abandoned							);
		$reengaged_checkouts					= ($number_of_checkouts_abandoned 			* $percentage_of_checkouts_abandoned_that_can_be_reengaged	);
		$reengaged_carts						= ($number_of_carts_abandoned 				* $percentage_of_carts_abandoned_that_can_be_reengaged		);
		$converted_checkouts					= ($reengaged_checkouts 					* $conversion_rate_for_reengaged_checkouts					);
		$converted_carts						= ($reengaged_carts 						* $conversion_rate_for_reengaged_carts						);
		$converted_checkout_revenue				= ($converted_carts 						* $average_order_value										);
		$converted_carts_revenue				= ($converted_checkouts 					* $average_order_value										);
		$anticipated_annual_recovered_revenue	= ($converted_checkout_revenue 				+ $converted_carts_revenue									);
		
		/* debug output
		echo 'industry = ' . $industry;
		echo 'online revenue = ' .    						intval(str_replace(',', '', $online_revenue)) . ' <br />';
		echo 'average order value = ' . 					intval(str_replace(',', '', $average_order_value)) . ' <br />';
		echo '$industry_shopping_cart_conversion_rate = ' . $industry_shopping_cart_conversion_rate . '<br />';
		echo 'number of transactions = ' . 					$number_of_transactions . ' <br />';
		echo 'number of carts started = ' . 				$number_of_carts_started . ' <br />';
		echo 'number of total abandoned transactions = ' . 	$number_of_total_abandoned_transactions . ' <br />';
		echo 'number of checkouts abandoned = ' . 			$number_of_checkouts_abandoned . ' <br />';
		echo 'number of carts abandoned = ' . 				$number_of_carts_abandoned . ' <br />';
		echo 'reengaged checkouts = ' . 					$reengaged_checkouts . ' <br />';
		echo 'reengaged carts = ' . 						$reengaged_carts . ' <br />';
		echo 'converted checkouts = ' . 					$converted_checkouts . ' <br />';
		die(0);
		*/
		
		
		$whole_form = 	'$number_of_transactions 					= ' . $number_of_transactions . 				' || ' . 
						'$number_of_carts_started 					= ' . $number_of_carts_started . 				' || ' . 
						'$number_of_total_abandoned_transactions 	= ' . $number_of_total_abandoned_transactions . ' || ' . 
						'$number_of_checkouts_abandoned				= ' . $number_of_checkouts_abandoned . 			' || ' . 
						'$number_of_carts_abandoned					= ' . $number_of_carts_abandoned . 				' || ' . 
						'$reengaged_checkouts						= ' . $reengaged_checkouts . 					' || ' . 
						'$reengaged_carts							= ' . $reengaged_carts . 						' || ' . 
						'$converted_checkouts						= ' . $converted_checkouts . 					' || ' . 
						'$converted_carts							= ' . $converted_carts . 						' || ' . 
						'$converted_checkout_revenue				= ' . $converted_checkout_revenue . 			' || ' . 
						'$converted_carts_revenue					= ' . $converted_carts_revenue . 				' || ' . 
						'$anticipated_annual_recovered_revenue		= ' . $anticipated_annual_recovered_revenue; 
		
				
		// update hidden fields
	    $_POST["input_10"] = round($converted_checkouts);
	    $_POST["input_11"] = money_format('%i', $converted_carts_revenue);
	    $_POST["input_12"] = money_format('%i', $converted_checkout_revenue);
	    $_POST["input_13"] = money_format('%i', $anticipated_annual_recovered_revenue);
	    $_POST["input_14"] = $whole_form;
	    $_POST["input_19"] = str_ireplace('USD ', '', $_POST["input_13"]);
	    
	    
	 
	 
	}
 
 
 	// step two form
	add_action("gform_pre_submission_9", "pre_submission_handler_9");
	function pre_submission_handler_9($form){
				 
		$form_step_1_id			= $_POST["input_3"];
		
		// update hidden fields
	    $_POST["input_3"] = 'http://smarter.tunedevelopment.com/wp-admin/admin.php?page=gf_entries&view=entry&id=8&lid=' . $form_step_1_id . '&filter=&paged=1&pos=0';	    
	 
	}
 
 
 	// step three form
	add_action("gform_pre_submission_10", "pre_submission_handler_10");
	function pre_submission_handler_10($form){
				 
		$form_step_1_id			= $_POST["input_42"];
		
		// update hidden fields
	    $_POST["input_42"] = $form_step_1_id;	    
	 
	}
	
	// send form values in an email for testing
	add_action("gform_post_submission", "set_post_content", 10, 2);
		 
		 function set_post_content($entry, $form){
		 //Gravity Forms has validated the data
		 //Our Custom Form Submitted via PHP will go here
		 
		 // Lets get the IDs of the relevant fields and prepare an email message
		 $message = print_r($entry, true);
		 
		 // In case any of our lines are larger than 70 characters, we should use wordwrap()
		 $message = wordwrap($message, 70);
		 
		 // Send
		 mail('matt@tunedevelopment.com', 'Getting the Gravity Form Field IDs', $message);
		 
		 
		 // set session variable that will allow the next page to keep the id of the form the user just filled out
		 $_SESSION['form_id']=$entry['id']; 
	}
 
 
	// encode function
	function encode_base64($sData){
		$sBase64 = base64_encode($sData);
		return substr(strtr($sBase64, '+/', '-_'), 0, -2);
	}
	
	// decode function
	function decode_base64($sData){
		$sBase64 = strtr($sData, '-_', '+/');
		return base64_decode($sBase64.'==');
	}
