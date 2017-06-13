@extends ('backend.layouts.app')

@section ('title', trans('room::labels.backend.room.management'))

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@stop

@section('page-header')
    <h1>
        {{ trans('room::labels.backend.room.management') }}
        <small>{{ trans('room::labels.backend.room.management') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('room::labels.backend.room.management') }}</h3>

            <div class="box-tools pull-right">
                @include('room::partials.header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="room-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>{{ trans('room::labels.backend.room.table.id') }}</th>
                            <th>{{ trans('room::labels.backend.room.table.name') }}</th>
                            <th>{{ trans('room::labels.backend.room.table.hotel_name') }}</th>
                            <th>{{ trans('room::labels.backend.room.table.room_type') }}</th>
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
            $('#room-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.room.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'hotel_id', name: 'hotel_id'},
                    {data: 'room_category_id', name: 'room_category_id'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[0, "desc"]],
                searchDelay: 500
            });
        });
    </script>
@stop