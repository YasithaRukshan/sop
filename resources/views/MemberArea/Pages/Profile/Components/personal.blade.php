<div class="tab-pane fade  show active" id="tabs-icons-text-1" role="tabpanel">
    <form class="tab-wizard wizard-circle wizard clearfix" action="{{route('profile.update')}}" method="POST"
        id="personal-info">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <input type="hidden" name="customer_id" value="{{ Auth::user()->id }}">
                    <label for="first_name"><b>First Name</b></label>
                    <input type="text" value="{{ Auth::user()->first_name }}"
                        class="form-control  form-control-alternative" id="firstname" name="first_name"
                        placeholder="Enter Name Here" required>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="lastname"><b>Last Name</b></label>
                    <input type="text" value="{{ Auth::user()->last_name }}"
                        class="form-control  form-control-alternative" id="lastname" name="last_name"
                        placeholder="Enter Name Here" required>
                </div>
            </div>
            <div class="col-lg-12  mt-4">
                <h6 class="text-center">
                    <button class="btn btn-info" id="submit-btn" type="submit">Update</button>
                </h6>
            </div>
        </div>
    </form>
</div>
