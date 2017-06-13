@extends ('backend.layouts.app')

@section ('title', trans('gallery::labels.backend.galleries.management'))

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@stop

@section('page-header')
    <h1>
        {{ trans('gallery::labels.backend.galleries.management') }}
        <small>{{ trans('gallery::labels.backend.galleries.management') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('gallery::labels.backend.galleries.management') }}</h3>

            <div class="box-tools pull-right">
                @include('gallery::partials.gallery-header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="galleries-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>{{ trans('gallery::labels.backend.galleries.table.id') }}</th>
                            <th>{{ trans('gallery::labels.backend.galleries.table.category') }}</th>
                            <th>{{ trans('gallery::labels.backend.galleries.table.name') }}</th>
                            <th>{{ trans('gallery::labels.backend.galleries.table.type') }}</th>
                            <th>{{ trans('gallery::labels.backend.galleries.table.last_updated') }}</th>
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
            $('#galleries-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.gallery.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'category', name: 'category'},
                    {data: 'name', name: 'name', render: $.fn.dataTable.render.text()},
                    {data: 'type', name: 'type'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[0, "desc"]],
                searchDelay: 500
            });
        });
    </script>
@stop