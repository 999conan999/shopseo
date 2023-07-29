<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

 
function update_comment_shopseo($id,$json_img,$rs_comment,$rs_phone,$rs_rep,$rs_status,$rs_user_name){
    $json_img=stripslashes($json_img);
    $data = array(
        // 'id_post'=> $id,
        'json_img'=> $json_img,
        'rs_comment'=> $rs_comment,
        'rs_phone'=> $rs_phone,
        'rs_rep'=> $rs_rep,
        'rs_status'=> $rs_status,
        'rs_user_name'=> $rs_user_name,
    );
    global $wpdb;
    $table = $wpdb->prefix . 'shopseo_comments';
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


if(is_user_logged_in()){
    if($_POST){
        $id=(int)$_POST['id']; // id =-1 >create || update
        $json_img=$_POST['json_img'];   
        $rs_comment=$_POST['rs_comment'];   
        $rs_phone=$_POST['rs_phone'];   
        $rs_rep=$_POST['rs_rep'];   
        $rs_status=$_POST['rs_status'];   
        $rs_user_name=$_POST['rs_user_name'];   
        update_comment_shopseo($id,$json_img,$rs_comment,$rs_phone,$rs_rep,$rs_status,$rs_user_name);
    } 
}











?>