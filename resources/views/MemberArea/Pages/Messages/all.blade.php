@extends('MemberArea.Layouts.app')
@section('title', 'Messages | SOP')
@section('header')
<div class="row  py-4">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-dark d-inline-block mb-0">Messages</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-block mt-2">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="">Messages</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="d-lg-flex">
    <div class="w-100 user-chat">
        <div class="card">
            <div class="p-4 border-bottom ">
                <div class="row">
                    <div class="col-md-4 col-9">
                        <h5 class="font-size-15 mb-1">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-circle text-success align-middle mr-1"></i>
                            Active now
                        </p>
                    </div>
                </div>
            </div>
            <div>
                <div id="msg_view">
                </div>
                <div class="p-3 chat-input-section">
                    <div class="row">
                        <div class="col">
                            <div class="position-relative">
                                <textarea id="new_msg" class="form-control" rows="2"
                                    placeholder="Enter Message"></textarea>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="submit" onclick="sentmsg()"
                                class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light"><span
                                    class="d-none d-sm-inline-block mr-2">Send</span> <i
                                    class="mdi mdi-send"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
@include('MemberArea.Pages.Messages.Includes.css')
@endsection
@section('js')
@include('MemberArea.Pages.Messages.Includes.js')
@endsection
