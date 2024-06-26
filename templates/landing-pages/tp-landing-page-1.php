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

    // Retrieve Google Fonts script URL and font family name
    $google_fonts_script_url = get_post_meta($associated_brand_id, 'google_fonts_script_url', true);
    $font_family_name = get_post_meta($associated_brand_id, 'font_family_name', true);

    // Include Font Partial
    $font_partial_path = plugin_dir_path(dirname(__FILE__, 2)) . 'includes/public/font-inclusion.php';

    if (file_exists($font_partial_path)) {
        include $font_partial_path;
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

        <!-- Testimonial Section -->
        <?php
        $testimonial_variables = compact('brand_colors');
        include_template_part('testimonial-section', $testimonial_variables);
        ?>

        <!-- Call-to-Action Section -->
        <?php
        $cta_variables = compact('brand_colors');
        include_template_part('cta-section', $cta_variables);
        ?>

        <!-- FAQ Section -->
        <?php
        $faq_variables = compact('brand_colors');
        include_template_part('faq-section', $faq_variables);
        ?>

        <!-- Case Studies/Success Stories -->
        <section class="case-studies-section">
            <h1>Case studies content</h1>
        </section>

        <!-- Unique Selling Points -->
        <section class="usp-section">
            <h1>Unique selling points content</h1>
        </section>

        <!-- Features/Benefits -->
        <section class="features-section">
            <h1>Features and benefits content</h1>
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

        <!-- Newsletter Signup -->
        <section class="newsletter-section">
            <h1>Newsletter signup form</h1>
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
