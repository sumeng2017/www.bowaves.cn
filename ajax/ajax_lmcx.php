<?php
define('DEDEADMIN', str_replace("\\", '/', dirname(__FILE__) ) );
require_once(DEDEADMIN.'/../member/config.php');


$class = dirname(__FILE__) . '/class.php'; 

require_once($class);

$url2 = "http://shengyicanmou.com/tcsq.php"; 
$content = get_content($url2, $cookie); 

$item_url=$_POST['item_url'];





$post_data = array(
         "item_url" => $item_url
    
		
		
       );






    // 判断是否支持CURL
if (!function_exists('curl_init') || !function_exists('curl_exec')) {
        exit('您的主机不支持Curl，请开启~');
}




    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,"http://shengyicanmou.com/ajax/ajax_lmcx.php");
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
    
if($cfg_ml->M_Rank == "20"){

print_r($data);
}else{
if($cfg_ml->M_Money > $lmcx){



$data=str_replace("\u67e5\u8be2\u5b8c\u6210\uff0c\u79ef\u5206 -0","\u67e5\u8be2\u5b8c\u6210\uff0c\u79ef\u5206 -".$lmcx,$data);

$dsql->ExecNoneQuery("UPDATE  `dede_member` SET  `money` = money -".$lmcx.",`scores` = scores +".$lmcx." WHERE  `mid` =".$cfg_ml->M_ID.";");



print_r($data);

}else{



$arr = array ('err'=>'0','msg'=>'您的积分不足,查询失败！');
print_r(json_encode($arr));

}

}






?>