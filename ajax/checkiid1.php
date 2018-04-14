<?php


$checktburl=$_POST['checktburl'];





$post_data = array(
         "checktburl" => $checktburl

    
		
		
       );




$header = array();
$header[] = 'Host:shengyicanmou.com';
$header[] = 'Origin:http://shengyicanmou.com';
$header[] = 'Referer:http://shengyicanmou.com/ajax/checkiid.php';
$header[] = 'Cookie:PHPSESSID=sapks35nehlgitj4o1uvjjfv53; user=1; 1150273798=1; Hm_lvt_75cd9b0d9743152ec049eba54f506315=1517750418; Hm_lpvt_75cd9b0d9743152ec049eba54f506315=1517803065';
$header[] = 'User-Agent:Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36';

    // 判断是否支持CURL
if (!function_exists('curl_init') || !function_exists('curl_exec')) {
        exit('您的主机不支持Curl，请开启~');
}




    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,"http://shengyicanmou.com/ajax/checkiid.php");
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
	 curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
	curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

    $data = curl_exec($curl);
    curl_close($curl);
    

print_r($data);








?>