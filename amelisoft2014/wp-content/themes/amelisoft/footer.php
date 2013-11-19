<?php global $woo_options; ?>
	<?php
		$total = $woo_options['woo_footer_sidebars']; if ( ! isset( $total ) ) { $total = 4; }
		if ( ( woo_active_sidebar( 'footer-1' ) ||
			   woo_active_sidebar( 'footer-2' ) ||
			   woo_active_sidebar( 'footer-3' ) ||
			   woo_active_sidebar( 'footer-4' ) ) && $total > 0 ) {

  	?>

	<div id="footer-widgets">
		<div class="col-full col-<?php echo $total; ?>">

		<?php $i = 0; while ( $i < $total ) { $i++; ?>
			<?php if ( woo_active_sidebar( 'footer-' . $i ) ) { ?>

		<div class="block footer-widget-<?php echo $i; ?>">
        	<?php woo_sidebar( 'footer-' . $i ); ?>
		</div>

	        <?php } ?>
		<?php } ?>

		
		</div>
	</div><!-- /#footer-widgets  -->
    <?php } ?>

	<div id="footer">
		<div id="map-canvas"/></div>
		<div class="col-full">
			<p>Vytvořeno s láskou softwarovým studiem Amelisoft s.r.o.</p>
		</div>
	</div><!-- /#footer  -->
</div><!-- /#wrapper -->
<?php wp_footer(); ?>
<?php woo_foot(); ?>
</body>

    <script>
var map;
function initialize() {
  var mapOptions = {
    zoom: 17,
    center: new google.maps.LatLng(49.1991519, 16.6246558),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>

</html>