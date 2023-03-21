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
		$args = array(
			'post_type' => 'bon-vin-locations',
			'posts_per_page' => -1,
		);
		$query = new WP_QUERY( $args );
		if ( $query -> have_posts() ) :
			?>
			<div class="navigation-div">
			<?php
			while ( $query -> have_posts() ) :
				$query -> the_post();
				$id = get_the_ID();
				?>
				<a href="#<?php echo $id; ?>"><?php the_title(); ?></a>
				<?php
				if ( get_field( 'single_location' ) ) : ?>
					<h2><?php the_field( 'single_location' ); ?></h2>
					<?php
				endif;

					
			endwhile;
			wp_reset_postdata();
			?>
			</div>
			<?php
		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
