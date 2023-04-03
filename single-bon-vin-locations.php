<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

	<header class="entry-header locations">
        <?php the_title( "<h1 class='entry-title locations'>", "</h1>" );
			$image = get_field('single_location');
			$size = 'full'; // (thumbnail, medium, large, full or custom size)
				if( $image ) {
				echo wp_get_attachment_image( $image, $size );
				}
		?>

		<?php
		if ( get_field('cta') ) {
			$link = get_field('cta');
			if ($link) {
				$link_title = $link['title'];
				$link_url = $link['url'];
			?>
			<a href="<?php echo esc_url( $link_url ); ?>" class='locations-menu-btn'><?php echo $link_title; ?></a>
			<?php
				}
			}
			?>
    </header><!-- .entry-header -->

	<section class="location-info">

		<?php
		if ( get_field('location_description') ) {
			?>
			<p><?php the_field('location_description'); ?></p>
			<?php
		}
		?>

		<?php
		if (get_field('map')) {
		$location = get_field('map');
		if( $location ): 
		?>
    	<div class="acf-map" data-zoom="16">
       		<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
    	</div>
		<?php
		endif;
		}
		?>

		<?php
		if (get_field('location_address')) {
		?>
		<p><?php the_field('location_address'); ?></p>
		<?php
		}
		?>
	</section>

	<div class='hours-contact'>
			
		<section class="hours">		
			<?php
			if ( get_field('hours_title') ) {
			?>
				<h2><?php the_field('hours_title'); ?></h2>
			<?php
			}
			?>	

			<?php if (have_rows('hours')) : ?>
			<ul>
				<?php while (have_rows('hours')) : the_row(); ?>
					<li>
						<?php the_sub_field('day'); ?>
						<?php the_sub_field('hours'); ?>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php	
			endif;
			?>
		</section>

		<section class="contact-info">
			<?php
			if ( get_field('contact_title') ) {
				?>
				<h2><?php the_field('contact_title'); ?></h2>
				<?php
			}
			if ( get_field('phone') ) {
				?>
				<p><?php the_field('phone'); ?></p>
				<?php
			}
			?>
		</section>
	</div>

	<section class="apply">
		<?php
		if ( get_field('career_cta_blurb') ) {
			?>
			<p><?php the_field('career_cta_blurb'); ?></p>
			<?php
		}
		?>

		<?php
		if (get_field('career_cta')) :
			$link = get_field('career_cta');
			if( $link ): ?>
				<a class="button" href="<?php echo esc_url( $link ); ?>">Apply Now</a>
			<?php 	
			endif;
		endif; ?>
	</section>

	<?php
	endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php

get_footer();
