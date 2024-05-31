<?php

// Function to log a message to the console
function tp_log_to_console($message) {
    echo "<script>console.log('PHP: " . addslashes($message) . "');</script>";
}

// Log a message to the console
tp_log_to_console('public-scripts.php loaded');

// Enqueue the compiled CSS file
function tp_enqueue_styles() {
    wp_enqueue_style(
        'tailored-pages-styles',
        plugins_url('dist/css/style.css', dirname(__FILE__, 2)),
        array(),
        filemtime(plugin_dir_path(dirname(__FILE__, 2)) . 'dist/css/style.css')
    );
}
add_action('wp_enqueue_scripts', 'tp_enqueue_styles');

// Enqueue accordion.js file for the front end
function tp_enqueue_accordion_script() {
    wp_enqueue_script(
        'tp-accordion-js',
        plugins_url('js/accordion.js', dirname(__FILE__, 2)),
        array('jquery'),
        filemtime(plugin_dir_path(dirname(__FILE__, 2)) . 'js/accordion.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'tp_enqueue_accordion_script');



?>
