
<script>
    $(document).ready(function () {
        msgview();
        read();
    });

    function msgview() {
        $.ajax({
            url: '{{ route("messages.view") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            dataType: "html",
            success: function (response) {
                readonlymsg()
                $("#msg_view").html(response);
                var id = 'tabs-msg-text-scroll';
                if (document.getElementById(id)) {
                    var el = new SimpleBar(document.getElementById(id));
                    el.getScrollElement().scrollTop = el.getScrollElement().scrollHeight

                }
            }
        });
    }

    function msgpusher() {
        $.ajax({
            url: '{{ route("messages.pusher") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            success: function (response) {}
        });
    }

    function sentmsg() {
        var message = document.getElementById('new_msg').value;
        if (message) {
            $.ajax({
                url: '{{ route("messages.store") }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    message: message
                },
                type: 'post',
                dataType: "html",
                success: function (response) {
                    readonlymsg();
                    document.getElementById('new_msg').value = "";
                    msgpusher();
                    setTimeout(() => {
                        msgview();
                    }, 300);
                }
            });
        } else {
            alertDanger("Enter message !");
        }
    }

    function copydata(copy_id) {
        var copyText = document.getElementById(copy_id);
        document.getElementById(copy_id).classList.remove("d-none");
        copyText.select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");
        setTimeout(() => {
            alertCopy("Copied to clipboard !");
        }, 500);
        document.getElementById(copy_id).classList.add("d-none");
    }

    function alertCopy(msg) {
        $.toast({
            heading: 'Copied',
            text: msg,
            icon: 'success',
            loader: true,
            loaderBg: '#fff',
            showHideTransition: 'slide',
            hideAfter: 1000,
            allowToastClose: false,
            position: 'bottom-right',
        })
    }



    var pusher_key = '{{config("broadcasting.connections.pusher.key")}}'
    var cluster_key = '{{config("broadcasting.connections.pusher.options.cluster")}}'
    var pusher = new Pusher(pusher_key, {
        cluster: cluster_key
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function (data) {
        if (data.user_type == 'admin') {
            if (data.user_id == '{{ Auth::user()->id }}') {
                readonlymsg();
                setTimeout(() => {
                    msgview();
                }, 300);
            }
        }
    });

    function read() {
        $.ajax({
            url: '{{ route("messages.read") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            dataType: "html",
            success: function (response) {
                msgpusher();
            }
        });
    }

    function readonlymsg() {
        $.ajax({
            url: '{{ route("messages.read") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            dataType: "html",
            success: function (response) {}
        });
    }

    function delatemsg(deletid) {
        $.confirm({
            title: 'Are You Sure,',
            content: "Do You Want To Delete This Message!",
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
                            url: '{{ route("messages.delete") }}',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                id: deletid
                            },
                            type: 'get',
                            dataType: "html",
                            success: function (response) {
                                readonlymsg();
                                msgpusher();
                                setTimeout(() => {
                                    msgview();
                                }, 300);
                                var msg = "Message deleted successfully!"
                                alertSuccess(msg);
                            }
                        });
                    }
                },
                cancel: function () {}
            }
        });
    }

</script>