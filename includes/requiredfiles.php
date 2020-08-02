<?php

function bed_search_style(){
	wp_enqueue_style('bed-css', plugins_url(). '/post_filter_with_acf/includes/css/bed-css.css' );

}

add_action( 'wp_enqueue_scripts', 'bed_search_style' );

function bed_search_scripts(){
	wp_enqueue_script('bed-search', plugins_url(). '/post_filter_with_acf/includes/js/bed-search.js', array('jquery'), '1.0.0', true );
	wp_localize_script('bed-search', 'ajax_url', admin_url('admin-ajax.php'));
}



// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', plugin_dir_path( __FILE__ ) . 'acf/' );
define( 'MY_ACF_URL', plugin_dir_url( __FILE__ ) . 'acf/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}


// Register Custom Post Type Bed
function create_bed_cpt() {

	$labels = array(
		'name' => _x( 'Beds', 'Post Type General Name', 'wp6' ),
		'singular_name' => _x( 'Bed', 'Post Type Singular Name', 'wp6' ),
		'menu_name' => _x( 'Beds', 'Admin Menu text', 'wp6' ),
		'name_admin_bar' => _x( 'Bed', 'Add New on Toolbar', 'wp6' ),
		'archives' => __( 'Bed Archives', 'wp6' ),
		'attributes' => __( 'Bed Attributes', 'wp6' ),
		'parent_item_colon' => __( 'Parent Bed:', 'wp6' ),
		'all_items' => __( 'All Beds', 'wp6' ),
		'add_new_item' => __( 'Add New Bed', 'wp6' ),
		'add_new' => __( 'Add New', 'wp6' ),
		'new_item' => __( 'New Bed', 'wp6' ),
		'edit_item' => __( 'Edit Bed', 'wp6' ),
		'update_item' => __( 'Update Bed', 'wp6' ),
		'view_item' => __( 'View Bed', 'wp6' ),
		'view_items' => __( 'View Beds', 'wp6' ),
		'search_items' => __( 'Search Bed', 'wp6' ),
		'not_found' => __( 'Not found', 'wp6' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'wp6' ),
		'featured_image' => __( 'Featured Image', 'wp6' ),
		'set_featured_image' => __( 'Set featured image', 'wp6' ),
		'remove_featured_image' => __( 'Remove featured image', 'wp6' ),
		'use_featured_image' => __( 'Use as featured image', 'wp6' ),
		'insert_into_item' => __( 'Insert into Bed', 'wp6' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Bed', 'wp6' ),
		'items_list' => __( 'Beds list', 'wp6' ),
		'items_list_navigation' => __( 'Beds list navigation', 'wp6' ),
		'filter_items_list' => __( 'Filter Beds list', 'wp6' ),
	);
	$args = array(
		'label' => __( 'Bed', 'wp6' ),
		'description' => __( 'Show Bed Details.', 'wp6' ),
		'labels' => $labels,
		'menu_icon' => 'dashicons-clipboard',
		'supports' => array('title', 'editor'),
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'bed', $args );

}
add_action( 'init', 'create_bed_cpt', 0 );