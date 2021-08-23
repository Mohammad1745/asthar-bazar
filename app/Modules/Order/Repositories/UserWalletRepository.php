<?php

namespace App\Modules\Order\Repositories;

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
