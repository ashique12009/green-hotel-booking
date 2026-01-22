<?php
/*
Template Name: Checkout
*/

get_header();

$current_user = null;

if ( is_user_logged_in() ) {
    $current_user = wp_get_current_user();
}

global $wpdb;

/* ---------------------------------
 * 1. Get & validate URL params
 * --------------------------------- */
$room_id  = isset($_GET['room_id']) ? (int) $_GET['room_id'] : 0;
$checkin  = isset($_GET['checkin']) ? sanitize_text_field($_GET['checkin']) : '';
$checkout = isset($_GET['checkout']) ? sanitize_text_field($_GET['checkout']) : '';
$guests   = isset($_GET['guests']) ? (int) $_GET['guests'] : 1;

if ( ! $room_id || ! $checkin || ! $checkout ) {
    echo '<p>Invalid booking request.</p>';
    get_footer();
    return;
}

/* ---------------------------------
 * 2. Load room data
 * --------------------------------- */
$room = get_post($room_id);

if ( ! $room || $room->post_type !== 'room' ) {
    echo '<div class="booking-error-wrapper">';
    echo '<p>Room not found.</p>';
    echo '</div>';
    get_footer();
    return;
}

$new_price   = (float) get_post_meta($room_id, '_room_new_price', true);
$max_guests  = (int) get_post_meta($room_id, '_room_max_guest_number', true);

/* ---------------------------------
 * 3. Calculate nights & price
 * --------------------------------- */
$checkin_date  = new DateTime($checkin);
$checkout_date = new DateTime($checkout);
$nights        = $checkin_date->diff($checkout_date)->days;

if ( $nights <= 0 ) {
    echo '<div class="booking-error-wrapper">';
    echo '<p>Invalid date selection.</p>';
    echo '</div>';
    get_footer();
    return;
}

$total_price = $nights * $new_price;

/* ---------------------------------
 * 4. Availability re-check
 * --------------------------------- */
if ( ! ghb_is_room_available($room_id, $checkin, $checkout) ) {
    echo '<div class="booking-error-wrapper">';
    echo '<p>Sorry, this room is no longer available.</p>';
    echo '</div>';
    get_footer();
    return;
}

/* ---------------------------------
 * 5. Handle form submit
 * --------------------------------- */
if ( isset($_POST['confirm_booking']) ) {

    if ( ! isset($_POST['_wpnonce']) || ! wp_verify_nonce($_POST['_wpnonce'], 'confirm_booking_nonce') ) {
        die('Security check failed');
    }

    $name  = sanitize_text_field($_POST['customer_name']);
    $email = sanitize_email($_POST['customer_email']);

    if ( empty($name) || empty($email) ) {
        echo '<p>Please fill all required fields.</p>';
    } else {
        // FINAL availability check (very important)
        if ( ghb_is_room_available($room_id, $checkin, $checkout) ) {

            $table = $wpdb->prefix . 'room_bookings';

            ghb_insert_booking([
                'room_id'        => $room_id,
                'checkin'        => $checkin,
                'checkout'       => $checkout,
                'name'           => $name,
                'email'          => $email
            ]);

            // Prepare email data
            $subject = 'Booking Confirmation';

            $email_html = ghb_get_email_template('booking-confirmation', [
                'name'          => $name,
                'room_title'    => $room->post_title,
                'checkin'       => $checkin,
                'checkout'      => $checkout,
                'nights'        => $nights,
                'total_price'   => $total_price,
            ]);
            
            // Put this emails into the Queue (no wp_mail will send here!)
            ghb_insert_booking_confirmation_into_queue($email, $subject, $email_html);

            echo '<div class="booking-confirmation-wrapper">';
            echo '<h2>✅ Booking Confirmed!</h2>';
            echo '<p>Thank you for your booking.</p>';
            echo '</div>';
            get_footer();
            return;

        } else {
            echo '<div class="booking-error-wrapper">';
            echo '<p>Room just got booked. Please try another room.</p>';
            echo '</div>';
        }
    }
}
?>
<section class="checkout-section ptop100 pbot50 minh300">
    <div class="container">
        <div class="checkout-wrapper">

            <h1>Checkout</h1>

            <div class="checkout-room">
                <h2><?php echo esc_html($room->post_title); ?></h2>

                <p><strong>Check-in:</strong> <?php echo esc_html($checkin); ?></p>
                <p><strong>Check-out:</strong> <?php echo esc_html($checkout); ?></p>
                <p><strong>Nights:</strong> <?php echo esc_html($nights); ?></p>
                <p><strong>Guests:</strong> <?php echo esc_html($guests); ?></p>

                <p><strong>Price per night:</strong> €<?php echo esc_html($new_price); ?></p>
                <p><strong>Total price:</strong> <strong>€<?php echo esc_html($total_price); ?></strong></p>
            </div>

            <hr>

            <form method="post" class="checkout-form">
                <?php wp_nonce_field('confirm_booking_nonce'); ?>
                <p>
                    <label>Your Name *</label>
                    <input type="text" name="customer_name" value="<?php echo $current_user ? esc_attr( $current_user->display_name ) : ''; ?>" required>
                </p>
                <p>
                    <label>Email *</label>
                    <input type="email" name="customer_email" value="<?php echo $current_user ? esc_attr( $current_user->user_email ) : ''; ?>" required>
                </p>
                <button type="submit" name="confirm_booking" class="btn-confirm btn-book mtop10">
                    Confirm Booking
                </button>
            </form>

        </div>
    </div>
</section>

<?php
get_footer();