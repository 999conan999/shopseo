<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;
require_once(get_stylesheet_directory().'/templates/ajax/xml/main.php');
 
function update_shopseo($id,$value,$type){
    // $thumnail=stripslashes($thumnail);
    if($type=="instock"){
        $data = array(
            'instock'=> $value,
        );
    }elseif($type=="shoping_type"){
        $data = array(
            'shoping_type'=> $value,
        );
    }elseif($type=="shoping_on_off"){
        $data = array(
            'shoping_on_off'=> $value,
        );
    }
    global $wpdb;
    $table = $wpdb->prefix . 'shopseo_posts';
    $rs=$wpdb->update(
        $table,
        $data,
        array('id_post' => $id)
    );
    $object = new stdClass();
    if($rs){
        main($id);
        $object->status=true;
    }else{
        $object->status=false;
    }
    send($object);
}


if(is_user_logged_in()){
    if($_POST){
        $id=(int)$_POST['id']; // id =-1 >create || update
        $value=$_POST['value'];   
        $type=$_POST['type'];   
        update_shopseo($id,$value,$type);
    } 
}











?>