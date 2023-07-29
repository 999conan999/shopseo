
<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;
//
function get_all_categorys(){
    global $wpdb;
    $table_prefix=$wpdb->prefix .'term_taxonomy';
    $sql = $wpdb->prepare( "SELECT term_id FROM $table_prefix WHERE taxonomy ='category' ORDER BY term_id DESC");
    $results = $wpdb->get_results( $sql , OBJECT );
    $rs=array();
    foreach($results as $x){
        $id=$x->term_id;
       $cat = get_category( $id );
       $obj= new stdClass();
       $obj->text=$cat->name;
       $obj->value=$x->term_id;
    //    $obj->url=get_category_link($id);
       array_push($rs,$obj);
    }
    send($rs);
}
if(is_user_logged_in()==false){
    get_all_categorys();
}
?>