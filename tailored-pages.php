<?php
/**
 * Plugin Name: Tailored Pages
 * Description: A plugin to create and manage custom post types for brands, landing pages, brochures, and listing pages.
 * Version: 0.1
 * Author: Andries Bester
 */

// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/admin/admin-menus.php';
require_once plugin_dir_path(__FILE__) . 'includes/custom-post-types.php';
require_once plugin_dir_path(__FILE__) . 'includes/public/public-scripts.php';
require_once plugin_dir_path(__FILE__) . 'includes/meta-boxes.php';
require_once plugin_dir_path(__FILE__) . 'includes/custom-columns.php';
require_once plugin_dir_path(__FILE__) . 'includes/form-handler.php';

// Custom table creation on plugin activation
register_activation_hook(__FILE__, 'tp_create_custom_table');

// Include the selected template
function tp_include_template($template) {
    if (is_singular(['brochure', 'landing-page', 'listing-page', 'success-page'])) {
        global $post;
        $selected_template = get_post_meta($post->ID, '_tp_selected_template', true);
        if ($selected_template) {
            $template_directory = '';
            $template_file = $selected_template . '.php';
            if (strpos($selected_template, 'landing-page') !== false) {
                $template_directory = 'landing-pages';
            } elseif (strpos($selected_template, 'brochure') !== false) {
                $template_directory = 'brochures';
            } elseif (strpos($selected_template, 'listing-page') !== false) {
                $template_directory = 'listing-pages';
            } elseif (strpos($selected_template, 'success-page') !== false) {
                $template_directory = 'success-pages';
            }

            $template_path = plugin_dir_path(__FILE__) . 'templates/' . $template_directory . '/' . $template_file;
            if (file_exists($template_path)) {
                error_log('Using custom template: ' . $template_path);
                return $template_path;
            } else {
                error_log('Template file does not exist: ' . $template_path);
            }
        } else {
            error_log('No custom template selected.');
        }
    } else {
        error_log('Not a singular custom post type.');
    }
    return $template;
}
add_filter('template_include', 'tp_include_template');

function tp_enqueue_admin_scripts($hook) {
    if ('post.php' != $hook && 'post-new.php' != $hook) {
        return;
    }

    global $post;
    if ('landing-page' !== $post->post_type) {
        return;
    }

    wp_enqueue_script(
        'tailored-pages-admin-js',
        plugins_url('js/custom-admin.js', __FILE__),
        array('jquery'),
        filemtime(plugin_dir_path(__FILE__) . 'js/custom-admin.js'),
        true
    );

    $associated_brand = get_field('associated_brand', $post->ID);

    $primary_color = '';
    $secondary_color = '';
    $tertiary_color = '';
    $quaternary_color = '';
    $quinary_color = '';

    if ($associated_brand) {
        $brand_id = is_array($associated_brand) ? $associated_brand[0]->ID : $associated_brand->ID;

        $primary_color = get_field('primary_color', $brand_id);
        $secondary_color = get_field('secondary_color', $brand_id);
        $tertiary_color = get_field('tertiary_color', $brand_id);
        $quaternary_color = get_field('quaternary_color', $brand_id);
        $quinary_color = get_field('quinary_color', $brand_id);
    }

    wp_localize_script('tailored-pages-admin-js', 'tpColors', array(
        'primary_color' => $primary_color,
        'secondary_color' => $secondary_color,
        'tertiary_color' => $tertiary_color,
        'quaternary_color' => $quaternary_color,
        'quinary_color' => $quinary_color,
    ));
}
add_action('admin_enqueue_scripts', 'tp_enqueue_admin_scripts');

add_action('after_setup_theme', 'custom_image_sizes');
function custom_image_sizes() {
    add_image_size('hero-background', 1920, 1080, true); // Example size, adjust as needed
    add_image_size('testimonial-portrait', 120, 120, true); // New image size for testimonial portrait
}
