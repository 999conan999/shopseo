<?php
// $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
// require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;
  
//   $Path_name_xml=ABSPATH.'wp-content/themes/shopseo/templates/ajax/xml/products.xml';
//   global $wpdb;
//   $table_prefix=$wpdb->prefix .'shopseo_posts';
//   $sql = $wpdb->prepare( "SELECT id_post,title,short_des,price,thumnail,shoping_type,instock,id_category FROM $table_prefix WHERE shoping_on_off = 'on' AND post_status = 'publish' ORDER BY id_category DESC ");
//   $results = $wpdb->get_results( $sql , OBJECT );
//   if(count($results)>0){
//     $home_url=get_home_url();
//     $home_name=str_replace('https://', '', $home_url);
//     $home_name=str_replace('http://', '', $home_name);
//     $rs=array();
//     foreach($results as $x){
//         $values = [];
//         $values['id'] = $x->id_post;
//         $values['title'] = $x->title;
//         $values['description'] =  $x->short_des;
//         $values['link'] = get_permalink($x->id_post);
//         $values['condition'] = "Mới";
//         $values['availability'] = $x->instock=="true"?"in_stock":"out_of_stock";
//             $price= str_replace(' ', '', $x->price);
//         $values['price'] = $price." VND";
//             $cat = get_category($x->id_category);
//             $name_brand=$cat->name." ".$home_name;
//         $values['brand'] = $name_brand;
//         $values['gtin'] = "";
//         $values['mpn'] = "";
//             $thumnail=json_decode($x->thumnail);
//         $values['image_link'] = $thumnail->url;
//         $values['google_product_category'] = "";
//         $values['custom_label_0'] = $x->shoping_type;
//         array_push($rs,$values);
//     }
//     if(count($rs)>0){
//         global $Path_name_xml;
//         $xml = new SimpleXMLElement('<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0"></rss>');
//         $channel = $xml->addChild('channel');
//         // Tạo một namespace
//         $gNamespace = 'http://base.google.com/ns/1.0';
//         foreach($rs as $updatedFields){
//             $item = $xml->channel->addChild('item');
//             foreach ($updatedFields as $fieldName => $fieldValue) {
//                 $item->addChild('g:'.$fieldName, $fieldValue, $gNamespace);
//             }
//         }
//         // Lưu file XML
//         $xml->asXML($Path_name_xml);
//     }
//   }
?>
