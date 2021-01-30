@extends('Layouts.app')
@section('title', 'All Notifications | Succulents')
@section('header')
<div class="header pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-8">
                    <h6 class="h2 text-dark d-inline-block mb-0">All Notifications</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-block ">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                All Notifications
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card shadow mb-4">
            <div class="card-header bg-transparent">
                <div class="row justify-content-between">
                    <div class="col-md-6">
                        <h3 class="mb-0">All Notifications</h3>
                    </div>
                </div>
                <div class="row justify-content-between mt-4">
                    <div class="col-md">
                        <div class="row">
                            <div class="col-md">
                                <label>
                                    <span>Show &nbsp;</span>
                                    <span>
                                        <select
                                            class="custom-select custom-select-sm form-control form-control-sm notification_pagination_select"
                                            id="notification_pagination">
                                            <option value="5" {{$paginate_number == 5? 'selected':''}}>5</option>
                                            <option value="10" {{$paginate_number == 10? 'selected':''}}>10</option>
                                            <option value="25" {{$paginate_number == 25? 'selected':''}}>25</option>
                                            <option value="100" {{$paginate_number == 100? 'selected':''}}>100</option>
                                        </select>
                                    </span>
                                    <span>&nbsp; entries</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control form-control-alternative" id="search_date" type="text"
                            placeholder="Search By Date">
                    </div>
                </div>
            </div>
            <div id="notification_card" class="card-body">
                @include('Pages.notification.notificationCard')
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
</div>
@endsection


@section('css')
<style>
    .inteli_pagination_select {
        width: auto;
        display: inline-block;
        margin: .375rem;
    }

    .time_date {
        color: #747474;
        display: block;
        font-size: 12px;
        margin: 8px 0 0;
    }

    .col-md {
        flex-grow: 1;
    }

    label {
        display: inline-flex;
    }
</style>
@endsection


@section('js')
<script>

    $(document).ready(function () {
        $("#search_date").datepicker();

    });

    $('#notification_pagination').change(function () {
        window.location.href = "{{ url('notification/')}}/" + $(this).val();

    });


    $('#search_date').change(function () {

        let date = new $(this).val();
        
        if (date) {
            date = date.split("/");
            var newDate = date[2] + "-" + date[0] + "-" + date[1];

            var data = {
                date: newDate,
            };
            console.log(data);
            $.ajax({
                url: "{{ route('notification.byDates') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                dataType: '',
                data: data,
                success: function (response) {
                    $('#notification_card').html(response);
                }
            });
        }

    });
</script>
@endsection