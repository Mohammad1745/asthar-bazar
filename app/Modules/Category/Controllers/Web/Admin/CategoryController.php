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
    private $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Application|Factory|View
     */
    public function category()
    {
        $data['base'] = 'department';
        $data['menu'] = 'category';
        $data['user'] = Auth::user();
        $data['categories'] = $this->service->categoriesNotHavingProducts();

        return view('admin.category.content', $data);
    }

    /**
     * @return mixed
     */
    public function categoryList()
    {
        return $this->service->categoryListQuery();
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
        $data['category'] = $this->service->details($encryptedCategoryId);
        $data['categories'] = $this->service->categoriesNotHavingProducts();

        return view('admin.category.details', $data);
    }

    /**
     * @param StoreCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        return $this->webResponse($this->service->store($request), 'admin.category');
    }

    /**
     * @param UpdateCategoryRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateCategoryRequest $request): RedirectResponse
    {
        return $this->webResponse($this->service->update($request), 'admin.category');
    }

    /**
     * @param $encryptedCategoryId
     * @return RedirectResponse
     */
    public function delete($encryptedCategoryId): RedirectResponse
    {
        return $this->webResponse($this->service->delete($encryptedCategoryId), 'admin.category');
    }
}
