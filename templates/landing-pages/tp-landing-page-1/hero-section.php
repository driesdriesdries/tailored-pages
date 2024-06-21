<?php
// Capture the initial number of queries
$initial_hero_queries = get_num_queries();

// Get all post meta values at once
$post_meta = get_post_meta(get_the_ID());

// Extract the necessary meta values
$background_image_id = isset($post_meta['hero_section_background_image'][0]) ? $post_meta['hero_section_background_image'][0] : '';
$background_image_url = $background_image_id ? wp_get_attachment_image_url($background_image_id, 'hero-background') : '';
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

<section class="hero-section" style="<?php echo $background_image_url ? 'background-image: url(' . esc_url($background_image_url) . ');' : 'background-color: white;'; ?>">
    <div class="hero-content">
        <div class="hero-text">
            <h1>Hero section will go here</h1>
        </div>
        <div class="hero-form">
            <?php
            // Include the form partial
            $form_variables = compact('associated_brand_id', 'associated_product_title');
            include plugin_dir_path(__FILE__) . 'form-section.php';
            ?>
        </div>
    </div>
</section>
<h5 style="text-align: center;"><?php // echo "Hero Section Queries: $hero_section_queries"; ?></h5>
