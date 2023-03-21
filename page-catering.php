<?php
/**
 * The template for displaying the catering page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bon_Vin
 */

get_header();
?>

	<main id="primary" class="site-main">
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
		<?php 
			if ( function_exists ( 'get_field' ) ) {
				?>
				<div classname="catering-description">
				<?php
				if ( get_field( 'catering_description' ) ) : ?>
					<p><?php the_field( 'catering_description' ); ?></p>
					<?php
				endif;
				?>
				</div>
				<div classname="catering-packages">
				<?php
				if ( get_field( 'packages_title' ) ) : ?>
					<h2><?php the_field( 'packages_title' ); ?></h2>
					<?php
					
				endif;

				if ( get_field( 'packages' ) ) : 
					if( have_rows('packages') ):
						while( have_rows('packages') ) : the_row(); ?>
						<h3><?php the_sub_field( 'package_name' ); ?></h3>
						<p><?php the_sub_field( 'package_description' ); ?></p>
						<?php
						endwhile;
					endif;
				endif;
			}
		?>
			<div classname="">
				<?php
				if ( function_exists ( 'gravity_form' ) ) {
					gravity_form( 1, false, false, false, '', false );
				}
				?>
			</div>
		</div>
	
	</main><!-- #main -->

<?php
get_footer();
