<?php

namespace App\Modules\Authentication\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\PasswordReset;

class PasswordResetRepository extends CommonRepository
{
    public $model;

    /**
     * PasswordResetRepository constructor.
     */
    public function __construct()
    {
        $this->model = new PasswordReset();
        parent::__construct($this->model);
    }
}
