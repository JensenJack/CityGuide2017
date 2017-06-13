<?php

namespace Modules\Gallery\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Gallery\Entities\Gallery;
use Modules\Gallery\Http\Requests\ManageGalleryRequest;
use Modules\Gallery\Http\Requests\CreateGalleryRequest;
use Modules\Gallery\Http\Requests\UpdateGalleryRequest;
use Modules\Gallery\Http\Requests\UploadGalleryImageRequest;
use Modules\Category\Repositories\CategoryRepository;
use Modules\Gallery\Repositories\GalleryRepository;

class GalleryController extends Controller
{
    /**
     * @var GalleryRepository
     * @var CategoryRepository
     */
    protected $galleries;
    protected $categories;

    /**
     * @param GalleryRepository $galleries
     * @param CategoryRepository $categories
     */
    public function __construct(GalleryRepository $galleries,CategoryRepository $categories)
    {
        $this->galleries = $galleries;
        $this->categories = $categories;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('gallery::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $category = $this->categories->getAll();
        return view('gallery::create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateGalleryRequest $request)
    {
        $this->galleries->create($request->all());

        \Log::info($request->name.' Gallery Created By: ' . access()->user()->name);
        return redirect()->route('admin.gallery.index')->withFlashSuccess(trans('alerts.backend.galleries.created'));
    }

    /**
     * @param Gallery              $gallery
     * @param ManageGalleryRequest $request
     *
     * @return mixed
     */
    public function edit(Gallery $gallery, ManageGalleryRequest $request)
    {
        $category = $this->categories->getAll();
        return view('gallery::edit',compact('category'))
            ->withGallery($gallery);
    }

    /**
     * @param Gallery              $gallery
     * @param UpdateGalleryRequest $request
     *
     * @return mixed
     */
    public function update(Gallery $gallery, UpdateGalleryRequest $request)
    {
        $input = $request->all();
        if($request->type == 'image' && $request->hasFile('image')){
            \Storage::disk('public')->delete($gallery->url);
            $input['url'] = \Storage::disk('public')->put('galleries', $request->image);
        }
        else if($request->type == 'image'){
            $input['url'] = $gallery->url;
        }

        $this->galleries->update($gallery,$input);
         \Log::info('Gallery ID '.$gallery->id.'- Updated By: ' . access()->user()->name);
        return redirect()->route('admin.gallery.index')->withFlashSuccess(trans('gallery::alerts.backend.galleries.updated'));
    }

    /**
     * @param Gallery              $gallery
     * @param ManageGalleryRequest $request
     *
     * @return mixed
     */
    public function show(Gallery $gallery, ManageGalleryRequest $request)
    {
        return view('gallery::show')->withGallery($gallery);
    }

    /**
     * @param UploadGalleryImageRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function gallery_image(UploadGalleryImageRequest $request,$id)
    {
        switch ($request->method()){
            case 'POST' :
                $this->galleries->upload_image($id,$request->all());
                break;

            case 'DELETE' :
                $this->galleries->delete_uploaded_image($id,$request->all());
                break;

            default:
                $images = $this->galleries->get_uploaded_image($id);

                $count = 0 ;
                $obj = array();
                foreach ($images as $image) {
                    $obj[$count]['id'] = $image->id;
                    $obj[$count]['name'] = 'Image - '.$image->id;
                    $obj[$count]['image'] = url('storage/'.$image->image);
                    $obj[$count]['size'] = \Storage::disk('public')->size($image->image);
                    $count++;
                }

                return response()->json($obj);
                break;

        }

    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Gallery $gallery)
    {
        $this->galleries->delete($gallery);
         \Log::info('Gallery ID '.$gallery->id.'- Deleted By: ' . access()->user()->name);
        return redirect()->route('admin.gallery.index')->withFlashSuccess(trans('alerts.backend.galleries.deleted'));
    }
}
