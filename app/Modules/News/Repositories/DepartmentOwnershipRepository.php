<?php

namespace App\Modules\News\Repositories;

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

    /**
     * @param $where
     */
    public function details($where)
    {
        return DepartmentOwnership::select([
            'departments.id as department_id',
            'departments.title as department_title',
        ])
            ->leftjoin('departments', ['department_ownerships.department_id' => 'departments.id'])
            ->where($where)
            ->first();
    }
}
