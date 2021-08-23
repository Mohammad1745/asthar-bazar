<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/5/19
 * Time: 7:31 PM
 */

namespace App\Modules\Authentication\Repositories;


use App\Http\Repositories\CommonRepository;
use App\User;
use Illuminate\Support\Facades\DB;

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
     * @param $request
     */
    public function deleteToken($request)
    {
        $token = $request->user()->token();
        if (!empty($token)) {
            DB::table('oauth_access_tokens')->where('id', $token->id)->delete();
        }
    }
}
