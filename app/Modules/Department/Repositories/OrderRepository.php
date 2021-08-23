<?php

namespace App\Modules\Department\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\Order;

class OrderRepository extends CommonRepository
{
    public $model;

    /**
     * OrderRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Order();
        parent::__construct($this->model);
    }
}
