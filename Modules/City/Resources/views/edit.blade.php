@extends ('backend.layouts.app')

@section ('title', trans('city::labels.backend.city.management') . ' | ' . trans('city::labels.backend.city.edit'))

@section('page-header')
    <h1>
        {{ trans('city::labels.backend.city.management') }}
        <small>{{ trans('city::labels.backend.city.edit') }}</small>
    </h1>
@endsection

@section('content')
    
    {{ Form::model($city, ['route' => ['admin.city.update', $city], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-city']) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('city::labels.backend.city.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('city::partials.header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">

                <div class="form-group">
                    {{ Form::label('name', trans('city::labels.backend.city.table.name'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('city::labels.backend.city.table.name')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('meta_keyword', trans('city::labels.backend.city.table.meta_keyword'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::textarea('meta_keyword', null, ['class' => 'form-control', 'placeholder' => trans('city::labels.backend.city.table.meta_keyword')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('meta_description', trans('city::labels.backend.city.table.meta_description'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::textarea('meta_description', null, ['class' => 'form-control', 'placeholder' => trans('city::labels.backend.city.table.meta_description')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <input id="pac-input" class="controls" type="text" placeholder="Search Place">
                <div class="form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div id="map-canvas"
                             style="width:97%;height:400px;"></div>
                        <div id="ajax_msg"></div>
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('longitude', trans('city::labels.backend.city.table.longitude'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('longitude', null, ['class' => 'form-control','id' => 'input-longitude', 'placeholder' => trans('city::labels.backend.city.table.longitude')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                  <div class="form-group">
                    {{ Form::label('latitude', trans('city::labels.backend.city.table.latitude'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('latitude', null, ['class' => 'form-control', 'id' => 'input-latitude', 'placeholder' => trans('city::labels.backend.city.table.latitude')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
        
            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.city.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger']) }}
                </div><!--pull-left-->

                <div class="pull-right">
                    {{ Form::submit(trans('buttons.general.crud.edit'), ['class' => 'btn btn-success']) }}
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->

    {{ Form::close() }}
@stop

@section('after-scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('app.app_setting.map_key') }}&libraries=weather,geometry,visualization,places,drawing&callback=initMap"
            async defer></script>
    <script>
        function initMap() {
            var mapOptions = {
                center: new google.maps.LatLng({{$city->latitude}}, {{$city->longitude}}),
                zoom: 13
            };
            var map = new google.maps.Map(document.getElementById('map-canvas'),
                    mapOptions);

            var marker_position = new google.maps.LatLng({{$city->latitude}}, {{$city->longitude}});
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

                var address = '';
                if (place.address_components) {
                    address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }

                // $('input[name=address]').val(place.formatted_address);

                infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
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