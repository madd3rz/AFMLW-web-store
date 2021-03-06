<?php

require('inc/config.php');
session_start();

?>
<html>

<head>
    <title>AFLMW Register Page</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/loginSignUp.css">
</head>

<body>
<main>
    <div class="reg-main">
        <div class="banner">
            <img src="assets/images/logo.png" alt="logo">
        </div>

        <form class="reg-form" name="register" method="POST" action="register-submit.php" onsubmit="validform()">

            <h2>Sign Up Now!</h2>
            <input type="text" placeholder="John Doe" name="name">
            <input type="email" placeholder="johndoe@test.com" name="email" value="">
            <input type="password" placeholder="Password" name="password" value="">
            <input type="password" placeholder="Confirm Password" name="cpassword" value="">
            <input type="text" placeholder="019-23121312" name="phoneNumber">
            <p>By clicking Sign Up below, you hereby agreed to<span><br></span>our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></p>

            <button class="signup-btn">Sign Up</button>

        </form>
    </div>
</main>
<?php require('inc/navBar.php'); ?>
</body>

<script>
    function validform() {
        var uname = document.register.name;
        var email = document.register.email;
        var mobnum = document.register.phoneNumber;
        var passw = document.register.password;
        var cfmpassw = document.register.cpassword;


        if (checkuname(uname))
        {
            if (checkemail(email))
            {
                if (checkmobnum(mobnum))
                {
                    if (checkpassw(passw))
                    {
                        if (checkcfmpassw(cfmpassw, passw))
                        {
                            return true;
                        }

                    }
                }
            }

        }
        event.preventDefault();
        return false;
    }



    function checkuname(uname) {
        var letter = /^[A-Za-z]+|\s+$/;
        if (uname.value == null || uname.value === "") {
            alert("Please Enter Your Username!!");
            return false;
        }
        if (uname.value.match(letter)) {
            return true;
        } else {
            alert("Username MUST Be Entered Using Alphabets ONLY");
            return false;
        }
    }

    function checkemail(email) {
        var emailfor = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (email.value === "") {
            alert("Please fill in your email");
            return false;
        }
        if (email.value.match(emailfor)) {
            return true;
        }
        else {
            alert("Invalid email format, please check again");
            return false;
        }
    }

    function checkmobnum(mobnum) {
        var number = /[0-9]/g;
        if (mobnum.value.match(number)) {
            return true;
        } else {
            alert("The Mobile Number Must Be In Number ONLY!!");
            return false;
        }
    }

    function checkpassw(passw) {
        var passw_extent = passw.value.extent;
        var up_case = /[A-Z]/g;
        var low_case = /[a-z]/g;
        var number = /[0-9]/g;
        var spe_char = /[';-=!@%^()+$,<>#:?[`_*&;{}|"~`/\].]/g;

        if (passw.value === "") {
            alert("Invalid Password, Please Enter Your Password Again")
            return false;
        } else {
            if (passw.value.match(up_case)) {
                if (passw.value.match(low_case)) {
                    if (passw.value.match(number)) {
                        if (passw.value.match(spe_char)) {
                            if (passw_extent !== 6) {
                                alert("The Password Must Only Contain 6 Digits");
                                passw_extent.focus();
                                return false;
                            }
                            return true;
                        } else {
                            alert("The Password Must Have At Least 1 Special Character");
                            return false;
                        }
                    } else {
                        alert("The Password Must Have At Least 1 Number");
                        return false;
                    }
                } else {
                    alert("The Password Must Have At Least 1 lowercase Letter");
                    return false;
                }
            } else {
                alert("The Password Must Have At Least 1 Uppercase Letter");
                return false;
            }
        }
    }

    function checkcfmpassw(cfmpassw, passw) {
        if (cfmpassw.value === "") {
            alert("Please fill in your confirm password");
            return false;
        }
        else if (cfmpassw.value === passw.value) {
            return true;
        }
        else {
            alert("The password does not match, please enter your password again");
            return false;
        }
    }
</script>

</html>