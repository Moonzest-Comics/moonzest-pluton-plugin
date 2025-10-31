<?php
/*
 * Plugin Name: Moonzest Comics Manager
 * Author:      Kristen Ridley
 * Text Domain: moonzest-comics
 */

/*
 * Filters and Fixes
 */

// change WordPress API URL to HOME URL
add_filter('rest_url', 'wptips_home_url_as_api_url');
function wptips_home_url_as_api_url($url) {
    $url = str_replace(home_url(),site_url() , $url);
    return $url;
}

/*
 * Custom Post Types and Taxonomies
 */
function moonzest_custom_post_type() {
	register_post_type( 'mz_comic',
		array(
			'labels'      => array(
				'name'          => __('Comics', 'moonzest-comics'),
				'singular_name' => __('Comic', 'moonzest-comics'),
				'add_new_item'  => __('Add New Comic', 'moonzest-comics')
			),
				'public'          => true,
				'has_archive'     => true,
				'rewrite'         => array( 'slug' => 'comics' ),
				'description'     => __('A comic image and its associated data', 'moonzest-comics'),
				'supports'        => array('title', 'editor', 'thumbnail'),
		)
	);
}

add_action('init', 'moonzest_custom_post_type');

function mz_characters_taxonomy() {

	$labels = array(
		'name'                  => _x( 'Characters', 'moonzest-comics' ),
		'singular_name'         => _x( 'Character', 'moonzest-comics' ),
		'search_items'          => __( 'Search Characters', 'moonzest-comics' ),
		'all_items'             => __( 'All Characters', 'moonzest-comics' ),
		'edit_item'             => __( 'Edit Character', 'moonzest-comics' ),
		'update_item'           => __( 'Update Character', 'moonzest-comics' ),
		'add_new_item'          => __( 'Add New Character', 'moonzest-comics' ),
		'new_item_name'         => __( 'New Character Name', 'moonzest-comics' ),
		'menu_name'             => __( 'Characters', 'moonzest-comics' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => false,
		'hierarchical'      => false,
		'show_tagcloud'     => true,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'query_var'         => true,
	);

	register_taxonomy( 'characters', array( 'mz_comic' ), $args );
}

add_action( 'init', 'mz_characters_taxonomy' );


