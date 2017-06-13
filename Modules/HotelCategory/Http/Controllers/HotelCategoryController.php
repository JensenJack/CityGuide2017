<?php

namespace Modules\HotelCategory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\HotelCategory\Entities\HotelCategory;
use Modules\HotelCategory\Http\Requests\ManageHotelCategoryRequest;
use Modules\HotelCategory\Http\Requests\CreateHotelCategoryRequest;
use Modules\HotelCategory\Http\Requests\UpdateHotelCategoryRequest;
use Modules\HotelCategory\Http\Requests\ShowHotelCategoryRequest;
use Modules\HotelCategory\Repositories\HotelCategoryRepository;

class HotelCategoryController extends Controller
{
    /**
     * @var HotelCategoryRepository
     * @var CategoryRepository
     */
    protected $hotelcategory;

    /**
     * @param HotelCategoryRepository $hotelcategory
     */
    public function __construct(HotelCategoryRepository $hotelcategory)
    {
        $this->hotelcategory = $hotelcategory;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(ManageHotelCategoryRequest $request)
    {
        return view('hotelcategory::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('hotelcategory::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateHotelCategoryRequest $request)
    {
        $hotelcategory = new HotelCategory($request->all());
        $this->hotelcategory->save($hotelcategory);
        \Log::info($request->name.' Hotel Category Created By: ' . access()->user()->name);
        return redirect()->route('admin.hotelcategory.index')->withFlashSuccess(trans('hotelcategory::alerts.backend.hotelcategory.created'));
    }

    /**
     * @param HotelCategory              $hotelcategory
     * @param ManageHotelCategoryRequest $request
     *
     * @return mixed
     */
    public function edit(HotelCategory $hotelcategory, ManageHotelCategoryRequest $request)
    {   

        return view('hotelcategory::edit')
            ->withHotelcategory($hotelcategory);
    }

    /**
     * @param HotelCategory              $hotelcategory
     * @param UpdateHotelCategoryRequest $request
     *
     * @return mixed
     */
    public function update(HotelCategory $hotelcategory, UpdateHotelCategoryRequest $request)
    {
        $this->hotelcategory->update($hotelcategory,$request->all());
        \Log::info('Hotel Category ID '.$hotelcategory->id.'- Updated By: ' . access()->user()->name);
        return redirect()->route('admin.hotelcategory.index')->withFlashSuccess(trans('hotelcategory::alerts.backend.hotelcategory.updated'));
    }

    /**
     * @param HotelCategory              $hotelcategory
     * @param ManageHotelCategoryRequest $request
     *
     * @return mixed
     */
    public function show(HotelCategory $hotelcategory, ShowHotelCategoryRequest $request)
    {
        return view('hotelcategory::show')->withHotelCategory($hotelcategory);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(HotelCategory $hotelcategory)
    {
        $this->hotelcategory->delete($hotelcategory);
         \Log::info('Hotel Category ID '.$hotelcategory->id.'- Deleted By: ' . access()->user()->name);
        return redirect()->route('admin.hotelcategory.index')->withFlashSuccess(trans('hotelcategory::alerts.backend.hotelcategory.deleted'));
    }
}