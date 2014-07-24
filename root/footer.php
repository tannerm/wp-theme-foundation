<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package {%= prefix %}
 */
?>

	</div><!-- #content -->
	<div class="row">
	<div class="large-12 columns">
		<div class="panel">
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php do_action( '{%= prefix %}_credits' ); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', '{%= prefix %}' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', '{%= prefix %}' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', '{%= prefix %}' ), '{%= prefix %}', '<a href="http://jaff.es/" rel="designer">jaff.es</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- panel -->
	</div>
</div><!-- row -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>