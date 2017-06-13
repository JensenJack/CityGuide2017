<?php

namespace Modules\RoomCategory\Repositories;

use Modules\RoomCategory\Entities\RoomCategory;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RoomCategoryRepository.
 */
class RoomCategoryRepository extends Repository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = RoomCategory::class;

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
}
