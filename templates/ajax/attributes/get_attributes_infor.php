<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

function get_attribute_by_id($id){// search phone or email ~~ '' => get all
   global $wpdb;
   $table_prefix=$wpdb->prefix .'shopseo_attributes';
  $sql = $wpdb->prepare( "SELECT id,json_data FROM $table_prefix WHERE id= %d",$id);
   $results = $wpdb->get_results( $sql , OBJECT );
   $json_data=json_decode($results[0]->json_data); 
   $json_data->id=$id;
   send($json_data);
}

if(is_user_logged_in()){
  if(isset($_GET['id'])){
    $id=(int)$_GET['id'];
    get_attribute_by_id($id);
  }
}
 ?>