
			<!-- <section title="clients">
				<div class="widget clearfix">
				
					<a href="#" class="prev"></a>
					
					<?php $args = array(
						'numberposts'=>-1,
						'post_type'=>'clients',
						'post_status'=>'publish',
						'orderby' => 'rand'
						); ?>
					
						<div class="widget_style">
							<ul class="clearfix">
								<?php $posts = get_posts($args);
								foreach($posts as $post): ?>
									<li><a href="/results/client-list/"><?php the_post_thumbnail(); ?></a></li>
								<?php endforeach; ?>
							</ul>
						</div>
					
					<a href="#" class="next"></a>
				
				</div>
			</section> -->

			<!-- New Clients Carousel -->

			<section>

				<div class="widget_new clearfix">
				
					<a href="#" class="prev"></a>
					
					<?php $args = array(
						'numberposts'=>-1,
						'post_type'=>'clients',
						'post_status'=>'publish',
						'orderby' => 'rand'
						); ?>
					
						<div class="widget_style_new">
							<ul class="client-list clearfix">
								<?php $posts = get_posts($args);
								foreach($posts as $post): ?>
									<li><a href="/results/client-list/"><?php the_post_thumbnail(); ?></a></li>
								<?php endforeach; ?>
							</ul>
						</div>
					
					<a href="#" class="next"></a>
				
				</div>

			</section>