@extends('frontend.layouts.app')

@section('content')
<div class="top-area show-onload">
    <div class="bg-holder full">
      <div class="bg-img" style="background-image:url(img/frontend/img/Balloons-Bagan-Burma.jpeg);"></div>
      <div class="bg-content">
        <div class="container">
            <div class="row" data-gutter="60">
                <div class="col-md-8">
                    <h3 style="color: white;">Welcome From BookMyanmarHotels</h3>
                    <p style="color: white;">This site is under maintenance.</p>
                    <p style="color: white;"> Thank you!!</p>
                </div>
                <div class="col-md-4">
                    <h3 style="color: white;">Login</h3>
                    <form action="{{route('frontend.auth.login')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                            <label for="email" style="color: white;">Email</label>
                            <input class="form-control" name="email" placeholder="e.g. johndoe@gmail.com" type="text"  />
                        </div>
                        <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                            <label for="password" style="color: white;">Password</label>
                            <input class="form-control" name="password" type="password" placeholder="my secret password" />
                        </div>
                        <input class="btn btn-primary" type="submit" value="Sign in" />
                    </form>
                </div>
            </div>
        </div> <!-- container -->
    </div><!-- bg-content -->
  </div><!-- bg-holder -->
</div><!-- top-area -->
@endsection