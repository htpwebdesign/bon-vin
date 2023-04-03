<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bon_Vin
 */

get_header();
?>

	<main id="primary" class="site-main about-main">
	<header class="about-title">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<?php

	while ( have_posts() ) :
		the_post();

		if (function_exists('get_field')) {
			?>
			<section class='about-wrapper'>
			<div class="content-wrapper">
				<?php
				$image = get_field('about_img');
				$size = 'large';
				if( $image ) {
					echo wp_get_attachment_image( $image, $size );
				}
		
				if ( get_field('about_description') ) {
					?>
					<p><?php the_field('about_description'); ?></p>
					<?php
				}
				?>
			</div>
				</section>
			

			<nav class="about-nav">
			<?php

			if ( get_field('shop_cta') ) {
				$link = get_field('shop_cta');
				if ($link) {
					$link_title = $link['title'];
					$link_url = $link['url'];
					?>
					<a href="<?php echo esc_url( $link_url ); ?>"><?php echo $link_title; ?></a>
					<?php
				}
			}
	
			if ( get_field('locations_cta') ) {
				$link = get_field('locations_cta');
				if ($link) {
					$link_title = $link['title'];
					$link_url = $link['url'];
					?>
					<a href="<?php echo esc_url( $link_url ); ?>"><?php echo $link_title; ?></a>
					<?php
				}
			}
	
			if ( get_field('careers_cta') ) {
				$link = get_field('careers_cta');
				if ($link) {
					$link_title = $link['title'];
					$link_url = $link['url'];
					?>
					<a href="<?php echo esc_url( $link_url ); ?>"><?php echo $link_title; ?></a>
					<?php
				}
			}
			?>
			</nav>
			<?php
		}

	endwhile;

	?>

	</main><!-- #main -->

<?php
get_footer();
