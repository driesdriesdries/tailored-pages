<?php
// Enqueue the compiled CSS file
function tp_enqueue_styles() {
    wp_enqueue_style(
        'tailored-pages-styles',
        plugins_url('../../dist/css/style.css', __FILE__), // Path adjusted
        array(),
        filemtime(plugin_dir_path(__FILE__) . '../../dist/css/style.css') // Path adjusted
    );
}
add_action('wp_enqueue_scripts', 'tp_enqueue_styles');

// Enqueue accordion.js file for the front end
function tp_enqueue_accordion_script() {
    wp_enqueue_script(
        'tp-accordion-js',
        plugins_url('../../js/accordion.js', __FILE__), // Path adjusted
        array('jquery'),
        filemtime(plugin_dir_path(__FILE__) . '../../js/accordion.js'), // Path adjusted
        true
    );
}
add_action('wp_enqueue_scripts', 'tp_enqueue_accordion_script');
?>
