<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

 

function search_phone($phone){// search phone or email ~~ '' => get all
    global $wpdb;
    $table_prefix=$wpdb->prefix .'shopseo_orders';
    $quantity=10;
    $offset=0;
    $sql = $wpdb->prepare( "SELECT id,name_buyer,phone,address_1,note,order_status,data_carts,date_create FROM $table_prefix WHERE phone LIKE %s ORDER BY id DESC LIMIT %d OFFSET %d ",'%'.$phone.'%',$quantity,$offset);
    $results = $wpdb->get_results( $sql , OBJECT );
    $rs=array();
    foreach($results as $x){
         $object = new stdClass();
         $object->id=$x->id;
         $object->name_buyer=$x->name_buyer;
         $object->phone=$x->phone;
         $object->address_1=$x->address_1;
         $object->note=$x->note;
         $object->order_status=$x->order_status;
         $object->date_create=$x->date_create;
         if($x->data_carts!=NULL&&$x->data_carts!=""){
              $object->data_carts=json_decode($x->data_carts);
         }else{
              $object->data_carts=array();
         }
         array_push($rs,$object);
    }
  send($rs);
}

if(is_user_logged_in()){
    if($_POST){
        $phone=$_POST['phone'];   
        search_phone($phone);
    } 
}











?>