@extends('frontend.layouts.app')

@section ('title', app_name() . ' | Final Confirmation')

@section('after-styles')

  <!-- BODY START-->
  <link rel="stylesheet" media="all" href="{{ asset('/build/css/style-shop.css') }}" type="text/css">
<style type="text/css">
        .error{
                    color: red;
        }
        .styledRadio{
            display: inline-block;
        }
         
</style>
@stop

@section('content')

<?php $count = 1; ?>


<div class="top-area show-onload">
	 <div class="bg-holder full">
	 	 <div class="bg-img" style="background-image:url(/img/frontend/img/Balloons-Bagan-Burma.jpeg);"></div>
        
        <div class="bg-content" >
            <section class="container">

                <div class="row triggerAnimation animated fadeInLeft" data-animate="fadeInLeft" style="color:white;">
                    <h3> Final Confirmation </h3>
                </div>
                <div class="row">

                <!-- BEGIN CONTENT -->
                <!-- <div class="col-md-12 col-sm-12"> -->

                    <!-- BEGIN CHECKOUT PAGE -->
                    <div class="panel-group checkout-page accordion scrollable" id="{{ (Auth::guest())?'payment-address':'login-page' }}">

                        @if (Auth::guest())
                               {!! Form::open(['url' => 'member_login', 'method' => 'post', 'id' => 'checkoutForm']) !!}
                                <!-- BEGIN LOGIN -->
                                <div id="login" class="panel panel-default">
                                    <div class="panel-heading">
                                        <h2 class="panel-title">
                                            <a href="#" style="color: black;">
                                                Step {{ $count++ }}: Login to Account
                                            </a>
                                        </h2>
                                    </div>
                                    <div id="login-content" class="panel-collapse collapse {{ (Auth::guest())?'in':'' }}">
                                        <div class="panel-body">
                                            <div class="col-md-6 col-sm-6">
                                                <h3 style="color: black;">Checkout as a Guest or Register : </h3>
                                                <div class="form-group">
                                                    <div class="radio">
                                                        <label>
                                                        <input class="i-radio checkout_method" type="radio" name="checkout"  value="guest" checked />{{trans('frontend.guest_checkout')}}</label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="radio">
                                                        <label>
                                                        <input class="i-radio checkout_method" type="radio" name="checkout"  value="register"/>{{trans('frontend.register')}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6" id="login-panel" style="display:none;">
                                                <h3 style="color: black;">{{ trans('frontend.existing_login')}}: </h3>
                                                <div id="login-error" class="error">
                                                </div>
                                                <div class="form-group">
                                                    <label for="emailormobile">Email or Mobile <span class="require">*</span></label>
                                                    <input id="emailormobile" name="emailormobile" class="form-control" placeholder="Your Email or Mobile:" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password <span class="require">*</span></label>
                                                    <input id="password" name="password" class="form-control" placeholder="Your Password:" type="password">
                                                </div>
                                             </div>
                                            <hr>
                                            <div class="col-md-12">
                                                <button class="btn btn-primary  pull-right" id="checkout" type="submit">Continue</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END LOGIN -->
                                {!! Form::close() !!}
                        @endif
                 </div>
                 <!-- END CHECKOUT PAGE -->

                  <!-- BEGIN PAYMENT ADDRESS -->
                  {!! Form::open(['url' => 'booking/confirmation', 'method' => 'post', 'id' => 'signupForm']) !!}

                   <input id="id_data" value="{{ (Auth::guest())?'login':'payment-address' }}" type="hidden">
                    <input id="amount" name="amount" value="" type="hidden">
                    <input id="service" name="service_fee" value="" type="hidden">
                    <input id="hotel_id" name="hotel_id" value="{{ $room->hotel_id }}" type="hidden">
                    <input id="room_id" name="room_id" value="{{ $room->id }}" type="hidden">
                    <input id="price" name="price" value="" type="hidden">
                    
                            <div id="payment-address" class="panel panel-default">
                                <div class="panel-heading">
                                    <h2 class="panel-title">
                                        <a href="#">
                                            Step {{ $count++ }}: Account &amp; Customer(s) Details
                                        </a>
                                    </h2>
                                </div>
                                <div id="payment-address-content" class="panel-collapse collapse {{ (Auth::guest())?'':'in' }}" style="overflow: auto;height: 525px;">
                                    <div class="panel-body">
                                        <div class="col-md-6 col-sm-6">
                                            <h3>Room Details</h3>
                                               <div class="form-group">
                                                        <label for="hotel">Hotel</label>
                                                        <input id="hotel" name="hotel" class="form-control" type="text" readonly="readonly" value="{{ $room->hotel->name. '(' .$room->hotel->city->name . ')' }}">
                                                        
                                                </div>
                                                <div class="form-group">
                                                        <label for="room">Room<span class="require">*</span></label>
                                                        <input id="room" name="room" class="form-control" type="text" readonly="readonly" value="{{ $room->name. '(' .$room->room_category->name . ')' }}">
                                                </div>

                                                <div class="form-group">
                                                        <label for="quantity">Quantity<span class="require">*</span></label>
                                                        <input id="quantity" name="quantity" class="form-control" type="number" @if(session('room_qty')) value="{{session('room_qty')}}" @else value='1' @endif min="1" max="{{ $room->available_qty }}">
                                                </div>

                                                <div class="input-daterange" data-date-format="yyyy-mm-d"> 
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                        <label>Check-in</label>
                                                        <input class="form-control check_in" name="start" type="text" @if(session('start')) value="{{session('start')}}" @else value="" @endif />
                                                        </div>       
                                            
                                                        <div class="form-group form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                        <label>Check-Out</label>
                                                        <input class="form-control check_out" name="end" type="text" @if(session('end')) value="{{session('end')}}" @else value="" @endif />
                                                        </div>       
                                                </div>

                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <h3>Your Personal Details</h3>
                                             @if(Auth::guest())
                                                    <div class="form-group">
                                                        <label for="name">{{ trans('frontend.name') }} <span class="require">*</span></label>
                                                        <input id="name" name="name" class="form-control" placeholder="Your Name:"  type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">{{ trans('frontend.email') }} <span class="require">*</span></label>
                                                        <input id="email" name="email" class="form-control" placeholder="Your Email:"  type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="guest_phone">{{ trans('frontend.mobile_no') }}<span class="require">*</span></label>
                                                        <input id="guest_phone" name="guest_phone" class="form-control" placeholder="Your Mobile No.: English Format !"  type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Guest Type</label><br>
                                                            <div class="radio-inline radio-small">
                                                                <label>
                                                                <input class="i-radio" type="radio" name="guest_type" value="foreigner" @if(session('guest_type') == 'foreigner') checked="checked" @endif id="foreigner" />Foreigner</label>
                                                            </div>
                                                            <div class="radio-inline radio-small">
                                                                <label>
                                                                <input class="i-radio" type="radio" name="guest_type" value="local" @if(session('guest_type') == 'local') checked="checked" @elseif(session('guest_type') == null) checked="checked" @endif id="local" />Local
                                                                </label>
                                                            </div>
                                                    </div>
                                            @else
                                                   <div class="form-group">
                                                        <label for="name">{{ trans('frontend.name') }} <span class="require">*</span></label>
                                                        <input id="name" name="name" class="form-control" placeholder="Your Name:" value="{{ auth()->user()->name }}"  readonly="true" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">{{ trans('frontend.email') }} <span class="require">*</span></label>
                                                        <input id="email" name="email" class="form-control" placeholder="Your Email:" value="{{ auth()->user()->email }}"  readonly="true" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="guest_phone">{{ trans('frontend.mobile_no') }}<span class="require">*</span></label>
                                                        <input id="guest_phone" name="guest_phone" class="form-control" placeholder="Your Mobile No.: English Format !" value="{{ auth()->user()->phone_number }}"  readonly="true" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Guest Type</label><br>
                                                            <div class="radio-inline radio-small">
                                                                <label>
                                                                <input class="i-radio" type="radio" name="guest_type" value="foreigner" checked="checked" />Foreigner</label>
                                                            </div>
                                                            <div class="radio-inline radio-small">
                                                                <label>
                                                                <input class="i-radio" type="radio" name="guest_type" value="local" />Local
                                                                </label>
                                                            </div>
                                                    </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <h3>Customer(s) Details</h3>
                                            <div class="form-group">
                                                <label for="guest_nrc">Customer NRC/Passport No. : </label>
                                                <input id="guest_nrc" name="guest_nrc" class="form-control" placeholder="12/မကတ(ႏုိင္)000000" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label for="check_in_name">Check In name (as in NRC/Passport) :</label>
                                                <input id="check_in_name" name="check_in_name" class="form-control" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label for="note">Customer Note (Optional) :</label>
                                                <input id="note" name="note" class="form-control" type="text">
                                            </div>

                                         </div>
                                        <hr>
                                        <div class="col-md-12">
                                            <button class="btn btn-primary  pull-right" id="okay" type="submit">Continue</button>
                                            <div class="checkbox pull-right">
                                                <label>
                                                    <input name="agreed" id="agreement" checked="checked" type="checkbox" value="agreed"> 
                                                    I have read and agree to the <a title="Terms and Conditions" style="color:#E85147;" target="_blank" href="{{ url('page/terms-conditions') }}">Terms and Conditions</a> &nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PAYMENT ADDRESS -->

                            <!-- BEGIN PAYMENT METHOD -->
                            <div id="payment-method" class="panel panel-default">
                                <div class="panel-heading">
                                    <h2 class="panel-title">
                                        <a href="#">
                                            Step {{ $count++ }}: Ticket Type &amp; Payment Method
                                        </a>
                                    </h2>
                                </div>
                                <div id="payment-method-content" class="panel-collapse collapse">
                                    <div class="panel-body">

                                        <p>Please select the preferred payment method to use on this booking.</p>
                                                @if(config('payment.transfer.enable') == 'true')
                                                <div class="col-md-6 form-group">
                                                    <div class="payment_method styledRadio" 
                                                            style="background-image: url('/img/frontend/screw/images/bank.jpg'); width: 70px; height: 43px; cursor: pointer; background-position: 0px -43px;" tabindex="0" role="radio">
                                                            <input class="payment_method" name="payment_method" value="transfer" data-sdb-image="url('/img/frontend/screw/images/bank.jpg')"
                                                            style="display: none;" type="radio">
                                                    </div>
                                                    <label class="valign"> BANK TRANSFER </label>
                                                </div>
                                                @endif
                                                @if(config('payment.deposite.enable') == 'true')
                                                <div class="col-md-6 form-group hide" id="deposit_account">
                                                    <div class="payment_method styledRadio" 
                                                            style="background-image: url('/img/frontend/screw/images/bnf.jpg'); width: 70px; height: 43px; cursor: pointer; background-position: 0px 0px;" 
                                                            tabindex="-1" role="radio">
                                                            <input class="payment_method" name="payment_method" value="account" data-sdb-image="url('/img/frontend/screw/images/bnf.jpg')" style="display: none;" 
                                                            type="radio">
                                                     </div>
                                                    <label class="valign"> DEPOSIT ACCOUNT </label>
                                                </div>
                                                @endif
                                                @if(config('payment.truemoney.enable') == 'true')
                                                <div class="col-md-6 form-group">
                                                    <div class="payment_method styledRadio" 
                                                            style="background-image: url('/img/frontend/screw/images/truemoney.jpg'); width: 70px; height: 43px; cursor: pointer; background-position: 0px 0px;" tabindex="-1" role="radio">
                                                            <input class="payment_method" name="payment_method" value="truemoney" data-sdb-image="url('/img/frontend/screw/images/truemoney.jpg')" style="display: none;" type="radio">
                                                        </div>
                                                    <label class="valign">True Money </label>
                                                </div>
                                                @endif
                                                @if(config('payment.visa_master.enable') == 'true')
                                                <div class="col-md-6 form-group">
                                                   <div class="payment_method styledRadio" 
                                                            style="background-image: url('/img/frontend/screw/images/visa_master.jpg'); width: 70px; height: 43px; cursor: pointer; background-position: 0px 0px;" tabindex="-1" role="radio">
                                                            <input class="payment_method" name="payment_method" value="visa_master" data-sdb-image="url('/img/frontend/screw/images/visa_master.jpg')" 
                                                            style="display: none;" type="radio">
                                                    </div>
                                                    <label class="valign">VISA/MASTER </label>
                                                </div>
                                                @endif

                                                @if(config('payment.mab.enable') == 'true')
                                                <div class="col-md-6 form-group">
                                                   <div class="payment_method styledRadio" 
                                                         style="background-image: url('/img/frontend/screw/images/mab.jpg'); width: 70px; height: 43px; cursor: pointer; background-position: 0px 0px;"
                                                          tabindex="-1" role="radio">
                                                          <input class="payment_method" name="payment_method" value="mab" data-sdb-image="url('/img/frontend/screw/images/mab.jpg')" style="display: none;" 
                                                          type="radio">
                                                    </div>
                                                    <label class="valign">MAB MOBILE BANKING  </label>
                                                </div>
                                                @endif
                                                @if(config('payment.paypal.enable') == 'true')
                                                <div class="col-md-6 form-group">
                                                    <div class="payment_method styledRadio" 
                                                            style="background-image: url('/img/frontend/screw/images/paypal.jpg'); width: 70px; height: 43px; cursor: pointer; background-position: 0px 0px;" tabindex="-1" role="radio">
                                                            <input class="payment_method" name="payment_method" value="paypal" data-sdb-image="url('/img/frontend/screw/images/paypal.jpg')" style="display: none;" 
                                                            type="radio">
                                                    </div>
                                                    <label class="valign">PAYPAL </label>
                                                </div>
                                                 @endif
                                                @if(config('payment.mpu.enable') == 'true')
                                                <div class="col-md-6 form-group">
                                                    <div class="payment_method styledRadio" 
                                                            style="background-image: url('/img/frontend/screw/images/mpu.jpg'); width: 70px; height: 43px; cursor: pointer; background-position: 0px 0px;" 
                                                            tabindex="-1" role="radio">
                                                            <input class="payment_method" name="payment_method" value="mpu" data-sdb-image="url('/img/frontend/screw/images/mpu.jpg')" style="display: none;" 
                                                            type="radio">
                                                    </div>
                                                    <label class="valign">MPU CARD </label>
                                                </div>
                                                 @endif
                                                @if(config('payment.onetwothree.enable') == 'true')
                                                <div class="col-md-6 form-group">
                                                    <div class="payment_method styledRadio" 
                                                            style="background-image: url('/img/frontend/screw/images/123.jpg'); width: 70px; height: 43px; cursor: pointer; background-position: 0px 0px;" 
                                                            tabindex="-1" role="radio">
                                                            <input class="payment_method" name="payment_method" value="onetwothree" data-sdb-image="url('/img/frontend/screw/images/123.jpg')" style="display: none;" type="radio">
                                                    </div>
                                                    <label class="valign">1-2-3 Service </label>
                                                </div>
                                                 @endif
                                                <div class="clearfix"></div>
                                               <p>Please select the communication type to use on this booking.</p>
                                                <div class="col-md-4 form-group">
                                                    <input class="communication_type" name="language" value="en" checked="checked" type="radio">
                                                    <label class="valign"> ENGLISH </label>
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <input class="communication_type" name="language" value="zg"  type="radio">
                                                    <label class="valign"> MYANMAR- ZAWGYI </label>
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <input class="communication_type" name="language" value="uni"  type="radio">
                                                    <label class="valign"> MYANMAR- UNICODE </label>
                                                </div>

                                        <div class="col-md-12">
                                            <button class="btn btn-default back" type="button">Back</button>
                                            <button class="btn btn-primary  pull-right" type="submit" id="button-confirm">Continue</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PAYMENT METHOD -->

                            <!-- BEGIN CONFIRM -->
                            <div id="confirm" class="panel panel-default">
                                <div class="panel-heading">
                                    <h2 class="panel-title">
                                        <a href="#">
                                            Step {{ $count++ }}: Confirm Booking
                                        </a>
                                    </h2>
                                </div>
                                <div id="confirm-content" class="panel-collapse collapse"  style="overflow: auto; height: 375px;">
                                    <div class="panel-body">
                                        <div class="col-md-12 clearfix">
                                            <div class="table-wrapper-responsive">
                                                <table width="100%">
                                                     <tbody>
                                                        <tr>
                                                                <th class="checkout-image">Check In Date</th>
                                                                <th class="checkout-model">Hotel</th>
                                                                <th class="checkout-description">Description</th>
                                                                <th class="checkout-quantity" width="10%">Quantity</th>
                                                                <th class="checkout-price">Price</th>
                                                                <th class="checkout-total">Total</th>
                                                        </tr>
                                                   
                                                        <tr>
                                                            <td class="checkout-image">
                                                              <p  class="check_in_date"></p>  
                                                            </td>
                                                            <td class="checkout-model">
                                                                {{ $room->hotel->name.' ( '.$room->hotel->class .'star)'}} <br>
                                                                {{ 'City -'. $room->hotel->city->name }}                          
                                                            </td>
                                                            <td class="checkout-description">
                                                                <h4>
                                                                    <a href="#">{{ 'Name -'.$room->name}}</a>
                                                                </h4>
                                                                <p>Type</strong> - {{ $room->room_category->name }}</p>

                                                                <p class="descrip_check_in"></p>

    
                                                                 <p class="descrip_check_out"></p>


                                                                <p class="customer_type"></p>
                                                                <p><strong>Payment Method</strong> - <span class="method">TRANSFER</span></p>
                                                             </td>
                                                            <td class="checkout-quantity"><strong class="quantity"></strong></td>
                                                            <td class="checkout-price"><strong class="price"><span>MMK</span></strong></td>
                                                            <td class="checkout-total"><strong id="total">0<span>MMK</span></strong></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <hr>
                                            <div class="checkout-total-block">
                                                <ul>
                                                    <li>
                                                        <em>Sub total</em>
                                                        <strong id="sub_total">0<span>MMK</span></strong>
                                                    </li>
                                                    <li>
                                                        <em id="display">Service Fees</em>
                                                        <strong id="service_fee">0<span>MMK</span></strong>
                                                    </li>
                                                    <li class="checkout-total-price">
                                                        <em>Total</em>
                                                        <strong id="total_amount">0<span>MMK</span></strong>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="clearfix"></div>
                                            <button class="btn btn-default back" type="button">Back</button>
                                            <button class="btn btn-primary pull-right" type="submit" id="button-confirm">Confirm Order</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END CONFIRM -->
                             {!! Form::close() !!}  
                   <!--  </div> -->
                </div> <!-- row -->
            </section>
        </div> <!--  bg-content -->
    </div><!--  bg-holder -->
</div><!--  top-area -->
@endsection

@section('after-scripts')
<script src="{{ asset('/build/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/img/frontend/screw/js/jquery.screwdefaultbuttonsV2.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {  

         

		$('.checkout_method').on('ifChanged',function(){
                    if($('input[name=checkout]:checked').val() == 'register'){
                        $('#register').iCheck('check');
                        $("#login-panel").slideDown("slow");


                    }
                    else{
                        $("#login-panel").slideUp("slow");
                    }
            });
		$("#checkoutForm").validate({
                rules: {
                    emailormobile: {
                        required: true
                    },
                    password: {
                        required: true
                    }
                },
                submitHandler: function(form) {
                    if($('input[name=checkout]:checked').val() == 'register'){
                        run_waitMe();
                            $.ajax({
                                    url: form.action,
                                    type: form.method,
                                    data: $(form).serialize(),
                                    success: function(response) {
                                        stop_waitMe();
                                        $('#name').val(response.user.name).attr('readonly','true');
                                        $('#email').val(response.user.email).attr('readonly','true');
                                        $('#mobile').val(response.user.mobile).attr('readonly','true');
                                         $('#id_data').val('payment-address');
                                        $('#checkoutForm').find('.panel-collapse').removeClass('in');
                                        // $('#deposit_account').removeClass('hide');
                                         $('#payment-address-content').addClass('in');
                                        window.location = "{{ url('booking') }}";
                                    },
                                    error: function(response,status){
                                        stop_waitMe();
                                         // $('#deposit_account').addClass('hide');
                                    
                                        if(!response.responseJSON.success)
                                             $('#login-error').html(response.responseJSON.message);
                                    }           
                                });
                    }
                    else{
                                        // $('#deposit_account').addClass('hide');
                                        $('#id_data').val('payment-address');
                                        $('#checkoutForm').find('.panel-collapse').removeClass('in');
                                        $('#payment-address-content').addClass('in');
                    }
                }
            });

         $('#agreement').change(function(){

                   if($('input[name=agreed]:checked').val() == 'agreed'){
                       $('#okay').removeAttr('disabled');
                    }
                    else{
                        $('#okay').attr('disabled','');
                    }
            });


         $.validator.addMethod("maxDate", function(value, element) {
                var check_out = new Date($('.check_out').val());
                var check_in = new Date($('.check_in').val());
                if (check_in < check_out)
                    return true;
                return false;
            }, "Check Out Date must be before Check In Date");   // error message


         $("#signupForm").validate({
                rules: {
                            name: {
                                required: true,
                                minlength: 4
                            },
                            check_in_name: {
                                required: true,
                                minlength: 4
                            },
                            guest_nrc: {
                                required: true,
                                minlength: 6
                            },
                            guest_phone: {
                                required: true
                            },
                            email: {
                                required: true,
                                email: true
                            },
                            payment_method: {
                                required: true
                            },
                            quantity: {
                                required: true
                            },
                            start: {
                                required: true,
                                maxDate: true,
                            },
                            end: {
                                required: true,
                                maxDate : true,
                            },
                            guest_type: {
                                required: true
                            },
                           
                            // mobile: 'customphone'
                            
                },
                submitHandler: function(form) {
                            var id_data = $('#id_data').val();
                            if(id_data == 'login')
                            {
                                $('#signupForm').find('.panel-collapse').removeClass('in');
                                $('#id_daat').val('payment-address');
                                $('#payment-address-content').addClass('in');
                                return false;
                            }
                            else if(id_data == 'payment-address')
                            {
                                $('#signupForm').find('.panel-collapse').removeClass('in');
                                $('#id_data').val('payment-method');
                                $('#payment-method-content').addClass('in');
                                return false;
                            }
                            else if(id_data == 'payment-method')
                            {
                                if(!$('.payment_method:checked').val()){
                                    swal('Please choose a payment method or login to checkout with your account!');
                                    return false;
                                }
                                $('#signupForm').find('.panel-collapse').removeClass('in');
                                $('#id_data').val('confirm');
                                $('#confirm-content').addClass('in');
                                return false;
                            }
                            form.submit();  // for demo
                }
            });

         $('input[name=payment_method]:radio').screwDefaultButtons({
                image: 'url("/img/frontend/screw/images/bullet.png")',
                width: 70,
                height: 43
            });


         $('.back').click(function(){
                    var id_data = $('#id_data').val();
                    $('#signupForm').find('.panel-collapse').removeClass('in');
                     if(id_data == 'confirm')
                    {
                        $('#id_data').val('payment-method');
                        $('#payment-method-content').addClass('in');
                        return false;
                    }
                    else if(id_data == 'payment-method')
                    {
                        $('#id_data').val('payment-address');
                        $('#payment-address-content').addClass('in');
                        return false;
                    }
            });
         
         $('#button-confirm').click(function(){

                        $('#display').html('Service Fees');
                         var  quantity   = $('input[name=quantity]').val();
                         var guest_type = $('input[name=guest_type]:checked').val();

 
                         if( guest_type == 'foreigner')
                         {
                             var  paypal_fee          = parseFloat("{{ $foreign_service_fee['paypal_fee'] }}");
                             var  mpu_fee             = parseFloat("{{ $foreign_service_fee['mpu_fee'] }}");
                             var  transfer_fee        = parseFloat("{{ $foreign_service_fee['transfer_fee'] }}");
                             var  onetwothree_fee     = parseFloat("{{ $foreign_service_fee['onetwothree_fee'] }}");
                             var  mab_fee             = parseFloat("{{ $foreign_service_fee['mab_fee'] }}");
                             var  visa_master_fee     = parseFloat("{{ $foreign_service_fee['visa_master_fee'] }}");
                             var  truemoney_fee       = parseFloat("{{ $foreign_service_fee['truemoney_fee'] }}");
                             var  deposite_fee        = parseFloat("{{ $foreign_service_fee['deposite_fee'] }}");


                            var room_price = parseFloat("{{ $room->foreign_sell_price }}");
                            payment(room_price,paypal_fee,mpu_fee,transfer_fee,onetwothree_fee,mab_fee,visa_master_fee,truemoney_fee,deposite_fee);

                         }

                         if(guest_type == 'local')
                         { 



                             var  paypal_fee          = parseFloat("{{ $local_service_fee['paypal_fee'] }}");
                             var  mpu_fee             = parseFloat("{{ $local_service_fee['mpu_fee'] }}");
                             var  transfer_fee        = parseFloat("{{ $local_service_fee['transfer_fee'] }}");
                             var  onetwothree_fee     = parseFloat("{{ $local_service_fee['onetwothree_fee'] }}");
                             var  mab_fee             = parseFloat("{{ $local_service_fee['mab_fee'] }}");
                             var  visa_master_fee     = parseFloat("{{ $local_service_fee['visa_master_fee'] }}");
                             var  truemoney_fee       = parseFloat("{{ $local_service_fee['truemoney_fee'] }}");
                             var  deposite_fee        = parseFloat("{{ $local_service_fee['deposite_fee'] }}");

                            var room_price = parseFloat("{{ $room->local_sell_price }}");
                            payment(room_price,paypal_fee,mpu_fee,transfer_fee,onetwothree_fee,mab_fee,visa_master_fee,truemoney_fee,deposite_fee);

                         }

                          function payment(room_price,paypal_fee,mpu_fee,transfer_fee,onetwothree_fee,mab_fee,visa_master_fee,truemoney_fee,deposite_fee)
                          {
                            var check_out = new Date($('.check_out').val());
                            var check_in = new Date($('.check_in').val());
                            var check_in_date =$('.check_in').val();
                            var check_out_date =$('.check_out').val();
                            
                            
                            var diff  = new Date(check_out - check_in);
                            var days  = diff/1000/60/60/24;

                            var amount =room_price * quantity * days;

                            $('.price').html(room_price + '<span> MMK</span>');
                            $('#total').html(amount + '<span> MMK</span>');
                            $('#sub_total').html(amount + '<span> MMK</span>');

                            if($('.payment_method:checked').val() == "account"){
                                $('.method').html('DEPOSIT');
                                var total_amount =parseFloat(deposite_fee) + parseFloat(amount);
                                $('#service_fee').html(parseFloat(deposite_fee * quantity * days) + '<span> MMK</span>');
                                $('#service').val(parseFloat(deposite_fee));      
                            }
                            else if($('.payment_method:checked').val() == "transfer"){
                                $('.method').html('TRANSFER');
                                var total_amount =parseFloat(transfer_fee) + parseFloat(amount);
                                $('#service_fee').html(parseFloat(transfer_fee * quantity * days) + '<span> MMK</span>');
                                $('#service').val(parseFloat(transfer_fee));      
                            }
                            else if($('.payment_method:checked').val() == "mpu"){
                                $('.method').html('MPU');
                                var total_amount = parseFloat(mpu_fee) + parseFloat(amount);
                                $('#service_fee').html(parseFloat(mpu_fee * quantity * days) + '<span> MMK</span>');
                                $('#service').val(parseFloat(mpu_fee));    
                            }
                            else if($('.payment_method:checked').val() == "visa_master"){
                                $('.method').html('Visa/Master');
                                var total_amount = parseFloat(visa_master_fee) + parseFloat(amount);
                                $('#service_fee').html(parseFloat(visa_master_fee * quantity * days) + '<span> MMK</span>');
                                $('#service').val(parseFloat(visa_master_fee));      
                            }
                            else if($('.payment_method:checked').val() == "mab"){
                                $('.method').html('MAB Mobile Banking');
                                var total_amount = parseFloat(mab_fee) + parseFloat(amount);
                                $('#service_fee').html(parseFloat(mab_fee * quantity * days) + '<span> MMK</span>');
                                $('#service').val(parseFloat(mab_fee));      
                            }
                            else if($('.payment_method:checked').val() == "truemoney"){
                                $('.method').html('True Money');
                                var total_amount = parseFloat(truemoney_fee) + parseFloat(amount);
                                $('#service_fee').html(parseFloat(truemoney_fee * quantity * days) + '<span> MMK</span>');
                                $('#service').val(parseFloat(truemoney_fee));      
                            }
                            else if($('.payment_method:checked').val() == "mab"){
                                $('.method').html('MAB MOBILE BANKING');
                                var total_amount = parseFloat(mab_fee) + parseFloat(amount);
                                $('#service_fee').html(parseFloat(mab_fee * quantity * days) + '<span> MMK</span>');
                                $('#service').val(parseFloat(mab_fee));      
                            }
                            else if($('.payment_method:checked').val() == "paypal"){
                                $('.method').html('PAYPAL');
                                var total_amount = parseFloat(paypal_fee) + parseFloat(amount);
                                $('#service_fee').html(parseFloat(paypal_fee * quantity * days) + '<span> MMK</span>');
                                $('#service').val(parseFloat(paypal_fee));      
                            }
                            else if($('.payment_method:checked').val() == "onetwothree"){
                                $('.method').html('123 Service');
                                var total_amount = parseFloat(onetwothree_fee) + parseFloat(amount);
                                $('#service_fee').html(parseFloat(onetwothree_fee * quantity * days) + '<span> MMK</span>');
                                $('#service').val(parseFloat(onetwothree_fee));      
                            }

                            $('#total_amount').html(total_amount + '<span> MMK</span>');
                            $('.check_in_date').html(check_in_date);
                            $('.descrip_check_in').html('<strong>Check In Date</strong> -'+ check_in_date);
                            $('.descrip_check_out').html('<strong>Check Out Date</strong> -'+ check_out_date);
                            $('.customer_type').html('<strong>Customer Type</strong> -'+ guest_type);
                            $('.quantity').html(quantity);

                            $('#amount').val(amount);
                            $('#price').val(room_price);
                        }
             });

});
</script>
@stop