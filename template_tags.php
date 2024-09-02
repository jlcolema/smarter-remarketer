<?php
/**
 * 
 * Template Name: Tag Search
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
			
			<section id="copy">
				<div class="subpage">
					<article class="clearfix" title="<?php the_title(); ?>">
						<header>
							<h2>Smarter Remarketer Tags</h2>
						</header>
						<aside>
							<nav>
								<ul>
									<li class="subnav">
										<?php dynamic_sidebar( 'Tag Search' ); ?>
									</li>
								</ul>
							</nav>
						</aside>
						<div class="copy" role="content">
							<?php
								if(isset($wp_query->query_vars['topic'])) {
									$tag = urldecode($wp_query->query_vars['topic']);
								} else {
									$tag = '';
								}
								$args = array(
									'numberposts'=>-1,
									'post_type'=>array ( 'post', 'page'),
									'orderby'=>'publish_date',
									'order'=>'DESC',
									'tag'=>$tag,
									'post_status'=>'publish'
								);
								$items = get_posts($args);
								echo '<h1>' . get_the_title() . '</h1>';
								foreach($items as $item):
									echo '<article class="news">';
										echo '<h4>' . $item->post_title . '</h4>';
										echo '<p>' . wp_trim_words( $item->post_content, $num_words = 55, $more = null ) . ' <a href="' . get_permalink($item->ID) . '" class="readmore">Read More</a></p>';
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