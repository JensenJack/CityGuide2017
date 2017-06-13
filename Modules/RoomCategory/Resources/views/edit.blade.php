@extends ('backend.layouts.app')

@section ('title', trans('roomcategory::labels.backend.roomcategory.management') . ' | ' . trans('roomcategory::labels.backend.roomcategory.edit'))

@section('page-header')
    <h1>
        {{ trans('roomcategory::labels.backend.roomcategory.management') }}
        <small>{{ trans('roomcategory::labels.backend.roomcategory.edit') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::model($roomcategory, ['route' => ['admin.roomcategory.update', $roomcategory], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-roomcategory']) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('roomcategory::labels.backend.roomcategory.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('roomcategory::partials.header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">

           <div class="form-group">
                    {{ Form::label('name', trans('roomcategory::labels.backend.roomcategory.table.name'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('roomcategory::labels.backend.roomcategory.table.name')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('description', trans('roomcategory::labels.backend.roomcategory.table.description'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => trans('roomcategory::labels.backend.roomcategory.table.description')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.roomcategory.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
                </div><!--pull-left-->

                <div class="pull-right">
                    {{ Form::submit(trans('buttons.general.crud.edit'), ['class' => 'btn btn-success btn-xs']) }}
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->

    {{ Form::close() }}
@stop