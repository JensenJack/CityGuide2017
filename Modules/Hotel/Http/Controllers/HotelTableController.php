<?php

namespace Modules\Hotel\Http\Controllers;

use Illuminate\Routing\Controller;
use Yajra\Datatables\Facades\Datatables;
use Modules\Hotel\Repositories\HotelRepository;
use Modules\Hotel\Http\Requests\ManageHotelRequest;

class HotelTableController extends Controller
{
    /**
     * @var HotelRepository
     */
    protected $hotel;

    /**
     * @param HotelRepository $hotel
     */
    public function __construct(HotelRepository $hotel)
    {
        $this->hotel = $hotel;
    }

    /**
     * @param ManageHotelRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageHotelRequest $request)
    {
        return Datatables::of($this->hotel->getForDataTable())
            ->addColumn('city', function($hotel){
                return $hotel->city->name;
            })
            ->addColumn('actions', function ($slider) {
                return $slider->action_buttons;
            })
            ->make(true);
    }
}
