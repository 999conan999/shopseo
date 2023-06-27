<?php 
    $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
    require_once( $parse_uri[0] . 'wp-load.php' );
 
    

 
    function telegram($msg,$telegrambot,$telegramchatid) {
        $url='https://api.telegram.org/bot'.$telegrambot.'/sendMessage';
        $data=array('chat_id'=>$telegramchatid,'text'=>$msg,'parse_mode'=>'html');
        $options=array('http'=>array('method'=>'POST','header'=>"Content-Type:application/x-www-form-urlencoded\r\n",'content'=>http_build_query($data),),);
        $context=stream_context_create($options);
        $result=file_get_contents($url,false,$context);
        return $result;
    }
    // 
    if(isset($_POST['phone'])){
        $API_data=get_option('telegram_data');
        if($API_data&&$API_data!=""){
            $name_buyer=stripslashes(strip_tags($_POST['name_buyer']));
            $phone=stripslashes(strip_tags($_POST['phone']));
            $address_1=stripslashes(strip_tags($_POST['address_1']));
            $note=stripslashes(strip_tags($_POST['note']));
            $data_carts=json_decode(stripslashes(strip_tags($_POST['data_carts'])));
            $API_data=json_decode($API_data);
            $token=$API_data->token;
            $id_chat=$API_data->id;
            if($token!=''&&$id_chat!=''){
                $mss='';
                $sum=0;
                $url_sp='';
                $img='';
                foreach($data_carts as $x){
                    $mss.='+ '.$x->title.' - <b>'.$x->kt.'</b> - <b>'.number_format((int)($x->price_sale),0,",",".").' đ</b>'."\n";
                    $mss.='+ Số lượng : <b>'.$x->sl.'</b>'. "\n";
                    $sum+=(int)($x->sl)*(int)($x->price_sale);
                    $url_sp.='<pre>'.$x->url.'</pre>'."\n";
                    $url_sp.='----------'."\n";
                    $img=$x->img;
                }
                $mss.='+ Tổng tiền : <b>'.number_format($sum,0,",",".").' đ</b>'. "\n";
                $mss.='+ Tên : <b>'.$name_buyer.'</b>'. "\n";
                $mss.='+ Địa chỉ : <b>'.$address_1.'</b>'. "\n";
                $mss.='+ Điện thoại : <b>'.$phone.'</b>'. "\n";
                $mss.='+ Ghi chú : <b>'.$note.'</b>'. "\n";
                $mss.='================'."\n";
                $mss.=$url_sp;
                $mss.=$img. "\n";
                telegram($mss,$token,$id_chat);
            }
        }
    }
    

?>