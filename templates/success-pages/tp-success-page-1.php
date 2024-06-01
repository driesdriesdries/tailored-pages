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
        $landing_page_sources = get_field('landing_page_source');

        if ( $landing_page_sources ) {
            foreach ($landing_page_sources as $landing_page_source) {
                $landing_page_title = get_the_title( $landing_page_source->ID );
                $landing_page_link = get_permalink( $landing_page_source->ID );

                echo '<p>This success page is linked from the landing page: <a href="' . esc_url( $landing_page_link ) . '">' . esc_html( $landing_page_title ) . '</a></p>';

                // Fetch associated brand from the landing page
                $associated_brand = get_field('associated_brand', $landing_page_source->ID);

                if ($associated_brand) {
                    $brand_id = is_array($associated_brand) ? $associated_brand[0]->ID : $associated_brand->ID;

                    // Get brand colors
                    $primary_color = get_field('primary_color', $brand_id);
                    $secondary_color = get_field('secondary_color', $brand_id);
                    $tertiary_color = get_field('tertiary_color', $brand_id);
                    $quaternary_color = get_field('quaternary_color', $brand_id);
                    $quinary_color = get_field('quinary_color', $brand_id);

                    // Output the brand colors
                    echo '<div style="background-color: ' . esc_attr($primary_color) . ';">Primary Color</div>';
                    echo '<div style="background-color: ' . esc_attr($secondary_color) . ';">Secondary Color</div>';
                    echo '<div style="background-color: ' . esc_attr($tertiary_color) . ';">Tertiary Color</div>';
                    echo '<div style="background-color: ' . esc_attr($quaternary_color) . ';">Quaternary Color</div>';
                    echo '<div style="background-color: ' . esc_attr($quinary_color) . ';">Quinary Color</div>';
                } else {
                    echo '<p>No associated brand found for the landing page.</p>';
                }
            }
        } else {
            echo '<p>No linked landing page found.</p>';
        }

        the_content();
    ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
    endwhile;
endif;

get_footer();
?>
