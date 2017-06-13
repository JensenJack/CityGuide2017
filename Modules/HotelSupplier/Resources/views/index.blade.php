@extends ('backend.layouts.app')

@section ('title', trans('hotelsupplier::labels.backend.hotelsupplier.management'))

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@stop

@section('page-header')
    <h1>
        {{ trans('hotelsupplier::labels.backend.hotelsupplier.management') }}
        <small>{{ trans('hotelsupplier::labels.backend.hotelsupplier.management') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('hotelsupplier::labels.backend.hotelsupplier.management') }}</h3>

            <div class="box-tools pull-right">
                @include('hotelsupplier::partials.header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="hotelsupplier-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>{{ trans('hotelsupplier::labels.backend.hotelsupplier.table.id') }}</th>
                            <th>{{ trans('hotelsupplier::labels.backend.hotelsupplier.table.supplier_name') }}
                            <th>{{ trans('hotelsupplier::labels.backend.hotelsupplier.table.hotel_name') }}
                            <th>{{ trans('hotelsupplier::labels.backend.hotelsupplier.table.created') }}</th>
                            <th>{{ trans('hotelsupplier::labels.backend.hotelsupplier.table.last_updated') }}</th>
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
            $('#hotelsupplier-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.hotelsupplier.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'supplier', name: 'supplier.name'},
                    {data: 'hotel', name: 'hotel', searchable: false, sortable: false},
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