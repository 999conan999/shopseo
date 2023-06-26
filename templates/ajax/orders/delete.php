<?php 
    $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
    require_once( $parse_uri[0] . 'wp-load.php' );

    function delete_comment_by_id($id){
        global $wpdb;
        $table = $wpdb->prefix . 'shopseo_comments';
        $rs = $wpdb->delete(
        $table,
        array( 'id' => $id ),
        array( '%d' )
        ); 
        $object = new stdClass();
        $object->status=$rs;
        send($object);
    }
 
    // if(is_user_logged_in()){
        if($_POST){
            $id=(int)$_POST['id'];
             delete_comment_by_id($id);
        }
    // }