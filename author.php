<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

<?php
	/* Queue the first post, that way we know who
	 * the author is when we try to get their name,
	 * URL, description, avatar, etc.
	 *
	 * We reset this later so we can run the loop
	 * properly with a call to rewind_posts().
	 */
?>

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
								<?php if ( have_posts() ) the_post(); ?>
									
									<h1><?php printf( __( 'Author Archives: %s', 'twentyten' ), "<a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a>" ); ?></h1>
									
									<?php
									// If a user has filled out their description, show a bio on their entries.
									if ( get_the_author_meta( 'description' ) ) : ?>
									
										<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 60 ) ); ?>
										<h2><?php printf( __( 'About %s', 'twentyten' ), get_the_author() ); ?></h2>
										<?php the_author_meta( 'description' ); ?>
									
									<?php endif; ?>
									
									<?php
									/* Since we called the_post() above, we need to
									* rewind the loop back to the beginning that way
									* we can run the loop properly, in full.
									*/
									rewind_posts();
									
									/* Run the loop for the author archive page to output the authors posts
									* If you want to overload this in a child theme then include a file
									* called loop-author.php and that will be used instead.
									*/
									get_template_part( 'loop', 'author' );
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
	
		<!-- home page content blocks - bottom -->
		<? if ( is_home() || is_front_page() ) : ?>
			<?php require('inc/home_page_blocks_bottom.php'); ?>
		<?php endif; ?>
		
		<!-- testimonail -->
		<?php require('inc/testimonial.php'); ?>
		
	</div>
</div>

<?php get_footer(); ?>