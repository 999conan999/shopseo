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
            $head.='<title>Giường sắt, 74 mẫu Giường Sắt Đẹp nhất, Giảm giá tới 40% | anbinhnew.com </title>';
            $head.='<meta name="description" content="Giường sắt tháo ráp, miễn phí vận chuyển tại tpHCM. Chất liệu sắt hộp cao cấp và bền bỉ sẽ giúp cho giường của bạn dùng trong nhiều năm. Với nhiều kích thước khác nhau để lựa chọn như 1mx2m, 1m2x2m, 1m4x2m, 1m6x2m, 1m8x2m, bạn có thể tìm thấy một giường phù hợp với kích thước của phòng ngủ của mình. Sản phẩm được bán tại nhiều khu vực trong thành phố Hồ Chí Minh và khu vực lân cận, bao gồm các quận như Quận 1, Quận 2, Quận 3, Quận 4, Quận 5, Quận 6, Quận 7, Quận 8, Quận 9, Quận 10, Quận 11, Quận 12, Quận Bình Thạnh, Quận Phú Nhuận, Quận Tân Bình, Quận Bình Tân, Huyện Bình Chánh, Quận Hóc Môn, Huyện Nhà Bè, Biên Hòa Đồng Nai, Dĩ An, Thuận An Bình Dương và Thủ Đức. Bên cạnh đó, khách hàng sẽ được tận hưởng nhiều dịch vụ hỗ trợ hấp dẫn như miễn phí vận chuyển, hỗ trợ lắp đặt và bảo hành 2 năm khi mua sản phẩm.">';
            $head.='<link rel="canonical" href="https://anbinhnew.com/shop/giuong-sat/">';
            $head.='<meta property="og:locale" content="vi_VN">';
            $head.='<meta property="og:type" content="website">';
            $head.='<meta property="og:title" content="Giường sắt, 74 mẫu Giường Sắt Đẹp nhất, Giảm giá tới 40%">';
            $head.='<meta property="og:description" content="Giường sắt tháo ráp, miễn phí vận chuyển tại tpHCM. Chất liệu sắt hộp cao cấp và bền bỉ sẽ giúp cho giường của bạn dùng trong nhiều năm. Với nhiều kích thước khác nhau để lựa chọn như 1mx2m, 1m2x2m, 1m4x2m, 1m6x2m, 1m8x2m, bạn có thể tìm thấy một giường phù hợp với kích thước của phòng ngủ của mình. Sản phẩm được bán tại nhiều khu vực trong thành phố Hồ Chí Minh và khu vực lân cận, bao gồm các quận như Quận 1, Quận 2, Quận 3, Quận 4, Quận 5, Quận 6, Quận 7, Quận 8, Quận 9, Quận 10, Quận 11, Quận 12, Quận Bình Thạnh, Quận Phú Nhuận, Quận Tân Bình, Quận Bình Tân, Huyện Bình Chánh, Quận Hóc Môn, Huyện Nhà Bè, Biên Hòa Đồng Nai, Dĩ An, Thuận An Bình Dương và Thủ Đức. Bên cạnh đó, khách hàng sẽ được tận hưởng nhiều dịch vụ hỗ trợ hấp dẫn như miễn phí vận chuyển, hỗ trợ lắp đặt và bảo hành 2 năm khi mua sản phẩm.">';
            $head.='<meta property="og:url" content="https://anbinhnew.com/shop/giuong-sat/">';
            $head.='<meta property="og:site_name" content="anbinhnew.com">';
            $head.='<meta property="og:image" content="https://anbinhnew.com/wp-content/uploads/2023/04/giuong-sat-thu-dau-mot.jpg">';
            $head.='<meta property="og:image:width" content="640">';
            $head.='<meta property="og:image:height" content="640">';
            $head.='<meta name="twitter:card" content="summary_large_image">';
            $head.='<link rel="icon" href="https://anbinhnew.com/wp-content/uploads/2022/06/logo-an-binh-noi-that-zshare.jpg" sizes="192x192">';
            $head.='<link rel="apple-touch-icon" href="https://anbinhnew.com/wp-content/uploads/2022/06/logo-an-binh-noi-that-zshare.jpg">';
            $head.='<meta name="msapplication-TileImage" content="https://anbinhnew.com/wp-content/uploads/2022/06/logo-an-binh-noi-that-zshare.jpg">';
            $head.='<script defer="defer" src="'.$home_url.'/wp-content/themes/shopseo/templates/src/lazyload.js"></script>';
            $head.='<style>@font-face { font-family: "icomoon"; src:  url("'.$home_url.'/wp-content/themes/shopseo/templates/src//icon/fonts/icomoon.eot?rxvpb"); src:  url("'.$home_url.'/wp-content/themes/shopseo/templates/src//icon/fonts/icomoon.eot?rxvpb#iefix") format("embedded-opentype"), url("'.$home_url.'/wp-content/themes/shopseo/templates/src//icon/fonts/icomoon.ttf?rxvpb") format("truetype"), url("'.$home_url.'/wp-content/themes/shopseo/templates/src//icon/fonts/icomoon.woff?rxvpb") format("woff"), url("'.$home_url.'/wp-content/themes/shopseo/templates/src//icon/fonts/icomoon.svg?rxvpb#icomoon") format("svg"); font-weight: normal; font-style: normal; font-display: block; }</style>';
            $head.='<link href="'.$home_url.'/wp-content/themes/shopseo/templates/src/style.css" rel="stylesheet">';
        $head.='</head>';
        echo $head;
            require_once(get_stylesheet_directory().'/templates/home/main.php');
        echo '</html>';
    $html_content = ob_get_clean();
    set_cache('shopseo_posts',$id,$time_now,$html_content);
    die($html_content);

?>