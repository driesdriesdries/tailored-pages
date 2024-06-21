<?php
// Template for Success Page

get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main tp-success-page1">

    <?php
        // Get the selected landing page
        $landing_page_sources = get_post_meta(get_the_ID(), 'landing_page_source', true);

        if ( $landing_page_sources ) {
            foreach ($landing_page_sources as $landing_page_source_id) {
                $landing_page_title = get_the_title($landing_page_source_id);
                $landing_page_link = get_permalink($landing_page_source_id);
    
                // Fetch associated brand from the landing page
                $associated_brand_id = get_post_meta($landing_page_source_id, 'associated_brand', true);

                if ($associated_brand_id) {
                    if (is_array($associated_brand_id) && !empty($associated_brand_id)) {
                        $associated_brand_id = $associated_brand_id[0];
                    }

                    // Get brand colors
                    $primary_color = get_post_meta($associated_brand_id, 'primary_color', true);
                    $secondary_color = get_post_meta($associated_brand_id, 'secondary_color', true);
                    $tertiary_color = get_post_meta($associated_brand_id, 'tertiary_color', true);
                    $quaternary_color = get_post_meta($associated_brand_id, 'quaternary_color', true);
                    $quinary_color = get_post_meta($associated_brand_id, 'quinary_color', true);

                    // Get Google Fonts script URL and font family name
                    $google_fonts_script_url = get_post_meta($associated_brand_id, 'google_fonts_script_url', true);
                    $font_family_name = get_post_meta($associated_brand_id, 'font_family_name', true);

                    // Include Font Partial
                    $font_partial_path = plugin_dir_path(dirname(__FILE__, 2)) . 'includes/public/font-inclusion.php';
                    if (file_exists($font_partial_path)) {
                        include $font_partial_path;
                    }
    ?>
                    <div class="brand-colors">
                        <div class="primary-color" style="background-color: <?php echo esc_attr($primary_color); ?>;">Primary Color</div>
                        <div class="secondary-color" style="background-color: <?php echo esc_attr($secondary_color); ?>;">Secondary Color</div>
                        <div class="tertiary-color" style="background-color: <?php echo esc_attr($tertiary_color); ?>;">Tertiary Color</div>
                        <div class="quaternary-color" style="background-color: <?php echo esc_attr($quaternary_color); ?>;">Quaternary Color</div>
                        <div class="quinary-color" style="background-color: <?php echo esc_attr($quinary_color); ?>;">Quinary Color</div>
                    </div>
    <?php
                } else {
    ?>
                    <p>No associated brand found for the landing page.</p>
    <?php
                }
    ?>
                <!-- Confirmation Box -->
                <div class="confirmation-box">
                    <p>Thank you for your interest in <a href="<?php echo esc_url($landing_page_link); ?>"><?php echo esc_html($landing_page_title); ?></a>!</p>
                    <p>You can download your file by clicking the link below:</p>
                    <a href="#">Click here to download your file</a>
                </div>
    <?php
            }
        } else {
    ?>
            <p>No linked landing page found.</p>
    <?php
        }

        the_content();
    ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
    endwhile;

    // Count the number of leads associated with the landing page
    global $wpdb;
    $landing_page_id = $landing_page_sources ? $landing_page_sources[0] : 0;
    $leads_count = $wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM {$wpdb->prefix}tp_leads WHERE associated_product = %s",
        get_the_title($landing_page_id)
    ));

    // Display the count
    if ($leads_count) {
        echo "<p>This page has produced {$leads_count} leads</p>";
    } else {
        echo "<p>This page has produced 0 leads</p>";
    }

endif;

get_footer();
?>
