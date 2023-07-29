<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

function get_posts_shopseo(){// search phone or email ~~ '' => get all
   global $wpdb;
   $table_prefix=$wpdb->prefix .'shopseo_posts';
        $sql = $wpdb->prepare( "SELECT id,id_post,thumnail,title,key_word,post_type,post_status FROM $table_prefix WHERE post_type = %s ORDER BY id DESC ",'page');
   $results = $wpdb->get_results( $sql , OBJECT );
   $rs=array();
   foreach($results as $x){
     $object = new stdClass();
     $object->id=$x->id_post;
     $object->thumnail=json_decode($x->thumnail);
     $object->title=$x->title;
     $object->key_word=$x->key_word;
     $object->type=$x->post_type;
     $object->status=$x->post_status;
     $object->url=get_permalink($x->id_post);;
     array_push($rs,$object);
   }
   send($rs);
}

if(is_user_logged_in()==false){
          get_posts_shopseo();
}
 ?>