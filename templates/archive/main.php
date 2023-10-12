<body>
    <?php echo $common->gg_header;?>
    <div id="root" style="overflow:hidden;">
    <?php echo $header; ?>
        <main class="mainz"  style="background-color: #f2f2f2;overflow-x: hidden;display: flex;flex-direction: column-reverse;padding-bottom: 24px;">
            <section class="contents container lock video-runing">
                <h1 class="title"><?php echo $data->title; ?></h1>
                <div class="long-des">
                    <blockquote>
                        <p><?php echo $data->short_des; ?></p>
                    </blockquote>
                    <?php echo $data->long_des; ?>
                </div>
            </section>
            <section class="container gt1 wrapcontentHome lock">
                <?php if(count($data->related_list)>0){ ?>
                <h2 class="xuhms">Xu Hướng mua sắm</h2>
                <div class="row category-mn">
                    <?php foreach($data->related_list as $x){ ?>
                    <div class="col-6 col-md-3 col-xl-2">
                        <a class="refz" href="<?php echo $x->url; ?>" title="<?php echo $x->name; ?>" target="_blank">
                            <img src="<?php echo $x->thumnail; ?>" width="64px" height="64px">
                            <p><?php echo $x->name; ?></p>
                        </a>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>
                <div class="sty">
                    <div class="wrap-list">
                        <?php 
                            $list_sp=$data->list_sp;
                            $text_id='';
                            $i=0;
                            foreach($data->dm as $x){
                                if(count($x->sp_list_id)){
                                $i++;
                                $id_url='id'.$i;
                        ?>
                        <div class="lis-category">
                            <div class="wraptt" onClick=navigator.clipboard.writeText("<?php echo $data->url.'#'.$id_url; ?>")>
                                <p id="<?php echo $id_url; ?>" class="title3z"><?php echo $x->name; ?></p>
                            </div>
                            <div class="wza">
                                <ul class="cart-w row dfer">
                                <?php 
                                    foreach($x->sp_list_id as $id_sp){
                                        if (isset($list_sp[$id_sp])) {
                                            $text_id.=','.$id_sp.',';
                                        $price_ins=(int)$list_sp[$id_sp]['price'];
                                        if($x->is_template_large){
// <div class="rating"><span class="xem-chi-tiet">>>Xem chi tiết</span><span class="star">Đã bán: <b>  echo $list_sp[$id_sp]['quantity_sold']; </b></span></div>
?>
<li class="lza col-12 col-md-4 col-xl-3"><a class="card-3" href="<?php echo $list_sp[$id_sp]['url']; ?>" title="<?php echo $list_sp[$id_sp]['title']; ?>" target="_blank">
        <div class="imgz-cart danhdev-product"><img class="zz lazyload" data-src="<?php echo $list_sp[$id_sp]['thumnail']->url; ?>" src="<?php echo $list_sp[$id_sp]['thumnail']->url300; ?>"  width="100%"></div>
        <h3><?php echo $list_sp[$id_sp]['title']; ?></h3>
        <div style=" padding-left: 8px; "><ins class="ins-cost costz"><?php echo number_format($price_ins, 0, ".", ".");?> đ</ins></div><div class="rating">
       <?php if((int)$list_sp[$id_sp]['quantity_sold']>0){ ?>                                     
        <span class="star">Đã bán: <b><?php echo $list_sp[$id_sp]['quantity_sold']; ?></b></span>
        <?php } ?>
    </div>
    </a>
</li>
<?php
                                        }else{
                                            echo '<li class="lza col-6 col-md-3 col-xl-2 lza-home"><a class="card-3 card-3-home" href="'.$list_sp[$id_sp]['url'].'" title="'.$list_sp[$id_sp]['title'].'" target="_blank"><div class="imgz-cart danhdev-product"><img class="zz lazyload" data-src="'.$list_sp[$id_sp]['thumnail']->url.'" src="'.$list_sp[$id_sp]['thumnail']->url300.'"></div><p style=" font-size: 12px;margin-bottom: 3px; ">'.$list_sp[$id_sp]['title'].'</p><div style=" padding-left: 8px;padding-bottom: 10px; "><ins style=" font-size: 14px; " class="ins-cost costz">'.number_format($price_ins, 0, ".", ".").' đ</ins></div><div class="rating" style=" position: absolute; right: 0px; bottom: -3px; "><span class="star" style=" font-size: 12px; ">Đã bán: <b>'.$list_sp[$id_sp]['quantity_sold'].'</b></span></div></a></li>';
                                        }
                                }} ?>
                                </ul>
                            </div>
                        </div>
                        <?php }} ?>
                    </div>
                </div>
                <!-- video -->
                <?php if($is_tiktok){ ?>
                <div class="splide" id="vertical-slider">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php 
                                $i=0;
                                foreach($data_tiktok as $video){
                                    $priceVideo=($video->price)>0?number_format($video->price, 0, ".", ".")." đ":"Liên hệ";
                            ?>
                            <li class="splide__slide">
                                <div class="item-video">
                                    <?php if (strpos($video->url, '.mp4') !== false) { ?>
                                    <video class="var-video cs-video" width="100%" <?php echo $i==0?"src":"data-src"; ?>="<?php echo $video->url; ?>" onclick="fs_play_index(<?php echo $i; ?>)"></video>
                                    <div class="centered-image" id="play-<?php echo $i; ?>"  onclick="fs_play_index(<?php echo $i; ?>)">
                                        <img src="<?php echo $home_url;?>/wp-content/themes/shopseo/templates/src/play.png" class="play-icon">
                                    </div>
                                    <?php }else{ ?>
                                        <img  <?php echo $i==0?"src":"data-src"; ?>="<?php echo $video->url; ?>" width="100%" class="var-video cs-video">
                                    <?php } ?>
                                    <div class="up-wrap" onclick="fs_scroll_top()">
                                        <img src="<?php echo $home_url;?>/wp-content/themes/shopseo/templates/src/up-icon.png" width="50px">
                                        <div>Lên trên</div>
                                    </div>
                                    <span class="contact-video shadz">Zalo: <?php echo $formattedPhoneNumber; ?></span>
                                    <span class="title-video shadz"><?php echo $video->title; ?></span>
                                    <div class="price-video shadz">Giá: <b><?php echo $priceVideo; ?></b></div>
                                    <?php  if($video->sold_out>0){ ?>
                                    <div class="sold-video shadz price-video">đã bán: <b><?php echo $video->sold_out; ?></b></div>
                                    <?php } ?>
                                    <span class="mxid">Mã: <?php echo $id; ?>X<?php echo $i+1; ?></span>
                                    <div class="menu-video">
                                        <a target="_blank" href="https://zalo.me/<?php echo $common->lien_he_zalo?>" rel="nofollow">
                                            <div class="re">
                                                <img src="<?php echo $home_url;?>/wp-content/themes/shopseo/templates/src/zalo.png" width="72px">
                                            </div>
                                            <div class="re">
                                                <img class="abs" style="right:14px;top:14px" src="<?php echo $home_url;?>/wp-content/themes/shopseo/templates/src/heart.png" width="39px">
                                                <span class="abs numx" style="right:14px;top:52px"><?php echo round((rand(11, 350) / 10), 1); ?>k</span>
                                                <img class="abs" style="right:12px;top:95px" src="<?php echo $home_url;?>/wp-content/themes/shopseo/templates/src/chat.png" width="39px">
                                                <span class="abs numx" style="right:17px;top:135px"><?php echo rand(400, 990); ?></span>
                                                <img class="abs" style="right:12px;top:167px" src="<?php echo $home_url;?>/wp-content/themes/shopseo/templates/src/share.png" width="39px">
                                                <span class="abs numx" style="right:17px;top:203px"><?php echo rand(0, 400); ?></span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>      
                            <?php 
                                $i++;
                            } 
                            ?>
                        </ul> 
                    </div>

                </div>
                <?php } ?>
                <!-- endvideo  -->
                <?php 
                    $i=0;$rs='';
                        foreach ($list_sp as $idx => $products) {
                            $s=','.$idx.',';
                            if(strpos($text_id, $s)===false&&$i<16){
                                $i++;
                        $rs.='<li class="bv-cart col-6 col-md-4 col-xl-3 ">';
                        $rs.='<a class="a-bv" href="'.$products["url"].'" title="'.$products['title'].'" target="_blank" >';
                        $rs.='<img src="'.$products['thumnail']->url150.'" width="80px" height="80px">';
                        $rs.='<p style=" font-size: 12px;margin-bottom: 3px; ">'.$products['title'].'</p></a>';
                        $rs.='</li>';
                        } elseif ($i >= 16) {
                            break;
                        }
                    } 
                    if($rs!=''){
                ?>
                <div class="sty video-runing">
                    <div class="wrap-list">
                        <div class="lis-category">
                            <div class="header-cate re">
                                <span class="icon-ff-1 icon-tt-1" style=" top: 6px; "></span>
                                <h3 class="title-h3-1">Bài viết liên quan</h3>
                            </div>
                            <div class="wza-home">
                                <ul class="cart-u row">
                                    <?php echo $rs;?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </section>
        </main>
    <?php echo $footer; ?>
    </div>
    <?php if($is_tiktok){ ?>
    <script src="<?php echo $home_url;?>/wp-content/themes/shopseo/templates/src/jquery.js"></script>
    <script src="<?php echo $home_url;?>/wp-content/themes/shopseo/templates/src/splide.min.js"></script>
    <?php } ?>
    <script src="<?php echo $home_url;?>/wp-content/themes/shopseo/templates/src/js.js"></script>
    <script type="text/javascript"> document.addEventListener('copy', function (e) { e.preventDefault(); }); document.addEventListener('contextmenu', function (e) { e.preventDefault(); }); </script>
</body>