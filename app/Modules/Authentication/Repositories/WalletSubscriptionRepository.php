<?php

namespace App\Modules\Authentication\Repositories;

use App\Http\Repositories\CommonRepository;
use App\Models\WalletSubscription;

class WalletSubscriptionRepository extends CommonRepository
{
    public $model;

    /**
     * WalletSubscriptionRepository constructor.
     */
    public function __construct()
    {
        $this->model = new WalletSubscription();
        parent::__construct($this->model);
    }
}
