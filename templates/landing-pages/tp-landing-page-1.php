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
    
        <!-- Navbar Section -->
        <?php
        $navbar_variables = compact('brand_name', 'brand_logo_url', 'brand_logo_alt', 'brand_colors');
        include_template_part('navbar-section', $navbar_variables);
        ?>
        
        <!-- Hero Section -->
        <?php
        $hero_variables = compact('brand_name', 'brand_colors');
        include_template_part('hero-section', $hero_variables);
        ?>

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
        $cta_variables = compact('brand_colors');
        include_template_part('cta-section', $cta_variables);
        ?>

        <!-- Case Studies/Success Stories -->
        <section class="case-studies-section">
            <h1>Case studies content</h1>
        </section>

        <!-- FAQ Section -->
        <?php
        $faq_variables = compact('brand_colors');
        include_template_part('faq-section', $faq_variables);
        ?>

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
