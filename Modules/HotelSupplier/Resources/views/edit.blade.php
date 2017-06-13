@extends ('backend.layouts.app')

@section ('title', trans('hotelsupplier::labels.backend.hotelsupplier.management') . ' | ' . trans('hotelsupplier::labels.backend.hotelsupplier.edit'))

@section('page-header')
    <h1>
        {{ trans('hotelsupplier::labels.backend.hotelsupplier.management') }}
        <small>{{ trans('hotelsupplier::labels.backend.hotelsupplier.edit') }}</small>
    </h1>
@endsection

@section('content')

    {{ Form::model($hotelsupplier, ['route' => ['admin.hotelsupplier.update', $hotelsupplier], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-hotelsupplier']) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('hotelsupplier::labels.backend.hotelsupplier.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('hotelsupplier::partials.header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">

                <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">
             
                <div class="form-group">
                    {{ Form::label('hotel_id', trans('hotelsupplier::labels.backend.hotelsupplier.table.hotel_name'), ['class' => 'col-lg-2 control-label']) }}

                    <input type="hidden" value="" name="hotel_id_list" id="hotels">

                    <div class="col-lg-10">
                       <select class='form-control select2 hotel' name='hotel_id[]' multiple="multiple">
                            @foreach($hotels as $key => $value)
                                @if(in_array($key,$hotelsupplier->hotel_id))
                                    <option value='{{ $key }}' selected>{{ $value }}</option>
                                @else
                                  <option value='{{ $key }}'>{{ $value }}</option>
                                @endif
                            @endforeach
                        </select><br>
                    </div><!--col-lg-10-->
                </div><!--form control-->

            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.hotelsupplier.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger']) }}
                </div><!--pull-left-->

                <div class="pull-right">
                    {{ Form::submit(trans('buttons.general.crud.edit'), ['class' => 'btn btn-success']) }}
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->

    {{ Form::close() }}
@stop

@section('after-scripts')

<script type="text/javascript">
        
        $(document).ready(function(){
            $('.select2').select2({ 
              placeholder:"Please Select"
            });
            var aa;
            $('.hotel').change(function(){
                aa=$(this).val();
                $('#hotels').val(aa);
            });

            $('.hotel').trigger('change');
        });    
</script>
@stop
