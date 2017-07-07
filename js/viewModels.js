$(document).ready(function() {
	$('a.compareModel').click( function() {
		var url = this.hash;		
		url = url.replace("#",""); 
		$('th').animate({backgroundColor: "#ffffff"}, 300).parent().find('th.model' + url).animate({backgroundColor: "#fc8f4e"}, 1000);
	});
 });
