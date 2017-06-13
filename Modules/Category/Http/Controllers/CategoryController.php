<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Category\Entities\Category;
use Modules\Category\Http\Requests\CreateCategoryRequest;
use Modules\Category\Repositories\CategoryRepository;
use Modules\Category\Http\Requests\ManageCategoryRequest;
use Modules\Category\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $categories;

    /**
     * @param CategoryRepository $categories
     */
    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('category::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('category::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $category = new Category($request->all());
        $this->categories->save($category);
        \Log::info($request->name.' Category Created By: ' . access()->user()->name);
        return redirect()->route('admin.category.index')->withFlashSuccess(trans('category::alerts.backend.categories.created'));
    }

    /**
     * @param Category              $category
     * @param ManageCategoryRequest $request
     *
     * @return mixed
     */
    public function edit(Category $category, ManageCategoryRequest $request)
    {
        return view('category::edit')
            ->withCategory($category);
    }

    /**
     * @param Category              $category
     * @param UpdateCategoryRequest $request
     *
     * @return mixed
     */
    public function update(Category $category, UpdateCategoryRequest $request)
    {
        $this->categories->update($category,$request->all());
         \Log::info('Category ID '.$category->id.'- Updated By: ' . access()->user()->name);
        return redirect()->route('admin.category.index')->withFlashSuccess(trans('category::alerts.backend.categories.updated'));
    }


    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Category $category)
    {
        $this->categories->delete($category);
        \Log::info('Category ID '.$category->id.'- Deleted By: ' . access()->user()->name);
        return redirect()->route('admin.category.index')->withFlashSuccess(trans('category::alerts.backend.categories.deleted'));
    }
}
