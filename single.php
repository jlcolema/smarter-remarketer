<?php
/**
 * The Template for displaying all single posts.
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
			
			<section id="copy">
				<div class="subpage">
					<article class="clearfix" title="<?php the_title(); ?>">
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
							<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
								<?php /*
								<?php previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'twentyten' ) . ' %title' ); ?>
								<?php next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '' ); ?>
								*/ ?>
								<h1>Blog</h1>
								<h2><?php the_title(); ?></h2>
							
								<div class="response">
									<?php twentyten_posted_on(); ?>
								</div>
								<?php the_content(); ?>
								<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
								
								<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
									<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 60 ) ); ?>
									<h3><?php printf( esc_attr__( 'About %s', 'twentyten' ), get_the_author() ); ?></h3>
									<?php the_author_meta( 'description' ); ?>
									<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
										<?php printf( __( 'View all posts by %s &rarr;', 'twentyten' ), get_the_author() ); ?>
									</a>
								<?php endif; ?>
							
								<?php twentyten_posted_in(); ?>
								<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
								
								<!-- AddThis Button BEGIN -->
								<div class="addthis_toolbox addthis_default_style ">
								<a class="addthis_button_preferred_1"></a>
								<a class="addthis_button_preferred_2"></a>
								<a class="addthis_button_preferred_3"></a>
								<a class="addthis_button_preferred_4"></a>
								<a class="addthis_button_compact"></a>
								<a class="addthis_counter addthis_bubble_style"></a>
								</div>
								<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4eb6f75d00b5bfcc"></script>
								<!-- AddThis Button END -->
				
								<?php /*
								<?php previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'twentyten' ) . ' %title' ); ?>
								<?php next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '' ); ?>
								*/ ?>
				
								<?php comments_template( '', true ); ?>
							
							<?php endwhile; // end of the loop. ?>
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