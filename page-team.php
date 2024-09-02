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
							<h2>The Smarter Remarketer Team</h2>
						</header>
						<aside>
							<nav>
								<?php require('inc/subnav.php'); ?>
							</nav>
						</aside>
						<div class="copy" role="content">
							<?php
								$args = array(
									'numberposts'=>-1,
									'post_type'=>'team',
									'orderby'=>'menu_order',
									'order'=>'ASC',
									'post_status'=>'publish',
									'taxonomy' => 'team-role',
									'term' => 'team'
								);
								echo '<h1>Team</h1>';
								echo output_team($args);
								
								
								function output_team($args) {
									$items = get_posts($args);
									$i=0;
									foreach($items as $item):
										$image_url = get_the_post_thumbnail( $item->ID, 'thumb' );
										if( $i == 0 ) echo '<ul class="grid-people clearfix">';
										if( $i == 2 ) { $class = ' class="last"'; } else { $class=""; };
										echo '<li '.$class.'id="people_'.$item->ID.'">';
											echo '<a href="'.get_permalink($item->ID).'" class="grid_link">';
											echo '<div class="hover_info">';
												echo $image_url;
												echo '<h4>'.get_post_meta($item->ID, 'first_name', true).' '.get_post_meta($item->ID, 'last_name', true).'</h4>';
												echo '<p>'.get_post_meta($item->ID, 'position_title', true).'</p>';
												echo '<p>'.get_post_meta($item->ID, 'area_of_expertise', true).'</p>';
											echo '</div>';
											echo '</a>';
										echo '</li>';
										if( $i == 2 ) {
											echo '</ul>';
											$i=0;
										} else {
											$i++;	
										}
									endforeach;
									if($i != 0) echo '</ul>';
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