<div class="pull-right mb-10 hidden-sm hidden-xs">
    {{ link_to_route('admin.hotel.index', trans('hotel::menus.backend.hotel.all'), [], ['class' => 'btn btn-primary btn-xs']) }}
    @if(access()->hasPermission('create-hotel'))
        {{ link_to_route('admin.hotel.create', trans('hotel::menus.backend.hotel.create'), [], ['class' => 'btn btn-success btn-xs']) }}
    @endif
</div><!--pull right-->

<div class="pull-right mb-10 hidden-lg hidden-md">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ trans('hotel::menus.backend.hotel.main') }} <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" hotel="menu">
            <li>{{ link_to_route('admin.hotel.index', trans('hotel::menus.backend.hotel.all')) }}</li>
            @if(access()->hasPermission('create-hotel'))
                <li>{{ link_to_route('admin.hotel.create', trans('hotel::menus.backend.hotel.create')) }}</li>
            @endif()
        </ul>
    </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>
