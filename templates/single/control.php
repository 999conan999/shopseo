<?php

    $home_url=get_home_url();
    $type='post';
    $home_name=str_replace('https://', '', $home_url);
    $home_name=str_replace('http://', '', $home_name);
    $post_infor=get_post_infor($id);
    $comments_id=$post_infor->comments_id==-1?$id:$post_infor->comments_id;
    if($post_infor->canonical!=""){
        $current_url=$post_infor->canonical;
    }else{
        $current_url=get_permalink($id);
    }
    $schema="";
    if($post_infor->type!="bv"){
        $year=date("Y");
        $vote= $id+($year-2000)*10+date("m")*2;
        $rate=4+rand(0,9)/10;
        // $highPrice=rand(9,12)*100000;
        $schema='<script type="application/ld+json">';
        $schema.='{"@context": "http://schema.org/","@type": "Product","name":"'.$post_infor->title.'","image":"'.$post_infor->thumnail->url.'","description":"'.$post_infor->short_des.'","url":"'.$current_url.'","sku":"'.$id.'","brand":{"@type": "Brand","name":"OEM"},"mpn":"COFA'.$id.'","review": {"@type": "Review","reviewRating": {"@type": "Rating","ratingValue": "'.$rate.'","bestRating": "5"},"author": {"@type": "Person","name": "'.$home_name.'"}},"aggregateRating": {"@type": "AggregateRating","ratingValue": "'.$rate.'","reviewCount": "'.$vote.'"},"offers": {"@type": "Offer","url":"'.$current_url.'","priceCurrency":"VND","price":"'.$post_infor->price.'","priceValidUntil": "'.$year.'-12-12","itemCondition": "https://schema.org/NewCondition","availability": "https://schema.org/InStock","seller": {"@type": "Organization", "name": "'.$home_name.'"}}}';
        $schema.='</script>';
    }
    //
    $index_price=$post_infor->index_price;
    if (is_object($post_infor) && property_exists($post_infor, 'att')) {
        $att=$post_infor->att;
        $price_ins=((int)$att->table_price[$index_price]->price_v+(int)$att->table_price[$index_price]->price_profit);
        $price_del=$price_ins+(int)$att->table_price[$index_price]->price_og;
        $cd=$att->price_ss;
    }else{
        $att = new stdClass();
        $att->title="";
        $att->attribute_name='Loại';
        $att->is_show_price_table=false;
        $att->is_show_infor=false;
        $att->is_show_commit=false;
        $att->table_price=array();
        $price_ins=0;
        $price_del=0;
        $cd=$post_infor->price_ss;

    }
    $table_price=array();
?>