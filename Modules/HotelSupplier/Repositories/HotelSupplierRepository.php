<?php

namespace Modules\HotelSupplier\Repositories;

use Modules\HotelSupplier\Entities\HotelSupplier;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HotelSupplierRepository.
 */
class HotelSupplierRepository extends Repository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = HotelSupplier::class;

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
            ->select('*');
    }

    public function getHotelList($user_id)
    {
        return $this->query()
            ->where('id',$user_id)
            ->select('hotel_id');
    }

     public function create($input)
    {  
        
        DB::transaction(function () use ($input) {
            $hotel_supplier = self::MODEL;
            $hotel_supplier = new $hotel_supplier();
            $hotel_supplier->hotel_id                         = $input['hotel_id'];
            $hotel_supplier->supplier_id                      = $input['supplier_id'];
            
            if (parent::save($hotel_supplier)) {
              
                return true;      
            }

            throw new GeneralException(trans('hotel::exceptions.backend.hotel.create_error'));
        });
    }

    public function update(Model $hotelsupplier, array $input)
    {

        
        $input['hotel_id']=serialize($input['hotel_id']);
        $input['supplier_id']=$input['supplier_id'];
        DB::transaction(function () use ($input, $hotelsupplier) {
            if(parent::update($hotelsupplier, $input)){
             
                    return true;
                }
            throw new GeneralException(trans('exceptions.backend.knowledge_base.update_error'));
        });
    }
}
