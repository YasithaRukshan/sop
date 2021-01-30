<!-- jequery plugins -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script>
<script src="{{ asset('PublicArea/js/owl.js') }}"></script>
<script src="{{ asset('PublicArea/js/wow.js') }}"></script>
<script src="{{ asset('PublicArea/js/validation.js') }}"></script>
<script src="{{ asset('PublicArea/js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('PublicArea/js/appear.js') }}"></script>
<script src="{{ asset('PublicArea/js/jquery.countTo.js') }}"></script>
<script src="{{ asset('PublicArea/js/scrollbar.js') }}"></script>
<script src="{{ asset('PublicArea/js/tilt.jquery.js') }}"></script>
<script src="{{ asset('PublicArea/js/pagenav.js') }}"></script>
<!-- main-js -->
<script src="{{ asset('PublicArea/js/script.js') }}"></script>

<!-- bootstrap-js -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- main-js -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<!-- rangeslider-js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/rangeslider.js/2.3.3/rangeslider.min.js"></script>

<!-- select2-js -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

<!-- sptoast JS-->
<script src="{{ asset('PublicArea/js/sptoast.js') }}"></script>



<script>
    $(document).ready(function () {

        @foreach(['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-'.$msg))
        var msg = '@php echo Session("alert-".$msg); @endphp';
        @if($msg == 'success')
        setTimeout(() => {
            alertSuccess(msg);
        }, 500);
        @endif
        @if($msg == 'danger')
        setTimeout(() => {
            alertDanger(msg);
        }, 500);
        @endif
        @if($msg == 'info')
        setTimeout(() => {
            alertInfo(msg);
        }, 500);
        @endif
        @if($msg == 'warning')
        setTimeout(() => {
            alertWarning(msg);
        }, 500);
        @endif
        @endif
        @endforeach

        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);

        if (urlParams.has('a')) {
            const a = urlParams.get('a')
            setCookie('rfusername', a, 180)
        }
    });

    function alertDanger(msg) {
        $.toast({
            heading: 'Oops',
            text: msg,
            icon: 'error',
            loader: true,
            loaderBg: '#fff',
            showHideTransition: 'slide',
            hideAfter: 6000,
            position: 'bottom-right',
        })
    }

    function alertSuccess(msg) {
        $.toast({
            heading: 'Success',
            text: msg,
            icon: 'success',
            loader: true,
            loaderBg: '#fff',
            showHideTransition: 'slide',
            hideAfter: 6000,
            allowToastClose: false,
            position: 'bottom-center',
        })
    }

    function alertWarning(msg) {
        $.toast({
            heading: 'Warning',
            text: msg,
            icon: 'warning',
            loader: true,
            loaderBg: '#fff',
            showHideTransition: 'slide',
            hideAfter: 6000,
            allowToastClose: false,
            position: 'bottom-right',
        })
    }

    function alertInfo(msg) {
        $.toast({
            heading: 'Attention',
            text: msg,
            icon: 'info',
            loader: true,
            loaderBg: '#fff',
            showHideTransition: 'slide',
            hideAfter: 6000,
            allowToastClose: false,
            position: 'bottom-right',
        })
    }

    $("#logoutModal").on('show.bs.modal', function (e) {
        $("#mobile-menu-view").css("display", "none");
    });

    $("#logoutModal").on('hide.bs.modal', function (e) {
        $("#mobile-menu-view").css("display", "");
    });

    $("#logout-form").submit(function () {
        sessionStorage.removeItem('password');
    });

    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }



</script>
@stack('js')
