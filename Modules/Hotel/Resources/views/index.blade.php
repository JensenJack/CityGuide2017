@extends ('backend.layouts.app')

@section ('title', trans('hotel::labels.backend.hotel.management'))

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@stop

@section('page-header')
    <h1>
        {{ trans('hotel::labels.backend.hotel.management') }}
        <small>{{ trans('hotel::labels.backend.hotel.management') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('hotel::labels.backend.hotel.management') }}</h3>

            <div class="box-tools pull-right">
                @include('hotel::partials.header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="hotel-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>{{ trans('hotel::labels.backend.hotel.table.id') }}</th>
                            <th>{{ trans('hotel::labels.backend.hotel.table.name') }}</th>
                            <th>{{ trans('hotel::labels.backend.hotel.table.city') }}</th>
                            <th>{{ trans('hotel::labels.backend.hotel.table.address') }}</th>
                            <th>{{ trans('hotel::labels.backend.hotel.table.phone') }}</th>
                            <th>{{ trans('hotel::labels.backend.hotel.table.email') }}</th>
                            <th>{{ trans('hotel::labels.backend.hotel.table.class') }}</th>
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
            $('#hotel-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.hotel.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'city', name: 'city_id'},
                    {data: 'address', name: 'address'},
                    {data: 'phone', name: 'phone'},
                    {data: 'email', name: 'email'},
                    {data: 'class', name: 'class'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[0, "desc"]],
                searchDelay: 500
            });
        });
    </script>
@stop