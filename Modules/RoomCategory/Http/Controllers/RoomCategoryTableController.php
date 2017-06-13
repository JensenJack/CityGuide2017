<?php

namespace Modules\RoomCategory\Http\Controllers;

use Illuminate\Routing\Controller;
use Yajra\Datatables\Facades\Datatables;
use Modules\RoomCategory\Repositories\RoomCategoryRepository;
use Modules\RoomCategory\Http\Requests\ManageRoomCategoryRequest;

class RoomCategoryTableController extends Controller
{
    /**
     * @var RoomCategoryRepository
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
     * @param ManageRoomCategoryRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageRoomCategoryRequest $request)
    {
        return Datatables::of($this->roomcategory->getForDataTable())
            ->addColumn('actions', function ($slider) {
                return $slider->action_buttons;
            })
            ->make(true);
    }
}
