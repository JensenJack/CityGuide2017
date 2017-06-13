<?php

namespace App\Http\Controllers\Backend\Access\Supplier;

use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Http\Requests\Backend\Access\User\ManageUserRequest;
use App\Http\Requests\Backend\Access\Supplier\CreateSupplierRequest;
use App\Http\Requests\Backend\Access\Supplier\UpdateSupplierRequest;
use App\Repositories\Backend\Access\User\UserRepository;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{

    /**
     * @var UserRepository
     */
    protected $users;

    public function __construct(UserRepository $users)
    {

        $this->users=$users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.access.supplier.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.access.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSupplierRequest $request)
    {
        $data=$request->except('_token');
        $data['is_supplier']='1';
       $this->users->create(['data' => $data]);

       \Log::info('Supplier : ' .$request->name.' Created By : ' . access()->user()->name);

        return redirect()->route('admin.access.supplier.index')->withFlashSuccess(trans('alerts.backend.suppliers.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $supplier, ManageUserRequest $request)
    {
        return view('backend.access.supplier.show')
            ->withUser($supplier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $supplier,ManageUserRequest $request)
    {
        return view('backend.access.supplier.edit')
                    ->withUser($supplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $supplier,UpdateSupplierRequest $request)
    {
        $this->users->updateSupplier($supplier,['data'=>$request->except('_token')]);

        \Log::info('Supplier ID = '.$supplier->id.' Name = '.$supplier->name.' Updated  By: ' . access()->user()->name);

        return redirect()->route('admin.access.supplier.index')->withFlashSuccess(trans('alerts.backend.suppliers.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $supplier,ManageUserRequest $request)
    {
        $this->users->delete($supplier);

        \Log::info('Supplier ID = '.$supplier->id.' Name = '.$supplier->name.' Deleted  By: ' . access()->user()->name);

        return redirect()->route('admin.access.supplier.index')->withFlashSuccess(trans('alerts.backend.suppliers.deleted'));
    }
}
