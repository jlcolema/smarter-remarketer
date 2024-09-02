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
		
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<section id="copy">
				<div class="subpage clearfix">
					<article title="<?php the_title(); ?>" class="clearfix">
						<header>
							<h2>Smarter Remarketer Events</h2>
						</header>
						<aside>
							<nav>
								<ul class="subnav clearfix">
									<?php dynamic_sidebar( 'Home - Recent Posts' ); ?>
								</ul>
							</nav>
						</aside>
						<div class="copy" role="content">
							<?php the_content(); ?>
						</div>
					</article>
				</div>
			</section>
			
			<?php endwhile; ?>
	</div>
</div>

<div class="container light">		
	<div class="boundary">
		
		<!-- testimonial -->
		<?php require('inc/testimonial.php'); ?>
		
	</div>
</div>

<?php get_footer(); ?>