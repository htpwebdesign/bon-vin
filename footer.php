<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bon_Vin
 */

?>

	<footer id="colophon" class="site-footer">

		<nav class="footer-navigation">
			<?php
			wp_nav_menu( array('theme_location' => 'footer-left') );
			wp_nav_menu( array('theme_location' => 'footer-right') );
			?>
		</nav>

		<section>
		<p class="footer-quote"><?php bloginfo( 'description' ); ?></p>
		<p>&copy;<?php echo date('Y') ?></p>
		</section>

	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
