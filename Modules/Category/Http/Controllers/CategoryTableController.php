<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Routing\Controller;
use Yajra\Datatables\Facades\Datatables;
use Modules\Category\Repositories\CategoryRepository;
use Modules\Category\Http\Requests\ManageCategoryRequest;

class CategoryTableController extends Controller
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
     * @param ManageCategoryRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageCategoryRequest $request)
    {
        return Datatables::of($this->categories->getForDataTable())
            ->addColumn('actions', function ($slider) {
                return $slider->action_buttons;
            })
            ->make(true);
    }
}
