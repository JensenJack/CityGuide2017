<?php

namespace Modules\AppSetting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\AppSetting\Http\Requests\UpdateAppSettingRequest;
use Modules\AppSetting\Repositories\AppSettingRepository;

class AppSettingController extends Controller
{
    /**
     * @var AppSettingRepository
     * @var CategoryRepository
     */
    protected $appsetting;

    /**
     * @param AppSettingRepository $appsetting
     */
    public function __construct(AppSettingRepository $appsetting)
    {
        $this->appsetting = $appsetting;
    }
    
    public function showAppSetting()
    {

        return view('appsetting::index');
    }

    public function storeAppSetting(UpdateAppSettingRequest $request)
    {
       
        $tab  = $request->input('tab');
        $this->appsetting->update($request);
        return redirect()->route('admin.appsetting.index',compact('tab'))->withFlashSuccess(trans('appsetting::alerts.backend.appsetting.updated'));
    }

    public function restoreAppSetting()
    {
        $this->appsetting->restore();
        return response()->json(['success'=>true],200);      
    }

}