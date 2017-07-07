 $(document).ready(function() {
    $('.ajax-save-button').click( function(e){
        e.preventDefault();
        var part_id = $(this).attr('partid');
        var field_name = $(this).attr('fieldname');
        var value = $(this).parent().find('.ajaxInput.' + field_name).val();
        var current_location = this;

        var data = 'part_id=' + part_id + '&' + field_name + '=' +  value;        

        $.ajax({
            type: 'POST',
            url: '/tasks/admin/item/part/ajaxSave.php',
            data: data,
            success: function(result) {     
                if(result != 1) {
                    $(current_location).parent().find('.ajaxInput.' + field_name).animate({ backgroundColor: "#f68429"}, 1000);
                } else {
                    $(current_location).parent().find('.ajaxInput.' + field_name).animate({ backgroundColor: "#91d93c" }, 1000);
                }
            },
            error: function(error) {
                alert(error)
                $(current_location).parent().find('.ajaxInput.' + field_name).animate({ backgroundColor: "#e6121e"}, 1000);

            }

        })

    })

 });