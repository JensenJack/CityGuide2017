<?php

namespace App\Http\Controllers\Backend\Access\Member;

use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Http\Requests\Backend\Access\Member\CreateMemberRequest;
use App\Http\Requests\Backend\Access\Member\UpdateMemberRequest;
use App\Http\Requests\Backend\Access\User\ManageUserRequest;
use App\Repositories\Backend\Access\User\UserRepository;
use App\Http\Controllers\Controller;

class MemberController extends Controller
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
        return view('backend..access.member.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.access.member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMemberRequest $request)
    {
        $data=$request->except('_token');
        $data['is_member']='1';
       $this->users->create(['data' => $data]);

       \Log::info('Member : ' .$request->name.' Created By : ' . access()->user()->name);

        return redirect()->route('admin.access.member.index')->withFlashSuccess(trans('alerts.backend.members.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $member, ManageUserRequest $request)
    {
        return view('backend.access.member.show')
            ->withUser($member);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $member,ManageUserRequest $request)
    {
        
        return view('backend.access.member.edit')
                    ->withUser($member);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $member,UpdateMemberRequest $request)
    {
        $this->users->updateMember($member,['data'=>$request->except('_token')]);

        \Log::info('Member ID = '.$member->id.' Name = '.$member->name.' Updated  By: ' . access()->user()->name);

        return redirect()->route('admin.access.member.index')->withFlashSuccess(trans('alerts.backend.members.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $member, ManageUserRequest $request)
    {

        $this->users->delete($member);

        \Log::info('Member ID = '.$member->id.' Name = '.$member->name.' Deleted By : ' . access()->user()->name);

        return redirect()->route('admin.access.member.index')->withFlashSuccess(trans('alerts.backend.members.deleted'));
    }
}
