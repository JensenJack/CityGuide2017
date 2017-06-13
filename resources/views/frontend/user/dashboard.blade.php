@extends('frontend.layouts.app')

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@stop

@section('content')
    <div class="container">
            <h1 class="page-title">Profile</h1>
        </div>


<div class="bg-content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <aside class="user-profile-sidebar">
                    <div class="user-profile-avatar text-center">
                        <img src="{{ Auth()->user()->photo }}" alt="Image Alternative text" title="AMaze" />
                        <h5>{{$logged_in_user->name}}</h5>
                        <p>{{ $logged_in_user->email }}</p>
                        <p>Member Since {{$logged_in_user->created_at->format('F jS, Y')}}</p>
                    </div>
                    <div role="tabpanel">
                        <ul class="list user-profile-nav">
                            <li role="presentation" class="active"><a href="#booking" aria-controls="booking" role="tab" data-toggle="tab"><i class="fa fa-clock-o"></i>Booking History</a>
                            </li>
                            <li role="presentation"><a href="#my_account" aria-controls="my_account" role="tab" data-toggle="tab"><i class="fa fa-cog"></i>Settings</a>
                            </li>
                        </ul>
                    </div>
                </aside>
            </div>
            <div class="tab-content">

                <div role="tabpanel" class="tab-pane mt-30 active" id="booking">
                    <div class="col-md-9">
                            <div>
                               <h2>Booking List</h2>
                            </div>
                            <table class="table table-bordered table-striped table-booking-history">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">Hotel</th>
                                        <th style="text-align: center;">Room</th>
                                        <th>Check In Name</th>
                                        <th>Booking Date</th>
                                        <th>Check In Date</th>
                                        <th>Check Out Date</th>
                                        <th>Amount</th>
                                        <th>Payment Complete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @if(count($bookings) == 0)
                                   
                                    <tr><td colspan="8" style="text-align: center;">No Booking List.</td></tr>
                                    
                                    @else
                                    
                                    @foreach($bookings as $booking)
                                        <tr>
                                            <td class="booking-history-type">
                                            Name:{{$booking->hotels->name}}<br> 
                                            Type:{{$booking->hotels->hotel_category->name}} <br>
                                            City:{{$booking->hotels->city->name}}
                                            </td>
                                            <td class="booking-history-title">
                                            Name:{{$booking->room->name}}<br>
                                            Type:{{$booking->room->room_category->name}}<br>
                                            Quantity:{{$booking->quantity}}
                                            </td>
                                            <td>{{$booking->check_in_name}}</td>
                                            <td>{{date('F j, Y' , strtotime($booking->created_at))}}</td>
                                            <td>{{date('F j, Y' , strtotime($booking->check_in_date))}}</td>
                                            <td>{{date('F j, Y' , strtotime($booking->check_out_date))}}</td>
                                            <td >{{$booking->amount}}</td>
                                            @if($booking->payment_complete == 0)
                                            <td>Unpaid</td>
                                            @elseif($booking->payment_complete == 1)
                                             <td>Paid</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                   @endif
                                </tbody>
                            </table>
                            {{ $bookings->links() }}
                    </div> <!-- col-md-9 -->
                </div> <!-- tabpanel -->

                <div role="tabpanel" class="tab-pane mt-30" id="my_account">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-5">
                                <form action="{{route('frontend.user.profile.photo')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <div class="img-acount">
                                        @if (Auth::user()->photo != null)
                                            <img src="{{ Auth::user()->photo }}" style="width: 200px; height: 200px;" 
                                                alt="{{ Auth::user()->name }}">
                                        @else
                                            <img src="{{ asset('frontend/images/default.png') }}" 
                                                alt="{{ Auth::user()->name }}">
                                        @endif
                                    </div>
                                    <div class="choses-file up-file">
                                        <input type="file" name="image" id="image">
                                    </div>
                                    <hr>
                                    <input type="submit" class="btn btn-primary hide" value="Change Profile" id="profile_upload">
                                </form>
                                <form action="{{route('frontend.user.profile.update')}}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}
                                <h4>Personal Infomation</h4>
                                <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
                                    <label> Name</label>
                                    <input class="form-control" name="name" type="text" value="{{ $logged_in_user->name }}" />
                                </div>
                                <div class="form-group form-group-icon-left"><i class="fa fa-envelope input-icon"></i>
                                    <label>E-mail</label>
                                    <input name="email" class="form-control" value="{{ $logged_in_user->email }}" type="text" />
                                </div>
                                <div class="form-group form-group-icon-left"><i class="fa fa-phone input-icon"></i>
                                    <label>Phone Number</label>
                                    <input name="phone_number" class="form-control" value="{{ $logged_in_user->phone_number }}" type="text" />
                                </div>
                                
                                <hr>
                                <input type="submit" class="btn btn-primary" value="Save Changes">
                            </form>
                            </div>
                            <div class="col-md-4 col-md-offset-1">
                                <h4>Change Password</h4>
                                <form action="{{route('frontend.auth.password.change')}}" method="post">
                                     {{ csrf_field() }}
                                     {{ method_field('PATCH') }}
                                    <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                                        <label>Current Password</label>
                                        <input class="form-control" type="password" name="old_password" />
                                    </div>
                                    <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                                        <label>New Password</label>
                                        <input class="form-control" type="password" name="password" />
                                    </div>
                                    <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                                        <label>New Password Again</label>
                                        <input class="form-control" type="password" name="password_confirmation" />
                                    </div>
                                    <hr />
                                    <input class="btn btn-primary" type="submit" value="Change Password" />
                                </form>
                            </div>
                        </div>
                    </div> <!-- col-md-9 -->
                </div><!--  tab-panel -->
            </div> <!-- tab-content -->
        </div> <!-- row -->
    </div><!--  container -->
</div><!-- bg-content -->

@endsection


@section('after-scripts')
    <script type="text/javascript">

         $("input[type='file']").change(function(){
               $("#profile_upload").removeClass('hide');
            });
    </script>
@stop
