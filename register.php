<?php
header("Content-type: text/html; charset=gb2312");
require("../public/public.class.php");
$type=$_GET['type'];
if($type=="reg"){
$username=$_POST['username'];
$pwd=$_POST['pwd'];
$password=$_POST['password'];
/*$mobilephone=$_POST['mobilephone'];
*///验证用户是否存在
$sql="SELECT `uid` FROM {$dbarray[DB_PREFIX]}businesses WHERE username='$username' ";
$query=mysql_query($sql,$con);
while($rs=mysql_fetch_array($query)){
		$dlist=$rs;
	}
	if($dlist[uid]){
	echo "<script>alert('该用户名已经存在，请重新输入！');javascript:window.location.href='index.php?type=reg';</script>";
	}elseif(!$username){
	echo "<script>alert('用户名不能为空！');javascript:window.location.href='index.php?type=reg';</script>";
	}elseif(!$pwd){
	echo "<script>alert('密码不能为空！');javascript:window.location.href='index.php?type=reg';</script>";
	}elseif(!$password){
	echo "<script>alert('确认密码不能为空！');javascript:window.location.href='index.php?type=reg';</script>";
	}else{
	$pwds=md5($pwd);
	$posttime=date("Y-m-d H:i");
	$sql_in="INSERT INTO {$dbarray[DB_PREFIX]}businesses (`username`,`pwd`,`sealyz`,`posttime`) VALUES('$username','$pwds','$pwds','$posttime') ";
	mysql_query($sql_in,$con);
	echo "<script>alert('恭喜你，注册成功，请登录！');javascript:window.location.href='index.php';</script>";
	
	}
	}elseif($type=="login"){	
	$username=$_POST['usernames'];
	$password=$_POST['passwords'];
	if(!$username){
	echo "<script>alert('用户名不能为空！');javascript:window.location.href='index.php?type=reg';</script>";
	}elseif(!$password){
	echo "<script>alert('密码不能为空！');javascript:window.location.href='index.php?type=reg';</script>";
	}else{
	$pwd=md5($password);
	$sql="SELECT `uid` FROM {$dbarray[DB_PREFIX]}businesses WHERE username='$username' AND pwd='$pwd' ";
$query=mysql_query($sql,$con);
while($rs=mysql_fetch_array($query)){
		$dlist=$rs;
	}
	if($dlist[uid]){
	$_SESSION['buid']=$dlist[uid];
	echo "<script>alert('恭喜你，登录成功！');javascript:window.location.href='index.php?type=myshop';</script>";
	}else{
	echo "<script>alert('很抱歉，登陆失败，请核对账号和密码！');javascript:window.location.href='index.php?type=home';</script>";
	}
	
	}
	
	}
?>