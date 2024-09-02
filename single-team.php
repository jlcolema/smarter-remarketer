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
			<section id="copy">
				<div class="subpage">
					<div class="border clearfix">
						<article title="<?php the_title(); ?>">
							<header>
								<h2>The Smarter Remarketer Team</h2>
							</header>
							<?php if ( strstr( $_SERVER["REQUEST_URI"], "/request-a-demo/" ) == false || strstr( $_SERVER["REQUEST_URI"], "/etail/" ) == true  ): ?>
								<aside>
									<nav>
										<?php require('inc/subnav.php'); ?>
									</nav>
								</aside>
							<?php endif; ?>
							<div class="copy" role="content">
								<h1><?php print_custom_field('first_name'); ?> <?php print_custom_field('last_name'); ?></h1>
								<div class="team photo">
									<ul class="clearfix">
										<li class="photo"><img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>" width="100%" /></li>
										<li class="info">								
											<?php
												if ( get_custom_field('position_title') !== '' ) {
													echo '<p class="title">' . get_custom_field('position_title') . '</p>';
												}
												if ( get_custom_field('phone') !== '' ) {
													echo '<p class="phone">' . get_custom_field('phone') . '</p>';
												}
												if ( get_custom_field('email_address') !== '' ) {
													echo '<p class="email_address"><a href="mailto:' . get_custom_field('email_address') . '">' . get_custom_field('email_address') . '</a></p>';
												}
												if ( get_custom_field('twitter_address') !== '' ) {
													echo '<p class="twitter_address"><a href="https://twitter.com/#!/' . get_custom_field('twitter_address') . '"><span></span>view profile</a></p>';
												}
												if ( get_custom_field('linked_in_address') !== '' ) {
													echo '<p class="linked_in_address"><a href="' . get_custom_field('linked_in_address') . '"><span></span>view profile</a></p>';
												}
											?>
										</li>
										<li><?php echo wpautop($post->post_content); ?></li>
									</ul>
								</div>
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