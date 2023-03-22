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

<main id="primary" class="site-main">
		

		<div class="logo">
		<?php 
			if ( function_exists ( 'get_field' ) ) {
				?>
				<div classname="logo">
					<?php
					if (get_field('logo')): ?> 
					<img src=" <?php the_field('logo'); ?> "/>
					<?php
					endif;
					?>
					
				<div>

				<div classname="shop-cta">
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
				}?>

				<div classname="wine-list">
					<?php
					if ( get_field( 'wine_list_title' ) ) : ?>
						<p><?php the_field( 'wine_list_title' ); ?></p>
						<?php
					endif;
					?>
				</div> 

				<div classname="wine-list-description">
				<?php
					if ( get_field( 'wine_list_description' ) ) : ?>
						<p><?php the_field( 'wine_list_description' ); ?></p>
						<?php
					endif;
					?>
				</div> 

				<div classname="shop-all-cta">
				<?php 
				if ( get_field('shop_cta') ) {
					$link = get_field('shop_all_cta');
					if ($link) {
						$link_title = $link['title'];
						$link_url = $link['url'];
						?>
						<a href="<?php echo esc_url( $link_url ); ?>"><?php echo $link_title; ?></a>
						<?php
					}
				}?>

				<div classname="wine-list">
					<?php

					?>

				</div>
				
				<?php
			}
			
		?>
			
	</div>
	
</main><!-- #main -->

<?php
get_footer();
