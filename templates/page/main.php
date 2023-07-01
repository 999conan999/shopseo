
<body>
    <?php echo $common->gg_header;?>
    <div id="root" style="overflow:hidden;">
       <?php echo $header; ?>
        <main class="mainz" style=" background-color: #f2f2f2; ">
            <div>
                <section class="contents container re" id="contents-dt">
                    <h1 class="title"><?php echo $post_infor->title?></h1>
                    <div id="long-des" class="long-des">
                        <blockquote class="link-dt"><?php echo $post_infor->short_des;?></blockquote>
                        <?php echo $post_infor->long_des?>
                    </div>
                </section>
            </div>
        </main>
        <?php echo $footer; ?>
    </div>
    <script type="text/javascript">
    </script>
    <script src="<?php echo $home_url;?>/wp-content/themes/shopseo/templates/src/js.js"></script>
    <script type="text/javascript"> document.addEventListener('copy', function (e) { e.preventDefault(); }); document.addEventListener('contextmenu', function (e) { e.preventDefault(); }); </script>
</body>
