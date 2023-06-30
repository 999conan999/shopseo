<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;
require_once(get_stylesheet_directory().'/templates/ajax/xml/main.php');
 
function update_shopseo($id,$value){
    $my_post = array(
        'ID'            =>$id,
        'post_status'   => $value,
    );
    $post_ID=wp_update_post( $my_post );
    $data = array(
        // 'id_post'=> $id,
        // 'thumnail'=> $thumnail,
        // 'title'=> $title,
        // 'price'=> $price,
        'post_status'=> $value,
        // 'key_word'=> $key_word,
        // 'related_keyword'=> $related_keyword,
        // 'short_des'=> $short_des,
        // 'is_best_seller'=> $is_best_seller,
        // 'post_type'=> $type,
        // 'post_status'=> $status,
        // 'json_data'=> $json_data,
        // 'id_category'=> $category_id,
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
    }else{
        $object->status=false;
    }
    send($object);
}


// if(is_user_logged_in()){
    if($_POST){
        $id=(int)$_POST['id']; // id =-1 >create || update
        $value=$_POST['value'];   
        update_shopseo($id,$value);
    } 
// }











?>