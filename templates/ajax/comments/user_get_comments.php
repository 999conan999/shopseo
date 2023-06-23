<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;

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
          $html_img.='<div class="dev-3 pdr-3"> <img class="img-com lazyload" src="'.$img->url300.'" data-src="'.$img->url.'" width="100%"></div>';
     }
     $html.='<div class="w1"> <b>'.$x->rs_user_name.'</b> &nbsp;&nbsp;<span class="icon-cartx comx"></span><i>Đã mua tại'.$home_name.'</i><p>'.$x->rs_comment.'</p>';
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
   send($obj);
}

     if(isset($_GET['id'])){
          $id_post=(int)stripslashes(strip_tags($_GET['id']));
          $page=(int)stripslashes(strip_tags($_GET['page']));
          get_comments_shopseo($id_post,$page);
     }
 ?>