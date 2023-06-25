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
function disable_buy_btn(){
    document.getElementById("payment").style.visibility = "hidden";
}
// 
function fs_buy(){
    let vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
    let home_url = document.getElementById("footer").getAttribute("data");
    let name = document.getElementById("billing_first_name").value;
    let phone = document.getElementById("billing_phone").value;
    let address = document.getElementById("billing_address_1").value;
    let note = document.getElementById("order_comments").value;
    console.log("🚀 ~ file: checkout.js:99 ~ fs_buy ~ note:", note)
    if (name.length < 2) {
        alert('Bạn chưa điền "Tên*".');
        reset_noti();
        document.getElementById("note1").style.display = "block";
      } else if (vnf_regex.test(phone) == false) {
        alert('Số điện thoại không đúng!');
        reset_noti();
        document.getElementById("note2").style.display = "block";
      } else if (address.length<16) {
        alert("Địa chỉ quá ngắn, vận chuyển sẽ không tìm được nhà của bạn.");
        reset_noti();
        document.getElementById("note3").style.display = "block";
      } else {
        reset_noti();
        console.log("🚀 ~ file: checkout.js:93 ~ fs_buy ~ name:", name)
        console.log("🚀 ~ file: checkout.js:95 ~ fs_buy ~ phone:", phone)
        console.log("🚀 ~ file: checkout.js:97 ~ fs_buy ~ address:", address)
            
      }
}
// 
function reset_noti(){
    document.getElementById("note1").style.display = "none";
    document.getElementById("note2").style.display = "none";
    document.getElementById("note3").style.display = "none";
}