<div class="pull-right mb-10 hidden-sm hidden-xs">
    {{ link_to_route('admin.gallery.index', trans('gallery::menus.backend.galleries.all'), [], ['class' => 'btn btn-primary btn-xs']) }}
    {{ link_to_route('admin.gallery.create', trans('gallery::menus.backend.galleries.create'), [], ['class' => 'btn btn-success btn-xs']) }}
</div><!--pull right-->

<div class="pull-right mb-10 hidden-lg hidden-md">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ trans('gallery::menus.backend.galleries.main') }} <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" gallery="menu">
            <li>{{ link_to_route('admin.gallery.index', trans('gallery::menus.backend.galleries.all')) }}</li>
            <li>{{ link_to_route('admin.gallery.create', trans('gallery::menus.backend.galleries.create')) }}</li>
        </ul>
    </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>