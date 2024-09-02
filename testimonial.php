
		<section title="testimonial">
			<div class="testimonial">
				<div class="container">
					<ul class="clearfix">
					<?php
						
						$thisurl = $_SERVER["REQUEST_URI"];
						if ( strstr( $thisurl, "/mindware/" ) == true ) {
							$my_post = 40;
							$slides = query_posts(array(
							    'p' => $my_post,
							    'post_type' => array('testimonials')
							));
							$type = "testimonial";
							
						} else if ( strstr( $thisurl, "/footwear-etc/" ) == true ) {
							$my_post = 132;
							$slides = query_posts(array(
							    'p' => $my_post,
							    'post_type' => array('page')
							));
							$type = "post";
							
						} else {
							$args = array(
								'numberposts'=>1,
								'post_type'=>'testimonials',
								'post_status'=>'publish',
								'orderby' => 'rand'
							);
							$slides = get_posts($args);
							$type = "testimonial";
							
						}
						if ($type == "testimonial") {
							foreach($slides as $slide): ?>
								<li class="quote left"><img src="<?php bloginfo( 'template_directory' ); ?>/images/quote-arrow-left.png" alt="quote-arrow-left" width="32" height="20" /></li>
								<li class="attribution">
									<p class="client-testimonial"><?php echo get_post_meta($slide->ID,'clienttestimonialsnippet',true); ?></p>
									<span class="client-name"><?php echo get_post_meta($slide->ID,'client_name',true); ?>, </span>
									<span class="client-company-name"><?php echo get_post_meta($slide->ID,'client_title',true); ?></span>
									<span class="client-company-name"><?php echo get_post_meta($slide->ID,'client_company_name',true); ?></span>
									<div class="button"><div><a href="/results/testimonials/"><span>More&nbsp;Testimonials</span></a></div></div>
								</li>
								<li class="quote right"><img src="<?php bloginfo( 'template_directory' ); ?>/images/quote-arrow-right.png" alt="quote-arrow-right" width="32" height="20" /></li>
						<?php 
							endforeach;
						} else if ($type == "post") {
							$content = $slides[0]->post_content;
							$content = apply_filters('the_content', $content);
							$content = str_replace(']]>', ']]&gt;', $content);
							echo $content;
						}
						?>
					</ul>
				</div>
			</div>
		</section>