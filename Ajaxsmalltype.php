<?php
header("Content-Type: text/xml;charset=gb2312");
	header("Cache-Control: no-cache");
	$fid=$_POST['fid'];//��ȡid
require("../public/public.class.php");
$info1="<Corporations>";
$queryzone=mysql_query("SELECT * FROM {$dbarray[DB_PREFIX]}small_type WHERE big_type_id='$fid' ORDER BY id ASC",$con);
while($rs=mysql_fetch_array($queryzone)){
$list_zone[]=$rs;
	}
	foreach($list_zone as $val){
	$vals=$val[small_type_name].";".$val[id];
	$info2.="<Corporation>$vals</Corporation>";
	}
	
	$info3="</Corporations>";	
$info=$info1.$info2.$info3;
echo $info

?>