<?php


$class = dirname(__FILE__) . '/class.php'; 

require_once($class);

$url2 = "http://shengyicanmou.com/ztcksp.php"; 
$content = get_content($url2, $cookie); 



$checktburl=$_POST['checktburl'];





$post_data = array(
         "checktburl" => $checktburl
		
	);





function getSubstr($str, $leftStr, $rightStr)
{
$left = strpos($str, $leftStr);
$right = strpos($str, $rightStr,$left);
if($left < 0 or $right < $left) return '';
return substr($str, $left + strlen($leftStr), $right-$left-strlen($leftStr));
}







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
	curl_setopt($curl,CURLOPT_COOKIEFILE,$cookie); //读取cookie 

    $data = curl_exec($curl);
    curl_close($curl);

$data=str_replace('"isbinding":"0"','"isbinding":"1"',$data);


$nick=getSubstr($data,'"nick":"','",');
$wwid=getSubstr($data,'wwid":"','",');

$data=str_replace('wwid":"'.$wwid.'",','wwid":"'.$nick.'",',$data);

print_r($data);






?>