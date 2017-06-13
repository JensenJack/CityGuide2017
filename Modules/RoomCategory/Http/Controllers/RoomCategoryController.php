<?php

namespace Modules\RoomCategory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\RoomCategory\Entities\RoomCategory;
use Modules\RoomCategory\Http\Requests\ManageRoomCategoryRequest;
use Modules\RoomCategory\Http\Requests\CreateRoomCategoryRequest;
use Modules\RoomCategory\Http\Requests\UpdateRoomCategoryRequest;
use Modules\RoomCategory\Http\Requests\ShowRoomCategoryRequest;
use Modules\RoomCategory\Repositories\RoomCategoryRepository;

class RoomCategoryController extends Controller
{
    /**
     * @var RoomCategoryRepository
     * @var CategoryRepository
     */
    protected $roomcategory;

    /**
     * @param RoomCategoryRepository $roomcategory
     */
    public function __construct(RoomCategoryRepository $roomcategory)
    {
        $this->roomcategory = $roomcategory;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('roomcategory::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('roomcategory::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateRoomCategoryRequest $request)
    {
        $roomcategory = new RoomCategory($request->all());
        $this->roomcategory->save($roomcategory);

         \Log::info($request->name.' Room Category Created By: ' . access()->user()->name);
        return redirect()->route('admin.roomcategory.index')->withFlashSuccess(trans('roomcategory::alerts.backend.roomcategory.created'));
    }

    /**
     * @param RoomCategory              $roomcategory
     * @param ManageRoomCategoryRequest $request
     *
     * @return mixed
     */
    public function edit(RoomCategory $roomcategory, ManageRoomCategoryRequest $request)
    {
        return view('roomcategory::edit')
            ->withRoomcategory($roomcategory);
    }

    /**
     * @param RoomCategory              $roomcategory
     * @param UpdateRoomCategoryRequest $request
     *
     * @return mixed
     */
    public function update(RoomCategory $roomcategory, UpdateRoomCategoryRequest $request)
    {
        $this->roomcategory->update($roomcategory,$request->all());
        \Log::info('Room Category ID '.$roomcategory->id.'- Updated By: ' . access()->user()->name);
        return redirect()->route('admin.roomcategory.index')->withFlashSuccess(trans('roomcategory::alerts.backend.roomcategory.updated'));
    }

    /**
     * @param RoomCategory              $roomcategory
     * @param ManageRoomCategoryRequest $request
     *
     * @return mixed
     */
    public function show(RoomCategory $roomcategory, ShowRoomCategoryRequest $request)
    {
        return view('roomcategory::show')->withRoomCategory($roomcategory);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(RoomCategory $roomcategory)
    {
        $this->roomcategory->delete($roomcategory);
         \Log::info('Room Category ID '.$roomcategory->id.'- Deleted By: ' . access()->user()->name);
        return redirect()->route('admin.roomcategory.index')->withFlashSuccess(trans('roomcategory::alerts.backend.roomcategory.deleted'));
    }
}