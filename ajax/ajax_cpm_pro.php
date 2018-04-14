<?php

$class = dirname(__FILE__) . '/class.php'; 

require_once($class);

$url2 = "http://shengyicanmou.com/key_qz.php"; 
$content = get_content($url2, $cookie); 

$mod=$_POST['mod'];

if($mod=="id"){

$so=$_POST['so'];
$sort=$_POST['sort'];
$page=$_POST['page'];
$buyer_ww=$_POST['buyer_ww'];
$key=$_POST['key'];
$id=$_POST['id'];

$post_data = array(
         "so" => $so,
         "mod" => $mod,
		 "sort" => $sort,
		 "page" => $page,
		 "buyer_ww" => $buyer_ww,
		"key" => $key,
		"id" => $id
       );


}else if($mod=="shop"){

$so=$_POST['so'];
$sort=$_POST['sort'];
$page=$_POST['page'];
$serv=$_POST['serv'];
$key=$_POST['key'];
$shop_nick=$_POST['shop_nick'];

$post_data = array(
         "so" => $so,
         "mod" => $mod,
		 "sort" => $sort,
		 "page" => $page,
		 "serv" => $serv,
		"key" => $key,
		"shop_nick" => $shop_nick
       );

}else if($mod=="all"){

$so=$_POST['so'];
$sort=$_POST['sort'];
$page=$_POST['page'];
$serv=$_POST['serv'];
$key=$_POST['key'];


$post_data = array(
         "so" => $so,
         "mod" => $mod,
		 "sort" => $sort,
		 "page" => $page,
		 "serv" => $serv,
		"key" => $key
		
       );

}


    // 判断是否支持CURL
if (!function_exists('curl_init') || !function_exists('curl_exec')) {
        exit('您的主机不支持Curl，请开启~');
}




    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,"http://shengyicanmou.com/ajax/ajax_cpm_pro.php");
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