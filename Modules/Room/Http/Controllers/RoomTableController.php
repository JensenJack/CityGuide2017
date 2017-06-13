<?php

namespace Modules\Room\Http\Controllers;

use Illuminate\Routing\Controller;
use Yajra\Datatables\Facades\Datatables;
use Modules\Room\Repositories\RoomRepository;
use Modules\Room\Http\Requests\ManageRoomRequest;
use Modules\Hotel\Entities\Hotel;
use Modules\RoomCategory\Entities\RoomCategory;

class RoomTableController extends Controller
{
    /**
     * @var RoomRepository
     */
    protected $room;

    /**
     * @param RoomRepository $room
     */
    public function __construct(RoomRepository $room)
    {
        $this->room = $room;
    }

    /**
     * @param ManageRoomRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageRoomRequest $request)
    {
        return Datatables::of($this->room->getForDataTable())
            ->addColumn('hotel_id', function($room){
                return $room->hotel->name." (".$room->hotel->city->name.")";
            })

            ->addColumn('room_category_id', function($room){
                return $room->room_category()->first()->name;
            })

            ->addColumn('actions', function ($slider) {
                return $slider->action_buttons;
            })
            ->make(true);
    }
}
