@extends ('backend.layouts.app')

@section ('title', trans('slider::labels.backend.sliders.management'))

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@stop

@section('page-header')
    <h1>
        {{ trans('slider::labels.backend.sliders.management') }}
        <small>{{ trans('slider::labels.backend.sliders.management') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('slider::labels.backend.sliders.management') }}</h3>

            <div class="box-tools pull-right">
                @include('slider::partials.slider-header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="sliders-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>{{ trans('slider::labels.backend.sliders.table.id') }}</th>
                            <th>{{ trans('slider::labels.backend.sliders.table.photo') }}</th>
                            <th>{{ trans('slider::labels.backend.sliders.table.description') }}</th>
                            <th>{{ trans('slider::labels.backend.sliders.table.created') }}</th>
                            <th>{{ trans('slider::labels.backend.sliders.table.last_updated') }}</th>
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
            $('#sliders-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.slider.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'photo_image', name: 'photo'},
                    {data: 'description', name: 'description', render: $.fn.dataTable.render.text()},
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