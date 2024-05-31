<?php
/**
 * Plugin Name: Tailored Pages
 * Description: A plugin to create and manage custom post types for brands, landing pages, brochures, and listing pages.
 * Version: 1.1
 * Author: Your Name
 */

// Include admin menus
include_once plugin_dir_path(__FILE__) . 'includes/admin/admin-menus.php';

// Include public scripts
include_once plugin_dir_path(__FILE__) . 'includes/public/public-scripts.php';

// Include custom post types
include_once plugin_dir_path(__FILE__) . 'includes/custom-post-types.php';


// Add Meta Box for Template Selection
function tp_add_template_meta_box() {
    $screens = ['brochure', 'landing-page', 'listing-page'];
    foreach ($screens as $screen) {
        add_meta_box(
            'tp_template_selection',
            'Template Selection',
            'tp_template_meta_box_callback',
            $screen,
            'side'
        );
    }
}
add_action( 'add_meta_boxes', 'tp_add_template_meta_box' );

function tp_template_meta_box_callback( $post ) {
    $value = get_post_meta( $post->ID, '_tp_selected_template', true );

    $options = [];
    if ( $post->post_type === 'landing-page' ) {
        $options = [
            'tp-landing-page-1' => 'Landing Page Template 1'
        ];
    } elseif ( $post->post_type === 'brochure' ) {
        $options = [
            'tp-brochure-1' => 'Brochure Template 1'
        ];
    } elseif ( $post->post_type === 'listing-page' ) {
        $options = [
            'tp-listing-page-1' => 'Listing Page Template 1'
        ];
    }

    ?>
    <label for="tp_template_field">Select Template:</label>
    <select name="tp_template_field" id="tp_template_field">
        <option value="">Default Template</option>
        <?php foreach ( $options as $template_value => $template_name ): ?>
            <option value="<?php echo esc_attr( $template_value ); ?>" <?php selected( $value, $template_value ); ?>><?php echo esc_html( $template_name ); ?></option>
        <?php endforeach; ?>
    </select>
    <?php
}

// Save the selected template
function tp_save_template_meta_box( $post_id ) {
    if ( array_key_exists( 'tp_template_field', $_POST ) ) {
        update_post_meta(
            $post_id,
            '_tp_selected_template',
            $_POST['tp_template_field']
        );
    }
}
add_action( 'save_post', 'tp_save_template_meta_box' );

// Include the selected template
function tp_include_template( $template ) {
    if ( is_singular(['brochure', 'landing-page', 'listing-page']) ) {
        global $post;
        $selected_template = get_post_meta( $post->ID, '_tp_selected_template', true );
        if ( $selected_template ) {
            // Map the template selection to the correct directory
            $template_directory = '';
            $template_file = $selected_template . '.php';
            if ( strpos( $selected_template, 'landing-page' ) !== false ) {
                $template_directory = 'landing-pages';
            } elseif ( strpos( $selected_template, 'brochure' ) !== false ) {
                $template_directory = 'brochures';
            } elseif ( strpos( $selected_template, 'listing-page' ) !== false ) {
                $template_directory = 'listing-pages';
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

add_filter('acf/fields/relationship/query/key=field_6659a1c39636d', 'tp_filter_products_by_brand', 10, 3);
function tp_filter_products_by_brand($args, $field, $post_id) {
    // Get the associated brand ID
    $associated_brand = get_field('associated_brand', $post_id);

    if ($associated_brand) {
        // Ensure it's an array of post objects and get the ID
        if (is_array($associated_brand)) {
            $associated_brand = $associated_brand[0]->ID;
        } else {
            $associated_brand = $associated_brand->ID;
        }

        // Modify the query arguments to filter by associated brand
        $args['meta_query'] = array(
            array(
                'key' => 'associated_brand', // The custom field key in the product post type
                'value' => '"' . $associated_brand . '"',
                'compare' => 'LIKE'
            )
        );
    }

    return $args;
}
// Add custom columns to Listing Page post type
function tp_add_listing_page_columns($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        if ($key == 'title') {
            $new_columns[$key] = $value;
            $new_columns['assigned_brand'] = __('Assigned Brand', 'text_domain');
        } else {
            $new_columns[$key] = $value;
        }
    }
    return $new_columns;
}
add_filter('manage_listing-page_posts_columns', 'tp_add_listing_page_columns');

// Populate custom columns for Listing Page post type
function tp_custom_listing_page_column($column, $post_id) {
    if ($column === 'assigned_brand') {
        $associated_brand = get_post_meta($post_id, 'associated_brand', true);
        if ($associated_brand) {
            if (is_array($associated_brand)) {
                $associated_brand = $associated_brand[0]; // If it is an array, get the first element
            }
            $brand_title = get_the_title($associated_brand);
            $brand_filter_link = add_query_arg('brand_filter', $associated_brand);
            echo '<a href="' . esc_url($brand_filter_link) . '">' . esc_html($brand_title) . '</a>';
        } else {
            echo __('No Brand Assigned', 'text_domain');
        }
    }
}
add_action('manage_listing-page_posts_custom_column', 'tp_custom_listing_page_column', 10, 2);

// Add custom columns to Landing Page post type
function tp_add_landing_page_columns($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        if ($key == 'title') {
            $new_columns[$key] = $value;
            $new_columns['assigned_brand'] = __('Assigned Brand', 'text_domain');
        } else {
            $new_columns[$key] = $value;
        }
    }
    return $new_columns;
}
add_filter('manage_landing-page_posts_columns', 'tp_add_landing_page_columns');

// Populate custom columns for Landing Page post type
function tp_custom_landing_page_column($column, $post_id) {
    if ($column === 'assigned_brand') {
        $associated_brand = get_post_meta($post_id, 'associated_brand', true);
        if ($associated_brand) {
            if (is_array($associated_brand)) {
                $associated_brand = $associated_brand[0]; // If it is an array, get the first element
            }
            $brand_title = get_the_title($associated_brand);
            $brand_filter_link = add_query_arg('brand_filter', $associated_brand);
            echo '<a href="' . esc_url($brand_filter_link) . '">' . esc_html($brand_title) . '</a>';
        } else {
            echo __('No Brand Assigned', 'text_domain');
        }
    }
}
add_action('manage_landing-page_posts_custom_column', 'tp_custom_landing_page_column', 10, 2);

// Modify the admin query to filter by brand
function tp_filter_by_brand($query) {
    global $pagenow;
    $post_type = isset($_GET['post_type']) ? $_GET['post_type'] : '';

    if (is_admin() && $query->is_main_query() && $pagenow == 'edit.php' && ($post_type == 'listing-page' || $post_type == 'landing-page')) {
        if (isset($_GET['brand_filter']) && !empty($_GET['brand_filter'])) {
            $brand_id = intval($_GET['brand_filter']);
            $query->set('meta_query', array(
                array(
                    'key' => 'associated_brand',
                    'value' => '"' . $brand_id . '"', // Use LIKE to handle serialized array
                    'compare' => 'LIKE'
                )
            ));
        }
    }
}
add_action('pre_get_posts', 'tp_filter_by_brand');

// Make the custom columns sortable
function tp_sortable_listing_page_columns($columns) {
    $columns['assigned_brand'] = 'assigned_brand';
    return $columns;
}
add_filter('manage_edit-listing-page_sortable_columns', 'tp_sortable_listing_page_columns');

function tp_sortable_landing_page_columns($columns) {
    $columns['assigned_brand'] = 'assigned_brand';
    return $columns;
}
add_filter('manage_edit-landing-page_sortable_columns', 'tp_sortable_landing_page_columns');

?>
