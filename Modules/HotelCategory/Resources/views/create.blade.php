@extends ('backend.layouts.app')

@section ('title', trans('hotelcategory::labels.backend.hotelcategory.management') . ' | ' . trans('hotelcategory::labels.backend.hotelcategory.create'))

@section('page-header')
    <h1>
        {{ trans('hotelcategory::labels.backend.hotelcategory.management') }}
        <small>{{ trans('hotelcategory::labels.backend.hotelcategory.create') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.hotelcategory.store', 'class' => 'form-horizontal', 'files' => true ,'role' => 'form', 'method' => 'post', 'id' => 'create-hotelcategory']) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('hotelcategory::labels.backend.hotelcategory.create') }}</h3>

                <div class="box-tools pull-right">
                    @include('hotelcategory::partials.header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
             
                <div class="form-group">
                    {{ Form::label('name', trans('hotelcategory::labels.backend.hotelcategory.table.name'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('hotelcategory::labels.backend.hotelcategory.table.name')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('description', trans('hotelcategory::labels.backend.hotelcategory.table.description'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => trans('hotelcategory::labels.backend.hotelcategory.table.description')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
		

            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.hotelcategory.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
                </div><!--pull-left-->

                <div class="pull-right">
                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success btn-xs']) }}
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->

    {{ Form::close() }}
@stop