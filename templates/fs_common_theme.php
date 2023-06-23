<?php
function get_common(){
    $value=get_option('shopseo_setup');
    if($value!=false){
        $data=json_decode($value);
        return $data;
    }else{
        return new stdClass();
    }
}
function get_post_infor($id){
    global $wpdb;
    $table_prefix=$wpdb->prefix .'shopseo_posts';
         $sql = $wpdb->prepare( "SELECT quantity_sold,thumnail,related_keyword,id_category,is_best_seller,json_data FROM $table_prefix WHERE id_post = %d",$id);
    $results = $wpdb->get_results( $sql , OBJECT );
 
    $json_data=json_decode($results[0]->json_data); 
    $json_data->id=$id;
    $json_data->quantity_sold=$results[0]->quantity_sold;
    $json_data->thumnail==json_decode($x->thumnail);
    $json_data->is_best_seller=$results[0]->is_best_seller;
    $json_data->related_keyword=json_decode($results[0]->related_keyword);
    //
    $cat = get_category($results[0]->id_category);
    $obj= new stdClass();
    $obj->id=$id;
    $obj->url=get_category_link($results[0]->id_category);
    $obj->title=$cat->name;
    $json_data->cate=$obj;
    $table_prefix=$wpdb->prefix .'shopseo_terms';
    $sql = $wpdb->prepare( "SELECT related_links FROM $table_prefix WHERE id_term = %d",$results[0]->id_category);
    $results = $wpdb->get_results( $sql , OBJECT );
    if(count($results)>0){
        $json_data->related_links=json_decode($results[0]->related_links);
    } 
    //
    if($json_data->type!="bv"){
        $table_prefix=$wpdb->prefix .'shopseo_attributes';
        $sql = $wpdb->prepare( "SELECT json_data FROM $table_prefix WHERE id = %d",$json_data->attribute_id);
        $results = $wpdb->get_results( $sql , OBJECT );
        if(count($results)>0){
            $json_data->att=json_decode($results[0]->json_data);
        } 
        $results=get_option('shopseo_notify');
        if($results!=false){
            $json_data->notify=json_decode($results);
        }
    }
    return $json_data;
}
 
?>