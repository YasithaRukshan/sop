<div class="dropdown  {{ isset($class)?$class:'dropdown' }} d-inline-block">
    <a href="{{route('wallet.withdrawals.create')}}" class="btn btn-sm {{ isset($btn)?$btn:'btn-dark' }}"
        id="page-header-notifications-dropdown">
        <i class="bx bx-download"></i> {{ isset($btn_text)?$btn_text:'SOPX' }}
    </a>

</div>
