<?php

namespace App\Modules\Department\Repositories;

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
    public function details($where)
    {
        return Department::select([
            'departments.id as id',
            'departments.title as title',
            'departments.description as description',
            'departments.created_at as created_at',
            'department_ownerships.status as status',
            'users.id as owner_id',
            'users.first_name as owner_first_name',
            'users.last_name as owner_last_name',
        ])
            ->leftjoin('department_ownerships', ['department_ownerships.department_id' => 'departments.id'])
            ->leftjoin('users', ['department_ownerships.user_id' => 'users.id'])
            ->where($where)
            ->orderBy('departments.id', 'desc')
            ->distinct('departments.id')
            ->first();
    }
}
