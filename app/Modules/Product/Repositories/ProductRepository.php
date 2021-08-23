<?php

namespace App\Modules\Product\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\Product;

class ProductRepository extends CommonRepository
{
    public $model;

    /**
     * ProductRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Product();
        parent::__construct($this->model);
    }

    /**
     * @param $where
     * @return mixed
     */
    public function products($where)
    {
        return Product::select([
            'products.id as id',
            'products.title as title',
            'products.category_id as category_id',
            'categories.title as category_title',
            'categories.description as description',
        ])
            ->leftjoin('categories', ['products.category_id' => 'categories.id'])
            ->leftjoin('departments', ['categories.department_id' => 'departments.id'])
            ->leftjoin('department_ownerships', ['department_ownerships.department_id' => 'departments.id'])
            ->where($where)
            ->orderBy('products.id', 'desc')
            ->distinct('products.id');
    }
}
