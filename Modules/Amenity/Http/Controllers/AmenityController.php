<?php

namespace Modules\Amenity\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Amenity\Entities\Amenity;
use Modules\Amenity\Http\Requests\ManageAmenityRequest;
use Modules\Amenity\Http\Requests\CreateAmenityRequest;
use Modules\Amenity\Http\Requests\UpdateAmenityRequest;
use Modules\Amenity\Http\Requests\ShowAmenityRequest;
use Modules\Amenity\Repositories\AmenityRepository;

class AmenityController extends Controller
{
    /**
     * @var AmenityRepository
     * @var CategoryRepository
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
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('amenity::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('amenity::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateAmenityRequest $request)
    {
        $amenity = new Amenity($request->all());
        $this->amenity->save($amenity);
        \Log::info($request->name.' Amenity Created By: ' . access()->user()->name);
        return redirect()->route('admin.amenity.index')->withFlashSuccess(trans('amenity::alerts.backend.amenity.created'));
    }

    /**
     * @param Amenity              $amenity
     * @param ManageAmenityRequest $request
     *
     * @return mixed
     */
    public function edit(Amenity $amenity, ManageAmenityRequest $request)
    {
        return view('amenity::edit')
            ->withAmenity($amenity);
    }

    /**
     * @param Amenity              $amenity
     * @param UpdateAmenityRequest $request
     *
     * @return mixed
     */
    public function update(Amenity $amenity, UpdateAmenityRequest $request)
    {
        $this->amenity->update($amenity,$request->all());
        \Log::info('Amenity ID '.$amenity->id.'- Updated By: ' . access()->user()->name);
        return redirect()->route('admin.amenity.index')->withFlashSuccess(trans('amenity::alerts.backend.amenity.updated'));
    }

    /**
     * @param Amenity              $amenity
     * @param ManageAmenityRequest $request
     *
     * @return mixed
     */
    public function show(Amenity $amenity, ShowAmenityRequest $request)
    {
        return view('amenity::show')->withAmenity($amenity);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Amenity $amenity)
    {
        $this->amenity->delete($amenity);
        \Log::info('Amenity ID '.$amenity->id.'- Deleted By: ' . access()->user()->name);
        return redirect()->route('admin.amenity.index')->withFlashSuccess(trans('amenity::alerts.backend.amenity.deleted'));
    }
}