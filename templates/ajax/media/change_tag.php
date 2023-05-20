<?php 
    $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
    require_once( $parse_uri[0] . 'wp-load.php' );

    function change_tag_by_id($id,$tag){
        global $wpdb;
        $table = $wpdb->prefix . 'shopseo_imgs';
        $wpdb->update(
            $table,
            array('tag' => $tag),
            array('id' => $id)
          );
    }
 
    // if(is_user_logged_in()){
        if($_POST){
            $id=(int)$_POST['id'];
            $tag=$_POST['tag'];
            $object = new stdClass();
            change_tag_by_id($id,$tag);
            $object->id=true;
            send($object);
        }
    // }