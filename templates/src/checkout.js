render_sp_list()
// 
function render_sp_list(){
    let data_carts=localStorage.getItem("order_carts");
    let rs_item_list='';
    let total_price=0;
    if(data_carts==null){
        htmlContent=`<div style=" text-align: center; color: tomato; "><span>Chưa có sản phẩm.</span></div>`;
        disable_buy_btn()
    }else{
        data_carts=JSON.parse(data_carts);
        console.log("🚀 ~ file: checkout.js:13 ~ render_sp_list ~ data_carts:", data_carts)
        if(data_carts.length>0){
            data_carts.forEach((e,i) => {
                total_price+=Number(e.price_sale)*Number(e.sl);
                rs_item_list+=`<div style="box-shadow: 0 1px 3px rgba(0,0,0,0.2), 0 1px 1px rgba(0,0,0,0.14), 0 2px 1px -1px rgba(0,0,0,0.12);background: #e8eaf6!important;padding: 12px 5px 0px 2px;margin-top: 5px;margin-bottom: 8px;border: 0.5px solid #9e9797;">
                <div style=" padding-bottom: 10px; border-bottom: dotted 0.5px #d4cdcd; margin-bottom: 10px; ">
                    <div class="item" style=" display: flex; ">
                        <div class="img-small" style=" width: 60px; height: 60px; overflow: hidden; margin-left: 2px; display: inline-block; ">
                            <img id="thum" style=" width: 100%; " src="${e.img}">
                        </div>
                        <div id="titlez" class="titlezz" style=" display: inline-block; width: 100%; margin-left: 2px; ">
                        <a href="${e.url}"><span>${e.title}</span></a> - <span style="font-weight: 900;color: royalblue;">${e.kt}</span> - <span style="font-weight: 600;color: green;"> ${Number(e.price_sale).toLocaleString('vi-VN', {style : 'currency', currency : 'VND'})}</span>
                        </div>
                    </div>
                    <div class="sl re">
                        <div style=" margin: auto; display: table;padding: 2px; ">
                            <button onclick="fs_tru(${i})" class="tru mouse-pointer" style="padding: 0px 9px;font-size: 17px;font-weight: 600;background-color: #da5454;border-radius: 5px;color: white;cursor: pointer;border: none;">-
                            </button><span id="num" class="num" style=" padding: 0px 20px; ">${e.sl}</span>
                            <button onclick="fs_cong(${i})" class="cong mouse-pointer" style="padding: 0px 9px;font-size: 17px;font-weight: 600;background-color: #da5454;border-radius: 5px;color: white;cursor: pointer;border: none;">+</button>
                        </div>
                        <div class="delte" onclick="fs_xoa(${i})"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="16" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64s14.3 32 32 32h384c17.7 0 32-14.3 32-32s-14.3-32-32-32h-96l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32l21.2 339c1.6 25.3 22.6 45 47.9 45h245.8c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></div>
                    </div>
                </div>
            </div>`
            });
            htmlContent=rs_item_list+`<div id="tong-tien" class="tong-tien">
            <p style="text-align: center;margin-bottom: 14px;">
                <span style="font-weight: 600;">Tổng tiền : </span>
                <span id="sump" style=" color: blue; font-weight: 700; ">${Number(total_price).toLocaleString('vi-VN', {style : 'currency', currency : 'VND'})}</span>
            </p>
        </div>`
            
        }else{
            htmlContent=`<div style=" text-align: center; color: tomato; "><span>Chưa có sản phẩm.</span></div>`;
            disable_buy_btn()
        }
        document.getElementById("sp").innerHTML = htmlContent;
    }
}
//
function fs_tru(i){
    let data_carts=localStorage.getItem("order_carts");
    if(data_carts!=null){
        data_carts=JSON.parse(data_carts);
        let sl=Number(data_carts[i].sl);
        if(sl>1){
            data_carts[i].sl=sl-1;
            localStorage.setItem("order_carts", JSON.stringify(data_carts));
            render_sp_list();
        }
    } 
}
function fs_cong(i){
    let data_carts=localStorage.getItem("order_carts");
    if(data_carts!=null){
        data_carts=JSON.parse(data_carts);
        let sl=Number(data_carts[i].sl);
        data_carts[i].sl=sl+1;
        localStorage.setItem("order_carts", JSON.stringify(data_carts));
        render_sp_list();
    } 
}
function fs_xoa(i){
    let data_carts=localStorage.getItem("order_carts");
    if(data_carts!=null){
        if(window.confirm("Xác nhận xóa!")){
        data_carts=JSON.parse(data_carts);
        data_carts.splice(i,1)
        localStorage.setItem("order_carts", JSON.stringify(data_carts));
        render_sp_list()
        update_count_cart()
        }
    }  
}
function fs_clear_order(){
    localStorage.setItem("order_carts", JSON.stringify([]));
}
function disable_buy_btn(){
    document.getElementById("payment").style.visibility = "hidden";
}
// 
function fs_buy(){
    let vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
    let home_url = document.getElementById("footer").getAttribute("data");
    let name_buyer = document.getElementById("billing_first_name").value;
    let phone = document.getElementById("billing_phone").value;
    let address_1 = document.getElementById("billing_address_1").value;
    let note = document.getElementById("order_comments").value;
    if (name_buyer.length < 2) {
        alert('Bạn chưa điền "Tên*".');
        reset_noti();
        document.getElementById("note1").style.display = "block";
      } else if (vnf_regex.test(phone) == false) {
        alert('Số điện thoại không đúng!');
        reset_noti();
        document.getElementById("note2").style.display = "block";
      } else if (address_1.length<16) {
        alert("Địa chỉ quá ngắn, vận chuyển sẽ không tìm được nhà của bạn.");
        reset_noti();
        document.getElementById("note3").style.display = "block";
      } else {
        reset_noti();
        let data_carts=localStorage.getItem("order_carts");
        if(data_carts==null){
            alert("Bạn chưa chọn sản phẩm!")
            window.location.assign("../");
        }else{
            data_carts=JSON.parse(data_carts);
            if(data_carts.length>0){
                //
                url=home_url+'/wp-content/themes/shopseo/templates/ajax/orders/add_order.php';
                url_tele=home_url+'/wp-content/themes/shopseo/templates/ajax/orders/telegram.php';
                let data_send=new FormData();
                data_send.append('note',note);
                data_send.append('address_1',address_1);
                data_send.append('phone',phone);
                data_send.append('name_buyer',name_buyer);
                data_send.append('data_carts',JSON.stringify(data_carts));
                render_result('loading');
                fetch(url, {
                method: "POST",
                body:data_send
                })
                .then(response => response.json())
                .then(a => {
                    if(a.status){
                        render_result('ok',data_carts);
                        fs_clear_order();
                    }else{
                        render_result("");
                        alert("Lỗi, không gửi được bình luận.")
                    }
                })
                .catch(error => {
                    console.error(error);
                    render_result("");
                });
                fetch(url_tele, {method: "POST",body:data_send})
                
            }else{
                alert("Bạn chưa chọn sản phẩm!")
                window.location.assign("../");  
            }
        }

        
      }
}
// 
function reset_noti(){
    document.getElementById("note1").style.display = "none";
    document.getElementById("note2").style.display = "none";
    document.getElementById("note3").style.display = "none";
}
//
function render_result(type,data_carts=[]){
    html='';
    if(type=="loading"){
        html=`<div style="position: fixed;width: 100%;height: 100%;background-color: #0e0e0ed6;top: 0px;left: 0px;z-index: 99;padding-left: 40%;padding-top: 40vh;">
        <div class="load-wrapp">
            <div class="load-6">
                <div class="letter-holder">
                    <div class="l-1 letter">L</div>
                    <div class="l-2 letter">o</div>
                    <div class="l-3 letter">a</div>
                    <div class="l-4 letter">d</div>
                    <div class="l-5 letter">i</div>
                    <div class="l-6 letter">n</div>
                    <div class="l-7 letter">g</div>
                    <div class="l-8 letter">.</div>
                    <div class="l-9 letter">.</div>
                    <div class="l-10 letter">.</div>
                </div>
            </div>
        </div>
    </div>`
    }
    if(type=="ok"){
        let list_sp_html='';
        let home_url = document.getElementById("footer").getAttribute("data");
        let name_buyer = document.getElementById("billing_first_name").value;
        let phone = document.getElementById("billing_phone").value;
        let address_1 = document.getElementById("billing_address_1").value;
        let note = document.getElementById("order_comments").value;
        let total_price=0;
        data_carts.forEach(e => {
            total_price+=(Number(e.price_sale)*Number(e.sl));
            list_sp_html+=`<tr><td><span style="color: #333;">${e.title} - <b>${e.kt}</b></span></td> <td>${Number(e.price_sale).toLocaleString('vi-VN', {style : 'currency', currency : 'VND'})}</td> <td>${e.sl}</td> <td>${(Number(e.price_sale)*Number(e.sl)).toLocaleString('vi-VN', {style : 'currency', currency : 'VND'})}</td></tr>`
        });
        html=`<div style=" overflow-y: scroll;position: fixed; width: 100%; height: 100%; background-color: #0e0e0ed6; top: 0px; left: 0px; z-index: 99;">
        <div class="container">
            <div class="row" style=" margin: 40px -8px; ">
                <div class="wrap-pp col-sm-8 col-md-6 col-lg-7">
                    <div class="header-pp">
                        <div class="check">
                            <svg class="icon-check" style="margin: auto;font-size: 70px;fill: #33a938;"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path
                                    d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z" />
                            </svg>
                            
                        </div>
                        <div>
                            <p style="
                                font-size: 22px; margin-top: 12px; font-weight: 600; margin-left:
                                12px; ">Đặt Hàng Thành Công!</p>
                        </div>
                    </div>
                    <div class=" body-pp">
                        <p style=" text-align: left; margin-bottom: 8px; color: currentColor; ">Thông tin đơn hàng :</p>
                        <table style=" border-collapse: collapse; width: 100%; ">
                            <tbody>
                                <tr style=" background-color: burlywood; ">
                                    <th>Tên sản phẩm</th>
                                    <th>Giá thành</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                                ${list_sp_html}
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td style=" font-weight: 600; ">Tổng tiền: </td>
                                    <td id="sum-price" style="font-weight: 600; color: blue;">${Number(total_price).toLocaleString('vi-VN', {style : 'currency', currency : 'VND'})}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div id="guess"><p style=" text-align: left; margin-bottom: 8px; color: currentColor;margin-top: 6px;"> Thông tin người nhận :</p> <p style="text-align: left;margin-bottom: 8px;color: currentColor;margin-top: 6px;"> Tên : <b>${name_buyer}</b></p> <p style="text-align: left;margin-bottom: 8px;color: currentColor;margin-top: 6px;"> Địa chỉ : <b>${address_1}</b></p> <p style="text-align: left;margin-bottom: 8px;color: currentColor;margin-top: 6px;"> Số điện thoại : <b>${phone}</b></p> <p style="text-align: left;margin-bottom: 8px;color: currentColor;margin-top: 6px;"> Ghi chú : <b>${note}</b></p></div>
                    </div>
                    <div class="footer-pp"><a id="backz" href="${home_url}">
                            <p class="bnt-home"
                                style=" margin: auto; width: 162px; padding: 14px; border: 1px solid green; border-radius: 10px; font-size: 15px; font-weight: 600; color: green; ">
                                Quay lại trang chủ</p>
                        </a></div>
                </div>
            </div>
        </div>
    </div>`;
    console.log("🚀 ~ file: checkout.js:183 ~ render_result ~ total_price:", total_price)

    }

    document.getElementById("rs").innerHTML = html;
}