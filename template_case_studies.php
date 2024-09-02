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
 * Template Name: Case Studies
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
								<?php the_content();
					
									$thisurl = $_SERVER["REQUEST_URI"];
									if ( strstr( $thisurl, "/footwear-etc/" ) == true ) {
										$my_file = '/wp-content/uploads/2012/02/Footwear-Etc.pdf';										
									} else if ( strstr( $thisurl, "/mindware/" ) == true ) {
										$my_file = '/wp-content/uploads/2012/02/Mindware.pdf';											
									} else if ( strstr( $thisurl, "/case-study-onestop-internet/" ) == true ) {
										$my_file = '/wp-content/uploads/2012/09/Case_Study_Download_Onestop_2012.pdf';											
									} 
									
								
									/* this code determines if the user has filled out the form.  if they have, just display document links - not the link to the form
									if ( isset ( $_COOKIE['whitepapers'] ) ) {
										echo '<p><a href="' . $my_file . '" class="download book"></a></p>';
									} else {
										echo '<p><a href="#contactForm" class="download book"></a></p>';
										echo '<script type="text/javascript">jQuery(document).ready(function() { jQuery("#doc").val("' . $my_file . '"); });</script>';
									} 
									*/
										//echo '<p><a href="#contactForm" class="download book"></a></p>';
										echo '<p><a href="#" class="download book" data-reveal-id="myModal"></a></p>';
										//echo '<script type="text/javascript">jQuery(document).ready(function() { jQuery("#doc").val("' . $my_file . '"); });</script>';
									
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


<?php /* old modal code		
<script type='text/javascript' src='<?php bloginfo( 'template_directory' ); ?>/js/modal_form.js'></script>
<script type='text/javascript' src='<?php bloginfo( 'template_directory' ); ?>/js/jquery.cookie.js'></script>
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/jquery.validationEngine.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/modal_form.css" />	
<div class="contact-form clearfix">
		<form action="<?php bloginfo( 'template_directory' ); ?>/processForm.php" method="post" id="contactForm">
			<input type="hidden" name="doc" value="" id="doc" />
			<input type="hidden" name="subject" value="Case Study Download" id="subject" />
			<h5>Download Case Study</h5>
			<ul>
				<li>
					<label>FIRST NAME*</label>
					<span class="wpcf7-form-control-wrap your-first-name">
					<input type="text" name="your-first-name" id="your-first-name" value="" class="wpcf7-text wpcf7-validates-as-required" size="40" />
					</span>
				</li>
				<li class="last">
					<label>LAST NAME*</label>
					<span class="wpcf7-form-control-wrap your-last-name">
					<input type="text" name="your-last-name" id="your-last-name" value="" class="wpcf7-text wpcf7-validates-as-required" size="40" />
					</span>
				</li>
			</ul>
			<ul>
				<li>
					<label>EMAIL*</label>
					<span class="wpcf7-form-control-wrap your-email">
					<input type="text" name="your-email" id="your-email" value="" class="validate[required,custom[email]] wpcf7-text wpcf7-validates-as-email wpcf7-validates-as-required" size="40" />
					</span>
				</li>
				<li class="last">
					<label>ORGANIZATION*</label>
					<span class="wpcf7-form-control-wrap your-organization">
					<input type="text" name="your-organization" id="your-organization" value="" class="wpcf7-text wpcf7-validates-as-required" size="40" />
					</span>
				</li>
			</ul>
			<ul>
				<li>
					<label>PHONE*</label>
					<span class="wpcf7-form-control-wrap your-phone">
					<input type="text" name="your-phone" id="your-phone" value="" class="wpcf7-text wpcf7-validates-as-required" size="40" />
					</span>
				</li>
				<li class="last">
					<label>&nbsp;</label>
					<input type="submit" value="Send" id="sendMessage" name="sendMessage" />
					<img class="ajax-loader" style="visibility: hidden;" alt="Sending ..." src="/wp-content/plugins/contact-form-7/images/ajax-loader.gif" />
				</li>
			</ul>
			<ul>
				<li class="required">*required field</li>
			</ul>
			<a href="#" id="cancel"><img src="<?php bloginfo( 'template_directory' ); ?>/images/btn_close.png" alt="btn_close" width="30" height="30" /></a>
		</form>
</div>

<div id="sendingMessage" class="statusMessage"><p>Submitting. Please wait...</p></div>
<div id="successMessage" class="statusMessage"><p>Thank you.  Your download will begin shortly.</p></div>
<div id="failureMessage" class="statusMessage"><p>There was a problem processing the form. Please try again.</p></div>
<div id="incompleteMessage" class="statusMessage"><p>Please complete all the fields in the form before sending.</p></div>
*/ ?>


<link rel="stylesheet" href="/wp-content/themes/smarterremarketer/js/reveal/reveal.css">	
<script type="text/javascript" src="/wp-content/themes/smarterremarketer/js/reveal/jquery.reveal.js"></script>
<div id="myModal" class="reveal-modal">
<?php

	$thisurl = $_SERVER["REQUEST_URI"];
	if ( strstr( $thisurl, "/footwear-etc/" ) == true ) {
		echo do_shortcode('[gravityform id="5" name="Download Case Study: Footwear Etc." description="false" ajax="true"]');									
	} else if ( strstr( $thisurl, "/mindware/" ) == true ) {
		echo do_shortcode('[gravityform id="4" name="Download Case Study: MindWare" description="false" ajax="true"]');									
	} else if ( strstr( $thisurl, "/case-study-onestop-internet/" ) == true ) {
		echo do_shortcode('[gravityform id="3" name="Download Case Study: Onestop Internet" description="false" ajax="true"]');
	} else if ( strstr( $thisurl, "/case-study-chaparral/" ) == true ) {
		echo do_shortcode('[gravityform id="6" name="Download Case Study: Chapparal" description="false" ajax="true"]');	 
	}
	
?>
	<a class="close-reveal-modal">&#215;</a>
</div>

<?php get_footer(); ?>