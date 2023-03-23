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

			get_template_part( 'template-parts/content', get_post_type() );
			?>
			<header class="entry-header">
            <?php the_title( "<h1 class=“entry-title”>", "</h1>" ); ?>
        </header><!-- .entry-header -->

<div class="main-image-location">
<?php

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
		<a href="<?php echo esc_url( $link_url ); ?>"><?php echo $link_title; ?></a>
		<?php
	}
	
}
?>
<?php 
$location = get_field('map');

if( $location ): ?>
    <div class="acf-map" data-zoom="16">
        <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
    </div>
<div class="location-description">
	<?php
	if ( get_field('location_description') ) {
			the_field('location_description');
		}
	?>
</div>

<div class="contact-info">
	<?php
	if ( get_field('contact_title') ) {
			the_field('contact_title');
		}
		if ( get_field('phone') ) {
			the_field('phone');
		}
		
		$email = get_field('email'); 
if ($email) {
    echo '<a href="mailto:' . $email . '">' . $email . '</a>';
}
	?>
</div>

<div class="hours-info">
	<?php
	if ( get_field('hours_title') ) {
		the_field('hours_title');
	}
	?>
</div>

<div class="hours">
<?php if (have_rows('hours')) : ?>
    <ul>
    <?php while (have_rows('hours')) : the_row(); ?>
        <li>
            <?php the_sub_field('day'); ?>
            <?php the_sub_field('hours'); ?>
            <?php // add more subfields as needed ?>
        </li>
    <?php endwhile; ?>
    </ul>
	<?php
	// No value.
else :
    // Do something...
endif;
?>
</div>

<div class="apply">
	<?php
$link = get_field('career_cta');
if( $link ): ?>
    <a class="button" href="<?php echo esc_url( $link ); ?>">Apply Now</a>
	<?php endif; ?>
</div>

<?php endif; ?>

     <!-- <iframe width="400" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.ca/maps?center=<?php the_field('maps'); ?>&q=<?php the_field('maps'); ?>&zoom=14&size=300x300&output=embed&iwloc=near"></iframe><br /> -->
		
</div>
<?php
			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'bon-vin' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'bon-vin' ) . '</span> <span class="nav-title">%title</span>',
				)
			);

			// // If comments are open or we have at least one comment, load up the comment template.
			// if ( comments_open() || get_comments_number() ) :
			// 	comments_template();
			// endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php

get_footer();
