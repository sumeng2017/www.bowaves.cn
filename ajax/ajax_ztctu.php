<?php
define('DEDEADMIN', str_replace("\\", '/', dirname(__FILE__) ) );
require_once(DEDEADMIN.'/../member/config.php');

$class = dirname(__FILE__) . '/class.php'; 

require_once($class);

$url2 = "http://shengyicanmou.com/ztctu.php"; 
$content = get_content($url2, $cookie); 


if(isset($_POST['start_page'])){




$ztckw=$_POST['ztckw'];
$start_page=$_POST['start_page'];
$end_page=$_POST['end_page'];
$channel=$_POST['channel'];



$post_data = array(
         "ztckw" => $ztckw,
		  "start_page" => $start_page,
		   "end_page" => $end_page,
    "channel" => $channel
		
		
       );















}else{


$ztcurl=$_POST['ztcurl'];
$ztckw=$_POST['ztckw'];


$post_data = array(
         "ztcurl" => $ztcurl,
		  "ztckw" => $ztckw
	);




}






    // 判断是否支持CURL
if (!function_exists('curl_init') || !function_exists('curl_exec')) {
        exit('您的主机不支持Curl，请开启~');
}




    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,"http://shengyicanmou.com/ajax/ajax_ztctu.php");
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
if($cfg_ml->M_Money > $ztctu){



$data=str_replace("\u6dd8\u53e3\u4ee4\u5df2\u751f\u6210\uff0c\u79ef\u5206 -0","\u6dd8\u53e3\u4ee4\u5df2\u751f\u6210\uff0c\u79ef\u5206 -".$ztctu,$data);

$dsql->ExecNoneQuery("UPDATE  `dede_member` SET  `money` = money -".$ztctu.",`scores` = scores +".$ztctu." WHERE  `mid` =".$cfg_ml->M_ID.";");



print_r($data);

}else{



$arr = array ('err'=>'0','msg'=>'您的积分不足,查询失败！');
print_r(json_encode($arr));

}


}





?>