@extends ('backend.layouts.app')

@section ('title', trans('email::labels.backend.email.management') . ' | ' . trans('email::labels.backend.email.edit'))

@section('page-header')
    <h1>
        {{ trans('email::labels.backend.email.management') }}
        <small>{{ trans('email::labels.backend.email.edit') }}</small>
    </h1>
@endsection

@section('after-styles')
    <link rel="stylesheet" type="text/css" href="/css/backend/plugin/bootstrap-summernote/summernote.css">
@endsection

@section('content')
    
    {{ Form::model($email, ['route' => ['admin.email.update', $email], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-email']) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('email::labels.backend.email.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('email::partials.email-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('slug', trans('email::labels.backend.email.table.slug'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('slug', null, ['class' => 'form-control', 'placeholder' => trans('email::labels.backend.email.table.slug'),'disabled'=>'disabled']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                 <div class="form-group">
                    {{ Form::label('subject', trans('email::labels.backend.email.table.subject'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('subject', null, ['class' => 'form-control', 'placeholder' => trans('email::labels.backend.email.table.subject')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                 <div class="form-group">
                    {{ Form::label('ledgen', trans('email::labels.backend.email.table.ledgen'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('ledgen', null, ['class' => 'form-control', 'placeholder' => trans('email::labels.backend.email.table.ledgen')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">

                    {{ Form::label('content', trans('email::labels.backend.email.table.content'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::textarea('content', null, ['class' => 'form-control editor', 'placeholder' => trans('email::labels.backend.email.table.content')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                 <div class="form-group">
                    {{ Form::label('mm_subject', trans('email::labels.backend.email.table.mm_subject'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('mm_subject', null, ['class' => 'form-control', 'placeholder' => trans('email::labels.backend.email.table.mm_subject')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                 <div class="form-group">

                    {{ Form::label('mm_content', trans('email::labels.backend.email.table.mm_content'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::textarea('mm_content', null, ['class' => 'form-control editor', 'placeholder' => trans('email::labels.backend.email.table.mm_content')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.email.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger']) }}
                </div><!--pull-left-->

                <div class="pull-right">
                    {{ Form::submit(trans('buttons.general.crud.edit'), ['class' => 'btn btn-success']) }}
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->

    {{ Form::close() }}
@endsection

@section('after-scripts')
<script src="/js/backend/plugin/bootstrap-summernote/summernote.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.editor').summernote({
                height: 300
            });
        });
    </script>
@endsection
