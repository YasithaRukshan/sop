<div class="dropdown d-inline-block">
    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
        style="padding-right: 20px;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {!!$tc->MsgCount($msg_count)!!}
    </button>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
        aria-labelledby="page-header-notifications-dropdown">
        <div class="p-3">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="m-0"> Messages </h6>
                </div>
            </div>
        </div>
        @if (!$messages->isEmpty())
        <div data-simplebar style="max-height: 230px;">
            @foreach ($messages as $key=>$message)
            @if ($key<5) <a href="{{route('messages')}}" class="text-reset notification-item">
                <div class="media">
                    <img src="MemberArea/images/avatar.png" class="mr-3 rounded-circle avatar-xs" alt="user-pic">
                    <div class="media-body">
                        <h6 class="mt-0 mb-1">Admin</h6>
                        <div class="font-size-12 text-muted">
                            <p class="mb-1">{{$message->message}}</p>
                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i>
                                {{$tc->TimeCrated($message->created_at)}}
                            </p>
                        </div>
                    </div>
                </div>
                </a>
                @endif
                @endforeach
        </div>
        <div class="p-2 border-top">
            <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="{{route('messages')}}">
                <i class="mdi mdi-arrow-right-circle mr-1"></i> View All
            </a>
        </div>
        @else
        <div data-simplebar style="max-height: 230px;">
            <center>
                <img width="50" height="50" class="img-profile rounded-circle"
                    src="{{ asset('assets/images/avatar.png')}}">
                <strong>
                    <h3 class="text-center">No new messages </h3>
                </strong>
            </center>
        </div>
        @endif
    </div>
</div>
