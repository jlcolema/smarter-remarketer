<?php
/**
 * Template Name: Case Study Index
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
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<section id="copy">
					<div class="subpage clearfix">
						<article title="<?php the_title(); ?>">
							<header>
								<h2><?php print_custom_field('page_headline'); ?></h2>
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
									'post_type'=>'casestudies',
									'orderby'=>'menu_order',
									'order'=>'ASC',
									'post_status'=>'publish'
								);
								echo '<h1>Case Studies</h1>';
								
								
									$items = get_posts($args);
									$i=0;
									echo '<ul class="clearfix">';
									foreach($items as $item):
										//$thisurl = get_post_meta($item->ID, 'case_study_link', true);
										$thisurl = get_permalink($item->ID);
										echo '<li>';
											echo '<a href="'.$thisurl.'" class="grid_link">';
												echo $item->post_title;
											echo '</a>';
										echo '</li>';
									endforeach;
									echo '</ul>';
							?>
							</div>
						</article>
					</div>
				</section>
			<?php endwhile; ?>
			
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