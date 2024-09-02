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
 * Template Name: Challenge Results
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

							<h1><?php the_title(); ?></h1>

							<div class="graph">
							
								<?php 
															
									// start session
									session_start(); 
									
									// get the form information from the previous step
									$form_step_1 = RGFormsModel::get_lead($_SESSION['form_id']);
									
									setlocale(LC_MONETARY, 'en_US');
									$recover =  str_ireplace('USD ', '', $form_step_1[13]);
									$recover_clean = str_replace(',', '', $recover);
									
									//dump($recover);
									//dump($recover_clean);
								
								?>

								<h2>Smarter Remarketer can help you recover $<?php echo $recover; ?> in lost revenue!</h2>
								<script>
									jQuery(document).ready(function($) {
										arrayOfData = new Array(
										  	 [[<?php echo $recover_clean; ?>],'Smarter Remarketer<br />$<?php echo number_format($recover_clean); ?>','#F39B31'],
										  	 [[<?php echo $recover_clean/2; ?>],'Competitor C<br />$<?php echo number_format($recover_clean/2); ?>','#dddddd'],
										  	 [[<?php echo $recover_clean*2/5; ?>],'Competitor E<br />$<?php echo number_format($recover_clean*2/5); ?>','#eeeeee']
										  	 
										  	 
										  	 
										  	 
										);
										
										$('#revenue_graph').jqbargraph({
										  	 data: arrayOfData,
										  	 width:560,
										  	 height:240,
										  	 prefix: '$',
										  	 showValues:false,
										  	 legend:false,
										  	 legends:false
										});
									});
								</script>

								<div class="graph_outer"><div id="revenue_graph"><?php /*<img src="<?php bloginfo( 'template_directory' ); ?>/images/graph.jpg" alt="Graph details" /> */?></div></div>

								<div class="note">

									<p><em>Smarter Remarkets vs. typical recovered revenue from competitors.</em></p>

									<p><em>This calculation is a good estimation of the revenue you can recover with Smarter Remarketer. Providing further details about your unique visitors, cart and checkout abandonment, and category activity will allow us to very accurately predict the number of users you can reengage.</em></p>

								</div>

							</div>

							<?php gravity_form(9, $display_title=false, $display_description=false, $display_inactive=false, $field_values=null, $ajax=false, 1); ?>
							
							<script>
							
								jQuery(window).load(function() {

									jQuery('#input_9_3').val('<?php echo $_SESSION['form_id']; ?>');
									jQuery('#input_9_4').val('<?php echo $form_step_1['4']; ?>');
									jQuery('#input_9_5').val('<?php echo $form_step_1['7']; ?>');
									jQuery('#input_9_6').val('<?php echo $form_step_1['8']; ?>');
									jQuery('#input_9_7').val('<?php echo $form_step_1['9']; ?>');
									jQuery('#input_9_8').val('<?php echo $form_step_1['6']; ?>');
									
									console.log(<?php echo $_SESSION['form_id']; ?>);
									
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
