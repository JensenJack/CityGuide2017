@extends ('backend.layouts.app')

@section ('title', trans('slider::labels.backend.sliders.management') . ' | ' . trans('slider::labels.backend.sliders.create'))

@section('page-header')
    <h1>
        {{ trans('slider::labels.backend.sliders.management') }}
        <small>{{ trans('slider::labels.backend.sliders.create') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.slider.store', 'class' => 'form-horizontal', 'files' => true ,'role' => 'form', 'method' => 'post', 'id' => 'create-slider']) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('slider::labels.backend.sliders.create') }}</h3>

                <div class="box-tools pull-right">
                    @include('slider::partials.slider-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('photo', trans('slider::labels.backend.sliders.table.photo'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::file('photo', null, ['class' => 'form-control', 'placeholder' => trans('slider::labels.backend.sliders.table.photo')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('description', trans('slider::labels.backend.sliders.table.description'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => trans('slider::labels.backend.sliders.table.description')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.slider.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
                </div><!--pull-left-->

                <div class="pull-right">
                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success btn-xs']) }}
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->

    {{ Form::close() }}
@stop