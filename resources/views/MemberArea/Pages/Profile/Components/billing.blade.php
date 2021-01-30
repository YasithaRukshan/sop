<div class="tab-pane fade " id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
    <div id="cc_card_blur">
        <form class="tab-wizard wizard-circle wizard clearfix" action="" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <input type="hidden" name="customer_id" value="">
                    <input type="hidden" name="billingAddress_id" value="">
                    <label for=""><b> Street</b></label>
                    <input type="text" name="street_address" class="form-control form-control-alternative" value=""
                        required>
                </div>
                <div class="col-lg-6 mb-4">
                    <label for=""><b>City</b></label>
                    <input type="text" name="city" class="form-control form-control-alternative" value="" required>
                </div>
                <div class="col-lg-6">

                    <label for="inp_country"><b>Country</b></label>
                    <select class="form-control form-control-alternative" onchange="getStatusForBilling('', 1)"
                        onchange="getcountrycode()" name="country" id="cardCountryForBilling" required>
                        <option></option>
                        @foreach($countries as $sn => $country)
                        <option value="{{ $sn }}">
                            {{ $country }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="inp_state">State</label>
                            <select class="form-control @error('state') is-invalid @enderror" id="cardStateForBilling"
                                name="state" required>
                                <option></option>
                                @foreach($countries as $sn => $state)
                                <option value="{{ $sn }}">{{ $state }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <label for=""><b>Zip</b></label>
                    <input type="text" min="1" name="zip_code" required class="form-control form-control-alternative"
                        value="" placeholder="Zip">
                </div>
                <div class="col-lg-6">
                    <label for=""><b>Line 2</b></label>
                    <input type="text" name="line_2" class="form-control form-control-alternative" value="">
                </div>
                <div class="col-lg-12 text-center mt-4 pt-4">
                    <button class="btn btn-info" id="cc_update_btn" type="submit">Update</button>
                </div>
            </div>
        </form>
        {{-- @endif --}}
    </div>
</div>
