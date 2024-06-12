<?php
// Get the number of queries before rendering the section
$queries_before = get_num_queries();
global $wpdb;
$queries_before_list = $wpdb->queries;

// Get the testimonial section background color, text color, instance background color, instance text color, and instance accent color using get_post_meta
$post_id = get_the_ID();
$testimonial_background_color = get_post_meta($post_id, 'testimonial_section_background_color', true);
$testimonial_text_color = get_post_meta($post_id, 'testimonial_section_text_color', true);
$testimonial_instance_background_color = get_post_meta($post_id, 'testimonial_instance_background_color', true);
$testimonial_instance_text_color = get_post_meta($post_id, 'testimonial_instance_text_color', true);
$testimonial_instance_accent_color = get_post_meta($post_id, 'testimonial_instance_accent_color', true);

// Get the testimonial section heading content from the WYSIWYG field
$testimonial_section_heading_content = get_post_meta($post_id, 'testimonial_section_heading_content', true);

// Get the value of the "Enable Testimonial Section" field
$enable_testimonial_section = get_post_meta($post_id, 'enable_testimonial_section', true);

// Prepare the color values
$background_color_value = isset($brand_colors[$testimonial_background_color]) ? $brand_colors[$testimonial_background_color] : '#FFFFFF';
$text_color_value = isset($brand_colors[$testimonial_text_color]) ? $brand_colors[$testimonial_text_color] : '#000000';
$instance_background_color_value = isset($brand_colors[$testimonial_instance_background_color]) ? $brand_colors[$testimonial_instance_background_color] : '#F0F0F0';
$instance_text_color_value = isset($brand_colors[$testimonial_instance_text_color]) ? $brand_colors[$testimonial_instance_text_color] : '#000000';
$instance_accent_color_value = isset($brand_colors[$testimonial_instance_accent_color]) ? $brand_colors[$testimonial_instance_accent_color] : '#FF0000';
?>

<?php if ($enable_testimonial_section) : ?>
<!-- Testimonial Area -->
<section class="testimonial-section" style="background-color: <?php echo esc_attr($background_color_value); ?> !important;">
    <style>
        .testimonial-section .testimonial-heading,
        .testimonial-section .testimonial-heading p,
        .testimonial-section .testimonial-heading h1,
        .testimonial-section .testimonial-heading h2,
        .testimonial-section .testimonial-heading h3,
        .testimonial-section .testimonial-heading h4,
        .testimonial-section .testimonial-heading h5,
        .testimonial-section .testimonial-heading h6 {
            color: <?php echo esc_attr($text_color_value); ?> !important;
        }
    </style>
    <div class="testimonial-heading">
        <?php echo apply_filters('the_content', wp_kses_post($testimonial_section_heading_content)); ?>
    </div>
    <div class="testimonial-group">
        <?php if (have_rows('testimonial_instances')) : ?>
            <?php while (have_rows('testimonial_instances')) : the_row(); ?>
                <div class="testimonial-group-instance" style="background-color: <?php echo esc_attr($instance_background_color_value); ?> !important; border-top: 5px solid <?php echo esc_attr($instance_accent_color_value); ?> !important;">
                    <p class="testimonial-group-instance-copy" style="color: <?php echo esc_attr($instance_text_color_value); ?> !important;">
                        <?php echo esc_html(get_sub_field('testimonial_instance_copy')); ?>
                    </p>
                    <?php if ($portrait_image_url = get_sub_field('testimonial_instance_portrait_image')) : ?>
                        <img src="<?php echo esc_url($portrait_image_url); ?>" alt="Portrait Image" class="testimonial-group-instance-portrait">
                    <?php endif; ?>
                    <p class="testimonial-group-instance-name" style="color: <?php echo esc_attr($instance_text_color_value); ?> !important;">
                        <?php echo esc_html(get_sub_field('testimonial_instance_name')); ?>
                    </p>
                    <p class="testimonial-group-instance-title" style="color: <?php echo esc_attr($instance_text_color_value); ?> !important;">
                        <?php echo esc_html(get_sub_field('testimonial_instance_title')); ?>
                    </p>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
    <?php
    // Get the number of queries after rendering the section
    $queries_after = get_num_queries();
    $queries_for_section = $queries_after - $queries_before;

    // Get the list of queries after rendering the section
    $queries_after_list = $wpdb->queries;

    // Calculate the queries responsible for this section
    $queries_for_section_list = array_slice($queries_after_list, $queries_before);
    ?>
    <h5><?php echo $queries_for_section; ?> DB Queries for Testimonial Section</h5>
</section>
<?php endif; ?>
