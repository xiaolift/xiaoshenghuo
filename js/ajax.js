// JavaScript Document
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


		function getCourse(fid){
	createXMLHttpRequest();

	if(myXmlHttpRequests){

		myXmlHttpRequests.open("post","Ajaxsmalltype.php",true);//�첽��ʽ

		myXmlHttpRequests.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

		//ָ���ص�����
		myXmlHttpRequests.onreadystatechange=chulia;

		//����
		var datas="fid="+fid;
		myXmlHttpRequests.send(datas);
	}
}

function chulia(){
		if(myXmlHttpRequests.readyState==4){
			
			if(myXmlHttpRequests.status==200){
				var cities=myXmlHttpRequests.responseXML.getElementsByTagName("Corporation");
				$('small_type_id').length=0;
				var myOption=document.createElement("option");	
					myOption.innerText="ѡ��С����";
					myOption.value=0;
					//��ӵ�
					$('small_type_id').appendChild(myOption);
				//������ȡ������
				for(var i=0;i<cities.length;i++){
					
					var city_name=cities[i].childNodes[0].nodeValue;
					var d=city_name.split(";");
					//�����µ�Ԫ��option
					var myOption=document.createElement("option");
					myOption.value=d[1];
					myOption.innerText=d[0];
					//��ӵ�
					$('small_type_id').appendChild(myOption);
				}
			
		}}
		
	}
	
	
	function getCourses(fid){
	createXMLHttpRequest();

	if(myXmlHttpRequests){

		myXmlHttpRequests.open("post","Ajaxzone.php",true);//�첽��ʽ

		myXmlHttpRequests.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

		//ָ���ص�����
		myXmlHttpRequests.onreadystatechange=chulias;

		//����
		var datas="fid="+fid;
		myXmlHttpRequests.send(datas);
	}
}

function chulias(){
		if(myXmlHttpRequests.readyState==4){
			
			if(myXmlHttpRequests.status==200){
				var cities=myXmlHttpRequests.responseXML.getElementsByTagName("Corporation");
				$('zoneid').length=0;
				var myOption=document.createElement("option");	
					myOption.innerText="ѡ����Ȧ";
					myOption.value=0;
					//��ӵ�
					$('zoneid').appendChild(myOption);
				//������ȡ������
				for(var i=0;i<cities.length;i++){
					
					var city_name=cities[i].childNodes[0].nodeValue;
					var d=city_name.split(";");
					//�����µ�Ԫ��option
					var myOption=document.createElement("option");
					myOption.value=d[1];
					myOption.innerText=d[0];
					//��ӵ�
					$('zoneid').appendChild(myOption);
				}
			
		}}
		
	}
	
	
	//��������дһ������
	function $(id){
		return document.getElementById(id);
	}