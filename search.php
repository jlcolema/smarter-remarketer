<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
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
			
		</section>
		
		<!-- main copy subpage -->
		<section id="copy">
			<div class="subpage clearfix">
				<article title="<?php the_title(); ?>">
					<header>
						<h2><?php printf( __( 'Search Results for: %s', 'twentyten' ), '' . get_search_query() . '' ); ?></h2>
					</header>
					<div class="copy full" role="content">							
						<?php if ( have_posts() ) : ?>
							<?php
							/* Run the loop for the search to output the results.
							* If you want to overload this in a child theme then include a file
							* called loop-search.php and that will be used instead.
							*/
							get_template_part( 'loop', 'search' );
							?>
						<?php else : ?>
							<h2><?php _e( 'Nothing Found', 'twentyten' ); ?></h2>
							<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentyten' ); ?></p>
							<?php get_search_form(); ?>
						<?php endif; ?>
					</div>
				</article>
			</div>
		</section>
	</div>
</div>

<div class="container light bottom">		
	<div class="boundary clearfix">
		
		<!-- testimonial -->
		<?php require('inc/testimonial.php'); ?>
		
	</div>
</div>

<?php get_footer(); ?>