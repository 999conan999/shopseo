<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

function get_posts_shopseo($id_cate){// search phone or email ~~ '' => get all
   global $wpdb;
   $table_prefix=$wpdb->prefix .'shopseo_posts';
        $sql = $wpdb->prepare( "SELECT id,id_post,thumnail,title,key_word,quantity_sold,post_type,related_keyword,post_status,is_best_seller,price FROM $table_prefix WHERE id_category = %d ORDER BY id DESC ",$id_cate);
   $results = $wpdb->get_results( $sql , OBJECT );
   $rs=array();
   foreach($results as $x){
     $object = new stdClass();
     $object->id=$x->id_post;
     $object->related_keyword=json_decode($x->related_keyword);
     $object->thumnail=json_decode($x->thumnail);
     $object->quantity_sold=$x->quantity_sold;
     $object->title=$x->title;
     $object->price=$x->price;
     $object->key_word=$x->key_word;
     $object->type=$x->post_type;
     $object->status=$x->post_status;
     $object->url=get_permalink($x->id_post);
     $object->is_best_seller=$x->is_best_seller;
     array_push($rs,$object);
   }
   send($rs);
}

// if(is_user_logged_in()){
     if(isset($_GET['id'])){
          $id_cate=(int)$_GET['id'];
          get_posts_shopseo($id_cate);
     }
// }
 ?>