<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

function count_order(){// search phone or email ~~ '' => get all
     global $wpdb;
     $table_name=$wpdb->prefix .'shopseo_orders';
     $sql = $wpdb->prepare(
        "SELECT COUNT(*) as count
        FROM $table_name
        WHERE order_status = %s",
        'check'
    );
    $count = $wpdb->get_var( $sql);
    $object = new stdClass();
    $object->count=$count;
   send($object);
}

if(is_user_logged_in()==false){
    count_order();
}
 ?>