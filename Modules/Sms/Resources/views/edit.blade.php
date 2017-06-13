@extends ('backend.layouts.app')

@section ('title', trans('sms::labels.backend.sms.management') . ' | ' . trans('sms::labels.backend.sms.edit'))

@section('page-header')
    <h1>
        {{ trans('sms::labels.backend.sms.management') }}
        <small>{{ trans('sms::labels.backend.sms.edit') }}</small>
    </h1>
@endsection

@section('content')
    
    {{ Form::model($sms, ['route' => ['admin.sms.update', $sms], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-sms']) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('sms::labels.backend.sms.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('sms::partials.sms-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('slug', trans('sms::labels.backend.sms.table.slug'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('slug', null, ['class' => 'form-control', 'placeholder' => trans('sms::labels.backend.sms.table.slug'), 'disabled']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('ledgen', trans('sms::labels.backend.sms.table.ledgen'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('ledgen', null, ['class' => 'form-control', 'placeholder' => trans('sms::labels.backend.sms.table.ledgen')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('content', trans('sms::labels.backend.sms.table.content'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => trans('sms::labels.backend.sms.table.content')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('mm_content', trans('sms::labels.backend.sms.table.mm_content'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::textarea('mm_content', null, ['class' => 'form-control', 'placeholder' => trans('sms::labels.backend.sms.table.mm_content')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.sms.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
                </div><!--pull-left-->

                <div class="pull-right">
                    {{ Form::submit(trans('buttons.general.crud.edit'), ['class' => 'btn btn-success btn-xs']) }}
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->

    {{ Form::close() }}
@stop