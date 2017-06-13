<div class="pull-right mb-10 hidden-sm hidden-xs">
    {{ link_to_route('admin.slider.index', trans('slider::menus.backend.sliders.all'), [], ['class' => 'btn btn-primary btn-xs']) }}
    {{ link_to_route('admin.slider.create', trans('slider::menus.backend.sliders.create'), [], ['class' => 'btn btn-success btn-xs']) }}
</div><!--pull right-->

<div class="pull-right mb-10 hidden-lg hidden-md">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ trans('slider::menus.backend.sliders.main') }} <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" slider="menu">
            <li>{{ link_to_route('admin.slider.index', trans('slider::menus.backend.sliders.all')) }}</li>
            <li>{{ link_to_route('admin.slider.create', trans('slider::menus.backend.sliders.create')) }}</li>
        </ul>
    </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>