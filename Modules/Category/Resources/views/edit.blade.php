@extends ('backend.layouts.app')

@section ('title', trans('category::labels.backend.categories.management') . ' | ' . trans('category::labels.backend.categories.edit'))

@section('page-header')
    <h1>
        {{ trans('category::labels.backend.categories.management') }}
        <small>{{ trans('category::labels.backend.categories.edit') }}</small>
    </h1>
@endsection

@section('content')
    
    {{ Form::model($category, ['route' => ['admin.category.update', $category], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-category']) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('category::labels.backend.categories.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('category::partials.category-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('name', trans('category::labels.backend.categories.table.name'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('category::labels.backend.categories.table.name')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('description', trans('category::labels.backend.categories.table.description'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => trans('category::labels.backend.categories.table.description')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.category.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
                </div><!--pull-left-->

                <div class="pull-right">
                    {{ Form::submit(trans('buttons.general.crud.edit'), ['class' => 'btn btn-success btn-xs']) }}
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->

    {{ Form::close() }}
@stop