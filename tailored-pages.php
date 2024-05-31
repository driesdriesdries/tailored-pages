<?php
/**
 * Plugin Name: Tailored Pages
 * Description: A plugin to create and manage custom post types for brands, landing pages, brochures, and listing pages.
 * Version: 1.1
 * Author: Your Name
 */

// Include admin menus
include_once plugin_dir_path(__FILE__) . 'includes/admin/admin-menus.php';

// Enqueue the compiled CSS file
function tp_enqueue_styles() {
    wp_enqueue_style(
        'tailored-pages-styles',
        plugins_url('dist/css/style.css', __FILE__),
        array(),
        filemtime(plugin_dir_path(__FILE__) . 'dist/css/style.css')
    );
}
add_action('wp_enqueue_scripts', 'tp_enqueue_styles');

// Enqueue accordion.js file for the front end
function tp_enqueue_accordion_script() {
    wp_enqueue_script(
        'tp-accordion-js',
        plugins_url('js/accordion.js', __FILE__),
        array('jquery'),
        filemtime(plugin_dir_path(__FILE__) . 'js/accordion.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'tp_enqueue_accordion_script');

// Register Custom Post Types
function tp_register_custom_post_types() {

    // Register Brand Post Type
    $labels = array(
        'name'                  => _x( 'Brands', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Brand', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Brands', 'text_domain' ),
        'name_admin_bar'        => __( 'Brand', 'text_domain' ),
        'archives'              => __( 'Brand Archives', 'text_domain' ),
        'attributes'            => __( 'Brand Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Brand:', 'text_domain' ),
        'all_items'             => __( 'All Brands', 'text_domain' ),
        'add_new_item'          => __( 'Add New Brand', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Brand', 'text_domain' ),
        'edit_item'             => __( 'Edit Brand', 'text_domain' ),
        'update_item'           => __( 'Update Brand', 'text_domain' ),
        'view_item'             => __( 'View Brand', 'text_domain' ),
        'view_items'            => __( 'View Brands', 'text_domain' ),
        'search_items'          => __( 'Search Brand', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into brand', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this brand', 'text_domain' ),
        'items_list'            => __( 'Brands list', 'text_domain' ),
        'items_list_navigation' => __( 'Brands list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter brands list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Brand', 'text_domain' ),
        'description'           => __( 'Post Type Description', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => 'tailored-pages',
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-store',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'brand', $args );

    // Register Listing Page Post Type
    $labels = array(
        'name'                  => _x( 'Listing Pages', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Listing Page', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Listing Pages', 'text_domain' ),
        'name_admin_bar'        => __( 'Listing Page', 'text_domain' ),
        'archives'              => __( 'Listing Page Archives', 'text_domain' ),
        'attributes'            => __( 'Listing Page Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Listing Page:', 'text_domain' ),
        'all_items'             => __( 'All Listing Pages', 'text_domain' ),
        'add_new_item'          => __( 'Add New Listing Page', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Listing Page', 'text_domain' ),
        'edit_item'             => __( 'Edit Listing Page', 'text_domain' ),
        'update_item'           => __( 'Update Listing Page', 'text_domain' ),
        'view_item'             => __( 'View Listing Page', 'text_domain' ),
        'view_items'            => __( 'View Listing Pages', 'text_domain' ),
        'search_items'          => __( 'Search Listing Page', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into listing page', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this listing page', 'text_domain' ),
        'items_list'            => __( 'Listing Pages list', 'text_domain' ),
        'items_list_navigation' => __( 'Listing Pages list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter listing pages list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Listing Page', 'text_domain' ),
        'description'           => __( 'Post Type Description', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => 'tailored-pages',
        'menu_position'         => 7,
        'menu_icon'             => 'dashicons-list-view',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'listing-page', $args );

    // Register Landing Page Post Type
    $labels = array(
        'name'                  => _x( 'Landing Pages', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Landing Page', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Landing Pages', 'text_domain' ),
        'name_admin_bar'        => __( 'Landing Page', 'text_domain' ),
        'archives'              => __( 'Landing Page Archives', 'text_domain' ),
        'attributes'            => __( 'Landing Page Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Landing Page:', 'text_domain' ),
        'all_items'             => __( 'All Landing Pages', 'text_domain' ),
        'add_new_item'          => __( 'Add New Landing Page', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Landing Page', 'text_domain' ),
        'edit_item'             => __( 'Edit Landing Page', 'text_domain' ),
        'update_item'           => __( 'Update Landing Page', 'text_domain' ),
        'view_item'             => __( 'View Landing Page', 'text_domain' ),
        'view_items'            => __( 'View Landing Pages', 'text_domain' ),
        'search_items'          => __( 'Search Landing Page', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into landing page', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this landing page', 'text_domain' ),
        'items_list'            => __( 'Landing Pages list', 'text_domain' ),
        'items_list_navigation' => __( 'Landing Pages list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter landing pages list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Landing Page', 'text_domain' ),
        'description'           => __( 'Post Type Description', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => 'tailored-pages',
        'menu_position'         => 8,
        'menu_icon'             => 'dashicons-admin-page',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'landing-page', $args );

    // Register Brochure Post Type
    $labels = array(
        'name'                  => _x( 'Brochures', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Brochure', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Brochures', 'text_domain' ),
        'name_admin_bar'        => __( 'Brochure', 'text_domain' ),
        'archives'              => __( 'Brochure Archives', 'text_domain' ),
        'attributes'            => __( 'Brochure Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Brochure:', 'text_domain' ),
        'all_items'             => __( 'All Brochures', 'text_domain' ),
        'add_new_item'          => __( 'Add New Brochure', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Brochure', 'text_domain' ),
        'edit_item'             => __( 'Edit Brochure', 'text_domain' ),
        'update_item'           => __( 'Update Brochure', 'text_domain' ),
        'view_item'             => __( 'View Brochure', 'text_domain' ),
        'view_items'            => __( 'View Brochures', 'text_domain' ),
        'search_items'          => __( 'Search Brochure', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into brochure', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this brochure', 'text_domain' ),
        'items_list'            => __( 'Brochures list', 'text_domain' ),
        'items_list_navigation' => __( 'Brochures list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter brochures list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Brochure', 'text_domain' ),
        'description'           => __( 'Post Type Description', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => 'tailored-pages',
        'menu_position'         => 9,
        'menu_icon'             => 'dashicons-format-aside',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'brochure', $args );

}
add_action( 'init', 'tp_register_custom_post_types', 0 );

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
