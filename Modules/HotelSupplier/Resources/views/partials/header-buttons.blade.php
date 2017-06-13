<div class="pull-right mb-10 hidden-sm hidden-xs">
    {{ link_to_route('admin.hotelsupplier.index', trans('hotelsupplier::menus.backend.hotelsupplier.all'), [], ['class' => 'btn btn-primary btn-xs']) }}
    @if(access()->hasPermission('create-hotelsupplier'))
        {{ link_to_route('admin.hotelsupplier.create', trans('hotelsupplier::menus.backend.hotelsupplier.create'), [], ['class' => 'btn btn-success btn-xs']) }}
    @endif()
</div><!--pull right-->

<div class="pull-right mb-10 hidden-lg hidden-md">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ trans('hotelsupplier::menus.backend.hotelsupplier.main') }} <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" hotelsupplier="menu">
            <li>{{ link_to_route('admin.hotelsupplier.index', trans('hotelsupplier::menus.backend.hotelsupplier.all')) }}</li>
            <li>{{ link_to_route('admin.hotelsupplier.create', trans('hotelsupplier::menus.backend.hotelsupplier.create')) }}</li>
        </ul>
    </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>
