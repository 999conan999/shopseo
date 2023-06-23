
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
                <section id="nhan-xet" class="wrapz-bl container ">
                    <h3 class="h6 heading re">Bình luận:<span class="rating__stars blx" style="--rating: 5;"></span>
                    </h3>
                    <div class="wrap-vbl">
                        <div class="blxx">
                            <b  class="vietBinhLuan" onclick="show_input_com()">Viết bình luận:</b>
                        </div>
                        <div id="writecom" data="<?php echo $home_url; ?>" value="<?php echo $comments_id; ?>" class="wpc" style="height:0px;overflow:hidden;"></div>
                    </div>
                    <div class="comment re" id="comments">
                        <?php echo $post_infor->comments->html; ?>
                        <?php if($post_infor->comments->status){ ?>
                        <div class="see-more" id="morex" style="background-image: linear-gradient(rgba(255, 255, 255, 0), rgb(255, 255, 255))"><button id="btn-more" onclick="set_more_bl()">Xem thêm bình luận</button></div>
                        <?php } ?>
                    </div>
                </section>
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
        <?php }?>
    </script>
    <script src="<?php echo $home_url;?>/wp-content/themes/shopseo/templates/src/jquery.js"></script>
    <script src="<?php echo $home_url;?>/wp-content/themes/shopseo/templates/src/js.js"></script>
    <script src="<?php echo $home_url;?>/wp-content/themes/shopseo/templates/src/js-sp.js"></script>

    <!-- <script type="text/javascript"> document.addEventListener('copy', function (e) { e.preventDefault(); }); document.addEventListener('contextmenu', function (e) { e.preventDefault(); }); </script> -->
</body>
