<?php

namespace Modules\Room\Repositories;

use Modules\Room\Entities\Room;
use Modules\Room\Entities\RoomImage;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RoomRepository.
 */
class RoomRepository extends Repository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Room::class;

    /**
     * @param string $order_by
     * @param string $sort
     *
     * @return mixed
     */
    public function getAll($order_by = 'created_at', $sort = 'desc')
    {
        return $this->query()
            ->orderBy($order_by, $sort)
            ->get();
    }

    /**
     * @param string $order_by
     * @param string $sort
     *
     * @return mixed
     */
    public function getForDataTable($order_by = 'created_at', $sort = 'desc')
    {
        return $this->query()
            ->orderBy($order_by, $sort)
            ->select('*');
    }

    public function create(array $input)
    {  
        DB::transaction(function () use ($input) {
            $room = self::MODEL;
            $room = new $room();            
            $room->status                           = $input['status'];
            $room->name                             = $input['name'];
            $room->meta_keyword                     = $input['meta_keyword'];
            $room->meta_description                 = $input['meta_description'];
            $room->hotel_id                         = $input['hotel_id'];
            $room->room_category_id                 = $input['room_category_id'];
            $room->description                      = $input['description'];
            $room->local_buy_price                  = $input['local_buy_price'];
            $room->local_sell_price                 = $input['local_sell_price'];
            $room->foreign_buy_price                = $input['foreign_buy_price'];
            $room->foreign_sell_price               = $input['foreign_sell_price'];
            $room->agent_buy_price                  = $input['agent_buy_price'];
            $room->agent_sell_price                 = $input['agent_sell_price'];
            $room->quantity                         = $input['quantity'];
            $room->minimum_stay                     = $input['minimum_stay'];
            $room->max_adults                       = $input['max_adults'];
            $room->extra_bed                        = $input['extra_bed'];
            $room->extra_bed_charge                 = $input['extra_bed_charge'];

            if (parent::save($room)) {
                if(isset($input['amenity_id'])){
                    $room->room_amenities()->attach($input['amenity_id']);
                }
                return true;
            }

            throw new GeneralException(trans('room::exceptions.backend.room.create_error'));
        });
    }

    public function update(Model $room, array $input)
    {
        DB::transaction(function () use ($input, $room) {
            if(parent::update($room, $input)){
                if(isset($input['amenity_id'])){
                    $room->room_amenities()->sync($input['amenity_id']);
                }
                else{
                    $room->room_amenities()->detach($room->amenity_id);
                }                   
                return true;
            }
            throw new GeneralException(trans('exceptions.backend.knowledge_base.update_error'));
        });
    }

    public function upload_image($id, array $input)
    {
        $room_photo = new RoomImage;
        $room_photo->room_id = $id;
        $room_photo->image = \Storage::disk('uploads')->put('room_images', $input['file']);
        $room_photo->save();
        \Log::info('Room Image Upload : ' . access()->user()->name);
        return true;
    }

    public function delete_uploaded_image($id, array $input)
    {
        \Log::info('Room Image Deleted : ' . access()->user()->name);
        return RoomImage::where('room_id',$id)->where('id',$input['id'])->delete();
    }

    public function get_uploaded_image($id)
    {
        return RoomImage::where('room_id',$id)->get();
    }
}
