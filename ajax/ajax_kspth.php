<?php
define('DEDEADMIN', str_replace("\\", '/', dirname(__FILE__) ) );
require_once(DEDEADMIN.'/../member/config.php');
$class = dirname(__FILE__) . '/class.php'; 

require_once($class);

$url2 = "http://shengyicanmou.com/lmkp.php"; 
$content = get_content($url2, $cookie); 


$item_url=$_POST['Keyword'];



if(isset($_POST['url_1'])){

$post_data = array(
     "item_url" => $item_url,
	 "url_1" => $_POST['url_1']
		
	);

}


if(isset($_POST['url_2'])){

$post_data = array(
         "item_url" => $item_url,
	 "url_1" => $_POST['url_1'],
	 "url_2" => $_POST['url_2']

		
	);


}



if(isset($_POST['url_3'])){

$post_data = array(
         "item_url" => $item_url,
	 "url_1" => $_POST['url_1'],
	 "url_2" => $_POST['url_2'],
	"url_3" => $_POST['url_3']

		
	);


}



if(isset($_POST['url_4'])){

$post_data = array(
         "item_url" => $item_url,
	 "url_1" => $_POST['url_1'],
	 "url_2" => $_POST['url_2'],
	"url_3" => $_POST['url_3'],
	"url_4" => $_POST['url_4']

		
	);

}


if(isset($_POST['url_5'])){

$post_data = array(
         "item_url" => $item_url,
	 "url_1" => $_POST['url_1'],
	 "url_2" => $_POST['url_2'],
	"url_3" => $_POST['url_3'],
	"url_4" => $_POST['url_4'],
	"url_5" => $_POST['url_5']

		
	);


}


if(isset($_POST['url_6'])){

$post_data = array(
         "item_url" => $item_url,
	 "url_1" => $_POST['url_1'],
	 "url_2" => $_POST['url_2'],
	"url_3" => $_POST['url_3'],
	"url_4" => $_POST['url_4'],
	"url_5" => $_POST['url_5'],
	"url_6" => $_POST['url_6']

		
	);


}


if(isset($_POST['url_7'])){

$post_data = array(
         "item_url" => $item_url,
	 "url_1" => $_POST['url_1'],
	 "url_2" => $_POST['url_2'],
	"url_3" => $_POST['url_3'],
	"url_4" => $_POST['url_4'],
	"url_5" => $_POST['url_5'],
	"url_6" => $_POST['url_6'],
	"url_7" => $_POST['url_7']


		
	);

}

if(isset($_POST['url_8'])){

$post_data = array(
         "item_url" => $item_url,
	 "url_1" => $_POST['url_1'],
	 "url_2" => $_POST['url_2'],
	"url_3" => $_POST['url_3'],
	"url_4" => $_POST['url_4'],
	"url_5" => $_POST['url_5'],
	"url_6" => $_POST['url_6'],
	"url_7" => $_POST['url_7'],
	"url_8" => $_POST['url_8']
	

		
	);

}

if(isset($_POST['url_9'])){


$post_data = array(
         "item_url" => $item_url,
	 "url_1" => $_POST['url_1'],
	 "url_2" => $_POST['url_2'],
	"url_3" => $_POST['url_3'],
	"url_4" => $_POST['url_4'],
	"url_5" => $_POST['url_5'],
	"url_6" => $_POST['url_6'],
	"url_7" => $_POST['url_7'],
	"url_8" => $_POST['url_8'],
	"url_9" => $_POST['url_9']
	

		
	);


}

if(isset($_POST['url_10'])){

$post_data = array(
         "item_url" => $item_url,
	 "url_1" => $_POST['url_1'],
	 "url_2" => $_POST['url_2'],
	"url_3" => $_POST['url_3'],
	"url_4" => $_POST['url_4'],
	"url_5" => $_POST['url_5'],
	"url_6" => $_POST['url_6'],
	"url_7" => $_POST['url_7'],
	"url_8" => $_POST['url_8'],
	"url_9" => $_POST['url_9'],
	"url_10" => $_POST['url_10']

		
	);


}














    // 判断是否支持CURL
if (!function_exists('curl_init') || !function_exists('curl_exec')) {
        exit('您的主机不支持Curl，请开启~');
}




    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,"http://shengyicanmou.com/ajax/ajax_kspth.php");
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
if($cfg_ml->M_Money > $kspth){



$data=str_replace("\u6dd8\u53e3\u4ee4\u5df2\u751f\u6210\uff0c\u79ef\u5206 -0","\u6dd8\u53e3\u4ee4\u5df2\u751f\u6210\uff0c\u79ef\u5206 -".$kspth,$data);

$dsql->ExecNoneQuery("UPDATE  `dede_member` SET  `money` = money -".$kspth.",`scores` = scores +".$kspth." WHERE  `mid` =".$cfg_ml->M_ID.";");



print_r($data);

}else{



$arr = array ('err'=>'0','msg'=>'您的积分不足,查询失败！');
print_r(json_encode($arr));

}


}





?>