@extends('frontend.layouts.app')

@section('content')
	<div class="container">
		<div class="booking-item-details">

			<header class="booking-item-header">
                <div class="row">
                    <div class="col-md-9">
                        <h2 class="lh1em">{{ $room->hotel->name }}</h2>
                        <p class="lh1em text-small"><i class="fa fa-map-marker"></i> {{ $room->hotel->address }} </p>

                        <ul class="list list-inline text-small">
                            <li><a href="#"><i class="fa fa-envelope"></i> {{ $room->hotel->email }} </a>
                            </li>
                            <li><a href="#"><i class="fa fa-home"></i> Hotel Website</a>
                            </li>
                            <li><i class="fa fa-phone"></i>{{ $room->hotel->phone }} </li>
                        </ul>
                    </div>
                </div>
            </header>

            <!--Hotel Detail-->
            <div class="row">
                <div class="col-md-6">
                    <div class="tabbable booking-details-tabbable">
                        <ul class="nav nav-tabs">
                            <li><a href="#h_images" data-toggle="tab"><i class="fa fa-camera"></i>Photos</a>
                            </li>
                            <li class="active"><a href="#my-google-map" data-toggle="tab"><i class="fa fa-map-marker"></i>On the Map</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade" id="h_images">
                                <div class="fotorama" data-allowfullscreen="true" data-nav="thumbs">	
                                    @if(count($images)>0)
	                                    @foreach($images as $image)
	                                    	<img src="{{ url('uploads/'.$image) }}" alt="Image Alternative text" />
	                                        @endforeach
	                                    @else
	                                	<p>There is no photo to show!</p>
	                                @endif
                                </div>
                            </div>
                            <div class="tab-pane fade in active" id="my-google-map">
                                <div id="map" style="width:100%; height:500px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
				<div class="col-md-6">
                    <div class="booking-item-meta">
                        <h4 class="lh1em mt40">Hotel Description</h4>
                        <p class="mb30">{!! $room->hotel->description !!}</p>                         
                        @if(count($hotel_amenities)>0)
                        	<h4 class="lh1em mt40">Hotel Amenities</h4>
	                        <ul class="booking-item-features booking-item-features-expand mb30 clearfix">
	                            @foreach($hotel_amenities as $hotel_amenity)
									<li> - {{$hotel_amenity}}</li>
		                        @endforeach
							</ul>	                        
	                    @endif
					</div>
                </div>

            </div><hr><!--row-->

            <div class="row">
            	<div class="col-md-12">
					<div class="gap gap-small"></div>
                        <ul class="booking-list">
                            <li>
                                <a class="booking-item">
                                    <div class="row">
                                        <div class="col-md-4">

                                            <h5 class="booking-item-title"><strong>{{ $room->name }}</strong> ( {{$room->room_category->name}} Room )</h5>
                                            <p class="text-small">{!! $room->description !!}</p>
                                            <ul class="booking-item-features booking-item-features-sign clearfix">
                                            	<li rel="tooltip" data-placement="top" title="Adults Occupancy"><i class="fa fa-male"></i><span class="booking-item-feature-sign">x {{$room->max_adults}}</span>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Extra Beds"><i class="fa fa-bed"></i><span class="booking-item-feature-sign">x {{$room->extra_bed}}</span>
                                                </li>
                                                <li rel="tooltip" data-placement="top" title="Extra Bed Charge"><i class="fa fa-money"></i><span class="booking-item-feature-sign">{{ $room->extra_bed_charge }}MMK</span>
                                                </li>
                                            </ul>                                            
                                            <h5><strong>
                                                @if($room->available_qty >0)
                                                    {{ $room->available_qty }} Rooms Avaliable!
                                                @else
                                                    All Rooms are sold out!
                                                @endif
                                            </strong></h5>
                                        </div>
                                        <div class="col-md-4">                                            
                                            <h5><strong>Room Amenities</strong></h5>
                                            @if(count($room_amenities))
                                                @foreach($room_amenities as $room_amenity)
                                                    - {{$room_amenity}}<br>
                                                @endforeach
                                            @else
                                                There is no amenity to show!
                                            @endif
                                        </div>
                                        <div class="col-md-4">
											Local - {{$room->local_sell_price}} MMK<br><br>
                                            Foreigner - {{$room->foreign_sell_price}} MMK<br><br>
                                            <form action="{{url('/booking/'. $room->id)}}">
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
						</ul>
                    </div>
                </div>
            </div><!--row-->

		</div><!--booking-item-details-->
	</div><br><!--container-->
@endsection

@section('after-scripts')
	{{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('app.app_setting.map_key') }}&callback=initMap"></script> --}}
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('app.app_setting.map_key') }}&libraries=weather,geometry,visualization,places,drawing&callback=initMap" async defer></script>
	<script>
			function initMap() {
		        var uluru = {lat: {{$room->hotel->latitude }}, lng: {{$room->hotel->longitude}} };
		        var map = new google.maps.Map(document.getElementById('map'), {
		          zoom: 15,
		          center: uluru,
                  mapTypeId: google.maps.MapTypeId.ROADMAP
		        });
                       
		        var marker = new google.maps.Marker({
		          position: uluru,
		          map: map
		        });            
		    }
                    
	</script>
@endsection