@if (!$messages->isEmpty())

<div class="chat-conversation p-3">
    <ul class="list-unstyled" data-simplebar style="max-height: 470px;min-height: 470px;" id="tabs-msg-text-scroll">
        @php
        $daynamesup=array();
        @endphp
        @foreach ($messages as $key=>$message)
        @php
        $viewdayname=$tc->TimeViewName($message->created_at);
        @endphp
        @if (!in_array($viewdayname, $daynamesup))
        @php
        $daynamesup[] = $viewdayname;
        @endphp
        <li>
            <div class="chat-day-title">
                <span class="title">{{$viewdayname}}</span>
            </div>
        </li>
        @endif
        @if ($message['from_who']=='1')
        <li class="{{(($message->message_read)=='1')?'read_msg':'un_read_msg'}}">
            <div class="conversation-list">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript: void(0);"
                            onclick="copydata('copy_{{$key}}')">Copy</a>
                    </div>
                </div>
                <div class="ctext-wrap">
                    <p style="font-size: 15px">
                        {!!$message->message!!}
                    </p>
                    <input type="text" id="copy_{{$key}}" value=" {!!$message->message!!}" class="d-none">
                    <p class="chat-time mb-0"><i class="bx bx-time-five align-middle mr-1"></i>
                        {{$tc->TimeCrated($message->created_at)}}
                    </p>
                </div>
            </div>
        </li>
        @else
        <li class="right {{(($message->message_read)=='1')?'right_read_msg':'right_un_read_msg'}}">
            <div class="conversation-list">
                <div class="dropdown">

                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript: void(0);"
                            onclick="copydata('copy_{{$key}}')">Copy</a>
                        <a class="dropdown-item" href="javascript: void(0);"
                            onclick="delatemsg('{{$message->id}}')">Delete</a>
                    </div>
                </div>
                <div class="ctext-wrap">
                    <p style="font-size: 15px">
                        {!!$message->message!!}
                    </p>
                    <input type="text" id="copy_{{$key}}" value=" {!!$message->message!!}" class="d-none">
                    <p class="chat-time mb-0 mb-sm-3"><i class="bx bx-time-five align-middle mr-1"></i>
                        {{$tc->TimeCrated($message->created_at)}}
                    </p>
                </div>
            </div>
        </li>
        @endif
        @endforeach
    </ul>
</div>
@else
<div class="chat-conversation p-3">
    <div class="card">
        <div class="row empty">
            <div class="col-lg-6 " style="min-height: 45vh; margin-left: auto; margin-right: auto;padding-top: 20vh">
                <center>
                    <img width="150" height="150" class="img-profile rounded-circle"
                        src="{{ asset('assets/images/avatar.png')}}">
                    <h5 class="text-muted"></h5>
                    <h3 class="text-center">
                        You can chat with admin
                    </h3>
                </center>
            </div>
        </div>
    </div>
</div>

@endif
