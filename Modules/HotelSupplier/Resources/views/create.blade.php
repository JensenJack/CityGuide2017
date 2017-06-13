@extends ('backend.layouts.app')

@section ('title', trans('hotelsupplier::labels.backend.hotelsupplier.management') . ' | ' . trans('hotelsupplier::labels.backend.hotelsupplier.create'))

@section('page-header')
    <h1>
        {{ trans('hotelsupplier::labels.backend.hotelsupplier.management') }}
        <small>{{ trans('hotelsupplier::labels.backend.hotelsupplier.create') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.hotelsupplier.store', 'class' => 'form-horizontal', 'files' => true ,'role' => 'form', 'method' => 'post', 'id' => 'create-hotelsupplier']) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('hotelsupplier::labels.backend.hotelsupplier.create') }}</h3>

                <div class="box-tools pull-right">
                    @include('hotelsupplier::partials.header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">

            <div class="form-group">
                    {{ Form::label('supplier_id', trans('hotelsupplier::labels.backend.hotelsupplier.table.supplier_name'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        <select class='form-control select2' name='supplier_id' id="supplier">
                            <option></option>
                            @foreach($suppliers as $supplier)
                                 @if(old('supplier_id') == $supplier->id)
                                    <option value='{{ $supplier->id }}' selected>{{ $supplier->name }}</option>
                                @else
                                <option value="{{ $supplier->id }}"> {{ $supplier->name }} </option>
                                 @endif
                            @endforeach
                        </select><br>
                    </div><!--col-lg-10-->
                </div><!--form control-->
             

                <div class="form-group">
                    {{ Form::label('hotel_id', trans('hotelsupplier::labels.backend.hotelsupplier.table.hotel_name'), ['class' => 'col-lg-2 control-label']) }}
                         <input type="hidden" value="" name="hotel_id_list" id="hotels">
                    <div class="col-lg-10">
                        <select class='form-control select2 hotel' name='hotel_id[]' id="hotel" multiple="multiple">
                            
        
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
                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success']) }}
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

            var clear=$("#hotel").select2();

                $('#hotel').attr('disabled', 'disabled');
          
                $('#supplier').change(function(){
                    clear.val("").trigger("change");
                   $('#hotel').select2({
                        placeholder: "Please Select"
                    });
                    $('#hotel').removeAttr('disabled');
                     $('#hotel').empty();


                    var supplier_id = $(this).val();
                    $.ajax({
                        url: '/admin/hotelsupplier/hotel_list/' + supplier_id,
                        type: 'GET',
                        success: function(data){ 
                            $.each(data,function(key,value){
                                $('#hotel').append('<option value='+ key +'>'+ value +' </option>');
                            });
                        }
                    });
                });

                if ($('#supplier').val() > 0)
                {
                     $('#hotel').removeAttr('disabled');
                     $('#supplier').trigger('change');
                }

                var aa;
                $('.hotel').change(function(){
                    aa=$(this).val();
                    $('#hotels').val(aa);
                });

                $('.hotel').trigger('change');
            
                  
        });
        
    
</script>
@stop
