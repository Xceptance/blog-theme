<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

		</div><!-- #main -->

		<footer id="colophon" class="site-footer" role="contentinfo">

			<?php get_sidebar( 'footer' ); ?>
			
			<div class="site-info">
				<span>Copyright <a id="Xceptance-link" href="https://www.xceptance.com">Xceptance</a> 2015</span>
				<?php do_action( 'twentyfourteen_credits' ); ?>
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentyfourteen' ) ); ?>"><?php printf( __( '–Proudly powered by %s', 'twentyfourteen' ), 'WordPress' ); ?></a>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>

    <div id="privacy-message" style="display: none;">
	    <div id="inner" class="alert alert-info">
            <p class="explaination">We use cookies. For more information please read <a href="http://www.xceptance.com/en/contact/privacy.html">our privacy section</a>. We also use analytics. 
            By clicking <em>Opt-Out</em>, we will place a non-personalized cookie on your machine that indicates that you don‘t wish to be tracked.</p>
		
            <p class="text-right">
			    <button type="button" class="btn-link" onclick="$.cookie('privacy', 'true', { expires: 7, path: '/' }); $('#privacy-message').hide();">Opt-Out</button>
                <button type="button" class="btn btn-primary" onclick="$('#privacy-message').hide(); reportAnalytics();">I understand</button>
		    </p>
	    </div>
    </div>

    <!-- Piwik -->
    <script type="text/javascript">
      var _paq = _paq || [];
      _paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
      _paq.push(["setCookieDomain", "blog.xceptance.com"]);
      _paq.push(["setDomains", ["blog.xceptance.com"]]);
      _paq.push(["trackPageView"]);
      _paq.push(["enableLinkTracking"]);

      function reportAnalytics() {
            // sent this only, if the user did not opt-out and he has seen the privacy message once at least
            if ( ($.cookie('privacy-ack-displayed') == 'true') && ($.cookie('privacy') == undefined) ) {
                var u=(("https:" == document.location.protocol) ? "https" : "http") + "://stats.xceptance.com/";
                _paq.push(["setTrackerUrl", u+"piwik.php"]);
                _paq.push(["setSiteId", "3"]);
                var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
                g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
            }
      };
      reportAnalytics();
    </script>
    <!-- End Piwik Code -->

    <script type="text/javascript">
        // display the privacy message when not yet displayed, store this fact in a cookie
        // if DNT is set, do not do anything, because we auto-disable tracking based on the 
        // users wish
        var isDNT = navigator.doNotTrack == "yes" || navigator.doNotTrack == "1" || navigator.msDoNotTrack == "1";
        
        if ($.cookie('privacy-ack-displayed') == undefined && !isDNT) { 
            $('#privacy-message').show();
            $.cookie('privacy-ack-displayed', 'true', { expires: 7, path: '/' });
        }
    </script>

</body>
</html>
