<?php



$cookie_jar = dirname(__FILE__)."/cache/cookie.txt";


$header = array();
$header[] = 'Host:shengyicanmou.com';
$header[] = 'Origin:http://shengyicanmou.com';
$header[] = 'Referer: http://shengyicanmou.com/login.php';
$header[] = 'Cookie: user=1; Hm_lvt_75cd9b0d9743152ec049eba54f506315=1517972127; PHPSESSID=755msqntkctaae06dbg3h9n9l2';
$header[] = 'User-Agent:Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36';

$post = "username=xiaoyaoahui&password=lihui508&btn-login=%3CI+class%3D%22icon+icon-check-circle%22%3E%3C%2FI%3E%E7%99%BB+%E5%BD%95";  

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://shengyicanmou.com/login.php");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
 curl_setopt($ch, CURLOPT_POST, 1);//post方式提交 
curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
curl_setopt($ch,CURLOPT_HTTPHEADER,$header);


 curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar); //设置Cookie信息保存在指定的文件中 


$result=curl_exec($ch);
curl_close($ch);


echo $result;

?>