<?php
function tp_handle_form_submission() {
    if (isset($_POST['action']) && $_POST['action'] === 'submit_landing_page_form') {
        global $wpdb;

        // Sanitize and process form input
        $first_name = sanitize_text_field($_POST['first_name']);
        $last_name = sanitize_text_field($_POST['last_name']);
        $email_address = sanitize_email($_POST['email_address']);
        $marketing_consent = isset($_POST['marketing_consent']) ? 1 : 0;
        $time = current_time('mysql');
        $landing_page_id = intval($_POST['landing_page_id']);
        $associated_brand_id = sanitize_text_field($_POST['associated_brand']);
        $associated_product_title = sanitize_text_field($_POST['associated_product']);

        // Retrieve brand name
        $associated_brand_name = get_the_title($associated_brand_id);

        // Insert data into custom table
        $table_name = $wpdb->prefix . 'tp_leads';
        $wpdb->insert(
            $table_name,
            array(
                'time' => $time,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email_address' => $email_address,
                'marketing_consent' => $marketing_consent,
                'associated_brand' => $associated_brand_name,
                'associated_product' => $associated_product_title,
            )
        );

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


// Custom table creation function
function tp_create_custom_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'tp_leads';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        first_name tinytext NOT NULL,
        last_name tinytext NOT NULL,
        email_address varchar(100) NOT NULL,
        marketing_consent boolean DEFAULT false NOT NULL,
        associated_brand tinytext NOT NULL,
        associated_product tinytext NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    if ($wpdb->last_error) {
        error_log('Custom Table Creation Error: ' . $wpdb->last_error);
    } else {
        error_log('Custom Table Created Successfully: ' . $table_name);
    }
}

function tp_register_export_page() {
    add_submenu_page(
        'edit.php?post_type=landing-page',
        __('Export Leads', 'text_domain'),
        __('Export Leads', 'text_domain'),
        'manage_options',
        'export-leads',
        'tp_export_leads_page'
    );
}
add_action('admin_menu', 'tp_register_export_page');

function tp_export_leads_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Export Leads', 'text_domain'); ?></h1>
        <form method="post" action="">
            <input type="hidden" name="tp_export_csv" value="1">
            <?php submit_button(__('Export to CSV', 'text_domain')); ?>
        </form>
    </div>
    <?php
}

function tp_export_leads() {
    if (isset($_POST['tp_export_csv']) && current_user_can('manage_options')) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'tp_leads';

        $results = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);

        if (!empty($results)) {
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=leads.csv');
            $output = fopen('php://output', 'w');
            fputcsv($output, array('ID', 'Time', 'First Name', 'Last Name', 'Email Address', 'Marketing Consent'));

            foreach ($results as $row) {
                fputcsv($output, $row);
            }

            fclose($output);
            exit;
        }
    }
}
add_action('admin_init', 'tp_export_leads');
