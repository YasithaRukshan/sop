@extends('MemberArea.Pages.Mails.Layouts.app')
@section('content')
@include('components.email_header')
@include('components.order_placed')
@include('components.email_footer')
@endsection
