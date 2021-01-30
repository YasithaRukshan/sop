<script>
    var viewmsgcount = 10;
    $(document).ready(function () {
        $('#cardStateForBilling').select2({
            placeholder: "Select State",
            allowClear: true
        });

        $('#cardCountryForBilling').select2({
            placeholder: "Select Country",
            allowClear: true
        });
        getStatusForBilling("{{ Auth::user()->billingAddress?Auth::user()->billingAddress->state:'' }}");
        
    });

    $('#passGen').on('click', function () {
        var pass = Math.random().toString(36).slice(-8);
        $('#new_pass').attr('type', 'text');
        $('#confirm_pass').attr('type', 'text');
        $('#new_pass').val(pass);
        $('#confirm_pass').val(pass);
        validatepasswordconf();
    })

    $("#new_pass").keyup(function () {
        validatepasswordconf()
    });
    $("#confirm_pass").keyup(function () {
        validatepasswordconf()
    });

    function validatepasswordconf() {
        if ($('#new_pass').val() == $('#confirm_pass').val() && $('#new_pass').val() != '' && $('#confirm_pass')
            .val() != '') {
            $('#conf_pass_msg').addClass('text-success').removeClass('text-danger').html(
                '<i class="fa fa-check"></i>');
            $("#sumbit-btn-pass").prop("disabled", false);

        } else if ($('#new_pass').val() == '' && $('#confirm_pass').val() == '' || ($('#confirm_pass').val() == '' && $(
                '#new_pass').val() == '')) {
            $('#conf_pass_msg').addClass('text-danger').removeClass('text-success').html(
                '');
            $("#sumbit-btn-pass").prop("disabled", true);
        } else {
            $('#conf_pass_msg').addClass('text-danger').removeClass('text-success').html(
                'The password and confirmation' +
                ' password do not match');
            $("#sumbit-btn-pass").prop("disabled", true);
        }
    }

    function getcountrycode() {
        var country_code = $('#country').val();
        return country_code;
    }

    function showPassword() {
        var type = $('#new_pass').attr('type')
        if (type == 'password') {
            $('#new_pass').attr('type', 'text');
            $('#confirm_pass').attr('type', 'text');
            $('#eye').removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            $('#new_pass').attr('type', 'password');
            $('#confirm_pass').attr('type', 'password');
            $('#eye').removeClass("fa-eye-slash").addClass("fa-eye");
        }
    }

    function getStatusForBilling(def = "", status) {
        var country = $('#cardCountryForBilling').val();
        $.ajax({
            url: "{{ route('get-states') }}?country=" + country,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            success: function (response) {
                var html = "";
                $.each(response, function (key, state) {
                    html += "<option " + (def == key ? 'selected' : '') + " value='" + key + "'>" +
                        state + "</option>";
                });

                $('#cardStateForBilling').html(html);
                $('#cardStateForBilling').select2({
                    placeholder: "Select State"
                });

            }
        });
    }


    function getStatesEdit(def = "") {
        var country = $('#inp_country_edit').val();
        $.ajax({
            url: "{{ route('get-states') }}?country=" + country,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            success: function (response) {
                var html = "";
                $.each(response, function (key, state) {
                    html += "<option " + (def == key ? 'selected' : '') + " value='" + key +
                        "'>" +
                        state + "</option>";
                });

                $('#inp_states_edit').html(html);
                $('#inp_states_edit').select2({
                    placeholder: "Select State",
                    dropdownParent: $('#shipping-edit-model'),
                    theme: "bootstrap"
                });

            }
        });
    }


    function readImageURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#inp_image_pre').attr('src', e.target.result)
                initCropper();
            };
            reader.readAsDataURL(input.files[0]);
        }
        $('.cropping-elements').removeClass('d-none');
    }

    function initCropper() {
        var $image = $('#inp_image_pre');
        $image.cropper('destroy');
        $image.cropper({
            aspectRatio: 6 / 6,
            preview: '#cropped_result',
            crop: function (event) {
                $('#inp_x1').val(event.detail.x);
                $('#inp_y1').val(event.detail.y);
                $('#inp_w').val(event.detail.width);
                $('#inp_h').val(event.detail.height);
            }
        });
        var cropper = $image.data('cropper');
    }

    function destroye() {
        $currentCropper = $('#inp_image_pre').data('cropper');
        if ($currentCropper) {
            $currentCropper.destroy();
        }
    }

    function validatePassword() {
        var validate_pass = document.getElementById('validate_pass').value;
    }

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var idvalue = $(this).attr('aria-controls');
        var id = $(this).attr('id');
        if (id != 'tabs-icons-text-1-tab') {
            if (!sessionStorage.getItem("password")) {
                showTab0();
                hiddenTab(idvalue)
                var Tabelement = document.getElementById(id);
                Tabelement.classList.remove("active");
            } else {
                hiddenTab0();
                $('#cardStateForBilling').select2({
                    placeholder: "Select State",
                    allowClear: true
                });

                $('#cardCountryForBilling').select2({
                    placeholder: "Select Country",
                    allowClear: true
                });
                showtab(idvalue);
            }
        }
    });

    function showValidatePassword() {
        var type = $('#validate_pass').attr('type')
        if (type == 'password') {
            $('#validate_pass').attr('type', 'text');
            $('#eyeValidate').removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            $('#validate_pass').attr('type', 'password');
            $('#eyeValidate').removeClass("fa-eye-slash").addClass("fa-eye");
        }
    }

    function validPassword() {
        var validate_pass = document.getElementById('validate_pass').value;
        $.ajax({
            url: '{{ route("profile.check.password") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                validate_pass: validate_pass
            },
            type: 'get',
            dataType: "html",
            success: function (response) {
                if (response == 'valid') {
                    sessionStorage.setItem("password", "valid");
                    hiddenTab0();
                    showTab3();
                } else {
                    alertDanger("Enter the correct password");
                }
            }
        });
    }

    function showTab3() {
        var Tabelement = document.getElementById('tabs-icons-text-3');
        Tabelement.classList.remove("d-none");
        Tabelement.classList.add("active");
        Tabelement.classList.add("show");
        var Tabelement = document.getElementById('tabs-icons-text-3-tab');
        Tabelement.classList.add("active");
        $('#cardStateForBilling').select2({
            placeholder: "Select State",
            allowClear: true
        });

        $('#cardCountryForBilling').select2({
            placeholder: "Select Country",
            allowClear: true
        });
    }

    function showTab0() {
        var TabelementDefult = document.getElementById('tabs-icons-text-0');
        TabelementDefult.classList.remove("d-none");
        TabelementDefult.classList.add("active");
        TabelementDefult.classList.add("show");
        if ((viewmsgcount % 10 )== 0) {
            alertDanger("Please enter your password & verify");
        }
        viewmsgcount = viewmsgcount + 1;
    }

    function hiddenTab0() {
        var TabelementDefult = document.getElementById('tabs-icons-text-0');
        TabelementDefult.classList.add("d-none");
        TabelementDefult.classList.remove("active");
        TabelementDefult.classList.remove("show");
    }

    function hiddenTab(id) {
        var Tabelement = document.getElementById(id);
        Tabelement.classList.remove("active");
        Tabelement.classList.remove("show");
        Tabelement.classList.add("d-none");
    }

    function showTab(id) {
        var TabelementDefult = document.getElementById(id);
        TabelementDefult.classList.remove("d-none");
        TabelementDefult.classList.add("active");
        TabelementDefult.classList.add("show");
    }

    function submitForm(tabid = 'tabs-icons-text-1', formid) {
        if (!sessionStorage.getItem("password")) {
            showTab0();
            hiddenTab(tabid)
        } else {
            sessionStorage.removeItem('password');
            document.getElementById(formid).submit();
        }
    }
    $("#usernameInput").keyup(function () {
        var username = ($(this).val());
        var nowusername = '{{ Auth::user()->username }}';
        $.ajax({
            url: "{{ route('customer.username') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                username: username
            },
            success: function (response) {
                console.log(response);
                if (response == "true") {

                    $("#submit-btn").prop("disabled", false);
                    document.getElementById("username_msg").innerHTML = "";
                } else {
                    if ((nowusername == username)) {
                        $("#submit-btn").prop("disabled", false);
                        document.getElementById("username_msg").innerHTML = "";
                    } else {
                        document.getElementById("username_msg").innerHTML =
                            "This username is already existing.";
                        $("#submit-btn").prop("disabled", true);
                    }
                }
            }
        });
    });

</script>
