<?php

namespace App\Http\Controllers\Backend\Access\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Access\User\User;
use App\Repositories\Backend\Access\User\UserRepository;
use App\Http\Requests\Backend\Access\User\ManageUserRequest;
use App\Http\Requests\Backend\Access\User\UpdateUserPasswordRequest;


class SupplierPasswordController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * @param User              $user
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function edit(User $supplier, ManageUserRequest $request)
    {
   
        return view('backend.access.supplier.change-supplierpassword')
            ->withUser($supplier);
    }

    /**
     * @param User                      $user
     * @param UpdateUserPasswordRequest $request
     *
     * @return mixed
     */
    public function update(User $supplier, UpdateUserPasswordRequest $request)
    {
        $this->users->updatePassword($supplier, $request->all());

        \Log::info('Supplier ID = '.$supplier->id.' Name = '.$supplier->name.' \'s Password Updated  By: ' . access()->user()->name);

        return redirect()->route('admin.access.supplier.index')->withFlashSuccess(trans('alerts.backend.suppliers.updated_password'));
    }
}
