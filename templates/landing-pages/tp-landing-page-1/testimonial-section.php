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

// Prepare the color values
$background_color_value = isset($brand_colors[$testimonial_background_color]) ? $brand_colors[$testimonial_background_color] : '#FFFFFF';
$text_color_value = isset($brand_colors[$testimonial_text_color]) ? $brand_colors[$testimonial_text_color] : '#000000';
$instance_background_color_value = isset($brand_colors[$testimonial_instance_background_color]) ? $brand_colors[$testimonial_instance_background_color] : '#F0F0F0';
$instance_text_color_value = isset($brand_colors[$testimonial_instance_text_color]) ? $brand_colors[$testimonial_instance_text_color] : '#000000';
$instance_accent_color_value = isset($brand_colors[$testimonial_instance_accent_color]) ? $brand_colors[$testimonial_instance_accent_color] : '#FF0000';
?>

<!-- Testimonial Area -->
<section class="testimonial-section" style="background-color: <?php echo esc_attr($background_color_value); ?> !important;">
    <style>
        .testimonial-section .testimonial-heading, .testimonial-section .testimonial-heading p {
            color: <?php echo esc_attr($text_color_value); ?> !important;
        }
    </style>
    <div class="testimonial-heading">
        <?php echo apply_filters('the_content', wp_kses_post($testimonial_section_heading_content)); ?>
    </div>
    <div class="testimonial-group">
        <div class="testimonial-group-instance" style="background-color: <?php echo esc_attr($instance_background_color_value); ?> !important; border-top: 5px solid <?php echo esc_attr($instance_accent_color_value); ?> !important;">
            <p class="testimonial-group-instance-copy" style="color: <?php echo esc_attr($instance_text_color_value); ?> !important;">“Andries used his wealth of experience and understanding of how humans learn best to foster a culture of growth in the Web Operations team that he led during my time at 2U. Always being keen to innovate and push the boundaries of what is possible made Andries a key component of a very successful team - he would be an absolute asset to any brand looking to drive hyper growth in the digital space.”</p>
            <img src="https://i.kym-cdn.com/entries/icons/facebook/000/045/146/son-goku-thumb-up.jpg" alt="#" class="testimonial-group-instance-portrait">
            <p class="testimonial-group-instance-name" style="color: <?php echo esc_attr($instance_text_color_value); ?> !important;">Andries Bester</p>
            <p class="testimonial-group-instance-title" style="color: <?php echo esc_attr($instance_text_color_value); ?> !important;">Loser of Note</p>
            <img src="https://i.kym-cdn.com/entries/icons/facebook/000/045/146/son-goku-thumb-up.jpg" alt="" class="testimonial-group-instance-logo">
        </div>

        <div class="testimonial-group-instance" style="background-color: <?php echo esc_attr($instance_background_color_value); ?> !important; border-top: 5px solid <?php echo esc_attr($instance_accent_color_value); ?> !important;">
            <p class="testimonial-group-instance-copy" style="color: <?php echo esc_attr($instance_text_color_value); ?> !important;">“Andries used his wealth of experience and understanding of how humans learn best to foster a culture of growth in the Web Operations team that he led during my time at 2U. Always being keen to innovate and push the boundaries of what is possible made Andries a key component of a very successful team - he would be an absolute asset to any brand looking to drive hyper growth in the digital space.”</p>
            <img src="https://i.kym-cdn.com/entries/icons/facebook/000/045/146/son-goku-thumb-up.jpg" alt="#" class="testimonial-group-instance-portrait">
            <p class="testimonial-group-instance-name" style="color: <?php echo esc_attr($instance_text_color_value); ?> !important;">Andries Bester</p>
            <p class="testimonial-group-instance-title" style="color: <?php echo esc_attr($instance_text_color_value); ?> !important;">Loser of Note</p>
            <img src="https://i.kym-cdn.com/entries/icons/facebook/000/045/146/son-goku-thumb-up.jpg" alt="" class="testimonial-group-instance-logo">
        </div>
        
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
    <ul>
        <?php foreach ($queries_for_section_list as $query) : ?>
            <li><?php echo esc_html($query[0]); ?></li>
        <?php endforeach; ?>
    </ul>
</section>
