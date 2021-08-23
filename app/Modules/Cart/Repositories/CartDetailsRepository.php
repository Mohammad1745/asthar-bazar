<?php

namespace App\Modules\Cart\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\CartDetails;

class CartDetailsRepository extends CommonRepository
{
    public $model;

    /**
     * CartDetailsRepository constructor.
     */
    public function __construct()
    {
        $this->model = new CartDetails();
        parent::__construct($this->model);
    }

    /**
     * @param $where
     * @return mixed
     */
    public function details($where)
    {
        return CartDetails::select([
            'cart_details.id as id',
            'product_variations.id as product_variation_id',
            'product_variations.product_id as product_id',
            'product_variations.type_id as type_id',
            'product_variations.title as title',
            'product_variations.image as image',
            'product_variations.unit_price as unit_price',
            'cart_details.quantity as quantity',
            'product_variations.unit_of_quantity as unit_of_quantity',
            'cart_details.price as price',
            'products.title as product_title',
            'types.title as type_title',
            'departments.title as department_title',
        ])
            ->leftjoin('carts', ['cart_details.cart_id' => 'carts.id'])
            ->leftjoin('product_variations', ['cart_details.product_variation_id' => 'product_variations.id'])
            ->leftjoin('types', ['product_variations.type_id' => 'types.id'])
            ->leftjoin('products', ['product_variations.product_id' => 'products.id'])
            ->leftjoin('categories', ['products.category_id' => 'categories.id'])
            ->leftjoin('departments', ['categories.department_id' => 'departments.id', 'types.department_id' => 'departments.id'])
            ->where($where)
            ->distinct('cart_details.id')
            ->get();
    }
}
