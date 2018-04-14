<?php

define('DEDEADMIN', str_replace("\\", '/', dirname(__FILE__) ) );
require_once(DEDEADMIN.'/../member/config.php');


$class = dirname(__FILE__) . '/class.php'; 

require_once($class);

$url2 = "http://shengyicanmou.com/yhpro.php"; 
$content = get_content($url2, $cookie); 

$nick=$_GET['nick'];
$get=$_GET['get'];

    // 判断是否支持CURL
if (!function_exists('curl_init') || !function_exists('curl_exec')) {
        exit('您的主机不支持Curl，请开启~');
}




    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,"http://shengyicanmou.com/ajax/ajax_yhmod_1.php?nick=".$nick."&get=".$get);
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










?>