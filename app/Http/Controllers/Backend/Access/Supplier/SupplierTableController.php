<?php

namespace App\Http\Controllers\Backend\Access\Supplier;

use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Access\User\UserRepository;
use App\Http\Requests\Backend\Access\User\ManageUserRequest;

class SupplierTableController extends Controller
{
     /**
     * @var 
     */
    protected $suppliers;

    /**
     * @param UserRepository $supplier
     */
    public function __construct(UserRepository $supplier)
    {
        $this->suppliers = $supplier;
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageUserRequest $request)
    {
        return Datatables::of($this->suppliers->getsupplierForDataTable())
        	->editColumn('confirmed', function ($supplier) {
                return $supplier->confirmed_label;
            })

            ->addColumn('actions', function ($supplier) {
                return $supplier->supplieraction_buttons;
            })
            ->make(true);
}
}
