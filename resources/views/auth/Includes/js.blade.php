<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    $(window).scroll(function () {
        if ($(window).scrollTop() >= 40) {
            $(".main-header").addClass("lightnewHeader");
            // $(".mbnScrolled .menu-area .mobile-nav-toggler .icon-bar").addClass("colornewdark");
            $(".mbnScrolled .menu-area .mobile-nav-toggler .icon-bar").css("color", "yellow  !important");
            $(".lightnewHeader .icon-bar").css('background', '#1d165c  !important');
        } else {
            $(".main-header").removeClass("lightnewHeader");
            $(".mbnScrolled .menu-area .mobile-nav-toggler .icon-bar").removeClass("colornewdark");
        }
    });

    $(document).ready(function () {
        $("#nav_logo").attr("src", "{{asset('PublicArea/images/logo.png')}}");
        if ($(window).scrollTop() >= 40) {
            $(".main-header").addClass("lightnewHeader");
            // $(".mbnScrolled .menu-area .mobile-nav-toggler .icon-bar").addClass("colornewdark");
            $(".lightnewHeader .icon-bar").css('background', '#1d165c  !important');
        } else {
            $(".main-header").removeClass("lightnewHeader");
            $(".mbnScrolled .menu-area .mobile-nav-toggler .icon-bar").removeClass("colornewdark");
        }
    });

    function onSubmit(token) {
        $("#register-form").submit();
    }

    $.validator.addMethod("containSpecialChars", function (value, element) {
        var patt = /[!@#$%^&*(),.?":{}|<>]/;
        return patt.test(value);
    });
    $.validator.addMethod("uppercaseChars", function (value, element) {
        var patt = /[A-Z]{1}/;
        return patt.test(value);
    });
    $.validator.addMethod("lowercaseChars", function (value, element) {
        var patt = /[a-z]{1}/;
        return patt.test(value);
    });
    $.validator.addMethod("numbercase", function (value, element) {
        var patt = /[0-9]{1}/;
        return patt.test(value);
    });
    $.validator.addMethod("emailValid", function (value, element) {
        var patt = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,10}\b$/i;
        return patt.test(value);
    });
    $.validator.addMethod("specialChar", function (value, element) {
        var patt = /^[A-Za-z0-9 ]+$/;
        return patt.test(value);
    });
    $.validator.addMethod("specialCharWithoutSpace", function (value, element) {
        var patt = /^[A-Za-z0-9]+$/;
        return patt.test(value);
    });
    $.validator.addMethod("earlyemail", function (value, element) {
        var email = document.getElementById('email').value;
        var isSuccess = true;

        $.ajax({
            url: "{{ route('customer.email') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                email: email
            },
            async: false,
            success: function (response) {
                isSuccess = response === "true" ? true : false
            }
        });
        return isSuccess;
    });
    $.validator.addMethod("earlyusername", function (value, element) {
        var username = document.getElementById('username').value;
        var isSuccess = true;

        $.ajax({
            url: "{{ route('customer.username') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                username: username
            },
            async: false,
            success: function (response) {
                isSuccess = response === "true" ? true : false
            }
        });
        return isSuccess;
    });

    // $.validator.addMethod("superuserCode", function (value, element) {
    //     var code = "{{ config('register.super_code')}}";
    //     return code == document.getElementById('superuser_code').value;
    // });

    $.validator.addMethod("checkPolicies", function (value, element) {
        if ($('#agreePolicy').is(":checked")) {
            $("#policyMsg").html("");
            return true;
        } else {
            $("#policyMsg").html("Please agree with TOS and Privacy Policies")
            return false;
        }
    });

    $.validator.addMethod("checkRef", function (value, element) {
        if ($('#inpRef').is(":checked")) {
            $("#refMsg").html("");
            return true;
        } else {
            $("#refMsg").html("Please Confirm Your Invitation")
            return false;
        }
    });

    $(function () {
        $("#register-form").validate({
            rules: {
                first_name: {
                    required: true,
                    specialChar: true
                },
                last_name: {
                    required: true,
                    specialChar: true
                },
                username: {
                    required: true,
                    specialCharWithoutSpace: true,
                    earlyusername: true
                },
                email: {
                    required: true,
                    emailValid: true,
                    earlyemail: true
                },
                password: {
                    required: true,
                    minlength: 8,
                    // containSpecialChars: true,
                    uppercaseChars: true,
                    lowercaseChars: true,
                    numbercase: true,
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password"
                },
                // superuser_code: {
                //     required: true,
                //     superuserCode: true,
                // },
                agreePolicy: {
                    checkPolicies: true
                },
                inpRef:{
                    checkRef: true
                }
            },
            messages: {
                first_name: {
                    required: "Please enter your first name",
                    specialChar: "Please only user letters here."
                },
                last_name: {
                    required: "Please enter your last name",
                    specialChar: "Please only user letters here."
                },
                username: {
                    required: "Please enter your username",
                    specialCharWithoutSpace: "Please only user letters here.",
                    earlyusername: "This username is already existing."
                },
                email: {
                    required: "Please enter email",
                    emailValid: "Please enter valid email",
                    earlyemail: "This email is already existing."
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must included at least 8 characters long",
                    // containSpecialChars: "Your password must included at least a special character",
                    uppercaseChars: "Your password must included at least a uppercase letter",
                    lowercaseChars: "Your password must included at least a lowercase letter",
                    numbercase: "Your password must included at least a number",
                },
                password_confirmation: {
                    required: "Please provide a confirmation password",
                    equalTo: "The password confirmation does not match."
                },
                // superuser_code: {
                //     required: "Please provide a superuser code",
                //     superuserCode: "Invalide superuser code."
                // },
                inpRef:{
                    checkRef: ""
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });

    $(function () {
        $("#reset-form").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 8,
                    containSpecialChars: true,
                    uppercaseChars: true,
                    lowercaseChars: true,
                    numbercase: true,
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must included at least 8 characters long",
                    containSpecialChars: "Your password must included at least a special character",
                    uppercaseChars: "Your password must included at least a uppercase letter",
                    lowercaseChars: "Your password must included at least a lowercase letter",
                    numbercase: "Your password must included at least a number",
                },
                password_confirmation: {
                    required: "Please provide a confirmation password",
                    equalTo: "The password confirmation does not match."
                },
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });


    $(function () {
        $("#login-form").validate({
            rules: {
                email: {
                    required: true,
                    emailValid: true,
                },
                password: {
                    required: true,
                }
            },
            messages: {
                email: {
                    required: "Please  provide a email",
                    emailValid: "Please enter valid email",
                },
                password: {
                    required: "Please provide a password",
                },
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });

    function showPassword() {
        var type = $('#password').attr('type')
        if (type == 'password') {
            $('#password').attr('type', 'text');
            $('#password_confirmation').attr('type', 'text');
            $('#eye').removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            $('#password').attr('type', 'password');
            $('#password_confirmation').attr('type', 'password');
            $('#eye').removeClass("fa-eye-slash").addClass("fa-eye");
        }
    }

</script>
