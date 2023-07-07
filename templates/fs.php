<?php 
// Remove Parent Category from Child Category URL
add_filter('term_link', 'devvn_no_category_parents', 1000, 3);
function devvn_no_category_parents($url, $term, $taxonomy) {
    if($taxonomy == 'category'){
        $term_nicename = $term->slug;
        $url = trailingslashit(get_option( 'home' )) . user_trailingslashit( $term_nicename, 'category' );
    }
    return $url;
}
// Rewrite url mới
function devvn_no_category_parents_rewrite_rules($flash = false) {
    $terms = get_terms( array(
        'taxonomy' => 'category',
        'post_type' => 'post',
        'hide_empty' => false,
    ));
    if($terms && !is_wp_error($terms)){
        foreach ($terms as $term){
            $term_slug = $term->slug;
            add_rewrite_rule($term_slug.'/?$', 'index.php?category_name='.$term_slug,'top');
            add_rewrite_rule($term_slug.'/page/([0-9]{1,})/?$', 'index.php?category_name='.$term_slug.'&paged=$matches[1]','top');
            add_rewrite_rule($term_slug.'/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$', 'index.php?category_name='.$term_slug.'&feed=$matches[1]','top');
        }
    }
    if ($flash == true)
        flush_rewrite_rules(false);
}
add_action('init', 'devvn_no_category_parents_rewrite_rules');
/*Sửa lỗi khi tạo mới category bị 404*/
function devvn_new_category_edit_success() {
    devvn_no_category_parents_rewrite_rules(true);
}
add_action('created_category','devvn_new_category_edit_success');
add_action('edited_category','devvn_new_category_edit_success');
add_action('delete_category','devvn_new_category_edit_success');
// 
if (!function_exists('send')) {
    function send($data){
        header('Cache-Control: no-cache, must-revalidate');
        header('Content-type: application/json');
        echo json_encode($data);
    }
}
 
// //
if(is_user_logged_in()){
    add_action('after_switch_theme', 'my_theme_activation_hook');
}
function render_xml_first(){
    $Path_name_xml=ABSPATH.'wp-content/themes/shopseo/templates/ajax/xml/products.xml';
    global $wpdb;
    $table_prefix=$wpdb->prefix .'shopseo_posts';
    $sql = $wpdb->prepare( "SELECT id_post,title,short_des,price,thumnail,shoping_type,instock,id_category FROM $table_prefix WHERE shoping_on_off = 'on' AND post_status = 'publish' ORDER BY id_category DESC ");
    $results = $wpdb->get_results( $sql , OBJECT );
    if(count($results)>0){
      $home_url=get_home_url();
      $home_name=str_replace('https://', '', $home_url);
      $home_name=str_replace('http://', '', $home_name);
      $rs=array();
      foreach($results as $x){
          $values = [];
          $values['id'] = $x->id_post;
          $values['title'] = $x->title;
          $values['description'] =  $x->short_des;
          $values['link'] = get_permalink($x->id_post);
          $values['condition'] = "Mới";
          $values['availability'] = $x->instock=="true"?"in_stock":"out_of_stock";
              $price= str_replace(' ', '', $x->price);
          $values['price'] = $price." VND";
              $cat = get_category($x->id_category);
              $name_brand=$cat->name." ".$home_name;
          $values['brand'] = $name_brand;
          $values['gtin'] = "";
          $values['mpn'] = "";
              $thumnail=json_decode($x->thumnail);
          $values['image_link'] = $thumnail->url;
          $values['google_product_category'] = "";
          $values['custom_label_0'] = $x->shoping_type;
          array_push($rs,$values);
      }
      if(count($rs)>0){
          // Kiểm tra xem file tồn tại trước khi xóa
            if (file_exists($Path_name_xml)) {
                // Xóa file
                unlink($Path_name_xml);
            }
          $xml = new SimpleXMLElement('<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0"></rss>');
          $channel = $xml->addChild('channel');
          // Tạo một namespace
          $gNamespace = 'http://base.google.com/ns/1.0';
          foreach($rs as $updatedFields){
              $item = $xml->channel->addChild('item');
              foreach ($updatedFields as $fieldName => $fieldValue) {
                  $item->addChild('g:'.$fieldName, $fieldValue, $gNamespace);
              }
          }
          // Lưu file XML
          $xml->asXML($Path_name_xml);
      }
    }
}

function my_theme_activation_hook() {
    global $wpdb;
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    $table_name = $wpdb->prefix . 'shopseo_imgs';
    // Kiểm tra xem bảng đã tồn tại hay chưa
    if ($wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") != $table_name) {
        $charset_collate = $wpdb->get_charset_collate();
        // Tạo câu truy vấn để tạo bảng
        $sql = "CREATE TABLE {$table_name} (
            id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            url text NULL,
            url300 text NULL,
            url150 text NULL,
            tag text NULL,
            title text NULL,
            date_create timestamp NOT NULL,
            PRIMARY KEY (id)
        ) {$charset_collate};";
        // Thực hiện tạo bảng
        dbDelta($sql);
    }

    //
    $table_name = $wpdb->prefix . 'shopseo_posts';
    $table_parent = $wpdb->prefix . 'posts';
    // Kiểm tra xem bảng đã tồn tại hay chưa
    if ($wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") != $table_name) {
        $charset_collate = $wpdb->get_charset_collate();
        
        // Tạo câu truy vấn để tạo bảng
        $sql = "CREATE TABLE {$table_name} (
            id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            id_post bigint(20) UNSIGNED NOT NULL,
            id_category bigint(20) UNSIGNED NOT NULL,
            thumnail text NOT NULL,
            title text NOT NULL,
            price bigint(20) NOT NULL,
            quantity_sold int(10) NOT NULL,
            key_word text NOT NULL,
            related_keyword text NOT NULL,
            short_des text NOT NULL,
            is_best_seller varchar(6) NOT NULL,
            post_type varchar(50) NOT NULL,
            post_status varchar(20) NOT NULL,
            json_data longtext NULL,
            data_cache longtext NOT NULL,
            time_cache text NOT NULL,
            shoping_type varchar(200) NOT NULL,
            instock varchar(10) NOT NULL,
            shoping_on_off varchar(10) NOT NULL,
            PRIMARY KEY (id),
            FOREIGN KEY (id_post) REFERENCES {$table_parent}(ID) ON DELETE CASCADE
        ) {$charset_collate};";
        // Thực hiện tạo bảng
        dbDelta($sql);
    }

    $table_name = $wpdb->prefix . 'shopseo_attributes';
    // Kiểm tra xem bảng đã tồn tại hay chưa
    if ($wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") != $table_name) {
        $charset_collate = $wpdb->get_charset_collate();
        // Tạo câu truy vấn để tạo bảng
        $sql = "CREATE TABLE {$table_name} (
            id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            thumnail text NULL,
            title text NULL,
            tag text NULL,
            price bigint(20) NULL,
            price_ss bigint(20) NULL,
            json_data longtext NOT NULL,
            PRIMARY KEY (id)
        ) {$charset_collate};";
        // Thực hiện tạo bảng
        dbDelta($sql);
    }

    //
    $table_name = $wpdb->prefix . 'shopseo_terms';
    $table_parent = $wpdb->prefix . 'terms';
    // Kiểm tra xem bảng đã tồn tại hay chưa
    if ($wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") != $table_name) {
        $charset_collate = $wpdb->get_charset_collate();
        
        // Tạo câu truy vấn để tạo bảng
        $sql = "CREATE TABLE {$table_name} (
            id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            id_term bigint(20) UNSIGNED NOT NULL,
            thumnail text NOT NULL,
            title text NOT NULL,
            short_des text NOT NULL,
            price_ss bigint(20) NOT NULL,
            related_links longtext NULL,
            json_data longtext NULL,
            data_cache longtext NOT NULL,
            time_cache text NOT NULL,
            PRIMARY KEY (id),
            FOREIGN KEY (id_term) REFERENCES {$table_parent}(term_id) ON DELETE CASCADE
        ) {$charset_collate};";
        // Thực hiện tạo bảng
        dbDelta($sql);
    }

    //
    $table_name = $wpdb->prefix . 'shopseo_comments';
    $table_parent = $wpdb->prefix . 'posts';
    // Kiểm tra xem bảng đã tồn tại hay chưa
    if ($wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") != $table_name) {
        $charset_collate = $wpdb->get_charset_collate();
        
        // Tạo câu truy vấn để tạo bảng
        $sql = "CREATE TABLE {$table_name} (
            id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            id_post bigint(20) UNSIGNED NOT NULL,
            rs_comment text NOT NULL,
            rs_user_name text NOT NULL,
            rs_phone varchar(20) NOT NULL,
            rs_status varchar(10) NOT NULL,
            rs_rep text NOT NULL,
            json_img longtext NOT NULL,
            PRIMARY KEY (id),
            FOREIGN KEY (id_post) REFERENCES {$table_parent}(ID) ON DELETE CASCADE
        ) {$charset_collate};";
        // Thực hiện tạo bảng
        dbDelta($sql);
    }

    $table_name = $wpdb->prefix . 'shopseo_orders';
    // Kiểm tra xem bảng đã tồn tại hay chưa
    if ($wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") != $table_name) {
        $charset_collate = $wpdb->get_charset_collate();
        // Tạo câu truy vấn để tạo bảng
        $sql = "CREATE TABLE {$table_name} (
            id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            name_buyer text NULL,
            phone varchar(20) NOT NULL,
            address_1 text NOT NULL,
            note text NOT NULL,
            order_status varchar(20) NOT NULL,
            data_carts longtext NULL,
            date_create text NOT NULL,
            PRIMARY KEY (id)
        ) {$charset_collate};";
        // Thực hiện tạo bảng
        dbDelta($sql);
    }
    // render xml shoping first
    render_xml_first();

}


 
?>