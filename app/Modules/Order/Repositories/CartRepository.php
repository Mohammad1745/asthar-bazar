<?php

namespace App\Modules\Order\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\Cart;

class CartRepository extends CommonRepository
{
    public $model;

    /**
     * CartRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Cart();
        parent::__construct($this->model);
    }
}
