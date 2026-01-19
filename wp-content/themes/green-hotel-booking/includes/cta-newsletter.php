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
    $to = get_option('admin_email');
    $subject = 'New CTA Signup';

    $message = '
    <html>
    <body>
        <h2>New CTA Signup</h2>
        <p>A new user has been added as a subscriber.</p>
        <p><strong>Email:</strong> ' . esc_html($email) . '</p>
    </body>
    </html>
    ';

    $headers = array(
        'Content-Type: text/html; charset=UTF-8'
    );

    wp_mail($to, $subject, $message, $headers);


    wp_send_json_success('Thank you for subscribing!');
}

add_action('wp_ajax_ghb_save_cta_email', 'ghb_save_cta_email');
add_action('wp_ajax_nopriv_ghb_save_cta_email', 'ghb_save_cta_email');

// CTA newsletter admin email settings
// Looking to send emails in production? Check out our Email API/SMTP product!
function ghb_mailtrap($phpmailer) {
    $phpmailer->isSMTP();
    $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 2525;
    $phpmailer->Username = '8c47d5a7abace5';
    $phpmailer->Password = '7b69ef42c5e37e';
}

add_action('phpmailer_init', 'ghb_mailtrap');