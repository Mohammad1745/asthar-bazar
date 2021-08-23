<?php

namespace App\Modules\Collection\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\CollectionItem;

class CollectionItemRepository extends CommonRepository
{
    public $model;

    /**
     * CollectionItemRepository constructor.
     */
    public function __construct()
    {
        $this->model = new CollectionItem();
        parent::__construct($this->model);
    }

    /**
     * @param $where
     * @return mixed
     */
    public function collectionItemsQuery($where)
    {
        return CollectionItem::select([
            'collection_items.id as id',
            'collection_items.product_variation_id as product_variation_id',
            'product_variations.title as title',
            'product_variations.regular_price as regular_price',
            'collection_items.discount as discount',
            'product_variations.unit_price as unit_price',
            'products.title as product_title',
            'types.title as type_title',
            'collection_items.expires_at as expires_at',
        ])
            ->leftjoin('product_variations', ['collection_items.product_variation_id' => 'product_variations.id'])
            ->leftjoin('types', ['product_variations.type_id' => 'types.id'])
            ->leftjoin('products', ['product_variations.product_id' => 'products.id'])
            ->where($where);
    }

    /**
     * @param $where
     * @return mixed
     */
    public function itemDetails($where)
    {
        return CollectionItem::select([
            'collection_items.id as id',
            'collections.id as collection_id',
            'collections.title as collection_title',
            'collection_items.product_variation_id as product_variation_id',
            'product_variations.title as title',
            'product_variations.regular_price as regular_price',
            'collection_items.discount as discount',
            'product_variations.unit_price as unit_price',
            'products.title as product_title',
            'types.title as type_title',
            'collection_items.expires_at as expires_at',
        ])
            ->leftjoin('collections', ['collection_items.collection_id' => 'collections.id'])
            ->leftjoin('product_variations', ['collection_items.product_variation_id' => 'product_variations.id'])
            ->leftjoin('types', ['product_variations.type_id' => 'types.id'])
            ->leftjoin('products', ['product_variations.product_id' => 'products.id'])
            ->where($where)
            ->first();
    }
}
