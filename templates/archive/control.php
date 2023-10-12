<?php

$type='category';
$home_url=get_home_url();
$home_name=str_replace('https://', '', $home_url);
$home_name=str_replace('http://', '', $home_name);
$data=get_cate_infor($id);
$current_url=$data->url;
$cd=$data->price_ss;
// var_dump($data);
$data_tiktok=array();
$is_tiktok = false; 
if (isset($data->is_tiktok)) {
    $is_tiktok = $data->is_tiktok;
    if (isset($data->data_tiktok)) {
        $data_tiktok = $data->data_tiktok;
        if(count($data_tiktok)==0) $is_tiktok = false; 
    }
} 

?>