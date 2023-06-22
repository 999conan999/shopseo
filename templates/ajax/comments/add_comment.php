<?php 
    $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
    require_once( $parse_uri[0] . 'wp-load.php' );
 
    function  add_comment_shopseo($id,$rs_comment,$rs_user_name,$rs_phone){
        $data = array(
            'id_post'=> $id,
            'rs_comment'=> $rs_comment,
            'rs_user_name'=> $rs_user_name,
            'rs_phone'=> $rs_phone,
            'rs_status'=> 'private',
        );
        global $wpdb;
        $table = $wpdb->prefix . 'shopseo_comments';
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
    if(isset($_POST['id'])){
        $id=stripslashes(strip_tags($_POST['id']));
        $rs_comment=stripslashes(strip_tags($_POST['rs_comment']));
        $rs_user_name=stripslashes(strip_tags($_POST['rs_user_name']));
        $rs_phone=stripslashes(strip_tags($_POST['rs_phone']));
        add_comment_shopseo($id,$rs_comment,$rs_user_name,$rs_phone);
    }
?>