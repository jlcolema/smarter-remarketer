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
 *
 * Template Name: Challenge Metrics
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

			<? if ( ! is_front_page() ) : ?>

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<section id="copy">
			
				<div class="subpage clearfix">

					<article>

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
														
								 // start session
								 session_start();
								 
								 // set session variable that will allow the next page to keep the id of the form the user just filled out
								// dump( $_SESSION['form_id'] ); 
								
								$form_step_2 = RGFormsModel::get_lead($_SESSION['form_id']);
								
								//dump($form_step_2);
								
							?>
							
							<?php if ($form_step_2['2'] == 'Ready To Talk') { ?>
							
								Thank you! Someone will be contacting you shortly.
							
							<? } else { ?>
								
								<h1><?php the_title(); ?></h1>
	
								<?php the_content(); ?>
	
								<?php gravity_form(10, $display_title=true, $display_description=true, $display_inactive=false, $field_values=null, $ajax=false, 1); ?>
							
							<?php } ?>
							
							<script>
							
								jQuery(window).load(function() {

									jQuery('#input_10_42').val('<?php echo $form_step_2['3']; ?>');
									jQuery('#input_10_44').val('<?php echo $form_step_2['4']; ?>');
									jQuery('#input_10_4').val('<?php echo number_format($form_step_2['5']); ?>');
									jQuery('#input_10_5').val('<?php echo number_format($form_step_2['6']); ?>');
									jQuery('#input_10_6').val('<?php echo number_format($form_step_2['7']); ?>');
									jQuery("#input_10_3").val('<?php echo $form_step_2['8']; ?>');
									
								});
							
							</script>
						</div>
						
					</article>
					
				</div>
				
			</section>

			<link rel="stylesheet" href="/wp-content/themes/smarterremarketer/js/reveal/reveal.css">	

			<script type="text/javascript" src="/wp-content/themes/smarterremarketer/js/reveal/jquery.reveal.js"></script>

			<?php
			
				$page_id = 2180;
				$page_data = get_page ( $page_id );
				$content = $page_data->post_content;
				$title = $page_data->post_title;
			
				echo '<div id="myModal" class="reveal-modal faq-modal">';
			
					echo '<h1>';
				
						echo $page_data->post_title;
				
					echo '</h1>';
				
					echo apply_filters( 'the_content', $page_data->post_content );

					echo '<a class="close-reveal-modal">&#215;</a>';

				echo '</div>';
			
			?>

			<?php endwhile; ?>

			<?php endif; ?>

		</section>
	</div>
</div>

<?php get_footer(); ?>
