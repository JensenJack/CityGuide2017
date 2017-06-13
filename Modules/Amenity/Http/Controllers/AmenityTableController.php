<?php

namespace Modules\Amenity\Http\Controllers;

use Illuminate\Routing\Controller;
use Yajra\Datatables\Facades\Datatables;
use Modules\Amenity\Repositories\AmenityRepository;
use Modules\Amenity\Http\Requests\ManageAmenityRequest;

class AmenityTableController extends Controller
{
    /**
     * @var AmenityRepository
     */
    protected $amenity;

    /**
     * @param AmenityRepository $amenity
     */
    public function __construct(AmenityRepository $amenity)
    {
        $this->amenity = $amenity;
    }

    /**
     * @param ManageAmenityRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageAmenityRequest $request)
    {
        return Datatables::of($this->amenity->getForDataTable())
            ->addColumn('actions', function ($slider) {
                return $slider->action_buttons;
            })
            ->make(true);
    }
}
