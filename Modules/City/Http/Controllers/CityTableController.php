<?php

namespace Modules\City\Http\Controllers;

use Illuminate\Routing\Controller;
use Yajra\Datatables\Facades\Datatables;
use Modules\City\Repositories\CityRepository;
use Modules\City\Http\Requests\ManageCityRequest;

class CityTableController extends Controller
{
    /**
     * @var CityRepository
     */
    protected $city;

    /**
     * @param CityRepository $city
     */
    public function __construct(CityRepository $city)
    {
        $this->city = $city;
    }

    /**
     * @param ManageCityRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageCityRequest $request)
    {
        return Datatables::of($this->city->getForDataTable())
            ->addColumn('actions', function ($slider) {
                return $slider->action_buttons;
            })
            ->make(true);
    }
}
