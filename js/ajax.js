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

		myXmlHttpRequests.open("post","Ajaxsmalltype.php",true);//异步方式

		myXmlHttpRequests.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

		//指定回调函数
		myXmlHttpRequests.onreadystatechange=chulia;

		//发送
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
					myOption.innerText="选择小分类";
					myOption.value=0;
					//添加到
					$('small_type_id').appendChild(myOption);
				//遍历并取出城市
				for(var i=0;i<cities.length;i++){
					
					var city_name=cities[i].childNodes[0].nodeValue;
					var d=city_name.split(";");
					//创建新的元素option
					var myOption=document.createElement("option");
					myOption.value=d[1];
					myOption.innerText=d[0];
					//添加到
					$('small_type_id').appendChild(myOption);
				}
			
		}}
		
	}
	
	
	function getCourses(fid){
	createXMLHttpRequest();

	if(myXmlHttpRequests){

		myXmlHttpRequests.open("post","Ajaxzone.php",true);//异步方式

		myXmlHttpRequests.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

		//指定回调函数
		myXmlHttpRequests.onreadystatechange=chulias;

		//发送
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
					myOption.innerText="选择商圈";
					myOption.value=0;
					//添加到
					$('zoneid').appendChild(myOption);
				//遍历并取出城市
				for(var i=0;i<cities.length;i++){
					
					var city_name=cities[i].childNodes[0].nodeValue;
					var d=city_name.split(";");
					//创建新的元素option
					var myOption=document.createElement("option");
					myOption.value=d[1];
					myOption.innerText=d[0];
					//添加到
					$('zoneid').appendChild(myOption);
				}
			
		}}
		
	}
	
	
	//这里我们写一个函数
	function $(id){
		return document.getElementById(id);
	}