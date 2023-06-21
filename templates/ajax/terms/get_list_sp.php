<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

function get_posts_shopseo($id_cate){// search phone or email ~~ '' => get all
   global $wpdb;
   $table_prefix=$wpdb->prefix .'shopseo_posts';
        $sql = $wpdb->prepare( "SELECT id_post,thumnail,title,price FROM $table_prefix WHERE id_category = %d ORDER BY id DESC ",$id_cate);
   $results = $wpdb->get_results( $sql , ARRAY_A );
   $list_sp=[];
   foreach($results as $x){
     $x['img']=json_decode($x['thumnail']);
     $list_sp[$x['id_post']]=$x;
   }
   send($list_sp);
}

// if(is_user_logged_in()){
     if(isset($_GET['id'])){
          $id_cate=(int)$_GET['id'];
          get_posts_shopseo($id_cate);
     }
// }
 ?>