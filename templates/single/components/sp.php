<?php
    // $index_price=$post_infor->index_price;
    // if (is_object($post_infor) && property_exists($post_infor, 'att')) {
    //     $att=$post_infor->att;
    //     $price_ins=((int)$att->table_price[$index_price]->price_v+(int)$att->table_price[$index_price]->price_profit);
    //     $price_del=$price_ins+(int)$att->table_price[$index_price]->price_og;
    // }else{
    //     $att = new stdClass();
    //     $att->title="";
    //     $att->price_ss=50000;
    //     $att->attribute_name='Loại';
    //     $att->is_show_price_table=false;
    //     $att->is_show_infor=false;
    //     $att->is_show_commit=false;
    //     $price_ins=0;
    //     $price_del=0;
    // }
    // $table_price=array();
?>
<section class="container gt1 wrapcontentHome lock" style=" min-height: 545px; ">
    <nav class="woocommerce-breadcrumb breadcrumbs">
        <a href="<?php echo $home_url?>" title="Trang chủ <?php echo $home_name;?>">Trang chủ</a>
        <span>/</span>
        <a href="<?php echo $post_infor->cate->url;?>" title="<?php echo $post_infor->cate->title;?>"><?php echo $post_infor->cate->title;?></a>
    </nav>
    <div class="row wr-dt-slide">
        <div class="col-sm-12 dev-4 col-md-4">
            <?php  if(count($post_infor->img_sp->imgs_list)>0){ ?>
            <div>
                <div class="product owl-carousel slideProduct">
                    <?php 
                        $i=0;
                        $small_img_html='';
                        foreach ($post_infor->img_sp->imgs_list as $x){
                            $i++;
                            $pos = strpos($x->url, '.gif');
                            $pos2 = strpos($x->url, '.mp4');
                            if($pos||$pos2) $x->url300= $home_url.'/wp-content/themes/shopseo/templates/src/media/video-thumnail.jpg';
                            if($i==1){
                                $small_img_html.='<div> <div class="item select"><a class="clear-e" href="'.$x->url.'" title="'.$post_infor->title." ".$i.'"><img src="'.$x->url300.'" alt="'.$post_infor->title.' '.$i.'" title="'.$post_infor->title.' '.$i.'" class="d-block w-100" /></a> </div> </div>';
                            }else{
                                $small_img_html.='<div> <div class="item"><a class="clear-e" href="'.$x->url.'" title="'.$post_infor->title." ".$i.'"><img src="'.$x->url300.'" alt="'.$post_infor->title." ".$i.'" title="'.$post_infor->title.' '.$i.'" class="d-block w-100" /></a> </div> </div>'; 
                            }
                    ?>
                    <div class="item <?php echo $pos2?"":"imgz-cart get-img"; ?>">
                        <?php if($pos2){ ?>
                            <div class="lazy-video" data-src="<?php echo $x->url; ?>"></div>
                        <?php }else{?>
                            <img class="owl-lazy" data-src="<?php echo $x->url; ?>" src="<?php echo $x->url300; ?>" alt="<?php echo $post_infor->title.' '.$i; ?>" />
                            <?php if(!property_exists($x, 'is_show_buy')||$x->is_show_buy==true){ ?>
                            <div class="w-btn-mua"><button class="btn-mua" onclick="set_kt('<?php echo $x->url; ?>')"><span class="icon-cartx"></span>Mua ngay!</button></div>
                            <?php }?>
                            <span class="msp">Mã:<?php echo $id; ?>X<?php echo $i; ?></span>
                        <?php }?>
                    </div>
                    <?php }?>
                </div>
                <div class="product owl-carousel dot slideProduct-dot">
                    <?php echo $small_img_html;?>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="col-sm-12 dev-8 col-md-8">
            <span class="title-dt" id="get-tt"><?php echo $post_infor->title?></span>
            <div class="re rv">
                <span class="rating__stars" style="--rating: 5;"></span>
                <?php if($post_infor->comments->html!=""){ ?>
                <a href="#nhan-xet" class="danh-gia">(Xem <?php echo rand(55, 199); ?> lượt đánh giá)</a>
                <?php } ?>
            </div>
            <div class="price">
                <p class="danh-price"><span class="fxt">Giá mua :</span> <ins class="txt-price-alt" id="gia-mua"><?php echo number_format($price_ins, 0, ".", ".");?> ₫ </ins></p>
                <?php if($price_del>$price_ins){ ?>
                <p id="wr-price" class="danh-price"><span class="fxt">Giá cũ :</span>
                    <del class="txt-price-alt" id="gia-cu"><?php echo number_format($price_del, 0, ".", ".");?> ₫ </del>
                </p>
                <?php } ?>
            </div>
            <?php if (is_object($att) && property_exists($att, 'is_show_price_table')) { ?>
            <?php if ($att->is_show_price_table) { ?>

            <div class="table-price">
                <span>Bảng giá:</span>
                <table class="table-dt" border="1">
                    <thead>
                        <tr>
                            <th scope="col"><?php echo $att->attribute_name; ?></th>
                            <th scope="col">Giá gốc</th>
                            <th scope="col">Giá khuyến mãi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($att->table_price as $x){
                                $price_ins=((int)$x->price_v+(int)$x->price_profit);
                                $price_del=($price_ins+(int)$x->price_og);
                                $obj=new stdClass();
                                $obj->kt=$x->name;
                                $obj->price_og=$price_del;
                                $obj->price_sale=$price_ins;
                                array_push($table_price,$obj);
                        ?>
                        <tr>
                            <td><?php echo $x->name; ?></td>
                            <td>
                                <?php if($price_del>$price_ins){ ?>
                                <del class="txt-price-alt"><?php echo number_format($price_del, 0, ".", ".");?>đ</del>
                                <?php } ?>
                            </td>
                            <td><strong><?php echo number_format($price_ins, 0, ".", ".");?>đ</strong></td>
                        </tr>
                        <?php        
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php }} ?>
            <?php if (is_object($att) && property_exists($att, 'is_show_infor')) { ?>
            <?php if ($att->is_show_infor) { ?>
            <div class="table-ct">
                <span id="thong-so-ki-thuat">Thông số kĩ thuật :</span>
                <table class="st-pd-table">
                    <tbody>
                        <?php
                            foreach ($att->table_infor as $x){
                        ?>
                        <tr>
                            <td><?php echo $x->name; ?></td>
                            <td><?php echo $x->value; ?></td>
                        </tr>
                        <?php        
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php }} ?>
        </div>
    </div>
    <div id="khuyen-mai" class="row">
        <?php if(count($post_infor->related_links)>0){ ?>
        <div class="col-sm-12 col-md-8 card-dr">
            <span class="xuhms xu-huong">Xu Hướng mua sắm</span>
            <div class="row category-mn bgr-dt">
            <?php
                foreach ($post_infor->related_links as $x){
            ?>
                <div class="col-6 col-md-3">
                    <a class="refz" href="<?php echo $x->url; ?>" title="<?php echo $x->name; ?>">
                        <img src="<?php echo $x->thumnail; ?>" width="64px" height="64px">
                        <p><?php echo $x->name; ?></p>
                    </a>
                </div>
            <?php        
                }
            ?>
            </div>
        </div>
        <?php } ?>
    </div>
    <div id="show-img" class="row imgs-slide"></div>
</section>