<?php
/*
Template Name: TP Landing Page Template 1
*/
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main tp-landing-page1">
        <!-- Brand Information goes here -->
        <?php
        // Get the associated brand ID from post meta
        $associated_brand_ids = get_post_meta(get_the_ID(), 'associated_brand', true);
        
        // Check if the associated brand ID is an array and get the first element
        if (is_array($associated_brand_ids) && !empty($associated_brand_ids)) {
            $associated_brand_id = $associated_brand_ids[0];
        } else {
            $associated_brand_id = $associated_brand_ids;
        }

        // Initialize brand information variables
        $brand_name = '';
        $brand_logo_url = '';
        $brand_logo_alt = '';

        // Initialize brand colors array
        $brand_colors = [];

        // Check if the associated brand ID exists
        if ($associated_brand_id) {
            // Retrieve brand colors
            $brand_colors['primary_color'] = get_post_meta($associated_brand_id, 'primary_color', true);
            $brand_colors['secondary_color'] = get_post_meta($associated_brand_id, 'secondary_color', true);
            $brand_colors['tertiary_color'] = get_post_meta($associated_brand_id, 'tertiary_color', true);
            $brand_colors['quaternary_color'] = get_post_meta($associated_brand_id, 'quaternary_color', true);
            $brand_colors['quinary_color'] = get_post_meta($associated_brand_id, 'quinary_color', true);
        }

        if ($associated_brand_id) {
            // Retrieve the brand name (post title)
            $brand_name = get_the_title($associated_brand_id);

            // Retrieve the brand logo from the brand post meta
            $brand_logo_id = get_post_meta($associated_brand_id, 'brand_logo', true);

            if ($brand_logo_id) {
                // Assuming the brand logo is an image ID
                $brand_logo_url = wp_get_attachment_image_url($brand_logo_id, 'medium'); // Use 'medium' size
                $brand_logo_alt = get_post_meta($brand_logo_id, '_wp_attachment_image_alt', true);
            }
        }
        ?>
        
        <!-- Navbar Section -->
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

        <!-- Case Studies/Success Stories -->
        <section class="case-studies-section">
            <h1>Case studies content</h1>
        </section>

        <!-- FAQ Section -->
        <?php
        // Check if the FAQ section is enabled
        $enable_faq_section = get_post_meta(get_the_ID(), 'enable_faq_section', true);

        if ($enable_faq_section) {
            // Retrieve the values from the ACF fields
            $faq_section_background_color = $brand_colors[get_post_meta(get_the_ID(), 'faq_section_background_color', true)];
            $faq_section_copy_color = $brand_colors[get_post_meta(get_the_ID(), 'faq_section_copy_color', true)];
            $faq_section_heading = get_post_meta(get_the_ID(), 'faq_section_heading', true);
            $faq_section_description = get_post_meta(get_the_ID(), 'faq_section_description', true);
            $faq_section_accordion_heading_background_color = $brand_colors[get_post_meta(get_the_ID(), 'faq_section_accordion_heading_background_color', true)];
            $faq_section_accordion_heading_copy_color = $brand_colors[get_post_meta(get_the_ID(), 'faq_section_accordion_heading_copy_color', true)];
            $faq_section_accordion_body_background_color = $brand_colors[get_post_meta(get_the_ID(), 'faq_section_accordion_body_background_color', true)];
            $faq_section_accordion_body_copy_color = $brand_colors[get_post_meta(get_the_ID(), 'faq_section_accordion_body_copy_color', true)];
            $faq_section_accordion_accent_color = $brand_colors[get_post_meta(get_the_ID(), 'faq_section_accordion_accent_color', true)];
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
                    <?php if (have_rows('faq_section_repeater')): ?>
                        <?php while (have_rows('faq_section_repeater')): the_row(); ?>
                            <?php
                            $faq_heading = get_sub_field('faq_section_repeater_heading');
                            $faq_body = get_sub_field('faq_section_repeater_body');
                            ?>
                            <div class="accordion-item" style="border-bottom: 2px solid <?php echo esc_attr($faq_section_accordion_accent_color); ?>;">
                                <button class="accordion-header" style="background-color: <?php echo esc_attr($faq_section_accordion_heading_background_color); ?>; color: <?php echo esc_attr($faq_section_accordion_heading_copy_color); ?>;">
                                    <h4><?php echo esc_html($faq_heading); ?></h4>
                                    <span class="accordion-icon" style="color: <?php echo esc_attr($faq_section_accordion_accent_color); ?>;">+</span>
                                </button>
                                <div class="accordion-content" style="background-color: <?php echo esc_attr($faq_section_accordion_body_background_color); ?>; color: <?php echo esc_attr($faq_section_accordion_body_copy_color); ?>;">
                                    <p><?php echo esc_html($faq_body); ?></p>
                                </div>
                            </div>
                        <?php endwhile; ?>
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

        <!-- Call-to-Action Section -->
        <?php
        // Check if the CTA section is enabled
        $enable_cta_section = get_post_meta(get_the_ID(), 'enable_cta_section', true);

        if ($enable_cta_section) {
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

            // Debug output to ensure values are being fetched correctly
            echo '<!-- Debug: ';
            echo 'Enable CTA Section: ' . $enable_cta_section . '; ';
            echo 'CTA Heading: ' . $cta_section_heading . '; ';
            echo 'CTA Description: ' . $cta_section_description . '; ';
            echo 'CTA Background Color Key: ' . $cta_section_bg_color_key . '; ';
            echo 'CTA Background Color: ' . $cta_section_bg_color . '; ';
            echo 'CTA Copy Color Key: ' . $cta_section_copy_color_key . '; ';
            echo 'CTA Copy Color: ' . $cta_section_copy_color . '; ';
            echo 'CTA Button Background Color Key: ' . $cta_section_button_bg_color_key . '; ';
            echo 'CTA Button Background Color: ' . $cta_section_button_bg_color . '; ';
            echo 'CTA Button Copy Color Key: ' . $cta_section_button_copy_color_key . '; ';
            echo 'CTA Button Copy Color: ' . $cta_section_button_copy_color . '; ';
            echo 'CTA Button Copy: ' . $cta_section_button_copy . '; ';
            echo 'CTA Button Link: ' . $cta_section_button_link . '; ';
            echo 'CTA Button Link New Tab: ' . $cta_section_button_link_new_tab;
            echo ' -->';
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
            </section>
        <?php } ?>


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

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>
