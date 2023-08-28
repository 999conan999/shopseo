<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;
require_once(get_stylesheet_directory().'/templates/ajax/xml/main.php');

function update_post($id_post,$value){
     $data = array(
          'price'=> $value,
      );
      global $wpdb;
      $table = $wpdb->prefix . 'shopseo_posts';
      $rs=$wpdb->update(
          $table,
          $data,
          array('id_post' => $id_post)
      );
      return $rs;
}
function update_price_all_in_cate($id_att){// id attributed
    global $wpdb;
    $table_prefix=$wpdb->prefix .'shopseo_attributes';
        $sql = $wpdb->prepare( "SELECT id,tag,json_data FROM $table_prefix WHERE id = %d",$id_att);
    $results = $wpdb->get_results( $sql , OBJECT );
    if(count($results)>0){
     // id category
          $id_cate=$results[0]->tag;
          $json_data=json_decode($results[0]->json_data);
     //table_price
          $table_price=$json_data->table_price;
          if(count($table_price)>0){
               //danh sach san pham theo id
               global $wpdb;
               $table_prefix=$wpdb->prefix .'shopseo_posts';
                    $sql = $wpdb->prepare( "SELECT id_post,price,json_data FROM $table_prefix WHERE id_category = %d AND post_status = 'publish' ORDER BY id DESC ",$id_cate);
               $results = $wpdb->get_results( $sql , OBJECT );
               // $list_sp=[];
               foreach($results as $x){
                    $json_data=json_decode($x->json_data);
                    $index_price=$json_data->index_price;
                    $attribute_id=$json_data->attribute_id;
                    $price_old=(int)$x->price;
                    $id_post=$x->id_post;
                    if($id_att==$attribute_id){
                         if(isset($table_price[$index_price])){
                              $price_new=(int)$table_price[$index_price]->price_v+(int)$table_price[$index_price]->price_profit;
                              if($price_new!=$price_old){
                                   // echo 'xu ly thay doi o day';
                                   $rs=update_post($id_post,$price_new);
                                   if($rs==1){
                                        main($id_post);
                                   }
                              }
                         }
                    }
               }
          }
    }
}

// if(is_user_logged_in()){
//      if(isset($_GET['id'])){
//           $id_cate=(int)$_GET['id'];
//           get_posts_shopseo($id_cate);
//      }
// }

// update_price_all_in_cate(8);
      



?>