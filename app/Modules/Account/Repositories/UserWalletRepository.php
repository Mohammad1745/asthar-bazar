<?php

namespace App\Modules\Account\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\UserWallet;

class UserWalletRepository extends CommonRepository
{
    public $model;

    /**
     * UserWalletRepository constructor.
     */
    public function __construct()
    {
        $this->model = new UserWallet();
        parent::__construct($this->model);
    }
}
