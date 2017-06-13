<?php

namespace Modules\Gallery\Repositories;

use Modules\Gallery\Entities\Gallery;
use Modules\Gallery\Entities\GalleryPhoto;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GalleryRepository.
 */
class GalleryRepository extends Repository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Gallery::class;

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
            $gallery = self::MODEL;
            $gallery = new $gallery();
            if($input['type'] == 'image'){
                $gallery->url = \Storage::disk('public')->put('galleries', $input['image']);
            }
            else{
                $gallery->url = $input['url'];
            }
            $gallery->category_id = $input['category_id'];
            $gallery->name = $input['name'];
            $gallery->type = $input['type'];

            if (parent::save($gallery)) {

                return true;
            }

            throw new GeneralException(trans('gallery::exceptions.backend.galleries.create_error'));
        });
    }

    public function upload_image($id, array $input)
    {
        $gallery_photo = new GalleryPhoto;
        $gallery_photo->gallery_id = $id;
        $gallery_photo->image = \Storage::disk('public')->put('galleries', $input['file']);
        $gallery_photo->save();

        return true;
    }

    public function delete_uploaded_image($id, array $input)
    {
        return GalleryPhoto::where('gallery_id',$id)->where('id',$input['id'])->delete();
    }

    public function get_uploaded_image($id)
    {
        return GalleryPhoto::where('gallery_id',$id)->get();
    }
}
