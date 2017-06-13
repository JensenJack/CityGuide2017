<?php

namespace Modules\Slider\Http\Controllers;

use Illuminate\Routing\Controller;
use Yajra\Datatables\Facades\Datatables;
use Modules\Slider\Repositories\SliderRepository;
use Modules\Slider\Http\Requests\ManageSliderRequest;

class SliderTableController extends Controller
{
    /**
     * @var SliderRepository
     */
    protected $sliders;

    /**
     * @param SliderRepository $sliders
     */
    public function __construct(SliderRepository $sliders)
    {
        $this->sliders = $sliders;
    }

    /**
     * @param ManageSliderRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageSliderRequest $request)
    {
        return Datatables::of($this->sliders->getForDataTable())
            ->editColumn('photo_image', function ($slider) {
                return '<img style="width:100px;height:100px;" src="'.$slider->photo_image.'">';
            })
            ->addColumn('actions', function ($slider) {
                return $slider->action_buttons;
            })
            ->make(true);
    }
}
