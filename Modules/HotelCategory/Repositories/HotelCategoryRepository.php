<?php

namespace Modules\HotelCategory\Repositories;

use Modules\HotelCategory\Entities\HotelCategory;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HotelCategoryRepository.
 */
class HotelCategoryRepository extends Repository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = HotelCategory::class;

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

    public function getHotelCategory($id)
    {
         return $this->query()
            ->find($id);
    }

}
