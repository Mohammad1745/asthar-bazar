<?php

namespace App\Modules\Home\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\ProductVariation;

class ProductVariationRepository extends CommonRepository
{
    public $model;

    /**
     * ProductVariationRepository constructor.
     */
    public function __construct()
    {
        $this->model = new ProductVariation();
        parent::__construct($this->model);
    }

    /**
     * @param $where
     * @return mixed
     */
    public function filter($where)
    {
        return ProductVariation::select([
            'product_variations.id as id',
            'product_variations.product_id as product_id',
            'product_variations.type_id as type_id',
            'product_variations.title as title',
            'product_variations.description as description',
            'product_variations.image as image',
            'product_variations.quantity as quantity',
            'product_variations.unit_of_quantity as unit_of_quantity',
            'product_variations.regular_price as regular_price',
            'product_variations.unit_price as unit_price',
            'product_variations.status as status',
            'product_variations.available_at as available_at',
            'products.title as product_title',
            'types.title as type_title',
        ])
            ->leftjoin('types', ['product_variations.type_id' => 'types.id'])
            ->leftjoin('products', ['product_variations.product_id' => 'products.id'])
            ->leftjoin('categories', ['products.category_id' => 'categories.id'])
            ->leftjoin('departments', ['categories.department_id' => 'departments.id', 'types.department_id' => 'departments.id'])
            ->where($where)
            ->distinct('product_variations.id')
            ->get();
    }
}
