/**
  **************************************************************************************************
  **********  bbs.sasadown.cn 2016 WAP版官方正式版  *****  官方正版 *** 版权所有 *** 盗版必究  **********
  **********------------------------------------------------------------------------------**********
  * 官方网站：http://bbs.sasadown.cn/ 官方店铺：http://bbs.sasadown.cn/  *  官方店铺QQ：151619143 请认准再购买 *
  **************************************************************************************************
*/
var speeds=80;
var bdfahuo=document.getElementById('bdfahuo');
var bdfahuo1=document.getElementById('bdfahuo1');
var bdfahuo2=document.getElementById('bdfahuo2');
bdfahuo2.innerHTML=bdfahuo1.innerHTML
function Marquee1(){
	if(bdfahuo2.offsetHeight-bdfahuo.scrollTop<=0)
	bdfahuo.scrollTop-=bdfahuo1.offsetHeight
	else{
		bdfahuo.scrollTop++
	}
}
var MyMar1=setInterval(Marquee1,speeds)
bdfahuo.onmouseover=function(){
	clearInterval(MyMar1)
}
bdfahuo.onmouseout=function(){
	MyMar1=setInterval(Marquee1,speeds)
}
/*///////////////////////////////////////// BDORDERJSEND /////////////////////////////////////////*/