@extends ('backend.layouts.app')

@section ('title', trans('booking::labels.backend.booking.management'))

@section('page-header')
    <h1>
        {{ trans('booking::labels.backend.booking.management') }}
        <small>{{ trans('booking::labels.backend.booking.management') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ booking.'\'s '.trans('booking::labels.backend.booking.management') }}</h3>

            <div class="box-tools pull-right">
                @include('booking::partials.header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            


        </div><!-- /.box-body -->
    </div><!--box-->
@stop