<?php

namespace App\Modules\Department\Repositories;

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

    /**
     * @return mixed
     */
    public function getFreshAdmins(){
        $departmentOwnerIds = DepartmentOwnership::pluck('user_id');

        return DepartmentOwnership::select([
            'users.id as id',
            'users.first_name as first_name',
            'users.last_name as last_name',
        ])
            ->rightjoin('users', ['department_ownerships.user_id' => 'users.id'])
            ->where('users.role', ADMIN_ROLE)
            ->whereNotIn('users.id', $departmentOwnerIds)
            ->get();
    }
}
