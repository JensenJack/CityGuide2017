<?php
namespace App\Repositories\Frontend\Room;

use Modules\Amenity\Entities\Amenity;
use Modules\Hotel\Entities\HotelAmenity;
use Modules\Room\Entities\RoomAmenity;
use Modules\City\Entities\City;
use Modules\Room\Entities\Room;
use Modules\Hotel\Entities\Hotel;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Input;

class RoomRepository extends Repository
{
	/**
     * Associated Repository Model.
     */
	// const MODEL = Room::class;
	
	public function getRoomList($search_input = null)
	{	
		if(session('city_or_hotel')){
			$hotel_id = Hotel::where('name', 'like', '%'.session('city_or_hotel').'%')->pluck('id');
			$city_id = City::where('name', 'like', '%'.session('city_or_hotel').'%')->pluck('id');

			if(count($city_id)>0){
				$hotel_id = Hotel::where('city_id', $city_id)->pluck('id');				
				$rooms = Room::whereIn('hotel_id', $hotel_id)->pluck('id');
			}

			elseif(count($hotel_id)>0){
				$rooms = Room::whereIn('hotel_id', $hotel_id)->pluck('id');
			}

			else{
				return false;
			}

			$rooms = Room::whereIn('hotel_id', $hotel_id)->where('status', 1)->where('quantity','>=',session('room_qty'))->where('max_adults','>=',session('guest_qty'));

		}
		else{
			$rooms = Room::all();
		}

		if(session('hotel_names')){
			$rooms = Room::whereIn('hotel_id', session('hotel_names')); // ***
		}
		if(session('hotel_amenities')){
			$all_amenities = Amenity::whereIN('id', session('hotel_amenities'))->pluck('id');
			$h_id = HotelAmenity::whereIn('amenity_id', $all_amenities)->pluck('hotel_id');
			$rooms = $rooms->whereIn('hotel_id', $h_id);
		}
		if(session('room_amenities')){
			$all_amenities = Amenity::whereIN('id', session('room_amenities'))->pluck('id');
			$rooms_id = RoomAmenity::whereIn('amenity_id', $all_amenities)->pluck('room_id');
			$rooms = $rooms->whereIn('id', $rooms_id);			
		}
		if (session('price')) {
			$rooms_id = $rooms->pluck('id')->toArray();
			$price = explode(';', session('price'));			
            if(session('guest_type') == 'foreigner'){
            	$rooms = Room::whereIn('id', $rooms_id)->where('status', 1)->where('foreign_sell_price', '>', $price[0])->where('foreign_sell_price', '<', $price[1]);
            }
            else{
            	$rooms = Room::whereIn('id', $rooms_id)->where('status', 1)->where('local_sell_price', '>', $price[0])->where('local_sell_price', '<', $price[1]);
            }                
        }

		return $rooms;
	}
}
