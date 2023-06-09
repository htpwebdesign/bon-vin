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
				
	<section class="hero-img">
		<?php
		$image = get_field('hero_img');
		$size = 'large';
		if( $image ) {
			echo wp_get_attachment_image( $image, $size );
		}
		}
		?>

		<?php
		if ( function_exists ( 'get_field' ) ) {
		?>
		<div class="logo">
			<?php
			$image = get_field('logo');
			$size = 'full';
			if( $image ) {
				echo wp_get_attachment_image( $image, $size );
			}
			?>
		</div>
		<?php
		}
		?>

		<div class="scroll">
			<svg aria-abel="scroll down arrow" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z"/></svg>
		</div>
	</section>
					
	<nav class="shop-cta">
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
	</nav>

	<section class="wine-list-title">
	<?php
	if ( get_field( 'wine_list_title' ) ) : ?>
		<h3><?php the_field( 'wine_list_title' ); ?></h3>
	<?php
	endif;
	?>

	<div class="wine-list-description">
		<?php
		if ( get_field( 'wine_list_description' ) ) : ?>
			<p><?php the_field( 'wine_list_description' ); ?></p>
		<?php
		endif;
		?>
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

			<div class='<?php echo esc_html( $title ); ?>'>
				<?php echo get_the_post_thumbnail( $featured_post->ID, 'large',); ?>
				<div class="flexed-wine">
					<h3><?php echo esc_html( $title ); ?></h3>
					<p><?php echo get_the_content( "", false, $featured_post->ID ); ?> </p>
					<a href="<?php echo esc_url( $permalink ); ?>">Shop</a>
				</div>		
			</div>
						
			<?php endforeach; ?>
		<?php endif; ?>
	</section>

	<div class="shop-all-cta">
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
	</div>
				
	<?php
	endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php
get_footer();