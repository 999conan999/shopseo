<?php
    $type='page';
    $home_url=get_home_url();
    $home_name=str_replace('https://', '', $home_url);
    $home_name=str_replace('http://', '', $home_name);
    if($common->ridirect_404_301_home){
        header("Location: ".$home_url,TRUE,301);
        die();
    };
    $thumnail=$common->logo_icon;
    $canatical="noindex, nofollow, max-snippet:-1, max-image-preview:large, max-video-preview:-1";
    $html_xu_huong=get_404_cate();

?>
<?php

 

?>