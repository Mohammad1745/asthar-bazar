<?php

namespace App\Modules\Order\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\ReferralUser;

class ReferralUserRepository extends CommonRepository
{
    public $model;

    /**
     * ReferralUserRepository constructor.
     */
    public function __construct()
    {
        $this->model = new ReferralUser();
        parent::__construct($this->model);
    }
}
