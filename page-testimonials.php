<?php
/**
 * The template for the portfolio grid.
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
							<h1><?php the_title(); ?></h1>
							<?php the_content(); ?>
							<?php
								$args = array(
									'numberposts'=>-1,
									'post_type'=>'testimonials',
									'orderby'=>'menu_order',
									'order'=>'ASC',
									'post_status'=>'publish'
								);
								$items = get_posts($args);
								foreach($items as $item):
									echo '<article class="testimonial">';
										if ( get_post_meta($item->ID, 'clienttestimonialsnippet', true) != "" ) {
											echo '<span class="client-name">&#8220;' . get_post_meta($item->ID, 'clienttestimonialsnippet', true) . '&#8221;</span>';
										}
										echo '<footer>';
											echo '<p>';
											if ( get_post_meta($item->ID, 'client_name', true) != "" ) {
												echo '<span class="client-name">' . get_post_meta($item->ID, 'client_name', true);
											}
											if ( get_post_meta($item->ID, 'client_title', true) != "" ) {
												echo ', ' . get_post_meta($item->ID, 'client_title', true) . '</span>';
											}
											if ( get_post_meta($item->ID, 'client_company_name', true) != "" ) {
												echo '<span class="client-company-name">' . get_post_meta($item->ID, 'client_company_name', true) . '</span>';
											}
											echo '</p>';
										echo '</footer>';
									echo'</article>';
								endforeach;
								
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