<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

//
function get_category_detail($id){
     global $wpdb;
     //
     $table_prefix=$wpdb->prefix .'shopseo_terms';
     $sql = $wpdb->prepare( "SELECT id_term,json_data FROM $table_prefix WHERE id_term = %d  ORDER BY id_term DESC",$id);
     $results = $wpdb->get_results( $sql , OBJECT );
     $obj= new stdClass();
     if(count($results)==0){
          $cat = get_category( $id );
          $obj->title=$cat->name;
          send($obj);
     }else{
          $o=json_decode($results[0]->json_data);
          $o->id=$id;
          send($o);
     }
     // $rs=array();
     // foreach($results as $x){
     //      $obj= new stdClass();
     //      $ar_1[$x["id_term"]]=$x["thumnail"];
     // }
//      if (isset($x[152])) {
// var_dump($ar_1[152]);
//      }
     //
     // $table_prefix=$wpdb->prefix .'term_taxonomy';
     // $sql = $wpdb->prepare( "SELECT term_id FROM $table_prefix WHERE taxonomy ='category' ORDER BY term_id ASC");
     // $results = $wpdb->get_results( $sql , OBJECT );
     // $rs=array();
     // foreach($results as $x){
     //      $id=$x->term_id;
     //      $cat = get_category( $id );
     //      $id=$x->term_id;
     //      $obj= new stdClass();
     //      $obj->id=$id;
     //      $obj->url=get_category_link($id);
     //      $obj->title=$cat->name;
     //      if (isset($ar_1[$id])) {
     //           $obj->thumnail=json_decode($ar_1[$id]);
     //      } else{
     //           $o= new stdClass();
     //           $o->url="";
     //           $o->url150="";
     //           $o->url300="";
     //           $obj->thumnail=$o;
     //      }
     //      array_push($rs,$obj);
     // }
          // send($rs);
     }
 if(is_user_logged_in()==false){
     // if(isset($_GET['id'])){
          $id=(int)$_GET['id'];
          get_category_detail($id);
     // }
 }
 
 ?>