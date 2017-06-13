<?php

namespace Modules\Sms\Http\Controllers;

use Illuminate\Routing\Controller;
use Yajra\Datatables\Facades\Datatables;
use Modules\Sms\Repositories\SmsRepository;
use Modules\Sms\Http\Requests\ManageSmsRequest;

class SmsTableController extends Controller
{
    /**
     * @var SmsRepository
     */
    protected $sms;

    /**
     * @param SmsRepository $sms
     */
    public function __construct(SmsRepository $sms)
    {
        $this->sms = $sms;
    }

    /**
     * @param ManageSmsRequest $sms
     *
     * @return mixed
     */
    public function __invoke(ManageSmsRequest $request)
    {
        return Datatables::of($this->sms->getForDataTable())
            ->addColumn('actions', function ($slider) {
                return $slider->action_buttons;
            })
            ->make(true);
    }
}