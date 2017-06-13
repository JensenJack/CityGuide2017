<div class="pull-right mb-10 hidden-sm hidden-xs">
    {{ link_to_route('admin.category.index', trans('category::menus.backend.categories.all'), [], ['class' => 'btn btn-primary btn-xs']) }}
    {{ link_to_route('admin.category.create', trans('category::menus.backend.categories.create'), [], ['class' => 'btn btn-success btn-xs']) }}
</div><!--pull right-->

<div class="pull-right mb-10 hidden-lg hidden-md">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ trans('category::menus.backend.categories.main') }} <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" category="menu">
            <li>{{ link_to_route('admin.category.index', trans('category::menus.backend.categories.all')) }}</li>
            <li>{{ link_to_route('admin.category.create', trans('category::menus.backend.categories.create')) }}</li>
        </ul>
    </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>