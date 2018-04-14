<?php
define('DEDEADMIN', str_replace("\\", '/', dirname(__FILE__) ) );
require_once(DEDEADMIN.'/../member/config.php');
$class = dirname(__FILE__) . '/class.php'; 

require_once($class);

$url2 = "http://www.qiaodalianmeng.com/rankQuery.htm";
$content = get_content($url2, $cookie);

$post = array(
    'q' => $_POST['key'],
    'itemId' => $_POST['id'],
    'type' => 1,
    'mode' => $_POST['mod'],
    'sort' => $_POST['sort'],
    'page' => $_POST['page'],
    'nick' => $_POST['shop_nick'],
    'buyer' => '',
);
$post = json_encode($post);
//$mod=$_POST['mod'];
//
//if($mod=="id"){
//
//$so=$_POST['so'];
//$sort=$_POST['sort'];
//$page=$_POST['page'];
//$serv=$_POST['serv'];
//$key=$_POST['key'];
//$id=$_POST['id'];
//
//$post_data = array(
//         "so" => $so,
//         "mod" => $mod,
//		 "sort" => $sort,
//		 "page" => $page,
//		 "serv" => $serv,
//		"key" => $key,
//		"id" => $id
//       );
//
//
//}else if($mod=="shop"){
//
//$so=$_POST['so'];
//$sort=$_POST['sort'];
//$page=$_POST['page'];
//$serv=$_POST['serv'];
//$key=$_POST['key'];
//$shop_nick=$_POST['shop_nick'];
//
//$post_data = array(
//         "so" => $so,
//         "mod" => $mod,
//		 "sort" => $sort,
//		 "page" => $page,
//		 "serv" => $serv,
//		"key" => $key,
//		"shop_nick" => $shop_nick
//       );
//
//}else if($mod=="all"){
//
//$so=$_POST['so'];
//$sort=$_POST['sort'];
//$page=$_POST['page'];
//$serv=$_POST['serv'];
//$key=$_POST['key'];
//
//
//$post_data = array(
//         "so" => $so,
//         "mod" => $mod,
//		 "sort" => $sort,
//		 "page" => $page,
//		 "serv" => $serv,
//		"key" => $key
//
//       );
//
//}




    // 判断是否支持CURL
if (!function_exists('curl_init') || !function_exists('curl_exec')) {
        exit('您的主机不支持Curl，请开启~');
}




    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,"http://www.qiaodalianmeng.com/rankQuery.htm");
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
	 curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_POSTFIELDS, array('data'=>$post));
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
	//curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl,CURLOPT_COOKIEFILE,$cookie); //读取cookie 
    $data = curl_exec($curl);
    curl_close($curl);
    


if($cfg_ml->M_Rank == "20"){

print_r($data);
}else{

if($cfg_ml->M_Money > $cpm){



$data=str_replace("\u67e5\u8be2\u5b8c\u6210\uff0c\u79ef\u5206 -0","\u67e5\u8be2\u5b8c\u6210\uff0c\u79ef\u5206 -".$cpm,$data);

$dsql->ExecNoneQuery("UPDATE  `dede_member` SET  `money` = money -".$cpm.",`scores` = scores +".$cpm." WHERE  `mid` =".$cfg_ml->M_ID.";");


print_r($data);

}else{



$arr = array ('err'=>'0','msg'=>'您的积分不足,查询失败！');
print_r(json_encode($arr));

}


}






?>