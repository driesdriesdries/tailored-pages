<?php
// Capture the initial number of queries
$initial_hero_queries = get_num_queries();

// Get all post meta values at once
$post_meta = get_post_meta(get_the_ID());

// Extract the necessary meta values
$background_image_id = isset($post_meta['hero_section_background_image'][0]) ? $post_meta['hero_section_background_image'][0] : '';
$background_image_url = $background_image_id ? wp_get_attachment_image_url($background_image_id, 'hero-background') : 'https://images.immediate.co.uk/production/volatile/sites/3/2023/03/goku-dragon-ball-guru-824x490-11b2006-e1697471244240.jpg';
$associated_brand_ids = isset($post_meta['associated_brand'][0]) ? maybe_unserialize($post_meta['associated_brand'][0]) : '';
$associated_brand_id = is_array($associated_brand_ids) && !empty($associated_brand_ids) ? $associated_brand_ids[0] : $associated_brand_ids;

// Use the current post title as the associated product
$associated_product_title = get_the_title(get_the_ID());

// If there's an associated brand ID, fetch brand colors and other details
$brand_name = '';
$brand_logo_url = '';
$brand_logo_alt = '';
$brand_colors = [];

if ($associated_brand_id) {
    // Fetch all associated brand meta values in one go
    $brand_meta = get_post_meta($associated_brand_id);
    $brand_colors['primary_color'] = isset($brand_meta['primary_color'][0]) ? $brand_meta['primary_color'][0] : '';
    $brand_colors['secondary_color'] = isset($brand_meta['secondary_color'][0]) ? $brand_meta['secondary_color'][0] : '';
    $brand_colors['tertiary_color'] = isset($brand_meta['tertiary_color'][0]) ? $brand_meta['tertiary_color'][0] : '';
    $brand_colors['quaternary_color'] = isset($brand_meta['quaternary_color'][0]) ? $brand_meta['quaternary_color'][0] : '';
    $brand_colors['quinary_color'] = isset($brand_meta['quinary_color'][0]) ? $brand_meta['quinary_color'][0] : '';

    // Retrieve the brand name (post title)
    $brand_name = get_the_title($associated_brand_id);

    // Retrieve the brand logo from the brand post meta
    $brand_logo_id = isset($brand_meta['brand_logo'][0]) ? $brand_meta['brand_logo'][0] : '';
    if ($brand_logo_id) {
        $brand_logo_url = wp_get_attachment_image_url($brand_logo_id, 'medium'); // Use 'medium' size
        $brand_logo_alt = get_post_meta($brand_logo_id, '_wp_attachment_image_alt', true);
    }
}

// Log associated brand ID for debugging
error_log("Associated Brand ID in Template: $associated_brand_id");

// Capture the number of queries after retrieving the hero section data
$final_hero_queries = get_num_queries();
$hero_section_queries = $final_hero_queries - $initial_hero_queries;
?>

<section class="hero-section" style="background-image: url('<?php echo esc_url($background_image_url); ?>');">
    <div class="hero-content">
        <div class="hero-text">
            <h1>Hero section will go here</h1>
        </div>
        <div class="hero-form">
            <form id="landing-page-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                <div class="form-group">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" name="first_name" required>
                </div>
                
                <div class="form-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" name="last_name" required>
                </div>
                
                <div class="form-group">
                    <label for="email-address">Email Address</label>
                    <input type="email" id="email-address" name="email_address" required>
                </div>
                
                <div class="form-group">
                    <label for="marketing-consent">
                        <input type="checkbox" id="marketing-consent" name="marketing_consent" value="yes">
                        I agree to receive marketing communications
                    </label>
                </div>
                
                <input type="hidden" name="action" value="submit_landing_page_form">
                <input type="hidden" name="landing_page_id" value="<?php echo get_the_ID(); ?>">
                <input type="hidden" name="associated_brand" value="<?php echo esc_attr($associated_brand_id); ?>">
                <input type="hidden" name="associated_product" value="<?php echo esc_attr($associated_product_title); ?>">

                <?php
                    error_log("Form Hidden Fields: landing_page_id=" . get_the_ID() . ", associated_brand=" . esc_attr($associated_brand_id) . ", associated_product=" . esc_attr($associated_product_title));
                ?>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</section>
<h5 style="text-align: center;"><?php echo "Hero Section Queries: $hero_section_queries"; ?></h5>
