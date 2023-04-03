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
			<?php
			while ( have_posts() ) :
				the_post();
			?>

			<?php 
				if ( function_exists ( 'get_field' ) ) {
					?>
					<section class="logo">
						<?php
						$image = get_field('logo');
						$size = 'large';
							if( $image ) {
								echo wp_get_attachment_image( $image, $size );
							}
						?>
					</section>
				<?php
				}
				?>	
				<section class="shop-cta">
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
					?>
				</section>
				<div class= "content-wrapper">	

				<section class="wine-list-title">
					<?php
					if ( get_field( 'wine_list_title' ) ) : ?>
						<h3><?php the_field( 'wine_list_title' ); ?></h3>
						<?php
					endif;
					?>
				</section> 

				<section class="wine-list-description">
					<?php
						if ( get_field( 'wine_list_description' ) ) : ?>
							<p><?php the_field( 'wine_list_description' ); ?></p>
							<?php
						endif;
					?>
				</section> 

				</div>

				<section class="wine-list">
				<?php
				$featured_posts = get_field('wine_list');
				if( $featured_posts ): ?>
					
					<?php foreach( $featured_posts as $featured_post ): 
						$permalink = get_permalink( $featured_post->ID );
						$title = get_the_title( $featured_post->ID );
						$custom_field = get_field( 'field_name', $featured_post->ID );
					?>

					<section class="single-wine">
						<!-- <a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a> -->
						<?php echo get_the_post_thumbnail( $featured_post->ID, 'medium',); ?>
						<div class="flexed-wine">
							<h3><?php echo esc_html( $title ); ?></h3>
							<p><?php echo get_the_content( "", false, $featured_post->ID ); ?> </p>
						</div>
						
						<a href="<?php echo esc_url( $permalink ); ?>">Shop</a>
					</section>
						
					<?php endforeach; ?>
				<?php endif; ?>
				</section>
				<section class="shop-all-cta">
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
					}
					?>
				</section>
				

			<?php

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

	<?php
get_footer();