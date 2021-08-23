<?php

namespace App\Modules\Collection\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\Department;

class DepartmentRepository extends CommonRepository
{
    public $model;

    /**
     * DepartmentRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Department();
        parent::__construct($this->model);
    }
}
