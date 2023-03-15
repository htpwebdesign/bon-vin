<?php

function bon_vin_register_custom_post_types() {
    // BONVIN CAREERS
    $labels = array(
        'name'               => _x( 'Careers', 'post type general name' ),
        'singular_name'      => _x( 'Career', 'post type singular name'),
        'menu_name'          => _x( 'Careers', 'admin menu' ),
        'name_admin_bar'     => _x( 'Career', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'career' ),
        'add_new_item'       => __( 'Add New Career' ),
        'new_item'           => __( 'New Career' ),
        'edit_item'          => __( 'Edit Career' ),
        'view_item'          => __( 'View Career' ),
        'all_items'          => __( 'All Careers' ),
        'search_items'       => __( 'Search Careers' ),
        'parent_item_colon'  => __( 'Parent Careers:' ),
        'not_found'          => __( 'No careers found.' ),
        'not_found_in_trash' => __( 'No careers found in Trash.' ),
        'archives'           => __( 'Career Archives'),
        'insert_into_item'   => __( 'Insert into career'),
        'uploaded_to_this_item' => __( 'Uploaded to this career'),
        'filter_item_list'   => __( 'Filter careers list'),
        'items_list_navigation' => __( 'Careers list navigation'),
        'items_list'         => __( 'Careers list'),
        'featured_image'     => __( 'Career featured image'),
        'set_featured_image' => __( 'Set career featured image'),
        'remove_featured_image' => __( 'Remove career featured image'),
        'use_featured_image' => __( 'Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'careers' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-nametag',
        'supports'           => array( 'title' ),
    );
    register_post_type( 'bon-vin-careers', $args );

// BONVIN LOCATION 
    $labels = array(
        'name'               => _x( 'Locations', 'post type general name' ),
        'singular_name'      => _x( 'Location', 'post type singular name'),
        'menu_name'          => _x( 'Locations', 'admin menu' ),
        'name_admin_bar'     => _x( 'Location', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'location' ),
        'add_new_item'       => __( 'Add New Location' ),
        'new_item'           => __( 'New Location' ),
        'edit_item'          => __( 'Edit Location' ),
        'view_item'          => __( 'View Location' ),
        'all_items'          => __( 'All Locations' ),
        'search_items'       => __( 'Search Locations' ),
        'parent_item_colon'  => __( 'Parent Locations:' ),
        'not_found'          => __( 'No careers found.' ),
        'not_found_in_trash' => __( 'No careers found in Trash.' ),
        'archives'           => __( 'Location Archives'),
        'insert_into_item'   => __( 'Insert into location'),
        'uploaded_to_this_item' => __( 'Uploaded to this location'),
        'filter_item_list'   => __( 'Filter careers list'),
        'items_list_navigation' => __( 'Locations list navigation'),
        'items_list'         => __( 'Locations list'),
        'featured_image'     => __( 'Location featured image'),
        'set_featured_image' => __( 'Set location featured image'),
        'remove_featured_image' => __( 'Remove location featured image'),
        'use_featured_image' => __( 'Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'locations' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-location',
        'supports'           => array( 'title' ),
    );
    register_post_type( 'bon-vin-locations', $args );


}
add_action('init', 'bon_vin_register_custom_post_types');

function bon_vin_register_taxonomies(){
    // LOCATION TAXONOMY
    $labels = array(
        'name'              => _x( 'Career Locations', 'taxonomy general name' ),
        'singular_name'     => _x( 'Career Location', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Career Locations' ),
        'all_items'         => __( 'All Career Location' ),
        'parent_item'       => __( 'Parent Career Location' ),
        'parent_item_colon' => __( 'Parent Career Location:' ),
        'edit_item'         => __( 'Edit Career Location' ),
        'view_item'         => __( 'Vview Career Location' ),
        'update_item'       => __( 'Update Career Location' ),
        'add_new_item'      => __( 'Add New Career Location' ),
        'new_item_name'     => __( 'New Career Location Name' ),
        'menu_name'         => __( 'Career Location' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'career-locations' ),
    );
    register_taxonomy( 'bon-vin-career-locations', array( 'bon-vin-careers' ), $args );

    $labels = array(
        'name'              => _x( 'Menu Items', 'taxonomy general name' ),
        'singular_name'     => _x( 'Menu Items', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Menu Items' ),
        'all_items'         => __( 'All Menu Items' ),
        'parent_item'       => __( 'Parent Menu Items' ),
        'parent_item_colon' => __( 'Parent Menu Items:' ),
        'edit_item'         => __( 'Edit Menu Items' ),
        'view_item'         => __( 'Vview Menu Items' ),
        'update_item'       => __( 'Update Menu Items' ),
        'add_new_item'      => __( 'Add New Menu Items' ),
        'new_item_name'     => __( 'New Menu Items Name' ),
        'menu_name'         => __( 'Menu Items' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'menu-items' ),
    );
    register_taxonomy( 'bon-vin-menu-items', array( 'products' ), $args );
}
add_action('init', 'bon_vin_register_taxonomies');
