<?php

namespace Modules\HotelSupplier\Http\Controllers;

use Illuminate\Routing\Controller;
use Yajra\Datatables\Facades\Datatables;
use Modules\HotelSupplier\Repositories\HotelSupplierRepository;
use Modules\HotelSupplier\Http\Requests\ManageHotelSupplierRequest;
use Modules\HotelSupplier\Entities\HotelSupplier;
use Modules\Hotel\Entities\Hotel;

class HotelSupplierTableController extends Controller
{
    /**
     * @var HotelSupplierRepository
     */
    protected $hotelsupplier;

    /**
     * @param HotelSupplierRepository $hotelsupplier
     */
    public function __construct(HotelSupplierRepository $hotelsupplier)
    {
        $this->hotelsupplier = $hotelsupplier;
    }

    /**
     * @param ManageHotelSupplierRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageHotelSupplierRequest $request)
    {
        return Datatables::of($this->hotelsupplier->getForDataTable()->with('supplier'))
            ->addColumn('supplier', function($hotelsupplier){
                return $hotelsupplier->supplier->name;
            })
            ->addColumn('hotel', function($hotelsupplier) {
                return $hotelsupplier->hotel_name;
            })
            ->addColumn('actions', function ($slider) {
                return $slider->action_buttons;
            })
            ->make(true);
    }
}
