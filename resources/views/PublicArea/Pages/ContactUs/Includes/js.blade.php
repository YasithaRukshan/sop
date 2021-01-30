<script>
    $(document).ready(function () {
        $('.select-single-depth').select2({
            placeholder: "Select a depth",
            allowClear: true
        });
        $('.select-single-production').select2({
            placeholder: "Select a last active production",
            allowClear: true
        });
    });

    function onSubmit(token) {
        $("#contactUsForm").submit();
    }
    $.validator.addMethod("phoneValid", function (value, element) {
        var patt = /^\d{10}$/;
        return patt.test(value);
    });

    $(function () {
        $("#contactUsForm").validate({
            rules: {
                name: {
                    required: true,
                    specialChar: true
                },
                email: {
                    required: true,
                    emailValid: true
                },
                phone_number: {
                    required: true,
                    phoneValid: true
                },
                subject: {
                    required: true,
                },
                message: {
                    required: true,
                }
            },
            messages: {
                email: {
                    required: "Please  provide a email",
                    emailValid: "Please enter valid email",
                },
                name: {
                    required: "Please enter your name",
                    specialChar: "Please only user letters here."
                },
                phone_number: {
                    required: "Please enter phone number",
                    phoneValid: "Please enter valid phone number"
                },
                subject: {
                    required: "Please enter subject"
                },
                message: {
                    required: "Please enter message"
                },
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });

</script>
