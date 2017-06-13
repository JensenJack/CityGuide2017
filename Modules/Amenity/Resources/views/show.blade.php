@extends ('backend.layouts.app')

@section ('title', trans('amenity::labels.backend.amenity.management'))

@section('page-header')
    <h1>
        {{ trans('amenity::labels.backend.amenity.management') }}
        <small>{{ trans('amenity::labels.backend.amenity.management') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ amenity.'\'s '.trans('amenity::labels.backend.amenity.management') }}</h3>

            <div class="box-tools pull-right">
                @include('amenity::partials.header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            


        </div><!-- /.box-body -->
    </div><!--box-->
@stop