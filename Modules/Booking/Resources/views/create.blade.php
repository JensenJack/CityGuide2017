@extends ('backend.layouts.app')

@section ('title', trans('booking::labels.backend.booking.management') . ' | ' . trans('booking::labels.backend.booking.create'))

@section('after-styles')
    <link href="{{ asset('build/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />

@stop

@section('page-header')
    <h1>
        {{ trans('booking::labels.backend.booking.management') }}
        <small>{{ trans('booking::labels.backend.booking.create') }}</small>
    </h1>
@endsection

@section('content')

    {{ Form::open(['route' => 'admin.booking.store', 'class' => 'form-horizontal', 'files' => true ,'role' => 'form', 'method' => 'post', 'id' => 'create-booking']) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('booking::labels.backend.booking.create') }}</h3>

                <div class="box-tools pull-right">
                    @include('booking::partials.header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">


                <div class="form-group">
                <br>{{ Form::label('member_id', trans('booking::labels.backend.booking.table.member'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">          
                        <select class='form-control select2' name='member_id' autofocus="true" id="member">
                        <option></option>
                        <option>Guest</option>
                            @foreach($users as $user)
                                @if(old('member_id') == $user->id)
                                <option value="{{ $user->id }}" selected>{{ $user->name}}</option>
                                @else
                                <option value="{{ $user->id }}"> {{ $user->name }} </option>
                                @endif
                                @endforeach
                        </select><br><br>

                    </div><!--col-lg-10 -->            
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('guest_name', trans('booking::labels.backend.booking.table.guest_name'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('guest_name', null, ['class' => 'form-control user', 'placeholder' => trans('booking::labels.backend.booking.table.guest_name'),'id'=>'guest_name','readonly'=>'readonly']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('check_in_name', trans('booking::labels.backend.booking.table.check_in_name'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('check_in_name', null, ['class' => 'form-control', 'placeholder' => trans('booking::labels.backend.booking.table.check_in_name'),'id'=>'check_in_name']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->


                 <div class="form-group">
                    {{ Form::label('guest_email', trans('booking::labels.backend.booking.table.email'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('guest_email', null, ['class' => 'form-control user', 'placeholder' => trans('booking::labels.backend.booking.table.email'),'id'=>'email','readonly'=>'readonly']) }}
                    </div><!--col-lg-10-->
                 </div><!--form control-->


                <div class="form-group">
                    {{ Form::label('guest_phone', trans('booking::labels.backend.booking.table.phone'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('guest_phone', null, ['class' => 'form-control user', 'placeholder' => trans('booking::labels.backend.booking.table.phone'),'id'=>'phone','readonly'=>'readonly']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('guest_nrc', trans('booking::labels.backend.booking.table.nrc'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('guest_nrc', null, ['class' => 'form-control', 'placeholder' => trans('booking::labels.backend.booking.table.nrc'),'id'=>'nrc']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->



                <div class="form-group">
                <br>{{ Form::label('hotelcategory_id', trans('booking::labels.backend.booking.table.hotelcategory'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">          
                        <select class='form-control select2' name='hotelcategory_id' autofocus="true" id="hotelcategory">
                        <option></option>
                            @foreach($hotelcategory as $category)
                                @if(old('hotelcategory_id') == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->name}}</option>
                                @else
                                <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                @endif
                                @endforeach
                        </select><br><br>

                    </div><!--col-lg-10 -->            
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('hotel_id', trans('booking::labels.backend.booking.table.hotel'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                         <select class='form-control select2 hotel' name='hotel_id' id="hotel">

                        </select><br>
                    </div><!--col-lg-10-->
                    <div class="col-md-offset-2">
                       <div class="col-lg-10 hotel_detail">
                        
                       </div><!--col-lg-10-->
                   </div>
                </div><!--form control-->


                <div class="form-group">
                    {{ Form::label('room_id', trans('booking::labels.backend.booking.table.room'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                         <select class='form-control select2 room' name='room_id' id="room">

                        </select><br>
                    </div><!--col-lg-10-->
                    <div class="col-md-offset-2">
                       <div class="col-lg-10 room_detail">
                        
                       </div><!--col-lg-10-->
                   </div>
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('quantity', trans('booking::labels.backend.booking.table.quantity'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {!! Form::number('quantity', null, ['class' => 'form-control', 'min' => '1','id'=>'quantity']) !!}
                    </div><!--col-lg-10-->
                </div><!--form control-->
 
                <div class="form-group">
                    {{ Form::label('user_type', trans('booking::labels.backend.booking.table.user_type'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                      <input type="radio" name="guest_type" value="local" id="local" class="type">
                      <label for="guest_type">Local</label><br> 
                    
                      <input type="radio" name="guest_type" value="foreign" id="foreign" class="type">
                      <label for="guest_type">Foreign</label><br>
                      <input type="radio" name="guest_type" value="agent" id="agent" class="type">
                      <label for="guest_type">Agent</label><br> 
                   </div>
                   
    
                </div><!--form control-->

                <?php
                $tomorrow = date("Y-m-d H:I", time() + 86400);
                $today=date("Y-m-d H:I",time());
                ?>
                <div class="form-group">
                    {{ Form::label('check_in_date', trans('booking::labels.backend.booking.table.check_in'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('check_in_date',$tomorrow, ['class' => 'form-control datetime', 'placeholder' => trans('booking::labels.backend.booking.table.check_in'),'id'=>'check_in']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                 <div class="form-group">
                    {{ Form::label('check_out_date', trans('booking::labels.backend.booking.table.check_out'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('check_out_date',$tomorrow, ['class' => 'form-control datetime', 'placeholder' => trans('booking::labels.backend.booking.table.check_out'), 'id'=> 'check_out']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->


                <div class="form-group">
                    {{ Form::label('booking_expire', trans('booking::labels.backend.booking.table.booking_expire'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('booking_expire',$today, ['class' => 'form-control', 'placeholder' => trans('booking::labels.backend.booking.table.booking_expire'),'id'=>'booking_expire']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->


                <div class="form-group">
                    {{ Form::label('price', trans('booking::labels.backend.booking.table.price'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('price', null, ['class' => 'form-control', 'placeholder' => trans('booking::labels.backend.booking.table.price'),'id'=>'price','readonly'=>'readonly']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->


                 <div class="form-group">
                    {{ Form::label('amount', trans('booking::labels.backend.booking.table.amount'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('amount', null, ['class' => 'form-control', 'placeholder' => trans('booking::labels.backend.booking.table.amount'),'id'=>'amount','readonly'=>'readonly']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                
               
                 <div class="form-group">
                    {{ Form::label('discount', trans('booking::labels.backend.booking.table.discount'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('discount', null, ['class' => 'form-control', 'placeholder' => trans('booking::labels.backend.booking.table.discount'),'id'=>'discount']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                <br>{{ Form::label('payment_method', trans('booking::labels.backend.booking.table.payment_method'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        <select class='form-control select2' name='payment_method'>
                        <option value="offline_sale" selected>{{trans('booking::labels.backend.booking.table.offline_sale')}}</option>
                        <option value="deposit">{{trans('booking::labels.backend.booking.table.deposit')}}</option>     
                        </select><br>
                    </div><!--col-lg-10-->
               </div><!--form control-->

                <div class="form-group">
                <br>{{ Form::label('payment_complete', trans('booking::labels.backend.booking.table.payment'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        <select class='form-control select2' name='payment_complete'>
                        <option value="1">{{trans('booking::labels.backend.booking.table.paid')}}</option>
                        <option value="0" selected>{{trans('booking::labels.backend.booking.table.unpaid')}}</option>     
                        </select><br>
                    </div><!--col-lg-10-->
               </div><!--form control-->

               <div class="form-group">
                <br>{{ Form::label('language', trans('booking::labels.backend.booking.table.language'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        <select class='form-control select2' name='language'>
                        <option value="en" selected>{{trans('booking::labels.backend.booking.table.en')}}</option>
                        <option value="uni">{{trans('booking::labels.backend.booking.table.uni')}}</option>     
                        <option value="zg">{{trans('booking::labels.backend.booking.table.zg')}}</option>     
                        </select><br>
                    </div><!--col-lg-10-->
               </div><!--form control-->

            </div><!-- /.box-body -->
        </div><!--box-->


        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.booking.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger']) }}
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

 <script src="{{ asset('build/moment-master/moment.js') }}" type="text/javascript"></script>
 <script src="{{ asset('build/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
 <script type="text/javascript">
        
        $(document).ready(function(){
            $('.select2').select2({ 
              placeholder:"Please Select"
            });

                 var tomorrow='<?php echo date("Y-m-d H:I", time() + 86400);?>';
                 
                 $(".datetime").datetimepicker({
                    autoclose: true,
                    format: "yyyy-mm-dd",
                    todayBtn: true,
                    startDate: tomorrow,
                    minuteStep: 60,
                    });

                 var today='<?php echo date("Y-m-d H:I");?>';
                 $("#booking_expire").datetimepicker({
                    autoclose: true,
                    todayBtn: true,
                    startDate: today,
                    });

                $('.user').removeAttr('readonly');

            $('#member').change(function(){

                if($('#member').val() == 'Guest'){
                    $('.user').removeAttr('readonly');
                    $('.user').val('');
                }

                else
                {
                    $('.user').attr('readonly','readonly');

                    var user_id = $(this).val();
                    $.ajax({
                        url: '/admin/booking/user/' + user_id,
                        type: 'GET',
                        success: function(data){    
                              $('#guest_name').val(data['name']);
                              $('#email').val(data['email']);
                              $('#phone').val(data['phone_number']);
                        }
                       
                    });
                }
                     
                });
            
            if($('#member').val()>0){
                $('.user').attr('readonly','readonly');
                $('#user').trigger('change'); 
            }

             $('#hotel').attr('disabled', 'disabled');
                
                $('#hotelcategory').change(function(){
                    $('#hotel').removeAttr('disabled');
                    $('#hotel').empty();
                    var hotecategory_id = $(this).val();
                    $.ajax({
                        url: '/admin/booking/hotel/' + hotecategory_id,
                        type: 'GET',
                        success: function(data){  
                            $('#hotel').append('<option></option>');
                            $.each(data,function(key,value){
                                $('#hotel').append('<option value='+ value['id'] +'>'+ value['name']+ ' ('+value['city']['name']+ ')'+' </option>');
                            });
                        }
                    });
                });

                if( $('#hotelcategory').val() > 0){
                  $('#hotel').removeAttr('disabled');
                   $('#hotelcategory').trigger('change'); 
                }


                 $('#room').attr('disabled', 'disabled');

                    $('#hotel').change(function()
                    {
                    $('#room').removeAttr('disabled');
                    var room= $('#room').select2();
                      room.val("").trigger("change");
                        $('#room').select2({
                        placeholder: "Please Select"
                        });
                    $('#room').empty();
                     $('.hotel_detail').empty();
                    var hotel_id = $(this).val();
                    $.ajax({
                        url: '/admin/booking/room/' + hotel_id,
                        type: 'GET',
                        success: function(data){ 
                             $('#room').append('<option></option>');
                             $.each(data,function(key,value){
                                if(value['available_qty'] > 0)
                                {
                                 $('#room').append('<option value='+ value['id'] +'>'+ value['name']+'('+ value['room_category']['name']+')'+' </option>');
                                }

                            });
                        }
                    });
                    $('.hotel_detail').append('<a href="{{ url("admin/hotel") }}/'+hotel_id+'" target="_blank">View Hotel Detail</a>');

                });

                

                $('#quantity').val(1);
                $('#discount').val(0);
                $('#amount').val('');
                $('#price').val('');


                $('#quantity').attr('disabled','disabled');


                $('#room').change(function(){
                    $('#local').attr('checked','checked');
                    $('#quantity').removeAttr('disabled');

                    $('.room_detail').empty();

                    var room_id = $('#room').val();

                    $('.room_detail').append('<a href="{{ url("admin/room") }}/'+room_id+'" target="_blank">View Room Detail</a>');

                    $.ajax({
                        url: '/admin/booking/price/' + room_id,
                        type: 'GET',
                        success: function(data)
                        {
                        $('#amount').val(data['local_sell_price']);
                         $('#price').val(data['local_sell_price']);
                         $('#quantity').attr('max',data['available_qty']);

                        function total_amount(quantity,discount,days){
                            if($('#local').is(':checked'))
                               {
                                return $('#amount').val((data['local_sell_price'] * quantity *days)- discount );
                               }
                              else if($('#foreign').is(':checked'))
                               {
                                return $('#amount').val((data['foreign_sell_price'] * quantity *days) - discount);
                               }
                              else if($('#agent').is(':checked'))
                              {
                               return $('#amount').val((data['agent_sell_price'] * quantity *days) - discount);
                              }
                         }

                        $('.type').change(function()
                         {
                             var quantity = $('#quantity').val();
                             var discount = $('#discount').val();

                             var check_out = new Date($('.check_out_date').val());
                             var check_in = new Date($('.check_in_date').val());
                             var diff  = new Date(check_out - check_in);
                             var days  = diff/1000/60/60/24;

                            if($('#local').is(':checked'))
                               {
                                 $('#price').val(data['local_sell_price']);
                               }
                              else if($('#foreign').is(':checked'))
                               {
                                 $('#price').val(data['foreign_sell_price']);
                               }
                              else if($('#agent').is(':checked'))
                              {
                                $('#price').val(data['agent_sell_price']);
                              }
                              total_amount(quantity,discount,days);
                          });

                        $('#quantity').change(function()
                        {
                            var quantity = $('#quantity').val();
                            var discount = $('#discount').val();

                            var check_out = new Date($('#check_out').val());
                            var check_in = new Date($('#check_in').val());
                            var diff  = new Date(check_out - check_in);
                            var days  = diff/1000/60/60/24;
                
                              total_amount(quantity,discount,days);
                         });

                        $('#discount').change(function()
                        {
                            var quantity = $('#quantity').val();
                            var discount = $('#discount').val();

                            var check_out = new Date($('#check_out').val());
                            var check_in = new Date($('#check_in').val());
                            var diff  = new Date(check_out - check_in);
                            var days  = diff/1000/60/60/24;

                              total_amount(quantity,discount,days);
                         });

                        $('.datetime').change(function()
                        {
                            var quantity = $('#quantity').val();
                            var discount = $('#discount').val();

                            var check_out =new Date($('#check_out').val());
                            var check_in = new Date($('#check_in').val());
                            var diff  = new Date(check_out - check_in);
                            var days  = diff/1000/60/60/24;
                              total_amount(quantity,discount,days);
                         });
            
                        }
                    });
                });
             
        });


</script>
@stop