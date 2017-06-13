<?php

namespace Modules\Email\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Email\Repositories\EmailRepository;
use Modules\Email\Http\Requests\ManageEmailRequest;
use Yajra\Datatables\Facades\Datatables;


class EmailTableController extends Controller
{
    
  /**
     * @var EmailRepository
     */
    protected $email;

    /**
     * @param EmailRepository $email
     */
    public function __construct(EmailRepository $email)
    {
        $this->email = $email;
    }

    /**
     * @param ManageEmailRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageEmailRequest $request)
    {
        return Datatables::of($this->email->getForDataTable())
            ->addColumn('actions', function ($slider) {
                return $slider->action_buttons;
            })
            ->make(true);
    }
}
