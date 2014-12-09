<?php
if(isset($_POST['sub2'])){
require("../public/upload_class.php");
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
         if (!@$f->run('uploadinput',1)){
             //通过$f->errmsg()只能得到最后一个出错的信息，
             //详细的信息在$f->getInfo()中可以得到。
             //echo $f->errmsg()."<br>\n";
         }
         //上传结果保存在数组returnArray中。
     $pic = $f->getInfo();
	 $ext=end(explode('.',$pic[0]["saveName"]));
	 if($ext){
	 $destfile=$pic[0]["saveName"];
	 echo "<script>javascript:parent.hello('$destfile','coupons');</script>";
	 }
	
	}
?>