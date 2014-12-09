<?php
header("Content-type: text/html; charset=gb2312");
date_default_timezone_set("PRC");
require("../public/public.class.php");
require("../public/upload_class.php");
if(!$_SESSION['buid']){
require("../business/template/login.htm");
exit;
}
$type=$_GET['type'];
/*$paper=$_GET['paper'];
if($paper){
require("$paper.php");
exit;
}*/
if($type=='reg'){
require("../business/template/login.htm");
}elseif($type=="myshop"){
//查看是否创建店铺
$buid=$_SESSION['buid'];
$sql="SELECT `id` FROM {$dbarray[DB_PREFIX]}shop WHERE Businesses_uid='$buid' ";
$query=mysql_query($sql,$con);
while($rs=mysql_fetch_array($query)){
		$dlist=$rs;
	}
	if($dlist[id]){
	//查询店铺列表
	$sql="SELECT * FROM {$dbarray[DB_PREFIX]}shop WHERE Businesses_uid='$buid' ";
$query=mysql_query($sql,$con);
while($rs=mysql_fetch_array($query)){
		$list_shop[]=$rs;
	}
	require("../business/template/shop_list.htm");
	
	}else{
	//区域选择列表
$sqlqy="SELECT `id`,`area` FROM {$dbarray[DB_PREFIX]}area ";
$query_qy=mysql_query($sqlqy,$con);
while($rs=mysql_fetch_array($query_qy)){
		$qylist[]=$rs;
	}
	//查询大分类列表
$sqlbt="SELECT `id`,`type_name` FROM {$dbarray[DB_PREFIX]}big_type ";
$query_bt=mysql_query($sqlbt,$con);
while($rs=mysql_fetch_array($query_bt)){
		$btlist[]=$rs;
	}
	
	require("../business/template/add_shop.htm");
	}
	
	
}elseif($type=='shop_add_post'){
$shop_name=$_POST['shop_name'];
$mobilephone=$_POST['mobilephone'];
$Business_Hours=$_POST['Business_Hours'];
$address=$_POST['address'];
$areaid=$_POST['areaid'];
$big_type_id=$_POST['big_type_id'];
$small_type_id=$_POST['small_type_id'];
$describe=$_POST['describe'];
$zoneid=$_POST['zoneid'];
$picurl=$_POST['picurl'];
$buid=$_SESSION['buid'];
$sql_in="INSERT INTO {$dbarray[DB_PREFIX]}shop (`shop_name`,`mobilephone`,`Business_Hours`,`address`,`areaid`,`big_type_id`,`small_type_id`,`describe`,`Businesses_uid`,`zoneid`,`shop_pic`) VALUES('$shop_name','$mobilephone','$Business_Hours','$address','$areaid','$big_type_id','$small_type_id','$describe','$buid','$zoneid','$picurl') ";
	mysql_query($sql_in,$con);
	echo "<script>alert('恭喜你，店铺创建成功！');javascript:window.location.href='index.php?type=myshop';</script>";

}elseif($type=="shop_add"){
//区域选择列表
$sqlqy="SELECT `id`,`area` FROM {$dbarray[DB_PREFIX]}area ";
$query_qy=mysql_query($sqlqy,$con);
while($rs=mysql_fetch_array($query_qy)){
		$qylist[]=$rs;
	}
	//查询大分类列表
$sqlbt="SELECT `id`,`type_name` FROM {$dbarray[DB_PREFIX]}big_type ";
$query_bt=mysql_query($sqlbt,$con);
while($rs=mysql_fetch_array($query_bt)){
		$btlist[]=$rs;
	}
	
require("../business/template/add_shop.htm");

}elseif($type=="shop_coupons_admin"){
$fid=$_GET['fid'];
$nowtime=time();
$sqlst="SELECT * FROM {$dbarray[DB_PREFIX]}coupons WHERE shop_id='$fid' ORDER BY id DESC";
$query_st=mysql_query($sqlst,$con);
while($rs=mysql_fetch_array($query_st)){
$times=strtotime($rs[endTime]);
$rs[check]=$rs[check]?"正常":"未审核";
$rs[check]=$nowtime>$times?"已过期":$rs[check];
$rs[sum]=$rs[sum]!=-1?"数量:$rs[sum]张":"无限量";
		$stlist[]=$rs;
	}
require("../business/template/shop_coupons_admin.htm");
}elseif($type=="coupons_add"){
$shop_id=$_GET['shop_id'];
require("../business/template/shop_coupons_add.htm");
}elseif($type=="shop_coupons_add_post"){
$shop_id=$_POST['shop_id'];
$name=$_POST['name'];
$oldPrice=$_POST['oldPrice'];
$nowPrice=$_POST['nowPrice'];
$sum=$_POST['sum'];
$endTime=$_POST['endTime'];
$start_time=$_POST['start_time'];
$describe=$_POST['describe'];
$use_help=$_POST['use_help'];
$buid=$_SESSION['buid'];
$coupons_pic=$_POST['picurl'];
$sum=$sum?$sum:-1;
$Receive_max=$_POST['Receive_max'];

$sql_in="INSERT INTO {$dbarray[DB_PREFIX]}coupons (`name`,`oldPrice`,`nowPrice`,`sum`,`endTime`,`describe`,`use_help`,`shop_id`,`Businesses_uid`,`pic`,`start_time`,`Receive_max`) VALUES('$name','$oldPrice','$nowPrice','$sum','$endTime','$describe','$use_help','$shop_id','$buid','$coupons_pic','$start_time','$Receive_max') ";
	mysql_query($sql_in,$con);
	echo "<script>alert('恭喜你,优惠券创建成功！');javascript:window.location.href='index.php?type=shop_coupons_admin&fid=$shop_id';</script>";
}elseif($type=="coupons_edit"){
$fid=$_GET['fid'];
$sqlbt="SELECT * FROM {$dbarray[DB_PREFIX]}coupons WHERE id='$fid' ";
$query_bt=mysql_query($sqlbt,$con);
while($rs=mysql_fetch_array($query_bt)){
		$btlist=$rs;
	}
	
require("../business/template/coupons_edit.htm");
}elseif($type=="shop_coupons_edit_post"){
$fid=$_GET['fid'];
$name=$_POST['name'];
$oldPrice=$_POST['oldPrice'];
$nowPrice=$_POST['nowPrice'];
$sum=$_POST['sum'];
$endTime=$_POST['endTime'];
$start_time=$_POST['start_time'];
$describe=$_POST['describe'];
$use_help=$_POST['use_help'];
$buid=$_SESSION['buid'];
$pics=$_POST['pic'];
$shop_id=$_POST['shop_id'];
$Receive_max=$_POST['Receive_max'];

$sum=!$sum?-1:$sum=$sum=="无限量"?-1:$sum;
//设置文件上传目录
         $savePath = "../upload/coupons";
    
         //允许的文件类型
         $fileFormat = array('gif','jpg','jpeg','png');
    
         //文件大小限制，单位: Byte，1KB = 1000 Byte
         //0 表示无限制，但受php.ini中upload_max_filesize设置影响
         $maxSize = 0;
    
         //覆盖原有文件吗？ 0 不允许   1 允许
         $overwrite = 0;
    
         //初始化上传类
         $f = new clsUpload( $savePath, $fileFormat, $maxSize, $overwrite);
    
         //如果想生成缩略图，则调用成员函数 $f->setThumb();
         //参数列表: setThumb($thumb, $thumbWidth = 0,$thumbHeight = 0)
         //$thumb=1 表示要生成缩略图，不调用时，其值为 0
         //$thumbWidth   缩略图宽，单位是像素(px)，留空则使用默认值 130
         //$thumbHeight 缩略图高，单位是像素(px)，留空则使用默认值 130
         $f->setThumb(1);
    
     $f->thumbWidth = 120;
     $f->thumbHeight = 120;
	  $f->thumbWidths = 180;
     $f->thumbHeights = 180;
        
         //参数中的uploadinput是表单中上传文件输入框input的名字
         //后面的0表示不更改文件名，若为1，则由系统生成随机文件名
         if (!$f->run('uploadinput',1)){
             //通过$f->errmsg()只能得到最后一个出错的信息，
             //详细的信息在$f->getInfo()中可以得到。
             //echo $f->errmsg()."<br>\n";
         }
         //上传结果保存在数组returnArray中。
     $pic = $f->getInfo();
	$coupons_pic=$pic[0]["saveName"];
	$ext=end(explode('.',$coupons_pic));
	if($ext){
	 $f->del("../upload/coupons/".$pics);
	$f->del("../upload/coupons/thumb_".$pics);
	$f->del("../upload/coupons/thumbs_".$pics);
	}
	$pwdu=$coupons_pic&&$ext?",`pic`='$coupons_pic'":"";
mysql_query("UPDATE {$dbarray[DB_PREFIX]}coupons SET `name`='$name',`oldPrice`='$oldPrice',`nowPrice`='$nowPrice',`sum`='$sum',`endTime`='$endTime',`describe`='$describe',`use_help`='$use_help',`start_time`='$start_time',`Receive_max`='$Receive_max',`check`=0 $pwdu WHERE id='$fid' ",$con);
echo "<script>alert('恭喜你，优惠券修改成功！');javascript:window.location.href='index.php?type=shop_coupons_admin&fid=$shop_id';</script>";
}elseif($type=="shop_activities_admin"){
$fid=$_GET['shop_id'];
$nowtime=time();
$sqlst="SELECT * FROM {$dbarray[DB_PREFIX]}newactivities WHERE shop_id='$fid' ORDER BY id DESC";
$query_st=mysql_query($sqlst,$con);
while($rs=mysql_fetch_array($query_st)){
$times=strtotime($rs[endTime]);
$rs[check]=$rs[check]?"正常":"未审核";
$rs[check]=$nowtime>$times?"已过期":$rs[check]; 
		$stlist[]=$rs;
	}
require("../business/template/shop_activities_admin.htm");
}elseif($type=="activities_add"){
$fid=$_GET['shop_id'];
require("../business/template/shop_activities_add.htm");

}elseif($type=="shop_activities_add_post"){
$shop_id=$_POST['shop_id'];
$Activities_name=$_POST['Activities_name'];
$oldPrice=$_POST['oldPrice'];
$price=$_POST['price'];
$sum=$_POST['sum'];
$seal_time=$_POST['seal_time'];
$endTime=$_POST['endTime'];
$start_time=$_POST['start_time'];
$describe=$_POST['describe'];
$buid=$_SESSION['buid'];
$activities_pic=$_POST['picurl'];
$sum=$sum?$sum:-1;
$sql_in="INSERT INTO {$dbarray[DB_PREFIX]}newactivities (`Activities_name`,`oldPrice`,`price`,`sum`,`endTime`,`describe`,`seal_time`,`shop_id`,`Businesses_uid`,`pic`,`start_time`) VALUES('$Activities_name','$oldPrice','$price','$sum','$endTime','$describe','$seal_time','$shop_id','$buid','$activities_pic','$start_time') ";
	mysql_query($sql_in,$con);
	echo "<script>alert('恭喜你,活动创建成功！');javascript:window.location.href='index.php?type=shop_activities_admin&shop_id=$shop_id';</script>";
}elseif($type=="shop_users_admin"){
$fid=$_GET['shop_id'];
$sqlst="SELECT LEFT(b.niname,1) AS niname,b.mobilephone,@rownum:=@rownum+1 AS rownum FROM (SELECT @rownum:=0) r,{$dbarray[DB_PREFIX]}shop_user a, {$dbarray[DB_PREFIX]}users b WHERE a.uid=b.uid AND a.shop_id='$fid' ORDER BY a.id DESC";
$query_st=mysql_query($sqlst,$con);
while($rs=mysql_fetch_array($query_st)){
$rs[niname]=$rs[niname]."**";
		$stlist[]=$rs;
	}
require("../business/template/shop_users_admin.htm");
}elseif($type=="activities_edit"){
$fid=$_GET['fid'];
$sqlbt="SELECT * FROM {$dbarray[DB_PREFIX]}newactivities  WHERE id='$fid' ";
$query_bt=mysql_query($sqlbt,$con);
while($rs=mysql_fetch_array($query_bt)){
		$btlist=$rs;
	}
	
require("../business/template/activities_edit.htm");
}elseif($type=="shop_activities_edit_post"){
$fid=$_GET['fid'];
$Activities_name=$_POST['Activities_name'];
$oldPrice=$_POST['oldPrice'];
$lowest_price=$_POST['lowest_price'];
$sum=$_POST['sum'];
$Reduced_price=$_POST['Reduced_price'];
$endTime=$_POST['endTime'];
$start_time=$_POST['start_time'];
$describe=$_POST['describe'];
$pics=$_POST['pic'];
$shop_id=$_POST['shop_id'];
$sum=!$sum?-1:$sum=$sum=="无限量"?-1:$sum;
//设置文件上传目录
         $savePath = "../upload/activities";
    
         //允许的文件类型
         $fileFormat = array('gif','jpg','jpeg','png');
    
         //文件大小限制，单位: Byte，1KB = 1000 Byte
         //0 表示无限制，但受php.ini中upload_max_filesize设置影响
         $maxSize = 0;
    
         //覆盖原有文件吗？ 0 不允许   1 允许
         $overwrite = 0;
    
         //初始化上传类
         $f = new clsUpload( $savePath, $fileFormat, $maxSize, $overwrite);
    
         //如果想生成缩略图，则调用成员函数 $f->setThumb();
         //参数列表: setThumb($thumb, $thumbWidth = 0,$thumbHeight = 0)
         //$thumb=1 表示要生成缩略图，不调用时，其值为 0
         //$thumbWidth   缩略图宽，单位是像素(px)，留空则使用默认值 130
         //$thumbHeight 缩略图高，单位是像素(px)，留空则使用默认值 130
         $f->setThumb(1);
    
     $f->thumbWidth = 120;
     $f->thumbHeight = 120;
	  $f->thumbWidths = 180;
     $f->thumbHeights = 180;
        
         //参数中的uploadinput是表单中上传文件输入框input的名字
         //后面的0表示不更改文件名，若为1，则由系统生成随机文件名
         if (!$f->run('uploadinput',1)){
             //通过$f->errmsg()只能得到最后一个出错的信息，
             //详细的信息在$f->getInfo()中可以得到。
             //echo $f->errmsg()."<br>\n";
         }
         //上传结果保存在数组returnArray中。
     $pic = $f->getInfo();
	$activities_pic=$pic[0]["saveName"];
	$ext=end(explode('.',$activities_pic));
	if($ext){
	 $f->del("../upload/activities/".$pics);
	$f->del("../upload/activities/thumb_".$pics);
	$f->del("../upload/activities/thumbs_".$pics);
	}
	$pwdu=$activities_pic&&$ext?",`pic`='$activities_pic'":"";
mysql_query("UPDATE {$dbarray[DB_PREFIX]}newactivities  SET `Activities_name`='$Activities_name',`oldPrice`='$oldPrice',`lowest_price`='$lowest_price',`sum`='$sum',`Reduced_price`='$Reduced_price',`endTime`='$endTime',`describe`='$describe',`check`=0 $pwdu WHERE id='$fid' ",$con);
echo "<script>alert('恭喜你，活动修改成功！');javascript:window.location.href='index.php?type=shop_activities_admin&shop_id=$shop_id';</script>";

}elseif($type=="quit"){
unset($_SESSION['buid']);
require(dirname(__FILE__)."/"."template/login.htm");

}elseif($type=="shop_edit"){
$fid=$_GET['fid'];
$sql="SELECT * FROM {$dbarray[DB_PREFIX]}shop   WHERE id='$fid' ";
$query=mysql_query($sql,$con);
while($rs=mysql_fetch_array($query)){
		$list_shop=$rs;
	}

//区域选择列表
$sqlqy="SELECT `id`,`area` FROM {$dbarray[DB_PREFIX]}area ";
$query_qy=mysql_query($sqlqy,$con);
while($rs=mysql_fetch_array($query_qy)){
		$qylist[]=$rs;
	}
	//查询大分类列表
$sqlbt="SELECT `id`,`type_name` FROM {$dbarray[DB_PREFIX]}big_type ";
$query_bt=mysql_query($sqlbt,$con);
while($rs=mysql_fetch_array($query_bt)){
		$btlist[]=$rs;
	}
	//查询小分类列表
$sqlbt="SELECT `id`,`small_type_name` FROM {$dbarray[DB_PREFIX]}small_type WHERE big_type_id='$list_shop[big_type_id]' ";
$query_bt=mysql_query($sqlbt,$con);
while($rs=mysql_fetch_array($query_bt)){
		$stlist[]=$rs;
	}
	//查询商圈列表
$sqlbt="SELECT `id`,`zones` FROM {$dbarray[DB_PREFIX]}business_zones  WHERE areaid='$list_shop[areaid]' ";
$query_bt=mysql_query($sqlbt,$con);
while($rs=mysql_fetch_array($query_bt)){
		$znlist[]=$rs;
	}

require(dirname(__FILE__)."/"."template/shop_edit.htm");
}elseif($type=="shop_edit_post"){
$shop_name=$_POST['shop_name'];
$mobilephone=$_POST['mobilephone'];
$Business_Hours=$_POST['Business_Hours'];
$address=$_POST['address'];
$areaid=$_POST['areaid'];
$big_type_id=$_POST['big_type_id'];
$small_type_id=$_POST['small_type_id'];
$describe=$_POST['describe'];
$zoneid=$_POST['zoneid'];
$pics=$_POST['picurl'];
//设置文件上传目录
         $savePath = "../upload/shop";
    
         //允许的文件类型
         $fileFormat = array('gif','jpg','jpeg','png');
    
         //文件大小限制，单位: Byte，1KB = 1000 Byte
         //0 表示无限制，但受php.ini中upload_max_filesize设置影响
         $maxSize = 0;
    
         //覆盖原有文件吗？ 0 不允许   1 允许
         $overwrite = 0;
    
         //初始化上传类
         $f = new clsUpload( $savePath, $fileFormat, $maxSize, $overwrite);
    
         //如果想生成缩略图，则调用成员函数 $f->setThumb();
         //参数列表: setThumb($thumb, $thumbWidth = 0,$thumbHeight = 0)
         //$thumb=1 表示要生成缩略图，不调用时，其值为 0
         //$thumbWidth   缩略图宽，单位是像素(px)，留空则使用默认值 130
         //$thumbHeight 缩略图高，单位是像素(px)，留空则使用默认值 130
         $f->setThumb(1);
    
     $f->thumbWidth = 120;
     $f->thumbHeight = 120;
	  $f->thumbWidths = 350;
     $f->thumbHeights = 350;
        
         //参数中的uploadinput是表单中上传文件输入框input的名字
         //后面的0表示不更改文件名，若为1，则由系统生成随机文件名
         if (!$f->run('uploadinput',1)){
             //通过$f->errmsg()只能得到最后一个出错的信息，
             //详细的信息在$f->getInfo()中可以得到。
             //echo $f->errmsg()."<br>\n";
         }
         //上传结果保存在数组returnArray中。
     $pic = $f->getInfo();
	$shop_pic=$pic[0]["saveName"];
	$ext=end(explode('.',$activities_pic));
	if($ext){
	 $f->del("../upload/shop/".$pics);
	$f->del("../upload/shop/thumb_".$pics);
	$f->del("../upload/shop/thumbs_".$pics);
	}
	$pwdu=$activities_pic&&$ext?",`shop_pic`='$shop_pic'":"";
mysql_query("UPDATE {$dbarray[DB_PREFIX]}shop  SET `shop_name`='$shop_name',`oldPrice`='$oldPrice',`lowest_price`='$lowest_price',`sum`='$sum',`Reduced_price`='$Reduced_price',`endTime`='$endTime',`describe`='$describe' $pwdu WHERE id='$fid' ",$con);
echo "<script>alert('恭喜你，活动修改成功！');javascript:window.location.href='index.php?type=shop_activities_admin&shop_id=$shop_id';</script>";
}else{
//查看是否创建店铺
$buid=$_SESSION['buid'];
$sql="SELECT `id` FROM {$dbarray[DB_PREFIX]}shop WHERE Businesses_uid='$buid' ";
$query=mysql_query($sql,$con);
while($rs=mysql_fetch_array($query)){
		$dlist=$rs;
	}
	if($dlist[id]){
	//查询店铺列表
	$sql="SELECT * FROM {$dbarray[DB_PREFIX]}shop WHERE Businesses_uid='$buid' ";
$query=mysql_query($sql,$con);
while($rs=mysql_fetch_array($query)){
		$list_shop[]=$rs;
	}require("../business/template/shop_list.htm");
	}else{
	require("../business/template/login.htm");
	}
	
}

//统计店铺多少张优惠券
function tj_coupons($shopid){
require("../public/public.class.php");
$sql="SELECT count(*) as num FROM {$dbarray[DB_PREFIX]}Coupons  WHERE shop_id='$shopid' ";
$query=mysql_query($sql,$con);
while($rs=mysql_fetch_array($query)){
		$list_shop=$rs;
	}
	echo $list_shop[num];
}

//统计店铺活动
function tj_Activities($shopid){
require("../public/public.class.php");
$sql="SELECT count(*) as num FROM {$dbarray[DB_PREFIX]}newactivities  WHERE shop_id='$shopid' ";
$query=mysql_query($sql,$con);
while($rs=mysql_fetch_array($query)){
		$list_shop=$rs;
	}
	echo $list_shop[num];
}
?>