@extends ('backend.layouts.app')

@section ('title', trans('gallery::labels.backend.galleries.management'))

@section('after-styles')
    {!! Html::style('/js/backend/plugin/dropzone/basic.min.css') !!}
    {!! Html::style('/js/backend/plugin/dropzone/dropzone.min.css') !!}

    <style type="text/css">
    .dz-image img 
    {
        width: 100%;
        height:100%;
    }
    </style>
@stop

@section('page-header')
    <h1>
        {{ trans('gallery::labels.backend.galleries.management') }}
        <small>{{ trans('gallery::labels.backend.galleries.management') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $gallery->name.'\'s '.trans('gallery::labels.backend.galleries.management') }}</h3>

            <div class="box-tools pull-right">
                @include('gallery::partials.gallery-header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            {!! Form::open(['route' => ['admin.gallery.gallery_image', $gallery->id ], 'class' => 'dropzone dropzone-file-area', 'id'=>'my-awesome-dropzone' ,'files'=> true ,'role' => 'form', 'method' => 'post']) !!}
            <h3 class="sbold">Drop files here or click to upload</h3>
            {!! Form::close() !!}
        </div><!-- /.box-body -->
    </div><!--box-->
@stop

@section('after-scripts')
    {!! Html::script('/js/backend/plugin/dropzone/dropzone.min.js') !!}
    <script>
        Dropzone.options.myAwesomeDropzone = {
            init: function () {
                thisDropzone = this;
                $.get('{{ route('admin.gallery.gallery_image' , $gallery->id ) }}', function(data) {

                    $.each(data, function (key, value) {

                        var mockFile = {name: value.name , size : value.size , id : value.id };

                        thisDropzone.options.addedfile.call(thisDropzone, mockFile);

                        thisDropzone.options.thumbnail.call(thisDropzone, mockFile, value.image );
                        thisDropzone.emit("complete", mockFile);
                    });
                });

            },
            dictRemoveFileConfirmation: 'Are you sure!',

            addRemoveLinks: true,

            removedfile : function (file) {
                var id = file.id;
                $.ajax({
                    type: 'DELETE',
                    url: '{{ route('admin.gallery.gallery_image' , $gallery->id ) }}',
                    data: {
                        'id': id
                    },
                    dataType: 'json'
                });
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            }
        };
    </script>
@stop