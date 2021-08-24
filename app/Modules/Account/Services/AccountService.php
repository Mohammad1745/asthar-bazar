<?php


namespace App\Modules\Account\Services;


use App\Http\Services\ResponseService;
use App\Modules\Account\Repositories\DepartmentOwnershipRepository;
use App\Modules\Account\Repositories\DepartmentTransactionRepository;
use App\Modules\Account\Repositories\OrderRepository;
use App\Modules\Account\Repositories\ReferralCodeRepository;
use App\Modules\Account\Repositories\ReferralUserRepository;
use App\Modules\Account\Repositories\UserWalletRepository;
use App\Modules\Account\Repositories\WalletSubscriptionRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AccountService extends ResponseService
{
    private $referralCodeRepository;
    private $referralUserRepository;
    private $departmentOwnershipRepository;
    private $departmentTransactionRepository;
    private $userWalletRepository;
    private $walletSubscriptionRepository;
    private $orderRepository;

    /**
     * AccountService constructor.
     * @param ReferralCodeRepository $referralCodeRepository
     * @param ReferralUserRepository $referralUserRepository
     * @param DepartmentOwnershipRepository $departmentOwnershipRepository
     * @param DepartmentTransactionRepository $departmentTransactionRepository
     * @param UserWalletRepository $userWalletRepository
     * @param WalletSubscriptionRepository $walletSubscriptionRepository
     * @param OrderRepository $orderRepository
     */
    public function __construct(
        ReferralCodeRepository $referralCodeRepository,
        ReferralUserRepository $referralUserRepository,
        DepartmentOwnershipRepository $departmentOwnershipRepository,
        DepartmentTransactionRepository $departmentTransactionRepository,
        UserWalletRepository $userWalletRepository,
        WalletSubscriptionRepository $walletSubscriptionRepository,
        OrderRepository $orderRepository
    )
    {
        $this->referralCodeRepository = $referralCodeRepository;
        $this->referralUserRepository = $referralUserRepository;
        $this->userWalletRepository = $userWalletRepository;
        $this->departmentOwnershipRepository = $departmentOwnershipRepository;
        $this->departmentTransactionRepository = $departmentTransactionRepository;
        $this->walletSubscriptionRepository = $walletSubscriptionRepository;
        $this->orderRepository=$orderRepository;
    }

    /**
     * @return mixed
     */
    public function referralCode()
    {
        return $this->referralCodeRepository->whereLast(['user_id' => Auth::user()->id]);
    }

    /**
     * @return mixed
     */
    public function referralUsersCount()
    {
        return $this->referralUserRepository->countWhere(['parent_id' => Auth::user()->id]);
    }

    /**
     * @return mixed
     */
    public function orderCount()
    {
        return $this->orderRepository->countWhere(['user_id' => Auth::user()->id]);
    }

    /**
     * @return array
     */
    public function generateReferralCode(): array
    {
        try{
            $user = Auth::user();
            $where = ['user_id' => $user->id];
            $referralCode = $this->referralCodeRepository->whereLast($where);
            if(empty($referralCode)){
                $referralCodeData = [];
                do{
                    $referralCodeData['code'] = Str::random(10);
                    $object = $this->referralCodeRepository->whereLast($referralCodeData);
                }while(!empty($object));
                $referralCodeData['user_id'] = $user->id;
                $this->referralCodeRepository->create($referralCodeData);

                return $this->response()->success('Referral Code has been generated.');
            }else{
                return $this->response()->success('Referral Code has already been generated.');
            }
        }catch (\Exception $exception){
            return $this->response()->error($exception->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function wallet()
    {
        $where = ['user_id' => Auth::user()->id];
        $wallet = $this->userWalletRepository->whereLast($where);
        $where = ['id' => $wallet['wallet_subscription_id']];
        $wallet['subscription'] = $this->walletSubscriptionRepository->whereFirst($where);

        return $wallet;
    }

    /**
     * @return mixed
     */
    public function walletSubscriptions()
    {
         return $this->walletSubscriptionRepository->getAll();
    }

    /**
     * @param $encryptedWalletSubscriptionId
     * @return array
     */
    public function subscribePackage($encryptedWalletSubscriptionId): array
    {
        try{
            $where = ['id' => decrypt($encryptedWalletSubscriptionId)];
            $walletSubscription = $this->walletSubscriptionRepository->whereFirst($where);
            $where = ['user_id' => Auth::user()->id];
            $wallet = $this->userWalletRepository->whereFirst($where);
            if($wallet->amount>=$walletSubscription->charge){
                $userWalletData = [
                    'user_id' => Auth::user()->id,
                    'wallet_subscription_id' => $walletSubscription->id,
                    'amount' => $wallet->amount-$walletSubscription->charge,
                    'capacity' => $walletSubscription->capacity,
                    'expires_at' => (Carbon::now())->addYear()
                ];
                $this->userWalletRepository->update($where, $userWalletData);

                return $this->response()->success('Successfully subscribed to '.$walletSubscription->package.' package.');
            }else{
                return $this->response()->success('Doesn\'t have enough money to subscribe '.$walletSubscription->package.' package.');
            }
        }catch (\Exception $exception){
            return $this->response()->error($exception->getMessage());
        }
    }

    /**
     * @return float|int
     */
    public function profilePercentage()
    {
        $count=0;
        $user = Auth::user();
        if(!is_null($user->first_name)) $count+=8.3;
        if(!is_null($user->last_name)) $count+=8.3;
        if(!is_null($user->username)) $count+=8.3;
        if(!is_null($user->photo)) $count+=8.3;
        if(!is_null($user->email)) $count+=8.3;
        if(!is_null($user->password)) $count+=8.3;
        if(!is_null($user->phone_code)) $count+=8.3;
        if(!is_null($user->phone)) $count+=8.3;
        if(!is_null($user->address)) $count+=8.4;
        if(!is_null($user->zip_code)) $count+=8.3;
        if(!is_null($user->city)) $count+=8.3;
        if(!is_null($user->country)) $count+=8.3;

        return $count;
    }

    /**
     * @return mixed
     */
    public function departmentRevenue()
    {
        $where = ['user_id' => Auth::user()->id];
        $departmentOwnership = $this->departmentOwnershipRepository->whereFirst($where);
        $where = [
            'department_id' => $departmentOwnership->department_id,
            'status' => true
        ];
        return $this->departmentTransactionRepository->sumWhere($where, 'revenue');
    }

    /**
     * @return array
     */
    public function departmentTransactions(): array
    {
        $where = ['user_id' => Auth::user()->id];
        $departmentOwnership = $this->departmentOwnershipRepository->whereFirst($where);
        $where = [
            'department_id' => $departmentOwnership->department_id,
            'status' => true
        ];

        return [
            'revenue' => $this->departmentTransactionRepository->sumWhere($where, 'revenue'),
            'revenue_from_wallet' => $this->departmentTransactionRepository->sumWhere($where, 'revenue_from_wallet'),
            'manufacturing_cost' => $this->departmentTransactionRepository->sumWhere($where, 'manufacturing_cost'),
            'profit' => $this->departmentTransactionRepository->sumWhere($where, 'profit'),
            'customer_reward' => $this->departmentTransactionRepository->sumWhere($where, 'customer_reward'),
            'net_profit' => $this->departmentTransactionRepository->sumWhere($where, 'net_profit'),
        ];
    }

    /**
     * @return mixed
     */
    public function netProfit()
    {
        return $this->departmentTransactionRepository->sumWhere(['status' => true], 'net_profit');
    }

    /**
     * @return array
     */
    public function transactions(): array
    {
        $where = ['status' => true];

        return [
            'revenue' => $this->departmentTransactionRepository->sumWhere($where, 'revenue'),
            'revenue_from_wallet' => $this->departmentTransactionRepository->sumWhere($where, 'revenue_from_wallet'),
            'manufacturing_cost' => $this->departmentTransactionRepository->sumWhere($where, 'manufacturing_cost'),
            'profit' => $this->departmentTransactionRepository->sumWhere($where, 'profit'),
            'customer_reward' => $this->departmentTransactionRepository->sumWhere($where, 'customer_reward'),
            'net_profit' => $this->departmentTransactionRepository->sumWhere($where, 'net_profit'),
        ];
    }

    /**
     * @return array|JsonResponse|mixed
     */
    public function walletSubscriptionPackageListQuery() {
        $walletSubscriptions = $this->walletSubscriptionRepository->getAllQuery();
        try {
            return datatables($walletSubscriptions)
                ->editColumn('package', function ($item) {
                    return $item->package;
                })
                ->editColumn('charge', function ($item) {
                    return '৳'.$item->charge;
                })
                ->editColumn('capacity', function ($item) {
                    return '৳'.$item->capacity;
                })
                ->addColumn('actions', function ($item) {
                    $generatedData = '<ul class="d-flex justify-content-center activity-menus mb-0">';

                    $where = ['user_id' => Auth::user()->id];
                    $wallet = $this->userWalletRepository->whereLast($where);
                    if($wallet->wallet_subscription_id==$item->id){
                        $generatedData .= '<li>Subscribed</li>';
                    }
                    elseif($wallet->amount>=$item->charge){
                        $generatedData .= '<div class="button button_update trans_200 mb-0">';
                        $generatedData .= '<a class="" href="';
                        $generatedData .= route('account.subscribePackage', encrypt($item->id));
                        $generatedData .= '" data-toggle="tooltip" title="Subscribe" onclick="return confirm(\'Are you sure to subscribe '.$item->package.' wallet?\');">';
                        $generatedData .= 'Subscribe';
                        $generatedData .= '</a></div>';
                    }
                    else{
                        $generatedData .= '<li>---------</li>';
                    }
                    $generatedData .= '</ul>';

                    return $generatedData;
                })
                ->rawColumns(['actions'])
                ->make(true);
        } catch (\Exception $exception) {
            return [];
        }
    }
}
