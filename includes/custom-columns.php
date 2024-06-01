<?php 
// Modify the query to filter by brand
function tp_filter_by_assigned_brand($query) {
    // Only modify the main query in the admin area
    if (is_admin() && $query->is_main_query() && !empty($_GET['brand_filter'])) {
        $meta_query = array(
            array(
                'key' => 'associated_brand',
                'value' => sanitize_text_field($_GET['brand_filter']),
                'compare' => 'LIKE'
            )
        );
        $query->set('meta_query', $meta_query);
    }
}
add_action('pre_get_posts', 'tp_filter_by_assigned_brand');


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
            $brand_filter_link = add_query_arg(array('post_type' => 'listing-page', 'brand_filter' => $associated_brand), admin_url('edit.php'));
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
            $brand_filter_link = add_query_arg(array('post_type' => 'landing-page', 'brand_filter' => $associated_brand), admin_url('edit.php'));
            echo '<a href="' . esc_url($brand_filter_link) . '">' . esc_html($brand_title) . '</a>';
        } else {
            echo __('No Brand Assigned', 'text_domain');
        }
    }
}
add_action('manage_landing-page_posts_custom_column', 'tp_custom_landing_page_column', 10, 2);
