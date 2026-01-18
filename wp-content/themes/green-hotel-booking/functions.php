<?php 
require_once 'includes/hotel-features.php';

add_theme_support('post-thumbnails');

function ghb_assets() {
    wp_enqueue_style(
        'main-style',
        get_stylesheet_uri()
    );
}

add_action('wp_enqueue_scripts', 'ghb_assets');