<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box" style="background-color: rgb(255, 255, 255) !important;">
                <a href="{{route('dashboard')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('MemberArea/images/logo-mini.png')}}?{{ rand(1,9999) }}" alt=""
                            class="nav-img-logo minilogo">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('MemberArea/images/logo.png')}}?{{ rand(1,9999) }}" alt=""
                            class="nav-img-logo ">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>

        <div class="d-flex">
            <livewire:nav.soax.available-soax />
            @if (Auth::user()->email_verified_at==null || Auth::user()->username==null)
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fa fa-tasks text-danger"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> <strong>Verifications</strong> </h6>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <a href="" class="text-reset notification-item">
                            @if (!(Auth::user()->email_verified_at))
                            <a class="dropdown-item" href="{{ route('puzzle-verification-view') }}">
                                <i class="bx bxs-circle bx-flashing font-size-16 align-middle mr-1 text-danger"></i>
                                Click Here To Verify Your Account
                            </a>
                            @endif
                        </a><br>
                        <a href="" class="text-reset notification-item">
                            @if (!(Auth::user()->username))
                            <a type="button" class="dropdown-item" data-toggle="modal" data-target="#UsernameModal"><i
                                    class="bx bxs-circle bx-flashing font-size-16 align-middle mr-1 text-danger"></i>
                                Update Username</a>
                            @endif
                        </a><br>
                    </div>
                </div>
            </div>
            @endif
            <div class="d-mobi-block">
                @include('MemberArea.Includes.Components.add_walletMobile')
            </div>
            <div id="msg_notification">
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon waves-effect"
                        id="page-header-notifications-dropdown" style="" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="bx bx-message-detail"></i>
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
                        <div data-simplebar style="max-height: 230px;">
                            <center>
                                <img width="50" height="50" class="img-profile rounded-circle"
                                    src="{{ asset('assets/images/avatar.png')}}">
                                <strong>
                                    <h3 class="text-center">No new messages </h3>
                                </strong>
                            </center>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ Auth::user()->profileimage?Config::get('images.access_path').'crop/'.Auth::user()->profileimage->name:asset('assets/images/avatar.png') }}"
                        alt="Profile Image" class="rounded-circle header-profile-user profile-pic">
                    <span class="d-none d-xl-inline-block ml-1">{{ Auth::user()->first_name }}
                        {{ Auth::user()->last_name }} </span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('/') }}"><i
                            class="bx bx-home font-size-16 align-middle mr-1"></i>
                        Home</a>
                    <a class="dropdown-item" href="{{ route('profile') }}"><i
                            class="bx bx-user font-size-16 align-middle mr-1"></i>
                        Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="javascript: void(0);" data-toggle="modal"
                        data-target="#logoutModal"><i
                            class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i>
                        Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>
