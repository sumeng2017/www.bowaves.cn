<?php

define('DEDEADMIN', str_replace("\\", '/', dirname(__FILE__) ) );
require_once(DEDEADMIN.'/../member/config.php');

$class = dirname(__FILE__) . '/class.php'; 

require_once($class);

$url2 = "http://shengyicanmou.com/tmwc.php"; 

$content = get_content($url2, $cookie); 

$item_url=$_POST['item_url'];

$Keyword=$_POST['Keyword'];
$get_num=$_POST['get_num'];



$post_data = array(
         "item_url" => $item_url,
		  "Keyword" => $Keyword,
		   "get_num" => $get_num
    
		
		
       );





    // 判断是否支持CURL
if (!function_exists('curl_init') || !function_exists('curl_exec')) {
        exit('您的主机不支持Curl，请开启~');
}




    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,"http://shengyicanmou.com/ajax/ajax_ztcksp.php");
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
	 curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
	
curl_setopt($curl,CURLOPT_COOKIEFILE,$cookie); //读取cookie 
    $data = curl_exec($curl);
    curl_close($curl);
    

print_r($data);

exit;

if($cfg_ml->M_Rank == "20"){

print_r($data);
}else{
if($cfg_ml->M_Money > $tmwc){



$data=str_replace("\u67e5\u8be2\u5b8c\u6210\uff0c\u79ef\u5206 -0","\u67e5\u8be2\u5b8c\u6210\uff0c\u79ef\u5206 -".$tmwc,$data);

$dsql->ExecNoneQuery("UPDATE  `dede_member` SET  `money` = money -".$tmwc.",`scores` = scores +".$tmwc." WHERE  `mid` =".$cfg_ml->M_ID.";");



print_r($data);

}else{



$arr = array ('err'=>'0','msg'=>'您的积分不足,查询失败！');
print_r(json_encode($arr));

}

}






?>