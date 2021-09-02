<?php

namespace App\Modules\Product\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Product\Requests\StoreProductRequest;
use App\Modules\Product\Requests\StoreProductVariationRequest;
use App\Modules\Product\Requests\UpdateProductRequest;
use App\Modules\Product\Requests\UpdateProductVariationRequest;
use App\Modules\Product\Services\ProductService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProductController extends Controller
{
    private $service;

    /**
     * ProductController constructor.
     * @param ProductService $service
     */
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Application|Factory|View
     */
    public function product()
    {
        $data['base'] = 'department';
        $data['menu'] = 'product';
        $data['user'] = Auth::user();
        $data['categories'] = $this->service->tailCategories();

        return view('admin.product.content', $data);
    }

    /**
     * @return mixed
     */
    public function productList()
    {
        return $this->service->productListQuery();
    }

    /**
     * @param StoreProductRequest $request
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        return $this->webResponse( $this->service->store($request), 'admin.product');
    }

    /**
     * @param UpdateProductRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateProductRequest $request): RedirectResponse
    {
        return $this->webResponse( $this->service->update($request), 'admin.product');
    }

    /**
     * @param string $encryptedProductId
     * @return RedirectResponse
     */
    public function delete(string $encryptedProductId): RedirectResponse
    {
        return $this->webResponse( $this->service->delete($encryptedProductId), 'admin.product');
    }

    /**
     * @param $encryptedProductId
     * @return Application|Factory|View
     */
    public function details($encryptedProductId)
    {
        $data['base'] = 'department';
        $data['menu'] = 'product';
        $data['user'] = Auth::user();
        $data['product'] = $this->service->product($encryptedProductId);
        $data['productVariations'] = $this->service->productVariations($encryptedProductId);
        $data['categories'] = $this->service->tailCategories();
        $data['types'] = $this->service->types();

        return view('admin.product.details', $data);
    }

    /**
     * @param $encryptedProductId
     * @return mixed
     */
    public function productVariationList($encryptedProductId)
    {
        return $this->service->productVariationListQuery($encryptedProductId);
    }

    /**
     * @param StoreProductVariationRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function storeVariation(StoreProductVariationRequest $request)
    {
        $response = $this->service->storeVariation($request);

        return $response['success'] ?
            redirect(route('admin.product.details', encrypt($response['data']['product_id'])))->with($response['message']) :
            redirect()->back()->with($response['message']);
    }

    /**
     * @param UpdateProductVariationRequest $request
     * @return RedirectResponse
     */
    public function updateVariation(UpdateProductVariationRequest $request): RedirectResponse
    {
        return $this->webResponse( $this->service->updateVariation($request));
    }

    /**
     * @param string $encryptedProductVariationId
     * @return RedirectResponse
     */
    public function deleteVariation(string $encryptedProductVariationId): RedirectResponse
    {
        return $this->webResponse( $this->service->deleteVariation($encryptedProductVariationId), 'admin.product');
    }

    /**
     * @param $encryptedProductVariationId
     * @return Application|Factory|View
     */
    public function variationDetails($encryptedProductVariationId)
    {
        $data['base'] = 'department';
        $data['menu'] = 'product';
        $data['user'] = Auth::user();
        $data['types'] = $this->service->types();
        $data['productVariation'] = $this->service->productVariationDetails($encryptedProductVariationId);

        return view('admin.product.variation', $data);
    }
}
