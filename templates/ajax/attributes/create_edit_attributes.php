<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;
require_once(get_stylesheet_directory().'/templates/ajax/attributes/reload_price_sp_by_cate_id.php');
function create_attribute($id,$json_data,$thumnail,$title,$price,$price_ss,$tag){
    $data = array(
        'json_data'=> $json_data,
        'thumnail'=> $thumnail,
        'title'=> $title,
        'price'=> $price,
        'price_ss'=> $price_ss,
        'tag'=> $tag,
    );
    global $wpdb;
    $table = $wpdb->prefix . 'shopseo_attributes';
    $rs=$wpdb->insert(
        $table,
        $data
    );
    $object = new stdClass();
    if($rs){
        $object->status=true;
        $object->id=$rs;
    }else{
        $object->status=false;
    }
    send($object);
}

function update_attribute($id,$json_data,$thumnail,$title,$price,$price_ss,$tag){
    $data = array(
        'json_data'=> $json_data,
        'thumnail'=> $thumnail,
        'title'=> $title,
        'price'=> $price,
        'price_ss'=> $price_ss,
        'tag'=> $tag,
    );
    global $wpdb;
    $table = $wpdb->prefix . 'shopseo_attributes';
    $rs=$wpdb->update(
        $table,
        $data,
        array('id' => $id)
    );
    $object = new stdClass();
    if($rs){
        update_price_all_in_cate($id);
        $object->status=true;
        $object->id=$id;
    }else{
        $object->status=false;
    }
    send($object);
}

if(is_user_logged_in()){
    if($_POST){
        $id=(int)$_POST['id']; // id =-1 >create || update
        $json_data=stripslashes($_POST['json_data']);     
        $thumnail=$_POST['thumnail'];     
        $title=$_POST['title'];     
        $price=$_POST['price'];     
        $price_ss=$_POST['price_ss'];     
        $tag=$_POST['tag'];    
        if($id==-1){// create new post
            create_attribute($id,$json_data,$thumnail,$title,$price,$price_ss,$tag);
        }else{
            update_attribute($id,$json_data,$thumnail,$title,$price,$price_ss,$tag);
        }

    }else{
        $object = new stdClass();
        send($object);
    }
}











?>