<?php
/*
Template Name: TP Listing Page Template 1
*/
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <h1>TP Listing Page Template 1</h1>
        
        <?php
        // Get the associated brand ID from post meta
        $associated_brand_ids = get_post_meta(get_the_ID(), 'associated_brand', true);
        
        // Check if the associated brand ID is an array and get the first element
        if (is_array($associated_brand_ids) && !empty($associated_brand_ids)) {
            $associated_brand_id = $associated_brand_ids[0];
        } else {
            $associated_brand_id = $associated_brand_ids;
        }

        if ($associated_brand_id) {
            // Retrieve the brand logo from the brand post meta
            $brand_logo_id = get_post_meta($associated_brand_id, 'brand_logo', true);
            // Retrieve the brand name
            $brand_name = get_the_title($associated_brand_id);

            if ($brand_logo_id) {
                // Assuming the brand logo is an image ID
                $brand_logo_url = wp_get_attachment_image_url($brand_logo_id, 'full');
                $brand_logo_alt = get_post_meta($brand_logo_id, '_wp_attachment_image_alt', true);

                echo '<div class="brand-logo">';
                echo '<img src="' . esc_url($brand_logo_url) . '" alt="' . esc_attr($brand_logo_alt) . '">';
                echo '</div>';
            } else {
                echo 'No brand logo found.';
            }

            if ($brand_name) {
                echo '<h2>' . esc_html($brand_name) . '</h2>';
            } else {
                echo 'No brand name found.';
            }
        } else {
            echo 'No associated brand.';
        }
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>
