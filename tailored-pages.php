<?php
/**
 * Plugin Name: Tailored Pages
 * Description: A plugin to create and manage custom post types for brands, landing pages, brochures, and listing pages.
 * Version: 1.0
 * Author: Your Name
 */

// Create Parent Menu
function tp_create_parent_menu() {
    add_menu_page(
        __( 'Tailored Pages', 'text_domain' ),
        __( 'Tailored Pages', 'text_domain' ),
        'manage_options',
        'tailored-pages',
        '',
        'dashicons-admin-generic',
        6
    );
}
add_action( 'admin_menu', 'tp_create_parent_menu' );

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

?>
