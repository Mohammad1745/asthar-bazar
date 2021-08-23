<?php

namespace App\Modules\Order\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\Category;

class CategoryRepository extends CommonRepository
{
    public $model;

    /**
     * CategoryRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Category();
        parent::__construct($this->model);
    }
}
