<?php
if(isset($_POST['sub2'])){
require("../public/upload_class.php");
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
         if (!@$f->run('uploadinput',1)){
             //ͨ��$f->errmsg()ֻ�ܵõ����һ���������Ϣ��
             //��ϸ����Ϣ��$f->getInfo()�п��Եõ���
             //echo $f->errmsg()."<br>\n";
         }
         //�ϴ��������������returnArray�С�
     $pic = $f->getInfo();
	 $ext=end(explode('.',$pic[0]["saveName"]));
	 if($ext){
	 $destfile=$pic[0]["saveName"];
	 echo "<script>javascript:parent.hello('$destfile','activities');</script>";
	 }
	
	}
?>