<div class="modal  fade bs-example-modal-xl" id="floorModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog  modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title mt-0">Users on
                            <strong id="modalLevel"></strong>
                            = #<strong id="modalCount"></strong>
                        </h5>
                    </div>
                    <div class="col-lg-12 mt-4 p-0 mb-2">
                        <table id="datatable-buttons" class="table text-center">
                            <thead class="light">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>SOAX Purchased</th>
                                    <th>Referred</th>
                                    <th>Commissions</th>
                                    <th>Joined</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="modalDataTable">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal  fade bs-example-modal-xl" id="childModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog  modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title mt-0">Degrees of Influence </h5>
                    </div>
                    <div class="col-lg-12 mt-4 p-0">
                        <table id="childModal_tb" class="table text-center">
                            <thead class="light">
                                <tr>
                                    <th>Name</th>
                                    <th>Referred</th>
                                    <th>Joined</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="childModalTable">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
