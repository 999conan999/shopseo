<?php
    require_once(get_stylesheet_directory().'/templates/fs_common_theme.php');
    $obj=get_queried_object();
    $id=$obj->ID;
    // xu ly cache
    $common= get_common();
    $time_now=time();
    $o=get_cache_by_table_name('shopseo_posts',$id);
    if($o->time_cache>0){
        $limit_time=(int)$common->time_cache;
        $denta=$time_now-$o->time_cache;
        if($denta<$limit_time){
            echo $o->data_cache;
            die();
        }
    }

        require_once(get_stylesheet_directory().'/templates/home/control.php');
        require_once(get_stylesheet_directory().'/templates/header/header.php'); 
        require_once(get_stylesheet_directory().'/templates/footer/footer.php');
        
        ob_start();
        echo '<!DOCTYPE html>';
        echo '<html lang="vi">';
        $head='<head>';
            $head.='<meta name="viewport" content="width=device-width, initial-scale=1">';
            $head.='<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">';
            $head.='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
            $head.='<title>'.$data->title.' | '.$home_name.'</title>';
            $head.='<meta name="description" content="'.$data->short_des.'">';
            $head.='<link rel="canonical" href="'.$home_url.'">';
            $head.='<meta property="og:locale" content="vi_VN">';
            $head.='<meta property="og:type" content="website">';
            $head.='<meta property="og:title" content="'.$data->title.'">';
            $head.='<meta property="og:description" content="'.$data->short_des.'">';
            $head.='<meta property="og:url" content="'.$home_url.'">';
            $head.='<meta property="og:site_name" content="'.$home_name.'">';
            $head.='<meta property="og:image" content="'.$data->thumnail->url.'">';
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
            require_once(get_stylesheet_directory().'/templates/home/main.php');
        echo '</html>';
    $html_content = ob_get_clean();
    set_cache('shopseo_posts',$id,$time_now,$html_content);
    die($html_content);

?>