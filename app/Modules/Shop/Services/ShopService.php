<?php


namespace App\Modules\Shop\Services;


use App\Http\Services\ResponseService;
use App\Modules\Shop\Repositories\CategoryRepository;
use App\Modules\Shop\Repositories\CollectionItemRepository;
use App\Modules\Shop\Repositories\DepartmentRepository;
use App\Modules\Shop\Repositories\ProductRepository;
use App\Modules\Shop\Repositories\ProductVariationRepository;
use App\Modules\Shop\Repositories\TypeRepository;

class ShopService extends ResponseService
{
    private $departmentRepository;
    private $collectionItemRepository;
    private $typeRepository;
    private $categoryRepository;
    private $productRepository;
    private $productVariationRepository;

    /**
     * ShopService constructor.
     * @param DepartmentRepository $departmentRepository
     * @param CollectionItemRepository $collectionItemRepository
     * @param TypeRepository $typeRepository
     * @param CategoryRepository $categoryRepository
     * @param ProductRepository $productRepository
     * @param ProductVariationRepository $productVariationRepository
     */
    public function __construct(
        DepartmentRepository $departmentRepository,
        CollectionItemRepository $collectionItemRepository,
        TypeRepository $typeRepository,
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
        ProductVariationRepository $productVariationRepository
    )
    {
        $this->departmentRepository = $departmentRepository;
        $this->collectionItemRepository = $collectionItemRepository;
        $this->typeRepository = $typeRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->productVariationRepository = $productVariationRepository;
    }

    /**
     * @return mixed
     */
    public function departments()
    {
        $where = ['department_ownerships.status' => DEPARTMENT_ACTIVE_STATUS];

        return $this->departmentRepository->getDepartments($where);
    }

    /**
     * @return mixed
     */
    public function upcomingDepartments()
    {
        $where = ['department_ownerships.status' => DEPARTMENT_UPCOMING_STATUS];

        return $this->departmentRepository->getDepartments($where);
    }

    /**
     * @return mixed
     */
    public function randomProductVariations()
    {
        $where = [
            'product_variations.status' => true,
            'department_ownerships.status' => DEPARTMENT_ACTIVE_STATUS,
        ];
        $productVariations = $this->productVariationRepository->random($where, 12);
        foreach ($productVariations as $productVariation){
            $where = ['collection_items.product_variation_id' =>  $productVariation->id];
            $collectionItem = $this->collectionItemRepository->itemDetails($where);
            if(!empty($collectionItem)){
                $productVariation['collection_item'] = $collectionItem;
            }
        }

        return $productVariations;
    }

    /**
     * @param $encryptedDepartmentId
     * @return mixed
     */
    public function currentDepartment($encryptedDepartmentId)
    {
        $where = ['id' => decrypt($encryptedDepartmentId)];

        return $this->departmentRepository->whereLast($where);
    }

    /**
     * @param $encryptedCategoryId
     * @return array|mixed
     */
    public function currentCategory($encryptedCategoryId)
    {
        if(decrypt($encryptedCategoryId)==null){
            return [
                'id' => null,
                'title' => 'Category'
            ];
        }else{
            $where = ['id' => decrypt($encryptedCategoryId)];

            return $this->categoryRepository->whereLast($where);
        }
    }

    /**
     * @param $encryptedTypeId
     * @return array|mixed
     */
    public function currentType($encryptedTypeId)
    {
        if(decrypt($encryptedTypeId)==null){
            return [
                'id' => null,
                'title' => 'Type'
            ];
        }else{
            $where = ['id' => decrypt($encryptedTypeId)];

            return $this->typeRepository->whereLast($where);
        }
    }

    /**
     * @param $encryptedDepartmentId
     * @return mixed
     */
    public function categories($encryptedDepartmentId)
    {
        $where = ['department_id' => decrypt($encryptedDepartmentId)];

        return $this->categoryRepository->getWhere($where);
    }

    /**
     * @param $encryptedDepartmentId
     * @return mixed
     */
    public function types($encryptedDepartmentId)
    {
        $where = ['department_id' => decrypt($encryptedDepartmentId)];

        return $this->typeRepository->getWhere($where);
    }

    /**
     * @param $encryptedDepartmentId
     * @param $encryptedCategoryId
     * @param $encryptedTypeId
     * @return mixed
     */
    public function departmentProductVariations($encryptedDepartmentId, $encryptedCategoryId, $encryptedTypeId)
    {
        $where = [
            'departments.id' => decrypt($encryptedDepartmentId),
            'product_variations.status' => true
        ];
        if(decrypt($encryptedCategoryId)!=null) $where['categories.id'] = decrypt($encryptedCategoryId);
        if(decrypt($encryptedTypeId)!=null) $where['types.id'] = decrypt($encryptedTypeId);
        $productVariations = $this->productVariationRepository->filter($where);
        foreach ($productVariations as $productVariation){
            $where = ['collection_items.product_variation_id' =>  $productVariation->id];
            $collectionItem = $this->collectionItemRepository->itemDetails($where);
            if(!empty($collectionItem)){
                $productVariation['collection_item'] = $collectionItem;
            }
        }

        return $productVariations;
    }

    /**
     * @param $encryptedProductVariationId
     * @return mixed
     */
    public function productVariation($encryptedProductVariationId)
    {
        $where = ['id' => decrypt($encryptedProductVariationId)];

        return $this->productVariationRepository->whereLast($where);
    }

    /**
     * @param $encryptedProductVariationId
     * @return mixed
     */
    public function type($encryptedProductVariationId)
    {
        $productVariation = $this->productVariation($encryptedProductVariationId);
        $where = ['id' => $productVariation->type_id];

        return $this->typeRepository->whereLast($where);
    }

    /**
     * @param $encryptedProductVariationId
     * @return mixed
     */
    public function product($encryptedProductVariationId)
    {
        $productVariation = $this->productVariation($encryptedProductVariationId);
        $where = ['id' => $productVariation->product_id];

        return $this->productRepository->whereLast($where);
    }

    /**
     * @param $encryptedProductVariationId
     * @return mixed
     */
    public function category($encryptedProductVariationId)
    {
        $product = $this->product($encryptedProductVariationId);
        $where = ['id' => $product->category_id];

        return $this->categoryRepository->whereLast($where);
    }

    /**
     * @param $encryptedProductVariationId
     * @return mixed
     */
    public function department($encryptedProductVariationId)
    {
        $type = $this->type($encryptedProductVariationId);
        $where = ['id' => $type->department_id];

        return $this->departmentRepository->whereLast($where);
    }
}
