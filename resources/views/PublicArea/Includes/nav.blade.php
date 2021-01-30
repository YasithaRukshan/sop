  <!-- main header -->
  <header class="main-header mbnScrolled style-five home-onepage">
      <div class="header-upper">
          <div class="outer-box clearfix">
              <div class="logo-box pull-left">
                  <figure class="logo"><a href="{{route('/')}}"><img src="{{asset('PublicArea/images/logo.png')}}"
                              alt="" id="nav_logo"></a></figure>
              </div>
              <div class="menu-area pull-right clearfix">
                  <!--Mobile Navigation Toggler-->
                  <div class="mobile-nav-toggler">
                      <i class="icon-bar"></i>
                      <i class="icon-bar"></i>
                      <i class="icon-bar"></i>
                  </div>
                  <nav class="main-menu navbar-expand-md navbar-light pl-5">
                      <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                          <ul class="navigation scroll-nav clearfix">
                              @if(Request::is('/'))
                              <li><a href="#home">The Project</a></li>
                              <li><a href="#our-process">Rewards</a></li>
                              <li><a href="#faq">FAQ</a></li>
                              @else
                              <li><a href="{{ route('/')}}">The Project</a></li>
                              <li><a href="{{ route('/')}}#our-process">Rewards</a></li>
                              <li><a href="{{ route('/')}}#faq">FAQ</a></li>
                              @endif

                              @guest
                              <li class="theme-btn-li mr-0"><a href="{{route('register')}}"
                                      class="theme-btn style-one ">Join</a></li>
                              <li class="theme-btn-li"><a href="{{route('login')}}"
                                      class="theme-btn style-two ">Login</a></li>
                              @else

                              <li class=" dropdown ml-5"><a href="javascript: void(0);"
                                      data-toggle="dropdown">{{ Auth::user()->first_name }}
                                      {{ Auth::user()->last_name }}</a>
                                  <ul>
                                      <li><a href="{{ route('dashboard') }}">Dashboard<i class="flaticon-next"></i></a>
                                      </li>
                                      <li><a class="dropdown-item text-danger" href="javascript: void(0);"
                                              data-toggle="modal" data-target="#logoutModal">
                                              Logout<i class="flaticon-next"></i></a></li>
                                  </ul>
                              </li>
                              <li></li>
                              <li class="" style="margin-left: 100px !important"></li>
                              @endguest
                          </ul>
                      </div>
                  </nav>
              </div>
          </div>
      </div>

      <!--sticky Header-->
      <div class="sticky-header">
          <div class="outer-box clearfix">
              <figure class="logo-box pull-left"><a href="{{route('/')}}"><img
                          src="{{asset('PublicArea/images/logo.png')}}" alt=""></a></figure>
              <div class="menu-area pull-right">
                  <nav class="main-menu clearfix">
                      <!--Keep This Empty / Menu will come through Javascript-->
                  </nav>
              </div>
          </div>
      </div>
  </header>
  <!-- main-header end -->

  <!-- Mobile Menu  -->
  <div class="mobile-menu" id="mobile-menu-view">
      <div class="menu-backdrop"></div>
      <div class="close-btn"><i class="fas fa-times"></i></div>

      <nav class="menu-box">
          <div class="nav-logo"><a href="{{route('/')}}"><img
                      src="{{asset('PublicArea/images/logo-mini.png')}}" alt="" title=""></a></div>
          <div class="menu-outer">
              <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
          </div>
      </nav>
  </div><!-- End Mobile Menu -->

  