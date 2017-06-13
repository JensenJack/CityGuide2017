@extends('frontend.layouts.app')

@section ('title', app_name() . ' | Booking Information')

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
							<div class="col-md-12 bg-white margin-bottom margin-top-50" style="background-color: white;">
								<div class="triggerAnimation animated" data-animate="fadeInLeft">
									<h2 class="title-color">Booking Payment Informations</h2>
									<hr class="style-hr">
								</div>
								<p class="text-justify">

									@if($method == 'transfer')
										<h3 style="text-align:center;"> သင့္ရဲ႕ Booking နံပါတ္မွာ 
										<span style="color: red">{{ $response['ref'] }} </span></h3>

			            				<h3 style="text-align:center;line-height: 35px;">သင့္၏ Booking အတြက္ {{ $response['bank_name'] }} ဘဏ္ သို႔ေငြေပးေခ်ၿပီး {{ config('app.phone') }} သို႔ ေက်းဇူးၿပဳ၍ အေႀကာင္းႀကားေပးပါရန္။</h3>

			           					<!-- <h3 style="text-align:center;"> ဘဏ္မွတစ္ဆင့္ ေငြေပးေခ်မွူကို လက္ခံရရွိပါက SMS Message ၿပန္လည္ေပးပို႔ၿခင္းၿဖင့္ ဆက္သြယ္ပါမည္။</h3> -->
									@endif

									@if($method == 'visa_master' || $method == 'paypal' || $method == 'mab' || $method == 'mpu')

										@if($response['paid'])

											<h3 style="text-align:center;"> Your Booking payment has been made successfully .</h3>
			            					<h3 style="text-align:center;"> Your Booking Reference Number is <span style="color: red">{{ $response['ref'] }} </span>.<br> ေက်းဇူးအထူးတင္ရွိပါသည္။</h3>

										@else

										   <h3 style="text-align:center;"> Sorry, your booking payment status was {{ $response['message'] }}.</h3>
			            				   <h3 style="text-align:center;"> Your Booking Reference Number is 
			            				   <span style="color: red">{{ $response['ref'] }} </span>.<br> 
			            				   You can also pay this payment manually later with above Reference Number.</h3>

										@endif

									@endif

									@if($method == 'onetwothree')

										<h4 style="text-align:center;padding: 21px 21px 0px 21px;"> Your Booking's payment of 1-2-3 Service Payment Code is <span style="color: red">{{ $response['ref'] }} </span>. Please take this payment code to any shop which can accept payment for 1-2-3 service and pay within 24 hours !</h4>

						                <h4 style="margin-left: 3.6%;padding-top: 23px">The following convenience stores and banks can accept 1-2-3 service.</h4>
						                <ul style="list-style: inside;width: 100%;margin-left: 0%;font-size: 18px;">
						                    <li>Pay with 1-STOP at G & G Convenience Store, Capital Hypermarket, Lu Gyi Min, E-City, Mr.Fone, Angel Fashion, Myanma Awba and other shops with 1-STOP Logo</li>
						                    <li>Pay with PayHere at ABC Convenience Store and other shops with PayHere Logo</li>
						                    <li>Pay with @POST at Myanmar Post Office with @POST Logo</li>
						                    <li>Pay at the branches of AGD, UAB, CB and KBZ Bank.</li>
						                </ul>

									@endif
									<br>
									<h3 style="text-align:center;"> ထပ္မံသိရွိလိုသည္မ်ားရွိပါက {{ config('app.phone') }} သို့ဆက္သြယ္ေမးၿမန္းနိုင္ပါသည္။</h3> <h3 style="text-align:center;">ေက်းဇူးအထူးတင္ရွိပါသည္။</h3>

								</p>
							</div>
					</div>
			</section>
			<div class="clearfix"></div>

		</div> <!--  bg-content -->
    </div><!--  bg-holder -->
</div><!--  top-area -->

@endsection