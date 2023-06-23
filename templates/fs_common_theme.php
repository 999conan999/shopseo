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
    $json_data->thumnail==json_decode($results[0]->thumnail);
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
    // get comments
    $comments=get_comments_shopseo($id,0);
    $json_data->comments=$comments;
    return $json_data;
}
function get_comments_shopseo($id_post,$page){//  
    global $wpdb;
    $table_prefix=$wpdb->prefix .'shopseo_comments';
    $quantity=8;
    $offset=abs((int)stripslashes(strip_tags($page))*$quantity);
    $sql = $wpdb->prepare( "SELECT rs_comment,rs_user_name,rs_rep,json_img FROM $table_prefix WHERE id_post = %d AND  rs_status ='publish' ORDER BY id DESC  LIMIT %d OFFSET %d ",$id_post,$quantity,$offset);
    $results = $wpdb->get_results( $sql , OBJECT );
  $rs=array();
  $home_url=get_home_url();
  $home_name=str_replace('https://', '', $home_url);
  $home_name=str_replace('http://', '', $home_name);
    $html='';
  foreach($results as $x){
    $json_img=array();
    if($x->json_img!=NULL&&$x->json_img!=""){
         $json_img=json_decode($x->json_img);
    }
    $html_img='';
    foreach($json_img as $img){
        $pos = strpos($img->url, '.gif');
        if($pos) $img->url300= $home_url.'/wp-content/themes/shopseo/templates/src/media/video-thumnail.jpg';
         $html_img.='<div class="dev-3 pdr-3"> <img class="img-com lazyload" src="'.$img->url300.'" data-src="'.$img->url.'" width="100%"></div>';
    }
    $html.='<div class="w1"> <b>'.$x->rs_user_name.'</b> &nbsp;&nbsp;<span class="icon-cartx comx"></span> <i>Đã mua tại'.$home_name.'</i><p>'.$x->rs_comment.'</p>';
    if( $html_img!=''){
         $html.='<div class="w-img-com row">'.$html_img.'</div>';
    }
    if($x->rs_rep!=''){
         $html.='<span class="rep">Trả lời</span><div class="w1 w2"> <b>'.$home_name.'</b><p>Cảm ơn đã sử dụng dịch vụ của chúng tôi!</p></div>';
    }
    $html.='</div>';
  }
  $obj = new stdClass();
  $obj->html=$html;
  $obj->status=count($results)==$quantity?true:false;
  return($obj);
}
// get time and data cache
function get_cache_by_table_name($table_name,$id_post){
    global $wpdb;
    $table_prefix=$wpdb->prefix .$table_name;
         $sql = $wpdb->prepare( "SELECT time_cache,data_cache FROM $table_prefix WHERE id_post= %d ORDER BY id DESC ",$id_post);
    $results = $wpdb->get_results( $sql , OBJECT );
    $o = new stdClass();
    if(count($results)>0){
        if($results[0]->time_cache==""||$results[0]->time_cache==NULL||$results[0]->data_cache==""||$results[0]->data_cache==NULL){
            $o->time_cache=0;
            $o->data_cache='';
        }else{
            $o->time_cache=(int)($results[0]->time_cache);
            $o->data_cache=($results[0]->data_cache);
        }
    }else{
        $o->time_cache=0;
        $o->data_cache='';
    }
    return $o;
}
// set cache
function set_cache($table_name,$id,$time_now,$html_content){
    $data = array(
        'time_cache'=> $time_now,
        'data_cache'=> $html_content,
    );
    global $wpdb;
    $table = $wpdb->prefix . $table_name;
    $rs=$wpdb->update(
        $table,
        $data,
        array('id_post' => $id)
    );
}
?>