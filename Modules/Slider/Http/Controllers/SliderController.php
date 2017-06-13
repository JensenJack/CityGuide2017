<?php

namespace Modules\Slider\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Slider\Entities\Slider;
use Modules\Slider\Http\Requests\CreateSliderRequest;
use Modules\Slider\Repositories\SliderRepository;

class SliderController extends Controller
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
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('slider::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('slider::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateSliderRequest $request)
    {
        $this->sliders->create($request->all());

         \Log::info($request->name.' Slider Created By: ' . access()->user()->name);
        return redirect()->route('admin.slider.index')->withFlashSuccess(trans('alerts.backend.sliders.created'));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Slider $slider)
    {
        $this->sliders->delete($slider);
        \Log::info('Slider ID '.$slider->id.'- Deleted By: ' . access()->user()->name);
        return redirect()->route('admin.slider.index')->withFlashSuccess(trans('alerts.backend.sliders.deleted'));
    }
}
