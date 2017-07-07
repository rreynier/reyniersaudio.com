<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="/tinymce/tiny_mce.js"></script>
<script type="text/javascript">

    // HTML to Entities (form) script- By JavaScriptKit.com (http://www.javascriptkit.com)
    // For this and over 400+ free scripts, visit JavaScript Kit- http://www.javascriptkit.com/
    // This notice must stay intact for use

    function html2entities(){
        var re=/['’°]/g
        for (i=0; i<arguments.length; i++)
            arguments[i].value=arguments[i].value.replace(re, function(m){return replacechar(m)})
    }

    function replacechar(match){
        if (match=="'")
            return "&#039;"
        else if (match=="’")
            return "&#039;"
        else if (match=="°")
            return "&deg;"
    }
</script>
<script type="text/javascript">
    tinyMCE.init({
        mode : "textareas",
        theme : "advanced",
        plugins : "style,table,inlinepopups,searchreplace,contextmenu,paste,tabfocus,codemagic, template",
        theme_advanced_buttons1 : "fullscreen,bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontsizeselect|,bullist,numlist,|,outdent,indent,|,charmap,styleprops,|",
        theme_advanced_buttons2 : "pastetext,|,undo,redo,|,link,cleanup,code,|,replace,tablecontrols,|,removeformat,visualaid,|,codemagic",
        theme_advanced_buttons3 : "",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing_use_cookie : false,
        theme_advanced_resizing : true,
        paste_postprocess : function(pl, o) {
            // remove extra line breaks
            o.node.innerHTML = o.node.innerHTML.replace(/<p.*>\s*(<br>|&nbsp;)\s*<\/p>/ig, "");
        },
        //content_css : "/css/info.css,/css/master.css,/css/cartSideBar.css,/css/nyroModal.css,/css/table.css,css/model.css",//
        content_css : "/css/info.css,/css/master.css,/css/cartSideBar.css,/css/nyroModal.css,/css/table.css,css/model.css",
        paste_strip_class_attributes : "all",
        apply_source_formatting : true,
        body_class : "info",
        tab_focus : ':prev,:next',
        valid_elements : "thead,ul,li,table[width=615px],i,th,tr,td,class,h1,h2,h3,h4,h5,h6,strong/b,br,p,colspan,th[colspan],td[colspan|class]",
        /*verify_css_classes : true,*/
        visual: false
    });
</script>
<textarea rows="1" cols="1" style="width:700px; height:800px;"></textarea>