<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

function get_post_infor($id){// search phone or email ~~ '' => get all
   global $wpdb;
   $table_prefix=$wpdb->prefix .'shopseo_posts';
        $sql = $wpdb->prepare( "SELECT quantity_sold,related_keyword,post_status,is_best_seller,json_data FROM $table_prefix WHERE id_post = %d",$id);
   $results = $wpdb->get_results( $sql , OBJECT );

   $json_data=json_decode($results[0]->json_data); 
   $json_data->id=$id;
   $json_data->quantity_sold=$results[0]->quantity_sold;
   $json_data->status=$results[0]->post_status;
   $json_data->is_best_seller=$results[0]->is_best_seller;
   $json_data->related_keyword=json_decode($results[0]->related_keyword);
   send($json_data);
}

// if(is_user_logged_in()){
     if(isset($_GET['id'])){
          $id=(int)$_GET['id'];
          get_post_infor($id);
     }
// }
 ?>