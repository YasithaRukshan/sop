<div class="dropleft no-arrow mb-1">
    <a class="btn btn-sm btn-icon-only text-dark" href="#" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-cog"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-left  "
        aria-labelledby="dropdownMenuButton" x-placement="bottom-start">
        <a class="dropdown-item edit-portfolio"
            href="{{route('contracts.view',md5($id))}}"
            class="btn btn-warning" title="">
            <i class="fas fa-edit"></i>&nbsp;View & &nbsp;Log
        </a>
    </div>
</div>