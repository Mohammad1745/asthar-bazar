<?php

namespace App\Modules\Order\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\OrderPayment;

class OrderPaymentRepository extends CommonRepository
{
    public $model;

    /**
     * OrderPaymentRepository constructor.
     */
    public function __construct()
    {
        $this->model = new OrderPayment();
        parent::__construct($this->model);
    }
}
