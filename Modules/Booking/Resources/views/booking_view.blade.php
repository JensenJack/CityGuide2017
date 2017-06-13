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
            <h3 class="box-title">{{ trans('booking::labels.backend.booking.booking_email.management') }}</h3>

            <div class="box-tools pull-right">
               <div class="pull-right mb-10 hidden-sm hidden-xs">
                <a href="{{ route('admin.booking.compose_email',$booking->id)}}"><button style="color:red;">{{trans('booking::menus.backend.booking.send_new_email')}}</button></a>
                </div>

            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="booking-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>{{ trans('booking::labels.backend.booking.table.id') }}</th>
                            <th>{{ trans('booking::labels.backend.booking.table.booking_date') }}</th>
                            <th>{{ trans('booking::labels.backend.booking.table.booking_ref') }}</th>
                            <th>{{ trans('booking::labels.backend.booking.table.client_info') }}</th>
                            <th>{{ trans('booking::labels.backend.booking.table.hotel_name') }}</th>
                            <th>{{ trans('booking::labels.backend.booking.table.room_name') }}</th>                                                   
                            <th>{{ trans('booking::labels.backend.booking.table.booking_info') }}</th>
                             <th>{{ trans('booking::labels.backend.booking.table.amount') }}</th>                                 
                             <th>{{ trans('booking::labels.backend.booking.table.payment_method') }}</th>                                 
                             <th>{{ trans('booking::labels.backend.booking.table.status') }}</th>                                 
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->
@stop

@section('after-scripts')
    {{ Html::script("js/backend/plugin/datatables/jquery.dataTables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables.bootstrap.min.js") }}

    <script>
        $(function() {

            $('#booking-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.booking_email.get",$booking->id) }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'booking_ref', name: 'booking_ref'},
                    {data: 'client_info', name: 'guest_email'},
                    {data: 'hotel', name: 'hotel_id'},
                    {data: 'room', name: 'room_id'}, 
                    {data: 'booking_info', name: 'booking_expire'},
                    {data: 'amount_info', name: 'amount'},
                    {data: 'payment', name: 'payment_method'},
                    {data: 'status', name: 'status'},     
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[0, "desc"]],
                searchDelay: 500
            });


        });
    </script>
@stop