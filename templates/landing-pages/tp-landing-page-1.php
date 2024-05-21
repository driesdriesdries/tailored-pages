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
        <section class="faq-section">
            <h1>FAQ content</h1>
        </section>

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
            // Get the CTA section heading from post meta
            $cta_section_heading = get_post_meta(get_the_ID(), 'cta_section_heading', true);
        ?>
        <section class="cta-section">
            <div class="content">
            <h2><?php echo esc_html($cta_section_heading); ?></h2>
                <p>Join thousands of satisfied customers who have transformed their businesses with our solutions. Take the first step towards achieving your goals today.</p>
                <a href="#">Find Out More</a>
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
