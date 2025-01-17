<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

<div class="container dark wide">	
	<div class="boundary">
		<section id="main">	
		
			<!-- header -->
			<header class="clearfix">
				<?php require('inc/logo.php'); ?>
				<?php require('inc/search.php'); ?>
				<?php require('inc/nav.php'); ?>				
		</header>
			<section id="copy">
				<div class="subpage">
					<div class="border clearfix">
						<article title="<?php the_title(); ?>">
							<header>
								<h2>Smarter Remarketer Blog</h2>
							</header>
							<aside>
								<nav>
									<ul>
										<li class="subnav">
											<?php dynamic_sidebar( 'Blog' ); ?>
										</li>
									</ul>
								</nav>
							</aside>
							<div class="copy" role="content">
								<h1>
									<?php if ( is_day() ) : ?>
										<?php printf( __( 'Daily Archives: %s', 'twentyten' ), get_the_date() ); ?>
									<?php elseif ( is_month() ) : ?>
										<?php printf( __( 'Monthly Archives: %s', 'twentyten' ), get_the_date('F Y') ); ?>
									<?php elseif ( is_year() ) : ?>
										<?php printf( __( 'Yearly Archives: %s', 'twentyten' ), get_the_date('Y') ); ?>
									<?php else : ?>
										<?php _e( 'Blog Archives', 'twentyten' ); ?>
									<?php endif; ?>
								</h1>
								
								<?php
									/* Since we called the_post() above, we need to
									 * rewind the loop back to the beginning that way
									 * we can run the loop properly, in full.
									 */
									rewind_posts();
								
									/* Run the loop for the archives page to output the posts.
									 * If you want to overload this in a child theme then include a file
									 * called loop-archives.php and that will be used instead.
									 */
									 get_template_part( 'loop', 'archive' );
								?>
							</div>
						</article>
					</div>
				</div>
			</section>
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