<?php

namespace App\Modules\Category\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Category\Requests\StoreCategoryRequest;
use App\Modules\Category\Requests\UpdateCategoryRequest;
use App\Modules\Category\Services\CategoryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @return Application|Factory|View
     */
    public function category()
    {
        $data['base'] = 'department';
        $data['menu'] = 'category';
        $data['user'] = Auth::user();
        $data['categories'] = $this->categoryService->categoriesNotHavingProducts();

        return view('admin.category.content', $data);
    }

    /**
     * @return mixed
     */
    public function categoryList()
    {
        return $this->categoryService->categoryListQuery();
    }

    /**
     * @param $encryptedCategoryId
     * @return Application|Factory|View
     */
    public function details($encryptedCategoryId)
    {
        $data['base'] = 'department';
        $data['menu'] = 'category';
        $data['user'] = Auth::user();
        $data['category'] = $this->categoryService->details($encryptedCategoryId);
        $data['categories'] = $this->categoryService->categoriesNotHavingProducts();

        return view('admin.category.details', $data);
    }

    /**
     * @param StoreCategoryRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StoreCategoryRequest $request)
    {
        $response = $this->categoryService->store($request);

        return redirect(route('admin.category'))->with($response['webResponse']);
    }

    /**
     * @param UpdateCategoryRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateCategoryRequest $request)
    {
        $response = $this->categoryService->update($request);

        return redirect(route('admin.category'))->with($response['webResponse']);
    }

    /**
     * @param $encryptedCategoryId
     * @return Application|RedirectResponse|Redirector
     */
    public function delete($encryptedCategoryId)
    {
        $response = $this->categoryService->delete($encryptedCategoryId);

        return $response['success'] ?
            redirect(route('admin.category'))->with($response['webResponse']):
            redirect()->back()->with($response['webResponse']);
    }
}
