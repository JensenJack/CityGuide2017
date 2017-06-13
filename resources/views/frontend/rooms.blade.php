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
        <div class="container">
            <div class="mfp-with-anim mfp-hide mfp-dialog mfp-search-dialog" id="search-dialog">
                <h3>Search for Hotel</h3>
                <form action="{{ route('frontend.find_rooms') }}" method="get" id="find_room">
                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon input-icon-highlight"></i>
                        <label>Where are you going?</label>
                        <input class="typeahead form-control" placeholder="City or Hotel Name" type="text" name="city_or_hotel" />
                    </div>
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
                            <div class="col-md-3">
                                <div class="form-group form-group-lg form-group-select-plus">
                                    <label>Guest Type</label><br>
                                    <div class="radio-inline radio-small">
                                        <label>
                                                <input class="i-radio" type="radio" name="guest_type" value="foreigner" @if(session('guest_type') == 'foreigner') checked="checked" @endif />Foreigner
                                        </label>
                                    </div>
                                    <div class="radio-inline radio-small">
                                        <label>
                                            <input class="i-radio" type="radio" name="guest_type" value="local" checked="checked" @if(session('guest_type') == 'local') checked="checked" @elseif(session('guest_type') == null) checked="checked" @endif/>Local
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-lg" type="submit"><i class="fa fa-search" aria-hidden="true"></i>Search for Hotels</button>
                </form>
            </div>
            <h3 class="booking-title">
                    {{ $rooms->total() }} rooms in 
                        {{count($old_hotels)}}
                    {{-- in {{ session('city') }} on {{ session('check_in') }} - {{ session('check_out') }} --}}{{-- for {{ session('guest_qty') }} --}} 
                    hotel for your searching.
                <a class="popup-text pull-right btn btn-danger" href="#search-dialog" data-effect="mfp-zoom-out"><i class="fa fa-search" aria-hidden="true"></i>Change Search</a>
            </h3>
            <div class="row">
                <div class="col-md-3">
                    <aside class="booking-filters text-white">
                        {{-- @if(count($rooms)) --}}
                            <form action="{{ route('frontend.search_rooms') }}" method="get">
                                <h3>Filter By:</h3>
                                <ul class="list booking-filters-list">
                                    <!--Prices-->
                                    <li>
                                        <h5 class="booking-filters-title">Price(MMK)</h5>
                                        <input type="text" id="price-slider" name="price">
                                    </li>

                                    <!--Hotel Amenities-->
                                    <li>
                                        <h5 class="booking-filters-title">Hotel Amenities</h5>
                                        @foreach($amenities as $amenity)
                                            @if (in_array($amenity->id, $hotel_amenities_id))
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value="{{ $amenity->id }}"@if(isset($old_hotel_amenities))) @if(in_array($amenity->id,$old_hotel_amenities)) checked @endif @endif name="hotel_amenities[]"  class="i-check hotel_amenities" /> 
                                                        @php
                                                            $counts = array_count_values($hotel_amenities_id);
                                                            echo $amenity->name;
                                                        @endphp
                                                    </label>
                                                </div>
                                            @endif                                        
                                        @endforeach
                                    </li>

                                    <!--Room Amenities-->
                                    <li>
                                        <h5 class="booking-filters-title">Room Amenities</h5>
                                        @foreach($amenities as $amenity)
                                            @if (in_array($amenity->id, $room_amenities_id))
                                                <div class="checkbox">                                                    
                                                    <label>
                                                        <input type="checkbox" value="{{ $amenity->id }}"@if(isset($old_room_amenities))) @if(in_array($amenity->id,$old_room_amenities)) checked @endif @endif name="room_amenities[]"  class="i-check room_amenities" /> 
                                                        @php
                                                        $counts = array_count_values($room_amenities_id);
                                                        echo $amenity->name;
                                                        @endphp
                                                    </label>                                                
                                                </div>
                                            @endif   
                                        @endforeach                                
                                    </li>

                                    <!--Hotels-->
                                    <li>
                                        <h5 class="booking-filters-title">Hotels</h5>
                                        @foreach($hotels as $hotel)
                                            <div class="checkbox">
                                                <label>
                                                    <input class="i-check hotel" type="checkbox" value="{{$hotel->id}}"
                                                    @if(isset($old_hotels))) @if(in_array($hotel->id,$old_hotels)) checked @endif @endif 
                                                    name="hotel_names[]" />{{$hotel->name}} ({{$hotel->city->name}})
                                                </label>
                                            </div>
                                        @endforeach
                                    </li>
                                </ul><br>
                                <input type="submit" value="Search" class="btn btn-primary">                                    
                            </form>
                            <!-- Filter End -->
                    </aside>
                </div>
                <div class="col-md-9">
                    <ul class="booking-list">
                        @if($errors->any())
                            <h4>{{$errors->first()}}</h4>
                        @endif
                        @foreach($rooms as $room)
                            <li>
                                <a class="booking-item" href="{{route('frontend.room_details', $room->id)}}" disabled="disabled">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="booking-item-img-wrap">
                                                <img src="{{ url('uploads/'.$room->hotel->logo) }}" alt="Image Alternative text" title="{{$room->hotel->name}} Hotel" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="booking-item-rating">
                                                <ul class="icon-group booking-item-rating-stars"></ul>
                                            </div>
                                            <h5 class="booking-item-title">
                                                - {{$room->name}} Room<br>
                                                - {{$room->hotel->name}} Hotel ({{$room->hotel->city->name}})<br>
                                                @if($room->available_qty >0)
                                                    - {{ $room->available_qty }} Rooms Avaliable!
                                                @else
                                                    - All Rooms are sold out!
                                                @endif
                                            </h5>
                                            <p class="booking-item-address"><i class="fa fa-map-marker"></i>{{ $room->hotel->address }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            Local - {{$room->local_sell_price}} MMK<br>
                                            Foreigner - {{$room->foreign_sell_price}} MMK<br>
                                            <form action="{{ url('/booking/'.$room->id) }}" method="get">
                                                {{ csrf_field() }}
                                                @if($room->available_qty == 0)
                                                    <button class="btn btn-warning" disabled="disabled">Sold Out</button>
                                                @else
                                                    <button class="btn btn-primary book-now" type="submit"><i class="fa fa-book" aria-hidden="true"></i>Book Now</button>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="row">
                        <div class="col-md-6">
                            <p><small>{{ $rooms->total() }} rooms in {{count($old_hotels)}} hotel. &nbsp;&nbsp;Showing {{($rooms->currentPage()-1)* $rooms->perPage() + 1}} – 
                               @if($rooms->currentPage() == $rooms->lastPage()) 
                                    {{$rooms->total()}}
                               @else
                                    {{ ($rooms->currentPage()-1)* $rooms->perPage() + $rooms->perPage() }}
                                @endif
                            </small></p>
                            {{ $rooms->links() }}
                        </div>
                        <div class="col-md-6 text-right">
                            <p>Not what you're looking for? <a class="popup-text" href="#search-dialog" data-effect="mfp-zoom-out">Try your search again</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="gap"></div>
            {{-- </div> --}}        
        </div><!-- container-->

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
        });
    </script>
@stop