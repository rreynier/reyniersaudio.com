document.write('<div id="loading"><div id="centerloading"><img src="/images/loading.gif" alt="Loading"/></div></div>');
function addLoadEvent(func){
    //setTimeout("$('#centerloading').animate({'opacity':'1'},500);",5);
    var oldonload=window.onload;
    if(typeof window.onload!='function')

    {
        window.onload=func
        }else{
        window.onload=function(){
            if(oldonload){
                oldonload()
                }
                func()
            }
        }
}
addLoadEvent
    (function(){
    setTimeout("$('#loading').animate({'opacity':'0'},1000);",500);
    setTimeout("$('#loading').hide()",5000);
    });
	
	
var position = 0;
function startPolling(){setInterval("poll()",5)}

function poll(){
  if( typeof( window.pageYOffset ) == 'number' ) {
    //Netscape compliant
    position = window.pageYOffset;
	if (position < 86){document.getElementById("rightCol").style.position="absolute";document.getElementById("rightCol").style.top="85px";}
	if (position > 85){document.getElementById("rightCol").style.position="fixed";document.getElementById("rightCol").style.top="0px";}
  } 
  else if( document.body && ( document.body.scrollLeft || document.body.scrollTop ) ) {
    //DOM compliant
    position = document.body.scrollTop;
	if (position < 86){document.getElementById("rightCol").style.position="absolute";document.getElementById("rightCol").style.top="85px";}
	if (position > 85){document.getElementById("rightCol").style.position="fixed";document.getElementById("rightCol").style.top="0px";}
  } 
  else if( navigator.appName == "Microsoft Internet Explorer") {
    //IE6 standards compliant mode
    position = document.documentElement.scrollTop;
	if (position < 86){document.getElementById("rightCol").style.position="absolute";document.getElementById("rightCol").style.top="85px";}
	if (position > 85){document.getElementById("rightCol").style.position="fixed";document.getElementById("rightCol").style.top="0px";}
  }
  return true;
}
startPolling();