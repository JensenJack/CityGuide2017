@extends('frontend.layouts.app')

@section ('title', app_name() . ' | Booking Confirmation')

@section('content')

<div class="top-area show-onload">
	 <div class="bg-holder full">
         <div class="bg-mask"></div>
	 	 <div class="bg-img" style="background-image:url(/img/frontend/img/2048x1365.png);"></div>
         <video class="bg-video hidden-sm hidden-xs" preload="auto" autoplay="true" loop="loop" muted="muted" poster="img/video-bg.jpg">
          <source src="/media/loop.webm" type="video/webm" />
          <source src="/media/loop.mp4" type="video/mp4" />
         </video>
        <div class="bg-content" >

				<br><br><section class="container">
						<div class="row">
								<div class="col-md-12 bg-white margin-bottom margin-top-50" style="overflow: auto; height:650px; background-color: #e0d0ba;">
									<div class="triggerAnimation animated" data-animate="fadeInLeft">
										<h2 class="title-color">Booking Payment Confirmation</h2>
										<hr class="style-hr">
									</div>
									<p class="text-justify">

									@if($show_form)

				                    		{!! Form::open(['url' => $form_values['url']]) !!}

										                <?php

										                  $left_timestamp = strtotime('+ 7days',time()) - strtotime($booking->travel_date);
										                  if($left_timestamp > 0)
										                   {
										                            echo "<h4 style='text-align:center;margin-top: 20px;line-height: 40px;'>Due to huge demand with close travel date booking, we can’t guarantee the room unless complete ticket with room number is issued after the payment is cleared. Please be ensured that we will try our best to get you best room.  However, if all rooms should run out, we will do 100% full refund to you immediately.</h4>";
										                   }

										                  ?>
										                 {!! $form_values['values'] !!}
										                <h4 style="text-align:center;margin-top: 80px">If full payment is made, our operator will review the booking and respond within 48 hours.</h4>

										                @if($currency == 'USD')
										                <h3 style="text-align:center;margin-top: 3px">Yes I confirm to Pay {{ $usd_amount }} {{ $currency }} now.<br><br>
										                @else
										                <h3 style="text-align:center;margin-top: 3px">Yes I confirm to Pay {{ $mmk_amount }} {{ $currency }} now.<br><br>
										                @endif

										                <button type="submit" style="border: none;background-color: #fff">
										                	<img src="{{ URL::to('img/buynow.gif') }}" alt="Buy Now!!!" >
										                </button>
										                </h3>	
					                    {!! Form::close() !!}

									@else

										@if(isset($form_values['method']) && $form_values['method'] == 'truemoney')

											<h3 style="text-align:center;"> Your Booking has been saved successfully.</h3>

				            				<h3 style="text-align:center;"> Your Booking payment of True Money Reference Number is <span style="color: red">{{ $form_values['data']->tmmRefNo }} </span>. Please take this code to a True Money store and pay within 24 hours !</h3>

										@endif

										@if(isset($form_values['method']) && $form_values['method'] == 'account' && $form_values['data'])

											<h3 style="text-align:center;"> Your Booking Payment has been successfully made by Deposit Account.</h3>

				            				<h3 style="text-align:center;"> Your Booking Reference Number is <span style="color: red"> {{ $form_values['data'] }} </span>. Agent will contact you very soon.</h3>

				            			@elseif(isset($form_values['method']) && $form_values['method'] == 'account' && access()->user())

											<h3 style="text-align:center;"> Your Booking has been saved successfully.</h3>

				            				<h3 style="text-align:center;"> <span style="color: red">Insufficient Balance! </span><br/>Please refill amount to your deposit account. Agent will contact you very soon.</h3>

				            			@elseif(isset($form_values['method']) && $form_values['method'] == 'account')

											<h3 style="text-align:center;"> Your Booking has been saved successfully.</h3>

				            				<h3 style="text-align:center;"> <span style="color: red">You must login to checkout with your deposit account. </span></h3>

										@endif
										<br>
										<h3 style="text-align:center;"> Please feel free to email {{ config('app.email') }} if you need further information or assistance.</h3>

									@endif								
									</p>
								</div>
						</div>
				</section>

		</div> <!--  bg-content -->
    </div><!--  bg-holder -->
</div><!--  top-area -->				

@endsection