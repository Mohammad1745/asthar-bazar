<?php

namespace App\Modules\FAQ\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\FAQ;

class FAQRepository extends CommonRepository
{
    public $model;

    /**
     * FAQRepository constructor.
     */
    public function __construct()
    {
        $this->model = new FAQ();
        parent::__construct($this->model);
    }

//    /**
//     * @param $where
//     * @return mixed
//     */
//    public function types($where)
//    {
//        return FAQ::select([
//            'types.id as id',
//            'types.title as title',
//            'types.description as description',
//        ])
//            ->leftjoin('departments', ['types.department_id' => 'departments.id'])
//            ->leftjoin('department_ownerships', ['department_ownerships.department_id' => 'departments.id'])
//            ->where($where)
//            ->distinct('types.id')
//            ->orderBy('types.id', 'desc')
//            ->get();
//    }
}
