/***********************************************
* Floating Top Bar script- © Dynamic Drive (www.dynamicdrive.com)
* Sliding routine by Roy Whittle (http://www.javascript-fx.com/)
* This notice must stay intact for legal use.
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

var startY = 85; //set y offset of bar in pixels
 
var verticalpos="fromtop"; //enter "fromtop" or "frombottom"

function iecompattest(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body;
}

function get_cookie(Name) {
var search = Name + "=";
var returnvalue = "";
if (document.cookie.length > 0) {
offset = document.cookie.indexOf(search);
if (offset != -1) {
offset += search.length;
end = document.cookie.indexOf(";", offset);
if (end == -1) end = document.cookie.length;
returnvalue=unescape(document.cookie.substring(offset, end));
}
}
return returnvalue;
}

function staticbar(){
	barheight=document.getElementById("rightCol").offsetHeight;
	var ns = (navigator.appName.indexOf("Netscape") != -1) || window.opera;
	var d = document;
	function ml(id){
		var el=d.getElementById(id);
		if(d.layers)el.style=el
		el.sP=function(x,y){
		    if(iecompattest().scrollTop < 85 || y < 86) {
              this.style.position="absolute";this.style.top="85px";
            }
			if(iecompattest().scrollTop > 150 || y > 151) {
              this.style.top=y-85+"px";
            }
};
		
		if (verticalpos=="fromtop")
		el.y = startY;
		else{
		el.y = ns ? pageYOffset + innerHeight : iecompattest().scrollTop + iecompattest().clientHeight;
		el.y -= startY;
		}
		return el;
	}
	window.stayTopLeft=function(){
		if (verticalpos=="fromtop"){
		var pY = ns ? pageYOffset : iecompattest().scrollTop;
		ftlObj.y += (pY + startY - ftlObj.y);
		
		}
		else{
		var pY = ns ? pageYOffset + innerHeight - barheight: iecompattest().scrollTop + iecompattest().clientHeight - barheight;
		ftlObj.y += (pY - startY - ftlObj.y);
		}
		ftlObj.sP(ftlObj.x, ftlObj.y);
		setTimeout("stayTopLeft()", 1);
	};
	ftlObj = ml("rightCol");
	stayTopLeft();
}

if (window.addEventListener)
window.addEventListener("load", staticbar, false);
else if (window.attachEvent)
window.attachEvent("onload", staticbar);
else if (document.getElementById)
window.onload=staticbar;