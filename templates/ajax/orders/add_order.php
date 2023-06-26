<?php 
    $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
    require_once( $parse_uri[0] . 'wp-load.php' );
 
    function add_order_shopseo($name_buyer,$phone,$address_1,$note,$data_carts){
        $time_now=time();
        $data = array(
            'name_buyer'=> $name_buyer,
            'phone'=> $phone,
            'address_1'=> $address_1,
            'note'=> $note,
            'data_carts'=> $data_carts,
            'date_create'=> $time_now,
            'order_status'=> 'check',
        );
        global $wpdb;
        $table = $wpdb->prefix . 'shopseo_orders';
        $rs=$wpdb->insert(
            $table,
            $data
        );
        $object = new stdClass();
        if($rs){
            $object->status=true;
        }else{
            $object->status=false;
        }
        send($object);
    }
    if(isset($_POST['phone'])){
        $name_buyer=stripslashes(strip_tags($_POST['name_buyer']));
        $phone=stripslashes(strip_tags($_POST['phone']));
        $address_1=stripslashes(strip_tags($_POST['address_1']));
        $note=stripslashes(strip_tags($_POST['note']));
        $data_carts=stripslashes(strip_tags($_POST['data_carts']));
        add_order_shopseo($name_buyer,$phone,$address_1,$note,$data_carts);
    }
?>