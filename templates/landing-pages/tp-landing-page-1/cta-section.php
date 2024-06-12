<?php
// Check if the CTA section is enabled
$enable_cta_section = get_post_meta(get_the_ID(), 'enable_cta_section', true);

if ($enable_cta_section) {
    // Get the initial number of queries
    $initial_queries = get_num_queries();

    // Get the CTA section heading and description from post meta
    $cta_section_heading = get_post_meta(get_the_ID(), 'cta_section_heading', true);
    $cta_section_description = get_post_meta(get_the_ID(), 'cta_section_description', true);

    // Get the selected CTA background color and text color
    $cta_section_bg_color_key = get_post_meta(get_the_ID(), 'cta_section_bg_color', true);
    $cta_section_copy_color_key = get_post_meta(get_the_ID(), 'cta_section_copy_color', true);

    // Get the selected CTA button background color, text color, button text, link destination, and new tab option
    $cta_section_button_bg_color_key = get_post_meta(get_the_ID(), 'cta_section_button_background_color', true);
    $cta_section_button_copy_color_key = get_post_meta(get_the_ID(), 'cta_section_button_copy_color', true);
    $cta_section_button_copy = get_post_meta(get_the_ID(), 'cta_section_button_copy', true);
    $cta_section_button_link = get_post_meta(get_the_ID(), 'cta_section_button_link', true);
    $cta_section_button_link_new_tab = get_post_meta(get_the_ID(), 'cta_section_button_link_new_tab', true);

    // Retrieve colors from the brand colors array or default to an empty string if not set
    $cta_section_bg_color = isset($brand_colors[$cta_section_bg_color_key]) ? $brand_colors[$cta_section_bg_color_key] : '';
    $cta_section_copy_color = isset($brand_colors[$cta_section_copy_color_key]) ? $brand_colors[$cta_section_copy_color_key] : '';
    $cta_section_button_bg_color = isset($brand_colors[$cta_section_button_bg_color_key]) ? $brand_colors[$cta_section_button_bg_color_key] : '';
    $cta_section_button_copy_color = isset($brand_colors[$cta_section_button_copy_color_key]) ? $brand_colors[$cta_section_button_copy_color_key] : '';

    // Determine target attribute based on the new tab option
    $cta_button_target = !empty($cta_section_button_link_new_tab) ? ' target="_blank"' : '';

    ?>
    <section class="cta-section" style="background-color: <?php echo esc_attr($cta_section_bg_color); ?>;">
        <div class="content">
            <?php if (!empty($cta_section_heading)) : ?>
                <h2 style="color: <?php echo esc_attr($cta_section_copy_color); ?>;"><?php echo esc_html($cta_section_heading); ?></h2>
            <?php endif; ?>
            <?php if (!empty($cta_section_description)) : ?>
                <p style="color: <?php echo esc_attr($cta_section_copy_color); ?>;"><?php echo esc_html($cta_section_description); ?></p>
            <?php endif; ?>
            <?php if (!empty($cta_section_button_copy) && !empty($cta_section_button_link)) : ?>
                <a class="primary-button" href="<?php echo esc_url($cta_section_button_link); ?>" style="background-color: <?php echo esc_attr($cta_section_button_bg_color); ?>; color: <?php echo esc_attr($cta_section_button_copy_color); ?>;"<?php echo $cta_button_target; ?>><?php echo esc_html($cta_section_button_copy); ?></a>
            <?php endif; ?>
        </div>
        <h5 style="text-align: center;">
            <?php
            // Get the final number of queries
            $final_queries = get_num_queries();
            // Calculate the number of queries the CTA section is responsible for
            $cta_section_queries = $final_queries - $initial_queries;
            echo "CTA Section Queries: $cta_section_queries";
            ?>
        </h5>
    </section>
    <?php
}
?>
