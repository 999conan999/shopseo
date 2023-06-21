<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

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
        $object->status=true;
    }else{
        $object->status=false;
    }
    send($object);
}
// function update_post($id,$json_data,$thumnail,$title,$price,$quantity_sold,$key_word,$related_keyword,$status,$is_best_seller,$type,$short_des,$category_id){
//     $thumnail=stripslashes($thumnail);
//     $related_keyword=stripslashes($related_keyword);
//     $json_data=stripslashes($json_data);
//     $my_post = array(
//         'ID'            =>$id,
//         'post_title'    => $title,
//         'post_status'   => $status,
//         'post_category' => array($category_id),
//     );
//     $post_ID=wp_update_post( $my_post );
//     $data = array(
//         'id_post'=> $id,
//         'thumnail'=> $thumnail,
//         'title'=> $title,
//         'price'=> $price,
//         'quantity_sold'=> $quantity_sold,
//         'key_word'=> $key_word,
//         'related_keyword'=> $related_keyword,
//         'short_des'=> $short_des,
//         'is_best_seller'=> $is_best_seller,
//         'post_type'=> $type,
//         'post_status'=> $status,
//         'json_data'=> $json_data,
//         'id_category'=> $category_id,
//     );
//     global $wpdb;
//     $table = $wpdb->prefix . 'shopseo_posts';
//     $rs=$wpdb->update(
//         $table,
//         $data,
//         array('id_post' => $id)
//     );
//     $object = new stdClass();
//     if($rs){
//         $object->status=true;
//         $object->id=$post_ID;
//         $object->url=get_permalink($post_ID);
//     }else{
//         $object->status=false;
//     }
//     send($object);
// }


// if(is_user_logged_in()){
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
// }











?>