@extends ('backend.layouts.app')

@section ('title', trans('city::labels.backend.city.management'))

@section('page-header')
    <h1>
        {{ trans('city::labels.backend.city.management') }}
        <small>{{ trans('city::labels.backend.city.management') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $city.'\'s '.trans('city::labels.backend.city.management') }}</h3>

            <div class="box-tools pull-right">
                @include('city::partials.header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            


        </div><!-- /.box-body -->
    </div><!--box-->
@stop