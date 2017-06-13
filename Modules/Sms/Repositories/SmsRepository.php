<?php

namespace Modules\Sms\Repositories;

use Modules\Sms\Entities\Sms;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SmsRepository.
 */
class SmsRepository extends Repository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Sms::class;

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

    /**
     * @param array $input
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {

        DB::transaction(function () use ($input) {
            $sms = self::MODEL;
            $sms = new $sms();
            $sms->slug = $input['slug'];
            $sms->ledgen = $input['ledgen'];
            $sms->content = $input['content'];
            $sms->mm_content = $input['mm_content'];

            if (parent::save($sms)) {

                return true;
            }

            throw new GeneralException(trans('sms::exceptions.backend.sms.create_error'));
        });
    }

    /**
     * @param Model $category
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Model $sms)
    {
        DB::transaction(function () use ($sms) {
            if (parent::delete($sms)) {
                return true;
            }

            throw new GeneralException(trans('sms::exceptions.backend.sms.delete_error'));
        });
    }
}
