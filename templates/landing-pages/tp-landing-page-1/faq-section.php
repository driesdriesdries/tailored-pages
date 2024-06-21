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
                            <p style="color: <?php echo esc_attr($faq_section_accordion_body_copy_color); ?>;"><?php echo esc_html($faq_body); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
<?php } ?>
