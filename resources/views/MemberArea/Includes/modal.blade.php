<div class="modal fade bs-example-modal-center" id="logoutModal"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-modal="true" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title " id="modal-title-notification">Logout</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="py-3 text-center">

                    <h4 class="heading mt-4">Are You Sure!</h4>
                    <p>
                        Do You Want To Logout Now ?
                    </p>
                </div>
                <div class="col-12">
                    <h6 class="text-center">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="Submit" class="btn btn-danger">Sure, Logout</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </form>
                    </h6>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

{{-- Username Update modal design--}}

<div class="modal fade" id="UsernameModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <!--Content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3>Update Username</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <!--Body-->
            <div class="modal-body mb-0">
                <form id="username-form" action="{{route('profile.update.username')}}" method="POST">
                    @csrf
                    <input type="text" class="form-control" name="username" id="username" aria-describedby="helpId"
                        placeholder="Enter Username">
                    <br>
                    <div class="text-center">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
