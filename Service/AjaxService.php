<?php 

define('DEDEADMIN', str_replace("\\", '/', dirname(__FILE__) ) );
require_once(DEDEADMIN.'/../member/config.php');

$ac=$_GET['ac'];

if($ac=="GetUser"){

$data=date("Y-m-d H:i:s",$cfg_ml->M_UpTime+$cfg_ml->M_ExpTime*86400);



$arr = array ('M_ID'=>$cfg_ml->M_ID,'userid'=>$cfg_ml->fields['userid'],'M_Money'=>$cfg_ml->M_Money,'M_Rank'=>$cfg_ml->M_Rank,'loginnum'=>$cfg_ml->fields['loginnum'],'data'=>$data,'scores'=>$cfg_ml->M_Scores);

print_r(json_encode($arr));


}


function geturl($url) {
    // 判断是否支持CURL
    if (!function_exists('curl_init') || !function_exists('curl_exec')) {
        exit('您的主机不支持Curl，请开启~');
	}
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_USERAGENT, 'Yun Parse');
    curl_setopt($curl, CURLOPT_REFERER, "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}



function login(){




}



?>