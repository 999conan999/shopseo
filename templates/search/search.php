<?php
    require_once(get_stylesheet_directory().'/templates/fs_common_theme.php');
    // $obj=get_queried_object();
    // $id=$obj->ID;
    // xu ly cache
    $common= get_common();
    require_once(get_stylesheet_directory().'/templates/search/control.php');
    require_once(get_stylesheet_directory().'/templates/header/header.php'); 
    require_once(get_stylesheet_directory().'/templates/footer/footer.php');


    echo '<!DOCTYPE html>';
    echo '<html lang="vi">';
    $head='<head>';
        $head.='<meta name="viewport" content="width=device-width, initial-scale=1">';
        $head.='<meta name="robots" content="noindex, nofollow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">';
        $head.='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
        $head.='<title>'.$search_text.' | '.$home_name.'</title>';
        $head.='<meta name="description" content="Tìm kiếm từ khóa: '.$search_text.'">';
        $head.='<link rel="canonical" href="'.$home_url.'">';
        $head.='<meta property="og:locale" content="vi_VN">';
        $head.='<meta property="og:type" content="website">';
        $head.='<meta property="og:title" content="'.$search_text.'">';
        $head.='<meta property="og:description" content="Tìm kiếm từ khóa: '.$search_text.'.">';
        $head.='<meta property="og:url" content="'.$home_url.'">';
        $head.='<meta property="og:site_name" content="'.$home_name.'">';
        $head.='<meta property="og:image" content="'.$thumnail.'">';
        $head.='<meta property="og:image:width" content="640">';
        $head.='<meta property="og:image:height" content="640">';
        $head.='<meta name="twitter:card" content="summary_large_image">';
        $head.='<link rel="icon" href="'.$common->mini_icon.'" sizes="192x192">';
        $head.='<link rel="apple-touch-icon" href="'.$common->mini_icon.'">';
        $head.='<meta name="msapplication-TileImage" content="'.$common->mini_icon.'">';
        $head.='<script defer="defer" src="'.$home_url.'/wp-content/themes/shopseo/templates/src/lazyload.js"></script>';
        $head.='<style>@font-face { font-family: "icomoon"; src:  url("'.$home_url.'/wp-content/themes/shopseo/templates/src//icon/fonts/icomoon.eot?rxvpb"); src:  url("'.$home_url.'/wp-content/themes/shopseo/templates/src//icon/fonts/icomoon.eot?rxvpb#iefix") format("embedded-opentype"), url("'.$home_url.'/wp-content/themes/shopseo/templates/src//icon/fonts/icomoon.ttf?rxvpb") format("truetype"), url("'.$home_url.'/wp-content/themes/shopseo/templates/src//icon/fonts/icomoon.woff?rxvpb") format("woff"), url("'.$home_url.'/wp-content/themes/shopseo/templates/src//icon/fonts/icomoon.svg?rxvpb#icomoon") format("svg"); font-weight: normal; font-style: normal; font-display: block; }</style>';
        $head.='<link href="'.$home_url.'/wp-content/themes/shopseo/templates/src/style.css" rel="stylesheet">';
        $head.=$common->gg_header;
    $head.='</head>';
    echo $head;
        require_once(get_stylesheet_directory().'/templates/search/main.php');
    echo '</html>';

?>