@extends ('backend.layouts.app')

@section ('title', trans('hotelcategory::labels.backend.hotelcategory.management'))

@section('page-header')
    <h1>
        {{ trans('hotelcategory::labels.backend.hotelcategory.management') }}
        <small>{{ trans('hotelcategory::labels.backend.hotelcategory.management') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ hotelcategory.'\'s '.trans('hotelcategory::labels.backend.hotelcategory.management') }}</h3>

            <div class="box-tools pull-right">
                @include('hotelcategory::partials.header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            


        </div><!-- /.box-body -->
    </div><!--box-->
@stop