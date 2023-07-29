<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;
function delete_attribute_by_id($id){
    global $wpdb;
    $table = $wpdb->prefix . 'shopseo_attributes';
    $delete = $wpdb->delete(
    $table,
    array( 'id' => $id ),
    array( '%d' )
    );
    $object = new stdClass();
    $object->status=true;
    send($object);
}

if(is_user_logged_in()){
    if($_POST){
        $idN=(int)$_POST['id'];
        delete_attribute_by_id($idN);
    } 
}
?>