<?php

namespace App\Modules\Order\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\OrderCharge;

class OrderChargeRepository extends CommonRepository
{
    public $model;

    /**
     * OrderChargeRepository constructor.
     */
    public function __construct()
    {
        $this->model = new OrderCharge();
        parent::__construct($this->model);
    }
}
