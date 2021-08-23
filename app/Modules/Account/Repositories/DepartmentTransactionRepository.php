<?php

namespace App\Modules\Account\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\DepartmentTransaction;

class DepartmentTransactionRepository extends CommonRepository
{
    public $model;

    /**
     * DepartmentTransactionRepository constructor.
     */
    public function __construct()
    {
        $this->model = new DepartmentTransaction();
        parent::__construct($this->model);
    }
}
