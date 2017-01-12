/**
  **************************************************************************************************
  **********  bbs.sasadown.cn WAP版官方正式版  *****  官方正版 *** 版权所有 *** 盗版必究  **********
  **********------------------------------------------------------------------------------**********
  ****** 官方网站：http://bbs.sasadown.cn/  *****  bbs.sasadown.cn 请认准再了购买 ********
  **************************************************************************************************
*/

window.onerror=function(){return true;} 

function $(id){return document.getElementById(id);}  

function getHeight(){$("wffahuo").style.height=$("wfforml").offsetHeight-86+"px";} 

window.onload=function(){getHeight();}

/*//////////////////////////// WFORDERJSFGX ////////////////////////////*/

function postcheck(){

	var ifname=/^[\u4e00-\u9fa5]{2,6}$/;

	var ifmob=/^1[3,4,5,7,8]\d{9}$/;

    var ifqq=/^\d{5,15}$/;

	var ifemail=/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;

	try{

		var flag1=0;

		var radio1=document.getElementsByName("bdproduct");		

		for(var i=0;i<radio1.length;i++){

			if(radio1.item(i).checked==true){

				flag1=1;

				break;

			}

		}

		if(!flag1&&radio1.item(0).getAttribute("type")=="radio"){

			alert('请选择您要订购的产品！');

			return false;

		}

    }catch(ex){}

	try{		

		var cbxs=document.getElementsByName("bdproduct[]");

		var flag2=0;

		for(var i=0;i<cbxs.length;i++){

			if(cbxs[i].checked){

				flag2+=1;

			}

		}

		if(flag2<1&&cbxs[0].getAttribute("type")=='checkbox'){

			alert('请选择您要订购的产品！');

			return false;

		}

	}catch(ex){}	

	try{

		if(document.wfform.bdproduct.value==""){

			alert('请选择您要订购的产品！');

			document.wfform.bdproduct.focus();

			return false;

		}

    }catch(ex){}	

	try{

		if(document.wfform.bdname.value==""){

			alert('请填写姓名（会员名）！');

			document.wfform.bdname.focus();

			return false;

		}

		if(!ifname.test(document.wfform.bdname.value)){

			alert('姓名（会员名）格式不正确，请重新填写！');

			document.wfform.bdname.focus();

			return false;

		}

    }catch(ex){}

    try{

		if(document.wfform.bdmob.value==""){

			alert('请填写手机号(QQ号)码！');

			document.wfform.bdmob.focus();

			return false;

		}

		if(!ifmob.test(document.wfform.bdmob.value)){

			alert('手机号(QQ号)码格式不正确，请重新填写！');

			document.wfform.bdmob.focus();

			return false;

		}

    }catch(ex){}

    try{

		if(document.wfform.bdprovince.value==""){

			alert('请选择所在地区！');

			document.wfform.bdprovince.focus();

			return false;

		}

    }catch(ex){}

    try{

		if(document.wfform.bdaddress.value==""){

			alert('请填写详细地址！');

			document.wfform.bdaddress.focus();

			return false;

		}

    }catch(ex){}

    try{

		if(document.wfform.bdqq.value==""){

			alert('请填写QQ号码！');

			document.wfform.bdqq.focus();

			return false;

		}

		if(!ifqq.test(document.wfform.bdqq.value)){

			alert('QQ号码格式不正确，请重新填写！');

			document.wfform.bdqq.focus();

			return false;

		}

    }catch(ex){}

    try{

		if(document.wfform.wfemail.value==""){

			alert('请填写E-MAIL！');

			document.wfform.wfemail.focus();

			return false;

		}

		if(!ifemail.test(document.wfform.wfemail.value)){

			alert('E-MAIL格式不正确，请重新填写！');

			document.wfform.wfemail.focus();

			return false;

		}

    }catch(ex){}


    try{

		var onbdpay=document.getElementsByName("bdpay"); 

		for(var i=0;i<onbdpay.length;i++){

			if(onbdpay[i].checked){

			var bdpay=onbdpay[i].value;

			}

		}

		if(bdpay=="支付宝支付"){

			document.wfform.bdsubmit.value="重新提交";

		}

		else{

			document.wfform.bdsubmit.value="正在提交，请稍等 >>";

		}

		return true;

    }catch(ex){}

}

/*//////////////////////////// WFORDERJSFGX ////////////////////////////*/

try{

	new PCAS("bdprovince","bdcity","bdarea");

}catch(ex){}



/*//////////////////////////// WFORDERJSFGX ////////////////////////////*/
function pricea(){
	var bdproduct = document.wfform.bdproduct.alt;
	for(var i=0;i<document.wfform.bdproduct.length;i++){
		if(document.wfform.bdproduct[i].checked==true){
			var bdproduct = document.wfform.bdproduct[i].alt;
			break;
		}
	}
    if(document.wfform.bdmun.value=="" || document.wfform.bdmun.value==0){	
		var bdmun=1;
	}
	else{
		var bdmun=document.wfform.bdmun.value;
	}	
	var bdprice=bdproduct*bdmun;
	document.wfform.bdprice.value=bdprice;
	document.getElementById("showprice").innerHTML=bdprice;
}

function priceb(){

    var wfcpxljg=document.getElementById("bdproduct");

    var bdproduct=wfcpxljg.options[document.getElementById("bdproduct").options.selectedIndex].title; 

    if(document.wfform.bdmun.value==""||document.wfform.bdmun.value==0){	

		var bdmun=1;

	}

	else{

		var bdmun=document.wfform.bdmun.value;

	}	

	var bdprice=bdproduct*bdmun;

	document.wfform.bdprice.value=bdprice;

	document.getElementById("showprice").innerHTML=bdprice;

}

function pricec(){

	var bdmun=0;

	var bdprice=0;	

	var obj=document.getElementsByName("bdproduct[]");

    for(var i=0;i<obj.length;i++){

		if(obj[i].checked){

			bdmun++;

			bdprice+=parseInt(obj[i].alt);

		}

	}

	document.wfform.bdmun.value=bdmun;

	document.wfform.bdprice.value=bdprice;

	document.getElementById("showmun").innerHTML=bdmun;

	document.getElementById('showprice').innerHTML=bdprice;

}

/*//////////////////////////// WFORDERJSFGX ////////////////////////////*/

function changeItem(i){

    var k=4;

	for(var j=0;j<k;j++){

	    if(j==i){

		    document.getElementById("paydiv"+j).style.display="block";

		}

		else{		

		    document.getElementById("paydiv"+j).style.display="none";

		}

	}

}

function opay(){

	document.getElementById("wfform").target="_parent";

}

function opay2(){

    document.getElementById("wfform").target="_blank";

}

/*///////////////////////////////////////// BDORDERJSFGX /////////////////////////////////////////*/
document.getElementById("referer").value = opener?opener.location.href:(top.document.referrer?top.document.referrer:top.location.href);
document.getElementById("url").value = top.location.href;
document.getElementById("purl").value = document.location;
/*///////////////////////////////////////// BDORDERJSEND /////////////////////////////////////////*/