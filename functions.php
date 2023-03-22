<?php
/**
 * Bon Vin functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bon_Vin
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bon_vin_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Bon Vin, use a find and replace
		* to change 'bon-vin' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'bon-vin', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'bon-vin' ),
			'footer-left' => esc_html__( 'footer- left', 'bon-vin' ),
			'footer-right' => esc_html__('footer- right', 'bon-vin')
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'bon_vin_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'bon_vin_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bon_vin_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bon_vin_content_width', 640 );
}
add_action( 'after_setup_theme', 'bon_vin_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bon_vin_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'bon-vin' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'bon-vin' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'bon_vin_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bon_vin_scripts() {
	wp_enqueue_style( 'bon-vin-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'bon-vin-style', 'rtl', 'replace' );

	wp_enqueue_script( 'bon-vin-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	// Load script from ACF Map Documentation
	wp_enqueue_script( 'google_js', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyASjO6BZFisDkgBdgpupQL7LM6KO9Fvo-c&callback=Function.prototype', '', '' );        // Map Helper Set up
	wp_enqueue_script( 'map-helper', get_template_directory_uri() . '/js/googlemap.js', array('jquery','google_js'), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bon_vin_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

// CPT and TAXONOMIES
require get_template_directory() . '/inc/cpt-taxonomy.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Automatically add locations into the career location taxonomy.
 */
function bon_vin_send_new_post($new_status, $old_status, $post) {
	if('publish' === $new_status && 'publish' !== $old_status && $post->post_type === 'bon-vin-locations') {
		$term = term_exists( $post->post_title, 'bon-vin-career-locations' );
		if ( $term == 0 || $term == null ){
			wp_insert_term(
					$post->post_title,   // the term 
					'bon-vin-career-locations' // the taxonomy
				);
		}
	}
  }

add_action('transition_post_status', 'bon_vin_send_new_post', 10, 3);

/**
 * ACF Google maps API key
 */
function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyASjO6BZFisDkgBdgpupQL7LM6KO9Fvo-c';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

function current_year() {
    $year = date('Y');
    return $year;
}

add_shortcode('year', 'current_year');