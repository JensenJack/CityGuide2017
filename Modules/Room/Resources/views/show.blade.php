@extends ('backend.layouts.app')

@section ('title', trans('room::labels.backend.room.management'))

@section('page-header')
    <h1>
        {{ trans('room::labels.backend.room.management') }}
        <small>{{ trans('room::labels.backend.room.management') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $room->name.'\'s '.trans('room::labels.backend.room.management') }}</h3>

            <div class="box-tools pull-right">
                @include('room::partials.header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="hotel-table" class="table table-condensed table-hover">
                    <tr>
                        <th>{{ trans('room::labels.backend.room.table.status') }}</th>
                        <td>
                            @if($room->id == 1)
                                Enabled
                            @else
                                Disabled
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>{{ trans('room::labels.backend.room.table.id') }}</th>
                        <td>{{ $room->id }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('room::labels.backend.room.table.name') }}</th>
                        <td>{{ $room->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('room::labels.backend.room.table.meta_keyword') }}</th>
                        <td>{{ $room->meta_keyword }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('room::labels.backend.room.table.hotel_name') }}</th>
                        <td>{{ $room->hotel()->first()->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('room::labels.backend.room.table.room_type') }}</th>
                        <td>{{ $room->room_category()->first()->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('room::labels.backend.room.table.meta_description') }}</th>
                        <td>{{ $room->meta_description }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('room::labels.backend.room.table.description') }}</th>
                        <td>{{ $room->description }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('room::labels.backend.room.table.local_buy_price') }}</th>
                        <td>{{ $room->local_buy_price }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('room::labels.backend.room.table.local_sell_price') }}</th>
                        <td>{{ $room->local_sell_price }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('room::labels.backend.room.table.foreign_buy_price') }}</th>
                        <td>{{ $room->foreign_buy_price }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('room::labels.backend.room.table.foreign_sell_price') }}</th>
                        <td>{{ $room->foreign_sell_price }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('room::labels.backend.room.table.agent_buy_price') }}</th>
                        <td>{{ $room->agent_buy_price }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('room::labels.backend.room.table.agent_sell_price') }}</th>
                        <td>{{ $room->agent_sell_price }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('room::labels.backend.room.table.quantity') }}</th>
                        <td>{{ $room->quantity }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('room::labels.backend.room.table.minimum_stay') }}</th>
                        <td>{{ $room->minimum_stay }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('room::labels.backend.room.table.max_adults') }}</th>
                        <td>{{ $room->max_adults }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('room::labels.backend.room.table.extra_bed') }}</th>
                        <td>{{ $room->extra_bed }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('room::labels.backend.room.table.extra_bed_charge') }}</th>
                        <td>{{ $room->extra_bed_charge }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('room::labels.backend.room.table.room_amenities') }}</th>
                        <td>@php
                                $amenities = $room->room_amenities()->get();
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
                        <th>{{ trans('room::labels.backend.room.table.room_image') }}</th>
                        <td>@php
                            $room_images = $room->room_image()->get();
                            foreach($room_images as $room_image)
                            {
                                echo "<img src='". url('uploads/'.$room_image->image) ."' style='width: 100px;height: 100px;'> ";
                            }
                            @endphp
                        </td>
                    </tr>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->

    </div><!--box-->
@stop