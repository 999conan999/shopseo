<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;
require_once(get_stylesheet_directory().'/templates/ajax/xml/main.php');
function delete_post_by_id($id){
    wp_delete_post($id,true);
    $object = new stdClass();
    $object->status=true;
    main($id);
    send($object);
}

if(is_user_logged_in()){
    if($_POST){
        $idN=(int)$_POST['id'];
        delete_post_by_id($idN);
    } 
}
?>