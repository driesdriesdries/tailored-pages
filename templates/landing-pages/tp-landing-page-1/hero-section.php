<!-- Hero Section -->
<?php
// Get the background image URL from the post meta
$background_image_id = get_post_meta(get_the_ID(), 'hero_section_background_image', true);
$background_image_url = $background_image_id ? wp_get_attachment_image_url($background_image_id, 'hero-background') : 'https://images.immediate.co.uk/production/volatile/sites/3/2023/03/goku-dragon-ball-guru-824x490-11b2006-e1697471244240.jpg';

// Get associated brand value
$associated_brand = get_field('associated_brand', get_the_ID()); // Assuming you're using ACF for this

// Ensure it's an ID
$associated_brand_id = is_array($associated_brand) && !empty($associated_brand) ? $associated_brand[0]->ID : $associated_brand;

// Use the current post title as the associated product
$associated_product_title = get_the_title(get_the_ID());

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
                        <input type="checkbox" id="marketing-consent" name="marketing_consent">
                        I agree to receive marketing communications
                    </label>
                </div>
                
                <input type="hidden" name="action" value="submit_landing_page_form">
                <input type="hidden" name="landing_page_id" value="<?php echo get_the_ID(); ?>">
                <input type="hidden" name="associated_brand" value="<?php echo esc_attr($associated_brand_id); ?>">
                <input type="hidden" name="associated_product" value="<?php echo esc_attr($associated_product_title); ?>">
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</section>
