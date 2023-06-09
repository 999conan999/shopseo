<body>
    <?php echo $common->gg_header;?>
    <div id="root" style="overflow:hidden;">
    <?php echo $header; ?>
        <main class="mainz"  style="background-color: #f2f2f2;overflow-x: hidden;display: flex;flex-direction: column-reverse;padding-bottom: 24px;">
            <section class="contents container lock">
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
                <?php 
                    $i=0;$rs='';
                        foreach ($list_sp as $idx => $products) {
                            $s=','.$idx.',';
                            if(strpos($text_id, $s)===false&&$i<12){
                        $rs.='<li class="bv-cart col-6 col-md-4 col-xl-3 ">';
                        $rs.='<a class="a-bv" href="'.$products["url"].'" title="'.$products['title'].'" target="_blank" >';
                        $rs.='<img src="'.$products['thumnail']->url150.'" width="80px" height="80px">';
                        $rs.='<p style=" font-size: 12px;margin-bottom: 3px; ">'.$products['title'].'</p></a>';
                        $rs.='</li>';
                        }} 
                        if($rs!=''){
                        ?>
                <div class="sty">
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
    <script src="<?php echo $home_url;?>/wp-content/themes/shopseo/templates/src/js.js"></script>
    <script type="text/javascript"> document.addEventListener('copy', function (e) { e.preventDefault(); }); document.addEventListener('contextmenu', function (e) { e.preventDefault(); }); </script>
</body>