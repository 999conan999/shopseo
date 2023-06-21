
<body>
    <div id="root" style="overflow:hidden;">
       <?php echo $header; ?>
        <main class="mainz" style=" background-color: #f2f2f2; ">
            <div>
                <section class="contents container re" id="contents-dt">
                    <h1 class="title"><?php echo $post_infor->title?></h1>
                    <div id="long-des" class="long-des" style="height: 200px;">
                        <blockquote class="link-dt"><?php echo $post_infor->short_des;?></blockquote>
                        <?php echo $post_infor->long_des?>
                        <?php if(count($post_infor->related_keyword->rs_obj)>0){ ?>
                        <h3>Bài viết liên quan:</h3>
                        <ul>
                            <?php 
                                 foreach ($post_infor->related_keyword->rs_obj as $x){
                            ?>
                                <li><a href="<?php echo $x->url ?>" title="<?php echo $x->text; ?>"><?php echo $x->text; ?></a></li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    </div>
                    <div class="see-more" id="see-more" style="background-image: linear-gradient(rgba(255, 255, 255, 0), rgb(255, 255, 255));"><button id="btn-more" onclick="set_more()">Xem thêm</button></div>
                </section>
                <!-- <section class="wrapz-bl container ">
                    <h3 class="h6 heading re">Bình luận:<span class="rating__stars blx" style="--rating: 5;"></span>
                    </h3>
                    <div class="wrap-vbl">
                        <div class="blxx">
                            <b class="vietBinhLuan">Viết bình luận:</b>
                        </div>
                        <div class="wpc">
                            <div class="write-cm">
                                <div id="write_comment_input_quB0ntJS" class="row" style="padding: 5px;">
                                    <div class="col-12">
                                        <textarea id="rs_comment_quB0ntJS" cols="45" rows="3" class="text-cm"
                                            minlength="10" required=""
                                            placeholder="Mời bạn chia sẻ thêm một số cảm nhận..."
                                            aria-required="true"></textarea>
                                    </div>
                                    <div class="col-6">
                                        <input id="author_quB0ntJS" class="dot" type="text" value="" size="30"
                                            autocomplete="off" required="" placeholder="Họ tên (bắt buộc)"
                                            aria-required="true">
                                    </div>
                                    <div class="col-6 op">
                                        <input id="phone_quB0ntJS" class="dot" type="number" value="" size="30"
                                            autocomplete="off" required="" placeholder="Số điện thoại (bắt buộc)"
                                            aria-required="true">
                                    </div>
                                    <div class="col-12 re">
                                        <button class="sendbl" data="quB0ntJS"
                                            url_ref="https://anbinhnew.com/shop/giuong-sat/?dm=npJg&amp;dt=huHftm#id_1">Gửi
                                            bình luận</button>
                                        <div class="canlex">
                                            <span>Hủy</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <b class="vietBinhLuan" data="quB0ntJS" id="vbl_quB0ntJS" style="display: none;">Viết bình
                                luận:</b>
                        </div>
                    </div>
                    <div class="comment">
                        <div class="w1"> <b>Văn Nam</b><img style="margin-left: 12px; " class="luna"
                                src="./media/check.png"><i>Đã
                                mua tại anbinhnew.com</i>
                            <p>Sản phẩm chắc chắn, đẹp, giao hàng nhanh, giá tốt, hài lòng nè</p>
                            <div class="w-img-com row">
                                <div class="dev-3 pdr-3">
                                    <img class="img-com"
                                        src="https://anbinhnew.com/wp-content/uploads/2023/04/giuong-mi-thuat-5.jpg"
                                        width="100%">
                                </div>
                                <div class="dev-3 pdr-3">
                                    <img class="img-com"
                                        src="https://anbinhnew.com/wp-content/uploads/2023/04/giuong-mi-thuat-5.jpg"
                                        width="100%">
                                </div>
                                <div class="dev-3 pdr-3">
                                    <img class="img-com"
                                        src="https://anbinhnew.com/wp-content/uploads/2023/04/giuong-mi-thuat-5.jpg"
                                        width="100%">
                                </div>
                            </div>
                            <span class="rep">Trả lời</span>
                            <div class="w1 w2"> <b>Shop</b>
                                <p>Cảm ơn đã sử dụng dịch vụ của chúng tôi!</p>
                            </div>
                        </div>
                        <div class="w1"> <b>Văn Nam</b><img style="margin-left: 12px; " class="luna"
                                src="./media/check.png"><i>Đã
                                mua tại anbinhnew.com</i>
                            <p>Sản phẩm chắc chắn, đẹp, giao hàng nhanh, giá tốt, hài lòng nè</p>
                            <div class="w-img-com row">
                                <div class="dev-3 pdr-3">
                                    <img class="img-com"
                                        src="https://anbinhnew.com/wp-content/uploads/2023/04/giuong-mi-thuat-5.jpg"
                                        width="100%">
                                </div>
                                <div class="dev-3 pdr-3">
                                    <img class="img-com"
                                        src="https://anbinhnew.com/wp-content/uploads/2023/04/giuong-mi-thuat-5.jpg"
                                        width="100%">
                                </div>
                                <div class="dev-3 pdr-3">
                                    <img class="img-com"
                                        src="https://anbinhnew.com/wp-content/uploads/2023/04/giuong-mi-thuat-5.jpg"
                                        width="100%">
                                </div>
                            </div>
                            <span class="rep">Trả lời</span>
                            <div class="w1 w2"> <b>Shop</b>
                                <p>Cảm ơn đã sử dụng dịch vụ của chúng tôi!</p>
                            </div>
                        </div>
                    </div>
                </section> -->
            </div>
            <?php 
                if($post_infor->type!="bv"){
                    require_once(get_stylesheet_directory().'/templates/single/components/sp.php');
                }
            ?>
        </main>
        <?php echo $footer; ?>
    </div>
    <script type="text/javascript">
        document.getElementById("contents-dt").style.display = "block";
        document.getElementById("footerz-dt").style.display = "block";
        <?php if($post_infor->type!="bv"){?>
        <?php
            $obj=new stdClass();
            $obj->id=$id;
            $obj->attribute_name=$att->attribute_name;
            $obj->table_price=$table_price;
            $obj->cam_ket=$att->table_commit;
            $obj->khuyen_mai=$post_infor->notify->long_text;
            echo 'window.data='.(json_encode($obj));
        ?>

        // window.data = {
        //     id: 0,
        //     attribute_name: 'Kích thước',
        //     table_price: [
        //         {
        //             kt: '1mx2m',
        //             price_og: '1350000',
        //             price_sale: '1250000'
        //         },
        //         {
        //             kt: '1m2x2m',
        //             price_og: '1550000',
        //             price_sale: '1350000'
        //         },
        //         {
        //             kt: '1m4x2m',
        //             price_og: '1650000',
        //             price_sale: '1450000'
        //         },
        //         {
        //             kt: '1m6x2m',
        //             price_og: '1750000',
        //             price_sale: '1550000'
        //         },
        //         {
        //             kt: '1m8x2m',
        //             price_og: '1850000',
        //             price_sale: '1650000'
        //         },
        //         {
        //             kt: '2mx2m',
        //             price_og: '1950000',
        //             price_sale: '1750000'
        //         },
        //     ],
        //     cam_ket:[
        //         'Sản phẩm cam kết chính hãng',
        //         'Bảo hành 12 tháng',
        //         'Đổi mới trong vòng 7 ngày',
        //         'Bảo hành qua tem sản phẩm hoặc hóa đơn thanh toán',
        //     ],
        //     khuyen_mai:'<p>Giảm giá 30% cho khách hàng mua giường kèm nệm tại: <a href="#12" target="_blank" rel="noopener"><strong>Giường giá rẻ</strong></a>.</p> <p><span style="color: rgb(186, 55, 42);"><strong>Tặng</strong></span> ngay <span style="color: rgb(186, 55, 42);"><strong>1 đèn học</strong></span> cho bé khi mua combo bàn học và ghế.</p> <p>Miễn phí vận chuyển cho khách hàng tại khu vực Hồ Chí Minh.</p>'
        // };
        <?php }?>
    </script>
    <script src="<?php echo $home_url;?>/wp-content/themes/shopseo/templates/src/jquery.js"></script>
    <script src="<?php echo $home_url;?>/wp-content/themes/shopseo/templates/src/js.js"></script>
    <script src="<?php echo $home_url;?>/wp-content/themes/shopseo/templates/src/js-sp.js"></script>

    <!-- <script type="text/javascript"> document.addEventListener('copy', function (e) { e.preventDefault(); }); document.addEventListener('contextmenu', function (e) { e.preventDefault(); }); </script> -->
</body>
