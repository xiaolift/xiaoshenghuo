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
//�鿴�Ƿ񴴽�����
$buid=$_SESSION['buid'];
$sql="SELECT `id` FROM {$dbarray[DB_PREFIX]}shop WHERE Businesses_uid='$buid' ";
$query=mysql_query($sql,$con);
while($rs=mysql_fetch_array($query)){
		$dlist=$rs;
	}
	if($dlist[id]){
	//��ѯ�����б�
	$sql="SELECT * FROM {$dbarray[DB_PREFIX]}shop WHERE Businesses_uid='$buid' ";
$query=mysql_query($sql,$con);
while($rs=mysql_fetch_array($query)){
		$list_shop[]=$rs;
	}
	require("../business/template/shop_list.htm");
	
	}else{
	//����ѡ���б�
$sqlqy="SELECT `id`,`area` FROM {$dbarray[DB_PREFIX]}area ";
$query_qy=mysql_query($sqlqy,$con);
while($rs=mysql_fetch_array($query_qy)){
		$qylist[]=$rs;
	}
	//��ѯ������б�
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
	echo "<script>alert('��ϲ�㣬���̴����ɹ���');javascript:window.location.href='index.php?type=myshop';</script>";

}elseif($type=="shop_add"){
//����ѡ���б�
$sqlqy="SELECT `id`,`area` FROM {$dbarray[DB_PREFIX]}area ";
$query_qy=mysql_query($sqlqy,$con);
while($rs=mysql_fetch_array($query_qy)){
		$qylist[]=$rs;
	}
	//��ѯ������б�
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
$rs[check]=$rs[check]?"����":"δ���";
$rs[check]=$nowtime>$times?"�ѹ���":$rs[check];
$rs[sum]=$rs[sum]!=-1?"����:$rs[sum]��":"������";
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
	echo "<script>alert('��ϲ��,�Ż�ȯ�����ɹ���');javascript:window.location.href='index.php?type=shop_coupons_admin&fid=$shop_id';</script>";
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

$sum=!$sum?-1:$sum=$sum=="������"?-1:$sum;
//�����ļ��ϴ�Ŀ¼
         $savePath = "../upload/coupons";
    
         //������ļ�����
         $fileFormat = array('gif','jpg','jpeg','png');
    
         //�ļ���С���ƣ���λ: Byte��1KB = 1000 Byte
         //0 ��ʾ�����ƣ�����php.ini��upload_max_filesize����Ӱ��
         $maxSize = 0;
    
         //����ԭ���ļ��� 0 ������   1 ����
         $overwrite = 0;
    
         //��ʼ���ϴ���
         $f = new clsUpload( $savePath, $fileFormat, $maxSize, $overwrite);
    
         //�������������ͼ������ó�Ա���� $f->setThumb();
         //�����б�: setThumb($thumb, $thumbWidth = 0,$thumbHeight = 0)
         //$thumb=1 ��ʾҪ��������ͼ��������ʱ����ֵΪ 0
         //$thumbWidth   ����ͼ����λ������(px)��������ʹ��Ĭ��ֵ 130
         //$thumbHeight ����ͼ�ߣ���λ������(px)��������ʹ��Ĭ��ֵ 130
         $f->setThumb(1);
    
     $f->thumbWidth = 120;
     $f->thumbHeight = 120;
	  $f->thumbWidths = 180;
     $f->thumbHeights = 180;
        
         //�����е�uploadinput�Ǳ����ϴ��ļ������input������
         //�����0��ʾ�������ļ�������Ϊ1������ϵͳ��������ļ���
         if (!$f->run('uploadinput',1)){
             //ͨ��$f->errmsg()ֻ�ܵõ����һ���������Ϣ��
             //��ϸ����Ϣ��$f->getInfo()�п��Եõ���
             //echo $f->errmsg()."<br>\n";
         }
         //�ϴ��������������returnArray�С�
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
echo "<script>alert('��ϲ�㣬�Ż�ȯ�޸ĳɹ���');javascript:window.location.href='index.php?type=shop_coupons_admin&fid=$shop_id';</script>";
}elseif($type=="shop_activities_admin"){
$fid=$_GET['shop_id'];
$nowtime=time();
$sqlst="SELECT * FROM {$dbarray[DB_PREFIX]}newactivities WHERE shop_id='$fid' ORDER BY id DESC";
$query_st=mysql_query($sqlst,$con);
while($rs=mysql_fetch_array($query_st)){
$times=strtotime($rs[endTime]);
$rs[check]=$rs[check]?"����":"δ���";
$rs[check]=$nowtime>$times?"�ѹ���":$rs[check]; 
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
	echo "<script>alert('��ϲ��,������ɹ���');javascript:window.location.href='index.php?type=shop_activities_admin&shop_id=$shop_id';</script>";
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
$sum=!$sum?-1:$sum=$sum=="������"?-1:$sum;
//�����ļ��ϴ�Ŀ¼
         $savePath = "../upload/activities";
    
         //������ļ�����
         $fileFormat = array('gif','jpg','jpeg','png');
    
         //�ļ���С���ƣ���λ: Byte��1KB = 1000 Byte
         //0 ��ʾ�����ƣ�����php.ini��upload_max_filesize����Ӱ��
         $maxSize = 0;
    
         //����ԭ���ļ��� 0 ������   1 ����
         $overwrite = 0;
    
         //��ʼ���ϴ���
         $f = new clsUpload( $savePath, $fileFormat, $maxSize, $overwrite);
    
         //�������������ͼ������ó�Ա���� $f->setThumb();
         //�����б�: setThumb($thumb, $thumbWidth = 0,$thumbHeight = 0)
         //$thumb=1 ��ʾҪ��������ͼ��������ʱ����ֵΪ 0
         //$thumbWidth   ����ͼ����λ������(px)��������ʹ��Ĭ��ֵ 130
         //$thumbHeight ����ͼ�ߣ���λ������(px)��������ʹ��Ĭ��ֵ 130
         $f->setThumb(1);
    
     $f->thumbWidth = 120;
     $f->thumbHeight = 120;
	  $f->thumbWidths = 180;
     $f->thumbHeights = 180;
        
         //�����е�uploadinput�Ǳ����ϴ��ļ������input������
         //�����0��ʾ�������ļ�������Ϊ1������ϵͳ��������ļ���
         if (!$f->run('uploadinput',1)){
             //ͨ��$f->errmsg()ֻ�ܵõ����һ���������Ϣ��
             //��ϸ����Ϣ��$f->getInfo()�п��Եõ���
             //echo $f->errmsg()."<br>\n";
         }
         //�ϴ��������������returnArray�С�
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
echo "<script>alert('��ϲ�㣬��޸ĳɹ���');javascript:window.location.href='index.php?type=shop_activities_admin&shop_id=$shop_id';</script>";

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

//����ѡ���б�
$sqlqy="SELECT `id`,`area` FROM {$dbarray[DB_PREFIX]}area ";
$query_qy=mysql_query($sqlqy,$con);
while($rs=mysql_fetch_array($query_qy)){
		$qylist[]=$rs;
	}
	//��ѯ������б�
$sqlbt="SELECT `id`,`type_name` FROM {$dbarray[DB_PREFIX]}big_type ";
$query_bt=mysql_query($sqlbt,$con);
while($rs=mysql_fetch_array($query_bt)){
		$btlist[]=$rs;
	}
	//��ѯС�����б�
$sqlbt="SELECT `id`,`small_type_name` FROM {$dbarray[DB_PREFIX]}small_type WHERE big_type_id='$list_shop[big_type_id]' ";
$query_bt=mysql_query($sqlbt,$con);
while($rs=mysql_fetch_array($query_bt)){
		$stlist[]=$rs;
	}
	//��ѯ��Ȧ�б�
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
//�����ļ��ϴ�Ŀ¼
         $savePath = "../upload/shop";
    
         //������ļ�����
         $fileFormat = array('gif','jpg','jpeg','png');
    
         //�ļ���С���ƣ���λ: Byte��1KB = 1000 Byte
         //0 ��ʾ�����ƣ�����php.ini��upload_max_filesize����Ӱ��
         $maxSize = 0;
    
         //����ԭ���ļ��� 0 ������   1 ����
         $overwrite = 0;
    
         //��ʼ���ϴ���
         $f = new clsUpload( $savePath, $fileFormat, $maxSize, $overwrite);
    
         //�������������ͼ������ó�Ա���� $f->setThumb();
         //�����б�: setThumb($thumb, $thumbWidth = 0,$thumbHeight = 0)
         //$thumb=1 ��ʾҪ��������ͼ��������ʱ����ֵΪ 0
         //$thumbWidth   ����ͼ����λ������(px)��������ʹ��Ĭ��ֵ 130
         //$thumbHeight ����ͼ�ߣ���λ������(px)��������ʹ��Ĭ��ֵ 130
         $f->setThumb(1);
    
     $f->thumbWidth = 120;
     $f->thumbHeight = 120;
	  $f->thumbWidths = 350;
     $f->thumbHeights = 350;
        
         //�����е�uploadinput�Ǳ����ϴ��ļ������input������
         //�����0��ʾ�������ļ�������Ϊ1������ϵͳ��������ļ���
         if (!$f->run('uploadinput',1)){
             //ͨ��$f->errmsg()ֻ�ܵõ����һ���������Ϣ��
             //��ϸ����Ϣ��$f->getInfo()�п��Եõ���
             //echo $f->errmsg()."<br>\n";
         }
         //�ϴ��������������returnArray�С�
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
echo "<script>alert('��ϲ�㣬��޸ĳɹ���');javascript:window.location.href='index.php?type=shop_activities_admin&shop_id=$shop_id';</script>";
}else{
//�鿴�Ƿ񴴽�����
$buid=$_SESSION['buid'];
$sql="SELECT `id` FROM {$dbarray[DB_PREFIX]}shop WHERE Businesses_uid='$buid' ";
$query=mysql_query($sql,$con);
while($rs=mysql_fetch_array($query)){
		$dlist=$rs;
	}
	if($dlist[id]){
	//��ѯ�����б�
	$sql="SELECT * FROM {$dbarray[DB_PREFIX]}shop WHERE Businesses_uid='$buid' ";
$query=mysql_query($sql,$con);
while($rs=mysql_fetch_array($query)){
		$list_shop[]=$rs;
	}require("../business/template/shop_list.htm");
	}else{
	require("../business/template/login.htm");
	}
	
}

//ͳ�Ƶ��̶������Ż�ȯ
function tj_coupons($shopid){
require("../public/public.class.php");
$sql="SELECT count(*) as num FROM {$dbarray[DB_PREFIX]}Coupons  WHERE shop_id='$shopid' ";
$query=mysql_query($sql,$con);
while($rs=mysql_fetch_array($query)){
		$list_shop=$rs;
	}
	echo $list_shop[num];
}

//ͳ�Ƶ��̻
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