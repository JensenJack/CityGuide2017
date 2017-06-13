<?php

namespace Modules\HotelCategory\Http\Controllers;

use Illuminate\Routing\Controller;
use Yajra\Datatables\Facades\Datatables;
use Modules\HotelCategory\Repositories\HotelCategoryRepository;
use Modules\HotelCategory\Http\Requests\ManageHotelCategoryRequest;

class HotelCategoryTableController extends Controller
{
    /**
     * @var HotelCategoryRepository
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
     * @param ManageHotelCategoryRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageHotelCategoryRequest $request)
    {
        return Datatables::of($this->hotelcategory->getForDataTable())
            ->addColumn('actions', function ($slider) {
                return $slider->action_buttons;
            })
            ->make(true);
    }
}
