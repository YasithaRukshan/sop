<!-- main-footer -->
<footer class="main-footer">
    <div class="footer-top">
        <div class="auto-container">
            <div class="widget-section">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-6 col-sm-12 footer-column">
                        <div class="footer-widget links-widget">
                            <div class="widget-title">
                                <h3>Useful Links</h3>
                                <div class="decor"
                                    style="background-image: url('{{asset('PublicArea/images/icons/decor-3.png')}}');">
                                </div>
                            </div>
                            <div class="widget-content">
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-6 col-sm-12 column">
                                        <ul class="links clearfix">
                                            @if(Request::is('/'))
                                            <li><a href="#home" class="nav-to">The Project</a></li>
                                            <li><a href="#our-process" class="nav-to">Rewards</a></li>
                                            <li><a href="#faq" class="nav-to">FAQ</a></li>
                                            @else
                                            <li><a href="{{ route('/')}}">The Project</a></li>
                                            <li><a href="{{ route('/')}}#our-process">Rewards</a>
                                            </li>
                                            <li><a href="{{ route('/')}}#faq">FAQ</a></li>
                                            @endif
                                            <li><a href="{{route('register')}}">Join</a></li>
                                            <li><a href="{{route('oilWell.owners')}}">Oil
                                                    Well Owners</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 column">
                                        <ul class="links clearfix">
                                            <li><a href="{{route('contact')}}">Contact Us</a></li>
                                            <li><a href="{{route('about-us')}}">About Us</a></li>
                                            <li><a target="_blank"
                                                    href="{{asset('docs/SOP-WhitePaper.pdf')}}">WhitePaper</a>
                                            </li>
                                            <li><a href="{{route('privacy-policy')}}">Privacy Policy</a></li>
                                            <li><a href="{{route('terms-and-conditions')}}">Terms and Conditions</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 column">
                                        <ul class="links clearfix">

                                            <li><a href="{{route('data-security-policy')}}">Data security</a>
                                            </li>
                                            <li><a href="{{route('aml-policy')}}">AML Policy</a></li>
                                            <li><a href="{{route('kyc-policy')}}">KYC Policy</a></li>
                                            <li><a href="{{route('gdpr-disclosure')}}">GDPR Disclosure</a></li>
                                            <li><a href="{{route('risk-disclosure')}}">Risk Disclosure</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 footer-column">
                        <div class="footer-widget about-widget">
                            <div class="widget-title">
                                <h3>About Company</h3>
                                <div class="decor"
                                    style="background-image: url('{{asset('PublicArea/images/icons/decor-3.png')}}');">
                                </div>
                            </div>
                            <div class="widget-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <a href="{{ route('/') }}"
                                            style="float:left; border-right: 1px solid #878787;margin-right:10px;">
                                            <img src="{{asset('PublicArea/images/logo-mini.png')}}" width="80" alt="">
                                        </a>
                                        <p class="text-dark">Solar Oil Project is a revolutionary community driven
                                            Smart
                                            Contract DeFi
                                            application designed to harness the power of the blockchain to address
                                            one of the greatest social and ecological challenges facing us today.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom style-one">
        <div class="auto-container clearfix">
            <div class="copyright text-center">
                <p>Copyright &copy; <a href="{{route('/')}}">SOP</a>, All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer>


<!-- main-footer end -->


<!--Scroll to top-->
<button class="scroll-top scroll-to-target" data-target="html">
    <span class="fas fa-angle-up"></span>
</button>
<!-- JS  -->
