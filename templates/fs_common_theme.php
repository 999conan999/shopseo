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
function get_404_cate(){
    global $wpdb;
    $table_prefix=$wpdb->prefix .'shopseo_terms';
    $sql = $wpdb->prepare( "SELECT id_term,thumnail,title FROM $table_prefix ORDER BY id_term DESC");
    $results = $wpdb->get_results( $sql , OBJECT );
    $arr=array();
    $i=0;
    $html_xu_huong='';
    foreach($results as $x){
        $i++;
        if($i<11){
            $url=get_category_link($x->id_term);
            $thumnail=json_decode($x->thumnail);
            $html_xu_huong.=' <div class="col-6 col-md-3 col-xl-2"><a class="refz" href="'.$url.'" title="'.$x->title.'"><img src="'.$thumnail->url150.'" width="64px" height="64px"><p>'.$x->title.'</p></a></div>';
            $obj= new stdClass();
            $obj->name=$x->title;
            $obj->url=$url;
            $obj->sp_html=get_sp_card($x->id_term,12,false);
            array_push($arr,$obj);
        }
        // 
    }
    return $html_xu_huong;
}
function get_home_infor($id){
    global $wpdb;
    $table_prefix=$wpdb->prefix .'shopseo_posts';
         $sql = $wpdb->prepare( "SELECT json_data FROM $table_prefix WHERE id_post = %d",$id);
    $results = $wpdb->get_results( $sql , OBJECT );
    if(count($results)>0){
        $json_data=json_decode($results[0]->json_data); 
        $json_data->id=$id;
        //
        $json_data->best_saller=get_sp_card($id,12,true);
        //
        $table_prefix=$wpdb->prefix .'shopseo_terms';
        $sql = $wpdb->prepare( "SELECT id_term,thumnail,title FROM $table_prefix ORDER BY id_term DESC");
        $results = $wpdb->get_results( $sql , OBJECT );
        $arr=array();
        $i=0;
        $html_xu_huong='';
        foreach($results as $x){
            $i++;
            if($i<11){
                $url=get_category_link($x->id_term);
                $thumnail=json_decode($x->thumnail);
                $html_xu_huong.=' <div class="col-6 col-md-3 col-xl-2"><a class="refz" href="'.$url.'" title="'.$x->title.'"><img src="'.$thumnail->url150.'" width="64px" height="64px"><p>'.$x->title.'</p></a></div>';
                $obj= new stdClass();
                $obj->name=$x->title;
                $obj->url=$url;
                $obj->sp_html=get_sp_card($x->id_term,12,false);
                array_push($arr,$obj);
            }
            // 
        }
        $json_data->html_xu_huong=$html_xu_huong;
        $json_data->category_data_list=$arr;
        $json_data->new_post=get_new_post(12);
        //
        return $json_data;
    }else{
        die();
    }
}
function get_page_infor($id){
    global $wpdb;
    $table_prefix=$wpdb->prefix .'shopseo_posts';
         $sql = $wpdb->prepare( "SELECT json_data FROM $table_prefix WHERE id_post = %d",$id);
    $results = $wpdb->get_results( $sql , OBJECT );
    if(count($results)>0){
        $json_data=json_decode($results[0]->json_data); 
        $json_data->id=$id;
        return $json_data;
    }else{
        die();
    }
}
function get_cate_infor($id){
    global $wpdb;
    $table_prefix=$wpdb->prefix .'shopseo_terms';
    $sql = $wpdb->prepare( "SELECT json_data FROM $table_prefix WHERE id_term = %d",$id);
    $results = $wpdb->get_results( $sql , OBJECT );
    if(count($results)==0) die();
    $json_data=json_decode($results[0]->json_data); 
    $json_data->id=$id;
    $json_data->url=get_category_link($id);
    //
    global $wpdb;
    $table_prefix=$wpdb->prefix .'shopseo_posts';
         $sql = $wpdb->prepare( "SELECT id_post,thumnail,title,price,quantity_sold FROM $table_prefix WHERE id_category = %d AND post_status = 'publish' ORDER BY id DESC ",$id);
    $results = $wpdb->get_results( $sql , ARRAY_A );
    $list_sp=[];
    foreach($results as $x){
      $x['thumnail']=json_decode($x['thumnail']);
      $x['url']=get_permalink($x['id_post']);
      $list_sp[$x['id_post']]=$x;
    }
    $json_data->list_sp=($list_sp);
    //
    return $json_data;
}
function get_post_infor($id){
    global $wpdb;
    $table_prefix=$wpdb->prefix .'shopseo_posts';
         $sql = $wpdb->prepare( "SELECT quantity_sold,thumnail,related_keyword,id_category,is_best_seller,json_data FROM $table_prefix WHERE id_post = %d",$id);
    $results = $wpdb->get_results( $sql , OBJECT );
    if(count($results)==0) die();
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
    };
    // get id comment
    $comment_id=$json_data->comments_id==-1?$id:$json_data->comments_id;
    // get comments
    $comments=get_comments_shopseo($comment_id,0,$json_data->key_word);
    $json_data->comments=$comments;
    return $json_data;
}
function get_comments_shopseo($id_post,$page,$key_word=''){//  
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
         $html_img.='<div class="dev-3 pdr-3"> <img class="img-com lazyload" alt="'.$x->rs_user_name.' nhận xét về '.$key_word.'" title="'.$x->rs_user_name.' nhận xét về '.$key_word.'" src="'.$img->url300.'" data-src="'.$img->url.'" width="100%"></div>';
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
function get_cache_by_table_name($table_name,$id_post,$is_term=false){
    global $wpdb;
    $table_prefix=$wpdb->prefix .$table_name;
    if($is_term){
        $sql = $wpdb->prepare( "SELECT time_cache,data_cache FROM $table_prefix WHERE id_term= %d ORDER BY id DESC ",$id_post);
    }else{
        $sql = $wpdb->prepare( "SELECT time_cache,data_cache FROM $table_prefix WHERE id_post= %d ORDER BY id DESC ",$id_post);
    }
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
function set_cache($table_name,$id,$time_now,$html_content,$is_term=false){
    $data = array(
        'time_cache'=> $time_now,
        'data_cache'=> $html_content,
    );
    global $wpdb;
    $table = $wpdb->prefix . $table_name;
    if($is_term){
        $rs=$wpdb->update(
            $table,
            $data,
            array('id_term' => $id)
        );
    }else{
        $rs=$wpdb->update(
            $table,
            $data,
            array('id_post' => $id)
        );
    }

}
if (!function_exists('fixForUri')) {
    function fixForUri($strX, $options = array()) {
        $str=delete_all_between("(",")",$strX);
        // Make sure string is in UTF-8 and strip invalid UTF-8 characters
        $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
        
        $defaults = array(
            'delimiter' => '-',
            'limit' => null,
            'lowercase' => true,
            'replacements' => array(),
            'transliterate' => true,
        );
        
        // Merge options
        $options = array_merge($defaults, $options);
        
        // Lowercase
        if ($options['lowercase']) {
            $str = mb_strtolower($str, 'UTF-8');
        }
        
        $char_map = array(
            // Latin
            'á' => 'a', 'à' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a', 'ă' => 'a', 'ắ' => 'a', 'ằ' => 'a', 'ẳ' => 'a', 'ẵ' => 'a', 'ặ' => 'a', 'â' => 'a', 'ấ' => 'a', 'ầ' => 'a', 'ẩ' => 'a', 'ẫ' => 'a', 'ậ' => 'a', 'đ' => 'd', 'é' => 'e', 'è' => 'e', 'ẻ' => 'e', 'ẽ' => 'e', 'ẹ' => 'e', 'ê' => 'e', 'ế' => 'e', 'ề' => 'e', 'ể' => 'e', 'ễ' => 'e', 'ệ' => 'e', 'í' => 'i', 'ì' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i', 'ó' => 'o', 'ò' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o', 'ô' => 'o', 'ố' => 'o', 'ồ' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o', 'ơ' => 'o', 'ớ' => 'o', 'ờ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o', 'ú' => 'u', 'ù' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u', 'ư' => 'u', 'ứ' => 'u', 'ừ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u', 'ý' => 'y', 'ỳ' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y'
        );
        
        // Make custom replacements
        $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
        
        // Transliterate characters to ASCII
        if ($options['transliterate']) {
            $str = str_replace(array_keys($char_map), $char_map, $str);
        }
        
        // Replace non-alphanumeric characters with our delimiter
        $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
        
        // Remove duplicate delimiters
        $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
        
        // Truncate slug to max. characters
        $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
        
        // Remove delimiter from ends
        $str = trim($str, $options['delimiter']);
        
        return $str;
    }
}
function get_sp_card($id,$sl=12,$is_best_saller=false){
        // best saler
        global $wpdb;
        $table_prefix=$wpdb->prefix .'shopseo_posts';
        if($is_best_saller){
             $sql = $wpdb->prepare( "SELECT id_post,thumnail,title,quantity_sold,price FROM $table_prefix WHERE is_best_seller = 'true' AND post_status = 'publish' ORDER BY quantity_sold DESC LIMIT %d OFFSET 0",$sl);
        }else{
            $sql = $wpdb->prepare( "SELECT id_post,thumnail,title,quantity_sold,price FROM $table_prefix WHERE id_category = %d AND post_status = 'publish' ORDER BY id DESC LIMIT %d OFFSET 0",$id,$sl);
        }
        $results = $wpdb->get_results( $sql , OBJECT );
        $html='';
        foreach($results as $x){
          $thumnail = json_decode($x->thumnail);
          $price_ins=(int)$x->price;
            $html.='<li class="lza col-6 col-md-3 col-xl-2 lza-home"><a class="card-3 card-3-home" href="'.get_permalink($x->id_post).'" title="'.$x->title.'" ><div class="imgz-cart danhdev-product"><img class="zz lazyload" data-src="'.$thumnail->url.'" src="'.$thumnail->url300.'"></div><p style=" font-size: 12px;margin-bottom: 3px; ">'.$x->title.'</p><div style=" padding-left: 8px;padding-bottom: 10px; "><ins style=" font-size: 14px; " class="ins-cost costz">'.number_format($price_ins, 0, ".", ".").' đ</ins></div><div class="rating" style=" position: absolute; right: 0px; bottom: -3px; "><span class="star" style=" font-size: 12px; ">Đã bán: <b>'.$x->quantity_sold.'</b></span></div></a></li>';
        }
        return $html;
}
function get_new_post($sl){
    // best saler
    global $wpdb;
    $table_prefix=$wpdb->prefix .'shopseo_posts';
    $sql = $wpdb->prepare( "SELECT id_post,thumnail,title FROM $table_prefix WHERE post_status = 'publish' ORDER BY id DESC LIMIT %d OFFSET 0",$sl);
    $results = $wpdb->get_results( $sql , OBJECT );
    $html='';
    foreach($results as $x){
      $thumnail = json_decode($x->thumnail);
        $html.='<li class="bv-cart col-6 col-md-4 col-xl-3 "><a class="a-bv" href="'.get_permalink($x->id_post).'" title="'.$x->title.'" ><img src="'.$thumnail->url150.'" width="80px" height="80px"><p style=" font-size: 12px;margin-bottom: 3px; ">'.$x->title.'</p></a></li>';
    }
    return $html;
}
//
function get_data_search($search_text){
    global $wpdb;
    $table_prefix=$wpdb->prefix .'shopseo_posts';
         $sql = $wpdb->prepare( "SELECT id_post,thumnail,title,short_des FROM $table_prefix WHERE  title LIKE %s ORDER BY id DESC LIMIT %d OFFSET %d ",'%'.$search_text.'%',10,0);
    $results = $wpdb->get_results( $sql , OBJECT );
    $rs=array();
    foreach($results as $x){
      $object = new stdClass();
      $object->thumnail=json_decode($x->thumnail);
      $object->title=$x->title;
      $object->short_des=$x->short_des;
      $object->url=get_permalink($x->id_post);
      array_push($rs,$object);
    }
    if(count($rs)>0){
        return $rs;
    }else{
        return false;
    }
}
?>