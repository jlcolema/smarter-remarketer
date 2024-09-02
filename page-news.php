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
							<h2>Smarter Remarketer News</h2>
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
							<?php
								$args = array(
									'numberposts'=>-1,
									'post_type'=>'news',
									'orderby'=>'publish_date',
									'order'=>'DESC',
									'post_status'=>'publish'
								);
								$items = get_posts($args);
								echo '<h1>' . get_the_title() . '</h1>';
								foreach($items as $item):
									echo '<article class="news">';
										echo '<h4>' . $item->post_title . '</h4>';
										echo '<p>' . $item->post_excerpt . ' <a href="' . $item->guid . '" class="readmore">Continue Reading &rarr;</a></p>';
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
		
		<!-- testimonial -->
		<?php require('inc/testimonial.php'); ?>
		
	</div>
</div>

<?php get_footer(); ?>