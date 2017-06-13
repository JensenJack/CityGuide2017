@extends ('backend.layouts.app')

@section ('title', trans('email::labels.backend.email.management'))

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@stop

@section('page-header')
    <h1>
        {{ trans('email::labels.backend.email.management') }}
        <small>{{ trans('email::labels.backend.email.management') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('email::labels.backend.email.management') }}</h3>

            <div class="box-tools pull-right">
                @include('email::partials.email-header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="emails-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>{{ trans('email::labels.backend.email.table.id') }}</th>
                            <th>{{ trans('email::labels.backend.email.table.slug') }}</th>
                            <th>{{ trans('email::labels.backend.email.table.content') }}</th>
                            <th>{{ trans('email::labels.backend.email.table.created') }}</th>
                            <th>{{ trans('email::labels.backend.email.table.last_updated') }}</th>
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
            $('#emails-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.email.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'slug', name: 'slug'},
                    {data: 'content', name: 'content'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}

                ],
                order: [[0, "desc"]],
                searchDelay: 500,
                fnDrawCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    addDeleteForms();
                    $('.tooltips').tooltip();
                }
            });
        });
    </script>
@stop