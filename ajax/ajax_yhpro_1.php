<?php

define('DEDEADMIN', str_replace("\\", '/', dirname(__FILE__) ) );
require_once(DEDEADMIN.'/../member/config.php');


$class = dirname(__FILE__) . '/function.php'; 

require_once($class);

$url2 = "http://shengyicanmou.com/yhpro.php"; 
$content = get_content($url2, $cookie); 

$nick=$_POST['nick'];





$post_data = array(
         "nick" => $nick
    
		
		
       );





    // 判断是否支持CURL
if (!function_exists('curl_init') || !function_exists('curl_exec')) {
        exit('您的主机不支持Curl，请开启~');
}




    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,"http://shengyicanmou.com/ajax/ajax_yhpro_1.php");
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

$data=str_replace("\u67e5\u8be2\u6210\u529f\uff01\u6263\u96641\u79ef\u5206\u3002","\u67e5\u8be2\u6210\u529f\uff01\u6263\u96640\u79ef\u5206\u3002",$data);


print_r($data);

}else{







$data=str_replace("\u67e5\u8be2\u6210\u529f\uff01\u6263\u96641\u79ef\u5206\u3002","\u67e5\u8be2\u6210\u529f\uff01\u6263\u96640\u79ef\u5206\u3002",$data);

$dsql->ExecNoneQuery("UPDATE  `dede_member` SET  `money` = money -".$tcsq.",`scores` = scores +".$tcsq." WHERE  `mid` =".$cfg_ml->M_ID.";");



print_r($data);



}











?>