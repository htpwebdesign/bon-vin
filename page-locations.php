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

	<header>
		<?php the_title( '<h1 class="entry-title locations">', '</h1>' ); ?>
	</header>

	<main id="primary" class="site-main">

		<div class='locations-wrapper'>

			<?php
			while ( have_posts() ) :
				the_post();

				$args = array(
					'post_type'      => 'bon-vin-locations',
					'posts_per_page' => -1,
					'order'          => 'ASC',
					'orderby'        => 'title'
				);
				
				$query = new WP_Query( $args );
				
				if ( $query -> have_posts() ){
					while ( $query -> have_posts() ) {
						$query -> the_post();
						?>
						<section class='location'>
						<?php
						$image = get_field('single_location');
						$size = 'full';
						if( $image ) {
							echo wp_get_attachment_image( $image, $size );
						}
						?>

							<div class='location-style'>
								<h2><?php the_title(); ?></h2>
								<a href="<?php the_permalink(); ?> " class='location-button'>Details</a>
							</div>
						</section>
						<?php
					}
					wp_reset_postdata();
				}
		?>
		</div>	
		<?php
					
				if( have_rows('all_locations') ): 
					?>
					<div class="acf-map locations" data-zoom="16">
					<?php while ( have_rows('all_locations') ) : the_row(); 

							$location = get_sub_field('location_address');
							$title = get_sub_field('location_name');
						?>
						<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>">
							<h3><?php echo esc_html( $title ); ?></h3>
						</div>
						<?php endwhile; ?>
						</div>
					<?php endif;

					endwhile; // End of the loop.
				?>


	</main><!-- #main -->

<?php
get_footer();
