<?php

namespace App\Modules\Department\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\SaleRecord;

class SaleRecordRepository extends CommonRepository
{
    public $model;

    /**
     * SaleRepository constructor.
     */
    public function __construct()
    {
        $this->model = new SaleRecord();
        parent::__construct($this->model);
    }
}
