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

    $.validator.addMethod("hasDepth", function (value, element) {
        if (!$('#inp_depth').val()) {
            $('#inp_depth_msg').html('Please select Depth')
            $(".select2-selection.select2-selection--single ").css("border",
                "1px solid #ff0000");
            return false;
        } else {
            $('#inp_depth_msg').html(' ')
            $(".select2-selection.select2-selection--single ").css("border",
                "1px solid #ced4da");
            return true;
        }
    });
    $.validator.addMethod("hasProduction", function (value, element) {
        if (!$('#inp_production').val()) {
            $('#inp_production_msg').html('Please select Production')
            $(".select2-selection.select2-selection--single ").css("border",
                "1px solid #ff0000");
            return false;
        } else {
            $('#inp_production_msg').html(' ')
            $(".select2-selection.select2-selection--single ").css("border",
                "1px solid #ced4da");
            return true;
        }
    });
    $.validator.addMethod("checkPolicies", function (value, element) {
        if (($('#inlineCheckbox1').is(":checked")) || ($('#inlineCheckbox2').is(":checked")))  {
            $("#warningMsg").html("");
            return true;
        } else {
            $("#warningMsg").html("Please select who are you")
            return false;
        }
    });

    $(function () {
        $("#owners-form").validate({
            rules: {
                status1: {
                    checkPolicies:true,
                },
                status: {
                    checkPolicies:true,
                },
                first_name: {
                    required: true,
                    specialChar: true
                },
                last_name: {
                    required: true,
                    specialChar: true
                },
                email: {
                    required: true,
                    emailValid: true
                },
                city: {
                    required: true,
                    specialChar: true
                },
                state: {
                    required: true,
                    specialChar: true
                },
                wells_num: {
                    required: true,
                    min: 1
                },
                depth: {
                    hasDepth: true,
                },
                production: {
                    hasProduction: true,
                },
                avg_bopd: {
                    required: true,
                },
                avg_tot_bopd: {
                    required: true,
                }
            },
            messages: {
                status: {
                    checkPolicies: " ",
                },
                status1: {
                    checkPolicies: " ",
                },
                first_name: {
                    required: "Please enter your first name",
                    specialChar: "Please only user letters here."
                },
                last_name: {
                    required: "Please enter your last name",
                    specialChar: "Please only user letters here."
                },
                email: {
                    required: "Please enter email",
                    emailValid: "Please enter valid email address"
                },
                city: {
                    required: "Please enter city",
                    specialChar: "Not allow special characters."
                },
                state: {
                    required: "Please enter state",
                    specialChar: "Not allow special characters."
                },
                wells_num: {
                    required: "Please enter number of wells",
                    min: "Please enter a value greater than or equal to 1."
                },
                depth: {
                    hasDepth: " "
                },
                production: {
                    hasProduction: " "
                },
                avg_bopd: {
                    required: "Please enter  average BOPD"
                },
                avg_tot_bopd: {
                    required: "Please enter average total BFPD"
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });

</script>
