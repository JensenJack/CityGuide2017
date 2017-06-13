<div class="pull-right mb-10 hidden-sm hidden-xs">
    {{ link_to_route('admin.amenity.index', trans('amenity::menus.backend.amenity.all'), [], ['class' => 'btn btn-primary btn-xs']) }}
    @if(access()->hasPermission('create-amenity'))
    {{ link_to_route('admin.amenity.create', trans('amenity::menus.backend.amenity.create'), [], ['class' => 'btn btn-success btn-xs']) }}
    @endif
</div><!--pull right-->

<div class="pull-right mb-10 hidden-lg hidden-md">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ trans('amenity::menus.backend.amenity.main') }} <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" amenity="menu">
            <li>{{ link_to_route('admin.amenity.index', trans('amenity::menus.backend.amenity.all')) }}</li>
            <li>{{ link_to_route('admin.amenity.create', trans('amenity::menus.backend.amenity.create')) }}</li>
        </ul>
    </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>
