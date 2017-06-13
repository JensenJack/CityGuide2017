<?php

namespace Modules\Gallery\Http\Controllers;

use Illuminate\Routing\Controller;
use Yajra\Datatables\Facades\Datatables;
use Modules\Gallery\Repositories\GalleryRepository;
use Modules\Gallery\Http\Requests\ManageGalleryRequest;

class GalleryTableController extends Controller
{
    /**
     * @var GalleryRepository
     */
    protected $galleries;

    /**
     * @param GalleryRepository $galleries
     */
    public function __construct(GalleryRepository $galleries)
    {
        $this->galleries = $galleries;
    }

    /**
     * @param ManageGalleryRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageGalleryRequest $request)
    {
        return Datatables::of($this->galleries->getForDataTable())
            ->addColumn('category', function ($gallery) {
                return $gallery->category->name;
            })
            ->editColumn('type', function ($gallery) {
                if($gallery->type == 'image'){
                    return '<img style="width:100px;height:100px;" src="'.url('storage/'.$gallery->url).'"><br>(image)';
                }
                else{
                    return $gallery->url.'<br>(video)';
                }
            })
            ->addColumn('actions', function ($gallery) {
                return $gallery->action_buttons;
            })
            ->make(true);
    }
}
