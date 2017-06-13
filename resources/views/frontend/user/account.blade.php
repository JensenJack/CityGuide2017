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

            <div class="row">

                <div class="col-xs-12"><br><br>

                    <div class="panel panel-default">
                        <div class="panel-heading"><h2>{{ trans('navs.frontend.user.account') }}</h2></div>

                        <div class="panel-body">

                            <div role="tabpanel">

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#profile_pic" aria-controls="profile_pic" role="tab" data-toggle="tab">{{ trans('navs.frontend.user.profile') }}</a>
                                    </li>

                                    <li role="presentation">
                                        <a href="#edit" aria-controls="edit" role="tab" data-toggle="tab">{{ trans('labels.frontend.user.profile.update_information') }}</a>
                                    </li>

                                    @if ($logged_in_user->canChangePassword())
                                        <li role="presentation">
                                            <a href="#password" aria-controls="password" role="tab" data-toggle="tab">{{ trans('navs.frontend.user.change_password') }}</a>
                                        </li>
                                    @endif
                                </ul>

                                <div class="tab-content">
                                    
                                    <div role="tabpanel" class="tab-pane mt-30 active" id="profile_pic">
                                        @include('frontend.user.account.tabs.profile')
                                    </div><!--tab panel edit-->

                                    <div role="tabpanel" class="tab-pane mt-30" id="edit">
                                        @include('frontend.user.account.tabs.edit')
                                    </div><!--tab panel edit-->

                                    @if ($logged_in_user->canChangePassword())
                                        <div role="tabpanel" class="tab-pane mt-30" id="password">
                                            @include('frontend.user.account.tabs.change-password')
                                        </div><!--tab panel change password-->
                                    @endif

                                </div><!--tab content-->

                            </div><!--tab panel-->

                        </div><!--panel body-->

                    </div><!-- panel -->

                </div><!-- col-xs-12 -->

            </div><!-- row -->
          </div><!--container  -->

        </div><!-- bg-content -->
    </div><!-- bg-holder -->

</div><!-- top-area -->
@endsection