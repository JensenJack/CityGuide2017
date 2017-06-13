@extends ('backend.layouts.app')

@section ('title', trans('amenity::labels.backend.amenity.management') . ' | ' . trans('amenity::labels.backend.amenity.edit'))

@section('page-header')
    <h1>
        {{ trans('amenity::labels.backend.amenity.management') }}
        <small>{{ trans('amenity::labels.backend.amenity.edit') }}</small>
    </h1>
@endsection

@section('content')
    
    {{ Form::model($amenity, ['route' => ['admin.amenity.update', $amenity], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-amenity']) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('amenity::labels.backend.amenity.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('amenity::partials.header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">

                <div class="form-group">
                    {{ Form::label('name', trans('amenity::labels.backend.amenity.table.name'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('amenity::labels.backend.amenity.table.name')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

            
            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.amenity.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
                </div><!--pull-left-->

                <div class="pull-right">
                    {{ Form::submit(trans('buttons.general.crud.edit'), ['class' => 'btn btn-success btn-xs']) }}
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->

    {{ Form::close() }}
@stop