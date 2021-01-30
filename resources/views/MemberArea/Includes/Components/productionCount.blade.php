@if (Auth::user()->productionCount()>0)
<span class="badge badge-pill badge-danger float-right">
    {{Auth::user()->productionCount()}}
</span>
@endif
