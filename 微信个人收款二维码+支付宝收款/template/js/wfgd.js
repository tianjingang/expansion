/**
  **************************************************************************************************
  **********  bbs.sasadown.cn 2016 WAP版官方正式版  *****  官方正版 *** 版权所有 *** 盗版必究  **********
  **********------------------------------------------------------------------------------**********
  * 官方网站：http://bbs.sasadown.cn/ 官方店铺：http://bbs.sasadown.cn/  *  官方店铺QQ：151619143 请认准再购买 *
  **************************************************************************************************
*/

var speeds=100;

var wffahuo=document.getElementById('wffahuo');

var wffahuo1=document.getElementById('wffahuo1');

var wffahuo2=document.getElementById('wffahuo2');

wffahuo2.innerHTML=wffahuo1.innerHTML

function Marquee1(){

	if(wffahuo2.offsetHeight-wffahuo.scrollTop<=0)

	wffahuo.scrollTop-=wffahuo1.offsetHeight

	else{

		wffahuo.scrollTop++

	}

}

var MyMar1=setInterval(Marquee1,speeds)

wffahuo.onmouseover=function(){

	clearInterval(MyMar1)

}

wffahuo.onmouseout=function(){

	MyMar1=setInterval(Marquee1,speeds)

}

/*//////////////////////////// WFORDERJSEND ////////////////////////////*/