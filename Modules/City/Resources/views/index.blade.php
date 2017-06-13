@extends ('backend.layouts.app')

@section ('title', trans('city::labels.backend.city.management'))

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@stop

@section('page-header')
    <h1>
        {{ trans('city::labels.backend.city.management') }}
        <small>{{ trans('city::labels.backend.city.management') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('city::labels.backend.city.management') }}</h3>

            <div class="box-tools pull-right">
                @include('city::partials.header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="city-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>{{ trans('city::labels.backend.city.table.id') }}</th>
                            <th>{{ trans('city::labels.backend.city.table.name') }}</th>
                            <th>{{ trans('city::labels.backend.city.table.longitude') }}</th>
                            <th>{{ trans('city::labels.backend.city.table.latitude') }}</th>
                            <th>{{ trans('city::labels.backend.city.table.created') }}</th>
                            <th>{{ trans('city::labels.backend.city.table.last_updated') }}</th>
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
            $('#city-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.city.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'longitude', name: 'longitude'},
                    {data: 'latitude', name: 'latitude'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[0, "desc"]],
                searchDelay: 500
            });
        });
    </script>
@stop