<?php 
// Create Parent Menu
function tp_create_parent_menu() {
    add_menu_page(
        __( 'Tailored Pages', 'text_domain' ),
        __( 'Tailored Pages', 'text_domain' ),
        'manage_options',
        'tailored-pages',
        '',
        'dashicons-admin-generic',
        6
    );
}
add_action( 'admin_menu', 'tp_create_parent_menu' );