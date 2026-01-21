<?php 
add_action('admin_menu', function () {
    add_menu_page(
        'Room Bookings',
        'Bookings',
        'manage_options',
        'room-bookings',
        'render_room_bookings_page',
        'dashicons-calendar-alt',
        26
    );
});

function render_room_bookings_page() {

    require_once get_stylesheet_directory() . '/includes/admin-class-room-booking-list-table.php';

    $table = new Room_Bookings_List_Table();
    $table->prepare_items();

    echo '<div class="wrap">';
        echo '<h1>Room Bookings</h1>';

        echo '<form method="post">';
            $table->display();
        echo '</form>';

    echo '</div>';
}

// Handle status change action
add_action('admin_init', function () {

    if (
        isset($_GET['action'], $_GET['id']) && $_GET['action'] === 'change_status' && 
        current_user_can('manage_options')
    ) {
        global $wpdb;

        $id = (int) $_GET['id'];
        $table = $wpdb->prefix . 'room_bookings';

        $current = $wpdb->get_var(
            $wpdb->prepare("SELECT status FROM $table WHERE id = %d", $id)
        );

        $new_status = ($current === 'confirmed') ? 'paid' : 'cancelled';

        $wpdb->update(
            $table,
            ['status' => $new_status],
            ['id' => $id],
            ['%s'],
            ['%d']
        );

        wp_redirect(admin_url('admin.php?page=room-bookings'));
        exit;
    }
});