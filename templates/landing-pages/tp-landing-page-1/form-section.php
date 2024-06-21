<?php
// Form Partial: form-section.php

// Log associated brand ID for debugging
error_log("Associated Brand ID in Form Partial: $associated_brand_id");

// Check if there are any errors with form fields (debugging purpose)
if (!isset($associated_brand_id) || !isset($associated_product_title)) {
    error_log("Form Partial Error: associated_brand_id or associated_product_title is not set.");
}
?>

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
