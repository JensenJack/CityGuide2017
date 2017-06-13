@extends ('backend.layouts.app')

@section ('title', trans('booking::labels.backend.booking.booking_email.management'))

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@stop

@section('page-header')
    <h1>
        {{ trans('booking::labels.backend.booking.booking_email.management') }}
        <small>{{ trans('booking::labels.backend.booking.booking_email.management') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ ucfirst($booking_email->booking->guest_name) }}'s Booking Email {{ trans('booking::labels.backend.booking.booking_email.list') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light portlet-fit portlet-datatable bordered">
                        <div class="portlet-body">
                            @if($booking_email->status == 2)
                                <p class="alert alert-success">Track your ticket in real-time on our site at
                                {{ str_replace('http://', '', url('/')) }}
                                </p>

                                <div class="invoice">
                                    <hr/>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <h3><strong>Your Myanmar Hotel e-Ticket</strong></h3>
                                            <ul class="list-unstyled">
                                                <li>Client Name&nbsp;&nbsp;:
                                                    <strong> {{ $booking_email->booking->check_in_name . ' (' . $booking_email->booking->guest_type . ')' }}
                                                        <br>(NRC No : {{$booking_email->booking->guest_nr}} )</strong>
                                                </li>
                                                <li>Booked By&nbsp;&nbsp;:
                                                    <strong><?php echo $booking_email->booking->guest_name; if ($booking_email->booking->member_id) {
                                                            echo ' (ID : ' . $booking_email->booking->mamber_id. ')';
                                                        } ?></strong></li>
                                                <li>Ticket Number&nbsp;&nbsp;&nbsp;&nbsp; :
                                                    <strong><?php echo $booking_email->booking->booking_ref; ?></strong></li>
                                                <li>Hotel Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                                    <strong style="background-color:yellow;"><?php echo $booking_email->booking->hotels->name; ?></strong>
                                                </li>
                                                <li>Room Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                                    <strong style="background-color:yellow;"><?php echo $booking_email->booking->room->name; ?></strong>
                                                </li>
                                                <li>Number of room :
                                                    <strong><?php echo $booking_email->booking->quantity; ?></strong>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <br>
                                            <table class="table  table-bordered table-hover table-full-width">
                                                <tr>
                                                    <th style="text-align: center;">Price</th>
                                                    <th style="text-align:center;">VOUCHER NO.</th>
                                                    <th style="text-align:center;">Check In Time</th>
                                                    <th style="text-align:center;">Check Out Time</th>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:center;">{{ $booking_email->booking->amount }}</td>
                                                    <td style="text-align:center;">
                                                        <div id="t_voucher_no">{!! $booking_email->voucher_no !!}</div>
                                                    </td>
                                                    <td style="text-align:center;">
                                                        <?php 
                                                            echo $booking_email->booking->check_in_date;
                                                        ?>
                                                    </td>
                                                    <td style="text-align:center;">

                                                        <?php 
                                                            echo $booking_email->booking->check_out_date;
                                                        ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3 text-center">
                                            @if($booking_email->booking->remark)
                                                <p style="text-align:center;color:red"><b>Remark
                                                        : {{ $booking_email->booking->remark }}</b></p>
                                                <br>
                                            @endif
                                            <i>For more information and FAQ, please vist our website at <a
                                                        href="{{ url('/') }}">{{ str_replace('http://', '', url('/')) }}</a>. Terms & Conditions
                                                apply and can be found on our website.Thank you for choosing us. v2.2</i>

                                            <br>
                                            <br>
                                            <img width="5%" src="{{ url('/img/greenmyanmar.png') }} ">
                                            <img width="5%" src="{{ url('/img/daytour.png') }}">
                                            <img width="5%" src="{{ url('/img/codemyanmar.png') }}">
                                            <img width="5%" src="{{ url('/img/bnf.png') }}">
                                            <br>
                                            <br>
                                            <b>Address : {{ config('app.app_setting.address') }}. Email:<a
                                                        href="mailto:{{ config('app.app_setting.ticket_email') }}" target="_blank"
                                                        style="text-decoration: none;color: #ff675f;font-weight: bold;">{{ config('app.app_setting.email') }}</a>
                                                <br>
                                               {{ config('app.app_setting.phone') }}
                                            </b>
                                        </div>
                                    </div>
                                </div>

                            @else

                                @inject('email', 'Modules\Email\Repositories\EmailRepository' )
                                @if($booking_email->status == 1)
                                    <?php
                                        $email_content = $email->get_email_content('initial_booking', $booking_email->booking->language);
                                    ?>
                                @elseif ($booking_email->status == 3)
                                    <?php
                                        $email_content = $email->get_email_content('cancel_booking', $booking_email->booking->language);
                                    ?>
                                @elseif ($booking_email->status == 5)
                                    <?php
                                        $email_content = $email->get_email_content('refund_with_money', $booking_email->booking->language);
                                    ?>
                                @endif

                                <?php

                                $message = $email_content->content;
                                $subject = $email_content->subject;

                                $message = str_replace('{REFUND_AMOUNT}', Session::get('refund_amount'), $message);
                                $message = str_replace('{NAME}', ucfirst($booking_email->booking->guest_name), $message);
                                $message = str_replace('{REF_ID}', $booking_email->booking->booking_ref, $message);

                                $message = str_replace('{NEWLINE}', PHP_EOL, $message);

                                $message = str_replace('{C_REMARK}', Session::get('c_remark'), $message);
                                $message = str_replace('{C_I_TIME}', date('d M Y', strtotime($booking_email->booking->check_in_date)), $message);
                                $message = str_replace('{C_O_TIME}', date('d M Y',strtotime($booking_email->booking->check_out_date)), $message);
                                $message = str_replace('{BASE_URL}', config('app.app_setting.main_logo'), $message);

                                ?>

                                <div class="row">
                                    <div class="portlet-body">
                                        <p style='font-size:13px;padding-left: 15px;'><b>Subject:</b></p>
                                        <div class="controls col-md-12">
                                            {!! $subject !!}
                                        </div>
                                    </div>
                                    <br>
                                    <div class="portlet-body">
                                        <p style='font-size:13px;padding-left: 15px;'><b>Message:</b></p>
                                        <div class="controls col-md-12">
                                            {!! $message !!}
                                        </div>
                                    </div>
                                </div>

                            @endif
                            <br><br>

                            <div class="row">
                                <div class="col-xs-8 invoice-block">
                                    <a class="btn btn-lg btn-primary hidden-print margin-bottom-5" href="{!! route('admin.booking.send_ticket_again' , $booking_email->id ) !!}"> Sent Ticket Again
                                        <i class="fa fa-check"></i>
                                    </a>

                                    @if($booking_email->status == 2 )
                                        <a class="btn btn-lg btn-warning hidden-print margin-bottom-5" target="_blank"
                                           href="{{ route('admin.booking.view_ticket' , $booking_email->id ) }}"> Print
                                            <i class="fa fa-print"></i>
                                        </a>
                                    @endif

                                    {{-- @if($booking_email->status == 2 )
                                        {!! Form::open(['route' => 'admin.booking.send_ticket', 'class' => 'form-horizontal', 'files'=> true ,'role' => 'form', 'method' => 'post' , 'id' => 'compose_email_form']) !!}
                                            <input type="hidden" name="invoice" value="invoice">
                                            <input type="hidden" name="seat_no" value="{{ $booking_email->seat_no }}">
                                            <input type="hidden" name="voucher_no" value="{{ $booking_email->voucher_no }}">
                                            <input type="hidden" name="status" value="{{ $booking_email->status}}">
                                            <input type="hidden" name="booking_id" value="{{ $booking_email->booking->id }}">
                                            <input type="hidden" name="amount" value="{{ $booking_email->booking->amount }}" id="amount">
                                            <input type="hidden" name="ref" value="{{ $booking_email->booking->booking_ref }}" id="ref">
                                            <input type="hidden" name="adult" value="{{ $booking_email->booking->adult }}" id="adult">
                                            <input type="hidden" name="sender" id="sender" readonly="true" value="{{ access()->user()->name }}" class="form-control">
                                            <input type="submit" class="btn btn-lg yellow hidden-print margin-bottom-5" href="#" value="Send New Ticket Mail With Invoice">
                                        {!! Form::close() !!}
                                    @endif --}}
                                    
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div><!--box-body-->
    </div><!--box-->    
@stop

