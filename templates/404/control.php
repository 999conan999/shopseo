<?php
    $type='page';
    $home_url=get_home_url();
    $home_name=str_replace('https://', '', $home_url);
    $home_name=str_replace('http://', '', $home_name);
    //
    $redirects = array(
        '/cofanew/xxxxx' => '/tu-sat',
        // Thêm nhiều cặp slug và URL khác nếu cần
    );
    // Kiểm tra URL slug và chuyển hướng nếu cần
    if (isset($redirects[$_SERVER['REQUEST_URI']])) {
        header("Location: " . $home_url . $redirects[$_SERVER['REQUEST_URI']], TRUE, 301);
        die();
    }
    //
    if($common->ridirect_404_301_home){
        header("Location: ".$home_url,TRUE,301);
        die();
    };
    $thumnail=$common->logo_icon;
    $canatical="noindex, nofollow, max-snippet:-1, max-image-preview:large, max-video-preview:-1";
    $html_xu_huong=get_404_cate();

?>