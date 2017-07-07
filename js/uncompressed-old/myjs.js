$(document).ready(function() {
    
    // Top Menu //
    $("ul#mainNav li.subMenu").hover(
        function() {
            $("ul:first" , this).stop().fadeTo(300, 1).show().parent().css({
                "background-image" : "url(images/topNav_bg_hover.gif)",
                "background-repeat" : "repeat-x"
            });
        
        },
        function() {
            $("ul:first" , this).stop().fadeTo(300,0).hide().parent().css({
                "background-image" : "none",
                "background-repeat" : "repeat-x"
            });
        }
        );
    // End Menu //

    // Signup to newsletter / Ask Question Popup //
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
    // End Sugnup / Ask Popup //

    // Ask Question //
    $('.error').hide();
    $('#ask_question').submit( function(e) {
        e.preventDefault();
        $('.error').hide(500);
        var firstName = $('input#first_name').val();
        var lastName = $('input#last_name').val();
        var email = $('input#email').val();
        var phone = $('input#phone').val();
        var question = $('textarea#question').val();
        if (firstName === "") {
            $('input#first_name').focus().next().show(500);
            return false;
        }
        if (lastName === "") {
            $('input#last_name').focus().next().show(500);
            return false;
        }
        if (email === "") {
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
    // End ask question//

    // Order Status Popup //
    $('a.orderstatus').click( function() {
        $.nyroModalManual({
            url: '/html/orderstatus.html.php',
            width: null, // default Width If null, will be calculate automatically
            height: 245, // default Height If null, will be calculate automatically
            minWidth: 50, // Minimum width
            minHeight: 50 // Minimum height
        });

    });
    //


    // Woopra Code that adds Cart Information //
    function submitform()
    {
        // Woopra send configuration change
        woopraTracker.addVisitorProperty("Cart Visit", "Yes");
        woopraTracker.track("/cart"+ window.location.pathname, "Add to Cart: "+ $totalHtml);
    }
    // End Woopra Code //

//    // Get URL Paramaters //
//     function get_url_param(name)
//    {
//        name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
//        var regexS = "[\\?&]"+name+"=([^&#]*)";
//        var regex = new RegExp( regexS );
//        var results = regex.exec( window.location.href );
//        if( results == null )    return "";
//        else return results[1];
//    }
//    jQuery.fn.extend({
//        getUrlParam: function(strParamName){
//            strParamName = escape(unescape(strParamName));
//            var returnVal = new Array();
//            var qString = null;
//            if ($(this).attr("nodeName")=="#document") {
//                //document-handler
//                if (window.location.search.search(strParamName) > -1 ){
//                    qString = window.location.search.substr(1,window.location.search.length).split("&");
//                }
//            } else if ($(this).attr("src")!="undefined") {
//                var strHref = $(this).attr("src");
//                if ( strHref.indexOf("?") > -1 ){
//                    var strQueryString = strHref.substr(strHref.indexOf("?")+1);
//                    qString = strQueryString.split("&");
//                }
//            } else if ($(this).attr("href")!="undefined") {
//                var strHref = $(this).attr("href")
//                if ( strHref.indexOf("?") > -1 ){
//                    var strQueryString = strHref.substr(strHref.indexOf("?")+1);
//                    qString = strQueryString.split("&");
//                }
//            } else {
//                return null;
//            }
//            if (qString==null) return null;
//            for (var i=0;i<qString.length; i++){
//                if (escape(unescape(qString[i].split("=")[0])) == strParamName){
//                    returnVal.push(qString[i].split("=")[1]);
//                }
//            }
//            if (returnVal.length==0) return null;
//            else if (returnVal.length==1) return returnVal[0];
//            else return returnVal;
//        }
//    });
//    // End URL Params //

    //Scroll To Script //

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
    // End Scroll To Script //



    // Compare Model //
    $('a.compareModel').click( function() {
        var url = this.hash;
        url = url.replace("#","");
        $('th').animate({
            backgroundColor: "#b2b2b2"
        }, 300).parent().find('th.model' + url).animate({
            backgroundColor: "#fc8f4e"
        }, 1000);
    });
    // End Compare Model //
});