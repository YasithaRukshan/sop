<script src="{{asset('MemberArea/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('MemberArea/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('MemberArea/libs/jszip/jszip.min.js')}}"></script>
<script src="{{asset('MemberArea/libs/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{asset('MemberArea/libs/pdfmake/build/vfs_fonts.js')}}"></script>
<script src="{{asset('MemberArea/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('MemberArea/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('MemberArea/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>

<script>
    $(document).ready(function () {
        setFirstRow();
    });
    let levelOfreferral = 0;
    let nowIds = [];
    let nowCount = 0;

    function setFirstRow() {
        levelOfreferral = levelOfreferral + 1;
        $.ajax({
            url: '{{ route("referrals.set.first") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            dataType: "html",
            async: false,
            success: function (response) {
                nowIds = [];
                let obj = JSON.parse(response);
                nowCount = nowCount + parseInt(obj.count);
                if (nowCount > 0) {
                    nowIds = obj.userId;
                    let name = 'view_details_' + levelOfreferral;
                    $('body').data(name, nowIds); //setter
                    let countName = 'count_' + levelOfreferral;
                    $('body').data(countName, nowCount);
                    checkNextRow();
                    checkPreRow();
                }
                $("#increment").html(nowCount);
                $("#nowLevel").html(levelOfreferral == 1 ? "Direct Referrals" : "Degree " + (
                    levelOfreferral - 1));
                $("#level-display").val(levelOfreferral);
                $('#referral_tb').DataTable().destroy();
                $("#viewDataTbody").append(obj.row);
                $('#referral_tb').dataTable({
                    "language": {
                        "emptyTable": "No data available in the table",
                        "paginate": {
                            "previous": '<i class="fas fa-chevron-left text-dark"></i>',
                            "next": '<i class="fas fa-chevron-right text-dark"></i>'
                        },
                        "sEmptyTable": "No data available in the table"
                    },
                    "searching": false
                });
            }
        });
    }

    function copyUrl(url, id) {
        let $temp = $("<input>");
        $("body").append($temp);
        $temp.val(url).select();
        document.execCommand("copy");
        $temp.remove();
    }

    function checkNextRow() {
        if (nowIds === undefined || nowIds.length == 0) {
            $("#plus").prop("disabled", true);
        } else {
            $.ajax({
                url: '{{ route("referrals.check.next") }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    nowIds: nowIds
                },
                type: 'post',
                dataType: "html",
                async: false,
                success: function (response) {
                    if (response) {
                        $("#plus").prop("disabled", false);
                    }
                }
            });
        }
    }

    function checkPreRow() {
        if (levelOfreferral > 1) {
            $("#minus").prop("disabled", false);
        } else {
            $("#minus").prop("disabled", true);
        }
    }

    function setPreRow() {
        $("#viewDataTbody").html(
            '<div class="spinner-grow text-danger" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-warning" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-danger" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-warning" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-danger" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-warning" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-danger" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-warning" role="status"> <span class="sr-only">Loading...</span> </div>'
        );
        $(".tooltip").tooltip("hide");
        $("#minus").prop("disabled", true);
        setTimeout(() => {
            if (levelOfreferral > 1) {

                $('#referral_tb').DataTable().destroy();
                $('#view_row_' + levelOfreferral).remove();
                levelOfreferral = levelOfreferral - 1;

                var page = Math.floor(levelOfreferral / 10);
                if ((page == 0) || (levelOfreferral == 10)) {
                    page = 0;
                }
                $('#referral_tb').dataTable({
                    "language": {
                        "emptyTable": "No data available in the table",
                        "paginate": {
                            "previous": '<i class="fas fa-chevron-left text-dark"></i>',
                            "next": '<i class="fas fa-chevron-right text-dark"></i>'
                        },
                        "sEmptyTable": "No data available in the table"
                    },
                    "searching": false
                });
                var table = $('#referral_tb').DataTable();
                table.page(page).draw('page');
                let idname = 'view_details_' + levelOfreferral;
                nowIds = $('body').data(idname);

                let countName = 'count_' + levelOfreferral;
                nowCount = $('body').data(countName);
                $("#increment").html(nowCount);
                $("#nowLevel").html(levelOfreferral == 1 ? "Direct Referrals" : "Degree " + (levelOfreferral -
                    1));
                $("#level-display").val(levelOfreferral);
                checkNextRow();
                checkPreRow();
            } else {
                $("#minus").prop("disabled", true);
            }

        }, 200);
    }

    function setNextRow() {
        levelOfreferral = levelOfreferral + 1;
        $(".tooltip").tooltip("hide");
        $("#plus").prop("disabled", true);

        $("#viewDataTbody").html(
            '<div class="spinner-grow text-success" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-warning" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-success" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-warning" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-success" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-warning" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-success" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-warning" role="status"> <span class="sr-only">Loading...</span> </div>'
        );
        $.ajax({
            url: '{{ route("referrals.set.next") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                level: levelOfreferral,
                nowIds: nowIds,
            },
            type: 'post',
            dataType: "html",
            success: function (response) {
                nowIds = [];
                let obj = JSON.parse(response);
                nowCount = nowCount + parseInt(obj.count);
                nowIds = obj.userId;
                let name = 'view_details_' + levelOfreferral;
                $('body').data(name, nowIds); //setter
                let countName = 'count_' + levelOfreferral;
                $('body').data(countName, nowCount);

                checkNextRow();
                checkPreRow();
                $("#increment").html(nowCount);
                $("#nowLevel").html(levelOfreferral == 1 ? "Direct Referrals" : "Degree " + (
                    levelOfreferral - 1));
                $("#level-display").val(levelOfreferral);
                $('#referral_tb').DataTable().destroy();
                $("#viewDataTbody").append(obj.row);

                var page = Math.floor(levelOfreferral / 10);
                if ((page == 0) || (levelOfreferral == 10)) {
                    page = 0;
                }
                $('#referral_tb').dataTable({
                    "language": {
                        "emptyTable": "No data available in the table",
                        "paginate": {
                            "previous": '<i class="fas fa-chevron-left text-dark"></i>',
                            "next": '<i class="fas fa-chevron-right text-dark"></i>'
                        },
                        "sEmptyTable": "No data available in the table"
                    },
                    "searching": false
                });
                var table = $('#referral_tb').DataTable();
                table.page(page).draw('page');
            }
        });
    }

    function showFloor(level) {

        let idname = 'view_details_' + level;
        tempnowIds = $('body').data(idname);
        let table = $('#referral_tb').DataTable();
        $('#floorModal').modal({
            keyboard: false,
            backdrop: "static"
        });
        $('#modalLevel').html(table.row('#view_row_' + level).data()[1]);
        $('#modalCount').html(table.row('#view_row_' + level).data()[2]);
        $('#datatable').DataTable();
        $("#modalDataTable").html(
            '<div class="spinner-grow text-success" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-warning" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-success" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-warning" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-success" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-warning" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-success" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-warning" role="status"> <span class="sr-only">Loading...</span> </div>'
        );

        $.ajax({
            url: '{{ route("referrals.load.modal") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                value: tempnowIds,
                level: level
            },
            type: 'post',
            dataType: "html",
            success: function (response) {
                $('#datatable').DataTable().destroy();
                $('#datatable-buttons').DataTable().destroy();
                $("#modalDataTable").html(response);
                $("#datatable").DataTable(), $("#datatable-buttons").DataTable({
                    "language": {
                        "emptyTable": "No data available in the table",
                        "paginate": {
                            "previous": '<i class="fas fa-chevron-left text-dark"></i>',
                            "next": '<i class="fas fa-chevron-right text-dark"></i>'
                        },
                        "sEmptyTable": "No data available in the table"
                    },
                    lengthChange: !1,
                    buttons: ["csv", "excel", "pdf"]
                }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");
            }
        });
    }

    function showChild(id) {
        $('#floorModal').modal('hide');
        $('#childModal').modal({
            keyboard: false,
            backdrop: "static"
        });
        $('#childModal_tb').DataTable();
        $("#childModalTable").html(
            '<div class="spinner-grow text-success" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-warning" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-success" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-warning" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-success" role="status"> <span class="sr-only">Loading...</span> </div> <div class="spinner-grow text-warning" role="status"> <span class="sr-only">Loading...</span> </div> '
        );

        $.ajax({
            url: '{{ route("referrals.load.modal.child") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id
            },
            type: 'get',
            dataType: "html",
            success: function (response) {
                $('#childModal_tb').DataTable().destroy();
                $("#childModalTable").html(response);
                $('#childModal_tb').dataTable({
                    "language": {
                        "emptyTable": "No data available in the table",
                        "paginate": {
                            "previous": '<i class="fas fa-chevron-left text-dark"></i>',
                            "next": '<i class="fas fa-chevron-right text-dark"></i>'
                        },
                        "sEmptyTable": "No data available in the table"
                    }
                });
            }
        });
    }

</script>
