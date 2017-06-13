<?php

namespace Modules\Email\Repositories;

use Modules\Email\Entities\Email;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryRepository.
 */
class EmailRepository extends Repository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Email::class;

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
        return $this->query()->select('*');
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
            $email = self::MODEL;
            $email = new $email();
            $email->slug = $input['slug'];
            $email->ledgen = $input['ledgen'];
            $email->subject = $input['subject'];
            $email->content = $input['content'];
            $email->mm_subject = $input['mm_subject'];
            $email->mm_content = $input['mm_content'];

            if (parent::save($email)) {

                return true;
            }

            throw new GeneralException(trans('email::exceptions.backend.emails.create_error'));
        });
    }

    /**
     * @param Model $category
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Model $email)
    {
        DB::transaction(function () use ($email) {
            if (parent::delete($email)) {
                return true;
            }

            throw new GeneralException(trans('email::exceptions.backend.emails.delete_error'));
        });
    }

    public function get_email_content($name, $type = Null)
    {

        switch ($type) {
            case 'uni':
                $data = Email::where('slug', '=', $name)->first();
                $data->content = fontConvert($data->mm_content);
                $data->subject = fontConvert($data->mm_subject);
                return $data;
            case 'zg':
                $data = Email::where('slug', '=', $name)->first();
                $data->content = $data->mm_content;
                $data->subject = $data->mm_subject;
                return $data;
            default:
                $data = Email::where('slug', '=', $name)->first();
                return $data;
        }
    }
}
