@extends ('backend.layouts.app')

@section ('title', trans('booking::labels.backend.booking.booking_email.management'))

@section('after-styles')
   

@stop

@section('page-header')
    <h1>
        {{ trans('booking::labels.backend.booking.booking_email.management') }}
      
    </h1>
@endsection

@section('content')
    {!! Form::open(['route' => 'admin.booking.sent_ticket', 'class' => 'form-horizontal', 'files'=> true ,'role' => 'form', 'method' => 'post' , 'id' => 'compose_email_form']) !!}

        <div class="box box-success">
            <div class="box-header with-border">
                <i class="icon-user font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">
                            {{ trans('booking::labels.backend.booking.booking_email.management') }}
                        </span>
                <div class="box-tools pull-right">
                  <div class="pull-right mb-10 hidden-sm hidden-xs">
                       <a href="javascript:;" id="skip" class="btn fa fa-arrow-right" style="color:red;background-color:orange;">
                            {{ trans('booking::menus.backend.booking.skip_to_complete') }}
                       </a>
                </div>
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
            	<input type="hidden" name="sender_id" class="sender_id" value="{{ access()->user()->id }}">
            	<input type="hidden" name="member_id" class="member_id" value="{{ $booking->member_id }}">
            	<input type="hidden" name="booking_id" class="booking_id" value="{{ $booking->id }}">

                 <div class="form-group">
                    {{ Form::label('client_name', trans('booking::labels.backend.booking.booking_email.client_name'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('client_name', $booking->guest_name. '(' . $booking->guest_email . ')', ['class' => 'form-control', 'id'=>'client_name','readonly'=>'readonly']) }}
                    </div><!--col-lg-10-->
                 </div><!--form control-->

                  <div class="form-group">
                    {{ Form::label('ref', trans('booking::labels.backend.booking.booking_email.ref'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('ref', $booking->booking_ref, ['class' => 'form-control ','id'=>'ref','readonly'=>'readonly']) }}
                    </div><!--col-lg-10-->
                 </div><!--form control-->

                 <div class="form-group">
                    {{ Form::label('booking_date', trans('booking::labels.backend.booking.booking_email.booking_date'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('booking_date', $booking->created_at, ['class' => 'form-control ','id'=>'booking_date','readonly'=>'readonly']) }}
                    </div><!--col-lg-10-->
                 </div><!--form control-->

                 <div class="form-group">
                    {{ Form::label('check_in_date', trans('booking::labels.backend.booking.table.check_in'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('check_in_date', $booking->check_in_date, ['class' => 'form-control ','id'=>'check_in_date','readonly'=>'readonly']) }}
                    </div><!--col-lg-10-->
                 </div><!--form control-->

                  <div class="form-group">
                    {{ Form::label('hotel_name', trans('booking::labels.backend.booking.booking_email.hotel_name'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('hotel_name', $booking->hotels->name, ['class' => 'form-control ','id'=>'check_in_date','readonly'=>'readonly']) }}
                    </div><!--col-lg-10-->
                 </div><!--form control-->

                 <div class="form-group">
                    {{ Form::label('payment_status', trans('booking::labels.backend.booking.booking_email.payment_status'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                      <input type="text" name="payment_status" class="form-control" id="payment_status" readonly="readonly" @if ($booking->payment_complete == 1 ) value="Paid" @else value="Unpaid"  @endif >
                    </div><!--col-lg-10-->
                 </div><!--form control-->

                  <div class="form-group">
                    {{ Form::label('status', trans('booking::labels.backend.booking.booking_email.status'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                      	<select name="status" id="status" class="form-control select2">
							<option value="1" {{ ($booking->status == 1) ? 'selected' : '' }} >Initial Sent
							</option>
							<option value="2" {{ ($booking->status == 2) ? 'selected' : '' }} >Final Sent
							</option>
							<option value="4" {{ ($booking->status == 4) ? 'selected' : '' }} >On Hold
							</option>
							<option value="3" {{ ($booking->status == 3) ? 'selected' : '' }} >Cancelled
							</option>
                        </select>

                    </div><!--col-lg-10-->
                 </div><!--form control-->

                  <div class="form-group">
                    {{ Form::label('room_name', trans('booking::labels.backend.booking.booking_email.room_name'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10" id="room_name_div">
                     	
                    </div><!--col-lg-10-->
                 </div><!--form control-->

                  <div class="form-group">
                    {{ Form::label('quantity', trans('booking::labels.backend.booking.booking_email.quantity'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10" id="quantity_div">
                     	
                    </div><!--col-lg-10-->
                 </div><!--form control-->

                  <div class="form-group">
                    {{ Form::label('voucher_no', trans('booking::labels.backend.booking.booking_email.voucher_no'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10" id="voucher_no_div">
                     	
                    </div><!--col-lg-10-->
                 </div><!--form control-->

                  <div class="form-group">
                    {{ Form::label('c_remark', trans('booking::labels.backend.booking.booking_email.c_remark'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10" id="c_remark">
                     	
                    </div><!--col-lg-10-->
                 </div><!--form control-->
                 <div class="form-group">
                    {{ Form::label('sender_name', trans('booking::labels.backend.booking.booking_email.sender'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10" id="c_remark">
                     	 {{ Form::text('sender_name', access()->user()->name, ['class' => 'form-control ','id'=>'check_in_date','readonly'=>'readonly']) }}
                    </div><!--col-lg-10-->
                 </div><!--form control-->

                
            			<div class="box-body">
                            <div class="pull-right">
                                @if($booking->status == 2)
                                    <button type="submit" class="btn red"><i class="icon-envelope"></i> Booking is
                                        Completed
                                        (Send Again)
                                    </button>
                                @else
                                    <button type="submit"
                                            {{ ( $booking->payment_complete == 0 ) ? "disabled=disabled" : "" }} id="send"
                                            class="btn green"><i
                                                class="btn fa fa-envelope" style="text-align: center;"></i> {{ ( $booking->payment_complete == 0 ) ? "Can't Send Unpaid Booking" : "Send" }}
                                    </button>
                                @endif
                            </div>
                        </div>
                 

                  <table class="table  table-bordered table-hover table-full-width" style=" border: 2px solid black;">
                        <tr>
                            <th style="text-align:center;border: 2px solid black;">NO</th>
                            <th style="text-align:center;border: 2px solid black;">HOTEL NAME</th>
                            <th style="text-align:center;border: 2px solid black;">ROOM</th>
                            <th style="text-align:center;border: 2px solid black;">QUANTITY</th>
                            <th style="text-align:center;border: 2px solid black;">VOUCHER NO.</th>
                            <th style="text-align:center;border: 2px solid black;">CHECK_IN_DATE</th>
                            <th style="text-align:center;border: 2px solid black;">CHECK_OUT_DATE</th>
                        </tr>
                        <tr>
                            <td style="text-align:center;border: 2px solid black;">1</td>
                            <td style="text-align:center;border: 2px solid black;">

                                {{ $booking->hotels->name }}
                                <br>
                                {{   $booking->hotels->class }}
                                <br>
                                 {{  $booking->hotels->city->name }}
                            </td>
                            <td style="text-align:center;border: 2px solid black;">
                                {{ $booking->room->name }} ( {{ $booking->room->room_category->name }} )
                                <br><br>
                            </td>
                            <td style="text-align:center;border: 2px solid black;">
                                {{ $booking->quantity }}
                            </td>
                            <td style="text-align:center;border: 2px solid black;">
                                <div id="t_voucher_no">Comming Up</div>
                            </td>
                            <td style="text-align:center;border: 2px solid black;">
                            	{{ $booking->check_in_date }}

                            </td>
                            <td style="text-align:center;border: 2px solid black;">
                                {{ $booking->check_out_date }}
                            </td>
                        </tr>
                    </table>

            </div><!-- /.box-body -->
        </div><!--box-->

    {{ Form::close() }}
@stop

@section('after-scripts')
{!! Html::script('build/bootbox/bootbox.min.js') !!}
<script src="{{ asset('build/js/app.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('build/js/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">

	 $(document).ready(function(){
            $('.select2').select2();


            $('#status').change(function(){

            	var status=$(this).val();
                var room_name  = "<?php echo $booking->room->name; ?>";
                var room_type  = "<?php echo $booking->room->room_category->name; ?>";
                var quantity  = "<?php echo $booking->quantity; ?>";
         

            	switch(status){

            		case'2':
            		         $('#room_name_div').append('<input type="text" name="room" class="form-control" id="room" readonly="readonly" value='+ room_name +'('+ room_type + ')>');

            		         $('#quantity_div').append('<input type="text" name="quantity" class="form-control" id="quantity" readonly="readonly" value='+ quantity +'>');
            		         $('#voucher_no_div').append('<input type="text" name="voucher_no" class="form-control" id="voucher_no">');
            		 		$('#c_remark').html("");
            		         break;

            		case'3': $('#room_name_div').html("");
            				 $('#quantity_div').html("");
            				 $('#voucher_no_div').html("");
            				 $('#c_remark').append('<textarea name="c_remark" class="form-control">C_remark</textarea>');
            				 break;

            		case'4': $('#room_name_div').html("");
            				 $('#quantity_div').html("");
            				 $('#voucher_no_div').html("");
            				 $('#c_remark').html("");
            				 break;


                            

            	}

            });



            $('#skip').click(function () {
                bootbox.dialog({
                    message: 'Are you sure!',
                    buttons: {
                        danger: {
                            label: "Cancel",
                            className: "red",
                        },
                        success: {
                            label: "Skip Now!",
                            className: "btn-success",
                            callback: function () {
                                App.blockUI();

                                $.get('{{ route('admin.booking.complete_all_stage' , $booking->id )}}', {
                                    member_id: '{{ $booking->member_id }}',
                                }, function (data) {

                                    setTimeout(function () {
                                        $.unblockUI({
                                            onUnblock: function () {
                                                toastr.success("{!! trans('booking::alerts.backend.booking.skip') !!}");
                                                window.location = "{{ route('admin.booking.index') }}";
                                            }
                                        });
                                    }, 2000);

                                }).error(function (data) {
                                    bootbox.alert({
                                        title: 'Error',
                                        message: data.responseJSON,
                                    });
                                });

                            }
                        }
                    }
                });
            });

        });
             
     
</script>


@stop