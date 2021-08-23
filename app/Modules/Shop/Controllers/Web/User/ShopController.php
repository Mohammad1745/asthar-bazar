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
    private $shopService;

    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;
    }

    /**
     * @return Application|Factory|View
     */
    public function shop()
    {
        $data['base'] = 'home';
        $data['menu'] = 'shop';
        $data['user'] = Auth::user();
        $data['departments'] = $this->shopService->departments();
        $data['upcomingDepartments'] = $this->shopService->upcomingDepartments();
        $data['productVariations'] = $this->shopService->randomProductVariations();

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
        $data['currentDepartment'] = $this->shopService->currentDepartment($encryptedDepartmentId);
        $data['currentCategory'] = $this->shopService->currentCategory($encryptedCategoryId);
        $data['currentType'] = $this->shopService->currentType($encryptedTypeId);
        $data['departments'] = $this->shopService->departments();
        $data['upcomingDepartments'] = $this->shopService->upcomingDepartments();
        $data['types'] = $this->shopService->types($encryptedDepartmentId);
        $data['categories'] = $this->shopService->categories($encryptedDepartmentId);
        $data['productVariations'] = $this->shopService->departmentProductVariations($encryptedDepartmentId, $encryptedCategoryId, $encryptedTypeId);

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
        $data['productVariation'] = $this->shopService->productVariation($encryptedProductVariationId);
        $data['type'] = $this->shopService->type($encryptedProductVariationId);
        $data['product'] = $this->shopService->product($encryptedProductVariationId);
        $data['category'] = $this->shopService->category($encryptedProductVariationId);
        $data['department'] = $this->shopService->department($encryptedProductVariationId);

        return view('user.shop.product', $data);
    }
}
