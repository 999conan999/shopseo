<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

function get_attributes($id){// search phone or email ~~ '' => get all
   global $wpdb;
   $table_prefix=$wpdb->prefix .'shopseo_attributes';
        $sql = $wpdb->prepare( "SELECT id,title,json_data  FROM $table_prefix WHERE tag = %d ORDER BY id DESC ",$id);
   $results = $wpdb->get_results( $sql , OBJECT );
   $rs=array();
   foreach($results as $x){
     $object = new stdClass();
     $object->value=$x->id;
     $object->text=$x->title;
     $object->data=$x->json_data;
     array_push($rs,$object);
   }
   send($rs);
}

 
if(is_user_logged_in()){
  if(isset($_GET['id'])){
    $id=(int)$_GET['id'];
    get_attributes($id);
  }
}
 ?>