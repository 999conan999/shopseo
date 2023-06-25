
<body>
    <div id="root" style="overflow:hidden;">
       <?php echo $header; ?>
       <main class="mainz"  style="background-color: #f2f2f2;overflow-x: hidden;display: flex;flex-direction: column-reverse;padding-bottom: 24px;">
            <section class="contents container lock">
                <h1 class="title"><?php echo $data->title; ?></h1>
                <div class="long-des">
                    <blockquote><p><?php echo $data->short_des; ?></p></blockquote>
                    <?php echo $data->long_des; ?>
                </div>
            </section>
            <section class="container gt1 wrapcontentHome lock">
                <h2 class="xuhms">Xu Hướng mua sắm</h2>
                <div class="row category-mn">
                   <?php echo $data->html_xu_huong; ?>
                </div>
                <?php
                    if($data->best_saller!=''){
                ?>
                <div class="sty">
                    <div class="wrap-list">
                        <div class="lis-category">
                            <div class="header-cate re">
                                <span class="icon-ff-1 icon-tt-1"></span>
                                <h3 class="title-h3-1">Sản phẩm bán chạy</h3>
                            </div>
                            <div class="wza-home">
                                <ul class="cart-w row">
                                    <?php echo $data->best_saller; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }
                    foreach($data->category_data_list as $x){
                        if($x->sp_html!=''){
                ?>
                <div class="sty">
                    <div class="wrap-list">
                        <div class="lis-category">
                            <div class="header-cate-2 re">
                                <span class="icon-ff-2 icon-tt-2"></span>
                                <h3 class="title-h3-2"><?php echo $x->name; ?></h3>
                                <a href="<?php echo $x->url; ?>" title="<?php echo $x->name; ?>" class="xem-them">Xem thêm</a>
                            </div>
                            <div class="wza-home">
                                <ul class="cart-w row">
                                    <?php echo $x->sp_html; ?>                                
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }}
                    if($data->new_post!=''){
                ?>
                <div class="sty">
                    <div class="wrap-list">
                        <div class="lis-category">
                            <div class="header-cate re">
                                <span class="icon-ff-1 icon-tt-1"></span>
                                <h3 class="title-h3-1">Bài viết mới nhất</h3>
                            </div>
                            <div class="wza-home">
                                <ul class="cart-u row">
                                    <?php echo $data->new_post;?>
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
