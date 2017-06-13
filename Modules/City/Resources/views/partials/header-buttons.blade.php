<div class="pull-right mb-10 hidden-sm hidden-xs">
    {{ link_to_route('admin.city.index', trans('city::menus.backend.city.all'), [], ['class' => 'btn btn-primary btn-xs']) }}
    @if(access()->hasPermission('create-city'))
    {{ link_to_route('admin.city.create', trans('city::menus.backend.city.create'), [], ['class' => 'btn btn-success btn-xs']) }}
    @endif
</div><!--pull right-->

<div class="pull-right mb-10 hidden-lg hidden-md">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ trans('city::menus.backend.city.main') }} <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" city="menu">
            <li>{{ link_to_route('admin.city.index', trans('city::menus.backend.city.all')) }}</li>
            <li>{{ link_to_route('admin.city.create', trans('city::menus.backend.city.create')) }}</li>
        </ul>
    </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>
