<body>
<?php echo $common->gg_header;?>
    <div id="root" style="overflow:hidden;">
       <?php echo $header; ?>
        <main class="main container">
            <div class="row" style=" padding-top: 16px; ">
                <div class="col-12 col-md-4">
                    <div>
                        <h2 style=" font-size: 16px; color: #4267b2; line-height: 30px; text-transform: uppercase; font-weight: bold; display: block; "> Thông tin đơn hàng</h2>
                    </div>
                    <div id="sp"></div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="ixxx">
                        <h2 style=" font-size: 16px; color: #4267b2; line-height: 30px; text-transform: uppercase; font-weight: bold; display: block; ">
                            Thông tin người nhận</h2>
                        <div class="danhdev-name">
                            <label for="billing_first_name" class="">Tên&nbsp;*<i id="note1" style="color:red;display:none;"> (Bạn điền thiếu thông tin này)*</i></label>
                            <span class="danhdev-input-name">
                                <input  type="text" class="input-text " name="billing_first_name" id="billing_first_name"
                                    placeholder="" value="" autocomplete="on"
                                    title="Có thể bạn chưa biết: Nhập tên chính xác giúp tỉ lệ đơn hàng vận chuyển thành công lên đến 95%.">
                            </span>
                        </div>
                        <div class="danhdev-phone">
                            <label for="billing_phone" class="">Số điện thoại&nbsp;*<i id="note2" style="color:red;display:none;"> (Bạn điền sai hoặc thiếu thông tin
                                    này)*</i></label>
                            <span class="danhdev-phone-input">
                                <input type="tel" class="input-text " name="billing_phone" id="billing_phone"
                                    placeholder="" value="" autocomplete="on"
                                    title="Nhân viên  Shop sẽ liên lạc qua số điện thoại của khách hàng để xác nhận đơn hàng.">
                            </span>
                        </div>

                        <div class="danhdev-address">
                            <label for="billing_address_1" class="">Địa chỉ&nbsp;*<span>(Vui lòng điền rõ địa chỉ để
                                    được nhận hàng nhanh hơn)<i id="note3" style="color:red;display:none;"> (Bạn điền
                                        thiếu thông tin này)*</i></span></label>
                            <span class="danhdev-address-input">
                                <input type="text" class="input-text " value="" autocomplete="on" id="billing_address_1"
                                    data-placeholder="Địa chỉ">
                            </span>
                        </div>
                        <div class="note-order">
                            <label for="order_comments" class="">Ghi chú đơn hàng&nbsp;<span class="optional">(tuỳ
                                    chọn)</span></label>
                            <span class="danhdev-note-order">
                                <textarea name="order_comments" class="input-text " id="order_comments"  autocomplete="on"
                                    placeholder="Ghi chú về đơn hàng, ví dụ: thời gian hay chỉ dẫn địa điểm giao hàng chi tiết hơn."
                                    rows="2" cols="5"></textarea>
                            </span>
                        </div>
                        <div class="danhdev-payment">
                            <div id="payment" class="woocommerce-checkout-payment">
                                <div class="button-dat-hang">
                                    <button id="tien-hanh-dat-hang" onclick="fs_buy()" 
                                        style="height:42px;margin-bottom: 20px;margin-top: 12px;">
                                        <span class="icon-cart-plus"
                                            style=" font-size: 16px; margin-right: 2px; "></span> Đặt Hàng
                                    </button>
                                </div>
                                <div id="test"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div id="rs"></div>

        </main>
        <?php echo $footer; ?>
    </div>
    <script src="<?php echo $home_url;?>/wp-content/themes/shopseo/templates/src/js.js"></script>
    <script src="<?php echo $home_url;?>/wp-content/themes/shopseo/templates/src/checkout.js"></script>
    <script type="text/javascript"> document.addEventListener('copy', function (e) { e.preventDefault(); }); document.addEventListener('contextmenu', function (e) { e.preventDefault(); }); </script>
</body>
