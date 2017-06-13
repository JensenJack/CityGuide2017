@extends ('backend.layouts.app')

@section ('title', trans('gallery::labels.backend.galleries.management') . ' | ' . trans('gallery::labels.backend.galleries.create'))

@section('page-header')
    <h1>
        {{ trans('gallery::labels.backend.galleries.management') }}
        <small>{{ trans('gallery::labels.backend.galleries.create') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.gallery.store', 'class' => 'form-horizontal', 'files' => true ,'role' => 'form', 'method' => 'post', 'id' => 'create-gallery']) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('gallery::labels.backend.galleries.create') }}</h3>

                <div class="box-tools pull-right">
                    @include('gallery::partials.gallery-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('category', trans('gallery::labels.backend.galleries.table.category'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        <select name="category_id" class="form-control" placeholder="{{ trans('gallery::labels.backend.galleries.table.category') }}">
                            <option value="">Choose Category</option>
                            @foreach($category as $cat)
                            <option value="{{ $cat->id }}" {{ ($cat->id == old('category_id'))?'selected':'' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('name', trans('gallery::labels.backend.galleries.table.name'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('gallery::labels.backend.galleries.table.name')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group">
                    {{ Form::label('type', trans('gallery::labels.backend.galleries.table.type'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        <input type="radio" class="type" checked name="type" value="image">
                        <label for="image">Image</label>
                        <input type="radio" class="type" name="type" value="video">
                        <label for="video">Video</label>
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group hide" id="video">
                    {{ Form::label('url', trans('gallery::labels.backend.galleries.table.url'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('url', null, ['class' => 'form-control', 'placeholder' => trans('gallery::labels.backend.galleries.table.url')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                <div class="form-group" id="image">
                    {{ Form::label('image', trans('gallery::labels.backend.galleries.table.image'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::file('image', null, ['class' => 'form-control', 'placeholder' => trans('gallery::labels.backend.galleries.table.image')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.gallery.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
                </div><!--pull-left-->

                <div class="pull-right">
                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success btn-xs']) }}
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->

    {{ Form::close() }}
@stop
@section('after-scripts')

<script type="text/javascript">
    $(document).ready(function() {
        $('.type').click(function(){
            var type = $(this).val();
            if(type == 'image'){
                $('#image').removeClass('hide');
                $('#video').addClass('hide');
            }
            else{
                $('#video').removeClass('hide');
                $('#image').addClass('hide');
            }
        });
    });
</script>

@stop