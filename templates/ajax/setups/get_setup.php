<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;


if(is_user_logged_in()==false){

    if($_POST){
        if(isset($_POST['name'])){
            $name_optipon= $_POST['name'];
            $value=get_option($name_optipon);
            if($value!=false){
                $data=json_decode($value);
                send($data);
            }
        }
    }
}

?>