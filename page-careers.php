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

			get_template_part( 'template-parts/content', 'page' );

			$taxonomy = 'bon-vin-career-locations';
			$terms = get_terms( 
				array(
					'taxonomy' => $taxonomy,
					'hide_empty' => false,
				) 
			);

			if ( $terms && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {

					$args = array(
						'post_type'      => 'bon-vin-careers',
						'posts_per_page' => -1,
						'order'          => 'ASC',
						'orderby'        => 'title',
						'tax_query'      => array(
							array(
								'taxonomy' => $taxonomy,
								'field'    => 'slug',
								'terms'    => $term->slug,
							)
						),
					);
					$query = new WP_Query ($args);
					if ($query -> have_posts()) {
						?>
						<!-- <section class="career-buttons"> -->
						<button class="accord-button"><?php echo esc_html( $term->name );?></button>
						<!-- </section> -->
						<section class="careers-location">
						<?php
						
						while ($query -> have_posts()) {
							$query -> the_post();
							if ( function_exists( 'get_field' ) ) {
								if ( get_field( 'job_title' ) ) {
									?>
									<article class="career-job">
									<h3><?php the_field( 'job_title' ); ?></h3>
									<p><?php the_field('job_overview') ?></p>
									<a href="<?php the_permalink(); ?>">Details</a>
									</article>
									<?php
								}
							}
						}
						?>
						</section>
						<?php
					} else {
						?>
						<button class="accord-button"><?php echo esc_html( $term->name );?></button>
						<section class="careers-location">
							<p>No posting available for this location.</p>
						</section>
					<?php
					}
				}
				wp_reset_postdata();
			}

		endwhile; // End of the loop.
		?>


	</main><!-- #main -->

<?php
get_footer();
