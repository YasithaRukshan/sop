<div class="row">
    <div class="col-12">
        <div class="table-responsive py-4">
            <table class="table" id="contractTable">
                <thead>
                    <tr>
                        <th>Contract ID</th>
                        <th>Portfolio</th>
                        <th>SOAX Staked</th>
                        <th>Production</th>
                        {{-- <th>Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contracts as $key => $contract)
                    <tr>
                        <td>{{ md5($contract->id )}}</td>
                        <td>{{ $contract->production->portfolio->title }}</td>
                        <td>{{ $contract->Contract->amount }}</td>
                        <td>{{ number_format($contract->amount, 4)}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- end table-responsive -->
    </div>
</div>
