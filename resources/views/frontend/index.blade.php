@extends('frontend.layouts.app')

@section('after-styles')

    <!-- BODY START-->
    <style type="text/css">
        .error{
            color: red;
        }        
    </style>
@endsection

@section('content')
    

        <!-- TOP AREA -->
        <div class="top-area show-onload">
            <div class="bg-holder full">
                <div class="bg-img" style="background-image:url(img/frontend/img/Balloons-Bagan-Burma.jpeg);"></div>

                <!-- Search Panel -->
                <div class="bg-front full-height">
                    <div class="container rel full-height">
                        <div class="search-tabs search-tabs-bg search-tabs-bottom">
                            <div class="tabbable">

                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab-1">
                                        <h2>Search and Save on Hotels</h2>
                                        <form action="{{ route('frontend.find_rooms') }}" method="get" id="find_room">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon"></i>
                                                        <label>Where are you going?</label>
                                                        <input class="typeahead form-control" placeholder="City or Hotel Name" type="text" name="city_or_hotel" />
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="input-daterange" data-date-format="M d, D">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                    <label>Check-in</label>
                                                                    <input class="form-control" name="start" type="text" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                                    <label>Check-out</label>
                                                                    <input class="form-control" name="end" type="text" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group form-group-lg form-group-select-plus">
                                                                    <label>Rooms</label>
                                                                    <div class="btn-group btn-group-select-num" data-toggle="buttons">
                                                                        <label class="btn btn-primary active">
                                                                            <input type="radio" value="1" />1</label>
                                                                        <label class="btn btn-primary">
                                                                            <input type="radio" value="2" />2</label>
                                                                        <label class="btn btn-primary">
                                                                            <input type="radio" value="3" />3</label>
                                                                        <label class="btn btn-primary">
                                                                            <input type="radio" value="4" />3+</label>
                                                                    </div>
                                                                    <select name="room_qty" class="form-control hidden">
                                                                        <option value="1" selected>1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="7">7</option>
                                                                        <option value="8">8</option>
                                                                        <option value="9">9</option>
                                                                        <option value="10">10</option>
                                                                        <option value="11">11</option>
                                                                        <option value="12">12</option>
                                                                        <option value="13">13</option>
                                                                        <option value="14">14</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group form-group-lg form-group-select-plus">
                                                                    <label>Guests</label>
                                                                    <div class="btn-group btn-group-select-num" data-toggle="buttons">
                                                                        <label class="btn btn-primary active">
                                                                            <input type="radio" value="1" />1</label>
                                                                        <label class="btn btn-primary">
                                                                            <input type="radio" value="2" />2</label>
                                                                        <label class="btn btn-primary">
                                                                            <input type="radio" value="3" />3</label>
                                                                        <label class="btn btn-primary">
                                                                            <input type="radio" value="4" />3+</label>
                                                                    </div>
                                                                    <select  class="form-control hidden" name="guest_qty">
                                                                        <option value="1" selected>1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="7">7</option>
                                                                        <option value="8">8</option>
                                                                        <option value="9">9</option>
                                                                        <option value="10">10</option>
                                                                        <option value="11">11</option>
                                                                        <option value="12">12</option>
                                                                        <option value="13">13</option>
                                                                        <option value="14">14</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="form-group form-group-lg form-group-select-plus">
                                                    <label>Guest Type</label><br>
                                                    <div class="radio-inline radio-small">
                                                        <label>
                                                            <input class="i-radio" type="radio" name="guest_type" value="foreigner"@if(session('guest_type') == 'foreigner') checked="checked" @endif />Foreigner
                                                        </label>
                                                    </div>
                                                    <div class="radio-inline radio-small">
                                                        <label>
                                                            <input class="i-radio" type="radio" name="guest_type" value="local"  @if(session('guest_type') == 'local') checked="checked" @elseif(session('guest_type') == null) checked="checked" @endif/>Local
                                                        </label>
                                                    </div> 
                                                </div>
                                            </div>
                                            <button class="btn btn-primary btn-lg" type="submit"><i class="fa fa-search" aria-hidden="true"></i>Search for Hotels</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div> <!-- bg-holder -->
        </div> <!-- top-area -->
        <!-- END TOP AREA  -->

    <div class="content">
        <div class="container">
            <div class="gap"></div>
            <h2 class="text-center">Available Hotels</h2>
            <div class="gap">
                <div class="row row-wrap">
                    <div id="owl-demo" class="owl-carousel">
                    @foreach($hotels as $hotel)
                            <div class="item padding-5">
                                <a class="hover-img curved" href="{{url('get_rooms_with_city/'.$hotel->id)}}" class="image-hover img-layer-title-slide-bottom-hover">
                                        <img style="height:258px;" title="Welcome from {{ $hotel->name .'('. $hotel->city->name .')' }}" src="{{url('uploads/'.$hotel->logo)}}" class="img-responsive">
                                    <div class="layer">
                                        <h4>
                                            {{ $hotel->name .'('. $hotel->city->name .')' }}
                                        </h4>
                                    </div>
                                </a>
                            </div>
                   
                    @endforeach
                    </div>
                    <div class="customNavigation">
                        <a class="btn btn-primary prev pull-left">Back</a>
                        <a class="btn btn-primary next pull-right">Next</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('after-scripts')
    <script src="{{ asset('build/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#find_room").validate({
                rules: {
                    city_or_hotel: {
                        required: true
                    },
                },
                submitHandler: function(form) {
                    form.submit();  // for demo
                }
            });
            var owl = $("#owl-demo");
            owl.owlCarousel({
              items : 4, //10 items above 1000px browser width
              itemsDesktop : [1000,3], //5 items between 1000px and 901px
              itemsDesktopSmall : [900,3], // 3 items betweem 900px and 601px
              itemsTablet: [600,2], //2 items between 600 and 0;
              itemsMobile : [450,1] // itemsMobile disabled - inherit from itemsTablet option
          });
            // Custom Navigation Events
          $(".next").click(function(){
              owl.trigger('owl.next');
            });
            $(".prev").click(function(){
              owl.trigger('owl.prev');
            });
        });
    </script>
@endsection
