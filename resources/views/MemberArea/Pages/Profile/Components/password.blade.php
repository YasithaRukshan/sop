<div class="tab-pane fade " id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
    <form class="tab-wizard wizard-circle wizard clearfix" action="{{route('profile.update')}}" method="POST"
        id="password-update-form">
        @csrf
        <div class="row">
            <input type="hidden" name="customer_id" value="">
            <div class="col-12 mb-4">
                <label><b>{{ __('New Password') }}</b>
                    <a href="javascript:void(0)" id="passGen"> &nbsp;&nbsp;Generate</a></label>
                <input type="text" name="password" id="new_pass" class="form-control form-control-alternative" required>
            </div>

            <div class="col-12 mb-4">
                <label><b>{{ __('Confirm Password') }}<sup class="text-danger"></sup></b>
                    &nbsp;&nbsp;
                    <i id="eye" onclick="showPassword()" class="far fa-eye"></i></label>
                <input type="text" onkeyup="validatepasswordconf()" name="confirm_password" id="confirm_pass"
                    class="form-control form-control-alternative" required>
                <small id="conf_pass_msg"></small>
            </div>
            <div class="col-lg-12 text-center ">
                <button onclick="submitForm('tabs-icons-text-3','password-update-form')" class="btn btn-info"
                    id="sumbit-btn-pass" type="button" disabled>Update</button>
            </div>
        </div>
    </form>
</div>
