<script type="text/javascript">
    $(document).ready(function() {
        $('.error').hide();
        $('#signupSubmit').click( function(e) {
            $('.error').hide(500);
            e.preventDefault();
            var firstName = $('input#first_name').val();
            var lastName = $('input#last_name').val();
            var email = $('input#email').val();
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
            var dataString = "first_name=" + firstName + "&last_name=" + lastName + "&email=" + email;
            $.ajax({
                type: "POST",
                url: "/ajax/submitSignup.php",
                data: dataString,
                success: function() {
                    $.nyroModalManual({
                        content: '<link rel="stylesheet" type="text/css" href="/css/about.css" /><div id="popupHeader"><h1>Newsletter Signup</h1></div><span class="popup"><p>Your email address has been added to the newsletter list.</p><p>Thank You</p></span>',
                        width: 300, // default Width If null, will be calculate automatically
                        height: null, // default Height If null, will be calculate automatically
                        minWidth: 50, // Minimum width
                        minHeight: 150 // Minimum height
                    });
                }
            });
        });
    });
</script>
<div id="popupHeader">
    <h1>Sign up to our newsletter.</h1>
</div>
<div id="signup">
    <form name="signup" method="post" action="/ajax/submitSignup.php"  id="signup">
        <h3>Get site updates, audio tips, etc.</h3>
        <ul>
            
            <li>
                <label for="first_name">First Name:</label><br>
                <input type="text" name="first_name" id="first_name" />
                <div class="error">Please enter your first name.</div>
            </li>
            <li>
                <label for="last_name">Last Name:</label><br>
                <input type="text" name="last_name" id="last_name" />
                <div class="error">Please enter your last name.</div>
            </li>
            <li>
                <label for="email">Email Address:</label><br>
                <input type="text" name="email" id="email" />
                <div class="error">Please enter a valid email address.</div>
            </li>
            <li>
                <input type="submit" value="submit" id="signupSubmit"/>
            </li>
        </ul>
    </form>
</div>