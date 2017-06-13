@extends ('backend.layouts.app')

@section ('title', trans('appsetting::labels.backend.appsetting.management'))

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
    {{ Html::style("build/jquery-minicolors-master/jquery.minicolors.css") }}
@stop

@section('page-header')
    <h1>
        {{ trans('appsetting::labels.backend.appsetting.management') }}
        <small>{{ trans('appsetting::labels.backend.appsetting.management') }}</small>
    </h1>
@endsection


@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('appsetting::labels.backend.appsetting.management') }}</h3>

            <div class="box-tools pull-right">
                @if(access()->allow('restore-app-settings'))
                <div class="actions">
                    <button type="button" id="restore_setting" class="btn red danger">Restore Default Settings</button>
                </div>
                @endif
               
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body form">
            <?php 
                if(old('tab')) $tab=old('tab');
                elseif(isset($_GET['tab'])) $tab=$_GET['tab'];
                else $tab='basic';
                ?>
                <div class="tabbable-line">
                    <ul class="nav nav-tabs nav-tabs-lg">
                        @if(access()->allow('basic-app-settings'))
                        <li class="{{ ($tab=='basic')?'active':'' }}">
                            <a href="#basic" data-toggle="tab"> Basic Setting</a>
                        </li>
                        @endif
                        @if(access()->allow('theme-app-settings'))
                        <li class="{{ ($tab=='theme')?'active':'' }}">
                            <a href="#theme" data-toggle="tab"> Theme Setting
                            </a>
                        </li>
                        @endif
                        @if(access()->allow('booking-app-settings'))
                        <li class="{{ ($tab=='booking')?'active':'' }}">
                            <a href="#booking" data-toggle="tab"> Booking Setting
                            </a>
                        </li>
                        @endif
                        @if(access()->allow('payment-app-settings'))
                        <li class="{{ ($tab=='payment')?'active':'' }}">
                            <a href="#payment" data-toggle="tab"> Payment Setting</a>
                        </li>
                        @endif
                        @if(access()->allow('email-app-settings'))
                        <li class="{{ ($tab=='email')?'active':'' }}">
                            <a href="#email" data-toggle="tab"> Email & SMS Setting
                            </a>
                        </li>
                        @endif
                    </ul>
                    <div class="tab-content">
                        @if(access()->allow('basic-app-settings'))
                        <div class="tab-pane {{ ($tab=='basic')?'active':'' }}" id="basic">
                                {!! Form::open(['route' => 'admin.appsetting.store','files'=> true , 'role' => 'form', 'method' => 'post']) !!}
                                {!! Form::hidden('tab','basic') !!}

                                <div class="form-group form-md-line-input">
                          
                                <label for="app_name" class="col-md-2 control-label">App Theme</label>
                                 <div class="col-md-10">
                                  <select name="app_theme" id="app_theme" class="form-control">
                                     @foreach(config('backend.availiable_themes_list') as $theme)
                                         <option value="{{ $theme }}" {{ ($theme == config('backend.theme'))?'selected':'' }}>{{ ucfirst($theme) }}</option>
                                     @endforeach
                                 </select>
                                 </div>
                                </div><br><br>

                                <div class="form-group {{ $errors->has('main_logo') ? ' has-error' : '' }}">
                                    <label for="MAIN_LOGO" class="control-label col-md-2">App Main Logo</label>
                                 
                                     <div class="col-md-10">
                                        <input type="file" value="{{ config('app.app_setting.main_logo') }}" id="main_logo" name="main_logo" class="form-control"><br>
                                        @if(config('app.app_setting.main_logo'))
                                           <img src="{{ config('app.app_setting.main_logo') }}" class="thumbnail"  style="width: 200px; height: 150px;">
                                        @endif
                                    </div>
                                </div><br><br>
                                  
                            
                                <div class="form-group {{ $errors->has('app_favicon') ? ' has-error' : '' }}">
                                     <br>
                                     <label for="APP_FAVICON" class="control-label col-md-2">App Favicon</label>
                                     <div class="col-md-10">
                                       <input type="file" value="{{ config('app.app_setting.favicon') }}" id="app_favicon" name="app_favicon" class="form-control"><br>
                                        @if(config('app.app_setting.favicon'))
                                        <img src="{{ config('app.app_setting.favicon') }}" class="thumbnail"  style="width: 200px; height: 150px;">
                                        @endif
                                    </div>  
                                </div><br><br>


                                <div class="form-group form-md-line-input">
                                
                                    <label for="app_name" class="col-md-2 control-label">App Name</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('app.app_setting.name') }}" id="app_name" name="app_name" class="form-control"><br>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                  
                                     <label for="appstore" class="col-md-2 control-label">Applestore Link</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('app.app_setting.appstore') }}" id="appstore" name="appstore" class="form-control"><br><br>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label for="playstore" class="col-md-2 control-label">Google playstore Link</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('app.app_setting.playstore') }}" id="playstore" name="playstore" class="form-control"><br>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                
                                     <label for="facebook" class="col-md-2 control-label">Facebook Link</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('app.app_setting.facebook') }}" id="facebook" name="facebook" class="form-control"><br>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    
                                     <label for="googleplus" class="col-md-2 control-label">Google Plus Link</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('app.app_setting.googleplus') }}" id="googleplus" name="googleplus" class="form-control"><br>
                                    </div>
                                </div>

                                 <div class="form-group form-md-line-input">
                                    
                                     <label for="app_email" class="col-md-2 control-label">App Email</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('app.app_setting.email') }}" id="app_email" name="app_email" class="form-control"><br>
                                    </div>
                                </div>

                                 <div class="form-group form-md-line-input">
                                    
                                     <label for="ticket_email" class="col-md-2 control-label">Ticket Email</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('app.app_setting.ticket_email') }}" id="ticket_email" name="ticket_email" class="form-control"><br>
                                    </div>
                                </div>

                                 <div class="form-group form-md-line-input">
                                    
                                     <label for="app_phone" class="col-md-2 control-label">Emengency Phone No.</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('app.app_setting.phone') }}" id="app_phone" name="app_phone" class="form-control"><br>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                               
                                     <label for="app_address" class="col-md-2 control-label">Address</label>
                                    <div class="col-md-10">
                                     <textarea  id="app_address" name="app_address" class="form-control">{{ config('app.app_setting.address') }}</textarea><br>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                     <label for="date_format" class="col-md-2 control-label">Date Format</label>
                                    <div class="col-md-10">
                                     <select name="date_format" id="date_format" class="form-control">
                                        @foreach(config('app.date_format_list') as $date_format)
                                         <option value="{{ $date_format }}" {{ ($date_format == config('app.app_setting.date_format'))?'selected':'' }}>{{ ucfirst($date_format) }}</option>
                                     @endforeach
                                 </select><br>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                     <label for="time_format" class="col-md-2 control-label">Time Format</label>
                                    <div class="col-md-10">
                                     <select name="time_format" id="time_format" class="form-control">
                                        @foreach(config('app.time_format_list') as $time_format)
                                         <option value="{{ $time_format }}" {{ ($time_format == config('app.app_setting.time_format'))?'selected':'' }}>{{ ucfirst($time_format) }}</option>
                                     @endforeach
                                 </select><br>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                     <label for="date_time_format" class="col-md-2 control-label">Date-Time Format</label>
                                    <div class="col-md-10">
                                     <select name="date_time_format" id="date_time_format" class="form-control">
                                        @foreach(config('app.date_time_format_list') as $date_time_format)
                                         <option value="{{ $date_time_format }}" {{ ($time_format == config('app.app_setting.date_time_format'))?'selected':'' }}>{{ ucfirst($date_time_format) }}</option>
                                     @endforeach
                                 </select><br>
                                    </div>
                                </div>



                                <div class="form-group form-md-line-input">
                                    
                                     <label for="app_tnc" class="col-md-2 control-label">Booking Terms & Conditions</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('app.app_setting.tnc') }}" id="app_tnc" name="app_tnc" class="form-control"><br>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    
                                     <label for="app_ref" class="col-md-2 control-label">Reference No. Prefix</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('app.app_setting.ref') }}" id="app_ref" name="app_ref" class="form-control"><br>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    
                                     <label for="app_dollar_rate" class="col-md-2 control-label">Dollar Exchange Rate</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('app.app_setting.dollar_rate') }}" id="app_dollar_rate" name="app_dollar_rate" class="form-control"><br>
                                    </div>
                                </div>

                                 <div class="form-group form-md-line-input">
                                    
                                     <label for="google_map" class="col-md-2 control-label">Google Map API Key</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('app.app_setting.map_key') }}" id="google_map" name="google_map" class="form-control"><br>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="pull-right">
                                        <input type="submit" class="btn btn-success" value="{{ trans('buttons.general.crud.update') }}" ><br>
                                    </div>
                                </div>

                            {!! Form::close() !!}
                          
                        </div> <!-- tab-pane -->
                        @endif
                        @if(access()->allow('theme-app-settings'))
                        <div class="tab-pane {{ ($tab=='theme')?'active':'' }}" id="theme">
                            {!! Form::open(['route' => 'admin.appsetting.store','files'=> true , 'role' => 'form', 'method' => 'post']) !!}
                            {!! Form::hidden('tab','theme') !!}

                                <div class="form-group form-md-line-input">
                                    
                                    <label for="app_color" class="col-md-2 control-label">Main Color</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('app.app_setting.color') }}" id="app_color" name="app_color" class="form-control demo"><br>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <br>
                                    <label for="app_font_color" class="col-md-2 control-label">Font Color</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('app.app_setting.font_color') }}" id="app_font_color" name="app_font_color" class="form-control demo"><br>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    
                                    <label for="app_border_color" class="col-md-2 control-label">Border & Hover Color</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('app.app_setting.border_color') }}" id="app_border_color" name="app_border_color" class="form-control demo"><br>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="pull-right">
                                        <input type="submit" class="btn btn-success" value="{{ trans('buttons.general.crud.update') }}" ><br>
                                    </div>
                                </div>

                            {!! Form::close() !!}
                          
                        </div> <!-- tab-pane -->
                        @endif
                        @if(access()->allow('booking-app-settings'))
                        <div class="tab-pane {{ ($tab=='booking')?'active':'' }}" id="booking">
                            {!! Form::open(['route' => 'admin.appsetting.store','files'=> true , 'role' => 'form', 'method' => 'post']) !!}
                            {!! Form::hidden('tab','booking') !!}

                                <div class="form-group form-md-line-input">
                                  
                                    <label for="max_adult" class="col-md-2 control-label">Maximum Adult Book Qty</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('booking.max_adult') }}" id="max_adult" name="max_adult" class="form-control"><br>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                              
                                    <label for="before_block_min" class="col-md-2 control-label">Before Block Minutes</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('booking.before_block_min') }}" id="before_block_min" name="before_block_min" class="form-control"><br>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                   
                                    <label for="room_hold_min" class="col-md-2 control-label">Room Hold Minutes</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('booking.room_hold_min') }}" id="room_hold_min" name="room_hold_min" class="form-control"><br>
                                    </div>
                                </div>

                                 <div class="form-group form-md-line-input">
                                   
                                    <label for="refund_coupon_expiry_min" class="col-md-2 control-label">Refund Coupon Expiry Minutes</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('booking.refund_coupon_expiry_min') }}" id="refund_coupon_expiry_min" name="refund_coupon_expiry_min" class="form-control"><br>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    
                                    <label for="booking_email" class="col-md-2 control-label">Booking Noti Email</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('booking.email') }}" id="booking_email" name="booking_email" class="form-control"><br>
                                    </div>
                                </div>

                                 <div class="form-group form-md-line-input">
                                    
                                    <label for="all_booking_expiry_min" class="col-md-2 control-label">All Booking Expire Minutes</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('booking.all_booking_expiry_min') }}" id="all_booking_expiry_min" name="all_booking_expiry_min" class="form-control"><br>
                                    </div>
                                </div>

                                 <div class="form-group form-md-line-input">
                                    
                                    <label for="reseller_default_margin" class="col-md-2 control-label">Reseller Default Margin Amount</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('booking.reseller_default_margin') }}" id="reseller_default_margin" name="reseller_default_margin" class="form-control"><br>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="pull-right">
                                        <input type="submit" class="btn btn-success" value="{{ trans('buttons.general.crud.update') }}" ><br>
                                    </div>
                                </div>

                            {!! Form::close() !!}
                          
                        </div> <!-- tab-pane -->
                        @endif
                         @if(access()->allow('payment-app-settings'))
                        <div class="tab-pane {{ ($tab=='payment')?'active':'' }}" id="payment">
                            {!! Form::open(['route' => 'admin.appsetting.store','files'=> true , 'role' => 'form', 'method' => 'post']) !!}
                            {!! Form::hidden('tab','payment') !!}

                                @include('appsetting::includes.paylater')

                                @include('appsetting::includes.ok')

                                @include('appsetting::includes.paypal')

                                @include('appsetting::includes.mpu')

                                @include('appsetting::includes.truemoney')

                                @include('appsetting::includes.transfer')

                                @include('appsetting::includes.onetwothree')

                                @include('appsetting::includes.visa_master')

                                @include('appsetting::includes.mab')

                                @include('appsetting::includes.deposit')

                            
                                
                
                                <div class="form-group">
                                    <div class="pull-right">
                                        <input type="submit" class="btn btn-success" value="{{ trans('buttons.general.crud.update') }}" ><br>
                                    </div>
                                </div>
                              

                            {!! Form::close() !!}
                          
                        </div> <!-- tab-pane -->
                        @endif

                        @if(access()->allow('email-app-settings'))
                        <div class="tab-pane {{ ($tab=='email')?'active':'' }}" id="email">
                            {!! Form::open(['route' => 'admin.appsetting.store','files'=> true , 'role' => 'form', 'method' => 'post']) !!}
                            {!! Form::hidden('tab','email') !!}

                                
                                <div class="caption">
                                    <span class="caption-subject font-dark sbold uppercase">SMS</span>
                                </div>
                                <div class="form-group form-md-checkboxes">                            
                                    <label for="sms_enable" class="col-md-2 control-label">Send SMS</label>
                                        <div class="md-checkbox">
                                        <input type="checkbox" name="sms_enable" id="sms_enable" {{ (config('app.app_setting.sms.enable'))?'checked="checked"':'' }} value="true" class="md-check">
                                        <label for="sms_enable">
                                        <span class=""></span>
                                        <span class="check"></span>
                                        <span class="box"></span> Enable</label>
                                        </div>
                                </div>

                                <div class="form-group form-md-line-input">                                 
                                <label for="sms_server" class="col-md-2 control-label">SMS Host</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('app.app_setting.sms.server') }}" id="sms_server" name="sms_server" class="form-control"><br>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">                                 
                                <label for="sms_token" class="col-md-2 control-label">SMS User Token</label>
                                    <div class="col-md-10">
                                    <textarea  id="sms_token" name="sms_token" class="form-control">{{ config('app.app_setting.sms.token') }}</textarea><br>
                                    </div>
                                </div>

                                <div class="caption">
                                     <span class="caption-subject font-dark sbold uppercase">Email</span>
                                </div>

                                <div class="form-group form-md-line-input">                                 
                                <label for="mail_driver" class="col-md-2 control-label">Mail Driver</label>
                                    <div class="col-md-10">
                                    <select name="mail_driver" class="form-control">
                                      @foreach(config('mail.avaliable_drivers') as $driver)
                                     <option value="{{ $driver }}" {{ ($driver == config('mail.driver'))?'selected':'' }}>{{ ucfirst($driver) }}</option>
                                      @endforeach
                                    </select><br>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">                                 
                                <label for="mail_host" class="col-md-2 control-label">Mail Host</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('mail.host') }}" id="mail_host" name="mail_host" class="form-control"><br>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">                                 
                                <label for="mail_port" class="col-md-2 control-label">Mail Port</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('mail.port') }}" id="mail_port" name="mail_port" class="form-control"><br>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">                                 
                                <label for="mail_username" class="col-md-2 control-label">Mail Username</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('mail.username') }}" id="mail_username" name="mail_username" class="form-control"><br>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">                                 
                                <label for="mail_password" class="col-md-2 control-label">Mail Password</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('mail.password') }}" id="mail_password" name="mail_password" class="form-control"><br>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">                                 
                                <label for="mail_encryption" class="col-md-2 control-label">Mail Encryption</label>
                                    <div class="col-md-10">
                                    <input type="text" value="{{ config('mail.encryption') }}" id="mail_encryption" name="mail_encryption" class="form-control"><br>
                                    </div>
                                </div>
                
                                <div class="form_group">
                                    <div class="pull-right">
                                        <input type="submit" class="btn btn-success" value="{{ trans('buttons.general.crud.update') }}" ><br>
                                    </div>
                                </div>
                              

                            {!! Form::close() !!}
                          
                        </div> <!-- tab-pane -->
                        @endif
                    </div> <!-- tab-content -->
                </div> <!-- tabble-line -->
            
               
        </div><!-- /.box-body -->
    </div><!--box-->

@stop

@section('after-scripts')

{{ Html::script("js/backend/plugin/datatables/jquery.dataTables.min.js") }}
{{ Html::script("js/backend/plugin/datatables/dataTables.bootstrap.min.js") }}
{{ Html::script("build/jquery-minicolors-master/jquery.minicolors.js") }}

<script type="text/javascript">

     $(document).ready(function() {
        $('demo').minicolors();
        $('.demo').each(function() {
            //
            // Dear reader, it's actually very easy to initialize MiniColors. For example:
            //
            //  $(selector).minicolors();
            //
            // The way I've done it below is just for the demo, so don't get confused
            // by it. Also, data- attributes aren't supported at this time...they're
            // only used for this demo.
            //
            $(this).minicolors({
                control: $(this).attr('data-control') || 'hue',
                defaultValue: $(this).attr('data-defaultValue') || '',
                inline: $(this).attr('data-inline') === 'true',
                letterCase: $(this).attr('data-letterCase') || 'lowercase',
                opacity: $(this).attr('data-opacity'),
                position: $(this).attr('data-position') || 'bottom left',
                change: function(hex, opacity) {
                    if (!hex) return;
                    if (opacity) hex += ', ' + opacity;
                    if (typeof console === 'object') {
                        console.log(hex);
                    }
                },
                theme: 'bootstrap'
            });

        });

        $('#restore_setting').click(function () {


            swal({
              title: "Are you sure?",
              text: "You are going to restore the default setting of App Setting!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, restore it!",
              cancelButtonText: "No, cancel plx!",
              closeOnConfirm: false,
              closeOnCancel: false
            },
            function(isConfirm){
              if (isConfirm) {
                $.ajax({
                                type: 'get',
                                url: '{{ route('admin.appsetting.restore') }}',
                                data: '',
                                success: function (data, textStatus, jQxhr) {
                                    swal("Success", "Successfully restored!)", "success");
                                    location.reload();
                                }
                });
              }
              else {
                swal("Cancelled", "You cancelled the action!)", "error");
              }
            });
        });



            // bootbox.dialog({
            //     message: 'Are you sure ? To Restore Default App Settings',
            //     title: 'Restore Default',
            //     buttons: {
            //         danger: {
            //             label: "Cancel",
            //             className: "red",
            //         },
            //         success: {
            //             label: "Restore Now",
            //             className: "btn-success",
            //             callback: function () {
            //                 $.ajax({
            //                     type: 'get',
            //                     url: '{{ route('admin.appsetting.restore') }}',
            //                     data: '',
            //                     success: function (data, textStatus, jQxhr) {
            //                         toastr.success("{!! trans('alerts.backend.appsetting.restore') !!}");
            //                         location.reload();
            //                     },
            //                     error : function () {

            //                     }
            //                 });
            //             }
            //         }
            //     }
            // });
        
        
     });
    </script>
@stop