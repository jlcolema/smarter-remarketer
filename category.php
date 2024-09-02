<?php
/**
 * The template for displaying Category Archive pages.
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
					<div class="border clearfix">
						<article title="<?php the_title(); ?>">
							<header>
								<h2>Smarter Remarketer Blog</h2>
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
								<h1><?php
									printf( __( 'Category Archives: %s', 'twentyten' ), '' . single_cat_title( '', false ) . '' );
								?></h1>
								<?php
									$category_description = category_description();
									if ( ! empty( $category_description ) )
										echo '' . $category_description . '';
				
								/* Run the loop for the category page to output the posts.
								 * If you want to overload this in a child theme then include a file
								 * called loop-category.php and that will be used instead.
								 */
								get_template_part( 'loop', 'category' );
								?>
							</div>
						</article>
					</div>
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