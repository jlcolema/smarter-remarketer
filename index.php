<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
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
					<article class="clearfix" title="<?php the_title(); ?>">
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
							<h1>Blog</h1>
							<?php
							/* Run the loop to output the posts.
							 * If you want to overload this in a child theme then include a file
							 * called loop-index.php and that will be used instead.
							 */
							 get_template_part( 'loop', 'index' );
							?>
						</div>
					</article>
				</div>
			</section>
		</section>
	</div>
</div>

<div class="container light">		
	<div class="boundary">
	
		<!-- home page content blocks - bottom -->
		<? if ( is_home() || is_front_page() ) : ?>
			<?php require('inc/home_page_blocks_bottom.php'); ?>
		<?php endif; ?>
		
		<!-- testimonail -->
		<?php require('inc/testimonial.php'); ?>
		
	</div>
</div>

<?php get_footer(); ?>