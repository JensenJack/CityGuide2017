@extends('frontend.layouts.app')

@section ('title', app_name() . ' | ' . trans($cms->title))
@section ('meta_keyword', $cms->keyword)
@section ('meta', $cms->meta_tags)

@section('content')
<div class="top-area show-onload">
    <div class="bg-holder full">
       <div class="bg-img" style="background-image:url(/img/frontend/img/Balloons-Bagan-Burma.jpeg);"></div>

		<section class="container">
				
				<br><div class="row">
					<div class="col-md-12" style="background-color: #ffffff;overflow: auto; height: 660px;">
						@if(file_exists(public_path('/img/frontend/img/hotels-icon.png')))
						<br><img src="{{ url('/img/frontend/img/hotels-icon.png') }}" class="img-responsive" style="width: 100%;height: 200px;">
						@endif
					
							<div class="triggerAnimation animated" data-animate="fadeInLeft">
								<h2 class="title-color">{{ trans('frontend.'.$cms->page) }}</h2>
								<hr class="style-hr">
								<h3>{{$cms->title}}</h3>
								{!! $cms->cms_text !!}
							</div>	
					</div>
				</div>
		</section>

   </div> <!-- bg-holder -->
</div> <!-- top-area -->
    <!-- END TOP AREA  -->

@endsection