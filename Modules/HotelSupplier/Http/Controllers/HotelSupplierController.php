<?php

namespace Modules\HotelSupplier\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\HotelSupplier\Entities\HotelSupplier;
use Modules\Hotel\Entities\Hotel;
use App\Models\Access\User\User;
use Modules\HotelSupplier\Http\Requests\ManageHotelSupplierRequest;
use Modules\HotelSupplier\Http\Requests\CreateHotelSupplierRequest;
use Modules\HotelSupplier\Http\Requests\UpdateHotelSupplierRequest;
use Modules\HotelSupplier\Http\Requests\ShowHotelSupplierRequest;
use Modules\HotelSupplier\Repositories\HotelSupplierRepository;
use Modules\Hotel\Repositories\HotelRepository;


class HotelSupplierController extends Controller
{
    /**
     * @var HotelSupplierRepository
     * @var CategoryRepository
     */
    protected $hotelsupplier;
    protected $hotel;
 

    /**
     * @param HotelSupplierRepository $hotelsupplier
     */
    public function __construct(HotelSupplierRepository $hotelsupplier,HotelRepository $hotels)
    {
        $this->hotelsupplier = $hotelsupplier;
        $this->hotel = $hotels;
      
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('hotelsupplier::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $hotelsupplier_supplierid=HotelSupplier::pluck('supplier_id');

       $supplier=User::whereNotIn('id',$hotelsupplier_supplierid)
                        ->where('is_supplier',1)
                        ->get();
        $hotel=$this->hotel->getAll();
        
        return view('hotelsupplier::create')
                                            ->withHotels($hotel)
                                            ->withSuppliers($supplier);
                                           
                                            
                                         
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateHotelSupplierRequest $request)
    {
        $hotelsupplier = new HotelSupplier();
        $hotelsupplier['supplier_id'] = $request['supplier_id'];
        $hotelsupplier['hotel_id'] = serialize($request['hotel_id']);

        $this->hotelsupplier->create($hotelsupplier);
        \Log::info($request->name.' Hotel Supplier Created : ' . access()->user()->name);
        return redirect()->route('admin.hotelsupplier.index')->withFlashSuccess(trans('hotelsupplier::alerts.backend.hotelsupplier.created'));
    }

    /**
     * @param HotelSupplier              $hotelsupplier
     * @param ManageHotelSupplierRequest $request
     *
     * @return mixed
     */
    public function edit(HotelSupplier $hotelsupplier, ManageHotelSupplierRequest $request)
    {   
        $supplier=User::find($hotelsupplier->supplier_id);
        $hotelsupplier->hotel_id=unserialize($hotelsupplier->hotel_id);
    
        $hotel=Hotel::pluck('name', 'id');
        
        
        return view('hotelsupplier::edit')
            ->withHotelsupplier($hotelsupplier)
            ->withHotels($hotel)
            ->withSupplier($supplier);
    }

    /**
     * @param HotelSupplier              $hotelsupplier
     * @param UpdateHotelSupplierRequest $request
     *
     * @return mixed
     */
    public function update(HotelSupplier $hotelsupplier, UpdateHotelSupplierRequest $request)
    { 
        
        $hotelsupplier['hotel_id']=unserialize($hotelsupplier['hotel_id']);
        
        $this->hotelsupplier->update($hotelsupplier,$request->all());
         \Log::info('Hotel Supplier ID '.$hotelsupplier->id.'- Updated By: ' . access()->user()->name);
        return redirect()->route('admin.hotelsupplier.index')->withFlashSuccess(trans('hotelsupplier::alerts.backend.hotelsupplier.updated'));
    }

    /**
     * @param HotelSupplier              $hotelsupplier
     * @param ManageHotelSupplierRequest $request
     *
     * @return mixed
     */
    public function show(HotelSupplier $hotelsupplier, ShowHotelSupplierRequest $request)
    {
        return view('hotelsupplier::show')->withHotelSupplier($hotelsupplier);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(HotelSupplier $hotelsupplier)
    {
        $this->hotelsupplier->delete($hotelsupplier);
        \Log::info('Hotel Supplier ID '.$hotelsupplier->id.'- Deleted By: ' . access()->user()->name);
        return redirect()->route('admin.hotelsupplier.index')->withFlashSuccess(trans('hotelsupplier::alerts.backend.hotelsupplier.deleted'));
    }

    public function hotelLists($user_id)
    {
       $hotel_list=HotelSupplier::where('supplier_id',$user_id)->pluck('hotel_id');
        
       if(count($hotel_list)>0){
       $hotel_id=unserialize($hotel_list[0]);
        $hotel= Hotel::whereNotIn('id',$hotel_id)->pluck('name','id');
     }
      else
      {
        $hotel= Hotel::whereNotIn('id',$hotel_list)->pluck('name','id');
      }
        
        return $hotel;
    }
}