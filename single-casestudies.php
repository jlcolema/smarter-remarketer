<?php
/**
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
								<h2>Smarter Case Studies</h2>
							</header>
							<aside>
								<nav>
									<?php require('inc/subnav.php'); ?>
								</nav>
							</aside>
							<div class="copy" role="content">
							<?php
									echo '<h1>' . get_the_title() . '</h1>';
									echo '<p><img src="' . wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) . '" alt="" /></p>';
									echo the_content();
									
									$thisurl = get_post_meta($post->ID, 'case_study_link', true);
									echo '<p><a href="#" class="download book" data-reveal-id="myModal"></a></p>';
							?>
							<link rel="stylesheet" href="/wp-content/themes/smarterremarketer/js/reveal/reveal.css">	
							<script type="text/javascript" src="/wp-content/themes/smarterremarketer/js/reveal/jquery.reveal.js"></script>
							<div id="myModal" class="reveal-modal">
							<?php echo do_shortcode('[gravityform id="7" name="Download Case Study: General" description="false" ajax="true"]');	?>
								<a class="close-reveal-modal">&#215;</a>
							</div>
							</div>
												
							<script>
							
								jQuery(window).load(function() {

									jQuery('#input_7_8').val('<?php echo $thisurl; ?>');
									
								});
							
							</script>
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
