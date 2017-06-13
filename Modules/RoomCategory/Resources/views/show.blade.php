@extends ('backend.layouts.app')

@section ('title', trans('roomcategory::labels.backend.roomcategory.management'))

@section('page-header')
    <h1>
        {{ trans('roomcategory::labels.backend.roomcategory.management') }}
        <small>{{ trans('roomcategory::labels.backend.roomcategory.management') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ roomcategory.'\'s '.trans('roomcategory::labels.backend.roomcategory.management') }}</h3>

            <div class="box-tools pull-right">
                @include('roomcategory::partials.header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            


        </div><!-- /.box-body -->
    </div><!--box-->
@stop