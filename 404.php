<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Bon_Vin
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'bon-vin' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-404-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below?', 'bon-vin' ); ?></p>
					<a href="/home">Click to go back to homepage</a>
					<a href="/shop">Click to look at our shop</a>
				
			</div><!-- .page-content -->

		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
