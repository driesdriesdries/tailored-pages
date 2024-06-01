<?php
// Add Meta Box for Template Selection
function tp_add_template_meta_box() {
    $screens = ['brochure', 'landing-page', 'listing-page'];
    foreach ($screens as $screen) {
        add_meta_box(
            'tp_template_selection',
            'Template Selection',
            'tp_template_meta_box_callback',
            $screen,
            'side'
        );
    }
}
add_action('add_meta_boxes', 'tp_add_template_meta_box');

function tp_template_meta_box_callback($post) {
    $value = get_post_meta($post->ID, '_tp_selected_template', true);

    $options = [];
    if ($post->post_type === 'landing-page') {
        $options = ['tp-landing-page-1' => 'Landing Page Template 1'];
    } elseif ($post->post_type === 'brochure') {
        $options = ['tp-brochure-1' => 'Brochure Template 1'];
    } elseif ($post->post_type === 'listing-page') {
        $options = ['tp-listing-page-1' => 'Listing Page Template 1'];
    }

    ?>
    <label for="tp_template_field">Select Template:</label>
    <select name="tp_template_field" id="tp_template_field">
        <option value="">Default Template</option>
        <?php foreach ($options as $template_value => $template_name): ?>
            <option value="<?php echo esc_attr($template_value); ?>" <?php selected($value, $template_value); ?>><?php echo esc_html($template_name); ?></option>
        <?php endforeach; ?>
    </select>
    <?php
}

// Save the selected template
function tp_save_template_meta_box($post_id) {
    if (array_key_exists('tp_template_field', $_POST)) {
        update_post_meta(
            $post_id,
            '_tp_selected_template',
            $_POST['tp_template_field']
        );
    }
}
add_action('save_post', 'tp_save_template_meta_box');
?>
