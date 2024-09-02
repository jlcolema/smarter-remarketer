<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
 
?>

<div class="container dark contact">		
	<div class="boundary">
		<ul class="clearfix">
			<li class="contact-info col-1">
				<?php dynamic_sidebar( 'Footer - Contact Information' ); ?>
			</li>
			<li class="contact-info col-2 clearfix">
				<h3><a href="https://twitter.com/#!/SmarterHQ">@SmarterHQ</a></h3>
				<?php dynamic_sidebar( 'Footer - Tweets' ); ?>
			</li>
			<li class="contact-info col-3 clearfix">
				<div class="textwidget">
					<ul>
						<li>Get our updates.</li>
						<li class="clearfix">
							<ul class="buttons large">
								<li><a href="javascript:;" class="button newsletter"><span>Sign up for our Newsletter</span></a></li>
							</ul>
							<?php
								gravity_form(
									1, 
									false, 
									false,
									false,
									'', 
									true,
									false
								); 
							?>
						</li>
						<li>Stay connected with us:</li>
						<li>
							<ul class="social-media clearfix">
								<li><a href="https://twitter.com/#!/SmarterHQ" class="twitter"></a></li>
								<li><a href="http://www.linkedin.com/company/smarterremarketer-llc" class="linked-in"></a></li>
								<li><a href="mailto:LearnMore@smarterremarketer.com" class="email"></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</li>
		</ul>
	</div>
</div>

<div class="container orange links">	
	<div class="boundary clearfix">
		<footer class="footer-links">
			<div class="clearfix slidebox">
				<ul>
					<li class="fivecol span-1">
						<?php dynamic_sidebar( 'Footer - Products' ); ?>
					</li>
					<li class="fivecol span-1">
						<?php dynamic_sidebar( 'Footer - Resources' ); ?>
					</li>
					<li class="fivecol span-1">
						<?php dynamic_sidebar( 'Footer - Markets' ); ?>
					</li>
					<li class="fivecol span-2 breakable">
						<?php dynamic_sidebar( 'Footer - Topics' ); ?>
					</li>
				</ul>
			</div>
		</footer>
	</div>
</div>

<div class="container red copyright">	
	<div class="boundary">
		<footer class="clearfix">
			<ul class="clearfix">
				<li class="fivecol span-2">Copyright &copy; <?php print(Date("Y")); ?> Smarter Remarketer Inc. <span class="rights">All rights reserved.</span></li>
				<li class="fivecol span-3">
					<ul class="footer-links">
						<li><a href="/smarter-remarketer-solutions/">Smarter Solutions</a></li>
						<li><a href="/results/">Better Results</a></li>
						<li><a href="/about/">About Us</a></li>
						<li><a href="/blog/">Blog</a></li>
						<li><a href="/request-a-demo/">Request a Demo</a></li>
					</ul>
				</li>
			</ul>
		</footer>
	</div>
</div>

<?php /*
<div id="wide" class="mediaquery">wide viewport</div>
<div id="v960" class="mediaquery">&lt; 960px viewport</div>
<div id="v900" class="mediaquery">&lt; 900px viewport</div>
<div id="v800" class="mediaquery">&lt; 800px viewport</div>
<div id="v600" class="mediaquery">&lt; 600px viewport</div>
<div id="vlandscape" class="mediaquery">iPad in landscape</div>
<div id="vportrait" class="mediaquery">iPad in portrait</div>
<div id="mobile" class="mediaquery">mobile</div>
*/ ?>


<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

<script type="text/javascript">
var _sf_async_config={uid:20551,domain:"smarterremarketer.com"};
(function(){
  function loadChartbeat() {
    window._sf_endpt=(new Date()).getTime();
    var e = document.createElement('script');
    e.setAttribute('language', 'javascript');
    e.setAttribute('type', 'text/javascript');
    e.setAttribute('src',
       (("https:" == document.location.protocol) ? "https://a248.e.akamai.net/chartbeat.download.akamai.com/102508/" : "http://static.chartbeat.com/") +
       "js/chartbeat.js");
    document.body.appendChild(e);
  }
  var oldonload = window.onload;
  window.onload = (typeof window.onload != 'function') ?
     loadChartbeat : function() { oldonload(); loadChartbeat(); };
})();

</script>
</body>
</html>