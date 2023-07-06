<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

 
function update_shopseo($id){
    // $thumnail=stripslashes($thumnail);
    $data = array(
        'data_cache'=> '',
        'time_cache'=> '',
    );
    global $wpdb;
    $table = $wpdb->prefix . 'shopseo_posts';
    $rs=$wpdb->update(
        $table,
        $data,
        array('id_post' => $id)
    );
    $object = new stdClass();
    if($rs){
        $object->status=true;
    }else{
        $object->status=false;
    }
    send($object);
}


if(is_user_logged_in()){
    if($_POST){
        $id=(int)$_POST['id']; // id =-1 >create || update
        update_shopseo($id);
    } 
}











?>