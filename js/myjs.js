function get_url_param(name)
{
    name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
    var regexS = "[\\?&]"+name+"=([^&#]*)";
    var regex = new RegExp(regexS);
    var results = regex.exec( window.location.href );
    if( results == null )    return "";
    else return results[1];
}

$(document).ready(function() {
	$(".close").click(function (){
		$("#closed").hide();
	});


    $(".superMenu li li:last").css({'borderBottom' : 'none'})
    $("ul#mainNav li.subMenu").hover(
        function() {            
            $(this).find('ul').show();
            $(this).find('a:first').css({'backgroundColor' : '#e6e6e6', 'color' : '#538815', 'fontWeight' : 'bold'})
            $(this).find('.newitem').css({'display': 'none'});
        },
        function() {
            $(this).find('ul').hide();
            $(this).find('a:first').css({'backgroundColor' : 'transparent', 'color' : '#DFDFDF' , 'fontWeight' : 'normal'})
            if($(this).hasClass('active')) {
                $(this).find('a:first').css({'fontWeight':'bold'})
            }
            $(this).find('.newitem').css({'display': 'block'});
        }
    );


    $('a.signup').click( function() {
        $.nyroModalManual({
            url: '/html/signup.html.php',
            width: null, // default Width If null, will be calculate automatically
            height: 265, // default Height If null, will be calculate automatically
            minWidth: 50, // Minimum width
            minHeight: 50 // Minimum height
        });

    });
    $('a.ask').click( function(e) {
        e.preventDefault();
        $.nyroModalManual({
            url: '/html/question.html.php',
            width: 560, // default Width If null, will be calculate automatically
            height: 440, // default Height If null, will be calculate automatically
            minWidth: 555, // Minimum width
            minHeight: 385 // Minimum height
        });

    });

    $('a.orderstatus').click( function() {
        $.nyroModalManual({
            url: '/html/orderstatus.html.php',
            width: null, // default Width If null, will be calculate automatically
            height: 245, // default Height If null, will be calculate automatically
            minWidth: 50, // Minimum width
            minHeight: 50 // Minimum height
        });

    });

});

function submitform()
{
    // Woopra send configuration change
    setTimeout("document.modelForm.submit();",500);

}

/* Copyright (c) 2006-2007 Mathias Bank (http://www.mathias-bank.de)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php) 
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 * 
 * Version 2.1
 * 
 * Thanks to 
 * Hinnerk Ruemenapf - http://hinnerk.ruemenapf.de/ for bug reporting and fixing.
 * Tom Leonard for some improvements
 * 
 */
jQuery.fn.extend({
    /**
     * Returns get parameters.
     *
     * If the desired param does not exist, null will be returned
     *
     * To get the document params:
     * @example value = $(document).getUrlParam("paramName");
     *
     * To get the params of a html-attribut (uses src attribute)
     * @example value = $('#imgLink').getUrlParam("paramName");
     */
    getUrlParam: function(strParamName){
        strParamName = escape(unescape(strParamName));
	  
        var returnVal = new Array();
        var qString = null;
	  
        if ($(this).attr("nodeName")=="#document") {
            //document-handler
		
            if (window.location.search.search(strParamName) > -1 ){
			
                qString = window.location.search.substr(1,window.location.search.length).split("&");
            }
			
        } else if ($(this).attr("src")!="undefined") {
	  	
            var strHref = $(this).attr("src")
            if ( strHref.indexOf("?") > -1 ){
                var strQueryString = strHref.substr(strHref.indexOf("?")+1);
                qString = strQueryString.split("&");
            }
        } else if ($(this).attr("href")!="undefined") {
	  	
            var strHref = $(this).attr("href")
            if ( strHref.indexOf("?") > -1 ){
                var strQueryString = strHref.substr(strHref.indexOf("?")+1);
                qString = strQueryString.split("&");
            }
        } else {
            return null;
        }
	  	
	  
        if (qString==null) return null;
	  
	  
        for (var i=0;i<qString.length; i++){
            if (escape(unescape(qString[i].split("=")[0])) == strParamName){
                returnVal.push(qString[i].split("=")[1]);
            }
			
        }
	  
	  
        if (returnVal.length==0) return null;
        else if (returnVal.length==1) return returnVal[0];
        else return returnVal;
    }
});

/* Scroll To Script */
$(document).ready(function(){
    $(".scroll").click(function(event){
        //prevent the default action for the click event
        event.preventDefault();

        //get the full url - like mysitecom/index.htm#home
        var full_url = this.href;

        //split the url by # and get the anchor target name - home in mysitecom/index.htm#home
        var parts = full_url.split("#");
        var trgt = parts[1];

        //get the top offset of the target anchor
        var target_offset = $("#"+trgt).offset();
        var target_top = target_offset.top;

        //goto that anchor by setting the body scroll top to anchor top
        $('html, body').animate({
            scrollTop:target_top
        }, 1500);
    });
});

$(document).ready(function() {
    $('.error').hide();
    $('#ask_question').submit( function(e) {
        e.preventDefault();
        $('.error').hide(500);
        var firstName = $('input#first_name').val();
        var lastName = $('input#last_name').val();
        var email = $('input#email').val();
        var phone = $('input#phone').val();
        var question = $('textarea#question').val();
        if (firstName == "") {
            $('input#first_name').focus().next().show(500);
            return false;
        }
        if (lastName == "") {
            $('input#last_name').focus().next().show(500);
            return false;
        }
        if (email == "") {
            $('input#email').focus().next().show(500);
            return false;
        }
        var dataString = "first_name=" + firstName + "&last_name=" + lastName + "&email=" + email + "&phone=" + phone + "&question=" + question + "&form_submit='ask_question'";
        $.ajax({
            type: "POST",
            url: "index.php?task=browse&view=support",
            data: dataString,
            success: function(content) {
                $.nyroModalManual({
                    content: content,
                    width: 300, // default Width If null, will be calculate automatically
                    height: null, // default Height If null, will be calculate automatically
                    minWidth: 50, // Minimum width
                    minHeight: 50 // Minimum height
                });
            }
        });
    });
});


$(document).ready(function() {
      $('.widget-container').each( function () {
      $(this).find('li:last').css({
          'background' : 'none',
          'padding-bottom':'0'
  });
});
});