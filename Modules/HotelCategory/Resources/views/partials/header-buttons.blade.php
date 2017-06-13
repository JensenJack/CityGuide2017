<div class="pull-right mb-10 hidden-sm hidden-xs">
    {{ link_to_route('admin.hotelcategory.index', trans('hotelcategory::menus.backend.hotelcategory.all'), [], ['class' => 'btn btn-primary btn-xs']) }}
    @if(access()->hasPermission('create-hotelcategory'))
        {{ link_to_route('admin.hotelcategory.create', trans('hotelcategory::menus.backend.hotelcategory.create'), [], ['class' => 'btn btn-success btn-xs']) }}
    @endif
</div><!--pull right-->

<div class="pull-right mb-10 hidden-lg hidden-md">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ trans('hotelcategory::menus.backend.hotelcategory.main') }} <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" hotelcategory="menu">
            <li>{{ link_to_route('admin.hotelcategory.index', trans('hotelcategory::menus.backend.hotelcategory.all')) }}</li>
            @if(access()->hasPermission('create-hotelcategory'))
                <li>{{ link_to_route('admin.hotelcategory.create', trans('hotelcategory::menus.backend.hotelcategory.create')) }}</li>
            @endif
        </ul>
    </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>
