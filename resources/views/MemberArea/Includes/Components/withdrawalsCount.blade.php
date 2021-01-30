@if (Auth::user()->withdrawalStatusCount()>0)
<span class="badge badge-pill badge-danger float-right">
    {{Auth::user()->withdrawalStatusCount()}}
</span>
@endif