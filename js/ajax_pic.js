// JavaScript Document
function uploadimg(theform){ 
var tu1=document.getElementById('tu1').value;
var emp = /^\s*$/;
     //�ύ��ǰ��    
	 if(emp.test(tu1)){
		 alert("�ף���ѡ��ͼƬŶ��");
		 return false;
	 }else{
		 var sub2=document.getElementById('sub2');
		 sub2.value="�ϴ��С�";
		 
     theform.submit();
	 //sub2.disabled=true;
	 }
	 
    }
	
	var myXmlHttpRequests="";
		 function createXMLHttpRequest(){
        	if(window.XMLHttpRequest){
        	myXmlHttpRequests= new XMLHttpRequest();
        	}else if(window.ActiveXobject){
        	 try{
        	 myXmlHttpRequests = new ActiveXobject("Msxm12.XMLHTTP");
        	 }catch(e){
        	 try{
        	myXmlHttpRequests = new ActiveXObject("Microsoft.XMLHTTP");
        	 }catch(e){}
        	 }
        	}
        }
		
		function hello(picurl,act){
			var span=document.getElementById('showpic');
			var picurls=document.getElementById('picurl');
			picurls.value=picurl;
			span.innerHTML="<img width='100' height='60' src='../upload/"+act+"/thumb_"+picurl+"'/>";
			var sub2=document.getElementById('sub2');
		 sub2.value="�ϴ�ͼƬ";
		 //sub2.disabled=false;
		//alert(picurl);	
		}
	



		
	