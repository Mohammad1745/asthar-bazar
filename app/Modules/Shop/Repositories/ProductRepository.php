<?php

namespace App\Modules\Shop\Repositories;

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
}
