<?php



function login_post($url, $cookie, $post) { 
    $curl = curl_init();//初始化curl模块 
    curl_setopt($curl, CURLOPT_URL,$url);//登录提交的地址 
    curl_setopt($curl, CURLOPT_HEADER, 0);//是否显示头信息 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//是否自动显示返回的信息 
    curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie); //设置Cookie信息保存在指定的文件中 
    curl_setopt($curl, CURLOPT_POST,1);//post方式提交 
    curl_setopt($curl, CURLOPT_POSTFIELDS,$post);//要提交的信息 
    $rs=curl_exec($curl);//执行cURL 
    curl_close($curl);//关闭cURL资源，并且释放系统资源 
	 return $rs; 
} 

function get_content($url,$cookie) { 
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_HEADER, 0); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie); //读取cookie 
    $rs = curl_exec($ch); //执行cURL抓取页面内容 
    curl_close($ch); 
    return $rs; 
} 



$post = array(
         'username' => 'xiaoyaoahui',
		  'password' => 'lihui508',
		   'btn-login' =>'"icon+icon-check-circle"></I>登+录'
		   );


$md5=md5("cookie_".floor(time()/1800));

//设置cookie保存路径 
$cookie = dirname(__FILE__) . '/cache/'.$md5.'.txt'; 


if(file_exists($cookie)){



}
else{


//登录地址 
$url = "http://shengyicanmou.com/login.php"; 

//登录后要获取信息的地址 
$url2 = "http://shengyicanmou.com/"; 
//模拟登录 
login_post($url,$cookie,$post); 
//获取登录页的信息 



}









?>