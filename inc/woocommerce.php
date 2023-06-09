<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Bon_Vin
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function bon_vin_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'bon_vin_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function bon_vin_woocommerce_scripts() {
	wp_enqueue_style( 'bon-vin-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'bon-vin-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'bon_vin_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function bon_vin_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'bon_vin_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function bon_vin_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'bon_vin_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'bon_vin_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function bon_vin_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'bon_vin_woocommerce_wrapper_before' );

if ( ! function_exists( 'bon_vin_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function bon_vin_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'bon_vin_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'bon_vin_woocommerce_header_cart' ) ) {
			bon_vin_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'bon_vin_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function bon_vin_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		bon_vin_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'bon_vin_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'bon_vin_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function bon_vin_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'bon-vin' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'bon-vin' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'bon_vin_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function bon_vin_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php bon_vin_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}

// Remove the sidebar from site
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );


/*
** Shop Page 
*/
// Add filters to shop page 
function bon_vin_shop_filters() {
	?>
	<div class="filter-title-wrapper">
		<div class="filter-wrapper">
			<button class="filter-dropdown">Filters </button>
			<div class="filters">
				<button class="filter" data-filter="wine">WINE</button>
				<button class="filter" data-filter="not-wine">NOT WINE</button>
				<button class="filter" data-filter="all">ALL</button>
			</div>
		</div>
		<h2 class="filter-title">All Products</h2>
	</div>
	<?php
}

add_action(  'woocommerce_before_shop_loop', 'bon_vin_shop_filters' );

// Display all products on one page
function hwl_home_pagesize( $query ) {
	if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'product' ) ) {
		$query->set( 'posts_per_page', -1 );
		return;
	}
}
add_action( 'pre_get_posts', 'hwl_home_pagesize', 1 );

// Add description for products on shop page
function bon_vin_des_product() {
	if ( is_shop() ) {
		the_excerpt();
	}
}
add_action( 'woocommerce_after_shop_loop_item_title', 'bon_vin_des_product', 30 );

// Remove result count from shop page
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

// Remove base filters from shop page
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

// Remove breadcrumbs from shop and product pages
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

/*
** Product Page
*/
// Display title above image on product page 
function product_change_title_position() {
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_title', 5 );
}
add_action( 'init', 'product_change_title_position' );

// Remove quantities from product page 
// function custom_remove_all_quantity_fields( $return, $product ) {return true;}
// add_filter( 'woocommerce_is_sold_individually','custom_remove_all_quantity_fields', 10, 2 );

// Remove tabs from product page
function my_remove_all_product_tabs( $tabs ) {
  unset( $tabs['description'] );        // Remove the description tab
  unset( $tabs['reviews'] );       // Remove the reviews tab
  unset( $tabs['additional_information'] );    // Remove the additional information tab
  return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'my_remove_all_product_tabs', 98 );

/* Remove Categories from Single Products */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

// Display description and atributes on product page
function bon_vin_des_att(){
	global $product;
	the_content( $product );
	echo wc_display_product_attributes( $product );
}
add_action('woocommerce_before_add_to_cart_quantity', 'bon_vin_des_att', 10);

/*
 * Change number of related products output
 */ 

add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
  function jk_related_products_args( $args ) {
	$args['posts_per_page'] = 2; // 4 related products
	// $args['columns'] = 2; // arranged in 2 columns
	return $args;
}

// Remove product image zoom on product page 
function remove_image_zoom_support_webtalkhub() {
    remove_theme_support( 'wc-product-gallery-zoom' );
}
add_action( 'wp', 'remove_image_zoom_support_webtalkhub', 100 );

//  Remove add to cart from individual product page
function remove_add_to_cart_product_page() {
if (is_product() ) {
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
}
}
add_action( 'wp', 'remove_add_to_cart_product_page', 10);

add_filter( 'single_product_archive_thumbnail_size', 'fwd_change_shop_img_size' );
function fwd_change_shop_img_size() {
   return 'woocommerce_single';
}