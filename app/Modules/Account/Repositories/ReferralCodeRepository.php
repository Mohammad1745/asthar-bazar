<?php

namespace App\Modules\Account\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\ReferralCode;

class ReferralCodeRepository extends CommonRepository
{
    public $model;

    /**
     * ReferralCodeRepository constructor.
     */
    public function __construct()
    {
        $this->model = new ReferralCode();
        parent::__construct($this->model);
    }
}
