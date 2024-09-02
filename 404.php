<?php
/**
 * 404 Template.
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
			
		</section>
				
		<!-- main copy subpage -->
		<section id="copy">
			<div class="subpage clearfix">
				<article title="<?php the_title(); ?>">
					<header>
						<h2>Not Found</h2>
					</header>
					<div class="copy full" role="content">
						<h1><?php _e( 'Not Found', 'twentyten' ); ?></h1>
						<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'twentyten' ); ?></p>
						<?php get_search_form(); ?>
					
						<script type="text/javascript">
							// focus on search field after it has loaded
							document.getElementById('s') && document.getElementById('s').focus();
						</script>
					</div>
				</article>
			</div>
		</section>
			
	</div>
</div>

<div class="container light bottom">		
	<div class="boundary clearfix">
		
		<!-- testimonial -->
		<?php require('inc/testimonial.php'); ?>
		
	</div>
</div>

<?php get_footer(); ?>