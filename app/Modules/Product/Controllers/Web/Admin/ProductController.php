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
    private $productService;

    /**
     * ProductController constructor.
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @return Application|Factory|View
     */
    public function product()
    {
        $data['base'] = 'department';
        $data['menu'] = 'product';
        $data['user'] = Auth::user();
        $data['categories'] = $this->productService->tailCategories();

        return view('admin.product.content', $data);
    }

    /**
     * @return mixed
     */
    public function productList()
    {
        return $this->productService->productListQuery();
    }

    /**
     * @param StoreProductRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StoreProductRequest $request)
    {
        $response = $this->productService->store($request);

        return redirect(route('admin.product'))->with($response['webResponse']);
    }

    /**
     * @param UpdateProductRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateProductRequest $request)
    {
        $response = $this->productService->update($request);

        return redirect(route('admin.product'))->with($response['webResponse']);
    }

    /**
     * @param $encryptedProductId
     * @return Application|RedirectResponse|Redirector
     */
    public function delete($encryptedProductId)
    {
        $response = $this->productService->delete($encryptedProductId);

        return $response['success'] ?
            redirect(route('admin.product'))->with($response['webResponse']):
            redirect()->back()->with($response['webResponse']);
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
        $data['product'] = $this->productService->product($encryptedProductId);
        $data['productVariations'] = $this->productService->productVariations($encryptedProductId);
        $data['categories'] = $this->productService->tailCategories();
        $data['types'] = $this->productService->types();

        return view('admin.product.details', $data);
    }

    /**
     * @param $encryptedProductId
     * @return mixed
     */
    public function productVariationList($encryptedProductId)
    {
        return $this->productService->productVariationListQuery($encryptedProductId);
    }

    /**
     * @param StoreProductVariationRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function storeVariation(StoreProductVariationRequest $request)
    {
        $response = $this->productService->storeVariation($request);

        return $response['success'] ?
            redirect(route('admin.product.details', encrypt($response['data']['product_id'])))->with($response['webResponse']) :
            redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param UpdateProductVariationRequest $request
     * @return RedirectResponse
     */
    public function updateVariation(UpdateProductVariationRequest $request)
    {
        $response = $this->productService->updateVariation($request);

        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $encryptedProductVariationId
     * @return Application|RedirectResponse|Redirector
     */
    public function deleteVariation($encryptedProductVariationId)
    {
        $response = $this->productService->deleteVariation($encryptedProductVariationId);

        return $response['success'] ?
            redirect(route('admin.product'))->with($response['webResponse']):
            redirect()->back()->with($response['webResponse']);
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
        $data['types'] = $this->productService->types();
        $data['productVariation'] = $this->productService->productVariationDetails($encryptedProductVariationId);

        return view('admin.product.variation', $data);
    }
}
