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
 * Template Name: Challenge Welcome
 *
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

			<? if ( ! is_front_page() ) : ?>

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<section id="copy">
			
				<div class="subpage clearfix">

					<article>

						<header>
						
							<h2><?php print_custom_field('page_headline'); ?></h2>
							
						</header>

						<aside>

							<nav>
							
								<?php require('inc/subnav.php'); ?>
								
							</nav>
							
						</aside>

						<div class="copy" role="content">

							<h1><?php the_title(); ?></h1>

							<?php the_content(); ?>

							<?php gravity_form(8, $display_title=true, $display_description=true, $display_inactive=false, $field_values=null, $ajax=false, 1); ?>

						</div>
						
					</article>
					
				</div>
				
			</section>

			<?php endwhile; ?>

			<?php endif; ?>

		</section>
	</div>
</div>

<?php get_footer(); ?>