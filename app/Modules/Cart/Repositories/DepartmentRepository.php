<?php

namespace App\Modules\Cart\Repositories;

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

    /**
     * @param $where
     * @return mixed
     */
    public function getActiveDepartments($where)
    {

        return Department::select([
            'departments.id as id',
            'departments.title as title',
            'departments.cover_photo as cover_photo',
            'departments.description as description',
        ])
            ->leftjoin('department_ownerships', ['department_ownerships.department_id' => 'departments.id'])
            ->where($where)
            ->distinct('departments.id')
            ->get();
    }
}
