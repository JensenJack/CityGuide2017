 <div class="pull-right mb-10 hidden-sm hidden-xs">
    {{ link_to_route('admin.email.index', trans('email::menus.backend.emails.all'), [], ['class' => 'btn btn-primary btn-xs']) }}
    @if(access()->hasPermission('create-email'))
        {{ link_to_route('admin.email.create', trans('email::menus.backend.emails.create'), [], ['class' => 'btn btn-success btn-xs']) }}
    @endif
</div><!--pull right-->

<div class="pull-right mb-10 hidden-lg hidden-md">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ trans('email::menus.backend.emails.main') }} <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" category="menu">
            <li>{{ link_to_route('admin.email.index', trans('email::menus.backend.emails.all')) }}</li>
            @if(access()->hasPermission('create-email'))
                <li>{{ link_to_route('admin.email.create', trans('email::menus.backend.emails.create')) }}</li>
            @endif
        </ul>
    </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>