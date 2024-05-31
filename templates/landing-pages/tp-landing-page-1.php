<?php
/*
Template Name: TP Landing Page Template 1
*/
get_header();

function include_template_part($file, $variables = []) {
    extract($variables);
    include plugin_dir_path(__FILE__) . 'tp-landing-page-1/' . $file . '.php';
}

// Get the associated brand ID from post meta
$associated_brand_ids = get_post_meta(get_the_ID(), 'associated_brand', true);
$associated_brand_id = is_array($associated_brand_ids) && !empty($associated_brand_ids) ? $associated_brand_ids[0] : $associated_brand_ids;

// Initialize brand information variables
$brand_name = '';
$brand_logo_url = '';
$brand_logo_alt = '';
$brand_colors = [];

// Check if the associated brand ID exists
if ($associated_brand_id) {
    // Retrieve brand colors
    $brand_colors['primary_color'] = get_post_meta($associated_brand_id, 'primary_color', true);
    $brand_colors['secondary_color'] = get_post_meta($associated_brand_id, 'secondary_color', true);
    $brand_colors['tertiary_color'] = get_post_meta($associated_brand_id, 'tertiary_color', true);
    $brand_colors['quaternary_color'] = get_post_meta($associated_brand_id, 'quaternary_color', true);
    $brand_colors['quinary_color'] = get_post_meta($associated_brand_id, 'quinary_color', true);

    // Retrieve the brand name (post title)
    $brand_name = get_the_title($associated_brand_id);

    // Retrieve the brand logo from the brand post meta
    $brand_logo_id = get_post_meta($associated_brand_id, 'brand_logo', true);
    if ($brand_logo_id) {
        $brand_logo_url = wp_get_attachment_image_url($brand_logo_id, 'medium'); // Use 'medium' size
        $brand_logo_alt = get_post_meta($brand_logo_id, '_wp_attachment_image_alt', true);
    }
}
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main tp-landing-page1">
        <!-- Brand Information goes here -->
        <section class="navbar-section">
            <img src="<?php echo esc_url($brand_logo_url); ?>" alt="<?php echo esc_attr($brand_logo_alt); ?>">
            <h1><?php echo esc_html($brand_name); ?></h1>
        </section>
        
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="left">
                Left
            </div>
            <div class="right">
                right
            </div>
        </section>

        <!-- Unique Selling Points -->
        <section class="usp-section">
            <h1>Unique selling points content</h1>
        </section>

        <!-- Features/Benefits -->
        <section class="features-section">
            <h1>Features and benefits content</h1>
        </section>

        <!-- Testimonial Area -->
        <section class="testimonial-section">
            <h1>Testimonials content</h1>
        </section>

        <!-- Call-to-Action Section -->
        <?php
        // Define variables for the CTA section
        $cta_variables = compact('brand_colors');
        include_template_part('cta-section', $cta_variables);
        ?>

        <!-- Case Studies/Success Stories -->
        <section class="case-studies-section">
            <h1>Case studies content</h1>
        </section>

        <!-- FAQ Section -->
        <?php
        // Check if the FAQ section is enabled
        $enable_faq_section = get_post_meta(get_the_ID(), 'enable_faq_section', true);

        if ($enable_faq_section) {
            $post_meta = get_post_meta(get_the_ID());
            $faq_section_background_color = $brand_colors[$post_meta['faq_section_background_color'][0]];
            $faq_section_copy_color = $brand_colors[$post_meta['faq_section_copy_color'][0]];
            $faq_section_heading = $post_meta['faq_section_heading'][0];
            $faq_section_description = $post_meta['faq_section_description'][0];
            $faq_section_accordion_heading_background_color = $brand_colors[$post_meta['faq_section_accordion_heading_background_color'][0]];
            $faq_section_accordion_heading_copy_color = $brand_colors[$post_meta['faq_section_accordion_heading_copy_color'][0]];
            $faq_section_accordion_body_background_color = $brand_colors[$post_meta['faq_section_accordion_body_background_color'][0]];
            $faq_section_accordion_body_copy_color = $brand_colors[$post_meta['faq_section_accordion_body_copy_color'][0]];
            $faq_section_accordion_accent_color = $brand_colors[$post_meta['faq_section_accordion_accent_color'][0]];

            $faq_items = get_field('faq_section_repeater', get_the_ID());
            ?>

            <style>
                .faq-section .accordion-item .accordion-header:hover {
                    background-color: <?php echo esc_attr($faq_section_accordion_accent_color); ?>;
                }
                .faq-section .accordion-item .accordion-header:hover .accordion-icon {
                    color: <?php echo esc_attr($faq_section_accordion_accent_color); ?>;
                }
            </style>

            <section class="faq-section" style="background-color: <?php echo esc_attr($faq_section_background_color); ?>; color: <?php echo esc_attr($faq_section_copy_color); ?>;">
                <h2 style="text-align: center;"><?php echo esc_html($faq_section_heading); ?></h2>
                <p style="text-align: center;"><?php echo esc_html($faq_section_description); ?></p>
                <div class="accordion">
                    <?php if ($faq_items): ?>
                        <?php foreach ($faq_items as $faq_item): ?>
                            <?php
                            $faq_heading = $faq_item['faq_section_repeater_heading'];
                            $faq_body = $faq_item['faq_section_repeater_body'];
                            ?>
                            <div class="accordion-item" style="border-bottom: 2px solid <?php echo esc_attr($faq_section_accordion_accent_color); ?>;">
                                <button class="accordion-header" style="background-color: <?php echo esc_attr($faq_section_accordion_heading_background_color); ?>; color: <?php echo esc_attr($faq_section_accordion_heading_copy_color); ?>;">
                                    <h4><?php echo esc_html($faq_heading); ?></h4>
                                    <span class="accordion-icon" style="color: <?php echo esc_attr($faq_section_accordion_accent_color); ?>;">+</span>
                                </button>
                                <div class="accordion-content" style="background-color: <?php echo esc_attr($faq_section_accordion_body_background_color); ?>; color: <?php echo esc_attr($faq_section_accordion_body_copy_color); ?>;">
                                    <p style="color: <?php echo esc_attr($faq_section_accordion_body_copy_color); ?>; color: <?php echo esc_attr($faq_section_accordion_body_copy_color); ?>;"><?php echo esc_html($faq_body); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>
        <?php } ?>

        <!-- Video Section -->
        <section class="video-section">
            <h1>Video content</h1>
        </section>

        <!-- About Us Section -->
        <section class="about-us-section">
            <h1>About us content</h1>
        </section>

        <!-- Media Mentions/Trust Badges -->
        <section class="media-mentions-section">
            <h1>Media mentions and trust badges</h1>
        </section>

        <!-- Newsletter Signup -->
        <section class="newsletter-section">
            <h1>Newsletter signup form</h1>
        </section>

        <!-- Contact Information Section -->
        <section class="contact-section">
            <h1>Contact information content</h1>
        </section>

        <!-- Social Proof Section -->
        <section class="social-proof-section">
            <h1>Additional social proof</h1>
        </section>

        <!-- Footer -->
        <section class="footer-section">
            <h1>Footer content</h1>
        </section>

        <h1><?php echo get_num_queries(); ?> DB Queries</h1>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>
