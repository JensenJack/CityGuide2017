<?php

namespace Modules\Sms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Sms\Entities\Sms;
use Modules\Sms\Http\Requests\CreateSmsRequest;
use Modules\Sms\Repositories\SmsRepository;
use Modules\Sms\Http\Requests\ManageSmsRequest;
use Modules\Sms\Http\Requests\UpdateSmsRequest;
use Modules\Sms\Http\Requests\DeleteSmsRequest;

class SmsController extends Controller
{
     /**
     * @var CategoryRepository
     */
    protected $sms;

    /**
     * @param CategoryRepository $sms
     */
    public function __construct(SmsRepository $sms)
    {
        $this->sms = $sms;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(ManageSmsRequest $request)
    {
        return view('sms::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('sms::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateSmsRequest $request)
    {
        $this->sms->create($request->all());
        \Log::info('SMS Created : ' . access()->user()->name);
        return redirect()->route('admin.sms.index')->withFlashSuccess(trans('sms::alerts.backend.sms.created'));
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('sms::show');
    }

    /**
     * @param Sms              $sm 
     * @param ManageSmsRequest $request
     *
     * @return mixed
     */
    public function edit(Sms $sm)
    {
        return view('sms::edit')
            ->withSms($sm);
    }

    /**
     * @param Sms              $sms
     * @param UpdateSmsRequest $request
     *
     * @return mixed
     */
    public function update(Sms $sm, UpdateSmsRequest $request)
    {
        $this->sms->update($sm,$request->all());
        \Log::info('SMS Update : ' . access()->user()->name);
        return redirect()->route('admin.sms.index')->withFlashSuccess(trans('sms::alerts.backend.sms.updated'));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Sms $sm, DeleteSmsRequest $request)
    {
         $this->sms->delete($sm);
         \Log::info('SMS Delete : ' . access()->user()->name);
        return redirect()->route('admin.sms.index')->withFlashSuccess(trans('sms::alerts.backend.sms.deleted'));
    }
}
