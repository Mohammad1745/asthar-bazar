<?php

namespace App\Modules\Product\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\Category;

class CategoryRepository extends CommonRepository
{
    public $model;

    /**
     * CategoryRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Category();
        parent::__construct($this->model);
    }

    /**
     * @param $where
     * @return mixed
     */
    public function categories($where)
    {
        return Category::select([
            'categories.id as id',
            'categories.title as title',
            'categories.parent_id as parent_id',
            'categories.description as description',
        ])
            ->leftjoin('departments', ['categories.department_id' => 'departments.id'])
            ->leftjoin('department_ownerships', ['department_ownerships.department_id' => 'departments.id'])
            ->where($where)
            ->distinct('categories.id')
            ->orderBy('categories.id', 'desc');
    }
}
