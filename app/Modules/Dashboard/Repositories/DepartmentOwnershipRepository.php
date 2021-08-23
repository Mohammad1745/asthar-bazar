<?php

namespace App\Modules\Dashboard\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\DepartmentOwnership;

class DepartmentOwnershipRepository extends CommonRepository
{
    public $model;

    /**
     * DepartmentOwnershipRepository constructor.
     */
    public function __construct()
    {
        $this->model = new DepartmentOwnership();
        parent::__construct($this->model);
    }
}
