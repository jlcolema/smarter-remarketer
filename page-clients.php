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
		
			<!-- main copy subpage -->
			<section id="copy">
				<div class="subpage clearfix">
					<article title="<?php the_title(); ?>">
						<header>
							<h2>Data is common. Understanding is rare.</h2>
						</header>
						<aside>
							<nav>
								<?php require('inc/subnav.php'); ?>
							</nav>
						</aside>
						<div class="copy" role="content" id="grid-clients">
							<?php
								$args = array(
									'numberposts'=>-1,
									'post_type'=>'clients',
									'orderby'=>'menu_order',
									'order'=>'ASC',
									'post_status'=>'publish'
								);
								echo '<h1>Smarter Clients</h1>';
								echo output_team($args);
								
								
								function output_team($args) {
									$items = get_posts($args);
									$i=0;
									echo '<ul class="grid-clients clearfix">';
									foreach($items as $item):
										/* $image_url = wp_get_attachment_url( get_post_thumbnail_id($item->ID) ); */
										$image_url = wp_get_attachment_url(MultiPostThumbnails::get_post_thumbnail_id('clients', "client_color_image", $item->ID));
										if (get_post_meta($item->ID, 'case_study_link', true) != '') {
											$thisurl = get_post_meta($item->ID, 'case_study_link', true);
											$icon = 'icon case-study';
										} else if ( (get_post_meta($item->ID, 'testimonial_link', true) != '') ) {
											$thisurl = get_post_meta($item->ID, 'testimonial_link', true);
											$icon = 'icon testimonial';
										} else {
											$thisurl = 'javascript:;';
											$icon = '';
										}
										if( $i == 3 ) {
											$class = ' class="last"';
										} else {
											$class="";
										};
										echo '<li '.$class.'id="client_'.$item->ID.'">';
											echo '<a href="'.$thisurl.'" class="grid_link">';
												echo '<img src="' . $image_url . '" />';
												if ($icon != '') {
													echo '<div class="' . $icon . '"></div>';
												}
											echo '</a>';
										echo '</li>';
										$i++;
										if( $i == 4 ) {
											$i = 0;
										};
									endforeach;
									echo '</ul>';
								}
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
		
		<!-- testimonial -->
		<?php require('inc/testimonial.php'); ?>
		
	</div>
</div>

<?php get_footer(); ?>