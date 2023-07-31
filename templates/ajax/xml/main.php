<?php
// $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
// require_once( $parse_uri[0] . 'wp-load.php' );	// global $wpdb;
$Path_name_xml=ABSPATH.'wp-content/themes/shopseo/templates/ajax/xml/products.xml';
function get_infor_shoping_product_by_id($id){// 
    global $wpdb;
    $table_prefix=$wpdb->prefix .'shopseo_posts';
         $sql = $wpdb->prepare( "SELECT id_post,title,short_des,price,thumnail,img_shoping,shoping_type,instock,id_category FROM $table_prefix WHERE id_post = %d AND shoping_on_off = 'on' AND post_status = 'publish' ORDER BY id DESC ",$id);
    $results = $wpdb->get_results( $sql , OBJECT );
    if(count($results)>0){
        $home_url=get_home_url();
        $home_name=str_replace('https://', '', $home_url);
        $home_name=str_replace('http://', '', $home_name);
        $values = [];
        $values['id'] = $results[0]->id_post;
        $values['title'] = $results[0]->title;
        $values['description'] =  $results[0]->short_des;
        $values['link'] = get_permalink($results[0]->id_post);
        $values['condition'] = "Mới";
        $values['availability'] = $results[0]->instock=="true"?"in_stock":"out_of_stock";
            $price= str_replace(' ', '', $results[0]->price);
        $values['price'] = $price." VND";
            $cat = get_category($results[0]->id_category);
            $name_brand=$cat->name." ".$home_name;
        $values['brand'] = $name_brand;
        $values['gtin'] = "";
        $values['mpn'] = "";
        if($results[0]->img_shoping==""||$results[0]->img_shoping==" "||$results[0]->img_shoping==NULL){
            $thumnail=json_decode($results[0]->thumnail);
        $values['image_link'] = $thumnail->url;
        }else{
        $values['image_link'] = $results[0]->img_shoping;
        }
        $values['google_product_category'] = "";
        $values['custom_label_0'] = $results[0]->shoping_type;
        return $values;
    }else{
        return false;
    }
}
function delete_nodes($id) {
    global $Path_name_xml;
    $xml = simplexml_load_file($Path_name_xml); // Tải tệp XML
    $gNamespace = 'http://base.google.com/ns/1.0';
    // Sử dụng XPath để tìm các node có id cần xóa
    $nodesToDelete = $xml->xpath("//g:id[. = '{$id}']/parent::*");
    
    if (!empty($nodesToDelete)) {
        // Duyệt qua các node và xóa chúng
        foreach ($nodesToDelete as $node) {
            $domNode = dom_import_simplexml($node);
            $domNode->parentNode->removeChild($domNode);
        }
        
        $xml->asXML($Path_name_xml); // Lưu lại tệp XML sau khi xóa node
        return true;
    }
    
    return false;
}
function add_node($updatedFields){
    global $Path_name_xml;
    $xml = simplexml_load_file($Path_name_xml);
    // Tạo một namespace
    $gNamespace = 'http://base.google.com/ns/1.0';
    // Tạo một node con với các trường dữ liệu
    $item = $xml->channel->addChild('item');
    foreach ($updatedFields as $fieldName => $fieldValue) {
        // $node->$fieldName = $fieldValue;
        $item->addChild('g:'.$fieldName, $fieldValue, $gNamespace);
    }
    // Lưu file XML
    $xml->asXML($Path_name_xml);
}
// function is_node_exists($id) {
//     global $Path_name_xml;
//     $xml = simplexml_load_file($Path_name_xml); // Tải tệp XML
//     $nodes = $xml->xpath("//g:id[. = '{$id}']/parent::*");
//     return !empty($nodes); // Trả về true nếu tìm thấy node, ngược lại trả về false
// }
function create_xml(){
    global $Path_name_xml;
    $xml = new SimpleXMLElement('<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0"></rss>');
    $channel = $xml->addChild('channel');
     // Lưu file XML
    $xml->asXML($Path_name_xml);
    
}
function main($id){
    global $Path_name_xml;
    if (!file_exists($Path_name_xml)) {create_xml();};
    delete_nodes($id);
    $updatedFields=get_infor_shoping_product_by_id($id);
    if($updatedFields){// co gia tri
        add_node($updatedFields);
    }
}


// main(584);


?>
