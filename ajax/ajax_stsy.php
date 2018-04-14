<?php
define('DEDEADMIN', str_replace("\\", '/', dirname(__FILE__) ) );
require_once(DEDEADMIN.'/../member/config.php');

$class = dirname(__FILE__) . '/class.php'; 

require_once($class);

$url2 = "http://shengyicanmou.com/stsy.php"; 
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
    curl_setopt($curl, CURLOPT_URL,"http://shengyicanmou.com/ajax/ajax_stsy.php");
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


if($cfg_ml->M_Money > $stsy){



$data=str_replace("\u6dd8\u53e3\u4ee4\u5df2\u751f\u6210\uff0c\u79ef\u5206 -0","\u6dd8\u53e3\u4ee4\u5df2\u751f\u6210\uff0c\u79ef\u5206 -".$stsy,$data);

$dsql->ExecNoneQuery("UPDATE  `dede_member` SET  `money` = money -".$stsy.",`scores` = scores +".$stsy." WHERE  `mid` =".$cfg_ml->M_ID.";");



print_r($data);

}else{



$arr = array ('err'=>'0','msg'=>'您的积分不足,查询失败！');
print_r(json_encode($arr));

}

}


?>