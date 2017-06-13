<div class="pull-right mb-10 hidden-sm hidden-xs">
    {{ link_to_route('admin.room.index', trans('room::menus.backend.room.all'), [], ['class' => 'btn btn-primary btn-xs']) }}
    @if(access()->hasPermission('create-room'))
        {{ link_to_route('admin.room.create', trans('room::menus.backend.room.create'), [], ['class' => 'btn btn-success btn-xs']) }}
    @endif
</div><!--pull right-->

<div class="pull-right mb-10 hidden-lg hidden-md">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ trans('room::menus.backend.room.main') }} <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" room="menu">
            <li>{{ link_to_route('admin.room.index', trans('room::menus.backend.room.all')) }}</li>
             @if(access()->hasPermission('create-room'))
                <li>{{ link_to_route('admin.room.create', trans('room::menus.backend.room.create')) }}</li>
            @endif
        </ul>
    </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>
