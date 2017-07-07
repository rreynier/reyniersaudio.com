//Load Script
document.write('<div id="loading"><div id="centerloading"><img src="/images/loading.gif" alt="Loading"/></div></div>');
function addLoadEvent(func){
    var oldonload=window.onload;
    if(typeof window.onload!='function')
    {window.onload=func}else{window.onload=function(){if(oldonload){oldonload()}func()}}
}
addLoadEvent
    (function(){setTimeout("$('#loading').animate({'opacity':'0'},1000);",500); setTimeout("$('#loading').hide()",1000);});
//End Load Script

//Sticky Float Script//
var position = 0;
function startPolling(){setInterval("poll()",5)}
function poll(){
  if( typeof( window.pageYOffset ) == 'number' ) {
    //Netscape compliant
    position = window.pageYOffset;
	if (position < 86){$("#rightCol").css({"position":"absolute","top":"85px"});}
	if (position > 85){$("#rightCol").css({"position":"fixed","top":"0px"});}
  }
  else if( document.body && ( document.body.scrollLeft || document.body.scrollTop ) ) {
    //DOM compliant
    position = document.body.scrollTop;
	if (position < 86){$("#rightCol").css({"position":"absolute","top":"85px"});}
	if (position > 85){$("#rightCol").css({"position":"fixed","top":"0px"});}
  }
  else if( navigator.appName == "Microsoft Internet Explorer") {
    //IE6 standards compliant mode
    position = document.documentElement.scrollTop;
	if (position < 86){$("#rightCol").css({"position":"absolute","top":"85px"});}
        if (position > 85){$("#rightCol").css({"position":"fixed","top":"0px"});}
  }
  return true;
}
startPolling();
// End Sticky Float Script //

function formatCurrency(strValue)
{
    var strValue = strValue.toString().replace(/\$|\,/g,'');
    var dblValue = parseFloat(strValue);

    var blnSign = (dblValue == (dblValue = Math.abs(dblValue)));
    dblValue = Math.floor(dblValue*100+0.50000000001);
    var intCents = dblValue%100;
    var strCents = intCents.toString();
    dblValue = Math.floor(dblValue/100).toString();
    if(intCents<10)
        strCents = "0" + strCents;
    for (var i = 0; i < Math.floor((dblValue.length-(1+i))/3); i++)
        dblValue = dblValue.substring(0,dblValue.length-(4*i+3))+','+
        dblValue.substring(dblValue.length-(4*i+3));
    return (((blnSign)?'':'-') + '$' + dblValue + '.' + strCents);
}

// Sidebar update script //
function updateTotal() {	
    total = Number($('input#basePrice').attr('value'));
    discount = Number($('input#modelDiscount').attr('value'));
    $('input.selected').each( function () {
        cost = Number($(this).attr('cost'));
        total = total + cost;
    });
    total2 = total - discount;
    $("#cartTotal").empty();
    if (discount > 0) {
        /*$totalHtml = '<span class="preDiscountPrice">$' + Math.round(total) + '</span>';*/
		$totalHtml = '<span class="preDiscountPrice">$' + total + '</span>';
        /*$totalHtml = $totalHtml + '<span class="discountedBasePrice">$' + Math.round(total2) + '</span>';*/
		$totalHtml = $totalHtml + '<span class="discountedBasePrice">$' + total2 + '</span>';
    } else {
        $totalHtml = '$' + Math.round(total);
    }
    $("#cartTotal").append($totalHtml).show().animate({
        color: "#91d93c",
        marginLeft: "5px"
    } , 500).animate({
        marginLeft: "0px"
    } , 500).animate({
        color: "white"
    } , 500);
	
}

function getPartVars(item) {
    var part = new Array(8);
    part['cost'] = Number($(item).attr('cost'));
    part['upgradeCost'] = Number($(item).attr('upgradeCost'));
    part['partId'] = $(item).attr('partId');
    part['partTitle'] = $(item).attr('partTitle');
    part['subTypeId'] = $(item).attr('subTypeId');
    part['subTypeTitle'] = $(item).attr('subTypeTitle');
    part['subTypeShortTitle'] = $(item).attr('subTypeShortTitle');
    part['partTypeTitle'] = $(item).attr('partTypeTitle');
    part['partTypeId'] = $(item).attr('partTypeId');
    part['partTypeOrder'] = $(item).attr('partTypeOrder');
    return part;
}


var fxarray = new Array(2);
fxarray[0] = {
    opacity: 'hide',
    duration: 100
};
fxarray[1] = {
    opacity: 'show',
    duration: 200
};


$(document).ready(function() {
    var basePrice = $('#base-price').attr('baseprice');
    var total = 0;
    var cost = 0;
    var upgradeCost = 0;
    var partId;
    var partTitle = "";
    var subTypeId;
    var subTypeTitle = "";
    var partTypeId = "";
    var partTypeTitle = "";
    var xPartId;
    var xSubTypeId;
    var part = new Array(8);
    var partTypeIds = new Array();
    var subTypeIds = new Array();
    total = Number($('input#basePrice').attr('value'));
	
	
    $('input.selected').each( function () {

        part = getPartVars(this);
		
        // Add part to right bar
        $("#cartComputer ul.partType" + part['partTypeId'] + " li.subType" + part['subTypeId'] + ' ul').append(
            '<li class="part part' + part['partId'] + '"><span class="title">' + part['subTypeShortTitle'] + '</span><span class="desc">' + part['partTitle'] + '</span>' +
            '<input type="hidden" name="option' + part['partTypeOrder'] + '.' + part['subTypeId'] + part['partId'] + '|' +
            part['subTypeTitle'] + '" value="' + part['partTitle'] + '|' + part['upgradeCost'] + '" />' +
            '</li>'
            );
    });

    updateTotal();

    // Update right bar when a radio button is clicked.
    $('input:radio').click(function(){
		
        // Get variables from radio input that was clicked        
        part = getPartVars(this);
        // Woopra send configuration change
            //woopraTracker.addVisitorProperty("Configuration Change", "Yes");
            //woopraTracker.track("/partchange/"+part['partTitle'],"Part Change: "+ part['partTitle']+" [$"+part['upgradeCost']+"]");
        // To see which item was previously selected
        $('input:radio.selected').each( function () {
            var tempSubTypeId  = $(this).attr('subTypeId');            
            if (tempSubTypeId == part['subTypeId']) {
                xSubTypeId = $(this).attr('subTypeId');
                xPartId = $(this).attr('partId');
                xPartTypeId = $(this).attr('partTypeId');
                // Remove "selected" class from previously selected item.				
                $(this).removeClass('selected').parent().parent().removeClass('selectedPart');						
            }
        });

        // Add "selected" class to currently selected item for future clicks
        $(this).addClass("selected").parent().parent().addClass('selectedPart');

        // Update right bar by removing previously checked item and adding new item.
		
        $('#cartComputer ul.partType' + xPartTypeId + ' li.subType' + xSubTypeId + ' ul li.part' + xPartId).remove();
        $('#cartComputer ul.partType' + part['partTypeId'] + ' li.subType' + part['subTypeId'] + ' ul').append(
            '<li class="part part' + part['partId'] + '"><span class="title">' + part['subTypeShortTitle'] + '</span><span class="desc">' + part['partTitle'] + '</span>' +
            '<input type="hidden" name="option' + part['partTypeOrder'] + '.' + part['subTypeId'] + part['partId'] + '|' + part['subTypeTitle'] + '" value="' + part['partTitle'] + '|' + part['upgradeCost'] + '" />' +
            '</li>'
            ).find('span.desc').animate({
            color: "#91d93c",
            marginLeft: "5px"
        } , 500).animate({
            marginLeft: "0px"
        } , 500).animate({
            color: "#9a9a9a"
        } , 500);
		
        // Update Total
        updateTotal();

    });
	
    // Update right bar when a check box is clicked.
    $('input:checkbox').click(function(){
        part = getPartVars(this);
        // Woopra send configuration change
            //woopraTracker.addVisitorProperty("Configuration Change", "Yes");
            //woopraTracker.track("/partchange/"+part['partTitle'],"Part Change: "+ part['partTitle']+" [$"+part['upgradeCost']+"]");
        // Remove from side bar if the checkbox was selected before the mouse click
        if ($(this).is('.selected') == true) {
            if($(this).attr('default') == 1) { 
                basePrice = basePrice - part['cost'];
                $('#base-price').val('Default Parts|' + basePrice);
            }
            $('#cartComputer ul.partType' + part['partTypeId'] + ' li.subType' + part['subTypeId'] + ' ul li.part' + part['partId']).remove();
            $(this).removeClass('selected').parent().parent().removeClass('selectedPart');
        }
        // Add to side bar if the checkbox was not selected before mouse click
        else {
            if($(this).attr('default') == 1) {
                basePrice = basePrice + part['cost'];  
                $('#base-price').val('Default Parts|' + basePrice);
                $('#cartComputer ul.partType' + part['partTypeId'] + ' li.subType' + part['subTypeId'] + ' ul').append(
                    '<li class="part part' + part['partId'] + '"><span class="title">' + part['subTypeShortTitle'] + '</span><span class="desc">' + part['partTitle'] + '</span>' + '</li>'
                    ).find('span').animate({
                    color: "#91d93c",
                    marginLeft: "5px"
                } , 500).animate({
                    marginLeft: "0px"
                } , 500).animate({
                    color: "#9a9a9a"
                } , 500);
                $(this).addClass('selected').parent().parent().addClass('selectedPart');
            } else {
                $('#cartComputer ul.partType' + part['partTypeId'] + ' li.subType' + part['subTypeId'] + ' ul').append(
                    '<li class="part part' + part['partId'] + '"><span class="title">' + part['subTypeShortTitle'] + '</span><span class="desc">' + part['partTitle'] + '</span>' +
                    '<input type="hidden" name="option' + part['partTypeOrder'] + '.' + part['subTypeId'] + part['partId'] + '|' + part['subTypeTitle'] + '" value="' + part['partTitle'] + '|' + part['cost'] + '" />' +
                    '</li>'
                    ).find('span').animate({
                    color: "#91d93c",
                    marginLeft: "5px"
                } , 500).animate({
                    marginLeft: "0px"
                } , 500).animate({
                    color: "#9a9a9a"
                } , 500);
                $(this).addClass('selected').parent().parent().addClass('selectedPart');
            }
        }
		
        updateTotal();
		
		
    });
    $.nyroModalSettings({
        width: 800        
    });
});