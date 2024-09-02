			<section class="carousel" id="carousel">
				<article class="clearfix">
					<aside>
						<div class="pad clearfix">
							<?php
								$post_id = 2176;
								$items = get_post($post_id);
								
								echo wpautop($items->post_content);
							?>
								
						</div>
					</aside>
					
					<?php $args = array(
						'numberposts'=>-1,
						'post_type'=>'homepage_slideshow',
						'post_status'=>'publish',
						'orderby' => 'menu_order',
						'order' => 'ASC'
						); ?>
					
					<div class="flexslider clearfix">
						<ul class="slides">
							<?php
								$posts = get_posts($args);
								foreach($posts as $post): ?>
									<li><?php echo '<a href="' . get_post_meta($post->ID,'link',true) . '"><img src="' . wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) . '" /></a>'; ?></li>
								<?php endforeach; ?>
						</ul>
					</div>
				</article>
			</section>
