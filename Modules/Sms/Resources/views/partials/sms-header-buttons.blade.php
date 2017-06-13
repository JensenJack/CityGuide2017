<div class="pull-right mb-10 hidden-sm hidden-xs">
    {{ link_to_route('admin.sms.index', trans('sms::menus.backend.sms.all'), [], ['class' => 'btn btn-primary btn-xs']) }}
    @if(access()->hasPermission('create-sms'))
        {{ link_to_route('admin.sms.create', trans('sms::menus.backend.sms.create'), [], ['class' => 'btn btn-success btn-xs']) }}
    @endif
</div><!--pull right-->

<div class="pull-right mb-10 hidden-lg hidden-md">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ trans('sms::menus.backend.sms.main') }} <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" category="menu">
            <li>{{ link_to_route('admin.sms.index', trans('sms::menus.backend.sms.all')) }}</li>
             @if(access()->hasPermission('create-sms'))
                <li>{{ link_to_route('admin.sms.create', trans('sms::menus.backend.sms.create')) }}</li>
            @endif
        </ul>
    </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>