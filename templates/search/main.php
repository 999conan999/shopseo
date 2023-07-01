<body>
    <div id="root" style="overflow:hidden;">
       <?php echo $header; ?>
        <main class="mainz" style=" background-color: #ffffff; ">
            <section class="container gt1 wrapcontentHome">
                <div class="sty">
                    <div class="wrap-list">
                        <div class="lis-category">
                            <div class="header-cate re">
                                <h1 class="title-h3-1">Bài viết liên quan: <?php echo $search_text; ?></h1>
                            </div>
                            <div class="wza-home">
                                <ul class="cart-u row">
                                    <?php
                                        foreach($sp as $x){
                                    ?>
                                    <li class="bv-cart col-6 col-md-4 col-xl-3 ">
                                        <div class="a-bv dbl-block" >
                                            <img src="<?php echo $x->thumnail->url300; ?>" width="100%">
                                            <a href="<?php echo $x->url; ?>" title="<?php echo $x->title; ?>"><?php echo $x->title; ?></a>
                                            <p><?php echo $x->short_des; ?></p>
                                        </div>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <?php echo $footer; ?>
    </div>
    <script type="text/javascript">
    </script>
    <script src="<?php echo $home_url;?>/wp-content/themes/shopseo/templates/src/js.js"></script>
    <script type="text/javascript"> document.addEventListener('copy', function (e) { e.preventDefault(); }); document.addEventListener('contextmenu', function (e) { e.preventDefault(); }); </script>
</body>