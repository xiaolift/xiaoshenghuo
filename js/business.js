// JavaScript Document
function checkdata(type,val,er)
{
	var emp = /^\s*$/;
	 var regPartton=/1[3-8]+\d{9}/;
	var span=document.getElementById(er);
 switch(type){
	 case 1:
	 if(emp.test(val.value)){ 
		span.innerHTML="��,����д�ֻ�����!";
		//val.focus();
	 }else if(!regPartton.test(val.value)){
		 span.innerHTML="��,�ֻ�������������������!";
		// val.focus(); 
		 
	 }else{
		 span.innerHTML="������Ϊ��֤��������,����ȫ������!";
		 //fr1.pwd.focus();
		 }
	 break;
	 case 2:
	 if(emp.test(val.value)){
		 span.innerHTML="��,����д����!";
		 //val.focus(); 
	 }else if(val.value.length<6){
		 span.innerHTML="��,���벻��С��6λ!";
		 //val.focus(); 
	 }else{
		span.innerHTML=""; 
		//fr1.password.focus();
	 }
	 break;
	 case 3:
	 var pwd=fr1.pwd.value;
	 if(emp.test(val.value)){
		 span.innerHTML="��,����дȷ������!";
		 //val.focus(); 
	 }else if(val.value!=pwd){
		 span.innerHTML="��,ȷ�����벻��ȷ������������!";
		// val.focus(); 
		 
	 }else{
		span.innerHTML=""; 
		//fr1.mobilephone.focus();
	 }
	 break;
	 
 }
 
 }
 
 function datasubmit(){
	 var emp = /^\s*$/;
	 var regPartton=/1[3-8]+\d{9}/;
	 var username=document.getElementById("username").value;
	 var pwd=document.getElementById("pwd").value;
	 var password=document.getElementById("password").value;
	/* var mobilephone=document.getElementById("mobilephone").value;*/
	 if(emp.test(username)){
		 alert("��,����д�ֻ�����!");
		 return false;
	 }else if(!regPartton.test(username)){
		  alert("��,�ֻ�������������������!");
		 return false;
		 
	 }else if(emp.test(pwd)){
		 alert("��,����д����!");
		 return false;
	 }else if(pwd.length<6){
		 alert("��,���벻��С��6λ!");
		 return false;
	 }else if(emp.test(password)){
		 alert("��,����дȷ������!");
		 return false;
	 }else if(password!=pwd){
		 alert("��,ȷ�����벻��ȷ������������!");
		 return false;
	 }else{
		return true; 
	 }
	 
 }
 
 
 function datalogin(){
	 
	var usernames=document.getElementById("usernames").value;
	var passwords=document.getElementById("passwords").value;
	 var emp = /^\s*$/;
	 if(emp.test(usernames)){
		 alert("��,����д�û���!");
		 return false;
	 }else if(emp.test(passwords)){
		 alert("��,����д����!");
		 return false;
	 }else{
		return true; 
	 }
	
 }
 

 
 