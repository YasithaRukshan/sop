<div class="modal fade" id="profile-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content  ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit profile image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data" id="image_from">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Select Image</label>
                                <input type="file" class="form-control  form-control-alternative " name="image_id"
                                    id="inp_image" accept="image/jpg, image/jpeg, image/png" aria-describedby="helpId"
                                    placeholder="" onchange="readImageURL(this);">
                            </div>
                        </div>
                        <div class="col-lg-12 d-none cropping-elements">
                            <h6 class="text-center">Original Image</h6>
                            <hr>
                            <div class="image_container">
                                <img id="inp_image_pre" src="#" style="width:100%" alt="your image" />
                            </div>
                        </div>
                        <input type="hidden" name="x1" id="inp_x1">
                        <input type="hidden" name="y1" id="inp_y1">
                        <input type="hidden" name="h" id="inp_h">
                        <input type="hidden" name="w" id="inp_w">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
