<?php
	
	$thisurl = $_SERVER["REQUEST_URI"];
	
	if ($post->post_parent)	{
		$ancestors=get_post_ancestors($post->ID);
		$root=count($ancestors)-1;
		$parent = $ancestors[$root];
	} else {
		$parent = $post->ID;
	}
	
	if ( strstr( $thisurl, "/smarter-remarketer-solutions/" ) == true ) {
		echo '<h3>Smarter Solutions</h3>';
		wp_nav_menu( array( 'container' => false, 'container_class' => 'menu-header', 'theme_location' => 'primary', 'menu_class' => 'subnav clearfix', 'menu' => 'Smarter Solutions' ) );
	}
	
	
	if ( strstr( $thisurl, "/results/" ) == true || strstr( $thisurl, "/clients/" ) == true ) {
	
		echo '<h3>Better Results</h3>';
		wp_nav_menu( array( 'menu' => 'Better Results', 'depth' => '2', 'container_class' => 'subnav' ) );
		//wp_nav_menu( array( 'container' => false, 'container_class' => 'menu-header', 'theme_location' => 'primary', 'menu_class' => 'subnav clearfix', 'menu' => 'Better Results' ) );
	}
	
	
	if ( strstr( $thisurl, "/about/" ) == true || strstr( $thisurl, "/team/" ) == true ) {
		echo '<h3>About Us</h3>';
		wp_nav_menu( array( 'container' => false, 'container_class' => 'subnav', 'theme_location' => 'primary', 'menu_class' => 'subnav clearfix', 'menu' => 'About Us' ) );
	}
	
	
	if ( strstr( $thisurl, "/challenge/" ) == true ) {
		//echo '<h3>Challenge</h3>';
		//wp_nav_menu( array( 'container' => false, 'container_class' => 'subnav', 'theme_location' => 'primary', 'menu_class' => 'subnav clearfix', 'menu' => 'Challenge' ) ); ?>
	
		<ul id="menu-challenge" class="subnav clearfix">
			<li id="menu-item-2193" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2193"><a href="/challenge/challenge-faq/" data-reveal-id="myModal">Challenge FAQ</a></li>
			<li id="menu-item-2194" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2194"><a target="_blank" href="/about/company-fact-sheet/">Learn More About Smarter Remarketer</a></li>
			<li id="menu-item-2195" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2195"><a target="_blank" href="/results/case-studies/">Read Client Case Studies</a></li>
			<li id="menu-item-2201" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2201"><a target="_blank" href="/request-a-demo/">Request a Demo</a></li>
		</ul>
		
		<?php
	}
	
	
	
	
	
	/*
	$children = wp_list_pages("title_li=<h3>". get_the_title($parent) . "</h3>&child_of=". $parent ."&echo=0");

	if ($children) {
		echo '<ul class="subnav">';
		echo $children;
		echo '</ul>';
	} 
	*/
	
	/*
	if ( get_post_type($post->ID) == 'post' || get_post_type($post->ID) == 'insite' || get_post_type($post->ID) == 'whitepapers' || get_post_type($post->ID) == 'press_releases' || $parent == 18 || is_search() ) {
		$parent = 18;
		echo '<h2>' . get_the_title($parent) . '</h2>';
		$args = array(
			'menu'            => 'Inside SHP', 
			'container'       => 'ul', 
			'menu_class'      => 'subnav',
			'items_wrap'      => '<ul id="%1$s" class="pagenav">%3$s</ul>',);
		echo '<ul class="subnav">';
		wp_nav_menu( $args);
		echo '</ul>';
	} elseif ( (get_post_type($post->ID) == 'portfolio') || ( strstr( $thisurl, "/portfolio/" ) == true ) || ( strstr( $thisurl, "/portfolio-category/" ) == true ) ) {
		echo '<h2>Portfolio</h2>';
		$args = array(
			'menu'            => 'Portfolio', 
			'container'       => 'ul', 
			'menu_class'      => 'subnav',
			'items_wrap'      => '<ul id="%1$s" class="pagenav">%3$s</ul>',);
		echo '<ul class="subnav">';
		wp_nav_menu( $args);
		echo '</ul>';
	} elseif ( ( strstr( $thisurl, "/about/" ) == true ) || ( strstr( $thisurl, "/people/" ) == true) ) {
		echo '<h2>About</h2>';
		$args = array(
			'menu'            => 'About', 
			'container'       => 'ul', 
			'menu_class'      => 'subnav',
			'items_wrap'      => '<ul id="%1$s" class="pagenav">%3$s</ul>',);
		echo '<ul class="subnav">';
		wp_nav_menu( $args);
		echo '</ul>';
	} else {
		$children = wp_list_pages("title_li=<h2>". get_the_title($parent) . "</h2>&child_of=". $parent ."&echo=0");
	
		if ($children) {
			echo '<ul class="subnav">';
			echo $children;
			echo '</ul>';
		} 
	}
	*/




?>
