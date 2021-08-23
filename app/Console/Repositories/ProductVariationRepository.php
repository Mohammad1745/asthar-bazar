<?php

namespace App\Console\Repositories;

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
}
