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
 * Template Name: Challenge Results
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

							<div class="graph">

								<h2>Smarter Remarketer can help you recover $1,000 in lost revenue!</h2>

								<div><img src="<?php bloginfo( 'template_directory' ); ?>/images/graph.jpg" alt="Graph details" /></div>

								<div class="note">

									<p><em>Smarter Remarkets vs. typical recovered revenue from competitors.</em></p>

									<p><em>This calculation is a good estimation of the revenue you can recover with Smarter Remarketer. Providing further details about your unique visitors, cart and checkout abandonment, and category activity will allow us to very accurately predict the number of users you can reengage.</em></p>

								</div>

							</div>

							<?php gravity_form(9, $display_title=false, $display_description=false, $display_inactive=false, $field_values=null, $ajax=false, 1); ?>

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