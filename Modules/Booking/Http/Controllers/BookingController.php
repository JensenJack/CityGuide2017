<?php

namespace Modules\Booking\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Booking\Entities\Booking;
use Modules\Booking\Entities\BookingEmail;
use App\Models\Access\User\User;
use Modules\HotelCategory\Entities\HotelCategory;
use Modules\Hotel\Entities\Hotel;
use Modules\Room\Entities\Room;
use Modules\Booking\Http\Requests\ManageBookingRequest;
use Modules\Booking\Http\Requests\CreateBookingRequest;
use Modules\Booking\Http\Requests\UpdateBookingRequest;
use Modules\Booking\Http\Requests\ShowBookingRequest;
use Modules\Booking\Repositories\BookingRepository;
use Modules\Booking\Repositories\BookingEmailRepository;

class BookingController extends Controller
{
    /**
     * @var BookingRepository
     * @var CategoryRepository
     */
    protected $booking;
    protected $booking_email;

    /**
     * @param BookingRepository $booking
     */
    public function __construct(BookingRepository $booking,BookingEmailRepository $booking_email)
    {
        $this->booking = $booking;
        $this->booking_email = $booking_email;
        $today = date("Y-m-d h:i:s");
        Booking::where('booking_expire', '<', $today)->where('payment_complete', 0)->delete();
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('booking::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {   
        $users=User::where('is_member',1)->get();
        $hotelcategory=HotelCategory::all();
        return view('booking::create')->withUsers($users)
                                      ->withHotelcategory($hotelcategory);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateBookingRequest $request)
    {
        $id=$this->booking->create($request->except('_token'));

        \Log::info('User Created Booking: ' . access()->user()->name);
         return redirect()->route('admin.booking.compose_email',$id)->withFlashSuccess(trans('booking::alerts.backend.booking.created'));
    
    }

     public function composeEmail($id, $invoice = null)
    {

        $booking = $this->booking->find($id);
        return view('booking::compose_email', compact('booking', 'invoice'));
    }

     public function sentTicket(Request $request)
    {   

        $input=$request->except('_token');
        $booking=Booking::find($input['booking_id']);
        $booking->status=$input['status'];
        $booking->save();
        $this->booking_email->create($input);
        if($input['status'] == 1)
        {
            $type='initial_booking';
            $this->booking->sent_ticket($booking, $type);
            return redirect()->route('admin.booking.index')->withFlashSuccess(trans('booking::alerts.backend.booking.initial'));
        }
        elseif($input['status'] == 2)
        {
            $type = 'final_booking';
            // session()->put('booking_email_id', $result);
            $this->booking->final_booking_mail($input, $booking);
            return redirect()->route('admin.booking.index')->withFlashSuccess(trans('booking::alerts.backend.booking.final'));
        }
        elseif($input['status'] == 4)
        {
            return redirect()->route('admin.booking.index')->withFlashSuccess(trans('booking::alerts.backend.booking.onhold'));
        }
        else
        {
            $type = 'cancel_booking';
            session()->put('c_remark', $request->c_remark);
            $this->booking->sent_ticket($booking, $type);
            return redirect()->route('admin.booking.index')->withFlashSuccess(trans('booking::alerts.backend.booking.cancle'));
        }
       
    }



    /**
     * @param Booking              $booking
     * @param ManageBookingRequest $request
     *
     * @return mixed
     */
    public function edit(Booking $booking, ManageBookingRequest $request)
    {
       return view('booking::edit');
    }

    /**
     * @param Booking              $booking
     * @param UpdateBookingRequest $request
     *
     * @return mixed
     */
    public function update(Booking $booking, UpdateBookingRequest $request)
    {
        $this->booking->update($booking,$request->all());

        return redirect()->route('admin.booking.index')->withFlashSuccess(trans('booking::alerts.backend.booking.updated'));
    }

    /**
     *
     * @param  int $id
     * @return mixed
     */
    public function show($id)
    {
        return view('booking::booking_view')->with([
            'booking' => $this->booking->find($id)
        ]);
    }
    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Booking $booking)
    {
        Booking::destroy($booking->id);

        return redirect()->route('admin.booking.index')->withFlashSuccess(trans('booking::alerts.backend.booking.deleted'));
    }

    public function getUser($user_id)
    {
        $user=User::find($user_id);


        return $user;
    }

     public function getHotel($hotelcategory_id)
    {
        // $hotel=Hotel::where('hotel_category_id',$hotelcategory_id)->pluck('name','id');
        $hotel=Hotel::with('city')->where('hotel_category_id',$hotelcategory_id)->get();
        return response()->json($hotel);
    }

     public function getRoom($hotel_id)
    {
        $room=Room::with('room_category')
                    ->where('hotel_id',$hotel_id)
                    ->where('status',1)
                    ->get();

        return response()->json($room);
    }

    public function getRoomPrice($room_id)
    {
        $room=Room::find($room_id);

        return response()->json($room);
    }
    public function bin()
    {
        return view('booking::bin');
    }

    public function booking_restore($id)
    {
        $booking = Booking::onlyTrashed()->find($id);
        Booking::withTrashed()->where('id', $id)->restore();
        return redirect()->route('admin.booking.bin');
    }

    public function booking_forcedelete($id)
    {
        Booking::withTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('admin.booking.bin');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function change_payment($id)
    {
        $result = $this->booking->change_payment($id);

        if($result){
            return response('Successfully changed the payment status!', 200);
         }

        return response('Failed to change the payment status.Please check the payment method and balance amount!', 404);
    }

    public function booking_payment_info(Request $request)
    {
        return response($this->booking->booking_payment_info($request->all()), 200);
    }

    public function view_booking_email($id)
    {
        $booking_email = BookingEmail::find($id);
        return view('booking::booking_email_view', compact('booking_email'));
    }

    public function add_remark(Request $request, $id)
    {
        $result = $this->booking->add_remark($id, $request->all());

        if ($result) {
            return response('Successfully added the remark!', 200);
        }

        return response('Failed to add the remark!', 404);

    }
    public function complete_all_stage(Request $request,$id)
    {
        $result = $this->booking->complete_all_stage($id,$request->all());

        if ($result) {
            return response('Success', 200);
        }

        return response('Error', 404);
    }

    public function view_ticket($id)
    {
        $booking_email = $this->booking_email->find($id);
        
        return view('booking::ticket')->with([
            'booking_email' => $booking_email,
            'booking' => $this->booking->find($booking_email->booking_id)
        ]);
    }

     public function send_ticket_again($id)
    {
        $booking_email = $this->booking_email->find($id);
        $booking = $this->booking->find($booking_email->booking_id);



        switch ($booking_email->status) {
            case 1 :
                $type = 'initial_booking';
                $this->booking->sent_ticket($booking, $type);
                break;

            case 2 :
                $type = 'final_booking';
                session()->put('booking_email_id', $id);
                $this->booking->final_booking_mail($booking_email , $booking);
                break;

            case 3 :
                $type = 'cancel_booking';
                session()->put('c_remark', $booking_email->c_remark );
                $this->booking->sent_ticket($booking, $type);
                break;

        }

        return redirect()->back()->withFlashSuccess('The <strong>' . $type . '</strong> mail has been sent to admin <strong>('.config('app.ticket_email').')</strong> and  customer <strong> (' . $booking->guest_email . ')');
    }
}