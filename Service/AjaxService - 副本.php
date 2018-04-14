<?php 

define('DEDEADMIN', str_replace("\\", '/', dirname(__FILE__) ) );
require_once(DEDEADMIN.'/../member/config.php');

$Method=$_GET['Method'];

if($Method=="MemDelete"){

$strMemID=$_POST['strMemID'];

$row=$dsql->ExecNoneQuery("Delete From ".$TAB_USER_NAME." where id='".$strMemID."' ");

if($row==1){
$arr = array ('result'=>"1");
print_r(json_encode($arr));
}else{
$arr = array ('result'=>"0");
print_r(json_encode($arr));
}



}else if($Method=="GoodsCode"){

$txtcode=$_POST['txtcode'];
$row=$dsql->GetOne("Select * From dede_goods_".$TAB_ID." where txtGoodsCode = '".$txtcode."'");

$txtGoodsName=$row['txtGoodsName'];
$txtGoodsName=iconv('gbk','utf-8',$txtGoodsName);

$arr = array ('txtGoodsCode'=>$row['txtGoodsCode'],'txtGoodsName'=>$txtGoodsName,'txtGoodsPrice'=>$row['txtGoodsPrice']);

print_r(json_encode($arr));

}else if($Method=="GoodsIn"){

$goodsAccount=$_POST['goodsAccount'];


$strgood=explode("$$$",$goodsAccount);

$r=false;
for($i=1;$i< count($strgood);$i++){

$rkgood=explode("#",$strgood[$i]);

$row=$dsql->ExecNoneQuery("UPDATE  `dede_goods_".$TAB_ID."` SET  `txtGoodsNumber` = txtGoodsNumber +".$rkgood[2].",`txtGoodsBidPrice` = ".$rkgood[1]."  WHERE  `txtGoodsCode` =".$rkgood[0].";");

if($row=="1"){
$r=true;
}else{
$r=false;
 break;

}

}

if($r){
print_r(json_encode(1));
}else{
print_r(json_encode(0));
}

//print_r($strgood);


//print_r(json_encode(0));


}else if($Method=="GoodsSoc"){

$key=$_POST['key'];
$key=iconv('utf-8','gbk',$key);



$row=$dsql->GetOne("Select * From dede_goods_".$TAB_ID." where txtGoodsCode = '".$key."' OR txtGoodsName = '".$key."' ");


if($row['txtGoodsCode']!="" || $row['txtGoodsName']!="" || $row['txtGoodsPrice']!=""){
$html='<tr class="td" onclick="javascript:OnGood(&quot;'.$row["txtGoodsCode"].'&quot;,&quot;'.$row["txtGoodsName"].'&quot;,&quot;'.$row["txtGoodsBidPrice"].'&quot;);"><td style="text-align: center">'.$row["txtGoodsName"].'</td><td>'.$row["txtGoodsCode"].'</td><td style="text-align: center">'.$row["txtGoodsBidPrice"].'</td><td style="text-align: center">'.$row["txtGoodsNumber"].'</td></tr>';
}else
{
$html="0";

}



echo $html;

}else if($Method=="MemPage"){


$txtQueryMem=$_POST['txtQueryMem'];

$sql = "SELECT * FROM  `".$TAB_USER_NAME."` where txtmemcard=".$txtQueryMem." OR txtMemName=".$txtQueryMem." OR txtMemMobile=".$txtQueryMem." OR txtCardNumber=".$txtQueryMem." ";

$dsql->SetQuery($sql);
$dsql->SetQuery($sql);
$dsql->Execute();

while($row = $dsql->GetArray()){


if($row["sltMemState"]=="0"){
	$sltMemState="正常";
	
	}else if($row["sltMemState"]=="1"){
	$sltMemState="锁定";
	}else if($row["sltMemState"]=="2"){
	$sltMemState="挂失";
	}


$html=$html.'<tr class="td"><td><span id="gvMemList_ctl00_lblNumber">'.$row['id'].'</span></td><td><a href="/member/memregister.php?id='.$row['id'].'">'.$row['txtmemcard'].'</a></td><td style="text-align: left">'.$row['txtMemName'].'</td><td>'.$row['txtMemMobile'].'</td><td style="">'.$row['txtMemMoney'].'</td><td style="">'.$row['txtMemPoint'].'</td><td style="display:none">'.$row['times'].'</td><td style="display:none">'.$row['ption'].'</td><td>'.$row['sltMemLevelID'].'</td><td>'.$sltMemState.'</td><td>'.$row['txtMemBirthday'].'</td><td>'.$row['sltShop'].'</td><td>'.$row['txtMemCreateTime'].'</td><td>'.$row['sltMemUserID'].'</td><td class="listtd"style="width: 60px;"><a href="/member/memregister.php?id='.$row['id'].'" id="gvMemList_ctl00_hyEdit"><img src="../images/Gift/eit.png"alt="编辑"title="编辑"></a><a href="#" id="gvMemList_ctl00_hyDel" onclick="return DeleteMem(&quot;'.$row['txtmemcard'].'&quot;,&quot;'.$row['id'].'&quot;)"><img src="../images/Gift/del.png"alt="删除"title="删除"></a></td></tr>';

}

if($html!=""){
echo $html;
}else{
echo 0;
}


}else if($Method=="Query"){

$txtFindMember=$_POST['txtFindMember'];

$row=$dsql->GetOne("Select * From ".$TAB_USER_NAME." where txtmemcard = '".$txtFindMember."' OR txtMemMobile = '".$txtFindMember."' OR txtCardNumber = '".$txtFindMember."' ".$ENV_SHOP_QUERY);

if(count($row) <= 1){
$arr = array ('msg'=>0);
print_r(json_encode($arr));
}else{



$txtMemName=iconv('gbk','utf-8',$row['txtMemName']);
$sltShop=iconv('gbk','utf-8',$row['sltShop']);
$txtMemPassword=iconv('gbk','utf-8',$row['txtMemPassword']);
$txtMemPasswordCheck=iconv('gbk','utf-8',$row['txtMemPasswordCheck']);
$txtMemMobile=iconv('gbk','utf-8',$row['txtMemMobile']);
$sltMemState=iconv('gbk','utf-8',$row['sltMemState']);
$sltMemLevelID=iconv('gbk','utf-8',$row['sltMemLevelID']);
$txtMemBirthday=iconv('gbk','utf-8',$row['txtMemBirthday']);
$sltMemSex=iconv('gbk','utf-8',$row['sltMemSex']);
$txtMemPoint=iconv('gbk','utf-8',$row['txtMemPoint']);
$txtMemMoney=iconv('gbk','utf-8',$row['txtMemMoney']);
$txtMemEmail=iconv('gbk','utf-8',$row['txtMemEmail']);

$txtTelephone=iconv('gbk','utf-8',$row['txtTelephone']);
$txtMemIdentityCard=iconv('gbk','utf-8',$row['txtMemIdentityCard']);
$txtMemCreateTime=iconv('gbk','utf-8',$row['txtMemCreateTime']);
$sltMemUserID=iconv('gbk','utf-8',$row['sltMemUserID']);


$txtMemRecommendCard=iconv('gbk','utf-8',$row['txtMemRecommendCard']);
$txtMemPastTime=iconv('gbk','utf-8',$row['txtMemPastTime']);
$sltStaff=iconv('gbk','utf-8',$row['sltStaff']);
$txtRegisterStaffMoney=iconv('gbk','utf-8',$row['txtRegisterStaffMoney']);

$txtCardNumber=iconv('gbk','utf-8',$row['txtCardNumber']);
$ucSysArea_sltProvince=iconv('gbk','utf-8',$row['ucSysArea_sltProvince']);
$ucSysArea_sltCity=iconv('gbk','utf-8',$row['ucSysArea_sltCity']);
$ucSysArea_sltCounty=iconv('gbk','utf-8',$row['ucSysArea_sltCounty']);
$ucSysArea_sltVillage=iconv('gbk','utf-8',$row['ucSysArea_sltVillage']);
$txtMemAddress=iconv('gbk','utf-8',$row['txtMemAddress']);
$txtMemRemark=iconv('gbk','utf-8',$row['txtMemRemark']);


$DJ=$dsql->GetOne("Select * From `dede_grade_".$TAB_ID."` where sltMemLevelID = '".$row['sltMemLevelID']."' ");

$consumption=iconv('gbk','utf-8',$DJ['consumption']);
$discount=iconv('gbk','utf-8',$DJ['discount']);
$Recharge=iconv('gbk','utf-8',$DJ['Recharge']);

$txtMemPassword=iconv('gbk','utf-8',$row['txtMemPassword']);


if($txtMemPassword ==""){
$txtMemPassword="flase";
}else{
$txtMemPassword="true";
}

$arr = array ('msg'=>1,'txtmemcard'=>$row['txtmemcard'],'txtMemName'=>$txtMemName,'txtMemMobile'=>$txtMemMobile,'sltShop'=>$sltShop,'sltMemState'=>$sltMemState,'sltMemLevelID'=>$sltMemLevelID,'txtMemPoint'=>$txtMemPoint,'txtMemBirthday'=>$txtMemBirthday,'sltMemSex'=>$sltMemSex,'txtMemMoney'=>$txtMemMoney,'txtMemEmail'=>$txtMemEmail,'txtTelephone'=>$txtTelephone,'txtMemIdentityCard'=>$txtMemIdentityCard,'txtMemCreateTime'=>$txtMemCreateTime,'sltMemUserID'=>$sltMemUserID,'txtMemRecommendCard'=>$txtMemRecommendCard,'txtMemPastTime'=>$txtMemPastTime,'sltStaff'=>$sltStaff,'txtRegisterStaffMoney'=>$txtRegisterStaffMoney,'txtCardNumber'=>$txtCardNumber,'ucSysArea_sltProvince'=>$ucSysArea_sltProvince,'ucSysArea_sltCity'=>$ucSysArea_sltCity,'ucSysArea_sltCounty'=>$ucSysArea_sltCounty,'ucSysArea_sltVillage'=>$ucSysArea_sltVillage,'txtMemAddress'=>$txtMemAddress,'txtMemRemark'=>$txtMemRemark,'times'=>$row['times'],'ption'=>$row['ption'],'consumption'=>$consumption,'discount'=>$discount,'Recharge'=>$Recharge,'txtMemPassword'=>$txtMemPassword);

print_r(json_encode($arr));


}




}else if($Method=="RechargeMoney"){

$MemCard=$_POST['MemCard'];
$Name=$_POST['Name'];
$Money=$_POST['Money'];
$Point=$_POST['Point'];
$txtTotal=$_POST['txtTotal'];
$row=$dsql->ExecNoneQuery("UPDATE  `".$TAB_USER_NAME."` SET  `txtMemMoney` = txtMemMoney+".$txtTotal." ,`txtMemPoint` = txtMemPoint+".$Point." WHERE  `txtmemcard` =".$MemCard.";");
if($row==1){

echo '1';

}else{
echo '0';

}

}else if($Method=="MemLevelDelete"){



$LevelID=$_POST['LevelID'];

$DJXX=$dsql->GetOne("Select * From `dede_grade_".$TAB_ID."` where id = '".$LevelID."' ");

$dsql = new DedeSql(false);
$dsql->SetQuery("Select * from `".$TAB_USER_NAME."` where sltMemLevelID='".$DJXX['sltMemLevelID']."' ");
$dsql->Execute();
$ns = $dsql->GetTotalRow();



if($ns > 0){
echo '-1';
exit;
	}


$row=$dsql->ExecNoneQuery("Delete From `dede_grade_".$TAB_ID."` where id='".$LevelID."' ");

if($row==1){
echo '1';
}else{
echo '0';
}


}else if($Method=="ChangeCard"){

$MemCard=$_POST['MemCard'];
$Name=$_POST['Name'];
$txtOldPwd=$_POST['txtOldPwd'];
$txtNewCard=$_POST['txtNewCard'];
$txtNewPwd=$_POST['txtNewPwd'];
$txtReNewPwd=$_POST['txtReNewPwd'];
$txtCgCardRemark=$_POST['txtCgCardRemark'];



$row1 = $dsql->GetOne("SELECT * FROM `".$TAB_USER_NAME."` WHERE txtmemcard='".$MemCard."' ");

if($txtOldPwd==$row1['txtMemPassword']){
}else{
echo '2';
exit;
}


if($txtNewPwd==$txtReNewPwd){
}else{
echo '3';
exit;
}

$row2 = $dsql->GetOne("SELECT * FROM `".$TAB_USER_NAME."` WHERE txtmemcard='".$txtNewCard."' ");
if(count($row2) <= 1){

}else{
echo '4';
exit;
}

if($txtNewPwd=="" && $txtReNewPwd==""){

$row=$dsql->ExecNoneQuery("UPDATE  `".$TAB_USER_NAME."` SET  `txtmemcard` =  '".$txtNewCard."' WHERE  `txtmemcard` =".$MemCard.";");

}else{
$row=$dsql->ExecNoneQuery("UPDATE  `".$TAB_USER_NAME."` SET  `txtmemcard` =  '".$txtNewCard."',`txtMemPassword` =  '".$txtNewPwd."' WHERE  `txtmemcard` =".$MemCard.";");
}




if($row==1){
echo '1';
}else{
echo '0';
}

}else if($Method=="Delay"){

$MemCard=$_POST['MemCard'];
$Name=$_POST['Name'];
$DelayTime=$_POST['DelayTime'];

$row1 = $dsql->GetOne("SELECT * FROM `".$TAB_USER_NAME."` WHERE txtmemcard='".$MemCard."' ");

if(count($row1) <= 1){
echo '0';
exit;
}else{
$txtMemPastTime=str_replace("年","-",$row1['txtMemPastTime']);
$txtMemPastTime=str_replace("月","-",$txtMemPastTime);
$txtMemPastTime=str_replace("日","",$txtMemPastTime);
$ytime=strtotime($txtMemPastTime);
$time=(int)$DelayTime*2592000;
$ttime=$ytime+$time;

$bttime=date('Y-m-d',$ttime); 

$row=$dsql->ExecNoneQuery("UPDATE  `".$TAB_USER_NAME."` SET  `txtMemPastTime` =  '".$bttime."'  WHERE  `txtmemcard` =".$MemCard.";");
if($row==1){
echo '1';
}else{
echo '0';
}
}


}else if($Method=="MemLock"){

$MemCard=$_POST['MemCard'];
$Name=$_POST['Name'];
$DelayTime=$_POST['DelayTime'];

$row=$dsql->ExecNoneQuery("UPDATE  `".$TAB_USER_NAME."` SET  `sltMemState` =  '".$DelayTime."'  WHERE  `txtmemcard` =".$MemCard.";");
if($row==1){
echo '1';
}else{
echo '0';
}

}else if($Method=="MemChangePwd"){


$MemCard=$_POST['MemCard'];
$Name=$_POST['Name'];
$txtNewPwd=$_POST['txtNewPwd'];
$txtRePwd=$_POST['txtRePwd'];
if($txtNewPwd==$txtRePwd){

$row=$dsql->ExecNoneQuery("UPDATE  `".$TAB_USER_NAME."` SET  `txtMemPassword` =  '".$txtNewPwd."'  WHERE  `txtmemcard` =".$MemCard.";");

if($row==1){
echo '1';
}else{
echo '0';
}

}else{
echo '2';
}
}else if($Method=="PointChange"){

$MemCard=$_POST['MemCard'];
$Name=$_POST['Name'];
$type=$_POST['type'];
$txtFMemPoint=$_POST['txtFMemPoint'];

if($type=="0"){
$row=$dsql->ExecNoneQuery("UPDATE  `".$TAB_USER_NAME."` SET  `txtMemPoint` = txtMemPoint+'".$txtFMemPoint."'  WHERE  `txtmemcard` =".$MemCard.";");
}else{
$row=$dsql->ExecNoneQuery("UPDATE  `".$TAB_USER_NAME."` SET  `txtMemPoint` = txtMemPoint-'".$txtFMemPoint."'  WHERE  `txtmemcard` =".$MemCard.";");
}

if($row==1){
echo '1';
}else{
echo '0';
}

}else if($Method=="GoodDelete"){
$strMemID=$_POST['strMemID'];

$row=$dsql->ExecNoneQuery("Delete From `dede_commodity_".$TAB_ID."` where id='".$strMemID."' ");

if($row==1){
$arr = array ('result'=>"1");
print_r(json_encode($arr));
}else{
$arr = array ('result'=>"0");
print_r(json_encode($arr));
}

}else if($Method=="GoodsAddAndEdit"){




$txtGoodsCode=$_POST['txtGoodsCode'];
$chkService=$_POST['chkService'];
$txtGoodsSalePercent=$_POST['txtGoodsSalePercent'];
$txtGoodsName=iconv('utf-8','gbk',$_POST['txtGoodsName']);
$txtGoodsNameCode=iconv('utf-8','gbk',$_POST['txtGoodsNameCode']);
$sltGoodsClass=iconv('utf-8','gbk',$_POST['sltGoodsClass']);
$sltjldw=iconv('utf-8','gbk',$_POST['sltjldw']);
$txtGoodsPrice=iconv('utf-8','gbk',$_POST['txtGoodsPrice']);
$txtGoodsBidPrice=iconv('utf-8','gbk',$_POST['txtGoodsBidPrice']);
$sltCommissionType=iconv('utf-8','gbk',$_POST['sltCommissionType']);
$txtCommissionNumber=iconv('utf-8','gbk',$_POST['txtCommissionNumber']);
$sltShopList=iconv('utf-8','gbk',$_POST['sltShopList']);
$txtGoodsPoint=iconv('utf-8','gbk',$_POST['txtGoodsPoint']);
$txtGoodsRemark=iconv('utf-8','gbk',$_POST['txtGoodsRemark']);

$txtGoodsNumber=iconv('utf-8','gbk',$_POST['txtGoodsNumber']);
$txtGoodsMinPercent=iconv('utf-8','gbk',$_POST['txtGoodsMinPercent']);

$typeid=$_POST['typeid'];




$row1 = $dsql->GetOne("SELECT * FROM `dede_goods_".$TAB_ID."` WHERE txtGoodsCode='".$txtGoodsCode."' ");


if($typeid=="0"){

if(count($row1) > 1){
echo '-1';
exit;
}}

if($typeid=="0"){
$row=$dsql->ExecNoneQuery("INSERT INTO  `dede_goods_".$TAB_ID."` (`id` ,`txtGoodsCode` ,`txtGoodsName` ,`txtGoodsNameCode` ,`sltGoodsClass` ,`chkService` ,`sltjldw` ,`txtGoodsPrice` ,`txtGoodsBidPrice` ,`txtGoodsSalePercent` ,`txtGoodsMinPercent` ,`sltCommissionType` ,`txtCommissionNumber` ,`sltShopList` ,`txtGoodsPoint` ,`txtGoodsNumber` ,`txtGoodsRemark`)VALUES (NULL ,  '".$txtGoodsCode."',  '".$txtGoodsName."',  '".$txtGoodsNameCode."',  '".$sltGoodsClass."',  '".$chkService."',  '".$sltjldw."',  '".$txtGoodsPrice."',  '".$txtGoodsBidPrice."',  '".$txtGoodsSalePercent."',  '".$txtGoodsMinPercent."',  '".$sltCommissionType."',  '".$txtCommissionNumber."',  '".$sltShopList."',  '".$txtGoodsPoint."', '".$txtGoodsNumber."', '".$txtGoodsRemark."');");

}else{

$row=$dsql->ExecNoneQuery("UPDATE  `dede_goods_".$TAB_ID."` SET  `chkService` =  '".$chkService."',`txtGoodsName` = '".$txtGoodsName."',`txtGoodsNameCode` = '".$txtGoodsNameCode."',`sltGoodsClass` = '".$sltGoodsClass."',`txtGoodsRemark` = '".$txtGoodsRemark."',`sltjldw` = '".$sltjldw."',`txtGoodsPrice` = '".$txtGoodsPrice."',`txtGoodsBidPrice` = '".$txtGoodsBidPrice."',`txtGoodsSalePercent` = '".$txtGoodsSalePercent."',`txtGoodsMinPercent` = '".$txtGoodsMinPercent."',`txtGoodsPoint` = '".$txtGoodsPoint."',`txtGoodsNumber` = '".$txtGoodsNumber."' WHERE  `id` =".$typeid.";");


}


if($row==1){

echo '1';
}else{
echo '0';
}







}else if($Method=="GoodListDelete"){

$strMemID=$_POST['strMemID'];

$row=$dsql->ExecNoneQuery("Delete From dede_goods_".$TAB_ID." where id='".$strMemID."' ");

if($row==1){
$arr = array ('result'=>"1");
print_r(json_encode($arr));
}else{
$arr = array ('result'=>"0");
print_r(json_encode($arr));
}

}else if($Method=="GoodsListPage"){






$txtQueryMem=$_POST['txtQueryMem'];

$sql = "SELECT * FROM  `dede_goods_".$TAB_ID."` where txtGoodsCode=".$txtQueryMem." OR txtGoodsName=".$txtQueryMem."  OR txtGoodsNameCode=".$txtQueryMem." ";

$dsql->SetQuery($sql);
$dsql->SetQuery($sql);
$dsql->Execute();

while($row = $dsql->GetArray()){


if($row["chkService"]=="on"){
$type='<span style="color:red;">服务商品</span>';
}else{
$type='普通商品';
}

$row1 = $dsql->GetOne("SELECT * FROM `dede_commodity_".$TAB_ID."` WHERE id='".$row['sltGoodsClass']."' ");

$html=$html.'<tr class="td"><td><span id="gvMemList_ctl00_lblNumber">'.$row['id'].'</span></td><td>'.$row['txtGoodsCode'].'</td><td style="text-align: center">'.$row['txtGoodsName'].'</td><td>'.$row['txtGoodsNameCode'].'</td><td style="text-align: center">'.$type.'</td><td style="text-align: center">'.$row['sltjldw'].'</td><td style="text-align: center">'.$row['txtGoodsPrice'].'</td><td style="text-align: center">'.$row1["typename"].'</td> <td class="listtd" style="width: 60px;">
                          <a href="/member/GoodsAdd.php?id='.$row['id'].'" id="gvMemList_ctl00_hyEdit">
                                                <img src="../images/Gift/eit.png" alt="编辑" title="编辑" />
                                            </a><a href="#" id="gvMemList_ctl00_hyDel" onclick="return DeleteMem(&quot;'.$row['txtGoodsCode'].'&quot;,&quot;'.$row['id'].'&quot;)">
                                                <img src="../images/Gift/del.png" alt="删除" title="删除" /></a>
                                        </td></tr>';

}

if($html!=""){
echo $html;
}else{
echo 0;
}








}else if($Method=="StockList"){






$txtQueryMem=$_POST['txtQueryMem'];

$sql = "SELECT * FROM  `dede_goods_".$TAB_ID."` where txtGoodsCode=".$txtQueryMem." OR txtGoodsName=".$txtQueryMem."  OR txtGoodsNameCode=".$txtQueryMem." ";

$dsql->SetQuery($sql);
$dsql->SetQuery($sql);
$dsql->Execute();

while($row = $dsql->GetArray()){




$html=$html.'<tr class="td"><td><span id="gvMemList_ctl00_lblNumber">'.$row['txtGoodsCode'].'</span></td><td>'.$row['txtGoodsName'].'</td><td style="text-align: center">'.$row['txtGoodsNameCode'].'</td><td>'.$row['txtGoodsNumber'].'</td></tr>';

}

if($html!=""){
echo $html;
}else{
echo 0;
}








}else if($Method=="Expense"){


$MemCard=$_POST['MemCard'];
$Name=$_POST['Name'];
$Money=$_POST['Money'];
$Point=$_POST['Point'];
$row=$dsql->ExecNoneQuery("UPDATE  `".$TAB_USER_NAME."` SET  `txtMemMoney` = txtMemMoney-".$Money." ,`txtMemPoint` = txtMemPoint+".$Point." WHERE  `txtmemcard` =".$MemCard.";");
if($row==1){

echo '1';

}else{
echo '0';

}

}else if($Method=="GiftAdd"){

$giftID=$_POST['giftID'];

$giftCode=$_POST['giftCode'];
$giftClassID=$_POST['giftClassID'];
$giftStockNumber=$_POST['giftStockNumber'];
$giftExchangePoint=$_POST['giftExchangePoint'];
$giftPhoto=$_POST['giftPhoto'];
$giftExchangeNumber=$_POST['giftExchangeNumber'];

$giftName=iconv('utf-8','gbk',$_POST['giftName']);

$giftRemark=iconv('utf-8','gbk',$_POST['giftRemark']);

$row=$dsql->ExecNoneQuery("INSERT INTO  `dede_gift_".$TAB_ID."` (`id` ,`giftID` ,`giftName` ,`giftCode` ,`giftClassID` ,`giftStockNumber` ,`giftExchangePoint` ,`giftPhoto` ,`giftExchangeNumber` ,`giftRemark`)VALUES (NULL ,  '".$giftID."',  '".$giftName."',  '".$giftCode."',  '".$giftClassID."',  '".$giftStockNumber."',  '".$giftExchangePoint."',  '".$giftPhoto."',  '".$giftExchangeNumber."',  '".$giftRemark."');");


if($row==1){

echo '1';
}else{
echo '0';
}


}else if($Method=="GiftDel"){
$GiftID=$_POST['GiftID'];


$row=$dsql->ExecNoneQuery("Delete From `dede_gift_".$TAB_ID."` where id='".$GiftID."' ");

if($row==1){

echo '1';
}else{
echo '0';
}


}else if($Method=="GetGiftModel"){

$GiftID=$_POST['GiftID'];

$row1 = $dsql->GetOne("SELECT * FROM `dede_gift_".$TAB_ID."` WHERE id='".$GiftID."' ");

$arr = array ('GiftName'=>$row1['giftName'],'GiftCode'=>$row1['giftCode'],'GiftClassID'=>"",'GiftRemark'=>$row1['giftRemark'],'GiftPhoto'=>"",'GiftStockNumber'=>$row1['giftStockNumber'],'GiftExchangePoint'=>$row1['giftExchangePoint'],'GiftExchangeNumber'=>"",'GiftID'=>$row1['id']);
print_r(json_encode($arr));

}else if($Method=="GiftEdit"){

$giftID=$_POST['giftID'];
$giftName=$_POST['giftName'];
$giftCode=$_POST['giftCode'];
$giftClassID=$_POST['giftClassID'];
$giftStockNumber=$_POST['giftStockNumber'];
$giftExchangePoint=$_POST['giftExchangePoint'];
$giftPhoto=$_POST['giftPhoto'];
$giftExchangeNumber=$_POST['giftExchangeNumber'];


$giftRemark=iconv('utf-8','gbk',$_POST['giftRemark']);


if($giftID==""){
$row=$dsql->ExecNoneQuery("INSERT INTO  `dede_gift_".$TAB_ID."` (`id` ,`giftID` ,`giftName` ,`giftCode` ,`giftClassID` ,`giftStockNumber` ,`giftExchangePoint` ,`giftPhoto` ,`giftExchangeNumber` ,`giftRemark`)VALUES (NULL ,  '".$giftID."',  '".$giftName."',  '".$giftCode."',  '".$giftClassID."',  '".$giftStockNumber."',  '".$giftExchangePoint."',  '".$giftPhoto."',  '".$giftExchangeNumber."',  '".$giftRemark."');");
}else{
$row=$dsql->ExecNoneQuery("UPDATE  `dede_gift_".$TAB_ID."` SET  `giftName` = '".$giftName."',`giftCode` = '".$giftCode."',`giftStockNumber` = '".$giftStockNumber."',`giftExchangePoint` = '".$giftExchangePoint."',`giftRemark` = '".$giftRemark."' WHERE  `id` =".$giftID.";");
}





if($row==1){

echo '1';
}else{
echo '0';
}


}else if($Method=="ShopAdd"){

$shopID=$_POST['shopID'];


$shopName=iconv('utf-8','gbk',$_POST['shopName']);
$giftRemark=iconv('utf-8','gbk',$_POST['giftRemark']);
$shopContactMan=iconv('utf-8','gbk',$_POST['shopContactMan']);
$shopTelephone=iconv('utf-8','gbk',$_POST['shopTelephone']);
$shopAddress=iconv('utf-8','gbk',$_POST['shopAddress']);
$isChoose=iconv('utf-8','gbk',$_POST['isChoose']);
$shopRemark=iconv('utf-8','gbk',$_POST['shopRemark']);



$shopTitle=$_POST['shopTitle'];
$shopFoot=$_POST['shopFoot'];
$shopSmsName=$_POST['shopSmsName'];
$isChoose=$_POST['isChoose'];
$txtSettlementInterval=$_POST['txtSettlementInterval'];
$txtShopProportion=$_POST['txtShopProportion'];
$isAllianceProgram=$_POST['isAllianceProgram'];
$fatherShopID=$_POST['fatherShopID'];
$PointType=$_POST['PointType'];
$SmsType=$_POST['SmsType'];

$row=$dsql->ExecNoneQuery("INSERT INTO `dede_shop_".$TAB_ID."` (`id` ,`name` ,`contacts` ,`phone` ,`address` ,`state` ,`remarks`)VALUES (NULL ,  '".$shopName."', '".$shopContactMan."' , '".$shopTelephone."' , '".$shopAddress."' , '".$isChoose."' , '".$shopRemark."');");

if($row==1){

echo '1';
}else{
echo '0';
}


}else if($Method=="GetShopInfo"){


$shopID=$_POST['shopID'];


$row1 = $dsql->GetOne("SELECT * FROM `dede_shop_".$TAB_ID."` WHERE id='".$shopID."' ");

$shopName=iconv('gbk','utf-8',$row1['name']);
$contacts=iconv('gbk','utf-8',$row1['contacts']);
$phone=iconv('gbk','utf-8',$row1['phone']);
$address=iconv('gbk','utf-8',$row1['address']);


if($row1['state']=="0"){
$state="True";
}else{
$state="False";
}

$remarks=iconv('gbk','utf-8',$row1['remarks']);



$arr = array ('ShopName'=>$shopName,'ShopContactMan'=>$contacts,'ShopTelephone'=>$phone,'ShopAddress'=>$address,'ShopState'=>$state,'ShopRemark'=>$remarks,'ShopID'=>$row1['id']);
print_r(json_encode($arr));



}else if($Method=="ShopEdit"){


$shopID=$_POST['shopID'];
$shopName=iconv('utf-8','gbk',$_POST['shopName']);
$giftRemark=iconv('utf-8','gbk',$_POST['giftRemark']);
$shopContactMan=iconv('utf-8','gbk',$_POST['shopContactMan']);
$shopTelephone=iconv('utf-8','gbk',$_POST['shopTelephone']);
$shopAddress=iconv('utf-8','gbk',$_POST['shopAddress']);
$isChoose=iconv('utf-8','gbk',$_POST['isChoose']);
$shopRemark=iconv('utf-8','gbk',$_POST['shopRemark']);

$row=$dsql->ExecNoneQuery("UPDATE  `dede_shop_".$TAB_ID."` SET  `name` = '".$shopName."' ,`contacts` = '".$shopContactMan."',`phone` = '".$shopTelephone."',`address` = '".$shopAddress."',`state` = '".$isChoose."',`remarks` = '".$shopRemark."' WHERE  `id` =".$shopID.";");
if($row==1){

echo '1';

}else{
echo '0';

}




}else if($Method=="ShopListPage"){


$txtQueryMem=$_POST['txtQueryMem'];

$sql = "SELECT * FROM  `dede_shop_".$TAB_ID."` where name=".$txtQueryMem." OR contacts=".$txtQueryMem."  OR phone=".$txtQueryMem."   OR address=".$txtQueryMem."";

$dsql->SetQuery($sql);
$dsql->SetQuery($sql);
$dsql->Execute();

while($row = $dsql->GetArray()){


if($row["state"]=="0"){$isChoose="是";}else{$isChoose="否";}

$html=$html.'<tr class="td"><td><span id="gvMemList_ctl00_lblNumber">'.$row['id'].'</span></td><td>'.$row['name'].'</td><td style="">'.$row['contacts'].'</td><td>'.$row['phone'].'</td><td>'.$row['address'].'</td><td>'.$isChoose.'</td><td>'.$row['remarks'].'</td><td class="listtd" style="width: 60px;">
                                            <a href="#" id="gvwGiftList_ctl01_hyGiftEdit" onclick="ShopEdit(&quot; '.$row['name'].'&quot;,&quot;'.$row['id'].'&quot;)">
                                                <img src="/static/eit.png" alt="编辑" title="编辑"></a> 
                                        </td></tr>';

}

if($html!=""){
echo $html;
}else{
echo 0;
}


}else if($Method=="RulesAdd"){

	
$RulesName=iconv('utf-8','gbk',$_POST['RulesName']);
$RulesInterval=iconv('utf-8','gbk',$_POST['RulesInterval']);
$RulesUnitPrice=iconv('utf-8','gbk',$_POST['RulesUnitPrice']);
$RulesExceedTime=iconv('utf-8','gbk',$_POST['RulesExceedTime']);
$RulesID=iconv('utf-8','gbk',$_POST['RulesID']);
$RulesRemark=iconv('utf-8','gbk',$_POST['RulesRemark']);

$row=$dsql->ExecNoneQuery("INSERT INTO  `dede_project_".$TAB_ID."` (`id` ,`txtRulesName` ,`txtRulesInterval` ,`txtRulesUnitPrice` ,`txtRulesExceedTime` ,`txtRulesRemark`)VALUES (NULL ,  '".$RulesName."', '".$RulesInterval."' , '".$RulesUnitPrice."' , '".$RulesExceedTime."' , '".$RulesRemark."');");


if($row==1){

echo '1';

}else{
echo '0';

}


}else if($Method=="GetRules"){

$RulesID=$_POST['RulesID'];


$row1 = $dsql->GetOne("SELECT * FROM `dede_project_".$TAB_ID."` WHERE id='".$RulesID."' ");

$txtRulesName=iconv('gbk','utf-8',$row1['txtRulesName']);
$txtRulesInterval=iconv('gbk','utf-8',$row1['txtRulesInterval']);
$txtRulesUnitPrice=iconv('gbk','utf-8',$row1['txtRulesUnitPrice']);
$txtRulesExceedTime=iconv('gbk','utf-8',$row1['txtRulesExceedTime']);
$txtRulesRemark=iconv('gbk','utf-8',$row1['txtRulesRemark']);

$arr = array ('RulesName'=>$txtRulesName,'RulesInterval'=>$txtRulesInterval,'RulesUnitPrice'=>$txtRulesUnitPrice,'RulesExceedTime'=>$txtRulesExceedTime,'RulesRemark'=>$txtRulesRemark,'RulesID'=>$row1['id']);
print_r(json_encode($arr));

}else if($Method=="RulesEdit"){

$RulesName=iconv('utf-8','gbk',$_POST['RulesName']);
$RulesInterval=iconv('utf-8','gbk',$_POST['RulesInterval']);
$RulesUnitPrice=iconv('utf-8','gbk',$_POST['RulesUnitPrice']);
$RulesExceedTime=iconv('utf-8','gbk',$_POST['RulesExceedTime']);
$RulesID=iconv('utf-8','gbk',$_POST['RulesID']);
$RulesRemark=iconv('utf-8','gbk',$_POST['RulesRemark']);

$row=$dsql->ExecNoneQuery("UPDATE `dede_project_".$TAB_ID."` SET  `txtRulesName` = '".$RulesName."' ,`txtRulesInterval` = '".$RulesInterval."',`txtRulesUnitPrice` = '".$RulesUnitPrice."',`txtRulesExceedTime` = '".$RulesExceedTime."',`txtRulesRemark` = '".$RulesRemark."' WHERE  `id` =".$RulesID.";");

if($row==1){

echo '1';

}else{
echo '0';

}

}else if($Method=="DelRules"){
$RulesID=$_POST['RulesID'];


$row=$dsql->ExecNoneQuery("Delete From `dede_project_".$TAB_ID."` where id='".$RulesID."' ");

if($row==1){

echo '1';

}else{
echo '0';

}

}else if($Method=="TimingProjectAdd"){

$ProjectName=iconv('utf-8','gbk',$_POST['ProjectName']);
$ProjectRulesID=iconv('utf-8','gbk',$_POST['ProjectRulesID']);
$ProjectRemark=iconv('utf-8','gbk',$_POST['ProjectRemark']);
$ProjectID=iconv('utf-8','gbk',$_POST['ProjectID']);

$time=time();
$row=$dsql->ExecNoneQuery("INSERT INTO  `dede_timing_".$TAB_ID."` (`id` ,`txtProjectName` ,`sltProjectRulesID` ,`txtProjectRemark`,`time`)VALUES (NULL ,  '".$ProjectName."',  '".$ProjectRulesID."',  '".$ProjectRemark."',  '".$time."');");

if($row==1){

echo '1';

}else{
echo '0';

}

}else if($Method=="DelTimingProject"){

$ProjectID=$_POST['ProjectID'];


$row=$dsql->ExecNoneQuery("Delete From `dede_timing_".$TAB_ID."` where id='".$ProjectID."' ");

if($row==1){

echo '1';

}else{
echo '0';

}


}else if($Method=="GetTimingProject"){

$ProjectID=$_POST['ProjectID'];

$row1 = $dsql->GetOne("SELECT * FROM `dede_timing_".$TAB_ID."` WHERE id='".$ProjectID."' ");

$ProjectName=iconv('gbk','utf-8',$row1['txtProjectName']);
$ProjectRulesID=iconv('gbk','utf-8',$row1['sltProjectRulesID']);
$ProjectRemark=iconv('gbk','utf-8',$row1['txtProjectRemark']);

$arr = array ('ProjectName'=>$ProjectName,'ProjectRulesID'=>$ProjectRulesID,'ProjectRemark'=>$ProjectRemark,'ProjectID'=>$row1['id']);
print_r(json_encode($arr));

}else if($Method=="TimingProjectEdit"){

$ProjectName=iconv('utf-8','gbk',$_POST['ProjectName']);
$ProjectRulesID=iconv('utf-8','gbk',$_POST['ProjectRulesID']);
$ProjectRemark=iconv('utf-8','gbk',$_POST['ProjectRemark']);
$ProjectID=iconv('utf-8','gbk',$_POST['ProjectID']);

$row=$dsql->ExecNoneQuery("UPDATE  `dede_timing_".$TAB_ID."` SET  `txtProjectName` =  '".$ProjectName."',`sltProjectRulesID` =  '".$ProjectRulesID."',`txtProjectRemark` =  '".$ProjectRemark."' WHERE `id` =".$ProjectID.";");

if($row==1){

echo '1';

}else{
echo '0';

}



}else if($Method=="TimingPage"){

$txtQueryMem=$_POST['txtQueryMem'];

$sql = "SELECT * FROM  `dede_timing_".$TAB_ID."` where txtProjectName='".$txtQueryMem."' ";


$dsql->SetQuery($sql);
$dsql->Execute();


while($row = $dsql->GetArray()){

$html=$html.'<tr class="td"><td><span id="gvMemList_ctl00_lblNumber">'.$row['id'].'</span></td><td>'.$row['txtProjectName'].'</td><td >'.$row['sltProjectRulesID'].'</td><td>'.date("Y-m-d",$row["time"]).'</td><td class="listtd" style="width: 60px;">
                                            <a href="#" id="gvTimingProject_ctl01_hyLevelEdit" onclick=" EditTimingProject(&quot;'.$row['id'].'&quot;)">
                                                <img src="../images/Gift/eit.png" alt="编辑" title="编辑" />
                                            </a><a href="#" id="gvTimingProject_ctl01_hyLevelDelete" onclick=" DeleteTimingProject(&quot;'.$row['id'].'&quot;,&quot;'.$row['txtProjectName'].'&quot;)">
                                                <img src="../images/Gift/del.png" alt="删除" title="删除" />
                                            </a>
                                        </td></tr>';

}

if($html!=""){
echo $html;
}else{
echo 0;
}

}else if($Method=="StaffDelete"){

$StaffID=$_POST['StaffID'];


$row=$dsql->ExecNoneQuery("Delete From `dede_staff_".$TAB_ID."` where id='".$StaffID."' ");

if($row==1){

echo '1';

}else{
echo '0';

}

}else if($Method=="StaffListPage"){



$txtQueryMem=$_POST['txtQueryMem'];

$txtQueryMem=iconv('utf-8','gbk',$_POST['txtQueryMem']);



$sql = "SELECT * FROM  `dede_staff_".$TAB_ID."` where code='".$txtQueryMem."' OR name='".$txtQueryMem."' OR phone='".$txtQueryMem."' ";


$dsql->SetQuery($sql);
$dsql->Execute();


while($row = $dsql->GetArray()){

$row1 = $dsql->GetOne("SELECT * FROM `dede_shop_".$TAB_ID."` WHERE id='".$row["shop"]."' ");	

if($row["sex"]=="0"){$sex='男';}else{$sex='女';}

$html=$html.'<tr class="td"><td><span id="gvMemList_ctl00_lblNumber">'.$row['code'].'</span></td><td>'.$row['name'].'</td><td style="text-align: center">'.$sex.'</td><td>'.$row['phone'].'</td><td>'.$row['address'].'</td><td>'.$row1["name"].'</td><td>'.$row["remarks"].'</td><td class="listtd" style="width: 60px;"><a href="/member/EditStaffList.php?id='.$row['id'].'" > <img src="../images/Gift/eit.png" alt="编辑" title="编辑"></a><a href="javascript:void(0);" onclick="javascript:StaffDelete('.$row['id'].',&quot;'.$row['name'].'&quot);"><img src="../images/Gift/del.png" alt="删除" title="删除"></a></td></tr>';

}

if($html!=""){
echo $html;
}else{
echo 0;
}



}else if($Method=="GoodsExpense"){

$txtByCardMoney=$_POST['txtByCardMoney'];
$txtByCashMoney=$_POST['txtByCashMoney'];
$txtByBankMoney=$_POST['txtByBankMoney'];
$txtWxMoney=$_POST['txtWxMoney'];
$WxCoupon=$_POST['WxCoupon'];
$txtFMemCard=$_POST['txtFMemCard'];
$dingdan=$_POST['dingdan'];
$txtTotalMoney=$_POST['txtTotalMoney'];
$txtMemName=iconv('utf-8','gbk',$_POST['txtMemName']);
$PayType="";
$txtMemCard=$_POST['txtMemCard'];

$lblTotalPoint=$_POST['lblTotalPoint'];
$type="商品消费";

if((float)$txtByCardMoney > 0){
$PayType="余额支付";
}

if((float)$txtByCashMoney > 0){

if($PayType==""){
$PayType="现金支付";
}else{
$PayType=$PayType.","."现金支付";
}

}


if((float)$txtByBankMoney > 0){
if($PayType==""){
$PayType="银联支付";
}else{
$PayType=$PayType.","."银联支付";
}
}


$row1=$dsql->GetOne("Select * From ".$TAB_USER_NAME." where txtmemcard = '".$txtFMemCard."'");


if((float)$row1['txtMemMoney'] < (float)$txtByCardMoney){
echo "-1";
exit;
}

$row=$dsql->ExecNoneQuery("UPDATE  ".$TAB_USER_NAME." SET  `txtMemMoney` = txtMemMoney- ".$txtByCardMoney.",`txtMemPoint` = txtMemPoint + ".(int)$lblTotalPoint." WHERE  `txtmemcard` ='".$txtFMemCard."';");



$row1=$dsql->ExecNoneQuery("INSERT INTO `dede_expense_".$TAB_ID."` (`id` ,`dingdan` ,`txtMemName` ,`txtMemCard` ,`type` ,`txtMemMoney` ,`txtTotalMoney` ,`txtMemPoint` ,`time`,`PayType`,`State`)VALUES (NULL ,  '".$dingdan."', '".$txtMemName."' , '".$txtMemCard."' , '".$type."' , '".$txtTotalMoney."' , '1' , '1' , '".time()."', '".$PayType."', '付款成功' );");




if($row==1){
echo '1';
}else{
echo '0';

}

}else if($Method=="GetPrjectByPage"){

$size=$_POST['size'];
$index=$_POST['index'];
$ProjectName=$_POST['ProjectName'];
$memID=$_POST['memID'];

$row2=$dsql->GetOne("Select * From ".$TAB_USER_NAME." where txtmemcard = '".$memID."'");
$TimingPrject=$row['TimingPrject'];


$query = "SELECT * FROM  `dede_timing_".$TAB_ID."` ";
 $dsql->SetQuery($query);
    $dsql->Execute();

$List="";
while($row = $dsql->GetArray())
    {       

$row1=$dsql->GetOne("Select * From `dede_project_".$TAB_ID."` where id = '".$row['sltProjectRulesID']."'");



$TimingPrject=json_decode($row2['TimingPrject'],true);

if($TimingPrject[$row['id']]==""){
$AllCount="0";
}else{
$AllCount=$TimingPrject[$row['id']]['time'];
}



if($List==""){


$List='{"RowNum":"1","ProjectID":"'.$row['id'].'","ProjectName":"'.$row['txtProjectName'].'","ProjectCategoryID":"0","ProjectRulesID":"'.$row['sltProjectRulesID'].'","ProjectAddTime":"'.date("y-m-d H:i:s",$row['time']).'","ProjectShopID":"1","ProjectUserID":"1","ProjectRemark":"","UserName":"超管","RulesName":"'.$row1['txtRulesName'].'","RulesRemark":"'.$row['txtProjectRemark'].'","RulesID":"'.$row['id'].'","AllCount":"'.$AllCount.'"}';
}else{

$List=$List.','.'{"RowNum":"1","ProjectID":"'.$row['id'].'","ProjectName":"'.$row['txtProjectName'].'","ProjectCategoryID":"0","ProjectRulesID":"'.$row['sltProjectRulesID'].'","ProjectAddTime":"'.date("y-m-d H:i:s",$row['time']).'","ProjectShopID":"1","ProjectUserID":"1","ProjectRemark":"","UserName":"超管","RulesName":"'.$row1['txtRulesName'].'","RulesRemark":"'.$row['txtProjectRemark'].'","RulesID":"'.$row['id'].'","AllCount":"'.$AllCount.'"}';
}


}


echo '{"RecordCount":7,"List":['.$List.']}';


}else if($Method=="MemStorageTiming"){


$txtByCardMoney=$_POST['txtByCardMoney'];
$txtByCashMoney=$_POST['txtByCashMoney'];
$txtByBankMoney=$_POST['txtByBankMoney'];
$txtWxMoney=$_POST['txtWxMoney'];
$WxCoupon=$_POST['WxCoupon'];
$txtFMemCard=$_POST['txtFMemCard'];
$dingdan=$_POST['dingdan'];
$txtTotalMoney=$_POST['txtTotalMoney'];
$txtMemName=iconv('utf-8','gbk',$_POST['txtMemName']);
$txtExpPoint=$_POST['txtExpPoint'];

$PayType="";
$txtMemCard=$_POST['txtMemCard'];
$type="会员充时";

if((float)$txtByCardMoney > 0){
$PayType="余额支付";
}

if((float)$txtByCashMoney > 0){

if($PayType==""){
$PayType="现金支付";
}else{
$PayType=$PayType.","."现金支付";
}

}

if((float)$txtByBankMoney > 0){
if($PayType==""){
$PayType="银联支付";
}else{
$PayType=$PayType.","."银联支付";
}
}

$RulesID=$_POST['RulesID'];
$txtRechargeTime=$_POST['txtRechargeTime'];



$row1=$dsql->GetOne("Select * From ".$TAB_USER_NAME." where txtmemcard = '".$txtFMemCard."'");


if((float)$row1['txtMemMoney'] < (float)$txtByCardMoney){
echo "-1";
exit;
}

$TimingPrject=json_decode($row1['TimingPrject'],true);



$Array=Array
(
    $RulesID => Array('time' => $txtRechargeTime,),
    
);


if($TimingPrject[$RulesID]==""){


$TimingPrject[$RulesID]=array('time'=>$txtRechargeTime);
//Array_push($TimingPrject,5=>array(0=>'小李',1=>32,3=>'山东')); 

}else{

$TimingPrject[$RulesID]['time']=(int)$TimingPrject[$RulesID]['time']+(int)$txtRechargeTime;
}

//print_r($TimingPrject);
//Array_push($Array,$Array); 

$json=json_encode($TimingPrject);



$row3=$dsql->ExecNoneQuery("UPDATE  ".$TAB_USER_NAME." SET  `TimingPrject` = '".$json."'  WHERE  `id` =".$row1['id'].";");


$row=$dsql->ExecNoneQuery("UPDATE  ".$TAB_USER_NAME." SET  `txtMemMoney` = txtMemMoney- ".$txtByCardMoney." WHERE  `txtmemcard` ='".$txtFMemCard."';");

$row1=$dsql->ExecNoneQuery("INSERT INTO `dede_expense_".$TAB_ID."` (`id` ,`dingdan` ,`txtMemName` ,`txtMemCard` ,`type` ,`txtMemMoney` ,`txtTotalMoney` ,`txtMemPoint` ,`time`,`PayType`,`State`)VALUES (NULL ,  '".$dingdan."', '".$txtMemName."' , '".$txtMemCard."' , '".$type."' , '".$txtTotalMoney."' , '1' , '1' , '".time()."', '".$PayType."', '付款成功' );");

if($row==1){
echo '1';
}else{
echo '0';

}


}else if($Method=="GiftSoc"){

$key=$_POST['key'];




$row=$dsql->GetOne("Select * From `dede_gift_".$TAB_ID."` where giftName = '".$key."' OR giftCode = '".$key."' "  );


if($row['giftName']!="" || $row['giftName']!="" ){
$html='<tr class="td" onclick="javascript:OnGood(&quot;'.$row["giftCode"].'&quot;,&quot;'.$row["giftName"].'&quot;,&quot;'.$row["giftExchangePoint"].'&quot;);"><td style="text-align: left">'.$row["giftName"].'</td><td>'.$row["giftCode"].'</td><td style="text-align: right">'.$row["giftExchangePoint"].'</td><td style="text-align: right">'.$row["giftStockNumber"].'</td></tr>';
}else
{
$html="0";

}



echo $html;

}else if($Method=="GiftIn"){



$goodsAccount=iconv('utf-8','gbk',$_POST['goodsAccount']);


$lblTotalMoney=$_POST['lblTotalMoney'];
$txtMemCard=$_POST['txtMemCard'];
$lblTotalMoney=$_POST['lblTotalMoney'];
$spGoodsAccounte=$_POST['spGoodsAccounte'];//单号
$txtFMemCard=$_POST['txtFMemCard'];//会员卡号

$txtFMemName=iconv('utf-8','gbk',$_POST['txtFMemName']);//会员名称

$lblTotalNumber=$_POST['lblTotalNumber'];//兑换数量

$strgood=explode("$$$",$goodsAccount);

$RechargeCount=array();
$good="";
for($i=1;$i< count($strgood);$i++){
$good=explode("#",$strgood[$i]);




$RechargeCount[] = array('giftName'=>urlencode($good[0]),'giftCode'=>$good[1],'giftExchangePoint'=>$good[2],'txtNumber'=>$good[3]);
}


$json=json_encode($RechargeCount);



$row1=$dsql->GetOne("Select * From ".$TAB_USER_NAME." where txtmemcard = '".$txtMemCard."'");

if((float)$row1['txtMemPoint'] < (float)$lblTotalMoney){
echo "-1";
exit;
}


$row=$dsql->ExecNoneQuery("UPDATE  ".$TAB_USER_NAME." SET  `txtMemPoint` = txtMemPoint- ".$lblTotalMoney." WHERE  `txtmemcard` ='".$txtMemCard."';");

$row2=$dsql->ExecNoneQuery("INSERT INTO  `dede_point_".$TAB_ID."` (`id` ,`danghao` ,`txtmemcard` ,`txtMemName` ,`txtNumber` ,`txtBidPrice` ,`time`,`RechargeCount`)VALUES (NULL ,  '".$spGoodsAccounte."', '".$txtFMemCard."' , '".$txtFMemName."' , '".$lblTotalNumber."' , '".$lblTotalMoney."' , '".time()."', '".$json."');");







if($row=="1"){
echo '1';
}else{
echo '0';
}



}else if($Method=="TimeExpenseStart"){

$time=str_replace(".","",microtime(true)).rand(1000,9999);

$Token=$_POST['Token'];
$isMem=$_POST['isMem'];
$Project=$_POST['Project'];
$OrderPredictTime=$_POST['OrderPredictTime'];
$txtFMemName=iconv('utf-8','gbk',$_POST['txtFMemName']);

if($isMem=="true"){

$dsql = new DedeSql(false);
$dsql->SetQuery("SELECT * FROM  `dede_timestart_".$TAB_ID."` where Token='".$Token."' and state='1' ");
$dsql->Execute();
$ns = $dsql->GetTotalRow();
if($ns>=1){

$strReturn=iconv('gbk','utf-8','有尚未结束的计时消费记录，请先结束当前的计时消费项目再进行新的计时消费！');

$arr = array ('flag'=>"-1",'strReturn'=>$strReturn);
print_r(json_encode($arr));
exit;
}

//echo '0';

}









if($isMem=="true"){
$strReturn=iconv('gbk','utf-8','计时消费开始，会员卡号：'.$Token.',会员姓名：'.$txtFMemName.',计时消费开始时间：'. date('Y-m-d H:i:s',time()));


$row=$dsql->ExecNoneQuery("INSERT INTO `dede_timestart_".$TAB_ID."` (`id`,`danghao`, `txtFMemName`,`Token`, `isMem`, `Project`, `OrderPredictTime`, `time`, `state`) VALUES (NULL,'".$time."', '".$txtFMemName."','".$Token."', '".$isMem."', '".$Project."', '".$OrderPredictTime."', '".time()."', '1');");

}else{
$strReturn=iconv('gbk','utf-8','计时消费开始，散客令牌：'.$Token.',会员姓名：散客,计时消费开始时间：'.date('Y-m-d H:i:s',time()));

$txtFMemName="散客";
$row=$dsql->ExecNoneQuery("INSERT INTO `dede_timestart_".$TAB_ID."` (`id`,`danghao`, `txtFMemName`,`Token`, `isMem`, `Project`, `OrderPredictTime`, `time`, `state`) VALUES (NULL,'".$time."', '".$txtFMemName."','".$Token."', '".$isMem."', '".$Project."', '".$OrderPredictTime."', '".time()."', '1');");
}


if($row=="1"){
$arr = array ('flag'=>"1",'strReturn'=>$strReturn);
print_r(json_encode($arr));
}else{

$arr = array ('flag'=>"0");
print_r(json_encode($arr));
}



}else if($Method=="GoodsBills"){



$goodsAccount=$_POST['goodsAccount'];
$lblTotalMoney=$_POST['lblTotalMoney'];//消费总金额
$txtMemCard=$_POST['txtMemCard'];

$spGoodsAccounte=$_POST['spGoodsAccounte'];//单号
$txtFMemCard=$_POST['txtMemCard'];//会员卡号

$txtFMemName=iconv('utf-8','gbk',$_POST['txtFMemName']);//会员名称

$lblTotalNumber=$_POST['lblTotalNumber'];//消费总数量
$TotalMoney=$_POST['TotalMoney'];
$txtExRemark=$_POST['txtExRemark'];

$lblTotalPoint=$_POST['lblTotalPoint'];
$strgood=explode("$$$",$goodsAccount);



$RechargeCount=array();
$good="";
for($i=1;$i< count($strgood);$i++){
$good=explode("#",$strgood[$i]);
$RechargeCount[] = array('giftName'=>$good[0],'giftCode'=>$good[1],'txtBid'=>$good[2],'Discount'=>$good[3],'txtPoint'=>$good[4]);
}


$json=json_encode($RechargeCount);





//$row=$dsql->ExecNoneQuery("UPDATE  ".$TAB_USER_NAME." SET  `txtMemPoint` = txtMemPoint- ".$lblTotalMoney." WHERE  `txtmemcard` ='".$txtMemCard."';");


$row2=$dsql->ExecNoneQuery("INSERT INTO  `dede_bills_".$TAB_ID."` (`id` ,`danghao` ,`txtFMemCard` ,`txtFMemName` ,`txtTotalMoney` ,`txtActualTotal` ,`txtFMemPoint`,`txtExRemark`,`time`,`RechargeCount`,`UserName`)VALUES (NULL ,  '".$spGoodsAccounte."', '".$txtFMemCard."' , '".$txtFMemName."' , '".$TotalMoney."' , '".$lblTotalMoney."' ,'".$lblTotalPoint."' ,'".$txtExRemark."' , '".time()."', '".$json."', '".$USER['ENV_USER_NAME']."');");







if($row2=="1"){
echo '1';
}else{
echo '0';
}



}else if($Method=="chk"){

$ck=$_POST['ck'];
$cktype=$_POST['cktype'];

if($USER['ENV_USER_STATE']=="商家"){

$row=$dsql->ExecNoneQuery("UPDATE  `dede_member` SET  ".$cktype." =  '".$ck."' WHERE  `mid` ='".$USER['ENV_USER_MID']."';");

}else{


$row=$dsql->ExecNoneQuery("UPDATE  `dede_staff_".$TAB_ID."` SET  ".$cktype." =  '".$ck."' WHERE  `id` = '".$USER['ENV_USER_MID']."' ");


}


echo $row;





}else if($Method=="MemRechargeCount"){

$txtByCardMoney=$_POST['txtByCardMoney'];
$txtByCashMoney=$_POST['txtByCashMoney'];
$txtByBankMoney=$_POST['txtByBankMoney'];
$txtWxMoney=$_POST['txtWxMoney'];
$WxCoupon=$_POST['WxCoupon'];
$txtFMemCard=$_POST['txtFMemCard'];
$dingdan=$_POST['dingdan'];
$txtTotalMoney=$_POST['txtTotalMoney'];
$txtMemName=iconv('utf-8','gbk',$_POST['txtMemName']);
$PayType="";
$txtMemCard=$_POST['txtMemCard'];



$goodsAccount=$_POST['goodsAccount'];
$type="会员充次";
$tbOrderTable=$_POST['tbOrderTable'];
if((float)$txtByCardMoney > 0){
$PayType="余额支付";
}

if((float)$txtByCashMoney > 0){

if($PayType==""){
$PayType="现金支付";
}else{
$PayType=$PayType.","."现金支付";
}

}


if((float)$txtByBankMoney > 0){
if($PayType==""){
$PayType="银联支付";
}else{
$PayType=$PayType.","."银联支付";
}
}


$strgood=explode("$$$",$goodsAccount);

$row5=$dsql->GetOne("Select * From ".$TAB_USER_NAME." where txtmemcard = '".$txtFMemCard."'");


if((float)$row5['txtMemMoney'] < (float)$txtByCardMoney){
echo "-1";
exit;
}

$TimingPrject=json_decode($row5['CountPrject'],true);

$good="";
for($i=1;$i< count($strgood);$i++){



$good=explode("#",$strgood[$i]);



$goodsID=$good[5];

if($TimingPrject[$goodsID]==""){
$TimingPrject[$goodsID] =array('goodsID'=>$goodsID,'txtNumber'=>$good[2]);
}
else{

$TimingPrject[$goodsID]['txtNumber']= (int)$TimingPrject[$goodsID]['txtNumber']+$good[2];

}

}


$json=json_encode($TimingPrject);


$lblTotalPoint=$_POST['lblTotalPoint'];
$row2=$dsql->ExecNoneQuery("UPDATE  ".$TAB_USER_NAME." SET  `txtMemMoney` = txtMemMoney- ".$txtByCardMoney.",`txtMemPoint` = txtMemPoint + ".(int)$lblTotalPoint." WHERE  `txtmemcard` ='".$txtFMemCard."';");

$row1=$dsql->ExecNoneQuery("INSERT INTO `dede_expense_".$TAB_ID."` (`id` ,`dingdan` ,`txtMemName` ,`txtMemCard` ,`type` ,`txtMemMoney` ,`txtTotalMoney` ,`txtMemPoint` ,`time`,`PayType`,`State`)VALUES (NULL ,  '".$dingdan."', '".$txtMemName."' , '".$txtMemCard."' , '".$type."' , '".$txtTotalMoney."' , '1' , '1' , '".time()."', '".$PayType."', '付款成功' );");

$row=$dsql->ExecNoneQuery("UPDATE  ".$TAB_USER_NAME." SET  `CountPrject` = '".$json."' WHERE  `txtmemcard` ='".$txtMemCard."';");

//$row2=$dsql->ExecNoneQuery("UPDATE  ".$TAB_USER_NAME." SET  `txtMemMoney` = txtMemMoney- ".$txtByCardMoney." WHERE  `txtmemcard` ='".$txtFMemCard."';");

echo $row;




}else if($Method=="UserMoney"){

$txtTotal=$_POST['txtTotal'];

if((float)$txtTotal<100){
echo '-2';
exit;
}

$row1 = $dsql->GetOne("Select * From dede_member where mid ='".$USER['TAB_ID']."'");

$pmoney=$row1['pmoney'];



if((float)$pmoney >= $txtTotal){

$Point=0;
$To=sprintf("%.2f",$txtTotal);


}else{

$Point=sprintf("%.2f",((float)$txtTotal-(float)$pmoney)*0.005);


$To=$pmoney;

}


$Total=sprintf("%.2f",(float)$txtTotal+$Point);

if((float)$row1['money'] < (float)$Total){
echo '-1';
exit;
}





$row=$dsql->ExecNoneQuery("UPDATE  `dede_member` SET  `money` = money-'".$Total."',`pmoney` = pmoney-'".$To."' WHERE  `mid` ='".$USER['TAB_ID']."';");



$row2=$dsql->ExecNoneQuery("INSERT INTO  `dede_money` (`id` ,`reid` ,`money` ,`point` ,`time`)VALUES (NULL , '".$USER['TAB_ID']."',  '".sprintf("%.2f",$txtTotal)."',  '".$Point."',  '".time()."');");




if($row=="1"){
echo '1';
}else{
echo '0';
}


}else if($Method=="UserSet"){

$PayType=$_POST['PayType'];
$UserName=iconv('utf-8','gbk',$_POST['UserName']);;
$PayUser=$_POST['PayUser'];

$row=$dsql->ExecNoneQuery("UPDATE  `dede_member` SET  `PayType` = '".$PayType."',`UserName` = '".$UserName."',`PayUser` = '".$PayUser."' WHERE  `mid` ='".$USER['TAB_ID']."';");

if($row=="1"){
echo '1';
}else{
echo '0';
}

}else if($Method=="ConsumeMemCount"){

$goodsAccount=iconv('utf-8','gbk',$_POST['goodsAccount']);//会员名称

$lblTotalNumber=iconv('utf-8','gbk',$_POST['lblTotalNumber']);//会员名称
$txtFMemCard=$_POST['txtFMemCard'];

$row=$dsql->GetOne("Select * From ".$TAB_USER_NAME." where txtmemcard = '".$txtFMemCard."'");

$CountPrject=json_decode($row['CountPrject'],true);



$strgood=explode("$$$",$goodsAccount);


for($i=1;$i< count($strgood);$i++){

$good=explode("#",$strgood[$i]);

//print_r($good[0]);
$txtNumber=(int)$CountPrject[$good[0]]['txtNumber'];

if((int)$good[2] >$txtNumber ){

echo '-1';
exit;
}



//print_r($txtNumber);



}


for($i=1;$i< count($strgood);$i++){

$good=explode("#",$strgood[$i]);

//print_r($good[0]);

$txtNumber=(int)$CountPrject[$good[0]]['txtNumber'];

$CountPrject[$good[0]]['txtNumber']=$txtNumber-(int)$good[2];

}


$json=json_encode($CountPrject);


$row=$dsql->ExecNoneQuery("UPDATE  ".$TAB_USER_NAME." SET  `CountPrject` = '".$json."' WHERE  txtmemcard = '".$txtFMemCard."'");

if($row=="1"){
echo '1';
}else{
echo '0';
}


//echo $goodsAccount;

}else if($Method=="ExpenseGG"){

$txtByCardMoney=$_POST['txtByCardMoney'];
$txtByCashMoney=$_POST['txtByCashMoney'];
$txtByBankMoney=$_POST['txtByBankMoney'];
$txtWxMoney=$_POST['txtWxMoney'];
$WxCoupon=$_POST['WxCoupon'];
$txtFMemCard=$_POST['txtFMemCard'];
$dingdan=$_POST['dingdan'];
$txtTotalMoney=$_POST['txtTotalMoney'];
$txtMemName=iconv('utf-8','gbk',$_POST['txtMemName']);
$PayType="";
$txtMemCard=$_POST['txtMemCard'];



$goodsAccount=$_POST['goodsAccount'];
$type="快速消费";
$tbOrderTable=$_POST['tbOrderTable'];
if((float)$txtByCardMoney > 0){
$PayType="余额支付";
}

if((float)$txtByCashMoney > 0){

if($PayType==""){
$PayType="现金支付";
}else{
$PayType=$PayType.","."现金支付";
}

}


if((float)$txtByBankMoney > 0){
if($PayType==""){
$PayType="银联支付";
}else{
$PayType=$PayType.","."银联支付";
}
}


$strgood=explode("$$$",$goodsAccount);

$row1=$dsql->GetOne("Select * From ".$TAB_USER_NAME." where txtmemcard = '".$txtFMemCard."'");


if((float)$row1['txtMemMoney'] < (float)$txtByCardMoney){
echo "-1";
exit;
}

$TimingPrject=json_decode($row1['CountPrject'],true);

$good="";


$txtExpPoint=$_POST['txtExpPoint'];

$row=$dsql->ExecNoneQuery("UPDATE  ".$TAB_USER_NAME." SET  `txtMemMoney` = txtMemMoney- ".$txtByCardMoney.",`txtMemPoint` = txtMemPoint + ".(int)$txtExpPoint." WHERE  `txtmemcard` ='".$txtFMemCard."';");




$row1=$dsql->ExecNoneQuery("INSERT INTO `dede_expense_".$TAB_ID."` (`id` ,`dingdan` ,`txtMemName` ,`txtMemCard` ,`type` ,`txtMemMoney` ,`txtTotalMoney` ,`txtMemPoint` ,`time`,`PayType`,`State`)VALUES (NULL ,  '".$dingdan."', '".$txtMemName."' , '".$txtMemCard."' , '".$type."' , '".$txtTotalMoney."' , '1' , '1' , '".time()."', '".$PayType."', '付款成功' );");




if($row==1){
echo '1';
}else{
echo '0';

}
//$json=json_encode($TimingPrject);


//$row1=$dsql->ExecNoneQuery("INSERT INTO `dede_expense` (`id` ,`dingdan` ,`txtMemName` ,`txtMemCard` ,`type` ,`txtMemMoney` ,`txtTotalMoney` ,`txtMemPoint` ,`time`,`PayType`,`State`)VALUES (NULL ,  '".$dingdan."', '".$txtMemName."' , '".$txtMemCard."' , '".$type."' , '".$txtTotalMoney."' , '1' , '1' , '".time()."', '".$PayType."', '付款成功' );");

//$row=$dsql->ExecNoneQuery("UPDATE  ".$TAB_USER_NAME." SET  `CountPrject` = '".$json."' WHERE  `txtmemcard` ='".$txtMemCard."';");
//echo $row;
}else if($Method=="TimeLExpenseGG"){

$txtByCardMoney=$_POST['txtByCardMoney'];
$txtByCashMoney=$_POST['txtByCashMoney'];
$txtByBankMoney=$_POST['txtByBankMoney'];
$txtWxMoney=$_POST['txtWxMoney'];
$WxCoupon=$_POST['WxCoupon'];
$txtFMemCard=$_POST['txtFMemCard'];
$dingdan=$_POST['dingdan'];
$txtTotalMoney=$_POST['txtTotalMoney'];
$txtMemName=iconv('utf-8','gbk',$_POST['txtMemName']);
$PayType="";
$txtMemCard=$_POST['txtMemCard'];

$txtExpMoney=$_POST['txtExpMoney'];
$Project=$_POST['Project'];
$goodsAccount=$_POST['goodsAccount'];
$type="计时消费";
$tbOrderTable=$_POST['tbOrderTable'];
if((float)$txtByCardMoney > 0){
$PayType="余额支付";
}

if((float)$txtByCashMoney > 0){

if($PayType==""){
$PayType="现金支付";
}else{
$PayType=$PayType.","."现金支付";
}

}


if((float)$txtByBankMoney > 0){
if($PayType==""){
$PayType="银联支付";
}else{
$PayType=$PayType.","."银联支付";
}
}




$strgood=explode("$$$",$goodsAccount);

$row1=$dsql->GetOne("Select * From ".$TAB_USER_NAME." where txtmemcard = '".$txtMemCard."'");


if((float)$row1['txtMemMoney'] < (float)$txtByCardMoney){


echo "-1";
exit;
}

$TimingPrject=json_decode($row1['TimingPrject'],true);
$txtTime=$_POST['txtTime'];


$TimingPrject[$Project]['time']=(int)$TimingPrject[$Project]['time']-(int)$txtTime;

$json=json_encode($TimingPrject);


$good="";

$row=$dsql->ExecNoneQuery("UPDATE  ".$TAB_USER_NAME." SET  `txtMemMoney` = txtMemMoney- ".$txtByCardMoney.",`TimingPrject` = '".$json."'  WHERE  `txtmemcard` ='".$txtFMemCard."';");


$row1=$dsql->ExecNoneQuery("INSERT INTO `dede_expense_".$TAB_ID."` (`id` ,`dingdan` ,`txtMemName` ,`txtMemCard` ,`type` ,`txtMemMoney` ,`txtTotalMoney` ,`txtMemPoint` ,`time`,`PayType`,`State`)VALUES (NULL ,  '".$dingdan."', '".$txtMemName."' , '".$txtMemCard."' , '".$type."' , '".$txtTotalMoney."' , '1' , '1' , '".time()."', '".$PayType."', '付款成功' );");



$row1 = $dsql->ExecNoneQuery("UPDATE  `dede_timestart_".$TAB_ID."` SET  `end_time` = '".time()."',`state` = '0',`end_user` = '".$USER['ENV_USER_NAME']."' WHERE  `danghao` ='".$dingdan."';");




if($row==1){
echo '1';
}else{
echo '0';

}
//$json=json_encode($TimingPrject);


//$row1=$dsql->ExecNoneQuery("INSERT INTO `dede_expense` (`id` ,`dingdan` ,`txtMemName` ,`txtMemCard` ,`type` ,`txtMemMoney` ,`txtTotalMoney` ,`txtMemPoint` ,`time`,`PayType`,`State`)VALUES (NULL ,  '".$dingdan."', '".$txtMemName."' , '".$txtMemCard."' , '".$type."' , '".$txtTotalMoney."' , '1' , '1' , '".time()."', '".$PayType."', '付款成功' );");

//$row=$dsql->ExecNoneQuery("UPDATE  ".$TAB_USER_NAME." SET  `CountPrject` = '".$json."' WHERE  `txtmemcard` ='".$txtMemCard."';");
//echo $row;
}else if($Method=="DeleteEmptyBills"){

$orderID=$_POST['orderID'];


$row=$dsql->ExecNoneQuery("Delete From `dede_bills_".$TAB_ID."` where id='".$orderID."' ");

if($row==1){

echo '1';

}else{
echo '0';

}

}else if($Method=="Bills"){

$txtByCardMoney=$_POST['txtByCardMoney'];
$txtByCashMoney=$_POST['txtByCashMoney'];
$txtByBankMoney=$_POST['txtByBankMoney'];
$txtWxMoney=$_POST['txtWxMoney'];
$WxCoupon=$_POST['WxCoupon'];
$txtFMemCard=$_POST['txtFMemCard'];
$dingdan=$_POST['dingdan'];
$txtTotalMoney=$_POST['txtTotalMoney'];
$txtMemName=iconv('utf-8','gbk',$_POST['txtMemName']);
$PayType="";
$RulesID=$_POST['RulesID'];
$txtMemCard=$_POST['txtMemCard'];
$type="商品消费";

if((float)$txtByCardMoney > 0){
$PayType="余额支付";
}

if((float)$txtByCashMoney > 0){

if($PayType==""){
$PayType="现金支付";
}else{
$PayType=$PayType.","."现金支付";
}

}


if((float)$txtByBankMoney > 0){
if($PayType==""){
$PayType="银联支付";
}else{
$PayType=$PayType.","."银联支付";
}
}

$row1=$dsql->GetOne("Select * From ".$TAB_USER_NAME." where txtmemcard = '".$txtFMemCard."'");


if((float)$row1['txtMemMoney'] < (float)$txtByCardMoney){
echo "-1";
exit;
}


$row=$dsql->ExecNoneQuery("UPDATE  ".$TAB_USER_NAME." SET  `txtMemMoney` = txtMemMoney- ".$txtByCardMoney." WHERE  `txtmemcard` ='".$txtFMemCard."';");



$row1=$dsql->ExecNoneQuery("INSERT INTO `dede_expense_".$TAB_ID."` (`id` ,`dingdan` ,`txtMemName` ,`txtMemCard` ,`type` ,`txtMemMoney` ,`txtTotalMoney` ,`txtMemPoint` ,`time`,`PayType`,`State`)VALUES (NULL ,  '".$dingdan."', '".$txtMemName."' , '".$txtMemCard."' , '".$type."' , '".$txtTotalMoney."' , '1' , '1' , '".time()."', '".$PayType."', '付款成功' );");


$row2=$dsql->ExecNoneQuery("Delete From `dede_bills_".$TAB_ID."` where id='".$RulesID."' ");

if($row==1){
echo '1';
}else{
echo '0';

}

}else if($Method=="WeiXinSet"){

$PayTypa=$_POST['PayTypa'];
$mchid=$_POST['mchid'];
$appid=$_POST['appid'];
$key=$_POST['key'];

$row=$dsql->ExecNoneQuery("UPDATE `dede_member` SET  `PayType` =  '".$PayTypa."',`mchid` =  '".$mchid."',`appid` =  '".$appid."',`key` =  '".$key."' WHERE  `mid` ='".$USER['TAB_ID']."';");


if($row==1){
echo '1';
}else{
echo '0';

}

}else if($Method=="TimingList"){






$txtQueryMem=$_POST['txtQueryMem'];



$sql = "SELECT * FROM  `dede_timestart_".$TAB_ID."` where Token=".$txtQueryMem." ORDER BY  `id` DESC";

$dsql->SetQuery($sql);
$dsql->SetQuery($sql);
$dsql->Execute();


while($row = $dsql->GetArray()){




$row1 = $dsql->GetOne("SELECT * FROM `dede_timing_".$TAB_ID."` WHERE id='".$row['Project']."' ");

		
						
$sysc="";






 if($row['isMem']=="true"){

$isMem="会员消费";
}else{
$isMem="散客消费";

}
										
										   
if($row['state']=="1"){
$state='正在消费';
}else{
$state='<p style="color:red;">消费结束</p>';
}



 if($row['OrderPredictTime']==""){
											$OrderPredictTime='未设置';
											 }else{
											 $OrderPredictTime=$row['OrderPredictTime'].'分钟';;

											 }
		
											 
									
 if($row['state']=="1"){

 if($row['OrderPredictTime']!=""){

										$time=(int)$row['OrderPredictTime']*60;

										$time1=(int)$row['time']+$time-time();
										
										if($time1 > 0){

								
$sysc=' <span style="color:#4aadef;">剩余时长：'.(int)($time1/60).'分钟</span>';

										}else{
$time2=time()-(int)$row['time']+$time;	
$sysc='<span style="color:red;">已超时长：'.(int)($time2/60).'分钟</span>';

										}}
										}
											
										


if($row['state']!="1"){



$zxf='总共消费：'.(int)(((int)$row['end_time']-(int)$row["time"])/60).'分钟';

									   } 



if($row['state']!="1"){

$js='<p style="color:red;">   <img src="../images/Gift/isok.png" title="已结算" alt="已结算"></p>';
}


 if($row['state']=="1"){
										
										}else{
										$end_time=date("Y-m-d H:i:s",$row['end_time']);
										} 

 $html=$html.'<tr class="td">
                                        <td>
                                          '.$row['danghao'].'
                                            
                                            
                                        </td>
                                        <td>
                                          '.$isMem.'
                                        </td>
                                        <td>
                                           '.$row1['txtProjectName'].'
                                        </td>
                                        <td style="text-align: left;">
                                            '.$row['txtFMemName'].'
                                        </td>
                                        <td>
                                            '.$row['Token'].'
                                        </td>
                                        <td>
                                            超管
                                        </td>
                                        <td>
                                          '.$state.'
                                        </td>
                                        <td>
                                            '.$OrderPredictTime.'
                                        <td style="width: 120px;"><!---- *********************剩余时间*******************---->
                                         
									'.$sysc.'
											
											
											
                                        </td>
                                        <td>
                                            '.date("Y-m-d H:i:s",$row['time']).'
                                        </td>
                                        <td>
                                            '.$end_time.'
                                        </td>
                                        <td style="text-align: left;">
'.$zxf.'
                                        </td>
                                        <td>
                                            '.$row['end_user'].'
                                        </td>
                                        <td class="listtd" style="width: 40px; text-align: center;">
'.$js.'
                                            <a id="gvTimeExpense_ctl01_hyEndExpense" href="/member/TimeLExpense.php?dh='.$row['danghao'].'&isMem='.$row['isMem'].'&Token='.$row['Token'].'&Project='.$row['Project'].'">&nbsp;<img src="../images/Gift/goexpense.png" title="转到结算"
                                                    alt="转到结算" /></a>
                                        </td>
                                    </tr>';

}

if($html!=""){
echo $html;
}else{
echo 0;
}








}else if($Method=="ExpenseList"){




$txtQueryMem=iconv('utf-8','gbk',$_POST['txtQueryMem']);



$sql = "SELECT * FROM  `dede_expense_".$TAB_ID."` where dingdan = '".$txtQueryMem."' OR txtMemName = '".$txtQueryMem."' OR txtMemCard = '".$txtQueryMem."' ORDER BY  `id` DESC";

$dsql->SetQuery($sql);
$dsql->SetQuery($sql);
$dsql->Execute();


while($row = $dsql->GetArray()){


	$html=$html.'<tr class="td">
                                        <td style="width: 50px;">
                                            <span id="rptExpenseHistory_ctl01_lblNumber"> '.$row['id'].'</span>
                                        </td>
                                        <td style="text-align: left; width: 170px">
                                            
                                            '.$row['dingdan'].'
                                                
                                        </td>
                                        <td style="text-align: left">
                                           '.$row['txtMemName'].'
                                        </td>
                                        <td>
                                          '.$row['txtMemCard'].'
                                        </td>
                                        <td style="color: Red">
                                            '.$row['type'].'
                                        </td>
                                        <td style="text-align: right">
                                           '.$row['txtMemMoney'].'
                                        </td>
                                        <td style="text-align: right">
                                           '.$row['PayType'].'
                                        </td>
                                      
                                        <td style="text-align: right">
                                          '.$row['State'].'
                                        </td>
                                        
                                       
                                        
                                       
                                        <td>
                                             '. date('Y-m-d H:i:s',$row["time"]).'
                                        </td>
                                       
                                    </tr>';

}

if($html!=""){
echo $html;
}else{
echo 0;
}

}else if($Method=="UserPwdSet"){



$pwd=$_POST['pwd'];
$pwds=$_POST['pwds'];



if($pwd!==$pwds){
echo '-1';
exit;
}

if($pwd=="" || $pwds == "" ){
echo '-2';
exit;
}

$pwd=md5($pwd);

$row=$dsql->ExecNoneQuery("UPDATE  `dede_member` SET  `pwd` = '".$pwd."' WHERE  `mid` ='".$USER['TAB_ID']."';");

if($row=="1"){
echo '1';
}else{
echo '0';
}

}else if($Method=="DeDeMoney"){
$id=$_POST['id'];
$state=$_POST['state'];
$reid=$_POST['reid'];



$row1= $dsql->GetOne("SELECT * FROM `dede_money` WHERE id='".$id."' ");



if($state=="1"){
$row=$dsql->ExecNoneQuery("UPDATE  `dede_money` SET  `state` = '1' WHERE  `id` ='".$id."';");
}else if($state=="2"){
$money=(float)$row1['money']+(float)$row1['point'];
$row2=$dsql->ExecNoneQuery("UPDATE  `dede_member` SET  `money` = money+ ".$money." WHERE  `mid` ='".$reid."';");
$row=$dsql->ExecNoneQuery("UPDATE  `dede_money` SET  `state` = '2' WHERE  `id` ='".$id."';");
}

if($row=="1"){
echo '1';
}else{
echo '0';
}

}else if($Method=="SetPrint"){

$print=$_POST['print'];

$row=$dsql->ExecNoneQuery("UPDATE  `dede_member` SET  `Set_Print` = '".$print."' WHERE  `mid` ='".$USER['TAB_ID']."';");

if($row=="1"){
echo '1';
}else{
echo '0';
}

}else if($Method=="MemCheckPwd"){

$memID=$_POST['memID'];
$memPassword=$_POST['memPassword'];

$row=$dsql->GetOne("Select * From ".$TAB_USER_NAME." where txtmemcard = '".$memID."'");

if($memPassword==$row['txtMemPassword']){
echo '1';

}else{
echo '0';
}

}else if($Method=="ShopUserAdd"){

$SHOP_NAME=$_POST['SHOP_NAME'];
$SHOP_PAW=$_POST['SHOP_PAW'];
$typeid=$_POST['typeid'];


if(strlen($SHOP_NAME)< 6 || strlen($SHOP_PAW)< 6 ){
echo '-3';
exit;
}

if(ctype_alnum($SHOP_NAME)=="1" && ctype_alnum($SHOP_PAW)=="1"){
}else{
echo '-1';
exit;
}

if($typeid=="0"){

if($SJ_Num >= 1){


$dsql->SetQuery("Select * from `dede_member` where userid='".$SHOP_NAME."'");
$dsql->Execute();
$ns = $dsql->GetTotalRow();
if($ns > 0){
echo '-2';
exit;
}


$row1= $dsql->GetOne("SELECT * FROM `dede_money` WHERE id='".$id."' ");

$pwd=md5($SHOP_PAW);

$row=$dsql->ExecNoneQuery("INSERT INTO `dede_member` (`userid` ,`pwd`,`reid`,`logintime` ) VALUES ('".$SHOP_NAME."' ,'".$pwd."','".$TAB_ID."','".time()."')");


if($row=="1"){


$dsql->ExecNoneQuery("UPDATE  `dede_member` SET  `SJ_Num` = SJ_Num - 1 WHERE  `mid` ='".$USER['TAB_ID']."';");

echo '1';

}else{

echo '0';
}






}else{
echo '-4';
}


}else{

$pwd=md5($SHOP_PAW);



$row=$dsql->ExecNoneQuery("UPDATE  `dede_member` SET  `pwd` = '".$pwd."' WHERE  `mid` ='".$typeid."';");

if($row=="1"){

echo '3';

}else{

echo '4';
}


}






}







?>