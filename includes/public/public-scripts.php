<?php 
// Enqueue the compiled CSS file
function tp_enqueue_styles() {
    wp_enqueue_style(
        'tailored-pages-styles',
        plugin_dir_url(__FILE__) . 'dist/css/style.css',
        array(),
        filemtime(plugin_dir_path(__FILE__) . 'dist/css/style.css')
    );
}
add_action('wp_enqueue_scripts', 'tp_enqueue_styles');

// Enqueue accordion.js file for the front end
function tp_enqueue_accordion_script() {
    wp_enqueue_script(
        'tp-accordion-js',
        plugin_dir_url(__FILE__) . 'js/accordion.js',
        array('jquery'),
        filemtime(plugin_dir_path(__FILE__) . 'js/accordion.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'tp_enqueue_accordion_script');
