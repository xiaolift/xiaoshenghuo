<?php
header("Content-Type: text/xml;charset=gb2312");
	header("Cache-Control: no-cache");
	$fid=$_POST['fid'];//»ñÈ¡id
require("../public/public.class.php");
$info1="<Corporations>";
$queryzone=mysql_query("SELECT * FROM {$dbarray[DB_PREFIX]}business_zones WHERE areaid='$fid' ORDER BY id ASC",$con);
while($rs=mysql_fetch_array($queryzone)){
$list_zone[]=$rs;
	}
	foreach($list_zone as $val){
	$vals=$val[zones].";".$val[id];
	$info2.="<Corporation>$vals</Corporation>";
	}
	
	$info3="</Corporations>";	
$info=$info1.$info2.$info3;
echo $info

?>