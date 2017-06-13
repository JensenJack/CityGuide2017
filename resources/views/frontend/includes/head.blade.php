<div id="fb-root"></div>
  <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

        <header id="main-header">
            <div class="header-top">
                <div class="container">
                    
                    <div class="row">
                        <div class="col-md-2">
                            <a class="logo" href="{{ route('frontend.index') }}">
                                <img src="{{ config('app.app_setting.main_logo') }}" title="Welcome from BookMyanmarHotels." alt="Image Alternative text" title="Image Title" style="width: 100%;height: 45px;" />
                            </a>
                        </div>
                        <div class="col-md-4">
                           <marquee style="color: gold;">Welcome from BookMyanmarHotels. &nbsp This site is under maintenance.</marquee>
                        </div>
                        <div class="col-md-6">
                          

                            <div class="top-user-area clearfix">
                                <ul class="top-user-area-list list list-horizontal list-border" >
                                 

                                    @if (Auth::guest())                            
                                        <li><a href="{{ url('/login') }}">{{ trans('navs.frontend.login') }}</a></li>                
                                        <li><a href="{{ url('/register') }}">{{ trans('navs.frontend.register') }}</a></li>                    
                                    @else                                    
                                        <li style="color:orange;">
                                        <img class="origin round" src="{{ Auth::user()->photo ? Auth::user()->photo:'img/frontend/img/login.png'}}" 
                                         title="AMaze" style="width: 50px; height: 50px;" />{{ auth()->user()->name}}</li>
                                
                                        @permission('view-backend')
                                            <li>{!! link_to_route('admin.dashboard', trans('navs.frontend.user.administration')) !!}</li>
                                        @endauth

                                        <li><a href="{{ route('frontend.auth.logout') }}">{{ trans('navs.general.logout') }}</a></li>
                                        <li><a href="{{route('frontend.user.dashboard')}}" id="profile">{{trans('navs.frontend.user.profile')}}</a></li>                     
                                    @endif

                                    {{-- <li class="nav-drop"><a href="#">USD $<i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></a>
                                        <ul class="list nav-drop-menu">
                                            <li><a href="#">EUR<span class="right">€</span></a>
                                            </li>
                                            <li><a href="#">GBP<span class="right">£</span></a>
                                            </li>
                                            <li><a href="#">JPY<span class="right">円</span></a>
                                            </li>
                                            <li><a href="#">CAD<span class="right">$</span></a>
                                            </li>
                                            <li><a href="#">AUD<span class="right">A$</span></a>s
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="top-user-area-lang nav-drop">
                                        <a href="#">
                                            <img src="/img/frontend/img/flags/32/uk.png" alt="Image Alternative text" title="Image Title" />ENG<i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i>
                                        </a>
                                        <ul class="list nav-drop-menu">
                                            <li>
                                                <a title="German" href="#">
                                                    <img src="/img/frontend/img/flags/32/de.png" alt="Image Alternative text" title="Image Title" /><span class="right">GER</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a title="Japanise" href="#">
                                                    <img src="/img/frontend/img/flags/32/jp.png" alt="Image Alternative text" title="Image Title" /><span class="right">JAP</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a title="Italian" href="#">
                                                    <img src="/img/frontend/img/flags/32/it.png" alt="Image Alternative text" title="Image Title" /><span class="right">ITA</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a title="French" href="#">
                                                    <img src="/img/frontend/img/flags/32/fr.png" alt="Image Alternative text" title="Image Title" /><span class="right">FRE</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a title="Russian" href="#">
                                                    <img src="/img/frontend/img/flags/32/ru.png" alt="Image Alternative text" title="Image Title" /><span class="right">RUS</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a title="Korean" href="#">
                                                    <img src="/img/frontend/img/flags/32/kr.png" alt="Image Alternative text" title="Image Title" /><span class="right">KOR</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="nav">
                    <ul class="slimmenu pull-left" id="slimmenu">
                        <li><a href="{{ url('page/terms-conditions') }}">T&CS</a>
                        </li>
                        <li><a href="{{ url('page/faq') }}">FAQ</a>
                        </li>
                        <li><a href="{{ url('page/about_us') }}">About Us</a>
                        </li>
                       
                        <div class="col-md-8">
                             <li><a href="{{ route('frontend.index') }}">Home</a>
                            </li>

                            <li><a href="{{route('frontend.all_rooms')}}">Rooms</a>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </header>
