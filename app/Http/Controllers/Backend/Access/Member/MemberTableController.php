<?php

namespace App\Http\Controllers\Backend\Access\Member;

use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Access\User\UserRepository;
use App\Http\Requests\Backend\Access\User\ManageUserRequest;

class MemberTableController extends Controller
{
     /**
     * @var 
     */
    protected $members;

    /**
     * @param UserRepository $member
     */
    public function __construct(UserRepository $member)
    {
        $this->members = $member;
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageUserRequest $request)
    {
        return Datatables::of($this->members->getmemberForDataTable())
        	->editColumn('confirmed', function ($member) {
                return $member->confirmed_label;
            })

            ->addColumn('actions', function ($member) {
                return $member->memberaction_buttons;
            })
            ->make(true);
}
}
