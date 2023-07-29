<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

function get_comments_shopseo($id_post){// search phone or email ~~ '' => get all
     global $wpdb;
     $table_prefix=$wpdb->prefix .'shopseo_comments';
     $quantity=20;
     $offset=0;
if($id_post==-1){
     $sql = $wpdb->prepare( "SELECT id,id_post,rs_comment,rs_user_name,rs_phone,rs_status,rs_rep,json_img FROM $table_prefix WHERE rs_status ='private' ORDER BY id DESC LIMIT %d OFFSET %d ",$quantity,$offset);
   $results = $wpdb->get_results( $sql , OBJECT );
}else{
     $sql = $wpdb->prepare( "SELECT id,id_post,rs_comment,rs_user_name,rs_phone,rs_status,rs_rep,json_img FROM $table_prefix WHERE id_post = %d ORDER BY id DESC  LIMIT %d OFFSET %d ",$id_post,$quantity,$offset);
     $results = $wpdb->get_results( $sql , OBJECT );
}
   $rs=array();
   foreach($results as $x){
     $object = new stdClass();
     $object->id_post=$x->id_post;
     $object->id=$x->id;
     $object->rs_comment=$x->rs_comment;
     $object->rs_user_name=$x->rs_user_name;
     $object->rs_phone=$x->rs_phone;
     $object->rs_rep=$x->rs_rep;
     $object->rs_status=$x->rs_status;
     if($x->json_img!=NULL&&$x->json_img!=""){
          $object->json_img=json_decode($x->json_img);
     }else{
          $object->json_img=array();
     }
     array_push($rs,$object);
   }
   send($rs);
}

// if(is_user_logged_in()==false){
     if(isset($_GET['id_post'])){
          $id_post=(int)$_GET['id_post'];
          get_comments_shopseo($id_post);
     }
// }
 ?>