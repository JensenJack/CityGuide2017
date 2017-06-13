@extends ('backend.layouts.app')

@section ('title', trans('booking::labels.backend.booking.management') . ' | ' . trans('booking::labels.backend.booking.edit'))

@section('page-header')
    <h1>
        {{ trans('booking::labels.backend.booking.management') }}
        <small>{{ trans('booking::labels.backend.booking.edit') }}</small>
    </h1>
@endsection

@section('content')
    
    {{ Form::model($booking, ['route' => ['admin.booking.update', $booking], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-booking']) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('booking::labels.backend.booking.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('booking::partials.header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
                
                <div class="form-group">
                    {{ Form::label('user_id', trans('booking::labels.backend.booking.table.name'), ['class' => 'col-lg-2 control-label']) }}

                    <select>
                        
                    </select>
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('guest_name', trans('booking::labels.backend.booking.table.description'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::textarea('guest_name', null, ['class' => 'form-control', 'placeholder' => trans('booking::labels.backend.booking.table.description')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.booking.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
                </div><!--pull-left-->

                <div class="pull-right">
                    {{ Form::submit(trans('buttons.general.crud.edit'), ['class' => 'btn btn-success btn-xs']) }}
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->

    {{ Form::close() }}
@stop