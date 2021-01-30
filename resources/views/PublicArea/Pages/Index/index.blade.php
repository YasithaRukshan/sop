@extends('PublicArea.Layouts.app')
@section('title', 'Home | SOP')
@section('content')

<!-- banner-section -->
@include('PublicArea.Pages.Index.Components.home')
<!-- banner-section end -->
<!-- about-section -->
@include('PublicArea.Pages.Index.Components.about')
<!-- about-section end -->
<!-- about-section -->
@include('PublicArea.Pages.Index.Components.our-process')
<!-- about-section end -->
<!-- about-section -->
@include('PublicArea.Pages.Index.Components.calculator')
<!-- about-section end -->
<!-- work-process -->
{{-- @include('PublicArea.Pages.Index.Components.vision') --}}
<!-- work-process end -->
<!-- industries-section -->
@include('PublicArea.Pages.Index.Components.faq')
<!-- industries-section end -->
@endsection


@section('css')
@include('PublicArea.Pages.Index.Includes.css')
@endsection

@push('js')
@include('PublicArea.Pages.Index.Includes.scripts')

<script>
    $(function () {
        $(document).scroll(function () {
            var $nav = $(".main-header");
            $nav.toggleClass('mbnScrolled', $(this).scrollTop() < $nav.height());
        });
    });

    //Mobile Nav Hide Show
    if ($('.mobile-menu').length) {
        //Menu Toggle Btn
        $('.navigation').on('click', function () {
            $('body').removeClass('mobile-menu-visible');
        });
    }

</script>
<script>
    var xlocation = location.hash;
    if (xlocation) {
        location.href = '#'
        const href = xlocation;
        const offsetTop = document.querySelector(href).offsetTop - 100;
        scroll({
            top: offsetTop,
            behavior: "smooth"
        });
    }

    const links = document.querySelectorAll(".nav-to");

    for (const link of links) {
        link.addEventListener("click", clickHandler);
    }

    function clickHandler(e) {
        e.preventDefault();
        const href = this.getAttribute("href");
        const offsetTop = document.querySelector(href).offsetTop - 100;
        scroll({
            top: offsetTop,
            behavior: "smooth"
        });
    }

</script>
@endpush
