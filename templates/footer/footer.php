<?php
$footer='<footer id="footer" class="lock" data="'.$home_url.'">';
    $footer.='<div class="content-footer video-runing">';
        $footer.='<div class="container">';
            $footer.='<div class="row">';
                $footer.='<div class="col-12 col-sm-6 col-lg-3">';
                    $footer.='<div class="logoz">';
                        $footer.='<div class="icon-contact">';
                            $footer.='<a href="'.$home_url.'"><img src="'.$common->logo_icon.'" class="header-logo-dark" alt="logo '.$home_name.'"></a>';
                            $footer.='<ul class="ulicon"> <li class="bnb"> <a rel="nofollow"> <span class="icon-fb"></span> </a> </li> <li class="bnb"> <a rel="nofollow"> <span class="icon-inta"></span> </a> </li> <li class="bnb"> <a rel="nofollow"> <span class="icon-youtube"></span> </a> </li> <li class="bnb"> <a rel="nofollow"> <span class="icon-ping"></span> </a> </li> </ul>';
                        $footer.='</div>';
                        $footer.='<p style="color: rgb(248, 248, 248); font-size: 14px; text-align: center;"><strong>Địa chỉ</strong> :'.$common->lien_he_dc.'</p>';
                    $footer.='</div>';
                $footer.='</div>';
                $footer.='<div class="col-12 col-sm-6 col-lg-3">';
                    $footer.='<div class="aboutz">';
                        $footer.='<span class="titlez">Thông tin</span>';
                        $footer.='<ul class="listz">';
                        foreach($common->thong_tin as $x){
                            $footer.='<li><a href="'.$x->value.'" title="'.$x->name.'">'.$x->name.'</a></li>';
                        }
                        $footer.='</ul>';
                    $footer.='</div>';
                $footer.='</div>';
                $footer.='<div class="col-12 col-sm-6 col-lg-3">';
                    $footer.='<div class="aboutz">';
                        $footer.='<span class="titlez">CHÍNH SÁCH</span>';
                        $footer.='<ul class="listz">';
                        foreach($common->chinh_sach as $x){
                            $footer.='<li><a href="'.$x->value.'" title="'.$x->name.'">'.$x->name.'</a></li>';
                        }
                        $footer.='</ul>';
                    $footer.='</div>';
                $footer.='</div>';
                $footer.='<div class="col-12 col-sm-6 col-lg-3">';
                    $footer.='<div class="aboutz">';
                        $footer.='<span class="titlez">TUYỂN DỤNG</span>';
                        $footer.='<ul class="listz">';
                        foreach($common->tuyen_dung as $x){
                            $footer.='<li><a href="'.$x->value.'" title="'.$x->name.'">'.$x->name.'</a></li>';
                        }
                        $footer.='</ul>';
                    $footer.='</div>';
                $footer.='</div>';
            $footer.='</div>';
        $footer.='</div>';
    $footer.='</div>';
    $footer.='<div class="footer-bottom video-runing">';
        $footer.='<div class="sol textz"> <p style="margin: 0px;">'.$common->design_by.'</p> </div>';
    $footer.='</div>';
    $footer.='<div class="fixed-tool">';
        $footer.='<ul class="ulz">';
        // xu ly chuyen doi contacts here
        $p=50000;
        $z=50000;
        $m=50000;
        if(is_single($id)){
            $p=((int)($cd))*(float)($common->phone_cd);
            $z=((int)($cd))*(float)($common->zalo_cd);
            $m=((int)($cd))*(float)($common->fb_cd);
        }elseif(is_category($id)){
            $p=((int)($cd))*(float)($common->phone_cd);
            $z=((int)($cd))*(float)($common->zalo_cd);
            $m=((int)($cd))*(float)($common->fb_cd);
        } 
        // end chuyen doi
             $footer.='<li><a id="cuoc-goi-2" href="tel:'.$common->lien_he_sdt.'" rel="nofollow" onclick="window.value='.$p.'"><i class="icon-call calzs"></i></a><span class="aml-text-content aml-tooltiptext">Gọi ngay: '.$formattedPhoneNumber.'</span></li>';
             $footer.='<li><a id="lien-he-zalo-1" target="_blank" href="https://zalo.me/'.$common->lien_he_zalo.'" rel="nofollow" onclick="window.value='.$z.'" class="re"><span class="icon-zalo path1"><span class="path1"></span><span class="path2"></span></span></a><span class="aml-text-content aml-tooltiptext">Chat với chúng tôi qua Zalo</span></li>';
             $footer.='<li><a id="lien-he-fb" target="_blank" href="'.$common->lien_he_fb.'" rel="nofollow" onclick="window.value='.$m.'"><span class="icon-mess icon-messenger"></span></a><span class="aml-text-content aml-tooltiptext">Nhắn tin với chúng tôi qua Telegram</span></li>';
             $footer.='<li onclick="show_cart()"><a id="my-cart"><span class="icon-cartx icon-messenger re"><b class="notify" id="cart-2">0</b></span></a><span class="aml-text-content aml-tooltiptext">Giỏ hàng</span></li>';
        $footer.='</ul>';
    $footer.='</div>';
    if($type=="post"){
    $footer.='<div id="scrollTop" class="contactsx"><div class="rap-contanct">👉<a href="'.$post_infor->cate->url.'" class="contacktsx re" title="'.$post_infor->key_word.'">Xem thêm: '.$post_infor->key_word.'<span class="anime">1</span></a></div></div>';
    }
    $footer.='<div id="popup-cart" class="popup-cart"></div>';
    $footer.='<div id="check-kt" class="check-kt" onclick="hiden_check_kt()"></div>';
$footer.='</footer>';
?>