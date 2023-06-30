<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;
require_once(get_stylesheet_directory().'/templates/ajax/xml/main.php');
function create_post($id,$json_data,$thumnail,$title,$price,$quantity_sold,$key_word,$related_keyword,$status,$is_best_seller,$type,$short_des,$category_id){
    $thumnail=stripslashes($thumnail);
    $related_keyword=stripslashes($related_keyword);
    $json_data=stripslashes($json_data);
    if($type=='page'){
        $my_post = array(
            'post_title'    => $title,
            'post_content'  => '',
            'post_status'   => $status,
            // 'post_category' => array($category_id),
            'post_type'      => 'page',
        );
    }else{
        $my_post = array(
            'post_title'    => $title,
            'post_content'  => '',
            'post_status'   => $status,
            'post_category' => array($category_id),
        );
    }
    $post_ID=wp_insert_post( $my_post );
    $data = array(
        'id_post'=> $post_ID,
        'thumnail'=> $thumnail,
        'title'=> $title,
        'price'=> $price,
        'quantity_sold'=> $quantity_sold,
        'key_word'=> $key_word,
        'related_keyword'=> $related_keyword,
        'short_des'=> $short_des,
        'is_best_seller'=> $is_best_seller,
        'post_type'=> $type,
        'post_status'=> $status,
        'json_data'=> $json_data,
        'id_category'=> $category_id,
        //new shoping
        'shoping_type'=>'',
        'instock'=>'false',
        'shoping_on_off'=>'off',
    );
    global $wpdb;
    $table = $wpdb->prefix . 'shopseo_posts';
    $rs=$wpdb->insert(
        $table,
        $data
    );
    $object = new stdClass();

    if($rs){
        $object->status=true;
        $object->id=$post_ID;
        $object->url=get_permalink($post_ID);
    }else{
        $object->status=false;
    }
    send($object);
}
function update_post($id,$json_data,$thumnail,$title,$price,$quantity_sold,$key_word,$related_keyword,$status,$is_best_seller,$type,$short_des,$category_id){
    $thumnail=stripslashes($thumnail);
    $related_keyword=stripslashes($related_keyword);
    $json_data=stripslashes($json_data);
    if($type=='page'){
        $my_post = array(
            'ID'            =>$id,
            'post_title'    => $title,
            'post_status'   => $status,
            // 'post_category' => array($category_id),
            'post_type'      => 'page',
        );
    }else{
        $my_post = array(
            'ID'            =>$id,
            'post_title'    => $title,
            'post_status'   => $status,
            'post_category' => array($category_id),
        );
    }
    $post_ID=wp_update_post( $my_post );
    $data = array(
        'id_post'=> $id,
        'thumnail'=> $thumnail,
        'title'=> $title,
        'price'=> $price,
        'quantity_sold'=> $quantity_sold,
        'key_word'=> $key_word,
        'related_keyword'=> $related_keyword,
        'short_des'=> $short_des,
        'is_best_seller'=> $is_best_seller,
        'post_type'=> $type,
        'post_status'=> $status,
        'json_data'=> $json_data,
        'id_category'=> $category_id,
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
        main($id);
        $object->status=true;
        $object->id=$post_ID;
        $object->url=get_permalink($post_ID);
    }else{
        $object->status=false;
    }
    send($object);
}


// if(is_user_logged_in()){
    if($_POST){
        $id=(int)$_POST['id']; // id =-1 >create || update
        $category_id=(int)$_POST['category_id'];
        $json_data=$_POST['json_data'];     
        $thumnail=$_POST['thumnail'];     
        $title=$_POST['title'];     
        $price=$_POST['price'];     
        $quantity_sold=$_POST['quantity_sold'];     
        $key_word=$_POST['key_word'];     
        $related_keyword=$_POST['related_keyword'];     
        $status=$_POST['status'];     
        $is_best_seller=$_POST['is_best_seller'];     
        $type=$_POST['type'];     
        $short_des=$_POST['short_des'];     
        if($id==-1){// create new post
            create_post($id,$json_data,$thumnail,$title,$price,$quantity_sold,$key_word,$related_keyword,$status,$is_best_seller,$type,$short_des,$category_id);
        }else{
            update_post($id,$json_data,$thumnail,$title,$price,$quantity_sold,$key_word,$related_keyword,$status,$is_best_seller,$type,$short_des,$category_id);
        }

    }else{
        $object = new stdClass();
        send($object);
    }
// }











?>