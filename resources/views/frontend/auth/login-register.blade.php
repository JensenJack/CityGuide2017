@extends('frontend.layouts.app')

@section('content')
<div class="top-area show-onload">
    <div class="bg-holder full">
      <div class="bg-img" style="background-image:url(img/frontend/img/2048x1365.png);"></div>
        <video class="bg-video hidden-sm hidden-xs" preload="auto" autoplay="true" loop="loop" muted="muted" poster="img/video-bg.jpg">
          <source src="media/loop.webm" type="video/webm" />
          <source src="media/loop.mp4" type="video/mp4" />
       </video>
      <div class="bg-content">
        <div class="container">
             @include('includes.partials.messages')
            <div class="row" data-gutter="60">
                <div class="col-md-4">
                    <h3>Welcome From BookMyanmarHotels</h3>
                    <p>Books hotels here!!!</p>
                    <p>Thank you!!</p>
                </div>
                {{-- <div class="col-md-4">
                    <h3>Login</h3>
                    <form action="{{route('frontend.auth.login')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                            <label>Email</label>
                            <input class="form-control" name="email" placeholder="e.g. johndoe@gmail.com" type="text"  />
                        </div>
                        <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                            <label>Password</label>
                            <input class="form-control" name="password" type="password" placeholder="my secret password" />
                        </div>
                        <input class="btn btn-primary" type="submit" value="Sign in" />
                    </form>
                </div> --}}
                <div class="col-md-4">
                    <h3>New To Traveler?</h3>
                    <form action="{{route('frontend.auth.register')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                            <label>Full Name</label>
                            <input class="form-control" name="name" placeholder="e.g. John Doe" type="text" />
                        </div>
                        <div class="form-group form-group-icon-left"><i class="fa fa-envelope input-icon input-icon-show"></i>
                            <label>Email</label>
                            <input class="form-control" name="email" placeholder="e.g. johndoe@gmail.com" type="text" />
                        </div>
                        <div class="form-group form-group-icon-left"><i class="fa fa-phone input-icon input-icon-show"></i>
                            <label>Phone Number</label>
                            <input class="form-control" name="phone_number" type="text" placeholder="your phone number" />
                        </div>
                        <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                            <label>Password</label>
                            <input class="form-control" name="password" type="password" placeholder="my secret password" />
                        </div>
                        <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                            <label>Password Confirmation</label>
                            <input class="form-control" name="password_confirmation" type="password" placeholder="my secret password" />
                        </div>
                        <input class="btn btn-primary" type="submit" value="Sign up for Traveler" />
                    </form>
                </div>
            </div>
        </div> <!-- container -->
    </div><!-- bg-content -->
  </div><!-- bg-holder -->
</div><!-- top-area -->
@endsection