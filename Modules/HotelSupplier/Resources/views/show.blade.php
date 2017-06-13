@extends ('backend.layouts.app')

@section ('title', trans('hotelsupplier::labels.backend.hotelsupplier.management'))

@section('page-header')
    <h1>
        {{ trans('hotelsupplier::labels.backend.hotelsupplier.management') }}
        <small>{{ trans('hotelsupplier::labels.backend.hotelsupplier.management') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ hotelsupplier.'\'s '.trans('hotelsupplier::labels.backend.hotelsupplier.management') }}</h3>

            <div class="box-tools pull-right">
                @include('hotelsupplier::partials.header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            


        </div><!-- /.box-body -->
    </div><!--box-->
@stop