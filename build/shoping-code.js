async function myFunction() {
  var merchantId = '651114113';
  var feedId = '117213241'; // feedid=> https://developers.google.com/shopping-content/reference/rest/v2.1/datafeeds/list
  var xmlURL = "https://cofa.vn/wp-content/themes/shopseo/templates/ajax/xml/products.xml";
  var telegram_token="5213620215:AAEipChA-WvFisUDOK8vbRBk6b4GOIpq7ec";
  var telegram_id_chat="1497494659";
  //============================
  const accessToken=await getAccessToken();
  var b=await readXML(xmlURL);
  var a=await fetchProductInfo(merchantId, accessToken)
  let status=fs_is_load_data_feed(a,b);
  if(status) reloadProductFeed(accessToken,merchantId,feedId);
  //================================
  let k=await countDisapprovedProducts(merchantId);
  console.log(k)
  if(k.dis>0){
    let message=`Có ${k.dis}/${k.sum} sản phẩm bị từ chối tại Shoping của cofa.vn
${k.text_error}`;
    await sendTelegramMessage(telegram_token, telegram_id_chat, message)
  } 
}
// //================================================
function sendTelegramMessage(token, chatId, message) {
  var apiUrl = 'https://api.telegram.org/bot' + token + '/sendMessage';
  var payload = {
    'chat_id': chatId,
    'text': message
  };
  
  var options = {
    'method': 'post',
    'contentType': 'application/json',
    'payload': JSON.stringify(payload)
  };
  
  var response = UrlFetchApp.fetch(apiUrl, options);
  var responseCode = response.getResponseCode();
  
  if (responseCode == 200) {
    Logger.log('Telegram message sent successfully.');
  } else {
    Logger.log('Failed to send Telegram message. Response code: ' + responseCode);
  }
}
//
async function countDisapprovedProducts(merchantId) {
  var productStatuses = await ShoppingContent.Productstatuses.list(merchantId);
  var totalProducts = 0;
  var numberDisapprovedProducts = 0;
  var text_error=`
  `;
  if (productStatuses.resources) {
    for (var i = 0; i < productStatuses.resources.length; i++) {
      var product = productStatuses.resources[i];
      totalProducts += 1;
      if (product.itemLevelIssues) { 
        // if(product.itemLevelIssues[0].code!='low_image_quality'){
         text_error+=`+* ${product.title} 👉⚠️ : "${product.itemLevelIssues[0].code}"
`;
         numberDisapprovedProducts++;
        // }
      }
    }
  } else {
    Logger.log('No products in account ' + merchantId);
  }

  // Phân trang cho tất cả sản phẩm
  var pageToken = productStatuses.nextPageToken;
  while (pageToken) {
    productStatuses = await ShoppingContent.Productstatuses.list(merchantId, { pageToken: pageToken });
    if (productStatuses.resources) {
      for (var i = 0; i < productStatuses.resources.length; i++) {
        var product = productStatuses.resources[i];
        totalProducts += 1;
        if (product.itemLevelIssues) {
          // if(product.itemLevelIssues[0].code!='low_image_quality'){
            text_error+=`+* ${product.title} 👉⚠️ : "${product.itemLevelIssues[0].code}"
`;
            numberDisapprovedProducts++;
          // }
        }
      }
    }
    pageToken = productStatuses.nextPageToken;
  }

  return {
    sum: totalProducts,
    dis: numberDisapprovedProducts,
    text_error:text_error
  };
}
 
//================================================
function fs_is_load_data_feed(a,b){
  try{
  if(a.length!=b.length){
    console.log('Merchant : ',a.length);
    console.log('XML : ',b.length);
    console.log("Chênh lệch độ dài!");
    return true;
  }
  let rs_a=false;
  let rs_b=false;
  // xu ly a
  for(let i=0;i<a.length;i++){
    let id=a[i].id;
    let a_o=a[i];
    let b_o_arr=b.filter(function(item) {
      return item.id == id;
    });
    if(b_o_arr.length==1){
      let b_o=b_o_arr[0];
      if(a_o.title.replace(/\s/g, '')!=b_o.title.replace(/\s/g, '')||a_o.description.replace(/\s/g, '')!=b_o.description.replace(/\s/g, '')||a_o.link!=b_o.link||a_o.brand.replace(/\s/g, '')!=b_o.brand.replace(/\s/g, '')||a_o.imageLink!=b_o.imageLink||a_o.customLabel0.replace(/\s/g, '')!=b_o.customLabel0.replace(/\s/g, '')||(Number(a_o.price.replace(' VND',''))!=Number(b_o.price.replace(' VND',''))) ||(a_o.availability.replace('_',' ')!=b_o.availability.replace('_',' ')) ){
        console.log("A");
          if(a_o.title.replace(/\s/g, '')!=b_o.title.replace(/\s/g, '')){
            console.log("title");
            console.log('title_xml',a_o.title);
            console.log('title_merchant',b_o.title);
          }
          if(a_o.description.replace(/\s/g, '')!=b_o.description.replace(/\s/g, '')){
            console.log("description");
            console.log('description_xml',a_o.description);
            console.log('description_merchant',b_o.description);
          }
          if(a_o.link!=b_o.link){
            console.log("link");
            console.log('link_xml',a_o.link);
            console.log('link_merchant',b_o.link);
          }
          if(a_o.brand.replace(/\s/g, '')!=b_o.brand.replace(/\s/g, '')){
            console.log("brand");
            console.log('brand_xml',a_o.brand);
            console.log('brand_merchant',b_o.brand);
          }
          if(a_o.imageLink!=b_o.imageLink){
            console.log("imageLink");
            console.log('imageLink_xml',a_o.imageLink);
            console.log('imageLink_merchant',b_o.imageLink);
          }
          if(a_o.customLabel0.replace(/\s/g, '')!=b_o.customLabel0.replace(/\s/g, '')){
            console.log("customLabel0");
            console.log('customLabel0_xml',a_o.customLabel0);
            console.log('customLabel0_merchant',b_o.customLabel0);
          }
          if((Number(a_o.price.replace(' VND',''))!=Number(b_o.price.replace(' VND','')))){
            console.log("price");
            console.log('price_xml',Number(a_o.price.replace(' VND','')));
            console.log('price_merchant',Number(b_o.price.replace(' VND','')));
          }
          if((a_o.availability.replace('_',' ')!=b_o.availability.replace('_',' '))){
            console.log("availability");
            console.log('availability_xml',a_o.availability.replace('_',' '));
            console.log('availability_merchant',b_o.availability.replace('_',' '));
          }
         rs_a=true;
      }
    }else{
      rs_a=true;
    }
  }
  // xu ly b
  for(let i=0;i<b.length;i++){
    let id=b[i].id;
    let b_o=b[i];
    let a_o_arr=a.filter(function(item) {
      return item.id == id;
    });
    if(a_o_arr.length==1){
      let a_o=a_o_arr[0];
      if(a_o.title.replace(/\s/g, '')!=b_o.title.replace(/\s/g, '')||a_o.description.replace(/\s/g, '')!=b_o.description.replace(/\s/g, '')||a_o.link!=b_o.link||a_o.brand.replace(/\s/g, '')!=b_o.brand.replace(/\s/g, '')||a_o.imageLink!=b_o.imageLink||a_o.customLabel0.replace(/\s/g, '')!=b_o.customLabel0.replace(/\s/g, '')||(Number(a_o.price.replace(' VND',''))!=Number(b_o.price.replace(' VND',''))) ||(a_o.availability.replace('_',' ')!=b_o.availability.replace('_',' ')) ){
        console.log("B");
          if(a_o.title.replace(/\s/g, '')!=b_o.title.replace(/\s/g, '')){
            console.log("title");
            console.log('title_xml',a_o.title);
            console.log('title_merchant',b_o.title);
          }
          if(a_o.description.replace(/\s/g, '')!=b_o.description.replace(/\s/g, '')){
            console.log("description");
            console.log('description_xml',a_o.description);
            console.log('description_merchant',b_o.description);
          }
          if(a_o.link!=b_o.link){
            console.log("link");
            console.log('link_xml',a_o.link);
            console.log('link_merchant',b_o.link);
          }
          if(a_o.brand.replace(/\s/g, '')!=b_o.brand.replace(/\s/g, '')){
            console.log("brand");
            console.log('brand_xml',a_o.brand);
            console.log('brand_merchant',b_o.brand);
          }
          if(a_o.imageLink!=b_o.imageLink){
            console.log("imageLink");
            console.log('imageLink_xml',a_o.imageLink);
            console.log('imageLink_merchant',b_o.imageLink);
          }
          if(a_o.customLabel0.replace(/\s/g, '')!=b_o.customLabel0.replace(/\s/g, '')){
            console.log("customLabel0");
            console.log('customLabel0_xml',a_o.customLabel0);
            console.log('customLabel0_merchant',b_o.customLabel0);
          }
          if((Number(a_o.price.replace(' VND',''))!=Number(b_o.price.replace(' VND','')))){
            console.log("price");
            console.log('price_xml',Number(a_o.price.replace(' VND','')));
            console.log('price_merchant',Number(b_o.price.replace(' VND','')));
          }
          if((a_o.availability.replace('_',' ')!=b_o.availability.replace('_',' '))){
            console.log("availability");
            console.log('availability_xml',a_o.availability.replace('_',' '));
            console.log('availability_merchant',b_o.availability.replace('_',' '));
          }
         rs_a=true;
      }
    }else{
      rs_b=true;
    }
  }
  // 
  if(rs_a||rs_b){
    return true;
  }else{
    return false;
  }
  }catch(e){
    return true;
  }
}
// //================================================
async function readXML(xmlURL) {
  var response =await UrlFetchApp.fetch(xmlURL);
  var xmlString = response.getContentText();
  var document = XmlService.parse(xmlString);
  var rootElement = document.getRootElement();
  // Khai báo gNamespace
  var gNamespace = XmlService.getNamespace('g', 'http://base.google.com/ns/1.0');

  var itemElements = rootElement.getChild("channel").getChildren("item");
  var items = [];

  for (var i = 0; i < itemElements.length; i++) {
    var itemElement = itemElements[i];
    var item = {};

    // Sử dụng gNamespace để truy cập các phần tử có tiền tố "g:"
    item.id = getChildText(itemElement, "id", gNamespace);
    item.title = getChildText(itemElement, "title", gNamespace);
    item.description = getChildText(itemElement, "description", gNamespace);
    item.link = getChildText(itemElement, "link", gNamespace);
    item.condition = getChildText(itemElement, "condition", gNamespace);
    item.availability = getChildText(itemElement, "availability", gNamespace);
    item.price = getChildText(itemElement, "price", gNamespace);
    item.brand = getChildText(itemElement, "brand", gNamespace);
    item.imageLink = getChildText(itemElement, "image_link", gNamespace);
    item.customLabel0 = getChildText(itemElement, "custom_label_0", gNamespace);

    items.push(item);
  }

  return items;
}
function getChildText(parentElement, childName, namespace) {
  var childElement = parentElement.getChild(childName, namespace);
  return childElement !== null ? childElement.getText() : "";
}
//=========================
async function fetchProductInfo(merchantId, accessToken) {
  var productInfoArray = [];
  var pageToken = ""; // Sử dụng để theo dõi trang kế tiếp
  
  do {
    if(pageToken==""){
      var apiUrl = `https://shoppingcontent.googleapis.com/content/v2.1/${merchantId}/products?maxResults=250`;
    }else{
      var apiUrl = `https://shoppingcontent.googleapis.com/content/v2.1/${merchantId}/products?maxResults=250&pageToken=${pageToken}`;
    }
    var headers = {
      'Authorization': 'Bearer ' + accessToken,
      'Content-Type': 'application/json'
    };

    var params = {
      'maxResults': 250, // Số lượng sản phẩm trên mỗi trang (giá trị tối đa là 250)
      'pageToken': pageToken
    };
    
    var options = {
      'method': 'get',
      'headers': headers,
      'muteHttpExceptions': true,
    };

    var response = await UrlFetchApp.fetch(apiUrl, options);
    var responseData = JSON.parse(response.getContentText());
    if (responseData && responseData.resources) {
      for (var i = 0; i < responseData.resources.length; i++) {
        var product = responseData.resources[i];
        var productInfo = {
          id: product.offerId,
          title: product.title,
          description: product.description,
          link: product.link,
          condition: product.condition,
          availability: product.availability,
          price: product.price.value,
          brand: product.brand,
          imageLink: product.imageLink,
          customLabel0: product.customLabel0
        };
        productInfoArray.push(productInfo);
      }
    }
    pageToken = responseData.nextPageToken; // Lưu trang kế tiếp (nếu có) để gọi API tiếp theo
  } while (pageToken);
  
  return productInfoArray;
}

//==================================await reloadProductFeed(accessToken,merchantId,feedId);
async function reloadProductFeed(accessToken,merchantId,feedId) {
  var apiUrl=`https://shoppingcontent.googleapis.com/content/v2.1/${merchantId}/datafeeds/${feedId}/fetchNow`
  // var apiUrl = 'https://www.googleapis.com/content/v2.1/merchantId/' + merchantId + '/feeds/' + feedId + '/fetchNow';
  var headers = {
    'Authorization': 'Bearer ' + accessToken,
    'Content-Type': 'application/json'
  };
  
  var options = {
    'method': 'post',
    'headers': headers,
    'muteHttpExceptions': true
  };
  
  var response =await UrlFetchApp.fetch(apiUrl, options);
  console.log(response.getContentText());
  var responseCode = response.getResponseCode();
  if (responseCode == 200) {
    Logger.log('Product feed reloaded successfully.');
  } else {
    Logger.log('Failed to reload product feed. Response code: ' + responseCode);
  }
}
// Đoạn mã cần thực thi để xác thực và lấy mã truy cập (access token)
async function getAccessToken() {
  var serviceAccount = {
    "type": "service_account",
    "project_id": "merchant-center-1688665917033",
    "private_key_id": "d7f4bc15ccb0937a027375b81f6978c14b85a558",
    "private_key": "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCpS+iTtf+hyVII\nHhSfy9a9T2vCIy99kBNAC+kgd2pGg7o8s28NdVnZpU8CZm1KK7cMP2CZw6RwfLHr\neFrKdGKno3kB5P1AI3qCpJDouJHWuaQQksgu5cEkWGWIxoDzExaSbq0pxZ3t82gN\nAEI8ReSBdeO9Rf/ry4OCFOvXlRWUUe8BpnOsUq840pLAN0yP5rb2LtTAVoP/mwat\naIaijH3Y2Bbhyx4iSzVViWNAmod9aKzDGLPIZNrFypORyqwLFgtWjHbDPUZfgZY9\n9HEmbsnU3Rw9UKTRKdVDx+jx2Cp4dkLmAZ53jFs4rzzYw9kYnEZqc6FnFhMNWkVH\np2hgQnyvAgMBAAECggEAQ36P6tPUZpvsqG/VqR+LLU5Ml8mPVW/rPM2C0/7Hz/UU\ner7Ot37ho3PUXBCZ4cgr4iYiTStCk9Yi2M3S5IQiENOLmsXAcaGzZgJWA3ISMpkw\nX6slRA01Q1g6op0BK+egSCD3yH+Qxx0TjptbzMvQngxyDzOpJEiu1V2h6QD26Xpa\nQpAX8hxYQxAKiKBCCvNsL9/sDvtVYS3YhlfbBU96uVUdbmGw6DFfh4JTKcMBAjRQ\noJt4YSWzH4EWm5XRMlZDfcM//bGCvJqs3Ff4xTTUCnjFdfoqwfePiJL5HY4PeHZz\nXmV123ul/gXhSuYvffQpWDRLOR13NPHDR58Drop4gQKBgQDi5CTg3VQHM8oJLE/z\n74zODZAyzNTn4e7j8gn/3EiQEwTL9/B1yZj3ABJu11TlSy5SZO6WN3AfMR4IyB5b\nxW1iNpPWXud4hqlBMTyjYYP4n2aK0EjBfskjcSBmA5hSYVvDdYMj21l0i7ZxUxb+\nBYeGSVhri4p3ofarti0IKrPiIwKBgQC/BCpO6DEwudxaTlmubLivB4pzFrTUbefE\nyaGb9zr+JZyDyRk26EWvbq+Zhl7EeiG2f5gT4T1GHIyomyX+/LBxHqao2RyUfSlx\n03NnRX1NsD4h+h/dt1AQCc/Ir8kza9s0dRxNI3lGXYgWIq6imRSt0r7/fCVkXuqm\n9VDg8EjGBQKBgFN5/Nd+ltvPghW95+ynxfZJpzQJiIuH5IyZEHTCZzAazzj8D8xG\nT7EQpbeCIgn6jyBhYiaCXw4a1CIG/qRlDsmDqwDECgWeBcemhdjWl+dxPhj0aNBI\nBVi01mayC+jDSS+wnH8kxNTMUmN/XoY3IpWVhqKKxHcfb9HdRNQsYeJhAoGAcbGo\n/Q53OOlnntjDyG4t/wAeCCKbv1UrfpYE+zBMjLkWT9qCh4v47lKTcm3oOkn3hwir\nHCoUroaPskumcf81hh8YU6fmuvtEj9ur9OwHiRY95TtbfDyACwvMAUegGls4PiD2\nl3Nl29wQBBzglSdIh63IwYjDONrGEFozqa9boYECgYEAmxLRo/d01DjxTxnlOwSX\n/lee95ZFEWNILeFX19bmn1Yldjc1BTQ4W+IyuvElmddbjWhjezVjL8HE1muAgZP2\nea2BCdh6V6MtzK4THLOa51hGQ/Pmg/xFKtShH2kRebLKIaF3DW9vHbm86aObHWS0\nO4TQRhHQcM4SXqKGQ0fPwz8=\n-----END PRIVATE KEY-----\n",
    "client_email": "merchant-center-1688665917033@merchant-center-1688665917033.iam.gserviceaccount.com",
    "client_id": "115265323457621729293",
    "auth_uri": "https://accounts.google.com/o/oauth2/auth",
    "token_uri": "https://oauth2.googleapis.com/token",
    "auth_provider_x509_cert_url": "https://www.googleapis.com/oauth2/v1/certs",
    "client_x509_cert_url": "https://www.googleapis.com/robot/v1/metadata/x509/merchant-center-1688665917033%40merchant-center-1688665917033.iam.gserviceaccount.com",
    "universe_domain": "googleapis.com"
  };
  var scopes = ['https://www.googleapis.com/auth/content'];
  var service =await OAuth2.createService('merchantAPI')
    .setTokenUrl(serviceAccount.token_uri)
    .setPrivateKey(serviceAccount.private_key)
    .setIssuer(serviceAccount.client_email)
    .setSubject(serviceAccount.client_email)
    .setPropertyStore(PropertiesService.getUserProperties())
    .setScope(scopes);
  
  if (service.hasAccess()) {
    return service.getAccessToken();
  } else {
    var authorizationUrl = service.getAuthorizationUrl();
    Logger.log('Open the following URL and re-run the script: ' + authorizationUrl);
  }
}
//
