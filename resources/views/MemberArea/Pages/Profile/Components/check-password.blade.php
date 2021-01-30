<div class="tab-pane fade " id="tabs-icons-text-0" role="tabpanel" aria-labelledby="tabs-icons-text-0-tab">
    <div class="row mb-3">
        <div class="col-12">
            <h5 class="font-size-15 mb-1"> <i
                    class="bx bx-radio-circle bx-burst bx-md text-danger align-middle mr-1"></i> Please enter your
                current password to reset the password</h5>
            <p class="text-muted mb-0">

            </p>
        </div>
    </div>
    <div class="row">
        <input type="hidden" name="customer_id" value="">
        <div class="col-12 mb-4">
            <label><b>{{ __('Password') }}</b></label> <i id="eyeValidate" onclick="showValidatePassword()"
                class="far fa-eye-slash"></i></label>
            <input type="password" name="password" id="validate_pass" class="form-control form-control-alternative"
                placeholder="Enter Password">
        </div>
        <div class="col-lg-12 text-center ">
            <button onclick="validPassword()" class="btn btn-info" id="sumbit-btn" type="button">Verify</button>
        </div>
    </div>
</div>
