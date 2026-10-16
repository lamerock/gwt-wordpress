<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package GWT
 * @since Government Website Template 2.0
 */

?>
	

<!-- agency footer -->
<?php
if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ||
is_active_sidebar( 'footer-4' ) ) :
	?>
<div id="footer" class="anchor" name="agencyfooter">
	<div id="supplementary" class="row">
	<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
	<div class="<?php govph_displayoptions( 'govph_position_agency_footer' ); ?>" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<?php dynamic_sidebar( 'footer-1' ); ?>
	</div>
	<?php endif; // If active footer-1. ?>

	<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
	<div class="<?php govph_displayoptions( 'govph_position_agency_footer' ); ?>" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<?php dynamic_sidebar( 'footer-2' ); ?>
	</div>
	<?php endif; // If active footer-2. ?>

	<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
	<div class="<?php govph_displayoptions( 'govph_position_agency_footer' ); ?>" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<?php dynamic_sidebar( 'footer-3' ); ?>
	</div>
	<?php endif; // If active footer-3. ?>

	<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
	<div class="<?php govph_displayoptions( 'govph_position_agency_footer' ); ?>" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<?php dynamic_sidebar( 'footer-4' ); ?>
	</div>
	<?php endif; // If active footer-4. ?>
	</div>
</div>
<?php endif; ?>

<!-- standard footer -->
<div id="gwt-standard-footer"></div>
<!-- end standard footer -->

</div><!-- #off-canvass-content -->
</div><!-- #off-canvass-wrapper inner -->
</div><!-- #off-canvass-wrapper -->

<!-- standard footer script -->
<script type="text/javascript">
(function(d, s, id) {
	var js, gjs = d.getElementById('gwt-standard-footer');

	js = d.createElement(s); js.id = id;
	js.src = "//gwhs.i.gov.ph/gwt-footer/footer.js";
	gjs.parentNode.insertBefore(js, gjs);
}(document, 'script', 'gwt-footer-jsdk'));
</script>


<!-- philippine standard time script-->
<script type="text/javascript" id="gwt-pst">
var gwtpstClockStarted = false;

var gwtpstUseLocalTime = function() {
	var target = document.getElementById('pst-time');
	if (!target || gwtpstClockStarted || typeof Intl === 'undefined' || !Intl.DateTimeFormat) {
		return;
	}

	var formatter = new Intl.DateTimeFormat('en-PH', {
		timeZone: 'Asia/Manila',
		weekday: 'long',
		month: 'long',
		day: '2-digit',
		year: 'numeric',
		hour: 'numeric',
		minute: '2-digit',
		second: '2-digit',
		hour12: true
	});
	var updateTime = function() {
		target.textContent = formatter.format(new Date());
	};

	gwtpstClockStarted = true;
	updateTime();
	window.setInterval(updateTime, 1000);
};

var gwtpstReady = function() {
	if (gwtpstClockStarted) {
		return;
	}

	try {
		new gwtpstTime('pst-time');
		gwtpstClockStarted = true;
	} catch (error) {
		gwtpstUseLocalTime();
	}
}

if (document.getElementById('pst-time')) {
	var pstScript = document.createElement('script');
	pstScript.id = 'gwt-pst-jsdk';
	pstScript.src = '//gwhs.i.gov.ph/pst/gwtpst.js?' + new Date().getTime();
	document.getElementById('gwt-pst').parentNode.insertBefore(pstScript, document.getElementById('gwt-pst'));
	window.setTimeout(gwtpstUseLocalTime, 5000);
}
</script>
<!-- end philippine standard time -->

<?php wp_footer(); ?>

<div><a href="#page" id="back-to-top" style="display: inline;"><i class="fa fa-arrow-circle-up fa-2x"></i></a></div>
</body>
</html>
