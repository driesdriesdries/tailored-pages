<?php
/*
Plugin Name: Tailored Pages
Description: A white label paid marketing infrastructure plugin.
Version: 1.0
Author: Andries Bester
*/

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

include_once plugin_dir_path(__FILE__) . 'includes/post-types.php';

function tp_register_post_types() {
    register_post_type('brand', array(
        'labels' => array(
            'name' => __('Brands'),
            'singular_name' => __('Brand'),
            'menu_name' => __('Brands'),
            'name_admin_bar' => __('Brand'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Brand'),
            'new_item' => __('New Brand'),
            'edit_item' => __('Edit Brand'),
            'view_item' => __('View Brand'),
            'all_items' => __('All Brands'),
            'search_items' => __('Search Brands'),
            'not_found' => __('No brands found.'),
            'not_found_in_trash' => __('No brands found in Trash.')
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-admin-site'
    ));

    register_post_type('landing_page', array(
        'labels' => array(
            'name' => __('Landing Pages'),
            'singular_name' => __('Landing Page'),
            'menu_name' => __('Landing Pages'),
            'name_admin_bar' => __('Landing Page'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Landing Page'),
            'new_item' => __('New Landing Page'),
            'edit_item' => __('Edit Landing Page'),
            'view_item' => __('View Landing Page'),
            'all_items' => __('All Landing Pages'),
            'search_items' => __('Search Landing Pages'),
            'not_found' => __('No landing pages found.'),
            'not_found_in_trash' => __('No landing pages found in Trash.')
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-welcome-widgets-menus'
    ));

    register_post_type('brochure', array(
        'labels' => array(
            'name' => __('Brochures'),
            'singular_name' => __('Brochure'),
            'menu_name' => __('Brochures'),
            'name_admin_bar' => __('Brochure'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Brochure'),
            'new_item' => __('New Brochure'),
            'edit_item' => __('Edit Brochure'),
            'view_item' => __('View Brochure'),
            'all_items' => __('All Brochures'),
            'search_items' => __('Search Brochures'),
            'not_found' => __('No brochures found.'),
            'not_found_in_trash' => __('No brochures found in Trash.')
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-media-document'
    ));

    register_post_type('listing_page', array(
        'labels' => array(
            'name' => __('Listing Pages'),
            'singular_name' => __('Listing Page'),
            'menu_name' => __('Listing Pages'),
            'name_admin_bar' => __('Listing Page'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Listing Page'),
            'new_item' => __('New Listing Page'),
            'edit_item' => __('Edit Listing Page'),
            'view_item' => __('View Listing Page'),
            'all_items' => __('All Listing Pages'),
            'search_items' => __('Search Listing Pages'),
            'not_found' => __('No listing pages found.'),
            'not_found_in_trash' => __('No listing pages found in Trash.')
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-list-view'
    ));
}
add_action('init', 'tp_register_post_types');

add_filter('use_block_editor_for_post_type', 'tp_use_classic_editor', 10, 2);
function tp_use_classic_editor($use_block_editor, $post_type) {
    if (in_array($post_type, array('brand', 'landing_page', 'brochure', 'listing_page'))) {
        return false;
    }
    return $use_block_editor;
}
