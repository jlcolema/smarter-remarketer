<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0 
 * 
 * Template Name: Book
 */

get_header(); ?>

<div class="container dark wide">	
	<div class="boundary clearfix">
		<section id="main">	
		
			<!-- header -->
			<header class="clearfix">
				<?php require('inc/logo.php'); ?>
				<?php require('inc/search.php'); ?>
				<?php require('inc/nav.php'); ?>			
			</header>
			
			<!-- main copy subpage -->
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<section id="copy">
					<div class="subpage clearfix">
						<article title="<?php the_title(); ?>">
							<header>
								<h2><?php print_custom_field('page_headline'); ?></h2>
							</header>
							<aside>
								<nav>
									<?php require('inc/subnav.php'); ?>
								</nav>
							</aside>
							<div class="copy" role="content">
								<?php the_content(); ?>
								
								<p><a href="#" class="download book" data-reveal-id="myModal"></a></p>
								
								<link rel="stylesheet" href="/wp-content/themes/smarterremarketer/js/reveal/reveal.css">	
								<script type="text/javascript" src="/wp-content/themes/smarterremarketer/js/reveal/jquery.reveal.js"></script>
								<div id="myModal" class="reveal-modal">
								<?php echo do_shortcode('[gravityform id="10" name="Download the book - Unabandoned" description="false" ajax="true"]');	?>
									<a class="close-reveal-modal">&#215;</a>
								</div>
							</div>
						</article>
					</div>
				</section>
			<?php endwhile; ?>
			
		</section>
	</div>
</div>

<div class="container light">		
	<div class="boundary">
		
		<!-- testimonial -->
		<?php require('inc/testimonial.php'); ?>
		
	</div>
</div>

<?php get_footer(); ?>
