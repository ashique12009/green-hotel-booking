<?php
// Create CTA Newsletter Table
function ghb_create_cta_table() {
    global $wpdb;
    $table = $wpdb->prefix . 'cta_emails';

    $charset = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(190) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) $charset;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
add_action('after_setup_theme', 'ghb_create_cta_table');

// Function to insert email into the CTA Newsletter Table
function ghb_save_cta_email() {

    check_ajax_referer('cta_nonce', 'nonce');

    if ( empty($_POST['email']) || ! is_email($_POST['email']) ) {
        wp_send_json_error('Invalid email');
    }

    global $wpdb;
    $table = $wpdb->prefix . 'cta_emails';

    $email = sanitize_email($_POST['email']);

    // Check duplicate
    $exists = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT id FROM $table WHERE email = %s",
            $email
        )
    );

    if ( $exists ) {
        wp_send_json_error('This email is already subscribed.');
    }

    $wpdb->insert($table, [
        'email' => $email,
    ]);

    // Optional: notify admin
    wp_mail(
        get_option('admin_email'),
        'New CTA Signup',
        'New email: ' . $email
    );

    wp_send_json_success('Thank you for subscribing!');
}

add_action('wp_ajax_ghb_save_cta_email', 'ghb_save_cta_email');
add_action('wp_ajax_nopriv_ghb_save_cta_email', 'ghb_save_cta_email');