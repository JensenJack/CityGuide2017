@extends ('backend.layouts.app')

@section ('title', trans('hotel::labels.backend.hotel.management') . ' | ' . trans('hotel::labels.backend.hotel.create'))

@section('page-header')
    <h1>
        {{ trans('hotel::labels.backend.hotel.management') }}
        <small>{{ trans('hotel::labels.backend.hotel.create') }}</small>
    </h1>
@endsection

@section('after-styles')
    <link rel="stylesheet" type="text/css" href="/css/backend/plugin/bootstrap-summernote/summernote.css">
@endsection

@section('content')
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('hotel::labels.backend.hotel.create') }}</h3>

                <div class="box-tools pull-right">
                    @include('hotel::partials.header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body form">
                <?php 
                    if(old('tab')) $tab=old('tab');
                    elseif(isset($_GET['tab'])) $tab=$_GET['tab'];
                    else $tab='location';
                ?>

                {{ Form::open(['route' => 'admin.hotel.store', 'class' => 'form-horizontal', 'files' => true ,'role' => 'form', 'method' => 'post', 'id' => 'create-hotel']) }}
                            
                    {!! Form::hidden('tab',$tab) !!}

                    <div class="form-group">
                        <br>{{ Form::label('name', trans('hotel::labels.backend.hotel.table.name'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-10">
                            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('hotel::labels.backend.hotel.table.name')]) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('meta_keyword', trans('hotel::labels.backend.hotel.table.meta_keyword'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-10">
                            {{ Form::textarea('meta_keyword', null, ['class' => 'form-control', 'placeholder' => trans('hotel::labels.backend.hotel.table.meta_keyword')]) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('meta_description', trans('hotel::labels.backend.hotel.table.meta_description'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-10">
                            {{ Form::textarea('meta_description', null, ['class' => 'form-control', 'placeholder' => trans('hotel::labels.backend.hotel.table.meta_description')]) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->  

                    <div class="form-group">
                        {{ Form::label('phone', trans('hotel::labels.backend.hotel.table.phone'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-10">
                            {{ Form::text('phone', null, ['class' => 'form-control', 'placeholder' => trans('hotel::labels.backend.hotel.table.phone')]) }}
                        </div><!--col-lg-10-->
                    </div><!--form -->

                    <div class="form-group">
                        {{ Form::label('email', trans('hotel::labels.backend.hotel.table.email'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-10">
                            {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => trans('hotel::labels.backend.hotel.table.email')]) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('address', trans('hotel::labels.backend.hotel.table.address'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-10">
                            {{ Form::text('address', null, ['class' => 'form-control', 'placeholder' => trans('hotel::labels.backend.hotel.table.address')]) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->


                    <div class="form-group">
                        {{ Form::label('logo', trans('hotel::labels.backend.hotel.table.logo'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-10">
                            {{ Form::file('logo', null, ['class' => 'form-control', 'placeholder' => trans('hotel::labels.backend.hotel.table.logo')]) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        <br>{{ Form::label('hotel_category_id', trans('hotel::labels.backend.hotel.table.hotel_category'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-10">
                                    
                            <select class='form-control select2' name='hotel_category_id' autofocus="true">
                                <option></option>
                                @foreach($hotel_categories as $hotel_category)
                                    @if(old('hotel_category_id') == $hotel_category->id)
                                        <option value="{{ $hotel_category->id }}" selected>{{ $hotel_category->name }}</option>
                                    @else
                                        <option value="{{ $hotel_category->id }}"> {{$hotel_category->name}} </option>
                                    @endif
                                @endforeach
                            </select><br><br>
                        </div><!--col-lg-10 -->
                                
                    </div><!--form control-->



                    <div class="form-group">
                        {{ Form::label('class', trans('hotel::labels.backend.hotel.table.class'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-10">
                            {{ Form::number('class', null, ['class' => 'form-control', 'placeholder' => trans('hotel::labels.backend.hotel.table.class'), 'min' => '1', 'max' => '5']) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->


                    <div class="form-group">
                        {{ Form::label('description', trans('hotel::labels.backend.hotel.table.description'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-10">
                            {{ Form::textarea('description', null, ['class' => 'form-control editor', 'placeholder' => trans('hotel::labels.backend.hotel.table.description')]) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->
            
                    <label for="option" class="col-lg-2 control-label tab_label">{{ucfirst($tab)}}</label>

                    <div class="col-md-offset-2 tabbable-line">
                        <div class="panel with-nav-tabs panel-default">
                            <div class="panel-heading" style="padding: 5px 5px 0 5px;">
                                    <ul class="nav nav-tabs">
                                        <li class="{{ ($tab=='location')?'active':'' }}"><a href="#location" data-toggle="tab">Location</a></li>
                                        <li class="{{ ($tab=='amenities')?'active':'' }}"><a href="#amenities" data-toggle="tab">Amenities</a></li>
                                        {{-- <li class="dropdown">
                                            <a href="#" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#tab4default" data-toggle="tab">Default 4</a></li>
                                                <li><a href="#tab5default" data-toggle="tab">Default 5</a></li>
                                            </ul>
                                        </li> --}}
                                    </ul>
                            </div>

                            <div class="tab-content">

                                <!-- location tab panel -->
                                <div class="tab-pane {{ ($tab=='location')?'active':'' }}" id="location">
                                    <div class="col-md-offset-1">
                                        <div class="form-group">
                                            <br>{{ Form::label('city_id', trans('hotel::labels.backend.hotel.table.city'), ['class' => 'col-lg-1']) }}

                                            <div class="col-lg-10">
                                                <select class='form-control select2' name='city_id'>
                                                <option></option>
                                                @foreach($cities as $city)
                                                    @if(old('city_id') == $city->id)
                                                        <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                                                    @else
                                                    <option value="{{ $city->id }}"> {{ $city->name }} </option>
                                                @endif
                                                @endforeach
                                                </select><br>
                                            </div><!--col-lg-10-->
                                        </div><!--form control-->

                                        <input id="pac-input" class="controls" type="text" placeholder="Search Place">

                                        <div class="form-group">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-8">
                                                <div id="map-canvas"
                                                     style="width:97%;height:400px;">
                                                    
                                                 </div>
                                                <div id="ajax_msg"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                        {{ Form::label('latitude', trans('hotel::labels.backend.hotel.table.latitude'), ['class' => 'col-lg-1']) }}

                                            <div class="col-lg-10">
                                            {{ Form::text('latitude', null, ['class' => 'form-control','id'=>'input-latitude','placeholder' => trans('hotel::labels.backend.hotel.table.latitude')]) }}<br>
                                            </div><!--col-lg-10-->
                                        </div><!--form control-->

                                        <div class="form-group">
                                        {{ Form::label('longitude', trans('hotel::labels.backend.hotel.table.longitude'), ['class' => 'col-lg-1']) }}

                                            <div class="col-lg-10">
                                                {{ Form::text('longitude', null, ['class' => 'form-control','id'=>'input-longitude', 'placeholder' => trans('hotel::labels.backend.hotel.table.longitude')]) }}
                                            </div><!--col-lg-10-->
                                        </div><!--form control-->
                                    </div>
                                    
                                    
                                </div><!-- tab-pane -->

                                <!-- amenities tab panel -->
                                <div class="tab-pane {{ ($tab=='amenities')?'active':'' }}" id="amenities">
                                    <div class="col-md-offset-1">
                                        <div class="form-group">
                                            @foreach($amenities as $amenity)
                                                <div class="col-md-3">                               
                                                    <input type="checkbox"  value="{{ $amenity->id }}" id="{{$amenity->name}}" name="amenity_id[]"  
                                                        @if(old('amenity_id'))@if(in_array($amenity->id,old('amenity_id'))) checked @endif @endif>
                                                    <label for="{{$amenity->name}}" class="control-label">{{ $amenity->name }}</label>
                                                </div>
                                            @endforeach
                                            {{-- <div id="amenity_id_errors" class="col-md-12"></div> --}}
                                        </div>
                                    </div>
                                </div><!-- tab-pane -->

                            </div><!-- tab-content -->
                        </div><!-- panel -->
                    </div><!-- tabbable-line -->                                                
            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.hotel.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger']) }}
                </div><!--pull-left-->

                <div class="pull-right">
                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success']) }}
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->
    {{ Form::close() }} 
        

@stop

@section('after-scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('app.app_setting.map_key') }}&libraries=weather,geometry,visualization,places,drawing&callback=initMap" async defer></script>
<script src="/js/backend/plugin/bootstrap-summernote/summernote.min.js"></script>
    <script type="text/javascript">
        
        $(document).ready(function(){
            $('.select2').select2({ 
              placeholder:"Please Select"
            });
            
            $('.tabbable-line a').click(function(){
                $('input[name=tab]').val($(this).attr('href').replace('#',''));
                $('.tab_label').empty();
                $('.tab_label').append(ucFirst($('input[name=tab]').val()));
            });

            function ucFirst(string) {
                return string.substring(0, 1).toUpperCase() + string.substring(1).toLowerCase();
            }

            $('.editor').summernote({
                height: 300
            });
        });

        function initMap() {
            var mapOptions = {
                center: new google.maps.LatLng(16.798703652839684, 96.14947007373053),
                zoom: 13
            };
            var map = new google.maps.Map(document.getElementById('map-canvas'),
                    mapOptions);

            var marker_position = new google.maps.LatLng(16.798703652839684, 96.14947007373053);
            var input = /** @type {HTMLInputElement} */(
                    document.getElementById('pac-input'));

            var types = document.getElementById('type-selector');
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);

            var infowindow = new google.maps.InfoWindow();
            var marker = new google.maps.Marker({
                position: marker_position,
                draggable: true,
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
            });


            google.maps.event.addListener(marker, "mouseup", function (event) {
                $('#input-latitude').val(this.position.lat());
                $('#input-longitude').val(this.position.lng());
            });

            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                infowindow.close();
                marker.setVisible(false);
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }

                marker.setIcon(/** @type {google.maps.Icon} */({
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(35, 35)
                }));

                marker.setPosition(place.geometry.location);
                marker.setVisible(true);

                $('#input-latitude').val(place.geometry.location.lat());
                $('#input-longitude').val(place.geometry.location.lng());

                // var address = '';
                // if (place.address_components) {
                //     address = [
                //         (place.address_components[0] && place.address_components[0].short_name || ''),
                //         (place.address_components[1] && place.address_components[1].short_name || ''),
                //         (place.address_components[2] && place.address_components[2].short_name || '')
                //     ].join(' ');
                // }

                // $('input[name=address]').val(place.formatted_address);

                // infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                infowindow.open(map, marker);
            });


            google.maps.event.addListener(marker, 'dragend', function() {

                $('#input-latitude').val(place.geometry.location.lat());
                $('#input-longitude').val(place.geometry.location.lng());

            });

        }

        if ($('#map-canvas').length != 0) {
            google.maps.event.addDomListener(window, 'load', initMap);
        }
    </script>
@stop