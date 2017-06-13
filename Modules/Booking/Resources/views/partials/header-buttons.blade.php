<div class="pull-right mb-10 hidden-sm hidden-xs">
    {{ link_to_route('admin.booking.index', trans('booking::menus.backend.booking.all'), [], ['class' => 'btn btn-primary btn-xs']) }}
    @if(access()->hasPermission('create-booking'))
        {{ link_to_route('admin.booking.create', trans('booking::menus.backend.booking.create'), [], ['class' => 'btn btn-success btn-xs']) }}
    @endif()
</div><!--pull right-->

<div class="pull-right mb-10 hidden-lg hidden-md">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ trans('booking::menus.backend.booking.main') }} <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" booking="menu">
            <li>{{ link_to_route('admin.booking.index', trans('booking::menus.backend.booking.all')) }}</li>
            <li>{{ link_to_route('admin.booking.create', trans('booking::menus.backend.booking.create')) }}</li>
        </ul>
    </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>
