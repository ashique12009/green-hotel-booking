<?php 
require_once 'includes/hotel-features-custom-post-type.php';
require_once 'includes/hotel-rooms-custom-post-type.php';

add_theme_support('post-thumbnails');

function ghb_assets() {
    wp_enqueue_style(
        'main-style',
        get_stylesheet_uri()
    );

    wp_enqueue_script(
        'menu-js',
        get_template_directory_uri() . '/assets/js/menu.js',
        [],
        null,
        true
    );
}

add_action('wp_enqueue_scripts', 'ghb_assets');

// Menu
function ghb_register_menus() {
    register_nav_menus([
        'primary_menu' => 'Primary Header Menu',
    ]);
}
add_action('after_setup_theme', 'ghb_register_menus');