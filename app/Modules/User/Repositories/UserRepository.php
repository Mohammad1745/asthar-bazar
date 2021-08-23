<?php

namespace App\Modules\User\Repositories;

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

    /**
     * @return mixed
     */
    public function detailsQuery()
    {
        return User::select([
            'users.id as id',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'users.role as role',
            'users.verification_status as verification_status',
            'user_wallets.amount as wallet',
        ])
            ->leftjoin('user_wallets', ['user_wallets.user_id' => 'users.id']);
    }

    /**
     * @param $where
     * @return mixed
     */
    public function details($where)
    {
        return User::select([
            'users.id as id',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'users.username as username',
            'users.email as email',
            'users.verification_status as verification_status',
            'users.phone_code as phone_code',
            'users.phone as phone',
            'users.address as address',
            'users.zip_code as zip_code',
            'users.city as city',
            'users.country as country',
            'users.role as role',
            'user_wallets.amount as wallet_amount',
            'user_wallets.capacity as wallet_capacity',
            'user_wallets.expires_at as wallet_expires_at',
        ])
            ->leftjoin('user_wallets', ['user_wallets.user_id' => 'users.id'])
            ->where($where)
            ->first();
    }
}
