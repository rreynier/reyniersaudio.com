<script type="text/javascript">
    
        $('.error').hide();
        $('#askQuestionSubmit').click( function(e) {
            $('.error').hide(500);
            e.preventDefault();
            var firstName = $('input#first_name').val();
            var lastName = $('input#last_name').val();
            var email = $('input#email').val();
            var phone = $('input#phone').val();
            var question = $('textarea#question').val();
            if (firstName == "") {
                $('input#first_name').focus().next().show(500);
                return false;
            }
            if (email == "") {
                $('input#email').focus().next().show(500);
                return false;
            }
            var dataString = "first_name=" + firstName + "&last_name=" + lastName + "&email=" + email + "&phone=" + phone + "&question=" + question;
            $.ajax({
                type: "POST",
                url: "/ajax/submitQuestion.php",
                data: dataString,
                success: function() {
                    $.nyroModalManual({
                        content: '<div id="popupHeader"><h1>Ask Reyniers Audio</h1></div><span class="popup"><p>Your question has been submitted. We will contact you within 24 hours.</p><p>Thank you.</p></span>',
                        width: 400, // default Width If null, will be calculate automatically
                        height: null, // default Height If null, will be calculate automatically
                        minWidth: 50, // Minimum width
                        minHeight: 150 // Minimum height
                    });
                }
            });
        });
   
</script>
<div id="popupHeader">
    <h1>Ask Reyniers Audio a question</h1>
</div>
<div id="submitquestion">
    <form name="ask_question" id="ask_question" action="/ajax/submitQuestion.php" method="post">
        <ul>
        <li>
            <label for="first_name">First Name (required)</label>
            <input type="text" name="first_name" id="first_name" />
            <div class="error">Please enter a First Name</div>
        </li>
        <li>
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" />
            <div class="error">Please enter a First Name</div>
        </li>
        <li class="clrFlt">
            <label for="email">Email Address (required)</label>
            <input type="text" name="email" id="email" />
            <div class="error">Please enter a valid email address</div>
        </li>
        <li>
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" id="phone" />
        </li>
        <li class="clrFlt">
            <label for="question">Your Question (required)</label>
            <textarea name="question" cols="75" rows="10" id="question" ></textarea>
            <div class="error">Please enter a question</div>
        </li>
        <li id="askQuestionSubmit">
            <input type="submit" name="submit" id="submit" value="Submit Question" />
            <input type="hidden" name="form_submit" value="ask_question" class="hidden" />
        </li>
        </ul>
    </form>


    </div>
