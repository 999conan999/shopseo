<?php 
    $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
    require_once( $parse_uri[0] . 'wp-load.php' );

    function delete_img_clone_by_id_database($id){
        global $wpdb;
        $table = $wpdb->prefix . 'shopseo_imgs';
        $delete = $wpdb->delete(
        $table,
        array( 'id' => $id ),
        array( '%d' )
        ); 
    }
    function delete_file_clone_folder($id){
        global $wpdb;
        $table_prefix=$wpdb->prefix .'shopseo_imgs';
             $sql = $wpdb->prepare( "SELECT id,url300,url150,url FROM $table_prefix WHERE id=%d ",$id);
        $results = $wpdb->get_results( $sql , OBJECT );
        if(count($results)==1){
            $uploads = wp_get_upload_dir();
            $url=$results[0]->url;
            $file = str_replace("wp-content/uploads",$uploads['basedir'],$url);
            wp_delete_file($file);
            $url=$results[0]->url300;
            $file = str_replace("wp-content/uploads",$uploads['basedir'],$url);
            wp_delete_file($file);
            $url=$results[0]->url150;
            $file = str_replace("wp-content/uploads",$uploads['basedir'],$url);
            wp_delete_file($file);
            return true;
        }
        return false;
        
    }
    // if(is_user_logged_in()){
        if($_POST){
            $id=(int)$_POST['id'];
            $object = new stdClass();
            $object->status=false;
            $a=delete_file_clone_folder($id);
            if($a){
             delete_img_clone_by_id_database($id);
             $object->status=true;
             $object->id=$id;
            }
            send($object);
        }
    // }