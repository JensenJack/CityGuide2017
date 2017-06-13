<?php

namespace Modules\Room\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Room\Entities\Room;
use Modules\Room\Entities\RoomImage;
use Modules\Room\Http\Requests\ManageRoomRequest;
use Modules\Room\Http\Requests\CreateRoomRequest;
use Modules\Room\Http\Requests\UpdateRoomRequest;
use Modules\Room\Http\Requests\ShowRoomRequest;
use Modules\Room\Http\Requests\UploadImageRequest;
use Modules\Room\Repositories\RoomRepository;
use Modules\Amenity\Repositories\AmenityRepository;
use Modules\Hotel\Repositories\HotelRepository;
use Modules\RoomCategory\Repositories\RoomCategoryRepository;


class RoomController extends Controller
{
    /**
     * @var RoomRepository
     * @var CategoryRepository
     */
    protected $room;

    /**
     * @param RoomRepository $room
     */
    public function __construct(RoomRepository $room, HotelRepository $hotel, AmenityRepository $amenity, RoomCategoryRepository $room_category)
    {
        $this->room = $room;
        $this->hotel = $hotel;
        $this->amenity = $amenity;
        $this->room_category = $room_category;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('room::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $hotels = $this->hotel->getAll();
        $amenities = $this->amenity->getAll();
        $room_categories = $this->room_category->getAll();
        return view('room::create', compact(['hotels', 'amenities', 'room_categories']));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateRoomRequest $request)
    {
        $tab = $request->tab;
        $this->room->create($request->all());
        \Log::info($request->name.' Room Created : ' . access()->user()->name);
        return redirect()->route('admin.room.index')->withFlashSuccess(trans('room::alerts.backend.room.created'));
    }

    /**
     * @param Room              $room
     * @param ManageRoomRequest $request
     *
     * @return mixed
     */
    public function edit(Room $room, ManageRoomRequest $request)
    {
        $hotels = $this->hotel->getAll();
        $room_categories = $this->room_category->getAll();
        $amenities = $this->amenity->getAll();
        $room_amenities_id = $room->room_amenities()->get()->transform(function($value,$key){
                                return $value->id;
                            })->toArray();
        return view('room::edit', compact(['room', 'hotels', 'room_categories', 'amenities', 'room_amenities_id']));
    }

    /**
     * @param Room              $room
     * @param UpdateRoomRequest $request
     *
     * @return mixed
     */
    public function update(Room $room, UpdateRoomRequest $request)
    {
        $this->room->update($room,$request->all());
        \Log::info('Room ID '.$room->id.', Name '.$room->name.'- Updated : ' . access()->user()->name);
        return redirect()->route('admin.room.index')->withFlashSuccess(trans('room::alerts.backend.room.updated'));
    }

    /**
     * @param Room              $room
     * @param ManageRoomRequest $request
     *
     * @return mixed
     */
    public function show(Room $room, ShowRoomRequest $request)
    {
        return view('room::show')->withRoom($room);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Room $room)
    {
        $room->room_amenities()->detach($room->amenity_id);
        $this->room->delete($room);
        \Log::info($room->name.' Room Deleted : ' . access()->user()->name);
        return redirect()->route('admin.room.index')->withFlashSuccess(trans('room::alerts.backend.room.deleted'));
    }

    public function room_image_uploadform(Room $room)
    {
        return view('room::upload_form')->withRoom($room);
    }

    public function room_image($id, UploadImageRequest $request)
    {
        switch ($request->method()){
            case 'POST' :
                $this->room->upload_image($id, $request->all());
                break;

            case 'DELETE' :
                $this->room->delete_uploaded_image($id, $request->all());
                break;

            default:
                $images = $this->room->get_uploaded_image($id);

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