@if (Auth::user()->tokenStatusCount()>0)
<span class="badge badge-pill badge-danger float-right">
    {{Auth::user()->tokenStatusCount()}}
</span>
@endif
