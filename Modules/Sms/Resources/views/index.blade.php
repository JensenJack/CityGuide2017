@extends ('backend.layouts.app')

@section ('title', trans('sms::labels.backend.sms.management'))

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@stop

@section('page-header')
    <h1>
        {{ trans('sms::labels.backend.sms.management') }}
        <small>{{ trans('sms::labels.backend.sms.management') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('sms::labels.backend.sms.management') }}</h3>

            <div class="box-tools pull-right">
                @include('sms::partials.sms-header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="sms-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>{{ trans('sms::labels.backend.sms.table.id') }}</th>
                            <th>{{ trans('sms::labels.backend.sms.table.slug') }}</th>
                            <th>{{ trans('sms::labels.backend.sms.table.ledgen') }}</th>
                            <th>{{ trans('sms::labels.backend.sms.table.content') }}</th>
                            <th>{{ trans('sms::labels.backend.sms.table.mm_content') }}</th>
                            <th>{{ trans('sms::labels.backend.sms.table.created') }}</th>
                            <th>{{ trans('sms::labels.backend.sms.table.last_updated') }}</th>
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
            $('#sms-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.sms.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'slug', name: 'slug'},
                    {data: 'ledgen', name: 'ledgen'},
                    {data: 'content', name: 'content', render: $.fn.dataTable.render.text()},
                    {data: 'mm_content', name: 'mm_content', render: $.fn.dataTable.render.text()},
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