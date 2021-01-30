<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" style="margin-top:40px;" id="side-menu">
        <li>
            <a href="{{route('dashboard')}}" class=" waves-effect">
                <i class="bx bx-home-circle"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="menu-title">Main Services</li>
        <li class=" {{ in_array($curr_url,['wallet.purchase','wallet.purchase.view'])?'mm-active':'' }}">
            <a href="{{ route("wallet.purchase") }}"
                class=" waves-effect {{ in_array($curr_url,['wallet.purchase','wallet.purchase.view'])?'active':'' }}">
                <i class='bx bxs-coin'></i>
                <span>Token Purchases </span>
                @include('MemberArea.Includes.Components.purchasesCount')
            </a>
        </li>
        <li
            class=" {{ in_array($curr_url,['contracts.all','contracts.create','contracts.view','wallet.production'])?'mm-active':'' }}">
            <a href="{{route('contracts.all')}}"
                class=" waves-effect {{ in_array($curr_url,['contracts.all','contracts.create','contracts.view','wallet.production'])?'active':'' }}">
                <i class='bx bx-images'></i>
                <span>Staking</span>
            </a>
        </li>
        <li class=" {{ in_array($curr_url,['wallet.withdrawals.index','wallet.withdrawals.create'])?'mm-active':'' }}">
            <a href="{{ route("wallet.withdrawals.index") }}"
                class=" waves-effect {{ in_array($curr_url,['wallet.withdrawals.index','wallet.withdrawals.create'])?'active':'' }}">
                <i class='bx bx-money'></i>
                <span>Redemptions</span>
                @include('MemberArea.Includes.Components.withdrawalsCount')
            </a>
        </li>
        <li class="menu-title">Network &amp; Support</li>
        <li
            class=" {{ in_array($curr_url,['referrals','referral.redemptions.create','referrals.transactions','referrals.logs'])?'mm-active':'' }}">
            <a href="{{route('referrals')}}"
                class=" waves-effect {{ in_array($curr_url,['referrals','referral.redemptions.create','referrals.transactions','referrals.logs'])?'active':'' }}">
                <i class="bx bx-group"></i>
                <span>Share</span>
            </a>
        </li>
        <li
            class=" {{ in_array($curr_url,['social.impact','social.view','social.redemptions.create','social.transactions'])?'mm-active':'' }}">
            <a href="{{route('social.impact')}}"
                class=" waves-effect {{ in_array($curr_url,['social.impact','social.view','social.redemptions.create','social.transactions'])?'active':'' }}">
                <i class="bx bx-book"></i>
                <span>Social Impact</span>
            </a>
        </li>
        <li class=" {{ in_array($curr_url,['knowledge-base'])?'mm-active':'' }}">
            <a href="{{route('knowledge-base')}}"
                class=" waves-effect {{ in_array($curr_url,['knowledge-base'])?'active':'' }}">
                <i class='bx bx-world'></i>
                <span>Knowledge Base</span>
            </a>
        </li>
        <li class=" {{ in_array($curr_url,['messages'])?'mm-active':'' }}">
            <a href="{{route('messages')}}" class=" waves-effect {{ in_array($curr_url,['messages'])?'active':'' }}">
                <i class='bx bx-message-minus'></i>
                <span>Admin Support</span>
            </a>
        </li>
        <li class="menu-title">Other Settings</li>
        <li class=" {{ in_array($curr_url,['profile'])?'mm-active':'' }}">
            <a href="{{route('profile')}}" class=" waves-effect {{ in_array($curr_url,['profile'])?'active':'' }}">
                <i class="bx bx-user"></i>
                <span>My Profile</span>
            </a>
        </li>
        {{-- <li class=" {{ in_array($curr_url,['settings'])?'mm-active':'' }}">
        <a href="{{route('settings')}}" class=" waves-effect {{ in_array($curr_url,['settings'])?'active':'' }}">
            <i class="bx bx-cog"></i>
            <span>Settings</span>
        </a>
        </li> --}}
    </ul>
</div>
