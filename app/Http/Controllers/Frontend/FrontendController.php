<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\MemberLoginRequest;
use App\Http\Controllers\Controller;
use Modules\Hotel\Entities\Hotel;
use Modules\Room\Entities\Room;
use Modules\Amenity\Entities\Amenity;
use Modules\Hotel\Entities\HotelAmenity;
use Modules\Room\Entities\RoomAmenity;
use Modules\City\Entities\City;
use App\Repositories\Frontend\Room\RoomRepository;
use App\Repositories\Frontend\CMS\CMSRepository;
use Modules\Booking\Entities\Booking;

/**
 * Class FrontendController.
 */
class FrontendController extends Controller
{
    protected $room;
    protected $cms;
    public function __construct(RoomRepository $room,CMSRepository $cms)
    {
        $this->room = $room;
        $this->cms  = $cms;
        $today = date("Y-m-d h:i:s");
        Booking::where('booking_expire', '<', $today)->where('payment_complete', 0)->delete();
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $hotels =Hotel::with('city')->get();

        return view('frontend.index',compact('hotels'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function macros()
    {
        return view('frontend.macros');
    }

    public function all_rooms(Request $request)
    {
        session()->forget('city_or_hotel');
        session()->forget('start');
        session()->forget('end');
        session()->forget('room_qty');
        session()->forget('guest_qty');
        session()->forget('guest_type');
        session()->forget('hotel_names');
        session()->forget('hotel_amenities');
        session()->forget('room_amenities');
        session()->forget('price');


        $hotels = Hotel::all();
        $rooms = Room::where('status', 1)->paginate(10);
        $old_hotels = Hotel::pluck('id')->toArray();

        $amenities = Amenity::all();
        $hotel_amenities = HotelAmenity::all();
        $hotel_amenities_id = $this->amenity_transform($hotel_amenities);

        $room_amenities = RoomAmenity::all();
        $room_amenities_id = $this->amenity_transform($room_amenities);

        return view('frontend.rooms', compact('hotels', 'rooms', 'amenities', 'hotel_amenities_id', 'room_amenities_id', 'old_hotels'));
    }

    /*
    * To Filter the rooms from room.blade.php
     */
    public function search_rooms(Request $request)
    {   
        session()->forget('city_or_hotel');
        session()->forget('guest_type');
        

        $input = $request->all();
        if(!isset($request->page)){
            session()->forget('hotel_names');
            session()->forget('hotel_amenities');
            session()->forget('room_amenities');
            session()->forget('price');
            session()->put($input); 
        }

        $rooms = $this->room->getRoomList();
        if(count($rooms->get()) > 0){           // to know rooms(Builder) has or not
            $rooms = $rooms->paginate(10);
        }
        else{
            return Redirect::back()->withErrors(['There is no hotel or room equal with your searching! Your previous search-list is below!']);
        }

        $rooms_list = $this->room->getRoomList()->get();

        $hotels = Hotel::all();
        $hotels_id = $rooms_list->pluck('hotel_id');
        $old_hotels = Hotel::whereIn('id', $hotels_id)->pluck('id')->toArray();

        $amenities = Amenity::all();
        $hotel_amenities = HotelAmenity::all();
        $hotel_amenities_id = $this->amenity_transform($hotel_amenities);
        $old_hotel_amenities = $request->hotel_amenities;


        $room_amenities = RoomAmenity::all();
        $room_amenities_id = $this->amenity_transform($room_amenities);
        $old_room_amenities = $request->room_amenities;

        return view('frontend.rooms', compact('hotels', 'rooms', 'amenities', 'hotel_amenities_id', 'room_amenities_id', 'old_hotels', 'old_hotel_amenities', 'old_room_amenities'));
    }

    /*
    * To find the rooms with city or hotel names
     */
    public function find_rooms(Request $request)
    {
        session()->forget('hotel_names');
        session()->forget('hotel_amenities');
        session()->forget('room_amenities');
        session()->forget('price');

        $input = $request->all();
        if(!isset($request->page)){
            session()->put($input);
        }

        $rooms = $this->room->getRoomList();
        if($rooms){
            $rooms = $rooms->paginate(10);
        }
        else{
            return redirect(route('frontend.index'))->withFlashMessage("There is no city or hotel for your searching. Please check your searching again!");
        }
        $rooms_list = $this->room->getRoomList()->get();

        $hotels = Hotel::all();
        $hotels_id = $rooms_list->pluck('hotel_id');
        $old_hotels = Hotel::whereIn('id', $hotels_id)->pluck('id')->toArray();

        $amenities = Amenity::all();
        $hotel_amenities = HotelAmenity::all();
        $hotel_amenities_id = $this->amenity_transform($hotel_amenities);

        $room_amenities = RoomAmenity::all();
        $room_amenities_id = $this->amenity_transform($room_amenities);
   
        return view('frontend.rooms', compact('hotels', 'rooms', 'amenities', 'hotel_amenities_id', 'room_amenities_id', 'old_hotels'));
    }

    public function room_details($id)
    {
        $room = Room::find($id);

        $hotel_image = $room->hotel->hotel_image;
        $hotel_images = $this->images_transform($hotel_image);
        $room_image = $room->room_image;
        $room_images = $this->images_transform($room_image);
        $images = array_merge($hotel_images,$room_images);

        $hotel_amenity = $room->hotel->amenities;
        $hotel_amenities = $this->names_transform($hotel_amenity);

        $room_amenity = $room->room_amenities;
        $room_amenities = $this->names_transform($room_amenity);
       
        return view('frontend.room_details', compact('room', 'images', 'hotel_amenities', 'room_amenities'));
    }

    public function member_login(MemberLoginRequest $request)
    {
          $emailormobile = $request->input('emailormobile');
          $password = $request->input('password');
          $mobile_no = $request->input('mobile_no');

            if (\Auth::attempt(['email' => @$emailormobile, 'password' => $password]) || \Auth::attempt(['mobile' => @$emailormobile, 'password' => $password])) {
                return response()->json(['success' => false, 'user' => \Auth::user() ],200);
            }
            return response()->json(['success' => false, 'message' => 'Invalid Login Attempt.Please try again!'],401);
    }

    /**
     * change amenities object to array with only one value (id)
     * @param  [object] $amenities_id
     * @return [array]
     */
    public function amenity_transform($amenities_id)
    {
        return $amenities_id->transform(function($value,$key){
                                return $value->amenity_id;
        })->toArray();
    }

    /**
     * change images object to array with only one value (id)
     * @param  [object] $images
     * @return [array]
     */
    public function images_transform($images)
    {
        return $images->transform(function($value,$key){
                            return $value->image;
        })->toArray();
    }

    /**
     * change amenities object to array with only one value (name)
     * @param  [object] $amenity
     * @return [array]
     */
    public function names_transform($amenity)
    {
        return $amenity->transform(function($value,$key){
                                return $value->name;
        })->toArray();
    }

    public function sorting_price($rooms, $method)
    {
        if($method == 'low_to_high'){
            $rooms = $rooms->orderBy('local_sell_price', 'desc')->get();
            dd($rooms);
        }
    }
    public function getRoomswithCity($hotel_id)
    {

         $hotels=Hotel::all();
         $amenities = Amenity::all();

         $hotel_amenities = HotelAmenity::all();
         $hotel_amenities_id = $this->amenity_transform($hotel_amenities);

          $room_amenities = RoomAmenity::all();
         $room_amenities_id = $this->amenity_transform($room_amenities);

         $rooms_list=Room::where('hotel_id',$hotel_id)->get();
         $hotels_id = $rooms_list->pluck('hotel_id');
         $old_hotels = Hotel::whereIn('id', $hotels_id)->pluck('id')->toArray();

        $rooms=Room::where('hotel_id',$hotel_id)->paginate(10);

        return view('frontend.rooms', compact('hotels', 'rooms', 'amenities', 'hotel_amenities_id', 'room_amenities_id', 'old_hotels'));

    }

    public function typeahead_city($city){
        $cities = City::where('name', 'like', '%'.$city.'%')->pluck('name');
        $hotels = Hotel::where('name', 'like', '%'.$city.'%')->pluck('name');
    
        if(count($cities) > 0){
            return response()->json($cities);
        }
        elseif(count($hotels) > 0)
        {
            return response()->json($hotels);
        }
        
    }

     /**
     * @param $name
     * @return \Illuminate\View\View or Redirect to home
     */
     public function page($name)
     {
            $name = str_replace('-', '_', $name);
            $cms = $this->cms->getCmsPage($name);
            if($cms){
                return view('frontend.page',compact('cms'));
            }
            return redirect()->route('frontend.index');
     }
}
