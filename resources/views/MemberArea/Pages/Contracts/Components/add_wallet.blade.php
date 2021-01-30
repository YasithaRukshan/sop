<div class="d-none" id="buy_soax_div">
    Add more SOAX <span class="text-success"></span>
    <div class="dropdown d-inline-block">
        <a href="#" class="text-success" id="page-header-notifications-dropdown" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">click here</a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu p-0"
            aria-labelledby="page-header-notifications-dropdown">
            <div class="p-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-0"> SOAX </h6>
                    </div>
                </div>
            </div>
            <div class="p-3">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group" >
                            <label for="">Enter SOAX Amount To Purchase</label>
                            <div id="add_soax_input">

                            </div>
                            <small id="helpId" class="form-text text-muted">
                                <strong>Min: <span class="text-danger">
                                        {{ config("payments.minimum_soax") }}
                                    </span>
                                </strong>
                            </small>
                            
                        </div>
                    </div>
                    <div class="col-12 ">
                        <span class=" text-danger">
                            <strong id="amount_add_msg"></strong>
                        </span>
                    </div>

                    <div class="col-12 ">
                        <h6 class="text-center">
                            <button class="btn btn-primary" type="button" onclick="addsoaxValue()"> <i
                                    class="fas fa-chevron-right"></i>
                                Next</button>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
