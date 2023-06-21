//  menu
document.getElementById("menu-mb").addEventListener("click", () => { 
    document.getElementById("set-menu").classList.remove("hide-menu");
    document.getElementById("set-menu").classList.add("show-menu");
 });
try{
    let ww = document.getElementsByClassName("danhdev-product")[0].offsetWidth;
    var imgElements = document.querySelectorAll(".zz");
    imgElements.forEach(e => {
        e.style.height = (ww - 2) + "px";
    });
    let wz = document.getElementById("cccx").offsetWidth;
    var uu = document.getElementById("ccck").style.height = wz + 'px';
 }catch(e){}
function hide_menu(){
    document.getElementById("set-menu").classList.add("hide-menu");
    document.getElementById("set-menu").classList.remove("show-menu");
    document.getElementById("set-menu").classList.remove("menu-mt");
    window.toggle_menu=false;
}
function toggle_menu_destop(){
    if(window.toggle_menu==undefined||window.toggle_menu==false){
        document.getElementById("set-menu").classList.add("menu-mt");
        window.toggle_menu=true;
    }else{
        document.getElementById("set-menu").classList.remove("menu-mt");
        window.toggle_menu=false;
    }
}
// xu ly cart
update_count_cart();
// render
function render_cart_pp(is_control=false){
    let data_carts=localStorage.getItem("order_carts");
    let rs_item_list='';
    let total_price=0;
    if(data_carts==null){
        rs_item_list=`<div style=" text-align: center; color: tomato; "><span>Chưa có sản phẩm.</span></div>`;
    }else{
        data_carts=JSON.parse(data_carts);
        if(data_carts.length>0){
            data_carts.forEach((e,i) => {
                total_price+=Number(e.price_sale)*Number(e.sl);
                rs_item_list+=`<div class="item-data">
                <div class="item-data-1">
                    <div class="img-small">
                        <img width="100%" src="${e.img}">
                    </div>
                    <div class="title-z">
                        <span><a href="${e.url}">${e.title}</a></span>
                        -<b class="xx1">${e.kt}</b>
                        -<b class="xx2">${Number(e.price_sale).toLocaleString('vi-VN', {style : 'currency', currency : 'VND'})}</b>
                    </div>
                </div>
                <div class="sl">
                    <div>
                        <button class="add-1 cs" onclick="control_1(${i})">-
                        </button><span class="num">${e.sl}</span>
                        <button  class="add-2 cs" onclick="control_2(${i})">+</button>
                        <span class="xoa"  onclick="control_3(${i})">xóa</span>
                    </div>
                </div>
                <div class="upsale-sp">

                </div>
            </div>`
            });
        }else{
            rs_item_list=`<div style=" text-align: center; color: tomato; "><span>Chưa có sản phẩm.</span></div>`;
        }
    }
    let button_buy_wrap=``;
    if(total_price>0){
        button_buy_wrap=`<div class="wrap-tt" id="wrap-tt" style="right: ${is_control?0:'-300'}px;">
        <div class="tong-tien">
            <p style="text-align: center;"><span style="font-weight: 600;">Tổng tiền : </span><span id="price-sum" style=" color: blue; font-weight: 700; ">${Number(total_price).toLocaleString('vi-VN', {style : 'currency', currency : 'VND'})}</span></p>
        </div>
        <div class="btn-checkout">
            <a href="/thanh-toan/" title="thanh toan" rel="nofollow">
                <button class="thanh-toan">Thanh toán</button>
            </a>
        </div>
    </div>`
    }
    let htmlContent=`<div class="pp-content" id="pp-content" style="right:${is_control?0:'-300'}px;">
            <div>
                <span class="header-1"><span class="icon-cartx" style=" font-size: 30px; position: relative;"></span></span>
                <span class="header-2 cs icon-remove" onclick="hiden_cartpp()"></span>
            </div>
            <div id="datawwrap">${rs_item_list}</div>
            ${button_buy_wrap}
        </div>
        <div class="dimer-popup" style=" width: 100%; height: 100%; " onclick="hiden_cartpp()"></div>`;
        document.getElementById("popup-cart").innerHTML = htmlContent;
}

//
function show_cart(){
    document.getElementById("popup-cart").style.display = "block";
    document.getElementById("popup-cart").style.backgroundColor = "rgba(0, 0, 0, 0.55)";
    render_cart_pp();
    setTimeout(()=>{
        document.getElementById("pp-content").style.right = "0px";
        document.getElementById("wrap-tt").style.right = "0px";
    },10)

}
function hiden_cartpp(){
    document.getElementById("pp-content").style.right = "-300px";
    try{
        document.getElementById("wrap-tt").style.right = "-300px";
    }catch(e){}
    document.getElementById("popup-cart").style.backgroundColor = "transparent";
    setTimeout(()=>{
        document.getElementById("popup-cart").style.display = "none";
    },300)
}
function update_count_cart(){
let data_carts=localStorage.getItem("order_carts");
    if(data_carts!=null){
        data_carts=JSON.parse(data_carts);
        if(data_carts.length>0){
            document.getElementById("cart-1").innerHTML = data_carts.length;
            document.getElementById("cart-2").innerHTML = data_carts.length;
        }else{
            document.getElementById("cart-1").innerHTML = 0;
            document.getElementById("cart-2").innerHTML = 0;
        }
    }
}
function control_1(i){// giam
    let data_carts=localStorage.getItem("order_carts");
    if(data_carts!=null){
        data_carts=JSON.parse(data_carts);
        let sl=Number(data_carts[i].sl);
        if(sl>1){
            data_carts[i].sl=sl-1;
            localStorage.setItem("order_carts", JSON.stringify(data_carts));
            render_cart_pp(true);
        }
    } 
}
function control_2(i){// tang
    let data_carts=localStorage.getItem("order_carts");
    if(data_carts!=null){
        data_carts=JSON.parse(data_carts);
        let sl=Number(data_carts[i].sl);
        data_carts[i].sl=sl+1;
        localStorage.setItem("order_carts", JSON.stringify(data_carts));
        render_cart_pp(true);
    } 
}
function control_3(i){// xoa
    let data_carts=localStorage.getItem("order_carts");
    if(data_carts!=null){
        data_carts=JSON.parse(data_carts);
        data_carts.splice(i,1)
        localStorage.setItem("order_carts", JSON.stringify(data_carts));
        render_cart_pp(true);
        update_count_cart()
    } 
}