<?php

    $common= get_common();//
    $type='page';
    $home_url=get_home_url();
    $home_name=str_replace('https://', '', $home_url);
    $home_name=str_replace('http://', '', $home_name);
    $post_infor=get_page_infor($id);

?>