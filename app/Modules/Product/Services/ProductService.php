<?php


namespace App\Modules\Product\Services;

use App\Modules\Product\Repositories\CategoryRepository;
use App\Modules\Product\Repositories\DepartmentOwnershipRepository;
use App\Modules\Product\Repositories\ProductRepository;
use App\Modules\Product\Repositories\ProductVariationRepository;
use App\Modules\Product\Repositories\TypeRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    private $errorMessage;
    private $errorResponse;
    private $departmentOwnershipRepository;
    private $typeRepository;
    private $categoryRepository;
    private $productRepository;
    private $productVariationRepository;

    /**
     * ProductService constructor.
     * @param DepartmentOwnershipRepository $departmentOwnershipRepository
     * @param TypeRepository $typeRepository
     * @param CategoryRepository $categoryRepository
     * @param ProductRepository $productRepository
     * @param ProductVariationRepository $productVariationRepository
     */
    public function __construct(DepartmentOwnershipRepository $departmentOwnershipRepository, TypeRepository $typeRepository, CategoryRepository $categoryRepository, ProductRepository $productRepository, ProductVariationRepository $productVariationRepository)
    {
        $this->departmentOwnershipRepository = $departmentOwnershipRepository;
        $this->typeRepository = $typeRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->productVariationRepository = $productVariationRepository;
        $this->errorMessage = __('Something went wrong');
        $this->errorResponse = [
            'success' => false,
            'message' => $this->errorMessage,
            'data' => [],
            'webResponse' => [
                'dismiss' => $this->errorMessage,
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function tailCategories() {
        $where = ['department_ownerships.user_id' => Auth::user()->id];
        $categories = $this->categoryRepository->categories($where)->get();
        $tailCategories = [];
        foreach ($categories as $category){
            $where = ['parent_id' => $category->id];
            $subcategory = $this->categoryRepository->whereLast($where);
            if(is_null($subcategory)){
                array_push($tailCategories, $category);
            }
        }

        return $tailCategories;
    }

    /**
     * @return mixed
     */
    public function types() {
        $where = ['department_ownerships.user_id' => Auth::user()->id];

        return $this->typeRepository->types($where);
    }

    /**
     * @param $encryptedProductId
     * @return mixed
     */
    public function product($encryptedProductId)
    {
        $where = ['id' => decrypt($encryptedProductId)];
        $product = $this->productRepository->whereLast($where);
        $where = ['id' => $product->category_id];
        $product['category'] = $this->categoryRepository->whereLast($where);

        return $product;
    }

    /**
     * @param $encryptedProductId
     * @return mixed
     */
    public function productVariations($encryptedProductId)
    {
        $where = ['product_id' => decrypt($encryptedProductId)];

        return $this->productVariationRepository->getWhere($where);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request) {
        try{
            $productData = [
                'title' => $request->title,
                'category_id' => $request->category_id
            ];
            $this->productRepository->create($productData);

            return [
                'success' => true,
                'message' => __('Product has been added.'),
                'webResponse' => [
                    'success' => __('Product has been added.')
                ],
            ];
        }catch (\Exception $exception){
            return $this->errorResponse;
        }
    }

    /**
     * @param $request
     * @return mixed
     */
    public function update($request) {
        try{
            $where = ['id' => $request->id];
            $productData = [
                'title' => $request->title,
                'category_id' => $request->category_id
            ];
            $this->productRepository->update($where, $productData);

            return [
                'success' => true,
                'message' => __('Product has been updated.'),
                'webResponse' => [
                    'success' => __('Product has been updated.')
                ],
            ];
        }catch (\Exception $exception){
            return $this->errorResponse;
        }
    }

    /**
     * @param $encryptedProductId
     * @return array
     */
    public function delete($encryptedProductId)
    {
        try{
            $where = ['id' => decrypt($encryptedProductId)];
            $this->productRepository->deleteWhere($where);

            return [
                'success' => true,
                'message' => 'Product has been deleted.',
                'data' => [],
                'webResponse' => [
                    'success' => 'Product has been deleted.'
                ],
            ];
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @param $request
     * @return array
     */
    public function storeVariation($request) {
        try{
            $productVariationData = $this->prepareVariationData($request);
            $variation = $this->productVariationRepository->create($productVariationData);

            return [
                'success' => true,
                'message' => __('Product Variation added.'),
                'data' => $variation,
                'webResponse' => [
                    'success' => __('Product Variation added.')
                ],
            ];
        }catch (\Exception $exception){
            return $this->errorResponse;
        }
    }

    /**
     * @param $request
     * @return array
     */
    private function prepareVariationData($request)
    {
        return [
            'product_id' => $request->product_id,
            'type_id' => $request->type_id,
            'title' => $request->title,
            'description' => $request->description,
            'image' => uploadFile($request->image, productVariationImagePath()),
            'quantity' => $request->quantity,
            'unit_of_quantity' => $request->unit_of_quantity,
            'weight_per_unit' => $request->weight_per_unit,
            'manufacturing_cost' => $request->manufacturing_cost,
            'regular_price' => $request->regular_price,
            'unit_price' => $request->regular_price,
            'status' => $request->status,
            'available_at' => date_format(Carbon::now(), 'Y-m-d'),
        ];
    }

    /**
     * @param $request
     * @return array
     */
    public function updateVariation($request) {
        try{
            $where = ['id' => $request->id];
            $productVariationData = $this->prepareUpdatedVariationData($request);
            $this->productVariationRepository->update($where, $productVariationData);

            return [
                'success' => true,
                'message' => __('Product Variation updated.'),
                'webResponse' => [
                    'success' => __('Product Variation updated.')
                ],
            ];
        }catch (\Exception $exception){
            return $this->errorResponse;
        }
    }

    /**
     * @param $request
     * @return array
     */
    private function prepareUpdatedVariationData($request)
    {
        $preparedData = [
            'type_id' => $request->type_id,
            'title' => $request->title,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'unit_of_quantity' => $request->unit_of_quantity,
            'weight_per_unit' => $request->weight_per_unit,
            'manufacturing_cost' => $request->manufacturing_cost,
            'regular_price' => $request->regular_price,
            'unit_price' => $request->regular_price,
            'status' => $request->status,
            'available_at' => $request->available_at,
        ];
        if(isset($request->image)){
            $where = ['id' => $request->id];
            $oldImage = $this->productVariationRepository->whereLast($where)->image;
            $preparedData['image'] = uploadFile($request->image, productVariationImagePath(), $oldImage);
        }

        return $preparedData;
    }

    /**
     * @param $encryptedProductVariationId
     * @return array
     */
    public function deleteVariation($encryptedProductVariationId)
    {
        try{
            $where = ['id' => decrypt($encryptedProductVariationId)];
            $this->productVariationRepository->deleteWhere($where);

            return [
                'success' => true,
                'message' => 'Product Variation has been deleted.',
                'data' => [],
                'webResponse' => [
                    'success' => 'Product Variation has been deleted.'
                ],
            ];
        }catch (\Exception $e){
            return $this->errorResponse;
        }
    }

    /**
     * @param $encryptedProductVariationId
     * @return mixed
     */
    public function productVariationDetails($encryptedProductVariationId)
    {
        $where = ['product_variations.id' => decrypt($encryptedProductVariationId)];

        return $this->productVariationRepository->details($where);
    }

    /**
     * @return array|JsonResponse|mixed
     */
    public function productListQuery() {
        $where = ['department_ownerships.user_id' => Auth::user()->id];
        $products = $this->productRepository->products($where);
        try {
            return datatables($products)
                ->editColumn('title', function ($item) {
                    return $item->title;
                })
                ->addColumn('category', function ($item) {
                    return $item->category_title;
                })
                ->addColumn('variations', function ($item) {
                    $where = ['product_id' => $item->id];

                    return $this->productVariationRepository->countWhere($where);
                })
                ->addColumn('actions', function ($item) {
                    $generatedData = '<ul class="d-flex justify-content-center activity-menus mb-0">';

                    $generatedData .= '<a class="text-primary" href="';
                    $generatedData .= route('admin.product.details', encrypt($item->id));
                    $generatedData .= '" data-toggle="tooltip" title="Edit">';
                    $generatedData .= '<i class="fa fa-eye"></i>';
                    $generatedData .= '</a>';
                    $generatedData .= '</ul>';

                    return $generatedData;
                })
                ->rawColumns(['actions'])
                ->make(true);
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * @param $encryptedProductId
     * @return array|JsonResponse|mixed
     */
    public function productVariationListQuery($encryptedProductId) {
        $where = ['product_id' => decrypt($encryptedProductId)];
        $productVariations = $this->productVariationRepository->getWhereQuery($where);
        try {
            return datatables($productVariations)
                ->editColumn('title', function ($item) {
                    return $item->title;
                })
                ->editColumn('product', function ($item) {
                    $where = ['id' => $item->product_id];

                    return $this->productRepository->whereLast($where)->title;
                })
                ->editColumn('type', function ($item) {
                    $where = ['id' => $item->type_id];

                    return $this->typeRepository->whereLast($where)->title;
                })
                ->editColumn('quantity', function ($item) {
                    return $item->quantity;
                })
                ->editColumn('Unit of Quantity', function ($item) {
                    return $item->unit_of_quantity;
                })
                ->editColumn('weight_per_unit', function ($item) {
                    return $item->weight_per_unit;
                })
                ->editColumn('status', function ($item) {
                    return $item->status ?
                        '<span class="text-success">Active</span>':
                        '<span class="text-danger">Inactive</span>';
                })
                ->addColumn('actions', function ($item) {
                    $generatedData = '<ul class="d-flex justify-content-center activity-menus mb-0">';

                    $generatedData .= '<a class="text-primary" href="';
                    $generatedData .= route('admin.product.variationDetails', encrypt($item->id));
                    $generatedData .= '" data-toggle="tooltip" title="Edit">';
                    $generatedData .= '<i class="fa fa-eye"></i>';
                    $generatedData .= '</a>';
                    $generatedData .= '</ul>';

                    return $generatedData;
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        } catch (\Exception $e) {
            return [];
        }
    }
}
