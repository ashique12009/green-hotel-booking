<?php
if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class Room_Bookings_List_Table extends WP_List_Table {

    public function get_columns() {
        return [
            'cb'       => '<input type="checkbox" />',
            'id'       => 'ID',
            'room'     => 'Room',
            'customer' => 'Customer',
            'dates'    => 'Dates',
            'status'   => 'Status',
            'created'  => 'Created'
        ];
    }

    protected function column_cb($item) {
        return '<input type="checkbox" name="booking_id[]" value="' . esc_attr($item->id) . '">';
    }

    protected function column_room($item) {
        return get_the_title($item->room_id);
    }

    protected function column_customer($item) {
        return esc_html($item->customer_name) . '<br><small>' . esc_html($item->customer_email) . '</small>';
    }

    protected function column_dates($item) {
        return esc_html($item->checkin) . ' → ' . esc_html($item->checkout);
    }

    protected function column_status($item) {
        $url = admin_url('admin.php?page=room-bookings&action=change_status&id=' . $item->id);
        return '<strong>' . esc_html($item->status) . '</strong>
        <br><a href="' . esc_url($url) . '">Change</a>';
    }

    public function prepare_items() {
        global $wpdb;

        $table = $wpdb->prefix . 'room_bookings';
        $data  = $wpdb->get_results("SELECT * FROM $table ORDER BY created_at DESC");

        $this->items = $data;
        $this->_column_headers = [$this->get_columns(), [], []];
    }
}