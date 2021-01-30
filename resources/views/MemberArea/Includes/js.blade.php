@stack('beforejs')
<!-- JAVASCRIPT -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.6/metisMenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplebar/5.3.0/simplebar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js"></script>


<!-- Boxicons JS-->
{{-- <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script> --}}

<!-- sptoast JS-->
<script src="{{ asset('MemberArea/js/sptoast.js') }}"></script>

<!-- select2 JS-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

<!-- confirm JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<!-- cropper JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropper/4.0.0/cropper.min.js"></script>

<!-- ckeditor JS-->
<script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>

<!-- Required datatable js -->
<script src="{{asset('MemberArea/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('MemberArea/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

<!-- Responsive examples -->
<script src="{{asset('MemberArea/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('MemberArea/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>

<!-- validate JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.js"></script>

<!-- apexcharts JS-->
<script src="{{ asset('MemberArea/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- crypto-wallet init -->
<script src="{{asset('MemberArea/js/app.js')}}"></script>

<script src="{{asset('js/memberApp.js')}}"></script>


<!-- pusher JS-->
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>


@livewireScripts

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.webticker/3.0.0/jquery.webticker.min.js"
    integrity="sha512-sGvMKcHwoC9BkOtA57heMk9Gz/076xz4oLJmhLFKav+FHkVhNCmXlUtPnnBJGvVK3nn/gZ6Y52Tn8UmgtKtaUQ=="
    crossorigin="anonymous"></script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    $(document).ready(function () {
        $('#webTicker').webTicker({
            duplicate: true,
            rssfrequency: 1,
            startEmpty: false,
            hoverpause: true,
            // transition: "ease"
        });

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

        @if(session('emailStatus'))
        setTimeout(() => {
            alertSuccess('A new verification link has been sent to your email address.');
        }, 500);
        @endif

        setTimeout(() => {
            msg_notification();
        }, 3000);

        if (sessionStorage.getItem("SessionAddData")) {
            alertSuccess(sessionStorage.getItem("SessionAddData"));
            sessionStorage.removeItem('SessionAddData');
        }
        //clipboard copy function
        copyToCLipBoard();

    });

    function copyToCLipBoard() {
        var clipboard = new ClipboardJS('.copytoclipboard');
        clipboard.on('success', function (e) {
            alertSuccess('Copied To Clipboard')
        });

    }


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

    function delconf(url, title = "Do You Want To Remove This!") {
        $.confirm({
            title: 'Are You Sure,',
            content: title,
            autoClose: 'cancel|8000',
            type: 'red',
            confirmButton: "Yes",
            cancelButton: "Cancel",
            theme: 'material',
            backgroundDismiss: false,
            backgroundDismissAnimation: 'glow',
            buttons: {
                tryAgain: {
                    text: "Yes, Delete It ",
                    action: function () {
                        $.ajax({
                            url: url,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'GET',
                            success: function () {
                                location.reload();
                            }
                        });
                    }
                },
                cancel: function () {}
            }
        });
    }

    function approve(url, title = "Do You Want To Approve It") {
        $.confirm({
            title: 'Are you sure,',
            content: title,
            autoClose: 'cancel|8000',
            type: 'green',
            theme: 'material',
            backgroundDismiss: false,
            backgroundDismissAnimation: 'glow',
            buttons: {
                'Yes, Publish IT': function () {
                    window.location.href = url;
                    confirmButton: "Yes";
                    cancelButton: "Cancel";
                },
                cancel: function () {

                },

            }
        });
    }

    function decline(url, title = "Do You Want To Decline It") {
        $.confirm({
            title: 'Are you sure,',
            content: title,
            autoClose: 'cancel|8000',
            type: 'red',
            theme: 'material',
            backgroundDismiss: false,
            backgroundDismissAnimation: 'glow',
            buttons: {
                'Yes, Unpublish IT': function () {
                    window.location.href = url;
                },
                cancel: function () {

                },

            }
        });
    }

    function msg_notification() {
        $.ajax({
            url: '{{ route("messages.notification") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            dataType: "html",
            success: function (response) {
                $("#msg_notification").html(response);
            }
        });
    }


    // TODO: By Lathindu don't uncomment untill i do it
    // var pusher_key = '{{config("broadcasting.connections.pusher.key")}}'
    // var cluster_key = '{{config("broadcasting.connections.pusher.options.cluster")}}'
    // var pusher = new Pusher(pusher_key, {
    //     cluster: cluster_key
    // });

    // var channel = pusher.subscribe('my-channel');
    // channel.bind('my-event', function (data) {
    //     msg_notification();
    // });


    function setLst(name, value) {
        return localStorage.setItem(name, value);
    }

    function getLst(name) {
        return localStorage.getItem(name);
    }

    function removeLst(name) {
        return localStorage.removeItem(name);
    }

    $("#logout-form").submit(function () {
        sessionStorage.removeItem('password');
    });

    function setLoader(btnId, spanId) {
        $(btnId).addClass('d-none');

        $(spanId).html(
            '<div class="spinner-border spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>'
        );
    }

</script>
@yield('js')
@stack('js')
@stack('afterjs')
