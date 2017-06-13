<div class="pull-right mb-10 hidden-sm hidden-xs">
    {{ link_to_route('admin.roomcategory.index', trans('roomcategory::menus.backend.roomcategory.all'), [], ['class' => 'btn btn-primary btn-xs']) }}
    @if(access()->hasPermission('create-roomcategory'))
        {{ link_to_route('admin.roomcategory.create', trans('roomcategory::menus.backend.roomcategory.create'), [], ['class' => 'btn btn-success btn-xs']) }}
    @endif
</div><!--pull right-->

<div class="pull-right mb-10 hidden-lg hidden-md">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ trans('roomcategory::menus.backend.roomcategory.main') }} <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" roomcategory="menu">
            <li>{{ link_to_route('admin.roomcategory.index', trans('roomcategory::menus.backend.roomcategory.all')) }}</li>
            @if(access()->hasPermission('create-roomcategory'))
                <li>{{ link_to_route('admin.roomcategory.create', trans('roomcategory::menus.backend.roomcategory.create')) }}</li>
            @endif
        </ul>
    </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>
