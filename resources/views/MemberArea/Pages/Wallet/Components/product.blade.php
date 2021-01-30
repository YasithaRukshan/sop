<div class="row mb-4">
    <div class="col-lg-12">

        <ul class="nav nav-tabs nav-tabs-custom">

            @foreach ($contracts as $key=>$contract)
            <li class="nav-item">
                <a class="nav-link {{$key==0?' active':''}}" id="tabs-icons-text-{{$key}}-tab" data-toggle="tab"
                    href="#tabs-icons-text-{{$key}}" role="tab" aria-controls="tabs-icons-text-{{$key}}"
                    aria-selected="true" data-tableid="datatable{{$key}}">
                    {{$contract->Portfolio->title}}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>

<div >
    <div class="tab-content" id="myTabContent">
        @foreach ($contracts as $key=>$contract)
        <div class="tab-pane fade  table-responsive py-4 {{$key==0?'show active':''}}" id="tabs-icons-text-{{$key}}" role="tabpanel">
            <table id="datatable{{$key}}" class="table table-hover dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>ID No</th>
                        <th>Stake</th>
                        <th>Earnings</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        @endforeach
    </div>

</div>
