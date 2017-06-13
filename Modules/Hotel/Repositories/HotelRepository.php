<?php

namespace Modules\Hotel\Repositories;

use Modules\Hotel\Entities\Hotel;
use Modules\Hotel\Entities\HotelImage;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HotelRepository.
 */
class HotelRepository extends Repository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Hotel::class;

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
            $hotel = self::MODEL;
            $hotel = new $hotel();
            $hotel->city_id                         = $input['city_id'];
            $hotel->hotel_category_id               = $input['hotel_category_id'];
            $hotel->name                            = $input['name'];
            $hotel->meta_keyword                    = $input['meta_keyword'];
            $hotel->meta_description                = $input['meta_description'];
            $hotel->address                         = $input['address'];
            $hotel->latitude                        = $input['latitude'];
            $hotel->longitude                       = $input['longitude'];
            $hotel->logo                            = \Storage::disk('uploads')->put('hotels', $input['logo']);
            $hotel->phone                           = $input['phone'];
            $hotel->email                           = $input['email'];
            $hotel->description                     = $input['description'];
            $hotel->class                           = $input['class'];
            if (parent::save($hotel)) {
                if(isset($input['amenity_id'])){
                    $hotel->amenities()->attach($input['amenity_id']);
                }
                return true;      
            }

            throw new GeneralException(trans('hotel::exceptions.backend.hotel.create_error'));
        });
    }

    public function update(Model $hotel, array $input)
    {
        DB::transaction(function () use ($input, $hotel) {
            if(parent::update($hotel, $input)){
                    if(isset($input['amenity_id'])){
                        $hotel->amenities()->sync($input['amenity_id']);
                    }
                    else{
                        $hotel->amenities()->detach($hotel->amenity_id);
                    }                   
                    return true;
                }
            throw new GeneralException(trans('exceptions.backend.knowledge_base.update_error'));
        });
    }

    public function upload_image($id, array $input)
    {

        $hotel_photo = new HotelImage;
        $hotel_photo->hotel_id = $id;
        $hotel_photo->image = \Storage::disk('uploads')->put('hotel_images', $input['file']);
        $hotel_photo->save();
        \Log::info('Hotel Image Upload : ' . access()->user()->name);
        return true;
    }

    public function delete_uploaded_image($id, array $input)
    {
        \Log::info('Hotel Image Deleted : ' . access()->user()->name);
        return HotelImage::where('hotel_id',$id)->where('id',$input['id'])->delete();
    }

    public function get_uploaded_image($id)
    {
        return HotelImage::where('hotel_id',$id)->get();
    }

}
