<?php


namespace App\Modules\Home\Services;

use App\Modules\Home\Repositories\CollectionItemRepository;
use App\Modules\Home\Repositories\CollectionRepository;
use App\Modules\Home\Repositories\ProductRepository;
use App\Modules\Home\Repositories\ProductVariationRepository;
use App\Modules\Home\Repositories\TypeRepository;

class HomeService
{
    private $collectionRepository;
    private $collectionItemRepository;
    private $typeRepository;
    private $productRepository;
    private $productVariationRepository;

    /**
     * HomeService constructor.
     * @param CollectionRepository $collectionRepository
     * @param CollectionItemRepository $collectionItemRepository
     * @param TypeRepository $typeRepository
     * @param ProductRepository $productRepository
     * @param ProductVariationRepository $productVariationRepository
     */
    public function __construct(
        CollectionRepository $collectionRepository,
        CollectionItemRepository $collectionItemRepository,
        TypeRepository $typeRepository,
        ProductRepository $productRepository,
        ProductVariationRepository $productVariationRepository
    )
    {
        $this->collectionRepository = $collectionRepository;
        $this->collectionItemRepository = $collectionItemRepository;
        $this->typeRepository = $typeRepository;
        $this->productRepository = $productRepository;
        $this->productVariationRepository = $productVariationRepository;
    }

    /**
     * @return mixed
     */
    public function randomProductVariations()
    {
        $where = ['status' => true];
        $productVariations = $this->productVariationRepository->getRandomlyWhere($where, 12);
        foreach ($productVariations as $productVariation){
            $where = ['id' =>  $productVariation->type_id];
            $productVariation['type_title'] = $this->typeRepository->whereLast($where)->title;
            $where = ['id' =>  $productVariation->product_id];
            $productVariation['product_title'] = $this->productRepository->whereLast($where)->title;
            $where = ['collection_items.product_variation_id' =>  $productVariation->id];
            $collectionItem = $this->collectionItemRepository->itemDetails($where);
            if(!empty($collectionItem)){
                $productVariation['collection_item'] = $collectionItem;
            }
        }

        return $productVariations;
    }

    /**
     * @return mixed
     */
    public function maxDiscount()
    {
        $where = ['title' => 'new'];

        return $this->collectionRepository->maxWhere($where, 'discount');
    }
}
