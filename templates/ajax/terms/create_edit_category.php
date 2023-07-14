<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;
if ( ! function_exists( 'wp_insert_category' ) ) require_once(ABSPATH . 'wp-admin/includes/taxonomy.php'); 
function create_term($id,$title,$thumnail,$price_ss,$json_data,$related_links,$short_des){
    $my_category= array(
        'cat_name'    => $title,
        // 'category_description'  => $contentS,
        // 'category_parent'   => $parentIdN
    );
    $category_ID=wp_insert_category($my_category);
    //
    $data = array(
        'id_term'=> $category_ID,
        'thumnail'=> $thumnail,
        'title'=> $title,
        'short_des'=> $short_des,
        'price_ss'=> $price_ss,
        'related_links'=> $related_links,
        'json_data'=> $json_data,
        'data_cache'=> '',
        'time_cache'=> '',
    );
    global $wpdb;
    $table = $wpdb->prefix . 'shopseo_terms';
    $rs=$wpdb->insert(
        $table,
        $data
    );
    $object = new stdClass();

    if($rs){
        $object->status=true;
        $object->id=$category_ID;
        $object->url=get_category_link($category_ID);
    }else{
        $object->status=false;
    }
    send($object);
}
 
function update_term($id,$title,$thumnail,$price_ss,$json_data,$related_links,$short_des,$omg){
    // $my_category= array(
    //     'cat_name'    => $title,
    //     'cat_ID'    => $id,
    // );
    // $category_ID=wp_insert_category($my_category);
    
    if($omg=='true'){
        $data = array(
            'id_term'=> $id,
            'thumnail'=> $thumnail,
            'title'=> $title,
            'short_des'=> $short_des,
            'price_ss'=> $price_ss,
            'related_links'=> $related_links,
            'json_data'=> $json_data,
            'data_cache'=> '',
            'time_cache'=> '',
        );
        global $wpdb;
        $table = $wpdb->prefix . 'shopseo_terms';
        $rs=$wpdb->insert(
            $table,
            $data
        );
    }else{
        $data = array(
            'id_term'=> $id,
            'thumnail'=> $thumnail,
            'title'=> $title,
            'short_des'=> $short_des,
            'price_ss'=> $price_ss,
            'related_links'=> $related_links,
            'json_data'=> $json_data,
            'data_cache'=> '',
            'time_cache'=> '',
        );
        global $wpdb;
        $table = $wpdb->prefix . 'shopseo_terms';
        $rs=$wpdb->update(
            $table,
            $data,
            array('id_term' => $id)
        );
    }
        $object = new stdClass();

        if($rs){
            $defaultCategoryId = get_option('default_category');
            if($defaultCategoryId==$id){
                $object->defaultCategory=true;
           }else{
                $object->defaultCategory=false;
           }
            $object->status=true;
            $object->id=$category_ID;
            $object->url=get_category_link($category_ID);
        }else{
            $object->status=false;
        }
    send($object);
}

if(is_user_logged_in()){
    if($_POST){
        $id=(int)$_POST['id']; // id =-1 >create || update
        $json_data=stripslashes($_POST['json_data']);     
        $thumnail=stripslashes($_POST['thumnail']);     
        $related_links=stripslashes($_POST['related_links']);     
        $omg=($_POST['omg']);     
        $title=$_POST['title'];     
        $price_ss=$_POST['price_ss'];     
        $short_des=$_POST['short_des']; 
        if($id==-1){// create new post
            create_term($id,$title,$thumnail,$price_ss,$json_data,$related_links,$short_des);
        }else{
            update_term($id,$title,$thumnail,$price_ss,$json_data,$related_links,$short_des,$omg);
        }

    }else{
        $object = new stdClass();
        send($object);
    }
}











?>