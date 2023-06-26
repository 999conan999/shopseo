<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

 
function update_order_shopseo($id,$value){
    $data = array(
        // 'id_post'=> $id,
        // 'json_img'=> $json_img,
        // 'rs_comment'=> $rs_comment,
        // 'rs_phone'=> $rs_phone,
        // 'rs_rep'=> $rs_rep,
        'order_status'=> $value,
        // 'rs_user_name'=> $rs_user_name,
    );
    global $wpdb;
    $table = $wpdb->prefix . 'shopseo_orders';
    $rs=$wpdb->update(
        $table,
        $data,
        array('id' => $id)
    );
    $object = new stdClass();
    if($rs){
        $object->status=true;
    }else{
        $object->status=false;
    }
    send($object);
}


// if(is_user_logged_in()){
    if($_POST){
        $id=(int)$_POST['id']; // id =-1 >create || update
        $value=$_POST['value'];   
        update_order_shopseo($id,$value);
    } 
// }











?>