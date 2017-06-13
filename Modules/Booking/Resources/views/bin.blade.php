@extends ('backend.layouts.app')

@section ('title', trans('booking::labels.backend.booking.management'))

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@stop

@section('page-header')
    <h1>
        {{ trans('booking::labels.backend.booking.management') }}
        <small>{{ trans('booking::labels.backend.booking.management') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('booking::labels.backend.booking.management') }}</h3>

            <div class="box-tools pull-right">
                @include('booking::partials.header-buttons')
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
    {{-- {!! Html::script('build/bootbox/bootbox.min.js') !!} --}}

    <script>
        $(function() {
            $('#booking-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.delete_booking.get") }}',
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
                    {data: 'payment_method', name: 'payment_method'},
                    {data: 'status', name: 'status'},     
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                // fnDrawCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {

                //     $('.addRemark').click(function(){
                //         var link = $(this).attr('data-url');
                //         var rel_txt    = $(this).attr('data-value');
                //         var ref    = $(this).attr('rel');

                //         var title    =  '{{ trans('booking::labels.backend.booking.table.remark_title') }}' + ref ;

                //         bootbox.prompt({
                //             title: title ,
                //             value: rel_txt ,
                //             buttons: {
                //                 'cancel': {
                //                     label: 'Later',
                //                     className: 'btn green col-md-4 pull-left'
                //                 },
                //                 'confirm': {
                //                     label: 'Save Now',
                //                     className: 'btn red col-md-4 pull-right'
                //                 }
                //             },
                //             callback: function(result) {
                //                 if (result) {
                //                     $.ajax({
                //                         type: 'POST',
                //                         url: link,
                //                         data: {
                //                             remark : result
                //                         },
                //                         success: function (data, textStatus, jQxhr) {
                //                             toastr.success("{!! trans('booking::alerts.backend.booking.add_remark') !!}");
                //                             location.reload();
                //                         },
                //                         error:function(error,data){
                //                             toastr.error(error.responseText);
                //                          }
                //                     });
                //                 }
                //             }
                //         });
                //     });
                // },
                order: [[0, "desc"]],
                searchDelay: 500
            });
        });
    </script>
@stop