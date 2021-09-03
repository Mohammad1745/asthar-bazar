<?php

namespace App\Modules\Shop\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Modules\Shop\Services\ShopService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ShopController extends Controller
{
    private $service;

    public function __construct(ShopService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Application|Factory|View
     */
    public function shop()
    {
        $data['base'] = 'home';
        $data['menu'] = 'shop';
        $data['user'] = Auth::user();
        $data['departments'] = $this->service->departments();
        $data['upcomingDepartments'] = $this->service->upcomingDepartments();
        $data['productVariations'] = $this->service->randomProductVariations();

        return view('user.shop.content', $data);
    }

    /**
     * @param $encryptedDepartmentId
     * @param $encryptedCategoryId
     * @param $encryptedTypeId
     * @return Application|Factory|View
     */
    public function department($encryptedDepartmentId, $encryptedCategoryId, $encryptedTypeId)
    {
        $data['base'] = 'home';
        $data['menu'] = 'shop';
        $data['user'] = Auth::user();
        $data['currentDepartment'] = $this->service->currentDepartment($encryptedDepartmentId);
        $data['currentCategory'] = $this->service->currentCategory($encryptedCategoryId);
        $data['currentType'] = $this->service->currentType($encryptedTypeId);
        $data['departments'] = $this->service->departments();
        $data['upcomingDepartments'] = $this->service->upcomingDepartments();
        $data['types'] = $this->service->types($encryptedDepartmentId);
        $data['categories'] = $this->service->categories($encryptedDepartmentId);
        $data['productVariations'] = $this->service->departmentProductVariations($encryptedDepartmentId, $encryptedCategoryId, $encryptedTypeId);

        return view('user.shop.content', $data);
    }

    /**
     * @param $encryptedProductVariationId
     * @return Application|Factory|View
     */
    public function productVariation($encryptedProductVariationId)
    {
        $data['base'] = 'home';
        $data['menu'] = 'shop';
        $data['user'] = Auth::user();
        $data['productVariation'] = $this->service->productVariation($encryptedProductVariationId);
        $data['type'] = $this->service->type($encryptedProductVariationId);
        $data['product'] = $this->service->product($encryptedProductVariationId);
        $data['category'] = $this->service->category($encryptedProductVariationId);
        $data['department'] = $this->service->department($encryptedProductVariationId);

        return view('user.shop.product', $data);
    }
}
