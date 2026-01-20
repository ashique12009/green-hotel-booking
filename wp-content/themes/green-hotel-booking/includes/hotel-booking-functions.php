<?php 

function ghb_is_room_available($room_id, $checkin, $checkout) {
    global $wpdb;

    $table = $wpdb->prefix . 'room_bookings';

    // total rooms from CPT
    $total_rooms = (int) get_post_meta($room_id, '_room_total_room_number', true);

    // already booked rooms in date range
    $booked = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT SUM(qty) FROM $table
             WHERE room_id = %d
             AND status = 'confirmed'
             AND (
                (checkin < %s AND checkout > %s)
             )",
            $room_id,
            $checkout,
            $checkin
        )
    );

    $booked = (int) $booked;

    return ($total_rooms > $booked);
}

function ghb_insert_booking($data) {
    global $wpdb;

    $table = $wpdb->prefix . 'room_bookings';

    $wpdb->insert(
        $table,
        [
            'room_id'        => $data['room_id'],
            'checkin'        => $data['checkin'],
            'checkout'       => $data['checkout'],
            'qty'            => 1,
            'customer_name'  => $data['name'],
            'customer_email' => $data['email'],
            'status'         => 'confirmed'
        ],
        ['%d','%s','%s','%d','%s','%s','%s']
    );
}