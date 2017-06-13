<?php

namespace App\Http\Controllers\Backend\Access\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Access\User\User;
use App\Repositories\Backend\Access\User\UserRepository;
use App\Http\Requests\Backend\Access\User\ManageUserRequest;
use App\Http\Requests\Backend\Access\User\UpdateUserPasswordRequest;


class MemberPasswordController extends Controller
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
    public function edit(User $member, ManageUserRequest $request)
    {
   	
        return view('backend.access.member.change-memberpassword')
            ->withUser($member);
    }

    /**
     * @param User                      $user
     * @param UpdateUserPasswordRequest $request
     *
     * @return mixed
     */
    public function update(User $member, UpdateUserPasswordRequest $request)
    {
        $this->users->updatePassword($member, $request->all());

        \Log::info('Member ID = '.$member->id.' Name = '.$member->name.'\'s Password Updated  By: ' . access()->user()->name);

        return redirect()->route('admin.access.member.index')->withFlashSuccess(trans('alerts.backend.users.updated_password'));
    }
}
