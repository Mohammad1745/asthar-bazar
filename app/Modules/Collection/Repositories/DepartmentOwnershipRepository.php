<?php

namespace App\Modules\Collection\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\DepartmentOwnership;

class DepartmentOwnershipRepository extends CommonRepository
{
    public $model;

    /**
     * DepartmentOwnership constructor.
     */
    public function __construct()
    {
        $this->model = new DepartmentOwnership();
        parent::__construct($this->model);
    }
}
