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
		the_post(); ?>

		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		
			<nav class="menu-nav">
				<ul>
				<li><a href="#menu-wine">Wine</a></li>
				<li><a href="#menu-food">Food</a></li>
				</ul>
			</nav>
		</header><!-- .entry-header -->

		<?php
		$ids = array();
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => -1,
			'tax_query' => array(
				array(
					'taxonomy' => 'bon-vin-menu-items',
					'field'    => 'slug',
					'terms'    => 'wine'
				)
			)	
		);
		$query = new WP_QUERY( $args );
				if ( $query -> have_posts() ) :
					while ( $query -> have_posts() ) :
						$query -> the_post();
						$terms = get_the_terms(get_the_ID(), 'product_cat');
						foreach ($terms as $term ) {
							if ( $term->parent > 0 ) {
								$ids[] = $term->term_id;
							}
						}
					endwhile;
					wp_reset_postdata();
				endif;
				
		$term_id = 25;
		$taxonomy_name = 'product_cat';
		$termchildren = get_term_children( $term_id, $taxonomy_name );
		if ( $termchildren  ) : ?>

		<section class="menu" id="menu-wine">
		<h2>Wine</h2>

		<?php
			foreach ( $termchildren as $term ) : 
				$term_name = get_term( $term )->name;
				if (in_array($term, $ids)) : ?>

					<section class="menu-sub-section">
					<h3><?php echo $term_name ?></h3>

					<?php
					$args = array(
						'post_type' => 'product',
						'posts_per_page' => -1,
						'tax_query' => array(
							'relation'	   => 'AND',
							array(
								'taxonomy' => 'bon-vin-menu-items',
								'field'    => 'slug',
								'terms'    => 'wine'
							),
							array(
								'taxonomy' => 'product_cat',
								'field' => 'slug',
								'terms' => $term_name							
							)
						)	
					);
					$query = new WP_QUERY( $args );
					if ( $query -> have_posts() ) :
						while ( $query -> have_posts() ) :
							$query -> the_post();
							$id = get_the_ID();
							
							$product = wc_get_product($id);
							$product_price = $product->get_price();
							?>

							<div class="menu-item">
								<h4><?php the_title(); ?></h4>
								<p>$<?php echo $product_price ?></p>
							</div>

							<?php		
						endwhile;
						wp_reset_postdata();
					endif; ?>
					</section>
					<?php
				endif;
			endforeach;
			?>
				</section>
				<?php
		endif;
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => -1,
			'tax_query'      => array(
				array(
					'taxonomy' => 'bon-vin-menu-items',
					'field'    => 'slug',
					'terms'    => 'food'
				),
			)
		);
		$query = new WP_QUERY( $args );
		if ( $query -> have_posts() ) :
			?>
			<section class="menu" id="menu-food">
			<h2>Food</h2>
			<?php
			while ( $query -> have_posts() ) :
				$query -> the_post();
				$id = get_the_ID();
				$product = wc_get_product($id);
				$product_price = $product->get_price();
				?>
				<div class="menu-item">
					<h4><?php the_title(); ?></h4>
					<p>$<?php echo $product_price ?></p>
				</div>
				<?php		
			endwhile;
			wp_reset_postdata();
			?>
			</section>
			<?php
		endif;
	endwhile; // End of the loop.
	?>

	</main><!-- #main -->

<?php
get_footer();
