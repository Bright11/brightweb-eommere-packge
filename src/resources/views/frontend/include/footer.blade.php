
    <!-- footer -->

    <section class="footer-section">
        <footer class="footer">
            <div class="newsletter">
        
                <div class="newsletter_note">
                    <div class="newsletter_title">
                        <h1>Newsletter</h1>
                        <p>Subscribe to our newsletter</p>
                    </div>
                    <form action="" class="newsletter_form">
                        <div class="newsletter_input">
                            <input type="text" placeholder="Enter your email">
                        </div>
                        <div class="newsletter_button">
                            <button><i class="fa fa-send" style="font-size:24px"></i></button>
                        </div>
                    </form>
                    <div class="social_media">
                        <div class="social_media_icons">
                            <a href="{{ $social_links->facebook }}"><i class="fa fa-facebook-f" style="font-size:36px"></i></a>
                            <a href="{{ $social_links->linkedin }}"><i class="fa fa-linkedin-square" style="font-size:36px"></i></a>
                            <a href="{{ $social_links->twitter }}"><i class="fa fa-twitter-square" style="font-size:36px"></i></a>
                            <a href="{{ $social_links->youtube }}"><i class="fa fa-youtube" style="font-size:36px"></i></a>
                            <a href="{{ $social_links->instagram }}"><i class="fa fa-instagram" style="font-size:36px"></i></a>
    
                    </div>
                </div>
            </div>
            <div class="footer_links">
                <div class="logo_footer">
                    <img src="{{ asset("seo/$metaseo->site_logo") }}" alt="Logo">
                    <h1>{{ $metaseo->site_title }}</h1>
        
                </div>
                <div class="useful_links">
                    <div class="useful_links_title">
                        <h1>Useful Links</h1>
                    </div>
                       <ul class="footer_ul">
                         <li><a href="#">Home</a></li>
                         <li><a href="#">About</a></li>
                         <li><a href="#">Services</a></li>
                         <li><a href="#">Contact</a></li>
                         {{-- <li><a href="#">Blog</a></li>
                         <li><a href="#">Testimonials</a></li> --}}
                        
                       </ul>
                </div>
                <div class="useful_links">
                    <div class="useful_links_title">
                        <h1>Useful Links</h1>
                    </div>
                    <ul class="footer_ul">
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Pricing</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    {{-- <li><a href="#">Cookie Policy</a></li>
                    <li><a href="#">Affiliate Program</a></li> --}}
                    </ul>
                </div>
                <div class="contact_footer">
                    <div class="pox_address">
                        <p>{{ $social_links->box_address }}</p>
                       
                        <p>Tel: <i class="fa fa-phone" style="font-size:24px"></i>{{ $social_links->phone_number }}</p>
                        {{-- <p>Fax: +233538260666</p> --}}
        
                    </div>
        
                </div>
            </div>
            @php
                $year=date('Y');
            @endphp
            <p class="copyright">©{{ $year }} {{ $metaseo->site_title }}. All Rights Reserved</p>
          </footer>
        
    </section>



    

    {{-- <script src="{{ route('brightweb.frontendjs', ['filename' => 'translator.js']) }}"></script> --}}
    <script src="{{ asset("vendor/brightweb/frontendjs/translator.js") }}"></script>


    {{-- <script src="{{ route('brightweb.frontendjs', ['filename' => 'details.js']) }}"></script> --}}
    <script src="{{ asset("vendor/brightweb/frontendjs/details.js") }}"></script>


    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    {{-- <script src="{{route("brightweb.frontendjs",['filename'=>'nav.js'])}}"></script> --}}
    <script src="{{ asset("vendor/brightweb/frontendjs/nav.js") }}"></script>


    {{-- <script src="{{route("brightweb.frontendjs",['filename'=>'jquery.js'])}}"></script> --}}
    <script src="{{ asset("vendor/brightweb/frontendjs/jquery.js") }}"></script>


    {{-- <script src="{{route("brightweb.frontendjs",['filename'=>'carousel.min.js'])}}"></script> --}}
    <script src="{{ asset("vendor/brightweb/frontendjs/carousel.min.js") }}"></script>
    {{-- <script src="{{route("brightweb.frontendjs",['filename'=>'owlslider.js'])}}"></script> --}}
    <script src="{{ asset("vendor/brightweb/frontendjs/owlslider.js") }}"></script>


    
</body>
</html>