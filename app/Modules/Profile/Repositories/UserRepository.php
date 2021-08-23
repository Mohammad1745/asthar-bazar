<?php

namespace App\Modules\Profile\Repositories;

use App\Http\Repositories\CommonRepository;
use App\User;

class UserRepository extends CommonRepository
{
    public $model;

    /**
     * UserRepository constructor.
     */
    public function __construct()
    {
        $this->model = new User();
        parent::__construct($this->model);
    }
}
