<?php 
require_once 'includes/hotel-features-custom-post-type.php';
require_once 'includes/hotel-rooms-custom-post-type.php';
require_once 'includes/hotel-amenities-custom-post-type.php';
require_once 'includes/hotel-guest-exp-custom-post-type.php';
require_once 'includes/menu-setup.php';
require_once 'includes/cta-newsletter.php';
require_once 'includes/cta-email-queue.php';
require_once 'includes/hote-booking-table.php';
require_once 'includes/hotel-booking-functions.php';

add_theme_support('post-thumbnails');
add_theme_support('title-tag');

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

    wp_enqueue_script(
        'cta-js',
        get_template_directory_uri() . '/assets/js/cta-newsletter.js',
        ['jquery'],
        null,
        true
    );

    wp_localize_script(
        'cta-js',
        'ghbCta',
        [
            'ajax_url' => admin_url('admin-ajax.php'),
        ]
    );
}

add_action('wp_enqueue_scripts', 'ghb_assets');

function write_log( $data ) {
    if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
        $log_file = WP_CONTENT_DIR . '/debug.log';

        if ( is_array( $data ) || is_object( $data ) ) {
            error_log( print_r( $data, true ), 3, $log_file );
        } else {
            error_log( $data . PHP_EOL, 3, $log_file );
        }
    }
}

// Available rooms page template
function create_available_rooms_page() {

    $slug = 'available-rooms';

    // Check if page already exists
    if ( ! get_page_by_path( $slug ) ) {

        $page_id = wp_insert_post([
            'post_title'   => 'Available Rooms',
            'post_name'    => $slug,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => ''
        ]);

        // Assign page template (optional but good practice)
        if ( $page_id && ! is_wp_error($page_id) ) {
            update_post_meta(
                $page_id,
                '_wp_page_template',
                'page-available-rooms.php'
            );
        }
    }
}
add_action('after_switch_theme', 'create_available_rooms_page');

// Checkout page template
function create_checkout_page() {

    $slug = 'checkout';

    // Check if page already exists
    if ( ! get_page_by_path( $slug ) ) {

        $page_id = wp_insert_post([
            'post_title'   => 'Checkout',
            'post_name'    => $slug,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => ''
        ]);

        // Assign page template (optional but good practice)
        if ( $page_id && ! is_wp_error($page_id) ) {
            update_post_meta(
                $page_id,
                '_wp_page_template',
                'page-checkout.php'
            );
        }
    }
}
add_action('after_switch_theme', 'create_checkout_page');