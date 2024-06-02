<?php
/**
 * Plugin Name: Tailored Pages
 * Description: A plugin to create and manage custom post types for brands, landing pages, brochures, and listing pages.
 * Version: 0.1
 * Author: Andries Bester
 */

// Include admin menus
require_once plugin_dir_path(__FILE__) . 'includes/admin/admin-menus.php';
require_once plugin_dir_path(__FILE__) . 'includes/custom-post-types.php';
require_once plugin_dir_path(__FILE__) . 'includes/public/public-scripts.php';
require_once plugin_dir_path(__FILE__) . 'includes/meta-boxes.php';
require_once plugin_dir_path(__FILE__) . 'includes/custom-columns.php';

// Include the selected template
function tp_include_template( $template ) {
    if ( is_singular(['brochure', 'landing-page', 'listing-page', 'success-page']) ) {
        global $post;
        $selected_template = get_post_meta( $post->ID, '_tp_selected_template', true );
        if ( $selected_template ) {
            $template_directory = '';
            $template_file = $selected_template . '.php';
            if ( strpos( $selected_template, 'landing-page' ) !== false ) {
                $template_directory = 'landing-pages';
            } elseif ( strpos( $selected_template, 'brochure' ) !== false ) {
                $template_directory = 'brochures';
            } elseif ( strpos( $selected_template, 'listing-page' ) !== false ) {
                $template_directory = 'listing-pages';
            } elseif ( strpos( $selected_template, 'success-page' ) !== false ) {
                $template_directory = 'success-pages';
            }

            $template_path = plugin_dir_path( __FILE__ ) . 'templates/' . $template_directory . '/' . $template_file;
            if ( file_exists( $template_path ) ) {
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
add_filter( 'template_include', 'tp_include_template' );


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

// add_filter('acf/fields/relationship/query/key=field_6659a1c39636d', 'tp_filter_products_by_brand', 10, 3);
// function tp_filter_products_by_brand($args, $field, $post_id) {
//     // Get the associated brand ID
//     $associated_brand = get_field('associated_brand', $post_id);

//     if ($associated_brand) {
//         // Ensure it's an array of post objects and get the ID
//         if (is_array($associated_brand)) {
//             $associated_brand = $associated_brand[0]->ID;
//         } else {
//             $associated_brand = $associated_brand->ID;
//         }

//         // Modify the query arguments to filter by associated brand
//         $args['meta_query'] = array(
//             array(
//                 'key' => 'associated_brand', // The custom field key in the product post type
//                 'value' => '"' . $associated_brand . '"',
//                 'compare' => 'LIKE'
//             )
//         );
//     }

//     return $args;
// }

function tp_handle_form_submission() {
    if (isset($_POST['action']) && $_POST['action'] === 'submit_landing_page_form') {
        // Sanitize and process form input
        $first_name = sanitize_text_field($_POST['first_name']);
        $last_name = sanitize_text_field($_POST['last_name']);
        $email_address = sanitize_email($_POST['email_address']);
        $marketing_consent = isset($_POST['marketing_consent']) ? 1 : 0;
        $landing_page_id = intval($_POST['landing_page_id']);

        // Save the data to a custom post type
        $new_post = array(
            'post_title'    => $first_name . ' ' . $last_name,
            'post_type'     => 'lead',
            'post_status'   => 'publish',
        );

        $post_id = wp_insert_post($new_post);

        if ($post_id) {
            update_post_meta($post_id, 'email_address', $email_address);
            update_post_meta($post_id, 'marketing_consent', $marketing_consent);
        }

        // Check if there's a cached success page URL
        $cache_key = 'success_page_' . $landing_page_id;
        $success_page_url = get_transient($cache_key);

        if ($success_page_url === false) {
            // Query for the success page that has this landing page selected in its ACF field
            $success_page_query = new WP_Query(array(
                'post_type' => 'success-page',
                'meta_query' => array(
                    array(
                        'key' => 'landing_page_source', // ACF field name
                        'value' => '"' . $landing_page_id . '"',
                        'compare' => 'LIKE'
                    )
                )
            ));

            if ($success_page_query->have_posts()) {
                $success_page_query->the_post();
                $success_page_url = get_permalink();
                wp_reset_postdata();
                // Cache the success page URL for 12 hours
                set_transient($cache_key, $success_page_url, 12 * HOUR_IN_SECONDS);
            } else {
                $success_page_url = home_url('/');
            }
        }

        // Redirect after processing
        wp_redirect($success_page_url);
        exit;
    }
}
add_action('admin_post_nopriv_submit_landing_page_form', 'tp_handle_form_submission');
add_action('admin_post_submit_landing_page_form', 'tp_handle_form_submission');


add_action('after_setup_theme', 'custom_image_sizes');
function custom_image_sizes() {
    add_image_size('hero-background', 1920, 1080, true); // Example size, adjust as needed
}

?>
