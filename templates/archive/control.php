<?php

$type='category';
$home_url=get_home_url();
$home_name=str_replace('https://', '', $home_url);
$home_name=str_replace('http://', '', $home_name);
$data=get_cate_infor($id);
$current_url=$data->url;
// var_dump($data);

?>