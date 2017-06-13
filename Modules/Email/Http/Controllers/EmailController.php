<?php

namespace Modules\Email\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Email\Repositories\EmailRepository;
use Modules\Email\Http\Requests\CreateEmailRequest;
use Modules\Email\Entities\Email;
use Modules\Email\Http\Requests\ManageEmailRequest;
use Modules\Email\Http\Requests\UpdateEmailRequest;
use Modules\Email\Http\Requests\DeleteEmailRequest;



class EmailController extends Controller
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
     * Display a listing of the resource.
     * @return Response
     */
    public function index(ManageEmailRequest $request)

    {
        return view('email::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {

        return view('email::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateEmailRequest $request)
    {
        $this->email->create($request->all());
        \Log::info('User Created Email: ' . access()->user()->name);
        return redirect()->route('admin.email.index')->withFlashSuccess(trans('email::alerts.backend.emails.created'));
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('email::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Email $email)
    {
        return view('email::edit')->withEmail($email);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Email $email,UpdateEmailRequest $request)
    {
        $this->email->update($email,$request->all());

        \Log::info('User Updated Email: ' . access()->user()->name);

        return redirect()->route('admin.email.index')->withFlashSuccess(trans('email::alerts.backend.emails.updated'));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Email $email,DeleteEmailRequest $request)
    {
        $this->email->delete($email);

        \Log::info('User Deleted Email: ' . access()->user()->name);

        return redirect()->route('admin.email.index')->withFlashSuccess(trans('email::alerts.backend.emails.deleted'));
    }
}
