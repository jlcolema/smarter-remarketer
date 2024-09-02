<?php

/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php
	if (function_exists('orderStyleJS')) {
		orderStyleJS( 'start' );
	}
?>
<script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 * We filter the output of wp_title() a bit -- see
	 * twentyten_filter_wp_title() in functions.php.
	 */
	wp_title( '|', true, 'right' );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link href='http://fonts.googleapis.com/css?family=Asap' rel='stylesheet' type='text/css' />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/reset.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/superfish.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/clients.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/layout.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/flexslider.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/media-queries.css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php bloginfo( 'template_directory' ); ?>/js/jquery.min.js"><\/script>'); jQuery.noConflict();</script>
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
?>

<script type="text/javascript" src="http://use.typekit.com/qix7muj.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<!-- <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/jcarousellite_1.0.1.min.js" /></script> -->
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/carousel.js" /></script>
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/jquery.ba-resize.min.js" /></script>
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/jquery.flexslider-min.js" /></script>
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/modernizr.js" /></script>
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/respond.min.js" /></script>
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/superfish.js" /></script>
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/hoverizr.js" /></script>
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/jqBarGraph.1.1.min.js" /></script>
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/site.js" /></script>
<script type="text/javascript">
	jQuery(window).load(function() {
		jQuery('.flexslider').flexslider();
	});
</script>
<?php
	if (function_exists('orderStyleJS')) {
		orderStyleJS( 'end' );
	}
?>
</head>

<body <?php body_class(); ?>>
