<footer id="main-footer">
            <div class="container">
                <div class="row row-wrap">
                    <div class="col-md-4">
                        <a class="logo" href="{{ route('frontend.index') }}">
                            <img src="{{ config('app.app_setting.main_logo') }}" title="Welcome from BookMyanmarHotels." alt="Image Alternative text" title="Image Title" style="width: 100%;height: 100px;" />
                        </a>
                        <p class="mb20">Booking, reviews and advices on hotels and lots more!</p>
                        <ul class="list list-horizontal list-space">
                            <li>
                                <a class="fa fa-facebook box-icon-normal round animate-icon-bottom-to-top" href="#"></a>
                            </li>
                            <li>
                                <a class="fa fa-twitter box-icon-normal round animate-icon-bottom-to-top" href="#"></a>
                            </li>
                            <li>
                                <a class="fa fa-google-plus box-icon-normal round animate-icon-bottom-to-top" href="#"></a>
                            </li>
                            <li>
                                <a class="fa fa-linkedin box-icon-normal round animate-icon-bottom-to-top" href="#"></a>
                            </li>
                            <li>
                                <a class="fa fa-pinterest box-icon-normal round animate-icon-bottom-to-top" href="#"></a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3">
                         <h3 class="title-color">Link</h3>
                        <ul class="list list-footer">
                            <li><a href="{{ route('frontend.index') }}"><i class="fa fa-link"></i>Home</a>
                            </li>
                            <li><a href="{{ route('frontend.all_rooms') }}"><i class="fa fa-link"></i>Rooms</a>
                            </li>
                            <li><a href="{{ url('page/about_us') }}"><i class="fa fa-link"></i>About US</a>
                            </li>
                            <li><a href="{{ url('page/terms-conditions') }}"><i class="fa fa-link"></i>T&CS</a>
                            </li>
                             <li><a href="{{ url('page/faq') }}"><i class="fa fa-link"></i>FAQ</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h4>Have Questions?</h4>
                        <h4 class="text-color"><i class="fa fa-phone" style="color: white;"></i> &nbsp {{ config('app.app_setting.phone') }}</h4>
                        <h4><a href="#" class="text-color"> <i class="fa fa-envelope" style="color: white;"></i> &nbsp {{ config('app.app_setting.email') }}</a></h4>
                        <h4 class="text-color"> <i class="fa fa-map-marker" style="color: white;"></i>&nbsp {{ config('app.app_setting.address') }}</h4>
                        {{-- <p>24/7 Dedicated Customer Support</p> --}}
                        
                    </div>

                </div>
            </div>
        </footer>