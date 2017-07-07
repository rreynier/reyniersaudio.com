(function($) { 
    $.fn.makeFAQ = function(options) {
        var defaults = {
            indexTitle: "Index",    // Change to whatever you want to be displayed
            faqHeader: ":header",   // default grabs any header element - h1,h2, etc...
            displayIndex: true      // Display Index
        };
        var options = $.extend(defaults, options);

        return this.each(function() {
            var $obj = $(this);

            $obj.wrap("<div id='faqRoot'></div>");
            
            if(options.displayIndex) {
                $obj.before("<div id='faqindex'><h2>" + options.indexTitle + "</h2><ul></ul></div>");
            };

            var $faqEntries = $obj.children(options.faqHeader);
			var i = 0;
            $faqEntries.each(function () {
                var $entry = $(this);

                var entryName = $entry.text();
                // strip whitespaces and special characters
                var entryNameSafe = entryName.replace(/\W/g,"") + i;
				// Increment counter
                i++;

                // build index line for entry
                var itemHTML = "<li><a id='" + entryNameSafe.toString() + "Index' href='#" + entryNameSafe.toString() + "' >" + entryName + "</a></li>";
                // append the index line to the index
                $('#faqindex ul').append(itemHTML);

                // add click event for index entry
                if(options.displayIndex) {
                    $('#' + entryNameSafe.toString() + 'Index').click( function(){ 
                        // slide down the selected index before jumping to the bookmark    
                        $('#' + entryNameSafe.toString()).next('span').slideDown('fast');
                        // make sure it gets the faqopened class
                        $('#' + entryNameSafe.toString()).addClass('faqopened');
                     });
                };

                // add class to faq entry content
                $entry.next("div").addClass('faqcontent');

                // add title, name and id to entry
                $entry.attr({
                    title: "Click to expand/collapse",
                    name: entryNameSafe,
                    id: entryNameSafe                    
                    })
                    // add class
                    .addClass("faqclosed")
                    
                    // Add click event to entry
                    .click( function() {
                        $entry.next('div').slideToggle('fast');
                        $entry.toggleClass('faqopened');
                        })
                        // Collapse the span tag of the entry
                        .next('div').css({ 
                            display: "none"
                        });
            }); // end enumeration of each faq entry

        }); // end this each
    }; // end function
})(jQuery);