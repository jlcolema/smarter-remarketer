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
			
			<!-- home page carousel -->
			<? if ( is_front_page() ) : ?>
				<?php require('inc/home_page_carousel.php'); ?>
							
				<!-- client logos -->
				<?php require('inc/clients.php'); ?>
			<?php endif; ?>
			
			<!-- main copy subpage -->
			<? if ( ! is_front_page() ) : ?>
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<section id="copy">
					<div class="subpage clearfix">
						<article title="<?php the_title(); ?>">
							<header>
								<h2><?php print_custom_field('page_headline'); ?></h2>
							</header>
							<?php if ( strstr( $_SERVER["REQUEST_URI"], "/request-a-demo/" ) == false || strstr( $_SERVER["REQUEST_URI"], "/etail/" ) == true  ): ?>
								<aside>
									<nav>
										<?php require('inc/subnav.php'); ?>
									</nav>
								</aside>
							<?php endif; ?>
							<div class="copy<?php if ( strstr( $_SERVER["REQUEST_URI"], "/request-a-demo/" ) == true || strstr( $_SERVER["REQUEST_URI"], "/etail/" ) == true ): ?> full<?php endif; ?>" role="content">
								<?php the_content(); ?>
							</div>
						</article>
					</div>
				</section>
				<?php endwhile; ?>
			<?php endif; ?>
			
		</section>
	</div>
</div>

<? if ( is_front_page() ) : ?>
	<div class="container light short">		
		<div class="boundary">
			<section class="home-copy clearfix">
				<article>
					<?php wp_reset_query(); the_content(); ?>
				</article>
				<aside>
					<ul>
						<li class="subnav">
							<?php dynamic_sidebar( 'Home - Recent Posts' ); ?>
						</li>
					</ul>
				</aside>
			</section>
		
			<!-- testimonial -->
			<?php require('inc/testimonial.php'); ?>
			
		</div>
	</div>
<?php endif; ?>

<? if ( is_front_page() ) : ?>
	<div class="container dark">		
		<div class="boundary">
							
				<!-- home page content blocks - top -->
				<?php require('inc/home_page_blocks_top.php'); ?>
				
			</section>
		</div>
	</div>
<?php endif; ?>

<? if ( is_front_page() ) : ?>
	<div class="container light bottom">		
		<div class="boundary clearfix">
		
			<!-- home page content blocks - bottom -->
				<?php require('inc/home_page_blocks_bottom.php'); ?>
			
		</div>
	</div>
<?php endif; ?>

<?php get_footer(); ?>