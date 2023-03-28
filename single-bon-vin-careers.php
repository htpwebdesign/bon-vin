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
			<h1><?php the_title() ?></h1>
			<?php
			if (function_exists('get_field')) {

				?>
				<section class="single-job-description">
				<?php
	
				if (get_field('job_description')) {
					the_field('job_description');
				}
				?>
				</section>
	
				<section class="single-job-qualification">
				<?php
				if (get_field('job_qualifications')) {
					$field = get_field_object('job_qualifications');
					?>
					<h2><?php echo $field['label'] ?></h2>
					<?php the_field('job_qualifications'); ?>
					<?php
				}
				?>
				</section>
	
				<section class="single-job-apply">
				<?php
				if (get_field('how_to_apply')) {
					$field = get_field_object('how_to_apply');
					?>
					<h2><?php echo $field['label'] ?></h2>
					<p><?php the_field('how_to_apply'); ?></p>
					<?php
				}
	
				if (get_field('job_email')) {
					?>
					<a href="mailto: <?php the_field('job_email') ?>">Apply</a>
					<?php
				}
				?>
				</section>
				<?php
			}

		endwhile; // End of the loop.

		?>

	</main><!-- #main -->

<?php
get_footer();
