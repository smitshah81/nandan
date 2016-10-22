<?php
/* Footer Sidebar
 * Footer 
 * Google Analytics
 */
?>
</div><!-- #main -->
	
	<?php if ( get_option( 'atp_footer_sidebar' ) != 'on' ) { ?>
	<div id="footer">
		<div class="inner">
			<?php get_template_part( 'sidebar', 'footer' ); ?>
		</div>
		
		<?php if ( get_option('atp_leftcopyright') || get_option('atp_rightcopyright') != '' ) { ?>
		<div class="copyright">
			<div class="inner">
				<div class="copyright_left">
					<?php
					echo  do_shortcode( stripslashes( get_option('atp_leftcopyright')));
					?>
				</div>
				<div class="copyright_right">
					<?php echo do_shortcode(get_option('atp_rightcopyright')); ?>
				</div>
	
			</div><!-- .inner -->
		</div><!-- .copyright -->
		<?php } ?>

	</div><!-- #footer -->
	<?php } ?>

</div><!-- #wrapper -->
</div><!-- #layout -->

<div id="back-top"><a href="#header"><span></span></a></div>

<?php wp_footer();?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-75597082-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>