<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\User\UpdateProfileRequest;
use App\Repositories\Frontend\Access\User\UserRepository;
use App\Http\Requests\Frontend\User\UploadPhotoRequest;

/**
 * Class ProfileController.
 */
class ProfileController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * ProfileController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * @param UpdateProfileRequest $request
     *
     * @return mixed
     */
    public function update(UpdateProfileRequest $request)
    {
        $this->user->updateProfile(access()->id(), $request->all());

        return redirect()->route('frontend.user.dashboard')->withFlashSuccess(trans('strings.frontend.user.profile_updated'));
    }

    public function uploadPhoto(UploadPhotoRequest $request, UserRepository $user)
    {  
        $file = $request->file('image');

        $type = pathinfo($file, PATHINFO_EXTENSION);
        $data = file_get_contents($file);
        $image = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $user->changeProfilePhoto(access()->id(), $image);
        return redirect()->back()->withFlashSuccess(trans('strings.frontend.user.profile_updated'));
    }
}
