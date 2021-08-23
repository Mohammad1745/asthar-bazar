<?php

namespace App\Modules\Department\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\Type;

class TypeRepository extends CommonRepository
{
    public $model;

    /**
     * TypeRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Type();
        parent::__construct($this->model);
    }
}
