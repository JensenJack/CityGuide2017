<?php

namespace Modules\Slider\Repositories;

use Modules\Slider\Entities\Slider;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SliderRepository.
 */
class SliderRepository extends Repository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Slider::class;

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
            $slider = self::MODEL;
            $slider = new $slider();
            $slider->photo = \Storage::disk('public')->put('sliders', $input['photo']);;
            $slider->description = $input['description'];

            if (parent::save($slider)) {

                return true;
            }

            throw new GeneralException(trans('slider::exceptions.backend.sliders.create_error'));
        });
    }
}
