<?php
header("Content-type: text/html; charset=gb2312");
require("../public/public.class.php");
$type=$_GET['type'];
if($type=="reg"){
$username=$_POST['username'];
$pwd=$_POST['pwd'];
$password=$_POST['password'];
/*$mobilephone=$_POST['mobilephone'];
*///��֤�û��Ƿ����
$sql="SELECT `uid` FROM {$dbarray[DB_PREFIX]}businesses WHERE username='$username' ";
$query=mysql_query($sql,$con);
while($rs=mysql_fetch_array($query)){
		$dlist=$rs;
	}
	if($dlist[uid]){
	echo "<script>alert('���û����Ѿ����ڣ����������룡');javascript:window.location.href='index.php?type=reg';</script>";
	}elseif(!$username){
	echo "<script>alert('�û�������Ϊ�գ�');javascript:window.location.href='index.php?type=reg';</script>";
	}elseif(!$pwd){
	echo "<script>alert('���벻��Ϊ�գ�');javascript:window.location.href='index.php?type=reg';</script>";
	}elseif(!$password){
	echo "<script>alert('ȷ�����벻��Ϊ�գ�');javascript:window.location.href='index.php?type=reg';</script>";
	}else{
	$pwds=md5($pwd);
	$posttime=date("Y-m-d H:i");
	$sql_in="INSERT INTO {$dbarray[DB_PREFIX]}businesses (`username`,`pwd`,`sealyz`,`posttime`) VALUES('$username','$pwds','$pwds','$posttime') ";
	mysql_query($sql_in,$con);
	echo "<script>alert('��ϲ�㣬ע��ɹ������¼��');javascript:window.location.href='index.php';</script>";
	
	}
	}elseif($type=="login"){	
	$username=$_POST['usernames'];
	$password=$_POST['passwords'];
	if(!$username){
	echo "<script>alert('�û�������Ϊ�գ�');javascript:window.location.href='index.php?type=reg';</script>";
	}elseif(!$password){
	echo "<script>alert('���벻��Ϊ�գ�');javascript:window.location.href='index.php?type=reg';</script>";
	}else{
	$pwd=md5($password);
	$sql="SELECT `uid` FROM {$dbarray[DB_PREFIX]}businesses WHERE username='$username' AND pwd='$pwd' ";
$query=mysql_query($sql,$con);
while($rs=mysql_fetch_array($query)){
		$dlist=$rs;
	}
	if($dlist[uid]){
	$_SESSION['buid']=$dlist[uid];
	echo "<script>alert('��ϲ�㣬��¼�ɹ���');javascript:window.location.href='index.php?type=myshop';</script>";
	}else{
	echo "<script>alert('�ܱ�Ǹ����½ʧ�ܣ���˶��˺ź����룡');javascript:window.location.href='index.php?type=home';</script>";
	}
	
	}
	
	}
?>