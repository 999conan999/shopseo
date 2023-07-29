<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;
// function delete_category($id){
//    return wp_delete_category($id);
// }

if(is_user_logged_in()==false){
    if($_POST){
         $object = new stdClass();
        $defaultCategoryId = get_option('default_category');
        $id=(int)$_POST['id'];
        if($defaultCategoryId!=$id){
            $rs=wp_delete_category($id);// xoa category
            // cap nhat lai id cac sp
            if($rs){
                global $wpdb;
                $table_name = $wpdb->prefix . 'shopseo_posts';
                $sql = "UPDATE $table_name 
                        SET id_category = $defaultCategoryId 
                        WHERE id_category = $id";
                $wpdb->query($sql);
                $object->status=true;
            }else{
                $object->status=false;
            }
            
        }else{
            $object->status=false;
        }
        send($object);
    } 
}
?>