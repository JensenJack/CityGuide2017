<?php

namespace Modules\Hotel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Hotel\Entities\Hotel;
use Modules\Hotel\Http\Requests\ManageHotelRequest;
use Modules\Hotel\Http\Requests\CreateHotelRequest;
use Modules\Hotel\Http\Requests\UpdateHotelRequest;
use Modules\Hotel\Http\Requests\ShowHotelRequest;
use Modules\Hotel\Http\Requests\UploadImageRequest;
use Modules\Hotel\Repositories\HotelRepository;
use Modules\City\Repositories\CityRepository;
use Modules\Amenity\Repositories\AmenityRepository;
use Modules\HotelCategory\Repositories\HotelCategoryRepository;

class HotelController extends Controller
{
    /**
     * @var HotelRepository
     * @var CategoryRepository
     */
    protected $hotel;
    protected $city;
    protected $amenity;
    protected $hotel_category;

    /**
     * @param HotelRepository $hotel
     */
    public function __construct(HotelRepository $hotel, CityRepository $city, AmenityRepository $amenity, HotelCategoryRepository $hotel_category)
    {
        $this->hotel = $hotel;
        $this->city = $city;
        $this->amenity = $amenity;
        $this->hotel_category = $hotel_category;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(ManageHotelRequest $request)
    {
        return view('hotel::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $cities= $this->city->getAll();    
        $amenities = $this->amenity->getAll();
        $hotel_categories = $this->hotel_category->getAll();

        return view('hotel::create', compact(['cities', 'amenities', 'hotel_categories']));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateHotelRequest $request)
    {   
        $tab = $request->tab;
        $this->hotel->create($request->except('_token'));
        \Log::info($request->name.' Hotel Created : ' . access()->user()->name);
        return redirect()->route('admin.hotel.index')->withFlashSuccess(trans('hotel::alerts.backend.hotel.created'));
    }

    /**
     * @param Hotel              $hotel
     * @param ManageHotelRequest $request
     *
     * @return mixed
     */
    public function edit(Hotel $hotel, ManageHotelRequest $request)
    {
        $cities= $this->city->getAll();  
        $amenities = $this->amenity->getAll();
        $hotel_categories = $this->hotel_category->getAll();
        $hotel_amenities_id = $hotel->amenities()->get()->transform(function($value,$key){
                                return $value->id;
                            })->toArray();

        return view('hotel::edit', compact(['hotel', 'cities', 'amenities', 'hotel_categories','hotel_amenities_id']));
    }

    /**
     * @param Hotel              $hotel
     * @param UpdateHotelRequest $request
     *
     * @return mixed
     */
    public function update(Hotel $hotel, UpdateHotelRequest $request)
    {

       $input = $request->all();
        if($request->hasFile('logo')){
            
            \Storage::disk('uploads')->delete($hotel->logo);
            $input['logo'] = \Storage::disk('uploads')->put('hotels', $request->logo);
        }
        else{
            $input['logo'] = $hotel->logo;
        }

        $this->hotel->update($hotel,$input);
        \Log::info('Hotel ID '.$hotel->id.', Name '.$hotel->name.'- Updated : ' . access()->user()->name);
        return redirect()->route('admin.hotel.index')->withFlashSuccess(trans('hotel::alerts.backend.hotel.updated'));
    }

    /**
     * @param Hotel              $hotel
     * @param ManageHotelRequest $request
     *
     * @return mixed
     */
    public function show(Hotel $hotel, ShowHotelRequest $request)
    {
        return view('hotel::show')->withHotel($hotel);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->amenities()->detach($hotel->amenity_id);
        $this->hotel->delete($hotel);
        \Log::info($hotel->name.' Hotel Deleted : ' . access()->user()->name);
        return redirect()->route('admin.hotel.index')->withFlashSuccess(trans('hotel::alerts.backend.hotel.deleted'));
    }

    public function hotel_image_uploadform(Hotel $hotel)
    {
        return view('hotel::upload_form')->withHotel($hotel);
    }

    public function hotel_image($id, UploadImageRequest $request)
    {
        switch ($request->method()){
            case 'POST' :
                $this->hotel->upload_image($id,$request->all());
                break;

            case 'DELETE' :
                $this->hotel->delete_uploaded_image($id,$request->all());
                break;

            default:
                $images = $this->hotel->get_uploaded_image($id);

                $count = 0 ;
                $obj = array();
                foreach ($images as $image) {
                    $obj[$count]['id'] = $image->id;
                    $obj[$count]['name'] = 'Image - '.$image->id;
                    $obj[$count]['image'] = url('uploads/'.$image->image);
                    $obj[$count]['size'] = \Storage::disk('uploads')->size($image->image);
                    $count++;
                }

                return response()->json($obj);
                break;

        }
    }  

}