<?php
/*
Template Name: TP Landing Page Template 1
*/
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main tp-landing-page1">
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
            // Retrieve the brand name (post title)
            $brand_name = get_the_title($associated_brand_id);

            // Retrieve the brand logo from the brand post meta
            $brand_logo_id = get_post_meta($associated_brand_id, 'brand_logo', true);

            // Get color values from brand post meta
            $primary_color = get_post_meta($associated_brand_id, 'primary_color', true);
            $secondary_color = get_post_meta($associated_brand_id, 'secondary_color', true);
            $tertiary_color = get_post_meta($associated_brand_id, 'tertiary_color', true);
            $quaternary_color = get_post_meta($associated_brand_id, 'quaternary_color', true);
            $quinary_color = get_post_meta($associated_brand_id, 'quinary_color', true);

            echo '<div class="brand-info">';

            // Display the brand name as an h2
            if ($brand_name) {
                echo '<h2 style="color: ' . esc_attr($primary_color) . ';">' . esc_html($brand_name) . '</h2>';
            }

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

            echo '</div>'; // .brand-info

            // Display headings with brand colors
            echo '<div class="brand-headings">';
            echo '<h1 style="color: ' . esc_attr($primary_color) . ';">Heading 1</h1>';
            echo '<h2 style="color: ' . esc_attr($secondary_color) . ';">Heading 2</h2>';
            echo '<h3 style="color: ' . esc_attr($tertiary_color) . ';">Heading 3</h3>';
            echo '<h4 style="color: ' . esc_attr($quaternary_color) . ';">Heading 4</h4>';
            echo '<h5 style="color: ' . esc_attr($quinary_color) . ';">Heading 5</h5>';
            echo '</div>'; // .brand-headings
        } else {
            echo 'No associated brand.';
        }
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>
