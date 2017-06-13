@extends ('backend.layouts.app')

@section ('title', trans('hotel::labels.backend.hotel.management'))

@section('page-header')
    <h1>
        {{ trans('hotel::labels.backend.hotel.management') }}
        <small>{{ trans('hotel::labels.backend.hotel.management') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $hotel->name.'\'s '.trans('hotel::labels.backend.hotel.management') }}</h3>

            <div class="box-tools pull-right">
                @include('hotel::partials.header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="hotel-table" class="table table-condensed table-hover">
                        <tr>
                            <th>{{ trans('hotel::labels.backend.hotel.table.id') }}</th>
                            <td>{{ $hotel->id }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('hotel::labels.backend.hotel.table.name') }}</th>
                            <td>{{ $hotel->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('hotel::labels.backend.hotel.table.meta_keyword') }}</th>
                            <td>{{ $hotel->meta_keyword }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('hotel::labels.backend.hotel.table.meta_description') }}</th>
                            <td>{{ $hotel->meta_description }}</td>
                        </tr>
                        <tr>
                            <th valign="center">{{ trans('hotel::labels.backend.hotel.table.logo') }}</th>
                            <td><img src="{{ url('uploads/'.$hotel->logo) }}" style="width: 100px;height: 100px;"></td>
                        </tr>
                        <tr>
                            <th>{{ trans('hotel::labels.backend.hotel.table.address') }}</th>
                            <td>{{ $hotel->address }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('hotel::labels.backend.hotel.table.city') }}</th>
                            <td>{{ $hotel->city()->first()->name }} </td>
                        </tr>
                        <tr>
                            <th>{{ trans('hotel::labels.backend.hotel.table.latitude') }}</th>
                            <td>{{ $hotel->latitude }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('hotel::labels.backend.hotel.table.longitude') }}</th>
                            <td>{{ $hotel->longitude }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('hotel::labels.backend.hotel.table.description') }}</th>
                            <td>{{ $hotel->description }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('hotel::labels.backend.hotel.table.phone') }}</th>
                            <td>{{ $hotel->phone }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('hotel::labels.backend.hotel.table.email') }}</th>
                            <td>{{ $hotel->email }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('hotel::labels.backend.hotel.table.class') }}</th>
                            <td>{{ $hotel->class }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('hotel::labels.backend.hotel.table.hotel_category') }}</th>
                            <td>{{ $hotel->hotel_category()->first()->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('hotel::labels.backend.hotel.table.amenities') }}</th>
                            <td>@php
                                    $amenities = $hotel->amenities()->get();
                                    if(count($amenities)){
                                        foreach($amenities as $amenity)
                                            echo $amenity->name. "<br>";
                                    }
                                    else
                                        echo "-";    
                                @endphp
                            </td>
                        </tr>
                        <tr>
                            <th>{{ trans('hotel::labels.backend.hotel.table.hotel_image') }}</th>
                            <td>@php
                                $hotel_images = $hotel->hotel_image()->get();
                                foreach($hotel_images as $hotel_image)
                                {
                                    echo "<img src='". url('uploads/'.$hotel_image->image) ."' style='width: 100px;height: 100px;'> ";
                                }
                                @endphp
                            </td>
                        </tr>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
        
    </div><!--box-->
@stop