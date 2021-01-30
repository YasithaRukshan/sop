@extends('MemberArea.Layouts.app')
@section('title', 'Social Impacts Management | SOP')
@section('header')
<div class="row  py-4">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-dark d-inline-block mb-0">Your Social Impact Logs <small> [
                        @if ($degree)
                        Of Degree #{{ $degree }}
                        @else
                        All
                        @endif
                        ]</small></h6>
                <nav aria-label="breadcrumb" class="d-none d-md-block mt-2">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Social Impacts Logs</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-6">
                @if ($degree)
                <h6 class="text-right">
                    <a href="{{ route('social.view') }}" class=" btn btn-sm btn-neutral float-right">
                        <i class="fas fa-eye"></i> View All Logs
                    </a>
                </h6>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="table-responsive  py-4">
                <table class="table" id="social_tb">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Offset Points</th>
                            <th>Type</th>
                            <th>Source</th>
                            <th>Degree of Separation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $key => $transaction)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $transaction->created_at->format('M-d-Y H:I a') }}</td>
                            <td>{{ $transaction->amount }}</td>
                            <td>
                                @switch($transaction->reward->type)
                                @case(App\Models\Reward::TYPE['COR'])
                                <span class="badge badge-success">COR</span>
                                @break
                                @case(App\Models\Reward::TYPE['GEO'])
                                <span class="badge badge-warning">GEO</span>
                                @break
                                @case(App\Models\Reward::TYPE['OIGCC'])
                                <span class="badge badge-primary">OIGCC</span>
                                @break
                                @endswitch
                            </td>
                            <td>
                                {!! $tc->getRLSource($transaction) !!}
                            </td>
                            <td>
                                Degree #{{ $transaction->reward->degree }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- end table-responsive -->
        </div>
    </div>
</div>
@endsection
@section('css')
<style>

</style>
@endsection
@section('js')
<script>
    $(document).ready(function () {
        $('#social_tb').dataTable({
            "language": {
                "emptyTable": "No data available in the table",
                "paginate": {
                    "previous": '<i class="fas fa-chevron-left text-dark"></i>',
                    "next": '<i class="fas fa-chevron-right text-dark"></i>'
                },
                "sEmptyTable": "No data available in the table"
            }
        });
    });

</script>
@endsection
